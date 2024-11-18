<?php
require_once './app/libs/router.php';
require_once './app/controllers/api.Client.Controller.php';
require_once './app/controllers/api.Order.Controller.php';
require_once './config.php';

$router = new Router();

#                  endopoint,      method,      controller,             action
$router->addRoute('clients',                 'GET',    'ClientApiController',     'getClients');
$router->addRoute('clients/:id',              'GET',    'ClientApiController',     'getClient');
$router->addRoute('orders',                   'GET',    'OrderApiController',      'getOrders');
$router->addRoute('orders/:id',               'GET',    'OrderApiController',      'getOrder');
$router->addRoute('orders/:id',               'DELETE', 'OrderApiController',      'deleteOrder');
$router->addRoute('orders/',                  'POST',   'OrderApiController',      'createOrder');
$router->addRoute('orders/:id',               'PUT',    'OrderApiController',      'updateOrder');
$router->addRoute('orders/:id/id_client',     'GET',    'OrderApiController',      'getOrder');





 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);