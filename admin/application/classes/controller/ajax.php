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
    
    public function action_mudarestabelecimento(){
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
            
            $estabelecimento = $this->request->post("EST_ID");
            
            Session::instance()->set("id_estabelecimento".$this->nomeSessao, $estabelecimento);
            
            $estabelecimentos = ORM::factory("estabelecimentos")->where("EST_ID", "=", $estabelecimento)->find();
            
            Session::instance()->set("nome_estabelecimento".$this->nomeSessao, $estabelecimentos->EST_ID." - ".$estabelecimentos->EST_RAZAO_SOCIAL." - ".$estabelecimentos->EST_CNPJ);

            echo json_encode(array("ok" => true));
        }
    }
    
    //VERIFICA SE CPF, CNPJ CADASTRADOS
    public function action_verificacpf() {
        $qtd = 1;

        $post = $this->request->post();

        $qtd = ORM::factory($post["model"])->where($post["pre"]."_CPF", "=", $post["cpf"])->count_all();
        
        $opa = ($qtd == 0) ? true : false;
        echo json_encode(array("result" => $opa));
    }
    
    public function action_verificacnpj() {
        $qtd = 1;

        $post = $this->request->post();

        $qtd = ORM::factory($post["model"])->where($post["pre"]."_CNPJ", "=", $post["cnpj"])->count_all();
        
        $opa = ($qtd == 0) ? true : false;
        echo json_encode(array("result" => $opa));
    }
    
    //BUSCA AS CIDADES, DE ACORDO COM O ESTADO
    //BUSCA AS CIDADES, DE ACORDO COM O ESTADO
    public function action_buscamenu() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $post = $this->request->post();
            
            $digitado = $post["digitado"];
            
            $menu = "";

            //BUSCA AS CATEGORIAS DE MODULOS DOS MÓDULOS QUE O USUÁRIO TEM PERMISSÃO
            $categoriamodulo = ORM::factory("modulos")->with("categoriamodulo")->with("modulospermissoes")
                                    ->where("PER_ID", "=", $this->sessao->get("id_permissao" . $this->nomeSessao))
                                    ->group_by("CAM_ID")->order_by("CAM_ORDEM", "asc")->find_all();
            foreach ($categoriamodulo as $cam) {
                $modulos = ORM::factory("modulos")->with("modulospermissoes")
                                            ->where("PER_ID", "=", $this->sessao->get("id_permissao" . $this->nomeSessao))
                                            ->where("CAM_ID", "=", $cam->categoriamodulo->CAM_ID)
                                                ->where("MOD_NOME", "like", "%".$digitado."%")
                                            ->order_by("MOD_NOME", "asc")->find_all();
                if($modulos->count() > 0){
                    $menu .= '
                    <li class="header">'.$cam->categoriamodulo->CAM_NOME.'</li>';
                        foreach ($modulos as $mod) {
                            //VERIFICA SE É FAVORITO PARA COLOCAR A ESTRELINHA
                            //$favorito = ORM::factory("modulosfavoritos", array($mod->MOD_ID, $idvivente));
                            if(Request::current()->controller() == $mod->MOD_LINK){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            $menu .= '
                            <li class="'.$active.'">
                                <a href="'.url::base().$mod->MOD_LINK.'">';
                                    if($mod->MOD_ICONE == ""){ 
                                        $menu .= '<i class="fa fa-link"></i>';
                                    }else{
                                        $menu .= '<i class="'.$mod->MOD_ICONE.'"></i>';
                                    }
                                    $menu .= '
                                    <span>'.$mod->MOD_NOME.'</span>';
                                $menu .= '
                                </a>
                            </li>';

                        } 
                            
                }
            }
            
            echo json_encode(array("ok" => true, "menu" => $menu));
        }
    }

    //BUSCA AS CIDADES, DE ACORDO COM O ESTADO
    public function action_trocaestado() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $cidades = "";

            $citys = ORM::factory("cidades")->where("EST_ID", "=", $this->request->param("id"))->find_all();

            if ($citys) {
                //MONTA AS CIDADES
                $cidades .= '
                <div class="form-group">
                    <label for="CID_ID" class="col-sm-2 control-label">Cidade *</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" id="CID_ID" name="CID_ID" validar="texto">
                            <option value="">Selecione...</option>';
                            foreach ($citys as $cit) {
                                //SE HOUVER CIDADE COMO PARAMETRO, JA SELECIONA
                                if ($cit->CID_ID == $this->request->param("titulo"))
                                    $extra = "selected";
                                else
                                    $extra = "";

                                $cidades .= '
                                    <option value="' . $cit->CID_ID . '" ' . $extra . ' >
                                        ' . $cit->CID_NOME . '</option>';
                            }
                        $cidades .= '
                        </select>
                    </div>
            </div>';
            }

            echo json_encode(array("ok" => $cidades));
        }
    }

    //VERIFICA O CEP DIGITADO, BUSCANDO CIDADE E ENDEREÇO (CORREIOS)
    public function action_cep() {
        
        $cep = str_replace("-", "", $this->request->param("id"));
        $url = "http://api.postmon.com.br/v1/cep/";
        $url .= urlencode($cep);
        $resultado = file_get_contents($url);
        
        if (!$resultado) {
            $resultado = '{"ok":"false"}';
        }
        $resultado = json_decode($resultado,true);
        //print_r($resultado);
        $resultado_busca['cidade'] = trim($resultado["cidade"]);
        $resultado_busca["uf"] = trim($resultado["estado"]);
        if(isset($resultado["cep"])){
            $resultado_busca["cep"] = trim($resultado["cep"]);
        }
        if(isset($resultado["bairro"])){
            $resultado_busca["bairro"] = trim($resultado["bairro"]);
        }
        if(isset($resultado["logradouro"])){
            $resultado_busca["logradouro"] = trim($resultado["logradouro"]);
            if(strstr($resultado_busca['logradouro'],',')){
                $resultado_busca['logradouro'] = explode(',',$resultado_busca["logradouro"]);
                $resultado_busca["endereco"] = $dados["logradouro"][0];
                $resultado_busca["numero"] = $resultado_busca["logradouro"][1];
            }else if (strstr($resultado_busca['logradouro'],'-')){
                $resultado_busca['logradouro'] = explode('-',$resultado_busca["logradouro"]);
                $resultado_busca["endereco"] = $resultado_busca["logradouro"][0];
                $resultado_busca["numero"] = $resultado_busca["logradouro"][1];
            }else{
                $resultado_busca['endereco'] = $resultado_busca['logradouro'];
                $resultado_busca['numero'] = "";
            }
        }

        $cid = 0;
        $est = 0;

        $cidade = ORM::factory("cidades")->pesquisaCidadeCollate($resultado_busca["cidade"], $resultado_busca["uf"]);

        if ($cidade) {
            $cid = $cidade[0]["CID_ID"];
            $est = $cidade[0]["EST_ID"];
        }

        //print_r($resultado_busca);
        echo json_encode(array("ok" => $resultado_busca, "cid" => $cid, "est" => $est));
        
    }

    protected function simple_curl($url, $post = array(), $get = array()) {
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
        return curl_exec($ch);
    }
    
    //FUNCAO DE TOGGLE (SETAR MODULO FAVORITO)
    public function action_favoritar(){
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            //USUÁRIO E MÓDULO
            $usuario = $this->sessao->get('id_usuario' . $this->nomeSessao);
            $modulo = $this->request->param("id");
            
            //VERIFICA SE EXISTE
            $modulofavorito = ORM::factory("modulosfavoritos", array($modulo, $usuario));
            
            //SE EXISTE, RETIRA. SENÃO, INCLUI
            if($modulofavorito->loaded()){
                $modulofavorito->delete();
                $valor = "N";
            }else{
                $modulofavorito = ORM::factory("modulosfavoritos");
                $modulofavorito->MOD_ID = $modulo;
                $modulofavorito->USU_ID = $usuario;
                $modulofavorito->save();
                $valor = "S";
            }
            
            if($valor){
                echo json_encode(array("ok" => $valor));
            }else{
                echo json_encode(array("ok" => false));
            }
        }
    }
    
    public function action_novointervalo() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("intervalonumeracao");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->INN_ID."' selected>".$query->INN_INICIO." a ".$query->INN_FIM."</option>";
                
            echo json_encode(array("option" => $option, "INN_INICIO_INN_FIM" => $query->INN_INICIO." a ".$query->INN_FIM));
                        
        }
    }
    
    public function action_novogruposestoque() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("gruposestoque");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->GRE_ID."' selected>".$query->GRE_NOME."</option>";
                
            echo json_encode(array("option" => $option, "GRE_NOME" => $query->GRE_NOME));
                        
        }
    }
    
    public function action_novoncm() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("ncm");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->NCM_ID."' selected>".$query->NCM_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "NCM_DESCRICAO" => $query->NCM_DESCRICAO));
                        
        }
    }
    
    public function action_novocfop() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("cfop");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->CFO_ID."' selected>".$query->CFO_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "CFO_DESCRICAO" => $query->CFO_DESCRICAO));
                        
        }
    }
    
    public function action_novounidademedida() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("unidademedida");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->UNM_ID."' selected>".$query->UNM_UNIDADE_MEDIDA."</option>";
                
            echo json_encode(array("option" => $option, "UNM_UNIDADE_MEDIDA" => $query->UNM_UNIDADE_MEDIDA));
                        
        }
    }
    
    public function action_novocategoriaproduto() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("categoriaproduto");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->CAP_ID."' selected>".$query->CAP_NOME."</option>";
                
            echo json_encode(array("option" => $option, "CAP_NOME" => $query->CAP_NOME));
                        
        }
    }
    
    public function action_novoatividade() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("atividade");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->ATI_ID."' selected>".$query->ATI_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "ATI_DESCRICAO" => $query->ATI_DESCRICAO));
                        
        }
    }
    
    public function action_addprodutorecebimento() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $contador = $this->request->post("contador")+1;
            $fornecedor = $this->request->post("fornecedor");
            
            $html = "";

            $produtos = ORM::factory("produtos")->find_all();

            if ($produtos) {
                
                    $html .= '
                    <tr id="linha_'.$contador.'">
                        <td>
                            <select class="form-control select2" id="PRO_ID_'.$contador.'" name="PRO_ID[]" validar="int" style="width: 270px;" onchange="customedio('.$contador.');">
                                <option value="">Selecione...</option>';
                                foreach ($produtos as $prod){
                                    $reginfo = ORM::factory("reginfo")->where("PRO_ID", "=", $prod->PRO_ID)->where("CLF_ID", "=", $fornecedor)->find();
                                    $descreginfo = "";
                                    if($reginfo->REG_MATERIAL_FORNECEDOR){
                                        $descreginfo = " | Reginfo: ".$reginfo->REG_MATERIAL_FORNECEDOR;
                                    }
                                    $html .= '<option value="'.$prod->PRO_ID.'">'.$prod->PRO_CODIGO.' - '.$prod->PRO_NOME.$descreginfo.'</option>';
                                }
                            $html .= '
                            </select>
                        </td>
                        <td align="center" id="customedio_'.$contador.'">
                            <span id="loading-custo-'.$contador.'" style="display: none;"><i style="" class="fa fa-refresh fa-spin"></i></span>
                        </td>
                        <td>
                            <input type="text" validar="valor" class="valor'.$contador.'" id="REI_QUANTIDADE_'.$contador.'" name="REI_QUANTIDADE[]" style="text-align: center; width: 50px;" value="1,00" onkeyup="totalproduto('.$contador.')">
                        </td>
                        <td>
                            <input type="text" validar="valor" class="valor'.$contador.'" id="REI_VALOR_UNITARIO_'.$contador.'" name="REI_VALOR_UNITARIO[]" style="text-align: right; width: 80px;" value="" onkeyup="totalproduto('.$contador.')">
                        </td>
                        <td>
                            <input type="text" class="valortotal" id="REI_VALOR_TOTAL_'.$contador.'" readonly style="background: #EEEEEE; text-align: right; width: 80px;" value="">
                        </td>
                        <td>
                            <input type="text" class="data'.$contador.'" id="EST_DATA_VALIDADE_'.$contador.'" name="EST_DATA_VALIDADE[]" style="width: 80px;" value="">
                        </td>
                        <td>
                            <input type="text" id="EST_LOTE_'.$contador.'" name="EST_LOTE[]" style="width: 70px;" value="">
                        </td>
                        <td>
                            <input type="text" id="EST_REFERENCIA_'.$contador.'" name="EST_REFERENCIA[]" style="width: 70px;" value="">
                        </td>
                        <td>
                            <p class="btn-excluir" onclick="removelinha('.$contador.')"></p>
                        </td>
                    </tr>';
                
            }

            echo json_encode(array("html" => $html, "contador" => $contador));
        }
    }
    
    public function action_addprodutofatura() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $cfop = $this->request->post("cfop");
            $contador = $this->request->post("contador")+1;
            $emitirnfe = $this->request->post("emitirnfe");
            
            $html = "";

            $produtos = ORM::factory("produtos")->find_all();
            
            $cfopselecionado = ORM::factory("cfop");
            if($cfop != ""){
                $cfopselecionado = $cfopselecionado->where($cfopselecionado->primary_key(), "=", $this->sane($cfop))->find();
                
                $famcfop = explode(".", $cfopselecionado->CFO_CODIGO);
            
                $famcfop = $famcfop[0].".";

                $familiacfop = ORM::factory("cfop")->where("CFO_CODIGO", "like", $famcfop."%")->find_all();
                
            }else{
                $cfopselecionado = $cfopselecionado->find();
                
                $familiacfop = ORM::factory("cfop")->find_all();
            }

            if ($produtos) {
                
                    $html .= '
                    <tr id="linha_'.$contador.'">
                        <td>
                            <select class="form-control select2" id="PRO_ID_'.$contador.'" name="PRO_ID[]" validar="int" style="width: 270px;" onchange="infosproduto('.$contador.');">
                                <option value="">Selecione...</option>';
                                foreach ($produtos as $prod){
                                    $html .= '<option value="'.$prod->PRO_ID.'">'.$prod->PRO_CODIGO.' - '.$prod->PRO_NOME.'</option>';
                                }
                            $html .= '
                            </select>
                        </td>
                        <td>';
                            if($emitirnfe == "S"){
                                $html .= '
                                <select class="form-control select2" id="CFO_ID_'.$contador.'" name="item_CFO_ID[]" validar="int" style="width: 270px;">
                                    <option value="">Selecione...</option>';
                                    foreach ($familiacfop as $cfo){
                                        $selected = "";
                                        if($cfo->CFO_ID == $cfop){
                                            $selected = "selected";
                                        }
                                        $html .= '<option value="'.$cfo->CFO_ID.'" '.$selected.'>'.$cfo->CFO_CODIGO.' - '.$cfo->CFO_DESCRICAO.'</option>';
                                    }
                                $html .= '
                                </select>';
                            }
                        $html .= '
                        </td>
                        <td>
                            <input type="text" validar="valor" class="valor'.$contador.'" id="NFI_QUANTIDADE_'.$contador.'" name="NFI_QUANTIDADE[]" style="text-align: center; width: 50px;" value="1,00" onkeyup="totalproduto('.$contador.')">
                            <input type="hidden" id="estoquedisponivel_'.$contador.'" value="0">
                        </td>
                        <td>
                            <input type="text" validar="valor" class="valor'.$contador.'" id="NFI_VALOR_UNITARIO_'.$contador.'" name="NFI_VALOR_UNITARIO[]" style="text-align: right; width: 100px;" value="" onkeyup="totalproduto('.$contador.')">
                        </td>
                        <td>
                            <input type="text" class="valortotal" id="NFI_VALOR_TOTAL_'.$contador.'" readonly style="background: #EEEEEE; text-align: right; width: 100px;" value="">
                        </td>
                        <td>
                            <p class="btn-excluir" onclick="removelinha('.$contador.')"></p>
                        </td>
                    </tr>';
                
            }

            echo json_encode(array("html" => $html, "contador" => $contador));
        }
    }
    
    public function action_infosproduto() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $produto = $this->request->post("produto");
            
            $produtos = ORM::factory("produtos")
                            ->where("PRO_ID", "=", $produto)
                            ->find();
            
            $estoque = DB::select(array('SUM("e.EST_QUANTIDADE")', 'estoquedisponivel'))
                            ->from(array('ESTOQUE', 'e'))
                            ->join(array('DEPOSITOS', 'd'))->on("d.DEP_ID", "=", "e.DEP_ID")
                            ->where("e.PRO_ID", "=", $produto)
                            ->where("d.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                            ->group_by("e.PRO_ID")
                            ->execute();
            
            $disponivelvendedor = 0;
            if($this->request->post("vendedor")){
                $vendedor = ORM::factory("vendedor")
                            ->where("VEN_ID", "=", $this->request->post("vendedor"))
                            ->find();
                
                if($vendedor->VEN_CONTROLE_ESTOQUE == "S"){
                    $estoquevendedor = DB::select(array('SUM("ESV_QUANTIDADE")', 'estoquedisponivel'))
                            ->from('ESTOQUE_VENDEDOR')
                            ->where("VEN_ID", "=", $this->request->post("vendedor"))
                            ->where("PRO_ID", "=", $produto)
                            ->group_by("PRO_ID")
                            ->execute();
                    
                    $disponivelvendedor = $estoquevendedor[0]["estoquedisponivel"];
                }
            }
            
            $disponivel = $estoque[0]["estoquedisponivel"]+$disponivelvendedor;
            
            if($produtos->PRO_TIPO_PRODUTO == "S"){
                $disponivel = 999999.99;
            }
            
            echo json_encode(array("precovenda" => number_format($produtos->PRO_PRECO_VENDA,2,',','.'), "estoquedisponivel" => $disponivel));
                        
        }
    }
    
    public function action_customedio() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $produto = $this->request->post("produto");
            
            
            $recebimento = DB::select(array('SUM("rei.REI_VALOR_UNITARIO")', 'total'), array('COUNT("rei.PRO_ID")', 'entradas'))
                            ->from(array('RECEBIMENTO_ITEM', 'rei'))
                            ->join(array('RECEBIMENTOS', 'rec'))->on("rec.REC_ID", "=", "rei.REC_ID")
                            ->where("rei.PRO_ID", "=", $produto)
                            ->group_by("rei.PRO_ID")
                            ->execute();
            
            $customedio = 0;
            
            if($recebimento->count() > 0){
                $customedio = $recebimento[0]["total"]/$recebimento[0]["entradas"];
            }
            
            
            echo json_encode(array("customedio" => number_format($customedio,2,',','.')));
                        
        }
    }
    
    public function action_codigoproduto() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $ok = false;
            
            $produtos = ORM::factory("produtos")->where("PRO_CODIGO", "=", $this->request->post("PRO_CODIGO"))->find_all();
            
            if(count($produtos) > 0){
                $ok = true;
            }
            
            echo json_encode(array("ok" => $ok));
                        
        }
    }
    
    public function action_parcelamentofatura() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $vencimento = $this->request->post("primeirovencimento");
            $quantidade = $this->request->post("quantidade");
            $liquido = $this->request->post("liquido");
            
            $valorparcela = $liquido/$quantidade;
            
            $html = "";
            
            $ultimaparcela = $quantidade-1;
            $total = 0;
            
            for($i=0;$i<$quantidade;$i++){
                
                //joga o centavo que falta ultima parcela
                $falta = 0;
                $total += round($valorparcela,2);
                if($ultimaparcela == $i){ //é a ultima
                    $falta = $liquido - $total;
                    $falta = round($falta,2);
                }
                
                $html .= '
                <tr>
                    <td><input type="text" class="dataparcelas" id="DUP_DATA_VENCIMENTO_'.$i.'" name="DUP_DATA_VENCIMENTO[]" value="'.$vencimento.'"></td>
                    <td><input type="text" class="valorparcelas" id="DUP_VALOR_'.$i.'" name="DUP_VALOR[]" value="'.number_format($valorparcela+$falta,2,',','.').'" style="text-align: right;"></td>
                </tr>';
                
                $data = explode("/", $vencimento);
                
                $vencimento = date("d/m/Y", mktime(0, 0, 0, ($data[1] + 1), $data[0], $data[2]));
            }
            

            echo json_encode(array("html" => $html));
        }
    }
    
    public function action_volumesfatura() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $quantidade = $this->request->post("quantidade");
            
            $html = "";
            
            for($i=1;$i<=$quantidade;$i++){
                $html .= '
                <tr>
                    <td>Vol. '.$i.'</td>
                    <td><input type="text" validar="texto" id="VOL_ESPECIE_'.$i.'" name="VOL_ESPECIE[]" value="" placeholder="Espécie"></td>
                </tr>';
            }
            

            echo json_encode(array("html" => $html));
        }
    }
    
    public function action_novotipodespesa() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("tipodespesa");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->TID_ID."' selected>".$query->TID_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "TID_DESCRICAO" => $query->TID_DESCRICAO));
                        
        }
    }
    
    public function action_novocentrocusto() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("centrocusto");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->CEC_ID."' selected>".$query->CEC_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "CEC_DESCRICAO" => $query->CEC_DESCRICAO));
                        
        }
    }
    
    public function action_novotiporeceita() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("tiporeceita");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->TIR_ID."' selected>".$query->TIR_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "TIR_DESCRICAO" => $query->TIR_DESCRICAO));
                        
        }
    }
    
    public function action_novocentrolucro() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("centrolucro");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->CEL_ID."' selected>".$query->CEL_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "CEL_DESCRICAO" => $query->CEL_DESCRICAO));
                        
        }
    }
    
    public function action_novoconta() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("conta");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $model->save();
            } catch (ORM_Validation_Exception $e){
                $query = false;
            }
            
            $option = "<option value='".$query->CON_ID."' selected>".$query->CON_NUMERO." - ".$query->CON_DESCRICAO."</option>";
                
            echo json_encode(array("option" => $option, "CON_DESCRICAO" => $query->CON_NUMERO." - ".$query->CON_DESCRICAO));
                        
        }
    }
    
    public function action_novoparcelaspagar() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $post = $this->request->post();
            
            $libera = true;
            
            //SE FOR LANÇAMENTO DE CAIXA NÃO DEIXA MEXER SE JA FECHOU O CAIXA
            if($post["PAP_CAIXA_COFRE"] == "CA"){
                //SE JA TEM FECHAMENTO NO DIA NÃO PODE MAIS RECEBER PARCELA
                $fechamento = ORM::factory("fechamento")->where("EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))->where("FEC_DATA", "=", Controller_Index::ddmmaaaa_aaaammdd($post["PAP_DATA_PAGAMENTO"]))->find_all();
                if(count($fechamento) > 0){
                    $libera = false;
                }
            }
            
            if($libera){

                $id = $this->request->param("id");

                $model = ORM::factory("parcelaspagar", $id);

                //ATUALIZA
                foreach($this->request->post() as $campo => $value){
                    $model->$campo = $value;
                }

                //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
                try{
                    $query = $model->save();
                    $mensagem = "Pagamento efetuado com sucesso! ";
                    
                    $contaspagar = ORM::factory("contaspagar")->where("COP_ID", "=", $model->COP_ID)->find();
                    
                    //SE FOR CAIXA
                    if($post["PAP_CAIXA_COFRE"] == "CA"){
                        $caixa = ORM::factory("caixa");
                        $caixa->CAI_DESCRICAO = "Parcela Venc: ".$post["PAP_DATA_VENCIMENTO"]." - Doc: ".$contaspagar->COP_NUMERO_DOCUMENTO;
                        $caixa->CAI_DATA = date("d/m/Y");
                        $caixa->CAI_HORA = date("H:i");
                        $caixa->CAI_VALOR = $post["PAP_VALOR_PAGO"];
                        $caixa->CAI_OPERACAO = "D";
                        $caixa->PAR_ID = NULL;
                        $caixa->PAP_ID = $id;
                        $caixa->USU_ID = $this->sessao->get("id_usuario" . $this->nomeSessao);
                        $caixa->EST_ID = $this->sessao->get("id_estabelecimento" . $this->nomeSessao);

                        try {
                            $caixa->save();
                            $mensagem .= "\nValor pago foi lançado no caixa!";
                        } catch (ORM_Validation_Exception $ex) {

                            if(is_array($ex->errors("models"))){
                                $men = "";
                                foreach($ex->errors("models") as $m){
                                    $men .= "\n".$m;
                                }
                                $mensagem .= "\nCaixa: ".$men;
                            }
                        }
                        
                    //SE FOR COFRE
                    }else{
                        $cofre = ORM::factory("cofre");
                        $cofre->COF_DESCRICAO = "Parcela Venc: ".$post["PAP_DATA_VENCIMENTO"]." - Doc: ".$contaspagar->COP_NUMERO_DOCUMENTO;
                        $cofre->COF_DATA = date("d/m/Y");
                        $cofre->COF_HORA = date("H:i");
                        $cofre->COF_VALOR = $post["PAP_VALOR_PAGO"];
                        $cofre->COF_OPERACAO = "D";
                        $cofre->PAR_ID = NULL;
                        $cofre->PAP_ID = $id;
                        $cofre->USU_ID = $this->sessao->get("id_usuario" . $this->nomeSessao);
                        $cofre->EST_ID = $this->sessao->get("id_estabelecimento" . $this->nomeSessao);

                        try {
                            $cofre->save();
                            $mensagem .= "\nValor pago foi lançado no cofre!";
                        } catch (ORM_Validation_Exception $ex) {

                            if(is_array($ex->errors("models"))){
                                $men = "";
                                foreach($ex->errors("models") as $m){
                                    $men .= "\n".$m;
                                }
                                $mensagem .= "\nCofre: ".$men;
                            }
                        }
                    }

                } catch (ORM_Validation_Exception $e){
                    $query = false;
                    $mensagem = "Houve um problema. Pagamento não efetuado!";
                }
            }else{
                $query = false;
                $mensagem = "O caixa de hoje já está fechado. Não é possível realizar o pagamento!";
            }
                
            if($query){
                $ok = true;
            }else{
                $ok = false;
            }
            echo json_encode(array("ok" => $ok, "mensagem" => $mensagem));
                        
        }
    }
    
    public function action_novoparcelasreceber() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $post = $this->request->post();
            
            //SE JA TEM FECHAMENTO NO DIA NÃO PODE MAIS RECEBER PARCELA
            $fechamento = ORM::factory("fechamento")->where("FEC_DATA", "=", Controller_Index::ddmmaaaa_aaaammdd($post["PAR_DATA_RECEBIMENTO"]))->find_all();
            if(count($fechamento) == 0){
            
                $id = $this->request->param("id");

                $model = ORM::factory("parcelasreceber", $id);

                //ATUALIZA
                foreach($this->request->post() as $campo => $value){
                    $model->$campo = $value;
                }

                //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
                try{
                    $query = $model->save();
                    $mensagem = "Recemimento efetuado com sucesso! ";
                    
                    $contasreceber = ORM::factory("contasreceber")->where("COR_ID", "=", $model->COR_ID)->find();

                    $caixa = ORM::factory("caixa");
                    $caixa->CAI_DESCRICAO = "Parcela Venc: ".$post["PAR_DATA_VENCIMENTO"]." - Doc: ".$contasreceber->COR_NUMERO_DOCUMENTO;
                    $caixa->CAI_DATA = date("d/m/Y");
                    $caixa->CAI_HORA = date("H:i");
                    $caixa->CAI_VALOR = $post["PAR_VALOR_RECEBIDO"];
                    $caixa->CAI_OPERACAO = "C";
                    $caixa->PAR_ID = $id;
                    $caixa->PAP_ID = NULL;
                    $caixa->USU_ID = $this->sessao->get("id_usuario" . $this->nomeSessao);
                    $caixa->EST_ID = $this->sessao->get("id_estabelecimento" . $this->nomeSessao);

                    try {
                        $caixa->save();
                        $mensagem .= "\nValor recebido foi lançado no caixa!";
                    } catch (ORM_Validation_Exception $ex) {

                        if(is_array($ex->errors("models"))){
                            $men = "";
                            foreach($ex->errors("models") as $m){
                                $men .= "\n".$m;
                            }
                            $mensagem .= "\nCaixa: ".$men;
                        }
                    }
                } catch (ORM_Validation_Exception $e){
                    $query = false;
                    $mensagem = "Houve um problema. Recebimento não efetuado!";
                }
                
            }else{
                $query = false;
                $mensagem = "O caixa de hoje já está fechado. Não é possível realizar o recebimento!";
            }
                
            if($query){
                $ok = true;
            }else{
                $ok = false;
            }
            echo json_encode(array("ok" => $ok, "mensagem" => $mensagem));
                        
        }
    }
    
    public function action_parcelamentopagar() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $vencimento = $this->request->post("primeirovencimento");
            $quantidade = $this->request->post("quantidade");
            $valordocumento = $this->request->post("valordocumento");
            
            $valorparcela = $valordocumento/$quantidade;
            
            $html = "";
            
            $ultimaparcela = $quantidade-1;
            $total = 0;
            
            for($i=0;$i<$quantidade;$i++){
                
                //joga o centavo que falta ultima parcela
                $falta = 0;
                $total += round($valorparcela,2);
                if($ultimaparcela == $i){ //é a ultima
                    $falta = $valordocumento - $total;
                    $falta = round($falta,2);
                }
                
                $html .= '
                <tr>
                    <input type="hidden" id="PAP_ID_'.$i.'" name="PAP_ID[]" value="0">
                    <input type="hidden" id="PAP_PAGO_'.$i.'" name="PAP_PAGO[]" value="N">
                    <td><input type="text" class="dataparcelas" id="PAP_DATA_VENCIMENTO_'.$i.'" name="PAP_DATA_VENCIMENTO[]" value="'.$vencimento.'"></td>
                    <td><input type="text" class="valorparcelas" id="PAP_VALOR_PARCELA_'.$i.'" name="PAP_VALOR_PARCELA[]" value="'.number_format($valorparcela+$falta,2,',','.').'" style="text-align: right;"></td>
                </tr>';
                
                $data = explode("/", $vencimento);
                
                $vencimento = date("d/m/Y", mktime(0, 0, 0, ($data[1] + 1), $data[0], $data[2]));
            }
            

            echo json_encode(array("html" => $html));
        }
    }
    
    public function action_parcelamentoreceber() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $vencimento = $this->request->post("primeirovencimento");
            $quantidade = $this->request->post("quantidade");
            $valordocumento = $this->request->post("valordocumento");
            
            $valorparcela = $valordocumento/$quantidade;
            
            $html = "";
            
            $ultimaparcela = $quantidade-1;
            $total = 0;
            
            for($i=0;$i<$quantidade;$i++){
                
                //joga o centavo que falta ultima parcela
                $falta = 0;
                $total += round($valorparcela,2);
                if($ultimaparcela == $i){ //é a ultima
                    $falta = $valordocumento - $total;
                    $falta = round($falta,2);
                }
                
                $html .= '
                <tr>
                    <input type="hidden" id="PAR_ID_'.$i.'" name="PAR_ID[]" value="0">
                    <input type="hidden" id="PAR_RECEBIDO_'.$i.'" name="PAR_RECEBIDO[]" value="N">
                    <td><input type="text" class="dataparcelas" id="PAR_DATA_VENCIMENTO_'.$i.'" name="PAR_DATA_VENCIMENTO[]" value="'.$vencimento.'"></td>
                    <td><input type="text" class="valorparcelas" id="PAR_VALOR_PARCELA_'.$i.'" name="PAR_VALOR_PARCELA[]" value="'.number_format($valorparcela+$falta,2,',','.').'" style="text-align: right;"></td>
                </tr>';
                
                $data = explode("/", $vencimento);
                
                $vencimento = date("d/m/Y", mktime(0, 0, 0, ($data[1] + 1), $data[0], $data[2]));
            }
            

            echo json_encode(array("html" => $html));
        }
    }
    
    public function action_infosnota() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $ultimanota = ORM::factory("nfhead")->with("notafiscal")
