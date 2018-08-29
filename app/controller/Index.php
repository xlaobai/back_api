<?php

namespace ctl;

class Index
{
    public static function index()
    {
        \Flight::json(\lib\Util::apiRes(1, array('name' => 'xlaobai')));
    }
}