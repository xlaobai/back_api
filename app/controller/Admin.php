<?php

namespace ctl;

use lib\Cache;

class Admin
{
    public static function login()
    {
        $req = \Flight::request();

        $data['admin'] = isset( $req -> data['admin']) ? addslashes(trim($req -> data['admin'])) : '';
        $data['password'] = isset( $req -> data['password']) ? addslashes(trim($req -> data['password'])) : '';

        if( !$data['admin'] )
        {
            return \Flight::json(\lib\Util::apiRes(0, 'ADMIN_ERROR'));
        }

        if( !$data['password'] )
        {
            return \Flight::json(\lib\Util::apiRes(0,'PASSWD_ERROR'));
        }

        $adminId = \mod\Admin::checkAdmin( $data );

        if($adminId > 0)
        {
            //生成token并存储
            $token = md5("$adminId");
            $cache = \lib\Cache::init('redis');
            $cache -> set("$adminId", $token ,60*10);
            return \Flight::json(\lib\Util::apiRes(1,array(
                'id' => $adminId,
                'token' => $token
            )));
        }
        else
        {
            return \Flight::json(\lib\Util::apiRes(0,'LOGIN_ERROR'));
        }
    }
}