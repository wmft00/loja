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

    public function action_cupons() {
        $cupom = $this->request->post('inpt_cupom');
        $busca = ORM::factory('cupons')->where('CUP_CODIGO','=',strtoupper($cupom))->find();
        if ($busca->CUP_ID != ''){
            $valor = $busca->CUP_VALOR;
            $tipo = $busca->CUP_TIPO;
            $categoria = 0;
            $marca = 0;
            if ($tipo == 'P'){
                $txtTipo = 'Utilize este cupom para ganhar '.$valor.'% de desconto em produtos ';
            } else {
                $txtTipo = 'Utilize este cupom para ganhar R$ '.number_format($valor,2,',','.').' de desconto em produtos ';
            }
            $txtMsg = '<strong>=)</strong> Cupom encontrado!';
            if ($busca->MAR_ID != NULL and $busca->MAR_ID > 0){
                $buscaMarca = ORM::factory('marca')->where('MAR_ID','=',$busca->MAR_ID)->find();
                $marca = $busca->MAR_ID;
                $txtMsg .= '<p>'.$txtTipo.' marca '.$buscaMarca->MAR_NOME.'.</p>';
            }
            if ($busca->CAT_ID != NULL and $busca->CAT_ID > 0){
                $buscaCategoria = ORM::factory('categoria')->where('CAT_ID','=',$busca->CAT_ID)->find();
                $categoria = $busca->CAT_ID;
                $txtMsg .= '<p>'.$txtTipo.' categoria '.$buscaCategoria->CAT_NOME.'.</p>';
            }
            if ($categoria == 0 and $marca == 0){
                $txtMsg .= '<p>'.$txtTipo.' todos os produtos do site.</p>';
            }
            $msg = '<div class="alert alert-success fade in alert-dismissible mostra-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                '.$txtMsg.'
            </div>';
            
            echo json_encode(array('ok' => false, 'msg' => $msg, 'marca' => $marca, 'categoria' => $categoria, 'tipo' => $tipo, 'valor' => $valor));
        } else {
            echo json_encode(array('ok' => false, 'msg' => '<div class="alert alert-warning fade in alert-dismissible mostra-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>:(</strong> Cupom de desconto não encontrado!
        </div>'));
        }
    }
    public function action_carrinho() {
        $produto = ORM::factory("produtos", $this->request->post('id'));
        if ($produto->loaded()) {
            //SE O PREÇO OFERTA FOR MAIOR QUE ZERO, USA ELE. SENÃO, USA O PREÇO NORMAL
            $valor = $produto->PRO_PRECO;
            $valorTotal = ($valor * $this->request->post("qtda"));

            $existe = ORM::factory("carrinhos", array(Session::instance()->get('carrinho' . $this->commerceSession), $this->request->post('id')));
            //SE NÃO EXISTE AINDA, INSERE
            if (!$existe->loaded()) {
                //INSERE NO CARRINHO SE NAO EXISTIR
                $carrinho = ORM::factory("carrinhos");
                $carrinho->CAR_SESSAO = Session::instance()->get('carrinho' . $this->commerceSession);
                $carrinho->PRO_ID = $this->request->post('id');
                $carrinho->CAR_QUANTIDADE = $this->request->post("qtda");
                $carrinho->CAR_VALOR_ITEM = $valor;
                $carrinho->CAR_TOTAL = $valorTotal;
                $carrinho->CAR_DATA = date('d/m/Y');
                $carrinho->save();

                $quantidade = ORM::factory("carrinhos")
                ->selectSUMqnt(Session::instance()->get('carrinho'.$this->commerceSession));
                $qtda = $quantidade[0]["qnt"];

                echo json_encode(array('ok' => true, 'qtda' => $qtda, 'msg' => '<div class="alert alert-success fade in alert-dismissible mostra-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                Produto adicionado ao carrinho!<br><a href="'.url::base().'carrinho">Acesse aqui seu carrinho</a>
                </div>'));
            } else {
                $valorTotal = ($valor * ($this->request->post("qtda")+$existe->CAR_QUANTIDADE));
                $existe->CAR_QUANTIDADE = $this->request->post("qtda")+$existe->CAR_QUANTIDADE;
                $existe->CAR_VALOR_ITEM = $valor;
                $existe->CAR_TOTAL = $valorTotal;
                $existe->CAR_DATA = date('d/m/Y');
                $existe->save();

                $quantidade = ORM::factory("carrinhos")
                ->selectSUMqnt(Session::instance()->get('carrinho'.$this->commerceSession));
                $qtda = $quantidade[0]["qnt"];

                echo json_encode(array('ok' => true, 'qtda' => $qtda,'msg' => '<div class="alert alert-success fade in alert-dismissible mostra-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                Produto adicionado ao carrinho!<br><a href="'.url::base().'carrinho">Acesse aqui seu carrinho</a>
                </div>'));
            }
        }
    }

    public function action_cuponsproduto() {
        $cupom = $this->request->post('inpt_cupom');
        $id = $this->request->post('produto');
        $busca = ORM::factory('cupons')->where('CUP_CODIGO','=',strtoupper($cupom))->find();
        $produto = ORM::factory('produtos')->where('PRO_ID','=',$id)->find();
        if ($busca->CUP_ID != '' and $produto->PRO_ID != ''){
            $tipo = $busca->CUP_TIPO;
            $vlrAntigo = number_format($produto->PRO_PRECO,2,',','.');
            if ($tipo == 'P'){
                $valorNovo = (($produto->PRO_PRECO*$busca->CUP_VALOR)/100);
                $vlrComDesconto = number_format($produto->PRO_PRECO-$valorNovo,2,',','.');
            } else {
                $vlrComDesconto = number_format($produto->PRO_PRECO-$busca->CUP_VALOR,2,',','.');
            }
            $txtVlr = '<small class="txtPromo">De R$ '.$vlrAntigo.'</small> por R$ '.$vlrComDesconto.'</div>';
            echo json_encode(array('ok' => true, 'str' => $txtVlr ,'msg' => '<div style="color:green;">Preço atualizado conforme '.strtoupper($cupom).'</div>'));
        } else {
            echo json_encode(array('ok' => false, 'msg' => '<div style="color:red;">cupom não encontrado</div>'));
        }
    }
}

// End Ajax
