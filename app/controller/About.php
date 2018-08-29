<?php

namespace ctl;

class About
{
    public static function index()
    {
        \Flight::render('about', array('name' => 'xlaobai'));
    }
}