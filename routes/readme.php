<?php
/**
 * author: seekerliu
 * createTime: 2016/12/30 上午11:08
 * Description: Readme Routes
 */
if(Config::get('readme.route')) {
    Route::get(
        Config::get('readme.route')['prefix'],
        Config::get('readme.route')['action']
        )->name(Config::get('readme.route')['name']);
}