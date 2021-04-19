<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {

    //VIEW DEFAULT
    public $template = 'template';
    
    //GRAVA LOGS DE ERROS
    public $gravar_logs = TRUE;
    
    //INFORMAÇÕES DA EMPRESA
    public $empresa = array(
        "nome" => "Loja",
        "endereco" => "Av. Teste, 0000 - Conj. 01.<br/>
                                99.150-000 - RS<br/>
                                Fone: (54) 0000-0000",
        "description" => "Descrição Marota",
        "keywords" => "Vendas Teste"
    );
    
    //DOMÍNIO
    public $dominio = "https://lojatroc.000webhostapp.com/";
    
    
    //VARIAVEL DE SESSAO PARA O ECOMMERCE (ALTERAR QUANDO NOVO). MESMA FUNCAO DA USADA NO ADMIN
    public $commerceSession = "lojaTeste";
    
    //VARIAVEL DE CONTROLE DE CACHE
    //SE FOR RANDOMICA, VAI SEMPRE PUXAR OS ELEMENTOS NOVAMENTE, IGNORANDO A CACHE
    //SE FOR FIXA, UTILIZA A CACHE NORMALMENTE
    public $cacheController;

    public function before() {
        parent::before();
        
        //SETA INFORMAÇOES PARA IDENTIFICAO E CARRINHO
        if (Session::instance()->get('carrinho'.$this->commerceSession) == '') {
            Session::instance()->set('carrinho'.$this->commerceSession, md5(session_id()));
        }

        //RETIRA CARRINHOS ANTIGOS (2 DIAS)
        $data = gmdate("d/m/y", time() - (3600 * 51));
        $data = $this->ddmmaaaa_aaaammdd($data);
        $carrinhos = ORM::factory("carrinhos")->where("CAR_DATA", "<=", $data)->find_all();
        foreach ($carrinhos as $car) {
            $car->delete();
        }

        //SELECIONA O VALOR DO CARRINHO DA CRIANÇA
        $total = ORM::factory("carrinhos")->selectSUM(Session::instance()->get('carrinho'.$this->commerceSession));
        $this->template->valorTotal = $total[0]["total"];
        
        //INICIA A CACHECONTROLLER
        $this->cacheController = rand(0, 1000);

        $this->template->titulo = $this->empresa["nome"];
        
        /*VARIÁVEIS DE CONTROLE*/
        $this->template->cacheController = $this->cacheController;
        
        $this->template->description = $this->empresa["description"];
        
        $this->template->keywords = $this->empresa["keywords"];

        $this->template->enderecoEmpresa = $this->empresa["endereco"];
        
        $this->template->commerceSession = $this->commerceSession;
        /*FIM VARIÁVEIS DE CONTROLE*/

        //CATEGORIA DE PRODUTO
    }

    public function action_index() {
        $view = View::Factory('index');

        /*VARIÁVEIS DE CONTROLE*/
        $view->cacheController = $this->cacheController;
        /*FIM VARIÁVEIS DE CONTROLE*/

        $this->template->conteudo = $view;
    }

    public static function ddmmaaaa_aaaammdd($dd_mm_aaaa) {
        $axdia = substr($dd_mm_aaaa, 0, 2);
        $axmes = substr($dd_mm_aaaa, 3, 2);
        $axano = substr($dd_mm_aaaa, 6, 4);
        $aaaa_mm_dd = $axano . "-" . $axmes . "-" . $axdia;
        return $aaaa_mm_dd;
    }

    //FAZ SANE TEASE DOS GETS
    public static function sane($string) {
        return(str_replace(")", "", str_replace("(", "", str_replace(":", "", str_replace(";", "", preg_replace('/(\'|")/', '', $string))))));
    }
}

// End Template
