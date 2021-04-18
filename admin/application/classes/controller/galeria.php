<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Galeria extends Controller_Index {

    protected $maxImagens = 30;

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();
        $this->template->titulo .= " - GALERIA";

        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index($mensagem = "", $erro = false) {
        //INSTANCIA A VIEW DE FOTOS POR DEFAULT
        $view = View::Factory('galeria/edit');

        //MONTA AS VARIAVEIS DE ACORDO COM O MODULO PASSADO
        switch ($this->request->param("id")) {
            case "noticias":
                $array_informacoes = array();
                $array_informacoes["diretorio"] = 'upload/fotos_noticias/';
                $qryTitulo = ORM::factory("noticias");
                $qryTitulo->setColumns(array("NOT_ID"=>"NOT_ID", "NOT_TITULO"=>"NOT_TITULO"));
                $qryTitulo->where("NOT_ID", "=", $this->request->param("titulo"))->find();
                $array_informacoes["modulo"] = 'noticias';
                $array_informacoes["titulo"] = 'Notícias - ' . $qryTitulo->NOT_TITULO;
                $array_informacoes["id_item"] = $qryTitulo->NOT_ID;
                break;
            case "produtos":
                $array_informacoes = array();
                $array_informacoes["diretorio"] = 'upload/fotos_produtos/';
                $qryTitulo = ORM::factory("produtos");
                $qryTitulo->setColumns(array("PRO_ID"=>"PRO_ID", "PRO_TITULO"=>"PRO_TITULO"));
                $qryTitulo->where("PRO_ID", "=", $this->request->param("titulo"))->find();
                $array_informacoes["modulo"] = 'produtos';
                $array_informacoes["titulo"] = 'Produtos - ' . $qryTitulo->PRO_TITULO;
                $array_informacoes["id_item"] = $qryTitulo->PRO_ID;
                break;
            default:
                $this->request->redirect($this->request->param("id"));
                break;
        }

        //BUSCA OS REGISTROS
        $view->fotos = ORM::factory("galeria")->where("GAL_IMAGEM", "like", 
                "%".$array_informacoes["diretorio"]."thumb_".$array_informacoes["id_item"]."_%")->find_all();

        $view->informacoes = $array_informacoes;

        //PASSA A MENSAGEM
        $view->mensagem = $mensagem;
        $view->erro = $erro;
        
        $view->cacheController = $this->cacheController;

        $this->template->bt_voltar = true;

        $this->template->conteudo = $view;
    }
    
    //SALVA INFORMACOES (MULTIPLOS ARQUIVOS)
    public function action_save() {
        $this->auto_render = FALSE;
        
        //PEGA OS CAMPOS
        foreach ($this->request->post() as $campo => $value) {
            $valores[$campo] = addslashes($value);
        }

        $sql = "";

        //BUSCA A PROXIMA IMAGEM A SER CADASTRADA, COM MÁXIMO DEFINIDO NA VARIAVEL GLOBAL.
        //INSERE A IMAGEM, SE EXISTIR
        
        if ($_FILES["imagem"]["name"] != "") {

            for ($i = 1; $i <= $this->maxImagens; $i++) {
                if (!glob($valores["diretorio"] . "thumb_" . $valores["id_item"] . "_" . $i . ".*")) {
                    //imagem tamanho normal
                    $ext = explode(".", $_FILES["imagem"]["name"]);
                    $imgName = $valores["id_item"] . "_" . $i . "." . $ext[count($ext) - 1];

                    $img = Image::factory($_FILES["imagem"]["tmp_name"]);

                    $img->save(DOCROOT . $valores["diretorio"] . $imgName);

                    //thumb
                    $imgName = "thumb_" . $valores["id_item"] . "_" . $i . "." . $ext[count($ext) - 1];
                    $img->resize(200)->save(DOCROOT . $valores["diretorio"] . $imgName);
                    break;
                }
            }
        }

        //CRIA NO BANCO
        $galeria = ORM::factory("galeria");
        $galeria->GAL_IMAGEM = $valores["diretorio"] . $imgName;
        $galeria->GAL_ORDEM = 0;
        $galeria->save();

        //REDIRECIONA PARA O INDEX DA GALERIA
        //$this->request->redirect("galeria/index/" . $valores["modulo"] . "/" . $valores["id_item"]);
    }

    //ALTERA LEGENDA E ORDEM DAS FOTOS
    public function action_update() {
        //PEGA OS CAMPOS
        $post = $this->request->post();

        if (array_key_exists('GAL_ID', $post)) {
            if (is_array($post['GAL_ID'])) {
                $max = count($post['GAL_ID']);
                for ($i = 0; $i < $max; $i++) {
                    $galeria = ORM::factory("galeria", $post["GAL_ID"][$i]);
                    $galeria->GAL_LEGENDA = $post["legenda"][$i];
                    $galeria->GAL_ORDEM = $post["ordem"][$i];
                    $galeria->save();
                }
            }
        }

        //REDIRECIONA PARA O INDEX DA GALERIA
        $this->request->redirect("galeria/index/" . $post["modulo"] . "/" . $post["id_item"]);
    }

    //EXCLUI REGISTRO
    public function action_excluir() {
        //BUSCA A IMAGEM CADASTRADA PELO ID
        $galeria = ORM::factory("galeria", $this->request->param("id"));

        if ($galeria->loaded()) {
            //EXCLUI IMAGENS
            $imgsT = glob($galeria->GAL_IMAGEM);
            $imgs = glob(str_replace("thumb_", "", $galeria->GAL_IMAGEM));

            foreach ($imgs as $im) {
                unlink($im);
            }

            foreach ($imgsT as $imT) {
                unlink($imT);
            }

            //DELETE
            $galeria->delete();

            //REDIRECIONA PARA O INDEX DA GALERIA
            $this->request->redirect("galeria/index/" . $this->request->param("modulo") . "/" . $this->request->param("item"));
        }else
            echo "Erro: Imagem nao encontrada";
    }

}

// End Galeria