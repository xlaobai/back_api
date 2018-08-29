<?php

namespace ctl;

class Share
{
    public static function index()
    {
        \Flight::render('share', array('name' => 'xlaobai'));
    }
}