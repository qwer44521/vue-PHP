<?php


use app\admin\controller\Administrators;
use app\admin\controller\Login;
use app\admin\controller\Menus;
use think\facade\Route;
//后台路由组   不需要验证
Route::group('/',function (){
    Route::post('login', Login::class."@login");
    Route::post('loginout',Login::class.'@loginout');
//    Route::post('addadmin', Administrators::class . "@addAdministrator");
})->allowCrossDomain();
//后台路由组     需要验证
Route::group('/api',function (){
    Route::get('info', Administrators::class."@getAdminInfo");
    Route::get('menus', Menus::class."@allMenu");
    Route::get('test', Administrators::class."@test");
    Route::get('authmenu',Menus::class."@getAuthMenu");
    Route::post('addmenu',Menus::class."@addMenus");
})->middleware(\app\middleware\JwtMiddleware::class)->allowCrossDomain();