//                    ->where("EST_ID", "=", $this->request->post("EST_ID"))
                    ->where("NFH_EMITIR", "=", "S")
                    ->order_by("NFH_ID", "DESC")
                    ->limit(1)
                    ->find();
            
            if($ultimanota->loaded() > 0){
                $naturezaoperacao = $ultimanota->NAO_ID;
                
                $cfop = $ultimanota->CFO_ID;
                
                $numero = $ultimanota->notafiscal->NOF_NUMERO_NOTA + 1;
                
                $serie = $ultimanota->notafiscal->NOF_SERIE;
                
                $modalidade = $ultimanota->MOF_ID;
                
                $transportadora = $ultimanota->TRA_ID;
            }else{
                $naturezaoperacao = "";
                
                $cfop = "";
                
                $numeronotaestabelecimento = ORM::factory("estabelecimentos");
                $numeronotaestabelecimento = $numeronotaestabelecimento->where($numeronotaestabelecimento->primary_key(), "=", $this->request->post("EST_ID"))->find();
                $numero = $numeronotaestabelecimento->EST_NUMERACAO_INICIAL_NF;
                
                $serie = "";
                
                $modalidade = "";
                
                $transportadora = "";
            }
            
            
                
            echo json_encode(array("naturezaoperacao" => $naturezaoperacao, "cfop" => $cfop, "numero" => $numero, "serie" => $serie, "modalidade" => $modalidade, "transportadora" => $transportadora));
                        
        }
    }
    
    public function action_estoquebaixo() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

           $estoquebaixo = DB::select(array('SUM("e.EST_QUANTIDADE")', "estoque"), array("p.PRO_ESTOQUE_MINIMO", "minimo"), "p.PRO_NOME", "p.PRO_ID", "p.PRO_CODIGO")
                                        ->from(array("PRODUTOS", "p"))
                                        ->join(array("ESTOQUE", "e"))->on("e.PRO_ID", "=", "p.PRO_ID")
                                        ->join(array("DEPOSITOS", "d"))->on("d.DEP_ID", "=", "e.DEP_ID")
                                        ->where("p.PRO_ESTOQUE_MINIMO", "!=", "0.00")
                                        ->where("d.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->group_by("p.PRO_ID")
                                        ->execute();
            
            $html = "";
            $htmlalerta = "";
            $flag = true;
            $cont = 0;
            foreach ($estoquebaixo as $est){
                
                //busca os produtos que estao com o vendedor
                $estoquevendedor = DB::select(array('SUM("e.ESV_QUANTIDADE")', "estoquevendedor"))
                                        ->from(array("ESTOQUE_VENDEDOR", "e"))
                                        ->join(array("VENDEDOR", "v"))->on("v.VEN_ID", "=", "e.VEN_ID")
                                        ->where("v.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->where("e.PRO_ID", "=", $est["PRO_ID"])
                                        ->group_by("e.PRO_ID")
                                        ->execute();
                
                $estoque = $est["estoque"] + $estoquevendedor[0]["estoquevendedor"];
                
                if($estoque < $est["minimo"]){
                    $html .= '
                    <tr>
                        <td>'.$est["PRO_CODIGO"].' - '.$est["PRO_NOME"].'</td>
                        <td align="center">'.number_format($est["minimo"],2,',','.').'</td>
                        <td align="center" style="color: red;">'.number_format($estoque,2,',','.').' <i class="fa fa-warning" style="color: #FFC90E !important;"></i></td>
                    </tr>';
                    
                    $htmlalerta .= '
                        <li>
                            <a href="#" title="Estoque deste produto está abaixo da quantidade mínima!">
                                <i class="fa fa-bell text-aqua"></i>
                                '.$est["PRO_CODIGO"].'-'.$est["PRO_NOME"].' <span style="color: red;">'.number_format($estoque,2,',','.').'</span>
                                <i class="fa fa-warning" style="color: #FFC90E !important;"></i>
                            </a>
                        </li>';
                    
                    $flag = false;
                    $cont++;
                }
            }
            
            if($flag){
                $html = "<tr><td align='center' colspan='3'><span style='color: green;' class='glyphicon glyphicon-ok-circle'></span> Nenhum produto com estoque baixo!</td></tr>";
            }

            echo json_encode(array("html" => $html, "htmlalerta" => $htmlalerta, "flag" => $flag, "cont" => $cont));
        }
    }
    
    public function action_estoquevendedorbaixo() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

           $estoquevendedorbaixo = DB::select(array('SUM("e.ESV_QUANTIDADE")', "estoque"), array("p.PRO_ESTOQUE_MINIMO_VENDEDOR", "minimo"), "v.VEN_NOME", "p.PRO_NOME", "p.PRO_CODIGO")
                                        ->from(array("PRODUTOS", "p"))
                                        ->join(array("ESTOQUE_VENDEDOR", "e"))->on("e.PRO_ID", "=", "p.PRO_ID")
                                        ->join(array("VENDEDOR", "v"))->on("v.VEN_ID", "=", "e.VEN_ID")
                                        ->where("v.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->where("p.PRO_ESTOQUE_MINIMO_VENDEDOR", "!=", "0.00")
                                        ->group_by("p.PRO_ID")
                                        ->execute();
            
            $html = "";
            $flag = true;
            foreach ($estoquevendedorbaixo as $est){
                if($est["estoque"] < $est["minimo"]){
                    $html .= '
                    <tr>
                        <td>'.$est["VEN_NOME"].'</td>
                        <td>'.$est["PRO_CODIGO"].' - '.$est["PRO_NOME"].'</td>
                        <td align="center">'.number_format($est["minimo"],2,',','.').'</td>
                        <td align="center" style="color: red;">'.number_format($est["estoque"],2,',','.').' <i class="fa fa-warning" style="color: #FFC90E !important;"></i></td>
                    </tr>';
                    $flag = false;
                }
            }
            
            if($flag){
                $html = "<tr><td align='center' colspan='4'><span style='color: green;' class='glyphicon glyphicon-ok-circle'></span> Nenhum produto com estoque baixo!</td></tr>";
            }

            echo json_encode(array("html" => $html, "flag" => $flag));
        }
    }

    public function action_produtosvencendo() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
            
            $datavencimento = date("Y-m-d", mktime(0, 0, 0, (date("m") + 1), date("d"), date("Y")));

            $produtosvencendo = DB::select(array('SUM("e.EST_QUANTIDADE")', "estoque"), "e.EST_DATA_VALIDADE", "p.PRO_NOME", "p.PRO_ID", "p.PRO_CODIGO")
                                        ->from(array("PRODUTOS", "p"))
                                        ->join(array("ESTOQUE", "e"))->on("e.PRO_ID", "=", "p.PRO_ID")
                                        ->join(array("DEPOSITOS", "d"))->on("d.DEP_ID", "=", "e.DEP_ID")
                                        ->where("e.EST_DATA_VALIDADE", "<=", $datavencimento)
                                        ->where("e.EST_DATA_VALIDADE", "!=", "0000-00-00")
                                        ->where("e.EST_QUANTIDADE", "!=", "0.00")
                                        ->where("d.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->group_by("e.EST_DATA_VALIDADE")
                                        ->group_by("p.PRO_ID")
                                        ->execute();
            
            $html = "";
            $htmlalerta = "";
            $flag = true;
            $cont = 0;
            foreach ($produtosvencendo as $pro){
                
                    $html .= '
                    <tr>
                        <td>'.$pro["PRO_CODIGO"].' - '.$pro["PRO_NOME"].'</td>
                        <td align="center">'.number_format($pro["estoque"],2,',','.').'</td>
                        <td align="center" style="color: red;">'.Controller_Index::aaaammdd_ddmmaaaa($pro["EST_DATA_VALIDADE"],2,',','.').' <i class="fa fa-warning" style="color: #FFC90E !important;"></i></td>
                    </tr>';
                    $flag = false;
                    $cont++;
                    
                    $htmlalerta .= '
                        <li>
                            <a href="#" title="Este produto está com prazo de validade acabando! Qtd: '.number_format($pro["estoque"],2,',','.').'">
                                <i class="fa fa-bell text-aqua"></i>
                                '.$pro["PRO_CODIGO"].' - '.$pro["PRO_NOME"].' <span style="color: red;">'.Controller_Index::aaaammdd_ddmmaaaa($pro["EST_DATA_VALIDADE"],2,',','.').'</span>
                                <i class="fa fa-warning" style="color: #FFC90E !important;"></i>
                            </a>
                        </li>';
                
            }
            
            if($flag){
                $html = "<tr><td align='center' colspan='3'><span style='color: green;' class='glyphicon glyphicon-ok-circle'></span> Nenhum produto vencendo nos próximos 30 dias!</td></tr>";
            }

            echo json_encode(array("html" => $html, "htmlalerta" => $htmlalerta, "flag" => $flag, "cont" => $cont));
        }
    }
    
    public function action_totalcaixa() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $data = Controller_Index::ddmmaaaa_aaaammdd($this->request->post("datafechamento"));
           
            $sobra = DB::select(array('SUM("c.CAI_VALOR")', "sobra"))
                                        ->from(array("CAIXA", "c"))
                                        ->where("c.CAI_DATA", "=", $data)
                                        ->where("c.CAI_OPERACAO", "=", "S")
                                        ->where("c.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->group_by("c.CAI_DATA")
                                        ->execute();
            
            $caixacredito = DB::select(array('SUM("c.CAI_VALOR")', "credito"))
                                        ->from(array("CAIXA", "c"))
                                        ->where("c.CAI_DATA", "=", $data)
                                        ->where("c.CAI_OPERACAO", "=", "C")
                                        ->where("c.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->group_by("c.CAI_DATA")
                                        ->execute();
            $caixadebito = DB::select(array('SUM("c.CAI_VALOR")', "debito"))
                                        ->from(array("CAIXA", "c"))
                                        ->where("c.CAI_DATA", "=", $data)
                                        ->where("c.CAI_OPERACAO", "=", "D")
                                        ->where("c.EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                                        ->group_by("c.CAI_DATA")
                                        ->execute();
            
            
            $valor = $caixacredito[0]["credito"]+$sobra[0]["sobra"]-$caixadebito[0]["debito"];

            echo json_encode(array("valor" => number_format($valor,2,',','.')));
        }
    }
    
    public function action_novofechamento() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("fechamento");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            $model->FEC_DATA_FECHAMENTO = date("d/m/Y");
            $model->FEC_HORA = date("H:i:s");
            $model->USU_ID = $this->sessao->get("id_usuario" . $this->nomeSessao);
            $model->EST_ID = $this->sessao->get("id_estabelecimento" . $this->nomeSessao);
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $mensagem = "Fechamento realizado com sucesso!";
                $query = $model->save();
                $ok = true;
                
                $modal = '
                    <div class="modal modal-success fade" id="modal-alertafechamento" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon fa fa-check"></i> Fechamento realizado com sucesso! </h4>
                                </div>
                                <div class="modal-body">
                                    Caixa fechado
                                    <br/>Valor: '.$this->request->post("FEC_VALOR").'
                                    <br/>Data/Hora: '.$this->request->post("FEC_DATA").' às '.date("H:i").'
                                        
                                    <div class="box-body table-responsive">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <span id="loading-alertafechamento" style="display: none;"><i style="" class="fa fa-refresh fa-spin"></i> Aguarde, atualizando...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>-->
                                    <button data-dismiss="modal" class="btn btn-outline pull-left" type="button">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                
                $cofre = ORM::factory("cofre");
                $cofre->COF_DESCRICAO = "Fechamento ".$this->request->post("FEC_DATA");
                $cofre->COF_DATA = $this->request->post("FEC_DATA");
                $cofre->COF_HORA = date("H:i:s");
                $cofre->COF_VALOR = $this->request->post("FEC_VALOR");
                $cofre->COF_OPERACAO = "C";
                $cofre->PAR_ID = NULL;
                $cofre->PAP_ID = NULL;
                $cofre->USU_ID = $this->sessao->get("id_usuario" . $this->nomeSessao);
                $cofre->EST_ID = $this->sessao->get("id_estabelecimento" . $this->nomeSessao);
                $cofre->ID_FECHAMENTO = $model->FEC_ID;
                 try{
                     $cofre->save();
                 } catch (ORM_Validation_Exception $e){
                     $ok = false;
                     //SE MENSAGEM FOR ARRAY, TRANSFORMA EM STRING
                    if(is_array($e->errors("models"))){
                        $men = "";
                        foreach($mensagem as $m){
                            $men .= $m."<br>";
                        }
                        $mensagem = $men;
                    }
                 }
                 
                
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $ok = false;

                //SE MENSAGEM FOR ARRAY, TRANSFORMA EM STRING
                if(is_array($e->errors("models"))){
                    $men = "";
                    foreach($mensagem as $m){
                        $men .= $m."<br>";
                    }
                    $mensagem = $men;
                }
                
                $modal = '
                        <div class="modal modal-danger fade" id="modal-alertafechamento" data-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-warning"></i> Houve um problema ao realizar o fechamento! </h4>
                                    </div>
                                    <div class="modal-body">
                                        '.$mensagem.'
                                    </div>
                                    <div class="modal-footer">
                                        <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>-->
                                        <button data-dismiss="modal" class="btn btn-outline pull-left" type="button">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                
            }
                
            echo json_encode(array("ok" => $ok, "modal" => $modal));
                        
        }
    }
    
    public function action_sobrafechamento() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $ok = true;
            $mensagem = "";
            
            //VERIFICA SE TEM CAIXA ABERTO
            $caixa = DB::select("*")
                            ->from('CAIXA')
                            ->where("CAI_DATA", "NOT IN", DB::expr("(SELECT FEC_DATA FROM FECHAMENTO)"))
                            ->where("EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))
                            ->group_by("CAI_DATA")
                            ->order_by("CAI_DATA", "ASC")
                            ->execute();
            if($caixa->count() > 0){
                $ok = false;
                $mensagem = '
                    <div class="modal modal-danger fade" id="modal-alertaaberto" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-warning"></i> Não é possível abrir o caixa! </h4>
                                </div>
                                <div class="modal-body">
                                    Realize os fechamentos em aberto para prosseguir!
                                </div>
                                <div class="modal-footer">
                                    <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>-->
                                    <button data-dismiss="modal" class="btn btn-outline pull-left" type="button">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
            }
            
            $fechamento = ORM::factory("fechamento")->where("EST_ID", "=", Session::instance()->get("id_estabelecimento".$this->nomeSessao))->order_by("FEC_DATA", "DESC")->limit(1)->find(); 

            echo json_encode(array("ok" => $ok, "sobra" => number_format($fechamento->FEC_SOBRA,2,',','.'), "mensagem" => $mensagem));
        }
    }
    
    public function action_novocaixa() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            
            $model = ORM::factory("caixa");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $model->$campo = $value;
            }
            
            $model->CAI_OPERACAO = "S";
            $model->PAR_ID = NULL;
            $model->PAP_ID = NULL;
            $model->USU_ID = $this->sessao->get("id_usuario" . $this->nomeSessao);
            $model->EST_ID = $this->sessao->get("id_estabelecimento" . $this->nomeSessao);
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $mensagem = "Caixa aberto com sucesso!";
                $query = $model->save();
                $ok = true;
                
                $modal = '
                    <div class="modal modal-success fade" id="modal-alertacaixa" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i class="icon fa fa-check"></i> '.$mensagem.' </h4>
                                </div>
                                <div class="modal-body">
                                    Caixa Aberto
                                    <br/>Valor: '.$this->request->post("CAI_VALOR").'
                                    <br/>Data/Hora: '.$this->request->post("CAI_DATA").' às '.$this->request->post("CAI_HORA").'
                                        
                                    <div class="box-body table-responsive">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <span id="loading-alerta" style="display: none;"><i style="" class="fa fa-refresh fa-spin"></i> Aguarde, atualizando...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>-->
                                    <!--<button data-dismiss="modal" class="btn btn-outline pull-left" type="button">Fechar</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $ok = false;

                //SE MENSAGEM FOR ARRAY, TRANSFORMA EM STRING
                if(is_array($e->errors("models"))){
                    $men = "";
                    foreach($mensagem as $m){
                        $men .= $m."<br>";
                    }
                    $mensagem = $men;
                }
                
                $modal = '
                        <div class="modal modal-danger fade" id="modal-alertacaixa" data-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-warning"></i> Houve um problema ao realizar abertura do caixa! </h4>
                                    </div>
                                    <div class="modal-body">
                                        '.$mensagem.'
                                    </div>

                                    <div class="modal-footer">
                                        <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>-->
                                        <button data-dismiss="modal" class="btn btn-outline pull-left" type="button">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                
            }
                
            echo json_encode(array("ok" => $ok, "modal" => $modal,));
                        
        }
    }
}

// End Ajax
