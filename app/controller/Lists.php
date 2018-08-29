<?php

namespace ctl;

class Lists
{
    public static function index()
    {
        \Flight::render('list', array('name' => 'xlaobai'));
    }
}