<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Atividade extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - Atividade";
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCIA A VIEW DE LISTAGEM POR DEFAULT
        $view = View::Factory("atividade/list");
        
        $ordem = "ATI_ID";
        $sentido = "desc";

        //BUSCA OS REGISTROS        
        $atividade = ORM::factory("atividade");
                
        //SETA AS COLUNAS QUE VAI BUSCAR
        $atividade->setColumns(array("ATI_ID"=>"ATI_ID", "ATI_CNAE"=>"ATI_CNAE", "ATI_DESCRICAO"=>"ATI_DESCRICAO"));
        
        //TESTA SE TEM PESQUISA
        if(isset($_GET["chave"])){
            $atividade = $atividade->where("ATI_CNAE", "like", "%".$this->sane($_GET["chave"])."%")->or_where("ATI_DESCRICAO", "like", "%".$this->sane($_GET["chave"])."%");
        }
        
        /* ORDENAÇÃO */
        if (isset($_GET["ordem"])) {
            if ($_GET["ordem"] != "") {
                $atividade->order_by($this->sane($_GET["ordem"]), $this->sane($_GET["sentido"]));
                $ordem = $this->sane($_GET["ordem"]);
                $sentido = $this->sane($_GET["sentido"]);
            }
        }
        
        //PAGINAÇÃO
        $paginas = $this->action_page($atividade, $this->qtdPagina);
        $view->atividade = $paginas["data"];
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
        $view = View::Factory("atividade/edit");
        
        $id = $this->request->param("id");
        
        //SE EXISTIR O ID, BUSCA O REGISTRO
        if($id){
            //BUSCA O REGISTRO E PREENCHE OS CAMPOS
            $atividade = ORM::factory("atividade");
            $atividade = $atividade->where($atividade->primary_key(), "=", $this->sane($id))->find();
            
            $arr = array(
                "ATI_ID" => $atividade->ATI_ID,
                "ATI_CNAE" => $atividade->ATI_CNAE,
                "ATI_DESCRICAO" => $atividade->ATI_DESCRICAO,
            );
            
            $view->atividade = $arr;
        }else{
            //SENAO, SETA COMO VAZIO
            $arr = array( 
                "ATI_ID" => "0",
                "ATI_CNAE" => "",
                "ATI_DESCRICAO" => "",
            );
            
            $view->atividade = $arr;
        }
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }
    
    //SALVA INFORMACOES
    public function action_save(){ //MENSAGEM DE OK, OU ERRO
        $mensagem = "Registro alterado com sucesso!";

        //SE O ID ESTIVER ZERADO, INSERT
        if($this->request->post("ATI_ID") == "0" ){ 
            
            $atividade = ORM::factory("atividade");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                $atividade->$campo = $value;
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $atividade->save();
                $mensagem = "Registro inserido com sucesso!";
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $mensagem = $e->errors("models");
            }
        }else{
            //SENAO, UPDATE
            $atividade = ORM::factory("atividade", $this->request->post("ATI_ID"));
            
            //SE CARREGOU O MÓDULO, FAZ O UPDATE. SENÃO, NÃO FAZ NADA
            if ($atividade->loaded()){
                //ALTERA
                foreach($this->request->post() as $campo => $value){
                    $atividade->$campo = $value;
                }
                
                //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
                try{
                    $query = $atividade->save();
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
        //VERIFICA SE EXISTEM CLIENTEFORNECEDOR NESSA ATIVIDADE. SE EXISTIR, NÃO DEIXA EXCLUIR
        $estabelecimentos = ORM::factory("estabelecimentos")->where("ATI_ID", "=", $this->request->param("id"))->count_all();
                        
        if ($estabelecimentos > 0){
            $this->action_index("<p class='res-alert warning'>Existem Estabelecimentos cadastrados nessa Atividade! Nenhuma alteração realizada!</p>", true);
        }else{
                        
        $atividade = ORM::factory("atividade", $this->request->param("id"));
            
        //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
        if ($atividade->loaded()){
            //DELETA
            $query = $atividade->delete();
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
                //VERIFICA SE EXISTEM CLIENTEFORNECEDOR NESSA ATIVIDADE. SE EXISTIR, NÃO DEIXA EXCLUIR
                $clientefornecedor = ORM::factory("clientefornecedor")->where("ATI_ID", "=", $this->request->param("id"))->count_all();
                        
                if ($clientefornecedor > 0){
                    $this->action_index("<p class='res-alert warning'>Existem Cliente Fornecedor cadastrados nessa Atividade! Nenhuma alteração realizada!</p>", true);
                    return true;
                }else{
                        
                $atividade = ORM::factory("atividade", $val);
            
                //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
                if ($atividade->loaded()){
                    //DELETA
                    $query = $atividade->delete();
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

// End Atividade
