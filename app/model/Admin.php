<?php

namespace mod;

class Admin
{
    public static function findAdmin($cond = [])
    {
        $db = \lib\DB::init();
        $admin = $db -> select('admin', '*', $cond);

        return $admin;
    }

    public static function checkAdmin( $data = [] )
    {
        $admin = self::findAdmin([ "username" => $data['admin']]);

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

    public static function editAdmin()
    {

    }
}