<?php

return [
  // Attach the CORS filter to the application:
    'as corsFilter' => [
        'class' => \craft\filters\Cors::class,

      // CORS defaults for all non-CP requests:
        'cors' => [
            'Origin' => [
                'http://localhost:3000',
                'http://localhost:3002',
                'http://localhost:5173',
                'http://localhost:5174',
            ],
            'Access-Control-Request-Method' => ['GET', 'OPTIONS'],
            'Access-Control-Request-Headers' => ['*'],
            'Access-Control-Allow-Credentials' => true,
            'Access-Control-Max-Age' => 86400,
            'Access-Control-Expose-Headers' => [],
        ],
    ],
];
