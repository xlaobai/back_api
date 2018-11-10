<?php

namespace ctl;

class Cate
{
    public static function lst() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $data = [];
        if( isset($req -> query['id']) ) {
            $data['id'] = $req -> query['id'];
        }
        $res = \mod\Cate::findCate(array('id', 'catename'), $data);
        return \Flight::json(\lib\Util::apiRes('1',$res));

    }

    public static  function add() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $catename = isset( $req -> data['catename']) ? addslashes(trim($req -> data['catename'])) : '';;

        if(!$catename){
            return \Flight::json(\lib\Util::apiRes('0','CATERROR'));
        }

        $cate = [
            'catename' => $catename
        ];

        $back = \mod\Cate::findCate('id', $cate);

        if( sizeof($back) > 0 ) {
            return \Flight::json(\lib\Util::apiRes('0', 'CATEREPE'));
        }

        $data = [
            'catename' => $catename,
        ];
        $res = \mod\Cate::addCate($data);

        if( isset($res) ) {
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'ADDERROR'));
        }

    }

    public static  function edit() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $id = isset( $req -> data['id'] ) ? (int) $req -> data['id'] : '';
        $catename = isset( $req -> data['catename'] )? addslashes(trim( $req -> data['catename'])) : '';

        if(!$id) {
            return \Flight::json(\lib\Util::apiRes('0'), 'IDERROR');
        }
        if(!$catename){
            return \Flight::json(\lib\Util::apiRes('0','CATERROR'));
        }

        $data = [
            'id' => $id,
            'catename' => $catename
        ];

        $res = \mod\Cate::editCate($data);

        if( isset($res) ) {
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'EDITERROR'));
        }
    }

    public static  function del() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $id = isset( $req -> query['id'] ) ? (int) $req -> query['id'] : '';

        $res = \mod\Cate::delCate($id);
        if( $res ) {
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'DELERROR'));
        }
    }

}