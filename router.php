<?php
    require_once 'config.php';
    require_once 'libs/router.php';
    require_once 'controllers/apiCompanyController.php';
    require_once 'controllers/apiGameController.php';

    $router = new Router();

    #                 endpoint      verbo     controllers           método
$router->addRoute('games', 'GET', 'controller\ApiGameController', 'getGames');
$router->addRoute('companies', 'GET', 'controller\ApiCompanyController', 'getCompanies');
$router->addRoute('companies/:ID', 'GET', 'controller\ApiCompanyController', 'getCompany');
$router->addRoute('companies', 'POST', 'controller\ApiCompanyController' , 'createCompany');
$router->addRoute('companies/:ID', 'DELETE', 'controller\ApiCompanyController' , 'deleteCompany');
$router->addRoute('companies/:ID', 'PUT', 'controller\ApiCompanyController' , 'editCompany');
$router->addRoute('games/:ID', 'GET', 'controller\ApiGameController', 'getGame');
$router->addRoute('games-company/:ID', 'GET', 'controller\ApiGameController', 'getGamesByCompany');
$router->addRoute('games', 'POST', 'controller\ApiGameController' , 'createGame');
$router->addRoute('games/:ID', 'DELETE', 'controller\ApiGameController' , 'deleteGame');
$router->addRoute('games/:ID', 'PUT', 'controller\ApiGameController' , 'editGame');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);