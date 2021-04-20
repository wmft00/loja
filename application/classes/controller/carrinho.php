<?php

defined('SYSPATH') or die('No direct script access.');
class Controller_Carrinho extends Controller_Index {

    public function before() {

      parent::before();
      $this->_name = $this->request->controller();
      $this->template->description .= " - Carrinho";
      $this->template->titulo .= " - Carrinho";
      if ($this->request->is_ajax()) {
        $this->auto_render = FALSE;
      }
    }

    public function action_index() {
      $view = View::Factory('carrinho');
      $id = $this->request->param('id');
      if ($id == 'add'){
        $mensagem = '<div class="alert alert-success fade in alert-dismissible mostra-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>=)</strong> Produto adicionado com sucesso!</p>
    </div>';
      } else if ($id == 'exc'){
        $mensagem = '<div class="alert alert-warning fade in alert-dismissible mostra-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>:(</strong> Produto removido do carrinho!
    </div>';
      }else if ($id == 'atu'){
        $mensagem = '<div class="alert alert-success fade in alert-dismissible mostra-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        <strong>=)</strong> Produto atualizado com sucesso!</p>
    </div>';
      }
      $view->mensagem = $mensagem;
      $view->carrinho = ORM::factory("carrinhos")
      ->where("CAR_SESSAO", "=", Session::instance()->get('carrinho'.$this->commerceSession))
      ->find_all();
      $this->template->conteudo = $view;
    }

    public function action_remover() {
        $produto = ORM::factory("produtos", $this->request->param('id'));

      if ($produto->loaded()) {
          $existe = ORM::factory("carrinhos", array(Session::instance()->get('carrinho'.$this->commerceSession), $this->request->param('id')));
          if ($existe->loaded()) {
              $existe->delete();//INSERE NO CARRINHO SE NAO EXISTIR
          }
      }
      $this->request->redirect('carrinho/index/exc');
    }

    public function action_inserir() {
        $produto = ORM::factory("produtos", $this->request->param('id'));
        $existe = ORM::factory("carrinhos", array(Session::instance()->get('carrinho'.$this->commerceSession), $this->request->param('id')));
          if (!$existe->loaded()) {
            $valor = $produto->PRO_PRECO;
            $valorTotal = $produto->PRO_PRECO;
            //INSERE NO CARRINHO SE NAO EXISTIR
            $carrinho = ORM::factory("carrinhos");
            $carrinho->CAR_SESSAO = Session::instance()->get('carrinho'.$this->commerceSession);
            $carrinho->PRO_ID = $this->request->param('id');
            $carrinho->CAR_QUANTIDADE = 1;
            $carrinho->CAR_VALOR_ITEM = $valor;
            $carrinho->CAR_TOTAL = $valorTotal;
            $carrinho->CAR_DATA = date('d/m/Y');
            $carrinho->save();
          } else {
            $qtda = $existe->CAR_QUANTIDADE+1;
            $valor = $produto->PRO_PRECO;
            $valorTotal = $produto->PRO_PRECO * $qtda;
            $existe->CAR_QUANTIDADE = $qtda;
            $existe->CAR_VALOR_ITEM = $valor;
            $existe->CAR_TOTAL = $valorTotal;
            $existe->CAR_DATA = date('d/m/Y');
            $existe->save();
          }
        $this->request->redirect('carrinho/index/add');
    }

    public function action_atualiza() {
      $produto = ORM::factory("produtos", $this->request->param('id'));
      $existe = ORM::factory("carrinhos", array(Session::instance()->get('carrinho'.$this->commerceSession), $this->request->param('id')));
      $qtda = $this->request->param('titulo');
      $valor = $produto->PRO_PRECO;
      $valorTotal = $produto->PRO_PRECO * $qtda;
      $existe->CAR_QUANTIDADE = $qtda;
      $existe->CAR_VALOR_ITEM = $valor;
      $existe->CAR_TOTAL = $valorTotal;
      $existe->CAR_DATA = date('d/m/Y');
      $existe->save();
      $this->request->redirect('carrinho/index/atu');
  }
} 

// End Template