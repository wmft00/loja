<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Imprimir extends Controller_Template {

    public $template = 'imprimir';
    public $gravar_logs = TRUE;
    public $empresa = "OWS - Área Restrita";
    public $dominio = "http://www1.ows.com.br/restrito2014/";
    //NOME DA SESSÃO, PARA NÃO DAR BAGUNÇA COM OUTRA RESTRITAS E AFINS ABERTOS NO NAVEGADOR
    public $nomeSessao = "dmemoveis";
    //QUANTIDADE DE ITENS POR PAGINA NA LISTAGEM
    public $qtdPagina;

    public function before() {
        parent::before();
        
        //TESTA SE ESTA LOGADO
        if (!Session::instance()->get("id_usuario".$this->nomeSessao) or !Session::instance()->get("id_permissao".$this->nomeSessao)) {
            $this->request->redirect('login');
        }
        
        $this->template->titulo = $this->empresa;
        
        $id = $this->request->param("id");
        
        //BUSCA OS STATUS
        $this->template->status = ORM::factory("pedidostatus")->find_all();

        //BUSCA OS PRODUTOS DO PEDIDO
        $this->template->produtos = ORM::factory("itenspedido")->with("produtos")->where("PED_ID", "=", $id)->find_all();

        //SE EXISTIR O ID, BUSCA O REGISTRO
        if ($id) {
            //BUSCA O REGISTRO E PREENCHE OS CAMPOS
            $pedido = ORM::factory('pedidos')->with("formapagamento")->with("clientes")->with("cidades");
            $pedido = $pedido->where($pedido->primary_key(), "=", Controller_Index::sane($id))->find();

            $arr = array(
                "PED_ID" => $pedido->PED_ID,
                "PED_DATA" => Controller_Index::aaaammdd_ddmmaaaa($pedido->PED_DATA),
                "PED_DATA_ENVIO" => Controller_Index::aaaammdd_ddmmaaaa($pedido->PED_DATA_ENVIO),
                "PED_HORA" => $pedido->PED_HORA,
                //"PED_IP_CLIENTE" => $pedido->PED_IP_CLIENTE,
                "PED_JURO" => str_replace(".", ",", $pedido->PED_JURO),
                "PED_VALOR_FRETE" => str_replace(".", ",", $pedido->PED_VALOR_FRETE),
                "PED_VALOR_PARCELA" => str_replace(".", ",", $pedido->PED_VALOR_PARCELA),
                "PED_TOTAL_PRODUTOS" => str_replace(".", ",", $pedido->PED_TOTAL_PRODUTOS),
                "PED_TOTAL_PEDIDO" => str_replace(".", ",", $pedido->PED_TOTAL_PEDIDO),
                "PED_OBS" => $pedido->PED_OBS,
                "PED_ENDERECO_ENTREGA" => $pedido->PED_ENDERECO_ENTREGA,
                "PED_NUMERO_ENTREGA" => $pedido->PED_NUMERO_ENTREGA,
                "PED_COMPLEMENTO_ENTREGA" => $pedido->PED_COMPLEMENTO_ENTREGA,
                "PED_BAIRRO_ENTREGA" => $pedido->PED_BAIRRO_ENTREGA,
                "PED_CEP_ENTREGA" => $pedido->PED_CEP_ENTREGA,
                "PED_REFERENCIA_ENTREGA" => $pedido->PED_REFERENCIA_ENTREGA,
                "PED_NOME_PESSOA_ENTREGA" => $pedido->PED_NOME_PESSOA_ENTREGA,
                "PED_PARCELAS" => $pedido->PED_PARCELAS,
                "PED_RASTREAMENTO" => $pedido->PED_RASTREAMENTO,
                "CLI_EMAIL" => $pedido->clientes->CLI_EMAIL,
                "CLI_TELEFONE" => $pedido->clientes->CLI_TELEFONE,
                "CLI_ENDERECO" => $pedido->clientes->CLI_ENDERECO . ", " . $pedido->clientes->CLI_NUMERO . ", " . $pedido->clientes->CLI_COMPLEMENTO,
                "CLI_BAIRRO" => $pedido->clientes->CLI_BAIRRO,
                "CLI_CEP" => $pedido->clientes->CLI_CEP,
                "PES_ID" => $pedido->pedidostatus->PES_ID,
                "CID_NOME" => $pedido->cidades->CID_NOME,
                "EST_SIGLA" => $pedido->cidades->estados->EST_SIGLA,
                "FOP_ID" => $pedido->formapagamento->FOP_ID,
                "COP_ID" => $pedido->condicaopagamento->COP_ID,
                "FOP_NOME" => $pedido->formapagamento->FOP_NOME,
                "COP_NOME" => $pedido->condicaopagamento->COP_NOME,
            );

            if ($pedido->clientes->CLI_PESSOA == "F") {
                $arr["CLI_NOME"] = $pedido->clientes->clientespf->CLI_NOME . " " . $pedido->clientes->clientespf->CLI_SOBRENOME;
                $arr["TIPO_PESSOA"] = $pedido->clientes->CLI_PESSOA;
                $arr["CLI_CPF"] = $pedido->clientes->clientespf->CLI_CPF;
                $arr["CLI_RG"] = $pedido->clientes->clientespf->CLI_RG;
                $arr["CLI_DATA_NASCIMENTO"] = Controller_Index::aaaammdd_ddmmaaaa($pedido->clientes->clientespf->CLI_DATA_NASCIMENTO);
                $arr["CLI_CELULAR"] = $pedido->clientes->clientespf->CLI_CELULAR;
                if ($pedido->clientes->clientespf->CLI_SEXO == "M")
                    $arr["CLI_SEXO"] = "Masculino";
                else
                    $arr["CLI_SEXO"] = "Feminino";
            }else {
                $arr["CLI_NOME"] = $pedido->clientes->clientespj->CLI_RAZAO_SOCIAL;
                $arr["TIPO_PESSOA"] = $pedido->clientes->CLI_PESSOA;
                $arr["CLI_CNPJ"] = $pedido->clientes->clientespj->CLI_CNPJ;
                $arr["CLI_IE"] = $pedido->clientes->clientespj->CLI_IE;
                $arr["CLI_CONTATO"] = $pedido->clientes->clientespj->CLI_CONTATO;
            }

            $this->template->pedido = $arr;
        }
        
    }
    
    public function action_index() {}
}

// End Imprimir
