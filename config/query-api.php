<?php

return [
    '*' => [
        'cacheDuration' => 69420,
        'assetTransforms' => [
            'portrait' => [
                'srcset' => ['100w', '200w'],
                'generateOnSaveVolumes' => ['graphics']
            ],
            'landscape' => [
                'srcset' => ['0.5x', '1x'],
                'generateOnSaveVolumes' => true,
            ],
        ],
    ],

    'dev' => [
        'cacheDuration' => 0,
    ],
];
