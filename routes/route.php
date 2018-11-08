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
Flight::route('GET /api/admin/lst', ['\ctl\Admin', 'lst']);
Flight::route('POST /api/admin/add', ['\ctl\Admin', 'add']);
Flight::route('POST /api/admin/edit', ['\ctl\Admin', 'edit']);
Flight::route('GET /api/admin/del', ['\ctl\Admin', 'del']);
Flight::route('GET /api/cate/lst', ['\ctl\cate', 'lst']);
Flight::route('POST /api/cate/add', ['\ctl\cate', 'add']);
Flight::route('POST /api/cate/edit', ['\ctl\cate', 'edit']);
Flight::route('GET /api/cate/del', ['\ctl\cate', 'del']);
Flight::route('GET /api/art/lst', ['\ctl\article', 'lst']);
Flight::route('POST /api/art/add', ['\ctl\article', 'add']);
Flight::route('POST /api/art/edit', ['\ctl\article', 'edit']);
Flight::route('GET /api/art/del', ['\ctl\article', 'del']);
Flight::route('POST /api/upload/file', ['\ctl\article', 'upload']);


/* 路由前置处理 */
Flight::before('start',function(&$params, &$output){
    /*暂时开启跨域允许*/
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT');

    /* 用户TOKEN验证*/
    $req = \Flight::request();
    if( $req -> url == '/api/login' ) {         // 初始登录方法无需验证
        return false;
    }

    if( $req -> query['user_id'] && $req -> query['token'] ) {              //这里只是使用token进行登录时效的验证
        $checkAuth = \lib\Util::checkToken($req -> query['user_id'], $req -> query['token']);           //自定义验证方法

        if($checkAuth) {
            return false;
        }
    }

    exit(\Flight::json(\lib\Util::apiRes(0, 'TOKENERROR')));
});

Flight::after('start', function (){
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

