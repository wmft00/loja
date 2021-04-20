<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2021-04-20 00:05:16 --- ERROR: View_Exception [ 0 ]: The requested view produto could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2021-04-20 00:05:16 --- STRACE: View_Exception [ 0 ]: The requested view produto could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
--
#0 C:\xampp\htdocs\loja\system\classes\kohana\view.php(137): Kohana_View->set_filename('produto')
#1 C:\xampp\htdocs\loja\system\classes\kohana\view.php(30): Kohana_View->__construct('produto', NULL)
#2 C:\xampp\htdocs\loja\application\classes\controller\produtos.php(18): Kohana_View::factory('produto')
#3 [internal function]: Controller_Produtos->action_detalhes()
#4 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-20 00:05:23 --- ERROR: View_Exception [ 0 ]: The requested view produto could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2021-04-20 00:05:23 --- STRACE: View_Exception [ 0 ]: The requested view produto could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
--
#0 C:\xampp\htdocs\loja\system\classes\kohana\view.php(137): Kohana_View->set_filename('produto')
#1 C:\xampp\htdocs\loja\system\classes\kohana\view.php(30): Kohana_View->__construct('produto', NULL)
#2 C:\xampp\htdocs\loja\application\classes\controller\produtos.php(18): Kohana_View::factory('produto')
#3 [internal function]: Controller_Produtos->action_detalhes()
#4 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#5 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#7 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#8 {main}
2021-04-20 00:05:34 --- ERROR: Kohana_Exception [ 0 ]: The PRO_TITULO property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-20 00:05:34 --- STRACE: Kohana_Exception [ 0 ]: The PRO_TITULO property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\produtos.php(30): Kohana_ORM->__get('PRO_TITULO')
#1 [internal function]: Controller_Produtos->action_detalhes()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-20 00:05:40 --- ERROR: Kohana_Exception [ 0 ]: The PRO_TITULO property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-20 00:05:40 --- STRACE: Kohana_Exception [ 0 ]: The PRO_TITULO property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\produtos.php(30): Kohana_ORM->__get('PRO_TITULO')
#1 [internal function]: Controller_Produtos->action_detalhes()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Produtos))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}
2021-04-20 00:19:53 --- ERROR: Kohana_Exception [ 0 ]: The PRO_TITULO property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-20 00:19:53 --- STRACE: Kohana_Exception [ 0 ]: The PRO_TITULO property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\views\produto.php(14): Kohana_ORM->__get('PRO_TITULO')
#1 C:\xampp\htdocs\loja\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\application\views\template.php(41): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Produtos))
#10 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#13 {main}
2021-04-20 00:22:42 --- ERROR: Kohana_Exception [ 0 ]: The PRO_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-20 00:22:42 --- STRACE: Kohana_Exception [ 0 ]: The PRO_NOME property does not exist in the Model_Categoria class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\views\produto.php(18): Kohana_ORM->__get('PRO_NOME')
#1 C:\xampp\htdocs\loja\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\loja\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#3 C:\xampp\htdocs\loja\system\classes\kohana\view.php(228): Kohana_View->render()
#4 C:\xampp\htdocs\loja\application\views\template.php(41): Kohana_View->__toString()
#5 C:\xampp\htdocs\loja\system\classes\kohana\view.php(61): include('C:\\xampp\\htdocs...')
#6 C:\xampp\htdocs\loja\system\classes\kohana\view.php(343): Kohana_View::capture('C:\\xampp\\htdocs...', Array)
#7 C:\xampp\htdocs\loja\system\classes\kohana\controller\template.php(44): Kohana_View->render()
#8 [internal function]: Kohana_Controller_Template->after()
#9 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(121): ReflectionMethod->invoke(Object(Controller_Produtos))
#10 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#12 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#13 {main}
2021-04-20 01:13:24 --- ERROR: Error [ 0 ]: Call to undefined method stdClass::save() ~ APPPATH\classes\controller\ajax.php [ 87 ]
2021-04-20 01:13:24 --- STRACE: Error [ 0 ]: Call to undefined method stdClass::save() ~ APPPATH\classes\controller\ajax.php [ 87 ]
--
#0 [internal function]: Controller_Ajax->action_carrinho()
#1 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Ajax))
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#4 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#5 {main}
2021-04-20 01:13:32 --- ERROR: Error [ 0 ]: Call to undefined method stdClass::save() ~ APPPATH\classes\controller\ajax.php [ 87 ]
2021-04-20 01:13:32 --- STRACE: Error [ 0 ]: Call to undefined method stdClass::save() ~ APPPATH\classes\controller\ajax.php [ 87 ]
--
#0 [internal function]: Controller_Ajax->action_carrinho()
#1 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Ajax))
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#4 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#5 {main}
2021-04-20 02:07:17 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-20 02:07:17 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-20 02:08:15 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-20 02:08:15 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-20 02:09:12 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-20 02:09:12 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-20 02:09:34 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-20 02:09:34 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-20 02:09:41 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-20 02:09:41 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-20 02:09:57 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
2021-04-20 02:09:57 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: imagens/layout/checkout/produto-sugestao.jpg ~ SYSPATH\classes\kohana\request.php [ 1142 ]
--
#0 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#1 {main}
2021-04-20 02:44:43 --- ERROR: Kohana_Exception [ 0 ]: The PRO_VALOR property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
2021-04-20 02:44:43 --- STRACE: Kohana_Exception [ 0 ]: The PRO_VALOR property does not exist in the Model_Produtos class ~ MODPATH\orm\classes\kohana\orm.php [ 573 ]
--
#0 C:\xampp\htdocs\loja\application\classes\controller\carrinho.php(68): Kohana_ORM->__get('PRO_VALOR')
#1 [internal function]: Controller_Carrinho->action_inserir()
#2 C:\xampp\htdocs\loja\system\classes\kohana\request\client\internal.php(118): ReflectionMethod->invoke(Object(Controller_Carrinho))
#3 C:\xampp\htdocs\loja\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 C:\xampp\htdocs\loja\system\classes\kohana\request.php(1154): Kohana_Request_Client->execute(Object(Request))
#5 C:\xampp\htdocs\loja\index.php(109): Kohana_Request->execute()
#6 {main}