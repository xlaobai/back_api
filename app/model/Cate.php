<?php

namespace mod;

class Cate
{
    public static function findCate($columes = '*' , $cond = [])
    {
        $db = \lib\DB::init();
        $cate = $db -> select('cate', $columes, $cond);

        return $cate;
    }


    public static function addCate($params)
    {
        $db = \lib\DB::init();
        $db -> insert("cate", $params);
        return $db -> id();
    }

    public static function editCate($params) {
        $id = [
            'id' => (string) $params['id']
        ];
        unset($params['id']);
        $db = \lib\DB::init();
        $data = $db -> update('cate', $params, $id);
        return $data ? $data -> rowCount() : false;
    }

    public static function delCate($id) {
        $db = \lib\DB::init();
        $rs = $db -> delete('cate', array('id' => $id));
        return $rs ? $rs->rowCount() : false;
    }
}