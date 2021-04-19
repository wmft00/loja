<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Cupons extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - Cupons";
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCIA A VIEW DE LISTAGEM POR DEFAULT
        $view = View::Factory("cupons/list");
        
        $ordem = "CUP_ID";
        $sentido = "desc";

        //BUSCA OS REGISTROS        
        $cupons = ORM::factory("cupons")->with("marca")->with("categoria");
                
        //SETA AS COLUNAS QUE VAI BUSCAR
        $cupons->setColumns(array("CUP_ID"=>"CUP_ID", "CUP_CODIGO"=>"CUP_CODIGO", "CUP_TIPO"=>"CUP_TIPO"));
        
        //TESTA SE TEM PESQUISA
        if(isset($_GET["chave"])){
            $cupons = $cupons->where("CUP_CODIGO", "like", "%".$this->sane($_GET["chave"])."%")->or_where("CUP_TIPO", "like", "%".$this->sane($_GET["chave"])."%");
        }
        
        /* ORDENAÇÃO */
        if (isset($_GET["ordem"])) {
            if ($_GET["ordem"] != "") {
                $cupons->order_by($this->sane($_GET["ordem"]), $this->sane($_GET["sentido"]));
                $ordem = $this->sane($_GET["ordem"]);
                $sentido = $this->sane($_GET["sentido"]);
            }
        }
        
        //PAGINAÇÃO
        $paginas = $this->action_page($cupons, $this->qtdPagina);
        $view->cupons = $paginas["data"];
        $view->pagination = $paginas["pagination"];
        
        $view->ordem = $ordem;
        $view->sentido = $sentido;

        //PASSA A MENSAGEM
        $view->mensagem = $mensagem;
        $view->erro = $erro;
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }

    //FORMULARIO DE CADASTRO
    public function action_edit(){
        //INSTANCIA A VIEW DE EDICAO
        $view = View::Factory("cupons/edit");
        
        $id = $this->request->param("id");
        
        //BUSCA MARCA
        $view->marca = ORM::factory("marca")->find_all();
                            
        //BUSCA CATEGORIA
        $view->categoria = ORM::factory("categoria")->find_all();
                            
        //SE EXISTIR O ID, BUSCA O REGISTRO
        if($id){
            //BUSCA O REGISTRO E PREENCHE OS CAMPOS
            $cupons = ORM::factory("cupons");
            $cupons = $cupons->where($cupons->primary_key(), "=", $this->sane($id))->find();
            
            $arr = array(
                "CUP_ID" => $cupons->CUP_ID,
                "CUP_CODIGO" => $cupons->CUP_CODIGO,
                "CUP_TIPO" => $cupons->CUP_TIPO,
                "CUP_VALOR" => $cupons->CUP_VALOR,
                "MAR_ID" => $cupons->MAR_ID,
                "CAT_ID" => $cupons->CAT_ID,
            );
            
            $view->cupons = $arr;
        }else{
            //SENAO, SETA COMO VAZIO
            $arr = array( 
                "CUP_ID" => "0",
                "CUP_CODIGO" => "",
                "CUP_TIPO" => "P",
                "CUP_VALOR" => "0",
                "MAR_ID" => "",
                "CAT_ID" => "",
            );
            
            $view->cupons = $arr;
        }
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }
    
    //SALVA INFORMACOES
    public function action_save(){ //MENSAGEM DE OK, OU ERRO
        $mensagem = "Registro alterado com sucesso!";

        //SE O ID ESTIVER ZERADO, INSERT
        if($this->request->post("CUP_ID") == "0" ){ 
            
            $cupons = ORM::factory("cupons");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                if ($campo['MAR_ID'] == ''){
                    $campo->MAR_ID == NULL;
                } else if ($campo['CAT_ID'] == ''){
                    $campo->CAT_ID == NULL;
                } else {
                    $cupons->$campo = $value;
                }
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $cupons->save();
                $mensagem = "Registro inserido com sucesso!";
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $mensagem = $e->errors("models");
            }
        }else{
            //SENAO, UPDATE
            $cupons = ORM::factory("cupons", $this->request->post("CUP_ID"));
            
            //SE CARREGOU O MÓDULO, FAZ O UPDATE. SENÃO, NÃO FAZ NADA
            if ($cupons->loaded()){
                //ALTERA
                foreach($this->request->post() as $campo => $value){
                    if ($campo['MAR_ID'] == ''){
                        $campo->MAR_ID == NULL;
                    } else if ($campo['CAT_ID'] == ''){
                        $campo->CAT_ID == NULL;
                    } else {
                        $cupons->$campo = $value;
                    }
                }
                
                //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
                try{
                    $query = $cupons->save();
                } catch (ORM_Validation_Exception $e){
                    $query = false;
                    $mensagem = $e->errors("models");
                }
            } else{
                $query = false;
                $mensagem = "Houve um problema, nenhuma alteração realizada!";
            }
        }
        
        //SE MENSAGEM FOR ARRAY, TRANSFORMA EM STRING
        if(is_array($mensagem)){
            $men = "";
            foreach($mensagem as $m){
                $men .= $m."<br>";
            }
            $mensagem = $men;
        }
        
        //SE FUNCIONOU, VOLTA PRA LISTAGEM COM MENSAGEM DE OK
        if($query){
            $this->action_index("<p class='res-alert sucess'>".$mensagem."</p>", false);
        }else{
            //SENAO, VOLTA COM MENSAGEM DE ERRO
            $this->action_index("<p class='res-alert warning'>".$mensagem."</p>", true);
        }}
    
    //EXCLUI REGISTRO
    public function action_excluir(){
        $cupons = ORM::factory("cupons", $this->request->param("id"));
            
        //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
        if ($cupons->loaded()){
            //DELETA
            $query = $cupons->delete();
        }else{
            $query = false;
        }
        
        //SE FUNCIONOU, VOLTA PRA LISTAGEM COM MENSAGEM DE OK
        if($query){
            $this->action_index("<p class='res-alert trash'>Registro excluído com sucesso!</p>", false);
        }else{
            //SENAO, VOLTA COM MENSAGEM DE ERRO
            $this->action_index("<p class='res-alert warning'>Houve um problema!</p>", true);
        }
    }
    
    //EXCLUI TODOS REGISTROS MARCADOS
    public function action_excluirTodos() {$query = false;
        
        foreach ($this->request->post() as $value) {
            foreach($value as $val){
                $cupons = ORM::factory("cupons", $val);
            
                //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
                if ($cupons->loaded()){
                    //DELETA
                    $query = $cupons->delete();
                }else{
                    $query = false;
                }
            }
        }
        
        //SE FUNCIONOU, VOLTA PRA LISTAGEM COM MENSAGEM DE OK
        if ($query) {
            $this->action_index("<p class='res-alert trash'>Registros excluídos com sucesso!</p>", false);
        }
        else {
            //SENAO, VOLTA COM MENSAGEM DE ERRO
            $this->action_index("<p class='res-alert warning'>Houve um problema! Nenhum registro selecionado!</p>", true);
        }}
    
    //FUNCAO DE PESQUISA
    public function action_pesquisa(){
        $this->action_index("", false);
    }

}

// End Cupons
