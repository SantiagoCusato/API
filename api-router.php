<?php
require_once './libs/Router.php';
require_once './app/controllers/Instrumento-api.controller.php';

$router = new Router();

$router->addRoute('Instrumentos', 'GET', 'InstrumentoApiController', 'getInstrumentos');
$router->addRoute('Instrumento/:ID', 'GET', 'InstrumentoApiController', 'getInstrumento');
$router->addRoute('Instrumento/:ID', 'DELETE', 'InstrumentoApiController', 'deleteInstrumento');
$router->addRoute('Instrumento', 'POST', 'InstrumentoApiController', 'insertInstrumento');
$router->addRoute('Instrumento/:ID','PUT', 'InstrumentoApiController','ModInstrumento'); 

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);