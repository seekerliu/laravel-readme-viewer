<?php
/**
 * author: seekerliu
 * createTime: 2016/12/30 上午11:08
 * Description: Readme Routes
 */
Route::get('/readme/{packageName?}', 'Seekerliu\Readme\Controllers\ReadmeController@index')->name('readme.index');