<?php
/**
 * 路由文件
 * Created by PhpStorm.
 * User: xlaobai
 * Date: 2018/8/9 0009
 * Time: 下午 3:42
 */

/* 路由开始 */

Flight::route('GET /', ['\ctl\index', 'index']);
Flight::route('POST /api/login', ['\ctl\Admin', 'login']);
Flight::route('GET /share.html', ['\ctl\share', 'index']);
Flight::route('GET /list.html', ['\ctl\lists', 'index']);
Flight::route('GET /info.html', ['\ctl\info', 'index']);
Flight::route('GET /gbook.html', ['\ctl\gbook', 'index']);

/* 路由前置处理 */
Flight::before('start',function(&$params, &$output){
    /*暂时开启跨域允许*/
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT');
});

//异常处理
Flight::map('error', function(Exception $ex){
    //@todo 记录错误日志
    $logger = \lib\Log::init('error/day');
    $logger->error($ex);
});

//@todo 404处理
Flight::map('notFound', function(){
    exit('error request!');
});

