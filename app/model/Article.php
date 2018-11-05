<?php

namespace mod;

class Article
{
    public static function findArt($columes = '*' , $cond = [])
    {
        $db = \lib\DB::init();
        $art = $db -> select('article', $columes, $cond);

        return $art;
    }


    public static function addArt($params)
    {
        $db = \lib\DB::init();
        $db -> insert("article", $params);
        return $db -> id();
    }

    public static function editArt($params) {
        $id = [
            'id' => (string) $params['id']
        ];
        unset($params['id']);
        $db = \lib\DB::init();
        $data = $db -> update('article', $params, $id);
        return $data ? $data -> rowCount() : false;
    }

    public static function delArt($id) {
        $db = \lib\DB::init();
        $pic = self::findArt('pic', array( 'id' => $id));
        if($pic) {
            $upload = PATH_ROOT . 'public/static/upload/';
            if(file_exists($upload . $pic[0])) {
                unlink($upload . $pic[0]);
            }
        }
        $rs = $db -> delete('article', array('id' => $id));
        return $rs ? $rs->rowCount() : false;
    }
}