<?php

use Phroute\Phroute\RouteCollector;
use App\Controllers\AuthController;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];
try {
    $router = new RouteCollector();


    // khu vực cần quan tâm -----------
    // bắt đầu định nghĩa ra các đường dẫn
    // $router->get('/', function () {
    //     return "trang chủ";
    // });



    // khu vực cần quan tâm -----------
    $router->any('/login', [AuthController::class, 'login']);
    $router->get('/logout', [AuthController::class, 'logout']);
    # NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

    // Print out the value returned from the dispatched function
    echo $response;
} catch (Exception $e) {
    var_dump($e->getMessage());
    die;
}
