<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Vendors Path
    |--------------------------------------------------------------------------
    |
    | Composer's vendor dir Path.
    |
    */
    'vendor_path' => app_path() .'/../vendor/',

    /*
    |--------------------------------------------------------------------------
    | Readme File Name
    |--------------------------------------------------------------------------
    |
    | Package's default readme file name.
    |
    */
    'filename' => 'readme.md',

    /*
    |--------------------------------------------------------------------------
    | Route
    |--------------------------------------------------------------------------
    |
    | Default route config.
    | This will register a route as:
    | Route::get('/readme/{packageName?}','Seekerliu\Readme\Controllers\ReadmeController@index')->name('readme.index');
    |
    */
    'route' => [
        'prefix' => '/readme/{packageName?}',
        'action' => 'Seekerliu\Readme\Controllers\ReadmeController@index',
        'name' => 'readme.index',
    ],
];