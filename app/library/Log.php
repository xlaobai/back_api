<?php

namespace lib;

class Log
{
    public static $logger = array();

    //初始化日志方式
    public static function init( $logFile = 'web')
    {
        if( !isset(self::$logger[$logFile]))
        {
            $config = \lib\Util::getConfig('log');
            $logPath = $config['path'];
            $logger = new \Monolog\Logger($logFile);
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($logPath.$logFile.'.log'));
            $logger->pushHandler(new \Monolog\Handler\FirePHPHandler());
            self::$logger[$logFile] = $logger;
        } else {
            $logger = self::$logger[$logFile];
        }

        return $logger;
    }

}