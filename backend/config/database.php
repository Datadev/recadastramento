<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 5432),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => env('DB_PREFIX', ''),
            'schema' => env('DB_SCHEMA', 'public'),
            'sslmode' => env('DB_SSL_MODE', 'prefer'),
        ],
        
        'ecidade' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST_ECIDADE', '127.0.0.1'),
            'port' => env('DB_PORT_ECIDADE', 5432),
            'database' => env('APP_ENV') !== 'production' ? env('DB_DATABASE_ECIDADE', 'forge') . date('Ymd', strtotime("-1 days")) . '_2200' : env('DB_DATABASE_ECIDADE', 'forge'),
            'username' => env('DB_USERNAME_ECIDADE', 'forge'),
            'password' => env('DB_PASSWORD_ECIDADE', ''),
            'charset' => env('DB_CHARSET_ECIDADE', 'utf8'),
            'prefix' => env('DB_PREFIX_ECIDADE', ''),
            'schema' => env('DB_SCHEMA_ECIDADE', 'public'),
            'sslmode' => env('DB_SSL_MODE_ECIDADE', 'prefer'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

//    'redis' => [
//
//        'client' => env('REDIS_CLIENT', 'phpredis'),
//
//        'options' => [
//            'cluster' => env('REDIS_CLUSTER', 'redis'),
//            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'lumen'), '_').'_database_'),
//        ],
//
//        'default' => [
//            'url' => env('REDIS_URL'),
//            'host' => env('REDIS_HOST', '127.0.0.1'),
//            'password' => env('REDIS_PASSWORD', null),
//            'port' => env('REDIS_PORT', '6379'),
//            'database' => env('REDIS_DB', '0'),
//        ],
//
//        'cache' => [
//            'url' => env('REDIS_URL'),
//            'host' => env('REDIS_HOST', '127.0.0.1'),
//            'password' => env('REDIS_PASSWORD', null),
//            'port' => env('REDIS_PORT', '6379'),
//            'database' => env('REDIS_CACHE_DB', '1'),
//        ],
//
//    ],

];
