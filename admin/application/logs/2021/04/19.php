<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2021-04-19 22:16:59 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-19 22:16:59 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(3, 'UPDATE `CUPONS`...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1261): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->update(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(161): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-19 22:17:11 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-19 22:17:11 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(3, 'UPDATE `CUPONS`...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1261): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->update(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(161): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-19 22:18:26 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-19 22:18:26 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(3, 'UPDATE `CUPONS`...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1261): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->update(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(161): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-19 22:21:24 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-19 22:21:24 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(3, 'UPDATE `CUPONS`...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1261): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->update(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(161): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}
2021-04-19 22:24:45 --- ERROR: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
2021-04-19 22:24:45 --- STRACE: Database_Exception [ 1452 ]: Cannot add or update a child row: a foreign key constraint fails (`loja`.`cupons`, CONSTRAINT `CUPONS_ibfk_1` FOREIGN KEY (`MAR_ID`) REFERENCES `MARCA` (`MAR_ID`)) [ UPDATE `CUPONS` SET `CUP_CODIGO` = 'CUPOM11', `MAR_ID` = '', `CAT_ID` = '' WHERE `CUP_ID` = '2' ] ~ MODPATH\database\classes\database\mysqli.php [ 174 ]
--
#0 C:\xampp\htdocs\loja\admin\modules\database\classes\kohana\database\query.php(245): Database_MySQLi->query(3, 'UPDATE `CUPONS`...', false, Array)
#1 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1261): Kohana_Database_Query->execute(Object(Database_MySQLi))
#2 C:\xampp\htdocs\loja\admin\modules\orm\classes\kohana\orm.php(1287): Kohana_ORM->update(NULL)
#3 C:\xampp\htdocs\loja\admin\application\classes\controller\cupons.php(162): Kohana_ORM->save()
#4 [internal function]: Controller_Cupons->action_save()
#5 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Cupons))
#6 C:\xampp\htdocs\loja\admin\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 C:\xampp\htdocs\loja\admin\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#8 C:\xampp\htdocs\loja\admin\index.php(109): Kohana_Request->execute()
#9 {main}