<?php
/**
 * Created by PhpStorm.
 * User: xlaobai
 * Date: 2018/8/9 0009
 * Time: 下午 3:42
 */

//时区
date_default_timezone_set('Asia/Shanghai');

//根目录
define('PATH_ROOT', realpath(dirname(__DIR__)).'/');

//Composer   并加装composer.json文件，定义部分命名空间
require PATH_ROOT.'vendor/autoload.php';

//加装flight配置文件
$config = \lib\Util::getConfig('flight');

if( $config )
{
   foreach ( $config as $key => $value )
   {
       Flight::set("flight.{$key}", $value);
   }
}

//加装路由
require '../routes/route.php';

//框架启动
Flight::start();
