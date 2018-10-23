<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

$adminDomain = config('admin_domain');

Route::domain($adminDomain, function () {
    Route::get('/', 'Index/index');
    Route::get('dashboard', 'Board/index')->name('dashboard');
    Route::get('login', 'auth.login/showLoginForm');
    Route::post('login', 'auth.login/login');
})->bind('admin');

return [

];
