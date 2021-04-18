<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2021-04-17 12:51:34 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
            EST_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_ID INT (11) unsigned NOT NULL ,
            EST_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EST_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EST_CNPJ VARCHAR (100) NOT NULL ,
            EST_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EST_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EST_CEP VARCHAR (20) NOT NULL ,
            EST_ENDERECO VARCHAR (200) NOT NULL ,
            EST_NUMERO VARCHAR (100) NOT NULL ,
            EST_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EST_BAIRRO VARCHAR (100) NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            EST_EMAIL VARCHAR (100) NOT NULL ,
            EST_TELEFONE VARCHAR (20) NOT NULL ,
            EST_NUMERACAO_INICIAL_NF INT(11) unsigned NOT NULL ,
            ATI_ID INT (11) unsigned NOT NULL ,
            EST_AMBIENTE SET ('H','P') NOT NULL  default 'H',
            EST_CHAVE_HOMOLOGACAO VARCHAR (200) NOT NULL ,
            EST_CHAVE_PRODUCAO VARCHAR (200) NOT NULL ,
            EST_JUROS_APOS_VENCIMENTO DECIMAL (10,2) NOT NULL  default '0',
            EST_SENHA_CERTIFICADO VARCHAR (100) NOT NULL ,
            PRIMARY KEY  (EST_ID),
            FOREIGN KEY (EMP_ID) REFERENCES EMPRESAS(EMP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (ATI_ID) REFERENCES ATIVIDADE(ATI_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-17 12:51:34 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
            EST_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_ID INT (11) unsigned NOT NULL ,
            EST_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EST_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EST_CNPJ VARCHAR (100) NOT NULL ,
            EST_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EST_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EST_CEP VARCHAR (20) NOT NULL ,
            EST_ENDERECO VARCHAR (200) NOT NULL ,
            EST_NUMERO VARCHAR (100) NOT NULL ,
            EST_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EST_BAIRRO VARCHAR (100) NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            EST_EMAIL VARCHAR (100) NOT NULL ,
            EST_TELEFONE VARCHAR (20) NOT NULL ,
            EST_NUMERACAO_INICIAL_NF INT(11) unsigned NOT NULL ,
            ATI_ID INT (11) unsigned NOT NULL ,
            EST_AMBIENTE SET ('H','P') NOT NULL  default 'H',
            EST_CHAVE_HOMOLOGACAO VARCHAR (200) NOT NULL ,
            EST_CHAVE_PRODUCAO VARCHAR (200) NOT NULL ,
            EST_JUROS_APOS_VENCIMENTO DECIMAL (10,2) NOT NULL  default '0',
            EST_SENHA_CERTIFICADO VARCHAR (100) NOT NULL ,
            PRIMARY KEY  (EST_ID),
            FOREIGN KEY (EMP_ID) REFERENCES EMPRESAS(EMP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (ATI_ID) REFERENCES ATIVIDADE(ATI_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\estabelecimentos.php(168): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Estabelecimentos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\index.php(140): Kohana_ORM::factory('Model_Estabelec...')
#3 [internal function]: Controller_Index->before()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Index))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-17 13:29:19 --- ERROR: Error [ 0 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ MODPATH\orm\classes\kohana\orm.php [ 2104 ]
2021-04-17 13:29:19 --- STRACE: Error [ 0 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ MODPATH\orm\classes\kohana\orm.php [ 2104 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1054): Kohana_ORM->arrumaData('17/04/2021')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(608): Kohana_ORM->run_filter('ACE_DATA', '17/04/2021')
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(590): Kohana_ORM->set('ACE_DATA', '17/04/2021')
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\index.php(107): Kohana_ORM->__set('ACE_DATA', '17/04/2021')
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\modulos.php(8): Controller_Index->before()
#5 [internal function]: Controller_Modulos->before()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Modulos))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-17 13:37:02 --- ERROR: Error [ 0 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ MODPATH\orm\classes\kohana\orm.php [ 2104 ]
2021-04-17 13:37:02 --- STRACE: Error [ 0 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ MODPATH\orm\classes\kohana\orm.php [ 2104 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1054): Kohana_ORM->arrumaData('17/04/2021')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(608): Kohana_ORM->run_filter('ACE_DATA', '17/04/2021')
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(590): Kohana_ORM->set('ACE_DATA', '17/04/2021')
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\index.php(107): Kohana_ORM->__set('ACE_DATA', '17/04/2021')
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\modulos.php(8): Controller_Index->before()
#5 [internal function]: Controller_Modulos->before()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Modulos))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-17 13:38:52 --- ERROR: Error [ 0 ]: Call to undefined method Controller_Modulos::sane() ~ APPPATH\classes\controller\modulos.php [ 60 ]
2021-04-17 13:38:52 --- STRACE: Error [ 0 ]: Call to undefined method Controller_Modulos::sane() ~ APPPATH\classes\controller\modulos.php [ 60 ]
--
#0 [internal function]: Controller_Modulos->action_edit()
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Modulos))
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#4 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#5 {main}
2021-04-17 13:39:33 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
            EST_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_ID INT (11) unsigned NOT NULL ,
            EST_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EST_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EST_CNPJ VARCHAR (100) NOT NULL ,
            EST_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EST_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EST_CEP VARCHAR (20) NOT NULL ,
            EST_ENDERECO VARCHAR (200) NOT NULL ,
            EST_NUMERO VARCHAR (100) NOT NULL ,
            EST_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EST_BAIRRO VARCHAR (100) NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            EST_EMAIL VARCHAR (100) NOT NULL ,
            EST_TELEFONE VARCHAR (20) NOT NULL ,
            EST_NUMERACAO_INICIAL_NF INT(11) unsigned NOT NULL ,
            ATI_ID INT (11) unsigned NOT NULL ,
            EST_AMBIENTE SET ('H','P') NOT NULL  default 'H',
            EST_CHAVE_HOMOLOGACAO VARCHAR (200) NOT NULL ,
            EST_CHAVE_PRODUCAO VARCHAR (200) NOT NULL ,
            EST_JUROS_APOS_VENCIMENTO DECIMAL (10,2) NOT NULL  default '0',
            EST_SENHA_CERTIFICADO VARCHAR (100) NOT NULL ,
            PRIMARY KEY  (EST_ID),
            FOREIGN KEY (EMP_ID) REFERENCES EMPRESAS(EMP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (ATI_ID) REFERENCES ATIVIDADE(ATI_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-17 13:39:33 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
            EST_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_ID INT (11) unsigned NOT NULL ,
            EST_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EST_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EST_CNPJ VARCHAR (100) NOT NULL ,
            EST_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EST_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EST_CEP VARCHAR (20) NOT NULL ,
            EST_ENDERECO VARCHAR (200) NOT NULL ,
            EST_NUMERO VARCHAR (100) NOT NULL ,
            EST_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EST_BAIRRO VARCHAR (100) NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            EST_EMAIL VARCHAR (100) NOT NULL ,
            EST_TELEFONE VARCHAR (20) NOT NULL ,
            EST_NUMERACAO_INICIAL_NF INT(11) unsigned NOT NULL ,
            ATI_ID INT (11) unsigned NOT NULL ,
            EST_AMBIENTE SET ('H','P') NOT NULL  default 'H',
            EST_CHAVE_HOMOLOGACAO VARCHAR (200) NOT NULL ,
            EST_CHAVE_PRODUCAO VARCHAR (200) NOT NULL ,
            EST_JUROS_APOS_VENCIMENTO DECIMAL (10,2) NOT NULL  default '0',
            EST_SENHA_CERTIFICADO VARCHAR (100) NOT NULL ,
            PRIMARY KEY  (EST_ID),
            FOREIGN KEY (EMP_ID) REFERENCES EMPRESAS(EMP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (ATI_ID) REFERENCES ATIVIDADE(ATI_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\estabelecimentos.php(168): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Estabelecimentos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1494): Kohana_ORM::factory('Model_Estabelec...')
#3 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(721): Kohana_ORM->_related('estabelecimento...')
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\usuarios.php(23): Kohana_ORM->with('estabelecimento...')
#5 [internal function]: Controller_Usuarios->action_index()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Usuarios))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-17 13:40:27 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
            EST_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_ID INT (11) unsigned NOT NULL ,
            EST_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EST_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EST_CNPJ VARCHAR (100) NOT NULL ,
            EST_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EST_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EST_CEP VARCHAR (20) NOT NULL ,
            EST_ENDERECO VARCHAR (200) NOT NULL ,
            EST_NUMERO VARCHAR (100) NOT NULL ,
            EST_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EST_BAIRRO VARCHAR (100) NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            EST_EMAIL VARCHAR (100) NOT NULL ,
            EST_TELEFONE VARCHAR (20) NOT NULL ,
            EST_NUMERACAO_INICIAL_NF INT(11) unsigned NOT NULL ,
            ATI_ID INT (11) unsigned NOT NULL ,
            EST_AMBIENTE SET ('H','P') NOT NULL  default 'H',
            EST_CHAVE_HOMOLOGACAO VARCHAR (200) NOT NULL ,
            EST_CHAVE_PRODUCAO VARCHAR (200) NOT NULL ,
            EST_JUROS_APOS_VENCIMENTO DECIMAL (10,2) NOT NULL  default '0',
            EST_SENHA_CERTIFICADO VARCHAR (100) NOT NULL ,
            PRIMARY KEY  (EST_ID),
            FOREIGN KEY (EMP_ID) REFERENCES EMPRESAS(EMP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (ATI_ID) REFERENCES ATIVIDADE(ATI_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-17 13:40:27 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
            EST_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_ID INT (11) unsigned NOT NULL ,
            EST_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EST_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EST_CNPJ VARCHAR (100) NOT NULL ,
            EST_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EST_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EST_CEP VARCHAR (20) NOT NULL ,
            EST_ENDERECO VARCHAR (200) NOT NULL ,
            EST_NUMERO VARCHAR (100) NOT NULL ,
            EST_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EST_BAIRRO VARCHAR (100) NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            EST_EMAIL VARCHAR (100) NOT NULL ,
            EST_TELEFONE VARCHAR (20) NOT NULL ,
            EST_NUMERACAO_INICIAL_NF INT(11) unsigned NOT NULL ,
            ATI_ID INT (11) unsigned NOT NULL ,
            EST_AMBIENTE SET ('H','P') NOT NULL  default 'H',
            EST_CHAVE_HOMOLOGACAO VARCHAR (200) NOT NULL ,
            EST_CHAVE_PRODUCAO VARCHAR (200) NOT NULL ,
            EST_JUROS_APOS_VENCIMENTO DECIMAL (10,2) NOT NULL  default '0',
            EST_SENHA_CERTIFICADO VARCHAR (100) NOT NULL ,
            PRIMARY KEY  (EST_ID),
            FOREIGN KEY (EMP_ID) REFERENCES EMPRESAS(EMP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (ATI_ID) REFERENCES ATIVIDADE(ATI_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\estabelecimentos.php(168): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Estabelecimentos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1494): Kohana_ORM::factory('Model_Estabelec...')
#3 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(525): Kohana_ORM->_related('estabelecimento...')
#4 C:\xampp\htdocs\loja\admin\application\views\usuarios\list.php(47): Kohana_ORM->__get('estabelecimento...')
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(228): Kohana_View->render()
#8 C:\xampp\htdocs\loja\admin\application\views\template.php(222): Kohana_View->__toString()
#9 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#10 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#11 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#12 [internal function]: Kohana_Controller_Template->after()
#13 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Usuarios))
#14 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#15 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#16 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#17 {main}
2021-04-17 13:41:00 --- ERROR: Error [ 0 ]: Call to undefined method Controller_Usuarios::aaaammdd_ddmmaaaa() ~ APPPATH\classes\controller\usuarios.php [ 74 ]
2021-04-17 13:41:00 --- STRACE: Error [ 0 ]: Call to undefined method Controller_Usuarios::aaaammdd_ddmmaaaa() ~ APPPATH\classes\controller\usuarios.php [ 74 ]
--
#0 [internal function]: Controller_Usuarios->action_edit()
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Usuarios))
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#4 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#5 {main}
2021-04-17 13:41:22 --- ERROR: Error [ 0 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ MODPATH\orm\classes\kohana\orm.php [ 2104 ]
2021-04-17 13:41:22 --- STRACE: Error [ 0 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ MODPATH\orm\classes\kohana\orm.php [ 2104 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1054): Kohana_ORM->arrumaData('17/04/2021')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(608): Kohana_ORM->run_filter('ACE_DATA', '17/04/2021')
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(590): Kohana_ORM->set('ACE_DATA', '17/04/2021')
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\index.php(107): Kohana_ORM->__set('ACE_DATA', '17/04/2021')
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\usuarios.php(8): Controller_Index->before()
#5 [internal function]: Controller_Usuarios->before()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Usuarios))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-17 13:41:34 --- ERROR: Error [ 0 ]: Call to undefined method Controller_Usuarios::aaaammdd_ddmmaaaa() ~ APPPATH\classes\controller\usuarios.php [ 74 ]
2021-04-17 13:41:34 --- STRACE: Error [ 0 ]: Call to undefined method Controller_Usuarios::aaaammdd_ddmmaaaa() ~ APPPATH\classes\controller\usuarios.php [ 74 ]
--
#0 [internal function]: Controller_Usuarios->action_edit()
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Usuarios))
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#4 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#5 {main}
2021-04-17 13:43:22 --- ERROR: Kohana_Exception [ 0 ]: The EST_ID property does not exist in the Model_Usuarios class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-17 13:43:22 --- STRACE: Kohana_Exception [ 0 ]: The EST_ID property does not exist in the Model_Usuarios class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\usuarios.php(76): Kohana_ORM->__get('EST_ID')
#1 [internal function]: Controller_Usuarios->action_edit()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Usuarios))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-17 13:44:32 --- ERROR: Error [ 0 ]: Class 'Model_Acessos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-17 13:44:32 --- STRACE: Error [ 0 ]: Class 'Model_Acessos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\index.php(105): Kohana_ORM::factory('Model_Acessos')
#1 C:\xampp\htdocs\loja\admin\application\classes\controller\usuarios.php(8): Controller_Index->before()
#2 [internal function]: Controller_Usuarios->before()
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Usuarios))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#7 {main}
2021-04-17 13:44:51 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-17 13:44:51 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Usuarios))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-17 13:45:03 --- ERROR: Error [ 0 ]: Class 'Model_Acessos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-17 13:45:03 --- STRACE: Error [ 0 ]: Class 'Model_Acessos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\index.php(105): Kohana_ORM::factory('Model_Acessos')
#1 C:\xampp\htdocs\loja\admin\application\classes\controller\usuarios.php(8): Controller_Index->before()
#2 [internal function]: Controller_Usuarios->before()
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Usuarios))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#7 {main}
2021-04-17 13:45:11 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-17 13:45:11 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Usuarios))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}