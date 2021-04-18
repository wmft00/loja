<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2021-04-14 23:17:39 --- ERROR: Error [ 0 ]: Call to undefined function mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
2021-04-14 23:17:39 --- STRACE: Error [ 0 ]: Call to undefined function mysql_connect() ~ MODPATH\database\classes\kohana\database\mysql.php [ 59 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#1 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(23): Kohana_Database_MySQL->query(2, 'CREATE TABLE IF...')
#2 [internal function]: Controller_Login->before()
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#6 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#7 {main}
2021-04-14 23:20:42 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Gerador', 'gerador', 'fa fa-code', 2),
(6, 'Início', 'index', 'fa fa-dashboard', 3),
(7, 'Acessos', 'acssos', 'fa fa-magnet', 1); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:20:42 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Gerador', 'gerador', 'fa fa-code', 2),
(6, 'Início', 'index', 'fa fa-dashboard', 3),
(7, 'Acessos', 'acssos', 'fa fa-magnet', 1); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(68): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:22:02 --- ERROR: Database_Exception [ 1067 ]: Invalid default value for 'USU_DATA_CADASTRO' [ CREATE TABLE IF NOT EXISTS USUARIOS (
            USU_ID int(11) unsigned NOT NULL auto_increment,
            PER_ID int(11) unsigned NOT NULL,
            USU_NOME varchar(100) NOT NULL,
            USU_EMAIL varchar(200) NOT NULL default '',
            USU_LOGIN varchar(50) NOT NULL,
            USU_SENHA varchar(32) NOT NULL,
            USU_DATA_CADASTRO date NOT NULL default '0000-00-00',
            PRIMARY KEY  (USU_ID),
            UNIQUE KEY USU_LOGIN (USU_LOGIN),
            CONSTRAINT fk_usuariosper FOREIGN KEY (PER_ID) REFERENCES PERMISSOES(PER_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:22:02 --- STRACE: Database_Exception [ 1067 ]: Invalid default value for 'USU_DATA_CADASTRO' [ CREATE TABLE IF NOT EXISTS USUARIOS (
            USU_ID int(11) unsigned NOT NULL auto_increment,
            PER_ID int(11) unsigned NOT NULL,
            USU_NOME varchar(100) NOT NULL,
            USU_EMAIL varchar(200) NOT NULL default '',
            USU_LOGIN varchar(50) NOT NULL,
            USU_SENHA varchar(32) NOT NULL,
            USU_DATA_CADASTRO date NOT NULL default '0000-00-00',
            PRIMARY KEY  (USU_ID),
            UNIQUE KEY USU_LOGIN (USU_LOGIN),
            CONSTRAINT fk_usuariosper FOREIGN KEY (PER_ID) REFERENCES PERMISSOES(PER_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(77): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:23:27 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos_permissoes`, CONSTRAINT `fk_modulopermissaomod` FOREIGN KEY (`MOD_ID`) REFERENCES `MODULOS` (`MOD_ID`) ON DELETE CASCADE ON UPDATE CASCADE) [ INSERT INTO `MODULOS_PERMISSOES` (`MOD_ID`, `PER_ID`) VALUES 
                (1, 1),
                (2, 1),
                (3, 1),
                (4, 1),
                (5, 1),
                (6, 1),
                (7, 1); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:23:27 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos_permissoes`, CONSTRAINT `fk_modulopermissaomod` FOREIGN KEY (`MOD_ID`) REFERENCES `MODULOS` (`MOD_ID`) ON DELETE CASCADE ON UPDATE CASCADE) [ INSERT INTO `MODULOS_PERMISSOES` (`MOD_ID`, `PER_ID`) VALUES 
                (1, 1),
                (2, 1),
                (3, 1),
                (4, 1),
                (5, 1),
                (6, 1),
                (7, 1); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(112): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:26:30 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
2021-04-14 23:26:30 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(150): Kohana_ORM->with('estabelecimento...')
#5 [internal function]: Controller_Login->action_login()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Login))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-14 23:27:32 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
2021-04-14 23:27:32 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(150): Kohana_ORM->with('estabelecimento...')
#5 [internal function]: Controller_Login->action_login()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Login))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-14 23:28:00 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
2021-04-14 23:28:00 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
#4 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(150): Kohana_ORM->with('estabelecimento...')
#5 [internal function]: Controller_Login->action_login()
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Login))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#9 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#10 {main}
2021-04-14 23:30:12 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3),
(6, 'Acessos', 'acssos', 'fa fa-magnet', 1); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:30:12 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3),
(6, 'Acessos', 'acssos', 'fa fa-magnet', 1); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(68): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:31:26 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:31:26 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(68): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:31:28 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:31:28 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(68): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:31:49 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:31:49 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(68): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:37:47 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-14 23:37:47 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`modulos`, CONSTRAINT `fk_moduloscam` FOREIGN KEY (`CAM_ID`) REFERENCES `CATEGORIA_MODULO` (`CAM_ID`)) [ INSERT INTO `MODULOS` (`MOD_ID`, `MOD_NOME`, `MOD_LINK`, `MOD_ICONE`, `CAM_ID`) VALUES 
(1, 'Módulos', 'modulos', 'fa fa-cogs', 1),
(2, 'Permissões', 'permissoes', 'fa fa-unlock-alt', 1),
(3, 'Usuários', 'usuarios', 'fa fa-user', 1),
(4, 'Categorias Módulos', 'categoriamodulo', 'fa fa-object-group', 1),
(5, 'Início', 'index', 'fa fa-dashboard', 3); ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\login.php(68): Database_MySQLi->query(2, 'INSERT INTO `MO...')
#1 [internal function]: Controller_Login->before()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Login))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-14 23:42:49 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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
2021-04-14 23:42:49 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`estabelecimentos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS ESTABELECIMENTOS (
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