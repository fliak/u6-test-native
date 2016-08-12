<?php

$basePath = dirname(__DIR__);

define('BASE_PATH', $basePath);

require_once BASE_PATH . '/autoload.php';

$config = new \App\Config\Config();
$config->load(BASE_PATH . '/app/config/config.php');



$appBuilder = new \App\Builder();
$appBuilder->build();


$routes = [
    'menu' => [
        'route' => '/\/menu/',
        'method' => 'GET',
        'controller' => \App\Controller\MenuController::class,
        'action' => 'index'
    ],
    'data' => [
        'route' => '/\/data/',
        'method' => 'GET',
        'controller' => \App\Controller\DataController::class,
        'action' => 'get'
    ],
    'save-data' => [
        'route' => '/\/data/',
        'method' => 'POST',
        'controller' => \App\Controller\DataController::class,
        'action' => 'post'
    ],
    'login-check' => [
        'route' => '/\/login-check/',
        'method' => 'GET',
        'controller' => \App\Controller\AuthController::class,
        'action' => 'check'
    ],
    'login' => [
        'route' => '/\/login/',
        'method' => 'POST',
        'controller' => \App\Controller\AuthController::class,
        'action' => 'login'
    ],
    'logout' => [
        'route' => '/\/logout/',
        'method' => 'POST',
        'controller' => \App\Controller\AuthController::class,
        'action' => 'logout'
    ],
    '404' => [
        'controller' => function($request)  {
            return new \App\Http\Response('Resource missing', 404);
        }
    ]
];
//echo '<pre>';
//var_dump($_SERVER);exit;


$requestURI = $_SERVER['REQUEST_URI'];


$match = null;
foreach ($routes as $routeName => $routeOptions) {
    if (!array_key_exists('route', $routeOptions)) continue;

    $routeRegex = $routeOptions['route'];

    if (preg_match($routeRegex, $requestURI) !== 1) continue;

    if (array_key_exists('method', $routeOptions)) {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], $routeOptions['method']) !== 0)  {
            continue;
        }
    }

    $match = $routeName;

    break;
}

if (!$match)    {
    $match = '404';
}


$request = new \App\Http\Request($requestURI, $_SERVER['REQUEST_METHOD'], [
    'server' => $_SERVER,
    'get' => $_GET,
    'post' => $_POST,
    'matchedRoute' => $match
]);

$route = $routes[$match];

$controller = $route['controller'];
if (is_callable($controller))   {
    $response = $controller($request);
}
elseif (is_string($controller))    {
    /**
     * @var \App\Controller\AbstractController $controllerObject
     */
    $controllerObject = new $controller;
    $controllerObject->setAppBuilder($appBuilder);

    $action = 'indexAction';
    if (array_key_exists('action', $route)) {
        $action = $route['action'] . 'Action';
    }

    $response = $controllerObject->$action($request);
}

$response->send();