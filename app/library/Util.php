<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9 0009
 * Time: 下午 4:04
 */

namespace lib;

class Util
{
    private static $config = null;

    /**
     * 获取配置
     * @param string $type 配置名
     * @return array|string|null
     */
    public static function getConfig( $type = '' )
    {
        if( self::$config == null)
        {
            self::$config = require PATH_ROOT.'config/config.php';
        }

        return isset(self::$config[$type]) ? self::$config[$type] : null;
    }

    /**
     * api通用模板
     *
     * @param int $status 是否成功
     * @param mixed $content 放回数据 status=1时为(array)message status=0是为(string)data
     * @return array
     */
    public static function apiRes($status = 1, $content)
    {
        if($status)
        {
            $jsonData = array(
                'state' => $status,
                'message' => '',
                'data' => $content
            );
        }
        else
        {
            $jsonData = array(
                'state' => $status,
                'message' => $content,
                'data' => array()
            );
        }

        return $jsonData;
    }

}