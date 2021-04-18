<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller_Template {

    //VIEW DEFAULT
    public $template = 'login';
    
    //NOME EMPRESA
    public $empresa = "Admin";
    
    //NOME DA SESSÃO, PARA NÃO DAR BAGUNÇA COM OUTRA ADM E AFINS ABERTOS NO NAVEGADOR
    public $nomeSessao = "adminloja";
    
    public function before() { 
        parent::before(); 
        
        $this->_name = $this->request->controller();
        $this->template->titulo = $this->empresa." - LOGIN";
        
        //GERAM AS TABELAS DEFAULT
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS `PERMISSOES` (
            `PER_ID` int(11) unsigned NOT NULL auto_increment,
            `PER_NOME` varchar(48) NOT NULL default '',
            PRIMARY KEY  (`PER_ID`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;");

        //SE NÃO TEM AS PERMISSÕES DEFAULT, ADICIONA
        $existePer = ORM::factory("permissoes")->where("PER_ID", "=", 1)->or_where("PER_ID", "=", 2)->or_where("PER_ID", "=", 3)->find_all();
        if (count($existePer) == 0) {
            Database::instance()->query(Database::INSERT, "INSERT INTO `PERMISSOES` (`PER_ID`, `PER_NOME`) VALUES 
            (1, 'Master'),
            (2, 'Administrador');");
        }

        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS CATEGORIA_MODULO (
            CAM_ID INT (11) unsigned NOT NULL auto_increment,
            CAM_NOME VARCHAR (50) NOT NULL,
            CAM_ORDEM int(11) NOT NULL,
            PRIMARY KEY  (CAM_ID)
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;");
        
        //SE NÃO TEM AS CATEGORIAS INICIAIS, ADICIONA
        $existeCam = ORM::factory("categoriamodulo")->where("CAM_ID", "=", 1)->find_all();
        if (count($existeCam) == 0) {

            Database::instance()->query(Database::INSERT, "INSERT INTO `CATEGORIA_MODULO` (`CAM_ID`, `CAM_NOME`, `CAM_ORDEM`) VALUES 
(1, 'Configurações', 10),
(2, 'Início', 1);");
        }
        
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS MODULOS (
            MOD_ID int(11) unsigned NOT NULL auto_increment,
            MOD_NOME varchar(64) NOT NULL default '',
            MOD_LINK varchar(64) NOT NULL default '',
            MOD_ICONE varchar(20) NOT NULL,
            CAM_ID int(11) unsigned NOT NULL,
            PRIMARY KEY  (MOD_ID),
            UNIQUE KEY MOD_LINK (MOD_LINK),
            CONSTRAINT fk_moduloscam FOREIGN KEY (CAM_ID) REFERENCES CATEGORIA_MODULO(CAM_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;");

        //SE NÃO TEM OS MÓDULOS INICIAIS, ADICIONA
        $existeMod = ORM::factory("modulos")->where("MOD_ID", "=", 1)->or_where("MOD_ID", "=", 2)->or_where("MOD_ID", "=", 3)->find_all();
        if (count($existeMod) == 0) {

            Database::instance()->query(Database::INSERT, "INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
            (1, 'Módulos', 'modulos', 'list', 1),
            (2, 'Permissões', 'permissoes', 'playlist_add_check', 1),
            (3, 'Usuários', 'usuarios', 'person', 1),
            (4, 'Categorias Módulos', 'categoriamodulo', 'list', 1),
            (5, 'Início', 'index', 'dashboard', 2);");
        }
        
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS USUARIOS (
            USU_ID int(11) unsigned NOT NULL auto_increment,
            PER_ID int(11) unsigned NOT NULL,
            USU_NOME varchar(100) NOT NULL,
            USU_EMAIL varchar(200) NOT NULL default '',
            USU_LOGIN varchar(50) NOT NULL,
            USU_SENHA varchar(32) NOT NULL,
            USU_DATA_CADASTRO date NOT NULL,
            PRIMARY KEY  (USU_ID),
            UNIQUE KEY USU_LOGIN (USU_LOGIN),
            CONSTRAINT fk_usuariosper FOREIGN KEY (PER_ID) REFERENCES PERMISSOES(PER_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

        //SE NÃO TEM O USUÁRIO DEFAULT, ADICIONA
        $existeUser = ORM::factory("usuarios")->where("USU_ID", "=", 1)->find_all();
        if (count($existeUser) == 0) {

            //USUÁRIO DEFAULT admin. SENHA: adminteste
            Database::instance()->query(Database::INSERT, "INSERT INTO `USUARIOS` (`USU_ID`, `PER_ID`, `USU_NOME`, `USU_EMAIL`, `USU_LOGIN`, `USU_SENHA`, 
            `USU_DATA_CADASTRO`) VALUES 
(1, 1, 'admin', 'admin@admin.com.br', 'admin', '6b28c000c2b8426877fa533f85b795a6', '".date("Y-m-d")."');");
        }

        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS `MODULOS_PERMISSOES` (
            `MOD_ID` int(11) unsigned NOT NULL,
            `PER_ID` int(11) unsigned NOT NULL,
            PRIMARY KEY  (`MOD_ID`,`PER_ID`),
            CONSTRAINT fk_modulopermissaomod FOREIGN KEY (MOD_ID) REFERENCES MODULOS(MOD_ID) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT fk_modulopermissaoper FOREIGN KEY (PER_ID) REFERENCES PERMISSOES(PER_ID) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        //SE NÃO TEM OS MÓDULOS INICIAIS COM SUAS PERMISSÕES, ADICIONA
        $existeModP = ORM::factory("modulospermissoes")->where("MOD_ID", "=", 1)->or_where("MOD_ID", "=", 2)->or_where("MOD_ID", "=", 3)->find_all();
        if (count($existeModP) == 0) {
            Database::instance()->query(Database::INSERT, "INSERT INTO `MODULOS_PERMISSOES` (`MOD_ID`, `PER_ID`) VALUES 
                (1, 1),
                (2, 1),
                (3, 1),
                (4, 1),
                (5, 1);");
        }
        
        //MODULOS FAVORITOS
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS `MODULOS_FAVORITOS` (
            `MOD_ID` int(11) unsigned NOT NULL,
            `USU_ID` int(11) unsigned NOT NULL,
            PRIMARY KEY  (`MOD_ID`,`USU_ID`),
            CONSTRAINT fk_modulofavoritosmod FOREIGN KEY (MOD_ID) REFERENCES MODULOS(MOD_ID) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT fk_modulofavoritosusu FOREIGN KEY (USU_ID) REFERENCES USUARIOS(USU_ID) ON DELETE CASCADE ON UPDATE CASCADE
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }

    public function action_index() { 
        /*if (Auth::logado() === TRUE) {
            $this->request->redirect('');
        }*/
    }
    
    /*FAZ O LOGIN*/
    public function action_login() {
        $this->auto_render = FALSE;
        
        if ($this->request->is_ajax()) {
            /*PEGA OS CAMPOS*/
            $post = $this->request->post();
            
            //VERIFICA DE EXISTE O USUARIO COM AQUELA SENHA
            $usuario = ORM::factory("usuarios")->where("USU_LOGIN", "=", addslashes($post["login"]))
                    ->where("USU_SENHA", "=", md5(hash("sha512", Cookie::$salt.addslashes($post["senha"]))))->find();

            if($usuario->loaded()){
                //SETA AS SESSOES
                Session::instance()->set("id_usuario".$this->nomeSessao, $usuario->USU_ID);
                Session::instance()->set("usuario".$this->nomeSessao, $usuario->USU_NOME);
                Session::instance()->set("id_permissao".$this->nomeSessao, $usuario->PER_ID);
                Session::instance()->set("permisso".$this->nomeSessao, $usuario->USU_ID);

                $ok = true;

                $msg = '<div class="form-group has-success">
                            <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Login OK! Aguarde...</label>
                        </div>';

                $classe = 'has-success';
                
                echo json_encode(array("ok" => $ok, "msg" => $msg, "classe" => $classe));
            }else{
                $ok = false;

                $msg = '<div class="form-group has-error">
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Usuário ou senha inválidos, tente novamente!</label>
                        </div>';
                
                $classe = 'has-error';

                echo json_encode(array("ok" => $ok, "msg" => $msg, "classe" => $classe));
            }
        }
    }

    /*FAZ O LOGOUT*/
    public function action_logout() {
        Session::instance()->delete("id_usuario".$this->nomeSessao);
        Session::instance()->delete("usuario".$this->nomeSessao);
        Session::instance()->delete("id_permissao".$this->nomeSessao);
        Session::instance()->delete("permisso".$this->nomeSessao);
        $this->request->redirect("login");
    }

}

// End Login