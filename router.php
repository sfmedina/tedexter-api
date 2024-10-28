<?php
require_once 'app/libs/router.php';

$router = new Router();

#                  endopoint, method,      controller,          action
$router->addRoute('client',    'GET', 'ClientApiController', 'getClients');
$router->addRoute('client',    'GET', 'ClientApiController', 'getClient');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);