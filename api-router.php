<?php
require_once './libs/Router.php';
require_once './app/controllers/Instrumento-api.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('Instrumentos', 'GET', 'InstrumentoApiController', 'getInstrumentos');
$router->addRoute('Instrumento/:ID', 'GET', 'InstrumentoApiController', 'getInstrumento');
$router->addRoute('Instrumento/:ID', 'DELETE', 'InstrumentoApiController', 'deleteInstrumento');
$router->addRoute('Instrumento', 'POST', 'InstrumentoApiController', 'insertInstrumento');
$router->addRoute('Instrumento/:ID','PUT', 'InstrumentoApiController','ModInstrumento'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);