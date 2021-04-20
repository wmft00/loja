<?php

defined('SYSPATH') or die('No direct script access.');
class Controller_Produtos extends Controller_Index {

    public function before() {

      parent::before();
      $this->_name = $this->request->controller();
      $this->template->description .= " - Produtos";
      $this->template->titulo .= " - Produtos";
      if ($this->request->is_ajax()) {
        $this->auto_render = FALSE;
      }
    }

    public function action_detalhes() {
      $view = View::Factory('produto');
      $id = $this->request->param('id');
      $titulo = $this->request->param('titulo');
      if($id){
          $view = View::Factory('produto');
          //PRODUTOS
          $view->produto = ORM::factory("produtos")
                  ->where("PRO_ID", "=", $id)
                  ->where('PRO_ATIVO','=','S')
                  ->find();

          $this->template->titulo .= " - ".urldecode($view->produto->PRO_NOME);

          $this->template->conteudo = $view;
      }else{
          $this->request->redirect("index");
      }
    }
} 

// End Template