<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    //"paths" => ["api/*", "sanctum/csrf-cookie"],
    "paths" => ["api/*", "msas_backend/public/api/*n", "http://176.31.107.205/msas_backend/public/api/", "http://176.31.107.205/api/"],

    "allowed_methods" => ["*"],

    "allowed_origins" => ["*"],

    "allowed_origins_patterns" => [],

    "allowed_headers" => ["*"],

    "exposed_headers" => [],

    "max_age" => 0,

    "supports_credentials" => false,

];
