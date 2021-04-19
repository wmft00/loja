<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Produtos extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - Produtos";
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {

        //INSTANCIA A VIEW DE LISTAGEM POR DEFAULT
        $view = View::Factory("produtos/list");
        
        $ordem = "PRO_ID";
        $sentido = "desc";

        //BUSCA OS REGISTROS        
        $produtos = ORM::factory("produtos")->with("marca")->with("categoria");
                
        //SETA AS COLUNAS QUE VAI BUSCAR
        $produtos->setColumns(array("PRO_ID"=>"PRO_ID", "PRO_NOME"=>"PRO_NOME", "PRO_PRECO"=>"PRO_PRECO"));
        
        //TESTA SE TEM PESQUISA
        if(isset($_GET["chave"])){
            $produtos = $produtos->where("PRO_NOME", "like", "%".$this->sane($_GET["chave"])."%")->or_where("MAR_0", "like", "%".$this->sane($_GET["chave"])."%")->or_where("CAT_0", "like", "%".$this->sane($_GET["chave"])."%")->or_where("PRO_PRECO", "like", "%".$this->sane(str_replace(",", ".", str_replace(".", "", $_GET["chave"])))."%");
        }
        
        /* ORDENAÇÃO */
        if (isset($_GET["ordem"])) {
            if ($_GET["ordem"] != "") {
                $produtos->order_by($this->sane($_GET["ordem"]), $this->sane($_GET["sentido"]));
                $ordem = $this->sane($_GET["ordem"]);
                $sentido = $this->sane($_GET["sentido"]);
            }
        }
        
        //PAGINAÇÃO
        $paginas = $this->action_page($produtos, $this->qtdPagina);
        $view->produtos = $paginas["data"];
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
        $view = View::Factory("produtos/edit");
        
        $id = $this->request->param("id");
        
        //BUSCA MARCA
        $view->marca = ORM::factory("marca")->find_all();
                            
        //BUSCA CATEGORIA
        $view->categoria = ORM::factory("categoria")->find_all();
                            
        //SE EXISTIR O ID, BUSCA O REGISTRO
        if($id){
            //BUSCA O REGISTRO E PREENCHE OS CAMPOS
            $produtos = ORM::factory("produtos");
            $produtos = $produtos->where($produtos->primary_key(), "=", $this->sane($id))->find();
            
            $arr = array(
                "PRO_ID" => $produtos->PRO_ID,
                "PRO_NOME" => $produtos->PRO_NOME,
                "MAR_ID" => $produtos->MAR_ID,
                "CAT_ID" => $produtos->CAT_ID,
                "PRO_PRECO" => $produtos->PRO_PRECO,
                "PRO_DESCRICAO" => $produtos->PRO_DESCRICAO,
                "PRO_ATIVO" => $produtos->PRO_ATIVO,
            );
            
            $view->produtos = $arr;
                    
            //BUSCA A IMAGEM, SE HOUVER
            $imagem = glob("upload/produtos/thumb_" . $produtos->PRO_ID . ".*");
            if ($imagem) {
                $view->imagem = "<div class='form-group'>
                        <label class='col-sm-2 control-label'>Excluir Imagem</label>
                        <input type='checkbox' id='excluirImagem' name='excluirImagem'>
                        <img src='" . url::base() . $imagem[0] . "'>
                    </div>";
            }
            else {
                $view->imagem = false;
            }
        }else{
            //SENAO, SETA COMO VAZIO
            $arr = array( 
                "PRO_ID" => "0",
                "PRO_NOME" => "",
                "MAR_ID" => "",
                "CAT_ID" => "",
                "PRO_PRECO" => "0",
                "PRO_DESCRICAO" => "",
                "PRO_ATIVO" => "S",
            );
            
            $view->produtos = $arr;
            $view->imagem = false;
        }
        
        $this->template->bt_voltar = true;
        
        $this->template->conteudo = $view;
    }
    
    //SALVA INFORMACOES
    public function action_save(){ //MENSAGEM DE OK, OU ERRO
        $mensagem = "Registro alterado com sucesso!";

        $excluiImagem = false;
                
        //SE O ID ESTIVER ZERADO, INSERT
        if($this->request->post("PRO_ID") == "0" ){ 
            
            $produtos = ORM::factory("produtos");
            
            //INSERE
            foreach($this->request->post() as $campo => $value){
                if ($campo == "imagem" or $campo == "imagemBlob" or $campo == "imagemx1" or $campo == "imagemy1" or $campo == "imagemw" or $campo == "imagemh") {
                    //NÃO SALVA NO BANCO, É O CAMPO COM A IMAGEM REDIMENSIONADA
                }else{ 
                    $produtos->$campo = $value;
                }
            }
            
            //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
            try{
                $query = $produtos->save();
                $mensagem = "Registro inserido com sucesso!";

                //INSERE A IMAGEM, SE EXISTIR
                if ($this->request->post("imagemBlob") != "") {
                    $imgBlob = $this->request->post("imagemBlob");

                    if(strpos($this->request->post("imagemBlob"), "image/jpg") or strpos($this->request->post("imagemBlob"), "image/jpeg")){
                        //JPEG
                        $imgBlob = str_replace("data:image/jpeg;base64,", "", $imgBlob);
                        $ext = "jpg";
                    }else if(strpos($this->request->post("imagemBlob"), "image/png")){
                        //PNG
                        $imgBlob = str_replace("data:image/png;base64,", "", $imgBlob);
                        $ext = "png";
                    }

                    $imgBlob = str_replace(" ", "+", $imgBlob);
                    $data = base64_decode($imgBlob);

                    //imagem tamanho normal
                    $imgName = "".$produtos->pk() . ".".$ext;
                    file_put_contents(DOCROOT."upload/produtos/".$imgName, $data);

                    //CROP
                    if($this->request->post("imagemw") != "" and $this->request->post("imagemw") > 0){
                        $img = Image::factory(DOCROOT."upload/produtos/".$imgName);
                        $img = $img->crop($this->request->post("imagemw"), $this->request->post("imagemh"), $this->request->post("imagemx1"), $this->request->post("imagemy1"))->save(DOCROOT."upload/produtos/".$imgName);
                    }

                    //thumb
                    $img = Image::factory(DOCROOT."upload/produtos/".$imgName);
                    $imgName = "thumb_" . $produtos->pk() . ".".$ext;
                    $img->resize(250)->save(DOCROOT."upload/produtos/".$imgName);
                }
            } catch (ORM_Validation_Exception $e){
                $query = false;
                $mensagem = $e->errors("models");
            }
        }else{
            //SENAO, UPDATE
            $produtos = ORM::factory("produtos", $this->request->post("PRO_ID"));
            
            //SE CARREGOU O MÓDULO, FAZ O UPDATE. SENÃO, NÃO FAZ NADA
            if ($produtos->loaded()){
                //ALTERA
                foreach($this->request->post() as $campo => $value){
                    if ($campo == "excluirImagem") {
                        $excluiImagem = str_replace("'", "", $value);
                    }else if ($campo == "imagem" or $campo == "imagemBlob" or $campo == "imagemx1" or $campo == "imagemy1" or $campo == "imagemw" or $campo == "imagemh") {
                        //NÃO SALVA NO BANCO, É O CAMPO COM A IMAGEM REDIMENSIONADA
                    }else{ 
                        $produtos->$campo = $value;
                    }
                }
                
                //TENTA SALVAR. SE NÃO PASSAR NA VALIDAÇÃO, VAI PRO CATCH
                try{
                    $query = $produtos->save();
                            
                    //SE EXCLUIR IMAGEM ESTIVER MARCADO, EXCLUI A IMAGEM
                    if($excluiImagem == "on" or $this->request->post("imagemBlob") != ""){
                        $imgsT = glob("upload/produtos/thumb_" . $produtos->pk() . ".*");
                        $imgs = glob("upload/produtos/" . $produtos->pk() . ".*");

                        if($imgs){
                            foreach($imgs as $im){
                                unlink($im);
                            }
                        }

                        if($imgsT){
                            foreach($imgsT as $imT){
                                unlink($imT);
                            }
                        }
                    }

                    //INSERE A IMAGEM, SE EXISTIR
                    if ($this->request->post("imagemBlob") != "") {
                        $imgBlob = $this->request->post("imagemBlob");

                        if(strpos($this->request->post("imagemBlob"), "image/jpg") or strpos($this->request->post("imagemBlob"), "image/jpeg")){
                            //JPEG
                            $imgBlob = str_replace("data:image/jpeg;base64,", "", $imgBlob);
                            $ext = "jpg";
                        }else if(strpos($this->request->post("imagemBlob"), "image/png")){
                            //PNG
                            $imgBlob = str_replace("data:image/png;base64,", "", $imgBlob);
                            $ext = "png";
                        }

                        $imgBlob = str_replace(" ", "+", $imgBlob);
                        $data = base64_decode($imgBlob);

                        //imagem tamanho normal
                        $imgName = "".$produtos->pk() . ".".$ext;
                        file_put_contents(DOCROOT."upload/produtos/".$imgName, $data);

                        //CROP
                        if($this->request->post("imagemw") != "" and $this->request->post("imagemw") > 0){
                            $img = Image::factory(DOCROOT."upload/produtos/".$imgName);
                            $img = $img->crop($this->request->post("imagemw"), $this->request->post("imagemh"), $this->request->post("imagemx1"), $this->request->post("imagemy1"))->save(DOCROOT."upload/produtos/".$imgName);
                        }

                        //thumb
                        $img = Image::factory(DOCROOT."upload/produtos/".$imgName);
                        $imgName = "thumb_" . $produtos->pk() . ".".$ext;
                        $img->resize(250)->save(DOCROOT."upload/produtos/".$imgName);
                    }
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
        if($query or $this->request->post("imagemBlob") != "" or $excluiImagem){
            $this->action_index("<p class='res-alert sucess'>".$mensagem."</p>", false);
        }else{
            //SENAO, VOLTA COM MENSAGEM DE ERRO
            $this->action_index("<p class='res-alert warning'>".$mensagem."</p>", true);
        }}
    
    //EXCLUI REGISTRO
    public function action_excluir(){
        //EXCLUI IMAGEM
        $imgsT = glob("upload/produtos/thumb_" . $this->request->param("id") . ".*");
        $imgs = glob("upload/produtos/" . $this->request->param("id") . ".*");

        if($imgs){
            foreach($imgs as $im){
                unlink($im);
            }
        }

        if($imgsT){
            foreach($imgsT as $imT){
                unlink($imT);
            }
        }
        $produtos = ORM::factory("produtos", $this->request->param("id"));
            
        //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
        if ($produtos->loaded()){
            //DELETA
            $query = $produtos->delete();
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
                //EXCLUI IMAGEM
                $imgsT = glob("upload/produtos/thumb_" . $val . ".*");
                $imgs = glob("upload/produtos/" . $val . ".*");

                if($imgs){
                    foreach($imgs as $im){
                        unlink($im);
                    }
                }

                if($imgsT){
                    foreach($imgsT as $imT){
                        unlink($imT);
                    }
                }
                $produtos = ORM::factory("produtos", $val);
            
                //SE CARREGOU O MÓDULO, DELETA. SENÃO, NÃO FAZ NADA
                if ($produtos->loaded()){
                    //DELETA
                    $query = $produtos->delete();
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

// End Produtos
