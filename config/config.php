<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9 0009
 * Time: 下午 4:04
 */

return [
    'flight' => [
        'base_url'          => null,
        'case_sensitive'    => false,
        'handle_errors'     => true,
        'log_errors'        => true,
        'views.path'        => PATH_ROOT.'app/view',
        'views.extension'   => '.php',
    ],
    'pageName' => [
        'index',
        'about',
        'gbook',
        'info',
        'list',
        'share',
    ],
    'db'    =>  [
        'database_type'     => 'mysql',
        'server'            => '127.0.0.1',
        'database_name'     => 'php5',
        'username'          => 'root',
        'password'          => 'Lsx960202',
        'charset'           => 'utf8mb4',
        'prefix'            => 'tp_'
    ],
    'log'   =>  [
        'path'  =>  PATH_ROOT.'storage/log/'
    ],
    'cache' =>  [
        'cache_type'    =>  'file',
        'cache_prefix'  =>  'blog',
        'file'          =>  [
            'path'          =>  PATH_ROOT.'storage/cache/',
        ],
        'redis'         =>  [
            'scheme'        =>  'tcp',
            'host'          =>  '127.0.0.1',
            'port'          =>  6379,
        ],
        'url'   =>  [
            'site'      =>  'http://test.xtlqhb.com',
            'static'    =>  'http://test.xtlqhb.com',
            'cookie'    =>  'http://test.xtlqhb.com',
        ]
    ]
];