<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Di sini Anda bisa mengkonfigurasi pengaturan untuk CORS.
    |
    */

    'paths' => ['*'], // <-- Mengizinkan semua path, termasuk /api/* dan /files/*

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'], // <-- Mengizinkan request dari semua origin (penting untuk development)

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];