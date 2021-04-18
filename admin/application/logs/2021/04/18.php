<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2021-04-18 01:41:06 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT  NULL ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:41:06 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT  NULL ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:42:32 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT  NULL ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:42:32 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT  NULL ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:42:42 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT  NULL ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:42:42 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT  NULL ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:43:53 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:43:53 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_MARCA INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_MARCA) REFERENCES MARCA(MAR_MARCA) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:45:39 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:45:39 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:45:58 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:45:58 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:46:02 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 01:46:02 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`produtos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_CATEGORIA INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_CATEGORIA) REFERENCES CATEGORIA(CAT_CATEGORIA) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\produtos.php(64): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Produtos->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\produtos.php(26): Kohana_ORM::factory('Model_Produtos')
#3 [internal function]: Controller_Produtos->action_index()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 01:59:22 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 01:59:22 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Modulos))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 01:59:25 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 01:59:25 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 01:59:42 --- ERROR: Error [ 0 ]: Class 'Model_Cupons' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 01:59:42 --- STRACE: Error [ 0 ]: Class 'Model_Cupons' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(26): Kohana_ORM::factory('Model_Cupons')
#1 [internal function]: Controller_Cupons->action_index()
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-18 02:00:07 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:00:07 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:00:11 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:00:11 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:00:11 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:00:11 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:00:12 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:00:12 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:00:13 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:00:13 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:01:08 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:01:08 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
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
2021-04-18 02:01:18 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:01:18 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:01:24 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:01:24 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:01:33 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:01:33 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:02:10 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:02:10 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:02:11 --- ERROR: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-18 02:02:11 --- STRACE: Error [ 0 ]: Class 'Model_Modulosfavoritos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\template.php(189): Kohana_ORM::factory('Model_Modulosfa...', Array)
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#4 [internal function]: Kohana_Controller_Template->after()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Index))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:08:07 --- ERROR: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-18 02:08:07 --- STRACE: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\cupons\edit.php(48): Kohana_ORM->__get('MAR_')
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\admin\application\views\template.php(216): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#10 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#13 {main}
2021-04-18 02:08:34 --- ERROR: Kohana_Exception [ 0 ]: The CAT_ property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-18 02:08:34 --- STRACE: Kohana_Exception [ 0 ]: The CAT_ property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\cupons\edit.php(60): Kohana_ORM->__get('CAT_')
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\admin\application\views\template.php(216): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#10 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#13 {main}
2021-04-18 02:10:32 --- ERROR: Database_Exception [ 1067 ]: Invalid default value for 'CUP_TIPO' [ CREATE TABLE IF NOT EXISTS CUPONS (
            CUP_ID INT (11) unsigned NOT NULL auto_increment,
            CUP_CODIGO VARCHAR (10) NOT NULL ,
            CUP_TIPO SET ('V',' ') NOT NULL  default 'P',
            CUP_VALOR DECIMAL (10,2) NOT NULL  default '0',
            MAR_ID INT (11) unsigned NULL ,
            CAT_ID INT (11) unsigned NULL ,
            PRIMARY KEY  (CUP_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_ID) REFERENCES CATEGORIA(CAT_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 02:10:32 --- STRACE: Database_Exception [ 1067 ]: Invalid default value for 'CUP_TIPO' [ CREATE TABLE IF NOT EXISTS CUPONS (
            CUP_ID INT (11) unsigned NOT NULL auto_increment,
            CUP_CODIGO VARCHAR (10) NOT NULL ,
            CUP_TIPO SET ('V',' ') NOT NULL  default 'P',
            CUP_VALOR DECIMAL (10,2) NOT NULL  default '0',
            MAR_ID INT (11) unsigned NULL ,
            CAT_ID INT (11) unsigned NULL ,
            PRIMARY KEY  (CUP_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_ID) REFERENCES CATEGORIA(CAT_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\cupons.php(56): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Cupons->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(117): Kohana_ORM::factory('Model_Cupons')
#3 [internal function]: Controller_Cupons->action_save()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 02:11:03 --- ERROR: Database_Exception [ 1067 ]: Invalid default value for 'CUP_TIPO' [ CREATE TABLE IF NOT EXISTS CUPONS (
            CUP_ID INT (11) unsigned NOT NULL auto_increment,
            CUP_CODIGO VARCHAR (10) NOT NULL ,
            CUP_TIPO SET ('V',' ') NOT NULL  default 'P',
            CUP_VALOR DECIMAL (10,2) NOT NULL  default '0',
            MAR_ID INT (11) unsigned NULL ,
            CAT_ID INT (11) unsigned NULL ,
            PRIMARY KEY  (CUP_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_ID) REFERENCES CATEGORIA(CAT_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 02:11:03 --- STRACE: Database_Exception [ 1067 ]: Invalid default value for 'CUP_TIPO' [ CREATE TABLE IF NOT EXISTS CUPONS (
            CUP_ID INT (11) unsigned NOT NULL auto_increment,
            CUP_CODIGO VARCHAR (10) NOT NULL ,
            CUP_TIPO SET ('V',' ') NOT NULL  default 'P',
            CUP_VALOR DECIMAL (10,2) NOT NULL  default '0',
            MAR_ID INT (11) unsigned NULL ,
            CAT_ID INT (11) unsigned NULL ,
            PRIMARY KEY  (CUP_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_ID) REFERENCES CATEGORIA(CAT_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\application\classes\model\cupons.php(56): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(39): Model_Cupons->__construct(NULL)
#2 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(117): Kohana_ORM::factory('Model_Cupons')
#3 [internal function]: Controller_Cupons->action_save()
#4 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-18 02:11:14 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '0.00', '', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 02:11:14 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '0.00', '', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(2, 'INSERT INTO `CU...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1153): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->create(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(126): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:11:31 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '1212.12', '1', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 02:11:31 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '1212.12', '1', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(2, 'INSERT INTO `CU...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1153): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->create(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(126): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:12:35 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '1212.12', '1', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 02:12:35 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '1212.12', '1', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(2, 'INSERT INTO `CU...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1153): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->create(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(126): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:12:56 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '1212.12', '1', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-18 02:12:56 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `cupons_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `CATEGORIA` (`CAT_ID`)) [ INSERT INTO `CUPONS` (`CUP_ID`, `CUP_CODIGO`, `CUP_TIPO`, `CUP_VALOR`, `MAR_ID`, `CAT_ID`) VALUES ('0', '121212ads', 'P', '1212.12', '1', '') ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(2, 'INSERT INTO `CU...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1153): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->create(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(126): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-18 02:14:05 --- ERROR: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-18 02:14:05 --- STRACE: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\cupons\list.php(61): Kohana_ORM->__get('MAR_')
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\admin\application\views\template.php(216): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#10 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#13 {main}
2021-04-18 08:55:03 --- ERROR: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-18 08:55:03 --- STRACE: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\cupons\list.php(61): Kohana_ORM->__get('MAR_')
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\admin\application\views\template.php(216): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#10 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#13 {main}
2021-04-18 08:55:46 --- ERROR: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-18 08:55:46 --- STRACE: Kohana_Exception [ 0 ]: The MAR_ property does not exist in the Model_Marca class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\admin\application\views\cupons\list.php(61): Kohana_ORM->__get('MAR_')
#1 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\admin\application\views\template.php(216): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Cupons))
#10 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#13 {main}