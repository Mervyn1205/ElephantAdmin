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
    Route::get('login', 'auth/showLoginForm');
    Route::post('login', 'auth/login');
    Route::get('logout', 'auth/logout');
    Route::get('menu/:pid', 'menu/getLeft');
    Route::get('account/edit', 'account/edit');
    Route::POST('account/edit', 'account/update');
    Route::resource('manager', 'admin/manager');

})->bind('admin');

return [

];
