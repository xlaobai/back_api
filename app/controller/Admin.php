<?php

namespace ctl;

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

    public static function lst() {
        $req = \Flight::request();

        if(true){
            $res = \mod\Admin::findAdmins(array('id', 'username', 'address'));
            return \Flight::json(\lib\Util::apiRes('1',$res));
        } else {
            return \Flight::json(\lib\Util::apiRes('0','TOKENERROR'));
        }

    }

    public static  function add() {
        $req = \Flight::request();
        $username = isset( $req -> data['username']) ? addslashes(trim($req -> data['username'])) : '';
        $address = isset( $req -> data['address'])? addslashes(trim($req -> data['address'])) : '';
        $password = isset( $req -> data['password']) ? (int) $req -> data['password'] : '';

        if(!$username){
            return \Flight::json(\lib\Util::apiRes('0','USERERROR'));
        }

        if(!$password){
            return \Flight::json(\lib\Util::apiRes('0','PSWDERROR'));
        }

        $admin = [
            'username' => $username
        ];

        $back = \mod\Admin::findAdmins('id', $admin);

        if( sizeof($back) > 0 ) {
            return \Flight::json(\lib\Util::apiRes('0', 'USERREPE'));
        }

        $data = [
            'username' => $username,
            'address' => $address,
            'password' => md5($password),
            'logintime' => time()
        ];

        if(true) {
            $res = \mod\Admin::addAdmin($data);

            if( isset($res) ) {
                return \Flight::json(\lib\Util::apiRes('1', []));
            } else {
                return \Flight::json(\lib\Util::apiRes('0', 'ADDERROR'));
            }

        }
    }

    public static  function edit() {
        $req = \Flight::request();

        $id = isset( $req -> data['id'] ) ? (int) $req -> data['id'] : '';
        $username = isset( $req -> data['username'] )? addslashes(trim( $req -> data['username'])) : '';
        $address = isset( $req -> data['address'] )? addslashes(trim( $req -> data['address'])) : '';
        $password = isset( $req -> data['password']) ? (int) $req -> data['password'] : '';

        if(!$id) {
            return \Flight::json(\lib\Util::apiRes('0'), 'IDERROR');
        }
        if(!$username){
            return \Flight::json(\lib\Util::apiRes('0','USERERROR'));
        }
        if(!$password){
            return \Flight::json(\lib\Util::apiRes('0','PSWDERROR'));
        }

        $data = [
            'id' => $id,
            'username' => $username,
            'address' => $address,
            'password' => $password
        ];

        $res = \mod\Admin::editAdmin($data);

        if( isset($res) ) { 
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'EDITERROR'));
        }
    }

    public static  function del() {
        $req = \Flight::request();
        $id = isset( $req -> query['id'] ) ? (int) $req -> query['id'] : '';

        $res = \mod\Admin::delAdmin($id);
        if( $res ) {
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'DELERROR'));
        }
    }

}