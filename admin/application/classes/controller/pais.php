<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Pais extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - País";
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCIA A VIEW DE LISTAGEM POR DEFAULT
        $view = View::Factory("pais/list");
        
        $ordem = "PAI_ID";
        $sentido = "desc";

        //BUSCA OS REGISTROS        
        $pais = ORM::factory("pais");
                
        //SETA AS COLUNAS QUE VAI BUSCAR
        $pais->setColumns(array("PAI_ID"=>"PAI_ID", "PAI_NOME"=>"PAI_NOME", "PAI_SIGLA"=>"PAI_SIGLA"));
        
        //TESTA SE TEM PESQUISA
        if(isset($_GET["chave"])){
            $pais = $pais->where("PAI_NOME", "like", "%".$this->sane($_GET["chave"])."%")->or_where("PAI_SIGLA", "like", "%".$this->sane($_GET["chave"])."%");
        }
        
        /* ORDENAÇÃO */
        if (isset($_GET["ordem"])) {
            if ($_GET["ordem"] != "") {
                $pais->order_by($this->sane($_GET["ordem"]), $this->sane($_GET["sentido"]));
                $ordem = $this->sane($_GET["ordem"]);
                $sentido = $this->sane($_GET["sentido"]);
            }
        }
        
        //PAGINAÇÃO
        $paginas = $this->action_page($pais, $this->qtdPagina);
        $view->pais = $paginas["data"];
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
        $view = View::Factory("pais/edit");
        
        $id = $this->request->param("id");
        
        //SE EXISTIR O ID, BUSCA O REGISTRO
        if($id){
            //BUSCA O REGISTRO E PREENCHE OS CAMPOS
            $pais = ORM::factory("pais");
            $pais = $pais->where($pais->primary_key(), "=", $this->sane($id))->find();
            
            $arr = array(
                "PAI_ID" => $pais->PAI_ID,
                "PAI_NOME" => $pais->PAI_NOME,
                "PAI_SIGLA" => $pais->PAI_SIGLA,
            );
            
            $view->pais = $arr;
        }else{
            //SENAO, SETA COMO VAZIO
            $arr = array( 
                "PAI_ID" => "0",
                "PAI_NOME" => "",
                "PAI_SIGLA" => "",
            );
            
            $view->pais = $arr;
        }
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }
    
    //SALVA INFORMACOES
    public function action_save(){ //MENSAGEM DE OK, OU ERRO
        $mensagem = "Registro alterado com sucesso!";

        //SE O ID ESTIVER ZERADO, INSERT
        if($this->request->post("PAI_ID") == "0" ){ 
            
            $pais = ORM::factory("pais");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $pais->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $pais->save();
                $mensagem = "Registro inserido com sucesso!";
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $mensagem = $e->errors("models");
            }
        }else{
            //SENAO, UPDATE
            $pais = ORM::factory("pais", $this->request->post("PAI_ID"));
            
            //SE CARREGOU O MÓDULO, FAZ O UPDATE. SENÃO, NÃO FAZ NADA
            if ($pais->loaded()){
                //ALTERA
                foreach($this->request->post() as $campo => $value){
                    $pais->$campo = $value;
                }
                
                //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
                try{
                    $query = $pais->save();
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
        //VERIFICA SE EXISTEM ESTADOS NESSA PAIS. SE EXISTIR, NÃO DEIXA EXCLUIR
        $estados = ORM::factory("estados")->where("PAI_ID", "=", $this->request->param("id"))->count_all();
                        
        if ($estados > 0){
            $this->action_index("<p class='res-alert warning'>Existem Estados cadastrados nessa País! Nenhuma alteração realizada!</p>", true);
        }else{
                        
        $pais = ORM::factory("pais", $this->request->param("id"));
            
        //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
        if ($pais->loaded()){
            //DELETA
            $query = $pais->delete();
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
    }
    
    //EXCLUI TODOS REGISTROS MARCADOS
    public function action_excluirTodos() {$query = false;
        
        foreach ($this->request->post() as $value) {
            foreach($value as $val){
                //VERIFICA SE EXISTEM ESTADOS NESSA PAIS. SE EXISTIR, NÃO DEIXA EXCLUIR
                $estados = ORM::factory("estados")->where("PAI_ID", "=", $this->request->param("id"))->count_all();
                        
                if ($estados > 0){
                    $this->action_index("<p class='res-alert warning'>Existem Estados cadastrados nessa País! Nenhuma alteração realizada!</p>", true);
                    return true;
                }else{
                        
                $pais = ORM::factory("pais", $val);
            
                //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
                if ($pais->loaded()){
                    //DELETA
                    $query = $pais->delete();
                }else{
                    $query = false;
                }
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

// End País
