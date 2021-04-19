<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Ajax extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();

        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index() {
        
    }

    //CALCULA O FRETE, DE ACORDO COM OS CORREIOS
    public function action_frete() {
        //LOCKA O MUTEX DA SESSAO PARA NÃO PODER ESCREVER E PERMITIR ASSINCRONO
        Session::instance()->write();

        $this->auto_render = false;
        if ($this->request->is_ajax()) {

            $Ini = 0;

            /* NAO ATIVO AINDA */
            $valorFDP = "<label for='pac'><input type='radio' name='vaicarpi' value='" . number_format(0.1, 2, ".", "") . "' onclick='chang(\"P\")' id='pac' checked>Pac - R$ " . number_format(0.1, 2, ",", ".") . "<small>Previs&atilde;o de entrega em at&eacute; " . 0 . " dias &uacute;teis</small></label>";
            $valorFDP .= "<input type='hidden' name='cepConfereP' id='cepConfereP' value='" . number_format(0.1, 2, ".", "") . "'>";
            $valorFDP .= "<input type='hidden' name='cepConfere' id='cepConfere' value='" . number_format(0.1, 2, ".", "") . "'>";

            $carrinho = ORM::factory("carrinhos")->where("CAR_SESSAO", "=", Session::instance()->get('carrinho'.$this->commerceSession))->find_all();

            foreach ($carrinho as $car) {
                $car->CAR_FRETE = 0.1;
                $car->CAR_TIPOFRETE = "PAC";
                $car->CAR_CEP = $this->request->post('cep');
                $car->save();
            }

            echo json_encode(array("ok" => $valorFDP, "valor" => $Ini));
            exit;
            /* FIM NAO ATIVO */

            //PEGA O FRETE GRATIS (S OU N)
            $freteGratis = $this->request->post("freteGratis");

            //SE FOR FRETE GRÁTIS, VALOR 0
            if ($freteGratis == "S") {
                $valorFDP = "<label for='pac'><input type='radio' name='vaicarpi' value='" . number_format(0, 2, ".", "") . "' onclick='chang(\"P\")' id='pac' checked>Pac - R$ " . number_format(0, 2, ",", ".") . "</label>";
                $valorFDP .= "<label for='sedex'><input type='radio' onclick='chang(\"S\")' value='" . number_format(0, 2, ".", "") . "' name='vaicarpi' id='sedex'>Sedex - R$ " . number_format(0, 2, ",", ".") . "</label>";
                $valorFDP .= "<input type='hidden' name='cepConfere' id='cepConfere' value='" . number_format(0, 2, ".", "") . "'>";

                $carrinho = ORM::factory("carrinhos")->where("CAR_SESSAO", "=", Session::instance()->get('carrinho'.$this->commerceSession))->find_all();

                foreach ($carrinho as $car) {
                    $car->CAR_FRETE = 0;
                    $car->CAR_CEP = $this->request->post('cep');
                    $car->save();
                }
            } else {
                //INFORMAÇÃO CORREIOS
                $empresa = "13354191";
                $senha = "3pf8tw";
                $cepEmpresa = "99010110";

                //AQUI VAI CALCULO DO FRETE
                $resultado_busca = $this->buscaCep($this->request->post('cep'));

                if ($this->request->post('cep') == '' || $resultado_busca['cidade'] == '') {
                    //RETORNA O CEP NÃO ENCONTRADO
                    echo json_encode(array(
                        "ok" => '<input type="hidden" name="cepNaoExiste" id="cepNaoExiste" value="1"><b>CEP não encontrado!</b>',
                        "valor" => 0
                    ));
                    exit;
                } else {
                    $cepe = str_replace("-", "", $this->request->post('cep'));

                    //TIPO - PAC
                    $tp = 41068;

                    //PAC - TROCAR O ID DA EMPRESA E A SENHA, DE ACORDO COM CADASTRO NOS CORREIOS
                    $link = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=' . $empresa . '&sDsSenha=' . $senha . '&sCepOrigem='.$cepEmpresa.'&sCepDestino=' . $cepe . '&nVlPeso=' . $this->request->post("pesoFrete") . '&nCdFormato=1&nVlComprimento=' . $this->request->post("comprimentoFrete") . '&nVlAltura=' . $this->request->post("alturaFrete") . '&nVlLargura=' . $this->request->post("larguraFrete") . '&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=' . $tp . '&nVlDiametro=0&StrRetorno=xml';

                    $resul = file_get_contents($link);

                    //DEFAULT: PAC
                    $erro = explode("<MsgErro>", $resul);
                    $erro = explode("</MsgErro>", $erro[1]);
                    $erro[0] = str_replace("]]>", "", str_replace("<![CDATA[", "", $erro[0]));

                    $erro2 = explode("<Erro>", $resul);
                    $erro2 = explode("</Erro>", $erro2[1]);
                    //if($erro2[0] == 0) echo "oi";
                    if ($erro[0] != "" and $erro2[0] != 0) {
                        $carrinho = ORM::factory("carrinhos")->where("CAR_SESSAO", "=", Session::instance()->get('carrinho'.$this->commerceSession))->find_all();

                        foreach ($carrinho as $car) {
                            $car->CAR_TIPOFRETE = "PAC";
                            $car->CAR_CEP = $this->request->post('cep');
                            $car->save();
                        }

                        //SE FOR UM DESSES CÓDIGOS, É PROBLEMA NO TAMANHO
                        if($erro2[0] == "-18" or $erro2[0] == "-20" or $erro2[0] == "-22"){
                            $valorFDP = $erro[0] . "<input type='hidden' name='tamanhoInvalido' id='tamanhoInvalido' value='1'>";
                        }else{
                            $valorFDP = $erro[0] . "<input type='hidden' name='cepNaoExiste' id='cepNaoExiste' value='1'>";
                        }
                    } else {
                        $valor = explode("<Valor>", $resul);
                        $valor = explode("</Valor>", $valor[1]);
                        $valor = str_replace(",", ".", str_replace(".", "", $valor[0]));

                        $Ini = $valor;

                        $carrinho = ORM::factory("carrinhos")->where("CAR_SESSAO", "=", Session::instance()->get('carrinho'.$this->commerceSession))->find_all();

                        foreach ($carrinho as $car) {
                            $car->CAR_TIPOFRETE = "PAC";
                            $car->CAR_FRETE = $valor;
                            $car->CAR_CEP = $this->request->post('cep');
                            $car->save();
                        }

                        $prazoEnt = explode("<PrazoEntrega>", $resul);
                        $prazoEnt = explode("</PrazoEntrega>", $prazoEnt[1]);

                        $valorFDP = "<label for='pac'><input type='radio' name='vaicarpi' value='" . number_format($valor, 2, ".", "") . "' onclick='chang(\"P\")' id='pac' checked>Pac - R$ " . number_format($valor, 2, ",", ".") . "</label>";
                        $valorFDP .= "<input type='hidden' name='cepConfere' id='cepConfere' value='" . number_format($valor, 2, ".", "") . "'>";
                        $valorFDP .= "<input type='hidden' name='cepConfereP' id='cepConfereP' value='" . number_format($valor, 2, ".", "") . "'>";
                    }

                    //SEDEX - TROCAR O ID DA EMPRESA E A SENHA, DE ACORDO COM CADASTRO NOS CORREIOS
                    $tp = 40096;
                    $link = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=' . $empresa . '&sDsSenha=' . $senha . '&sCepOrigem='.$cepEmpresa.'&sCepDestino=' . $cepe . '&nVlPeso=' . $this->request->post("pesoFrete") . '&nCdFormato=1&nVlComprimento=' . $this->request->post("comprimentoFrete") . '&nVlAltura=' . $this->request->post("alturaFrete") . '&nVlLargura=' . $this->request->post("larguraFrete") . '&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=' . $tp . '&nVlDiametro=0&StrRetorno=xml';
                    $resul = file_get_contents($link);

                    $erro = explode("<MsgErro>", $resul);
                    $erro = explode("</MsgErro>", $erro[1]);

                    $erro2 = explode("<Erro>", $resul);
                    $erro2 = explode("</Erro>", $erro2[1]);
                    
                    if ($erro[0] != "" and $erro2[0] != 0) {
                        //FAZ NADA
                        //$valorFDP = $erro[0] . "<input type='hidden' name='cepNaoExiste' id='cepNaoExiste' value='1'>";
                    } else {
                        $valor = explode("<Valor>", $resul);
                        $valor = explode("</Valor>", $valor[1]);
                        $valor = str_replace(",", ".", str_replace(".", "", $valor[0]));

                        $prazoEnt = explode("<PrazoEntrega>", $resul);
                        $prazoEnt = explode("</PrazoEntrega>", $prazoEnt[1]);

                        $valorFDP .= "<label for='sedex'><input type='radio' onclick='chang(\"S\")' value='" . number_format($valor, 2, ".", "") . "' name='vaicarpi' id='sedex'>Sedex - R$ " . number_format($valor, 2, ",", ".") . "</label>";
                        $valorFDP .= "<input type='hidden' name='cepConfereS' id='cepConfereS' value='" . number_format($valor, 2, ".", "") . "'>";
                    }
                }
            }

            echo json_encode(array("ok" => $valorFDP, "valor" => $Ini));
        }
    }

    //BUSCA A CIDADE E ESTADO DE ACORDO COM O CEP INFORMADO
    public function buscaCep($cep) {
        include('phpQuery.php');

        $url = 'http://m.correios.com.br/movel/buscaCepConfirma.do';

        $post = array(
            'cepEntrada' => $cep,
            'tipoCep' => '',
            'cepTemp' => '',
            'metodo' => 'buscarCep'
        );

        $get = array();

        $url = explode('?', $url, 2);
        if (count($url) === 2) {
            $temp_get = array();
            parse_str($url[1], $temp_get);
            $get = array_merge($get, $temp_get);
        }

        $ch = curl_init($url[0] . "?" . http_build_query($get));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $retorno = curl_exec($ch);

        $html = $retorno;

        phpQuery::newDocumentHTML($html, $charset = 'utf-8');

        $dados = array(
            'logradouro' => trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html()),
            'bairro' => trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html()),
            'cidade/uf' => trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html()),
            'cep' => trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html())
        );

        $dados['cidade/uf'] = explode('/', $dados['cidade/uf']);
        $dados['cidade'] = trim($dados['cidade/uf'][0]);
        if(isset($dados['cidade/uf'][1])){
            $dados['uf'] = trim($dados['cidade/uf'][1]);
        }else{
            $dados['uf'] = "";
        }
        unset($dados['cidade/uf']);

        return $dados;
    }

    //ATUALIZA MUDANÇA DE STATUS DA CIELO
    public function action_mudancastatus() {

        $this->auto_render = FALSE;

        /* CAMPOS */
        $orderNumber = $this->request->post("checkout_cielo_order_number");
        $idPedido = $this->request->post("order_number");
        $status = $this->request->post("payment_status");

        //ATUALIZA CONFORME STATUS
        switch ($status) {
            case 1: //PENDENTE
                $pedido = ORM::factory("pedidos", $idPedido);

                if ($pedido->loaded()) {
                    $pedido->PES_ID = 1;

                    try {
                        $pedido->save();
                    } catch (ORM_Validation_Exception $e) {
                        print_r($e->errors('models'));
                    }
                }
                break;
            case 2: //PAGO
                $pedido = ORM::factory("pedidos", $idPedido);

                if ($pedido->loaded()) {
                    $pedido->PES_ID = 3;

                    try {
                        $pedido->save();
                    } catch (ORM_Validation_Exception $e) {
                        print_r($e->errors('models'));
                    }
                }
                break;
            case 3: //NEGADA
                $pedido = ORM::factory("pedidos", $idPedido);

                if ($pedido->loaded()) {
                    $pedido->PES_ID = 2;

                    try {
                        $pedido->save();

                        //DEVOLVE PRODUTO AO ESTOQUE
                        $itenspedido = ORM::factory("itenspedido")->where("PED_ID", "=", $idPedido)->find_all();

                        foreach ($itenspedido as $ite) {
                            $produto = ORM::factory("produtos", $ite->PRO_ID);

                            if ($produto->loaded()) {
                                $produto->PRO_ESTOQUE = $produto->PRO_ESTOQUE + $ite->PRO_QUANTIDADE;

                                try {
                                    $produto->save();
                                } catch (ORM_Validation_Exception $e) {
                                    print_r($e->errors('models'));
                                }
                            }
                        }
                    } catch (ORM_Validation_Exception $e) {
                        print_r($e->errors('models'));
                    }
                }

                break;
            case 5: //CANCELADA
                $pedido = ORM::factory("pedidos", $idPedido);

                if ($pedido->loaded()) {
                    $pedido->PES_ID = 2;

                    try {
                        $pedido->save();

                        //DEVOLVE PRODUTO AO ESTOQUE
                        $itenspedido = ORM::factory("itenspedido")->where("PED_ID", "=", $idPedido)->find_all();

                        foreach ($itenspedido as $ite) {
                            $produto = ORM::factory("produtos", $ite->PRO_ID);

                            if ($produto->loaded()) {
                                $produto->PRO_ESTOQUE = $produto->PRO_ESTOQUE + $ite->PRO_QUANTIDADE;

                                try {
                                    $produto->save();
                                } catch (ORM_Validation_Exception $e) {
                                    print_r($e->errors('models'));
                                }
                            }
                        }
                    } catch (ORM_Validation_Exception $e) {
                        print_r($e->errors('models'));
                    }
                }

                break;
            case 6: //NÃO FINALIZADO
                $pedido = ORM::factory("pedidos", $idPedido);

                if ($pedido->loaded()) {
                    $pedido->PES_ID = 1;

                    try {
                        $pedido->save();
                    } catch (ORM_Validation_Exception $e) {
                        print_r($e->errors('models'));
                    }
                }
                break;
            case 7: //AUTORIZADO
                $pedido = ORM::factory("pedidos", $idPedido);

                if ($pedido->loaded()) {
                    $pedido->PES_ID = 3;

                    try {
                        $pedido->save();
                    } catch (ORM_Validation_Exception $e) {
                        print_r($e->errors('models'));
                    }
                }
                break;
        }

        //INICIO ENVIO DO EMAIL
        //BUSCA PEDIDO
        $registro_pedido = ORM::factory("pedidos")->with("cidades")
                        ->where("PED_ID", "=", $idPedido)->find();
        
        //INFORMACOES DO CLIENTE
        $cli = ORM::factory("clientes")->with("cidades")->with("clientespf")->with("clientespj")
                        ->where("clientes.CLI_ID", "=", $registro_pedido->CLI_ID)->find();

        //SE TEM O CLIENTE COMO PESSOA FISICA
        if ($cli->CLI_PESSOA == "F") {
            $tipoPessoa = "CPF";
            $numeroTipo = $cli->clientespf->CLI_CPF;
            $nome = $cli->clientespf->CLI_NOME . " " . $cli->clientespf->CLI_SOBRENOME;
        } else {
            $tipoPessoa = "CNPJ";
            $numeroTipo = $cli->clientespj->CLI_CNPJ;
            $nome = $cli->clientespj->CLI_RAZAO_SOCIAL;
        }

        $assunto = "*** PEDIDO DE COMPRA DO SITE - " . $this->empresa["nome"] . " ***";

        //BUSCA ITENS DO PEDIDO
        $consulta_itens = ORM::factory("itenspedido")->with("produtos")
                        ->where("PED_ID", "=", $registro_pedido->PED_ID)->find_all();

        $itens_pedido = "";
        foreach ($consulta_itens as $registros_itens) {
            $total = $registros_itens->PRO_PRECO * $registros_itens->PRO_QUANTIDADE;
            $total = number_format($total, 2, ',', '.');
            $preco_unitario = number_format($registros_itens->PRO_PRECO, 2, ',', '.');

            $itens_pedido .= '<tr><td>' . $registros_itens->produtos->categoriaproduto->CAP_NOME . " - " . $registros_itens->produtos->PRO_TITULO . '</td><td align="center">'
                    . $registros_itens->PRO_QUANTIDADE . '</td><td align="center">' . $preco_unitario . '</td><td align="right">' . $total .
                    '</td></tr>';
        }

        $cidade_entrega = $registro_pedido->cidades->CID_NOME;
        $estado_entrega = $registro_pedido->cidades->estados->EST_NOME;
        $data = $this->aaaammdd_ddmmaaaa($registro_pedido->PED_DATA);
        $total_produtos = number_format($registro_pedido->PED_TOTAL_PEDIDO - $registro_pedido->PED_VALOR_FRETE, 2, ',', '.');
        $valor_frete = number_format($registro_pedido->PED_VALOR_FRETE, 2, ',', '.');

        $COP_PARCELAS = $registro_pedido->PED_PARCELAS;
        $total_pedido = number_format($registro_pedido->PED_TOTAL_PEDIDO, 2, ',', '.');

        // ENVIA EMAIL PARA A EMPRESA
        ($COP_PARCELAS == 1) ? $parcelas = "parcela" : $parcelas = "parcelas";

        //NOVO FORMATO MENSAGEM
        $mensagem = '<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" style="background-color:#ebebeb;font-family:sans-serif;" width="100%">
            <tr>
                <td height="20px"></td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" align="center" width="700" style="background-color:' . $this->coresEmail['background'] . ';border-radius:35px;">
                        <tr>
                            <td style="padding:15px;text-align:center;">
                                <img src="' . $this->dominio . 'images/logo.png" width="260" height="75" style="vertical-align:middle;"/>
                                <span style="color:' . $this->coresEmail['basecolor'] . ';margin-left:150px;font-weight:bold;font-size:20px;">Pedido</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:5px;">
                                <div style="background-color:#fff;margin:auto;padding:0px;width:660px;border-radius:10px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody><tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody><tr>
                                                                <td><a href="' . $this->dominio . '" target="_blank"><img border="0"></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Seu pedido foi concluído com sucesso e neste momento, encaminhado para o faturamento.
                                                                    Assim que o processo for concluído o mesmo será expedido.</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="color: ' . $this->coresEmail['basecolor'] . '; text-align: center; font-size: 22px; font-weight: bold">
                                                                    Pedido <strong style="color:#FF0000">' . $idPedido . '</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody><tr>
                                                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <td style="width: 50%; padding-top: 10px"><table border="0" cellpadding="0" cellspacing="0">
                                                                                                <tbody>
                                                                                                    <td><strong>Data:</strong></td>
                                                                                                    <tr><td style="padding-bottom: 15px">' . $data . '</td></tr>
                                                                                                    <td><strong>Hora:</strong></td>
                                                                                                    <tr><td style="padding-bottom: 15px">' . $registro_pedido->PED_HORA . '</td></tr>
                                                                                                    <td><strong>Cliente:</strong></td>
                                                                                                    <tr><td style="padding-bottom: 15px">' . $nome . '</td></tr>
                                                                                                </tbody>
                                                                                            </table></td>                                     
                                                                                        <td style="padding-top: 10px"><table border="0" cellspacing="0" cellpadding="0">
                                                                                                <td><strong>CPF:</strong></td>
                                                                                                <tr><td style="padding-bottom: 15px">' . $numeroTipo . '</td></tr>
                                                                                                <td><strong>E-mail:</strong></td>
                                                                                                <tr><td style="padding-bottom: 15px">' . $cli->CLI_EMAIL . '</td></tr>';

        $mensagem .= '
                                                                                            </table></td> 
                                                                                        </tbody></table></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody><tr style="line-height: 45px; font-size: 17px" bgcolor="' . $this->coresEmail['background'] . '">
                                                                                                <td width="39%" title="Produtos escolhidos que fazem parte da compra." style="text-indent: 10px"><strong>Produtos</strong></td>
                                                                                                <td width="13%" align="center" title="Quantidade deste produto."><strong>Quantidade</strong>.</td>
                                                                                                <td width="8%" align="center" title="Preço Unitário."><strong>Preço</strong></td>
                                                                                                <td width="9%" align="right" title="Total deste Produto." style="padding-right: 5px"><strong>Total
                                                                                                        (R$)</strong></td>
                                                                                            </tr>
                                                                                            ' . $itens_pedido . '
                                                                                            <tr><td colspan="2" align="right" style="padding-top: 10px; border-bottom: 1px solid #DCDCDC; height: 35px; vertical-align: middle"><strong>Total dos produtos:</strong></td><td  colspan="2" style="padding-top: 10px; border-bottom: 1px solid #DCDCDC" align="right">R$ ' . $total_produtos . ' </td></tr>
                                                                                            <tr><td colspan="2" align="right" style="padding-top: 10px; border-bottom: 1px solid #DCDCDC;  height: 35px; vertical-align: middle"><strong>Valor do frete:</strong></td><td  colspan="2" style="padding-top: 10px; border-bottom: 1px solid #DCDCDC" align="right">R$ ' . $valor_frete . ' </td></tr>
                                                                                            <tr><td colspan="2" align="right" style="padding-top: 10px; height: 35px; vertical-align: middle"><strong><font color="#FF0000">Total do pedido:</font></strong></td><td  colspan="2" style="padding-top: 30px" align="right"><strong>R$ ' . $total_pedido . '</strong></td></tr>
                                                                                            <tr>
                                                                                                <td colspan="5">&nbsp;</td>
                                                                                            </tr>
                                                                                        </tbody></table></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                        <tbody><tr style="line-height: 45px; font-size: 17px" bgcolor="' . $this->coresEmail['background'] . '">
                                                                                                <td colspan="2" style="text-indent: 10px"><strong>Dados da entrega</strong></td>
                                                                                            </tr>
                                                                                            <td style="width: 50%; padding-top: 10px"><table border="0" cellpadding="0" cellspacing="0">
                                                                                                    <tbody>
                                                                                                        <td><strong>Nome da pessoa:</strong></td>
                                                                                                        <tr><td style="padding-bottom: 15px">' . $registro_pedido->PED_NOME_PESSOA_ENTREGA . '</td></tr>
                                                                                                        <td><strong>Endereço:</strong></td>
                                                                                                        <tr><td style="padding-bottom: 15px">' . $registro_pedido->PED_ENDERECO_ENTREGA . '</td></tr>
                                                                                                        <td><strong>Número:</strong></td>
                                                                                                        <tr><td style="padding-bottom: 15px">' . $registro_pedido->PED_NUMERO_ENTREGA . '</td></tr>
                                                                                                        <td><strong>Cidade:</strong></td>
                                                                                                        <tr><td>' . ucwords(strtolower($cidade_entrega)) . '</td></tr>
                                                                                                    </tbody>
                                                                                                </table></td>                                
                                                                                            <td style="padding-top: 10px"><table border="0" cellspacing="0" cellpadding="0">
                                                                                                    <td><strong>Estado:</strong></td>
                                                                                                    <tr><td style="padding-bottom: 15px">' . $estado_entrega . '</td></tr>
                                                                                                    <td><strong>Bairro:</strong></td>
                                                                                                    <tr><td style="padding-bottom: 15px">' . $registro_pedido->PED_BAIRRO_ENTREGA . '</td></tr>
                                                                                                    <td><strong>CEP:</strong></td>
                                                                                                    <tr><td style="padding-bottom: 15px">' . $registro_pedido->PED_CEP_ENTREGA . '</td></tr>
                                                                                                    <td><strong>Complemento:</strong></td>
                                                                                                    <tr><td>' . $registro_pedido->PED_COMPLEMENTO_ENTREGA . '</td></tr>
                                                                                                </table></td>

                                                                                        </tbody></table></td>
                                                                            </tr>
                                                                        </tbody></table></td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>

                                                            <tr>
                                                                <td style="padding-top: 20px"> <b>Acesse nosso site em: </b> <a href="' . $this->dominio . '" target="_blank">' . $this->dominio . '</a> </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </tbody></table></td>
                                            </tr>
                                        </tbody></table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="font-size:11px;padding-top:10px;padding-left:10px;padding-right:10px;padding-bottom:25px;" cellpadding="0" cellspacing="0" border="0" align="center" width="700">
                                    <tr>
                                        <td width="70%" valign="top"><em>Copyright © ' . date('Y') . ' ' . $this->empresa["nome"] . ', todos os direitos reservados.</em></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="20px"></td>
            </tr>
        </table>

        <!-- exemplos
                <a href="http://htmlemailboilerplate.com" target ="_blank" title="Styling Links" style="color: orange; text-decoration: none;">Coloring Links appropriately</a>
                <img class="image_fix" src="full path to image" alt="Your alt text" title="Your title text" width="x" height="x" />
                <span class="mobile_link">123-456-7890</span>
        -->

        <style type="text/css">
            @media only screen and (max-device-width: 480px) {
                /* SMARTPHONES */
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: black; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }

                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: orange !important; /* or whatever your want */
                    pointer-events: auto;
                    cursor: default;
                }
            }
            @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
                /* TABLETS E IPADS*/
                a[href^="tel"], a[href^="sms"] {
                    text-decoration: none;
                    color: blue; /* or whatever your want */
                    pointer-events: none;
                    cursor: default;
                }

                .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                    text-decoration: default;
                    color: orange !important;
                    pointer-events: auto;
                    cursor: default;
                }
            }
            @media only screen and (-webkit-min-device-pixel-ratio: 2) {
                /* IPHONE RETINA */
            }
            @media only screen and (-webkit-device-pixel-ratio:.75){
                /* ANDROIDS DE TELA RUIM */
            }
            @media only screen and (-webkit-device-pixel-ratio:1){
                /* ANDROIDS ~NORMAIS */
            }
            @media only screen and (-webkit-device-pixel-ratio:1.5){
                /* ANDROIDS DE ALTA DENSIDADE */
            }
        </style>';
        //echo $mensagem;

        $para = $cli->CLI_EMAIL;

        $assunto = "*** PEDIDO EFETUADO COM SUCESSO - " . $this->empresa["nome"] . " ***";

        //ENVIA EMAIL
        //ASSINATURA DO METODO: public function enviarEmail($from, $fromName, $destinatario, $assunto, $mensagem, $mensagemRetorno = false, $destinatarioRetorno = false)
        $this->enviarEmail($this->emailEmpresa, $this->empresa["nome"], $para, $assunto, $mensagem);

        //NOTIFICAÇÃO DE OK
        echo '<status>OK</status>';
    }

}

// End Ajax
