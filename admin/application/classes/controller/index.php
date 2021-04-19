<?php 

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {

    //VIEW DEFAULT
    public $template = 'template';
    //GRAVA LOGS DE ERROS
    public $gravar_logs = TRUE;
    //NOME DA EMPRESA
    public $empresa = "Admin";
    //NOME DA SESSÃO, PARA NÃO DAR BAGUNÇA COM OUTRA RESTRITAS E AFINS ABERTOS NO NAVEGADOR
    public $nomeSessao = "adminloja";
    //DOMÍNIO
    public $dominio = "https://lojatroc.000webhostapp.com/admin/";
    //E-MAIL DE AUTENTICAÇÃO
    public $emailEmpresa = "email@email.com";
    //SENHA DO E-MAIL DE AUTENTICAÇÃO
    public $senhaEmail = "senhadoemail";
    //HOST DO E-MAIL DE AUTENTICAÇÃO
    public $host = "smtp.gmail.com";
    //VARIÁVEL DE SESSÕES
    protected $sessao;
    //QUANTIDADE DE ITENS POR PAGINA NA LISTAGEM
    public $qtdPagina;

    public function before() {
        parent::before();

        //SESSIONS
        $this->sessao = Session::instance();
        
        //Seta um tempo de ultimo clique para mudar o Online para offline
        setcookie("ultimoclique", time());

        //TESTA SE ESTA LOGADO
        if (!$this->sessao->get("id_usuario" . $this->nomeSessao) or !$this->sessao->get("id_permissao" . $this->nomeSessao)) {
            $this->request->redirect('login');
        }

        //TESTA O MODULO ACESSADO, SE NAO TEM PERMISSAO, REDIRECIONA PARA A HOME
        //EXCEÇÕES: CONDIÇÃO DE PAGAMENTO, GALERIA, AJAX 
        if (Request::current()->controller() != "index" and Request::current()->controller() != "galeria" and
            Request::current()->controller() != "condicaopagamento" and Request::current()->controller() != "ajax") {
            $testePermissao = ORM::factory("modulos")->with("modulospermissoes");
            $testePermissao = $testePermissao->where("MOD_LINK", "=", Request::current()->controller())
                            ->where("PER_ID", "=", $this->sessao->get("id_permissao" . $this->nomeSessao))->count_all();
            
            $this->template->herbalife = ORM::factory("modulos")->where("MOD_LINK", "=", Request::current()->controller())->find();

            if ($testePermissao == 0) {
                $this->request->redirect("index");
            }
        }
        
        

        //CONTROLE DE ACESSOS
        $meni = Request::current()->controller();
        $acao = Request::current()->action();
        $item = Request::current()->param("id");
        $post = "";

        //verifica se é refresh(F5) ou requisição de post(submit)
        if($_SERVER['REQUEST_METHOD'] == 'POST' //se for POST
            AND !$this->request->is_ajax() //se não for ajax
            AND  substr($meni, 0, 9) != 'relatorio' //se não for relatórios
            AND !isset($_FILES)){ //Se tem arquivo, passa sempre para salvar
            //se ultimo post e post atual forem iguais não salva
            if($this->sessao->get('last_request') == $this->request->post()){
                $this->request->redirect($meni);
            }else{
                $this->sessao->set('last_request', $this->request->post());
            }
        }

        //SE ITEM FOR IGUAL A 0, DEVE ESTAR VINDO POR POST. ENTÃO, PEGA O PRIMEIRO ITEM QUE TEM QUE SER O ID
        if ($item == 0) {
            foreach ($this->request->post() as $idItem) {
                //SE FOR ARRAY, DEVE SER O EXCLUIRTODOS. PEGA SOH O PRIMEIRO
                if (is_array($idItem)) {
                    $item = $idItem[0];
                } else {
                    $item = $idItem;
                }
                break;
            }
            foreach($this->request->post() as $campo => $value){
                $post .= $campo."=>[";
                if(is_array($value)){
                    foreach($value as $val){
                        $post .= $val.";";
                    }
                }else{
                    $post .= $value;
                }
                $post .= "]<br/>";
            }
        }

        
        //FIM CONTROLE ACESSOS

        $this->template->titulo = $this->empresa;

        //Quantidade de itens por pagina
        $this->qtdPagina = 10;

        //NOME DO VIVENTE LOGADO
        $this->template->vivente = $this->sessao->get('usuario' . $this->nomeSessao);
        
        //ID DO VIVENTE LOGADO
        $this->template->idvivente = $this->sessao->get('id_usuario' . $this->nomeSessao);

        //BUSCA AS CATEGORIAS DE MODULOS DOS MÓDULOS QUE O USUÁRIO TEM PERMISSÃO
        $this->template->categoriamodulo = ORM::factory("modulos")->with("categoriamodulo")->with("modulospermissoes")
                        ->where("PER_ID", "=", $this->sessao->get("id_permissao" . $this->nomeSessao))
                        ->group_by("CAM_ID")->order_by("CAM_ORDEM", "asc")->find_all();
        
        $this->template->permissao = $this->sessao->get("id_permissao" . $this->nomeSessao);
        
        //ESTABELECIMENTO LOGADO
        $this->template->estabelecimentos = 'Loja';              
    }

    public function action_index() {
        $view = View::Factory('index');
        
        $this->template->bt_voltar = false;

        $this->template->conteudo = $view;
    }
    
    //PAGINACAO DA ORM
    public function action_page($modelo, $limit) {

        //O RESET MANTEM A QUERY PARA SER USADA NOVAMENTE NA BUSCA REAL
        $pagination = Pagination::factory(array(
                    'total_items' => $modelo->reset(false)->count_all(),
                    'items_per_page' => $limit,
                    'view' => 'pagination/floating',
                        )
        );

        // Pass controller and action names explicitly to $pagination object
        $pagination->route_params(array('controller' => $this->request->controller(), 'action' => 'index'));
        // Get data
        $data = $modelo->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();
        // Pass data and validation object to view
        return array('data' => $data, 'pagination' => $pagination);
    }

    //retorna data formado ano-mes-dia
    public static function ddmmaaaa_aaaammdd($dd_mm_aaaa) {
        $axdia = substr($dd_mm_aaaa, 0, 2);
        $axmes = substr($dd_mm_aaaa, 3, 2);
        $axano = substr($dd_mm_aaaa, 6, 4);
        $aaaa_mm_dd = $axano . "-" . $axmes . "-" . $axdia;
        return $aaaa_mm_dd;
    }

    //retorna data formado dia-mes-ano
    public static function aaaammdd_ddmmaaaa($aaaa_mm_dd) {
        $axdia = substr($aaaa_mm_dd, 8, 2);
        $axmes = substr($aaaa_mm_dd, 5, 2);
        $axano = substr($aaaa_mm_dd, 0, 4);
        $dd_mm_aaaa = $axdia . "/" . $axmes . "/" . $axano;
        return $dd_mm_aaaa;
    }

    public static function sane($string) {
        return(str_replace(")", "", str_replace("(", "", str_replace(":", "", str_replace(";", "", preg_replace('/(\'|")/', '', $string))))));
    }
    
}

// End Template
