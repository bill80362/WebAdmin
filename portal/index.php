<?php

//載入Composer套件
include __DIR__."/../config/config_inc.php";

session_start();

//路由套件:https://github.com/nikic/FastRoute
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    //登入
    $r->addRoute('GET', '/', 'ControllerAdminLogin@login');
    $r->addRoute('POST', '/login', 'ControllerAdminLogin@loginData');

    //我的帳戶
    $r->addRoute('GET', '/my', 'ControllerMy@get');

    //會員管理
    $r->addRoute('GET', '/user/list', 'ControllerUser@list');
    $r->addRoute('GET', '/user/new', 'ControllerUser@new');
    $r->addRoute('POST', '/user/data', 'ControllerUser@getDataList');

    $r->addRoute('GET', '/user/update/{id:\d+}', 'ControllerUser@getData');
    $r->addRoute('POST', '/user/update/', 'ControllerUser@updateData');

    //訂單管理
    $r->addRoute('GET', '/order/list', 'ControllerOrder@list');
    $r->addRoute('GET', '/order/new', 'ControllerOrder@new');
    $r->addRoute('GET', '/order/update', 'ControllerOrder@update');
    $r->addRoute('GET', '/order/delete', 'ControllerOrder@delete');
    $r->addRoute('POST', '/order/data', 'ControllerOrder@getData');

    //Bonus報表
    $r->addRoute('GET', '/report', 'ControllerReport@report');
    $r->addRoute('POST', '/report/data', 'ControllerReport@reportData');

    //結算
    $r->addRoute('GET', '/report/make', 'ControllerReport@make');

    //
    $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {


    });




});

//路由套件設定區 START
if(true){
    // 從$_SERVER取路徑(URI)和方法
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    // 去除query string(?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);
    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    //讓OPTIONS通過
    if($httpMethod=="OPTIONS"){
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin:*");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header('Access-Control-Allow-Methods: PUT, PATCH, POST, GET, DELETE, OPTIONS');
        $_JSON['code']=200;
        $_JSON['msg']="OK";
        echo json_encode($_JSON);
        exit();
    }
    //CORS
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
    header('Access-Control-Allow-Methods: PUT, PATCH, POST, GET, DELETE, OPTIONS');
    //HTTP Cache
    header('Cache-Control: max-age=5');
    //分配路由狀態
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            //當uri路徑找不到
            header('Content-Type: application/json; charset=utf-8');
            header('HTTP/1.1 404 Not Found');
            $_JSON['code']=404;
            $_JSON['msg']="404 Not Found";
            echo json_encode($_JSON);
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // 當uri路徑找到，方法不對(GET POST PUT.....)
            header('Content-Type: application/json; charset=utf-8');
            header('HTTP/1.0 405 Method Not Allowed');
            $_JSON['code']=405;
            $_JSON['msg']="405 Method Not Allowed";
            echo json_encode($_JSON);
            break;
        case FastRoute\Dispatcher::FOUND:
            //路徑、方法都對了，執行Controller
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            //自定義$handler 第一個參數是 string class@method 第二個之後是$vars
            list($class, $method) = explode('@',$handler,2);
            $oMiddle = new Middleware();
            $obj = new $class($oMiddle);//類別進行物件化
            $obj->{$method}($vars);//傳入參數
            break;
    }
}
//路由套件設定區 END





