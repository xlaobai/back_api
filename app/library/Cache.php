<?php

namespace lib;

class Cache
{
    public static $connect = [];

    //初始化缓存方式
    public static function init($type = null)
    {
        $cacheConfig = \lib\Util::getConfig('cache');
        if( $type === null)
        {
            $type = $cacheConfig['cache_type'];
        }

        if( !isset(self::$connect[$type]))
        {
            switch ($type)
            {
                case 'file';
                    $adapter = new \Desarrolla2\Cache\Adapter\File($config[$type]['path'].$config['cache_prefix'].'/');
                    break;
                case 'redis':
                    if ( ! class_exists('\Predis\Client') )
                    {
                        exit('The predis library is not available.');
                    }
                    $backend = new \Predis\Client($cacheConfig[$type]);
                    $adapter = new \Desarrolla2\Cache\Adapter\Predis($backend);
                    $adapter->setOption('prefix', $cacheConfig['cache_prefix'].'_');
                    break;
                default:
                    $adapter = new \Desarrolla2\Cache\Adapter\NotCache();
                    break;
            }
            $connect = self::$connect[$type] = new \Desarrolla2\Cache\Cache($adapter);
        }
        else
        {
            $connect = self::$connect[$type];
        }

        return $connect;
    }

    public static function close($type=null)
    {
        $cacheConfig = Util::getConfig('cache');
        if ($type===null)
        {
            $type = $cacheConfig['cache_type'];
        }

        if(isset(self::$connect[$type]))
        {
            self::$connect[$type] = null;
        }
    }
}