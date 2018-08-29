<?php

namespace lib;

class DB
{
    private static $database = null;
    //初始化sql方式
    public static function init()
    {
        if( self::$database == null ) {
            $config = \lib\Util::getConfig('db');
            self::$database = new \Medoo\Medoo($config);
        }

        return self::$database;
    }

    public static function close()
    {
        if( self::$database)
        {
            self::$database = null;
        }
    }
}