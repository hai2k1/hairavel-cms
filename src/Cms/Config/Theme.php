<?php

return [
    'title' => env('THEME_TITLE', 'HaiBase CMS'),
    'keyword' => env('THEME_KEYWORD', 'HaiBase,HaiPHP,Laravel'),
    'description' => env('THEME_DESCRIPTION', ''),

    'default' => env(
        'THEME_DEFAULT',
        'default'
    ),

    'mobile' => env(
        'THEME_MOBILE',
        'default'
    )
];
