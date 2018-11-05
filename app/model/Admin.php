<?php

namespace mod;

class Admin
{
    public static function findAdmin($columes = '*' , $cond = [])
    {
        $db = \lib\DB::init();
        $admin = $db -> select('admin', $columes, $cond);

        return $admin;
    }

    public static function checkAdmin( $data = [] )
    {
        $admin = self::findAdmin( '*',[ "username" => $data['admin']]);

        if( sizeof($admin) == 0 )
        {
            return 0;
        } else if ( md5( $data['password'] ) != $admin[0]['password'])
        {
            return -1;
        } else {
            return $admin[0]['id'];
        }
    }

    public static function addAdmin($params)
    {
        $db = \lib\DB::init();
        $db -> insert("admin", $params);
        return $db -> id();
    }

    public static function editAdmin($params) {
        $id = [
            'id' => (string) $params['id']
        ];
        unset($params['id']);
        $db = \lib\DB::init();
        $data = $db -> update('admin', $params, $id);
        return $data ? $data -> rowCount() : false;
    }

    public static function delAdmin($id) {
        $db = \lib\DB::init();
        $rs = $db -> delete('admin', array('id' => $id));
        return $rs ? $rs->rowCount() : false;
    }
}