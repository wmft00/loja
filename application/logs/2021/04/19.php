<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2021-04-19 14:00:32 --- ERROR: ErrorException [ 1 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ APPPATH\classes\controller\index.php [ 45 ]
2021-04-19 14:00:32 --- STRACE: ErrorException [ 1 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ APPPATH\classes\controller\index.php [ 45 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2021-04-19 14:01:08 --- ERROR: ErrorException [ 1 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ APPPATH\classes\controller\index.php [ 45 ]
2021-04-19 14:01:08 --- STRACE: ErrorException [ 1 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ APPPATH\classes\controller\index.php [ 45 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2021-04-19 14:04:20 --- ERROR: ErrorException [ 1 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ APPPATH\classes\controller\index.php [ 45 ]
2021-04-19 14:04:20 --- STRACE: ErrorException [ 1 ]: Call to undefined method Controller_Index::ddmmaaaa_aaaammdd() ~ APPPATH\classes\controller\index.php [ 45 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2021-04-19 14:05:00 --- ERROR: ErrorException [ 1 ]: Class 'Model_Carrinhos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-19 14:05:00 --- STRACE: ErrorException [ 1 ]: Class 'Model_Carrinhos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2021-04-19 14:06:02 --- ERROR: Database_Exception [ 1005 ]: Can't create table `loja`.`carrinhos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS CARRINHOS (
            CAR_SESSAO varchar(32) NOT NULL,
            PRO_ID int(11) unsigned NOT NULL,
            CAR_QUANTIDADE int(10) unsigned NOT NULL,
            CAR_VALOR_ITEM decimal(10,2) NOT NULL,
            CAR_TOTAL decimal(10,2) NOT NULL,
            CAR_DATA date NOT NULL,
            CAR_FRETE decimal(10,2) NOT NULL default '0.00',
            CAR_TIPOFRETE varchar(10) NOT NULL default 'PAC',
            CAR_AVISADO set('S','N') NOT NULL default 'N',
            CAR_CEP varchar(9) NOT NULL default '00000-000',
            FOP_ID int(11) unsigned NOT NULL default '2',
            COP_ID int(11) unsigned NOT NULL default '50',
            PRIMARY KEY  (CAR_SESSAO,PRO_ID),
            CONSTRAINT fk_carrinhospro FOREIGN KEY (PRO_ID) REFERENCES PRODUTOS(PRO_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            CONSTRAINT fk_carrinhosfop FOREIGN KEY (FOP_ID) REFERENCES FORMAS_PAGAMENTOS(FOP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            CONSTRAINT fk_carrinhoscop FOREIGN KEY (COP_ID) REFERENCES CONDICOES_PAGAMENTO(COP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-19 14:06:02 --- STRACE: Database_Exception [ 1005 ]: Can't create table `loja`.`carrinhos` (errno: 150 "Foreign key constraint is incorrectly formed") [ CREATE TABLE IF NOT EXISTS CARRINHOS (
            CAR_SESSAO varchar(32) NOT NULL,
            PRO_ID int(11) unsigned NOT NULL,
            CAR_QUANTIDADE int(10) unsigned NOT NULL,
            CAR_VALOR_ITEM decimal(10,2) NOT NULL,
            CAR_TOTAL decimal(10,2) NOT NULL,
            CAR_DATA date NOT NULL,
            CAR_FRETE decimal(10,2) NOT NULL default '0.00',
            CAR_TIPOFRETE varchar(10) NOT NULL default 'PAC',
            CAR_AVISADO set('S','N') NOT NULL default 'N',
            CAR_CEP varchar(9) NOT NULL default '00000-000',
            FOP_ID int(11) unsigned NOT NULL default '2',
            COP_ID int(11) unsigned NOT NULL default '50',
            PRIMARY KEY  (CAR_SESSAO,PRO_ID),
            CONSTRAINT fk_carrinhospro FOREIGN KEY (PRO_ID) REFERENCES PRODUTOS(PRO_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            CONSTRAINT fk_carrinhosfop FOREIGN KEY (FOP_ID) REFERENCES FORMAS_PAGAMENTOS(FOP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            CONSTRAINT fk_carrinhoscop FOREIGN KEY (COP_ID) REFERENCES CONDICOES_PAGAMENTO(COP_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1; ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\application\classes\model\carrinhos.php(90): Database_MySQLi->query(2, 'CREATE TABLE IF...')
#1 C:\xampp\htdocs\loja\modules\orm\classes\kohana\orm.php(39): Model_Carrinhos->__construct(NULL)
#2 C:\xampp\htdocs\loja\application\classes\controller\index.php(46): Kohana_ORM::factory('carrinhos')
#3 [internal function]: Controller_Index->before()
#4 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(104): ReflectionMethod->invoke(Object(Controller_Index))
#5 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-19 19:31:39 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-19 19:31:39 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-19 19:32:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-19 19:32:36 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-19 19:34:38 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-19 19:34:38 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-19 19:34:48 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-19 19:34:48 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-19 19:36:15 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-19 19:36:15 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: favicon.png ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-19 22:45:18 --- ERROR: ErrorException [ 1 ]: Uncaught TypeError: Argument 1 passed to Kohana_Kohana_Exception::handler() must be an instance of Exception, instance of Error given in C:\xampp\htdocs\loja\system\classes\kohana\kohana\exception.php:88
Stack trace:
#0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main}
  thrown ~ SYSPATH\classes\kohana\kohana\exception.php [ 88 ]
2021-04-19 22:45:18 --- STRACE: ErrorException [ 1 ]: Uncaught TypeError: Argument 1 passed to Kohana_Kohana_Exception::handler() must be an instance of Exception, instance of Error given in C:\xampp\htdocs\loja\system\classes\kohana\kohana\exception.php:88
Stack trace:
#0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main}
  thrown ~ SYSPATH\classes\kohana\kohana\exception.php [ 88 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2021-04-19 22:47:43 --- ERROR: Error [ 0 ]: Class 'Model_Cupom' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
2021-04-19 22:47:43 --- STRACE: Error [ 0 ]: Class 'Model_Cupom' not found ~ MODPATH\orm\classes\kohana\orm.php [ 39 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\ajax.php(19): Kohana_ORM::factory('Model_Cupom')
#1 [internal function]: Controller_Ajax->action_cupons()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Ajax))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-19 23:17:32 --- ERROR: Kohana_Exception [ 0 ]: The MAR_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-19 23:17:32 --- STRACE: Kohana_Exception [ 0 ]: The MAR_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\ajax.php(35): Kohana_ORM->__get('MAR_NOME')
#1 [internal function]: Controller_Ajax->action_cupons()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Ajax))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-19 23:17:49 --- ERROR: Kohana_Exception [ 0 ]: The MAR_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-19 23:17:49 --- STRACE: Kohana_Exception [ 0 ]: The MAR_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\ajax.php(35): Kohana_ORM->__get('MAR_NOME')
#1 [internal function]: Controller_Ajax->action_cupons()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Ajax))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-19 23:18:13 --- ERROR: Kohana_Exception [ 0 ]: The MAR_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-19 23:18:13 --- STRACE: Kohana_Exception [ 0 ]: The MAR_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\ajax.php(35): Kohana_ORM->__get('MAR_NOME')
#1 [internal function]: Controller_Ajax->action_cupons()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Ajax))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}