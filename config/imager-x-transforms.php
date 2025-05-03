<?php
return [
    'auto' => [
        'transforms' => [
            ['width' => 200],
            ['width' => 400],
            ['width' => 800],
            ['width' => 1600],
        ],
    ],
    '1:1' => [
        'transforms' => [
            ['width' => 200],
            ['width' => 400],
            ['width' => 800],
            ['width' => 1600],
        ],
        'defaults' => [
            'ratio' => 1,
        ],
    ],
    '34' => [
        'transforms' => [
            ['width' => 200],
            ['width' => 400],
            ['width' => 800],
            ['width' => 1600],
        ],
        'defaults' => [
            'ratio' => 3/4,
        ],
    ],
    '16 9' => [
        'transforms' => [
            ['width' => 200],
            ['width' => 400],
            ['width' => 800],
            ['width' => 1600],
        ],
        'defaults' => [
            'ratio' => 16/9,
        ],
    ],
    '2/3' => [
        'transforms' => [
            ['width' => 200],
            ['width' => 400],
            ['width' => 800],
            ['width' => 1600],
        ],
        'defaults' => [
            'ratio' => 2/3,
        ],
    ],
    'dominantColor' => [
        'transforms' => [
            ['width' => 50],
        ],
    ],
];
