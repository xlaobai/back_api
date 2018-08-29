<?php

namespace ctl;

class Gbook
{
    public static function index()
    {
        \Flight::render('gbook', array('name' => 'xlaobai'));
    }
}