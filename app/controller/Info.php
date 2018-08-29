<?php

namespace ctl;

class Info
{
    public static function index()
    {
        \Flight::render('info', array('name' => 'xlaobai'));
    }
}