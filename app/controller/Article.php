<?php

namespace ctl;

class Article
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
        $res = \mod\Article::findArt('*', $data);
        return \Flight::json(\lib\Util::apiRes('1',$res));

    }

    public static  function add() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $cateid = isset( $req -> data['cateid'] ) ? (int) $req -> data['cateid'] : 0 ;
        if(!$cateid){
            return \Flight::json(\lib\Util::apiRes('0','CATERROR'));
        }
        $data = [
            'title' => isset( $req -> data['title']) ? addslashes(trim($req -> data['title'])) : '',
            'desc' => isset( $req -> data['desc']) ? addslashes(trim($req -> data['desc'])) : '',
            'content' => isset( $req -> data['content']) ? $req -> data['desc'] : '',
            'author' => isset( $req -> data['author']) ? $req -> data['author'] : 'stranger',
            'state' => $req -> data['state'] == 1  ? 1 : 0,
            'cateid' => $cateid,
            'time' => time()
        ];
        $keywords = isset( $req -> data['keywords'] ) ? trim($req -> data['keywords']) : '';
        if($keywords) {
            $data['keywords'] = str_replace('，', ',', $keywords);
            $data['keywords'] = str_replace(' ', '', $data['keywords']);
        }
        $pic = isset( $req -> data['pic']) ? $req -> data['pic'] : '';
        if($pic) {
            $satic = PATH_ROOT . 'public/static/';
            if(file_exists($satic . "temp/" . $pic)) {
                $picArr = explode('/', $pic);
                $dir = iconv("UTF-8", "GBK", $satic . "upload/" . $picArr[0]);
                if( !file_exists($dir) ) {
                    mkdir($dir, 0777, true);
                }
                rename($satic . "temp/" . $pic , $satic . "upload/" . $pic);
                $data['pic'] = $pic;
            }
        }

        $res = \mod\Article::addArt($data);

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
        $cateid = isset( $req -> data['cateid'] ) ? (int) $req -> data['cateid'] : 0 ;

        if(!$id) {
            return \Flight::json(\lib\Util::apiRes('0'), 'IDERROR');
        }

        if(!$cateid){
            return \Flight::json(\lib\Util::apiRes('0','CATERROR'));
        }

        $data = [
            'id' => $id,
            'title' => isset( $req -> data['title']) ? addslashes(trim($req -> data['title'])) : '',
            'desc' => isset( $req -> data['desc']) ? addslashes(trim($req -> data['desc'])) : '',
            'content' => isset( $req -> data['content']) ? $req -> data['desc'] : '',
            'author' => isset( $req -> data['author']) ? $req -> data['author'] : 'stranger',
            'state' => $req -> data['state'] == 1  ? 1 : 0,
            'cateid' => $cateid,
            'time' => time()
        ];

        $keywords = isset( $req -> data['keywords'] ) ? trim($req -> data['keywords']) : '';
        if($keywords) {
            $data['keywords'] = str_replace('，', ',', $keywords);
            $data['keywords'] = str_replace(' ', '', $data['keywords']);
        }

        $pic = isset( $req -> data['pic']) ? $req -> data['pic'] : '';
        if($pic) {
            $satic = PATH_ROOT . 'public/static/';
            if(file_exists($satic . "temp/" . $pic)) {
                $picArr = explode('/', $pic);
                $dir = iconv("UTF-8", "GBK", $satic . "upload/" . $picArr[0]);
                if( !file_exists($dir) ) {
                    mkdir($dir, 0777, true);
                }
                rename($satic . "temp/" . $pic , $satic . "upload/" . $pic);
                $data['pic'] = $pic;
            }
        }

        $res = \mod\Article::editArt($data);

        if( isset($res) ) {
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'ADDERROR'));
        }
    }

    public static  function del() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $id = isset( $req -> query['id'] ) ? (int) $req -> query['id'] : '';

        $res = \mod\Article::delArt($id);
        if( $res ) {
            return \Flight::json(\lib\Util::apiRes('1', []));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'DELERROR'));
        }
    }

    public static function upload() {
        $req = \Flight::request();
        if( isset($req->query['auto']) ) {
            return \Flight::json(\lib\Util::apiRes(0,'AUTO_ERROR'));
        }
        $pic = $req -> files['pic'];
        if( isset($pic) ) {
            $dateFile = date("Ymd");
            $dir = iconv("UTF-8", "GBK", PATH_ROOT . 'public/static/temp/' . $dateFile);
            if( !file_exists($dir) ) {
                mkdir ($dir, 0777, true);
            }
            $nameArr = explode('.', $pic["name"]);
            $picUrl = $dateFile . "/" . md5($pic["name"]) . "." . $nameArr[sizeof($nameArr)-1];
            move_uploaded_file($pic["tmp_name"], PATH_ROOT . 'public/static/temp/' . $picUrl);
                return \Flight::json(\lib\Util::apiRes('1', [
                'pic' => $picUrl
            ]));
        } else {
            return \Flight::json(\lib\Util::apiRes('0', 'EXITERROR'));
        }
    }
}