<?php


use app\admin\controller\Administrators;
use app\admin\controller\Login;
use app\admin\controller\Menus;
use app\admin\controller\Roles;
use think\facade\Route;
//后台路由组   不需要验证
Route::group('/',function (){
    Route::post('login', Login::class."@login");
    Route::post('loginout',Login::class.'@loginout');
    Route::post("test",\app\admin\controller\Test::class.'@test');
//  Route::post('addadmin', Administrators::class . "@addAdministrator");
})->allowCrossDomain();


//后台路由组     需要验证
Route::group('/api',function (){
    Route::get('info', Administrators::class."@getAdminInfo");
    Route::get('menus', Menus::class."@allMenu");
    Route::get('test', Administrators::class."@test");
    Route::get('authmenu',Menus::class."@getAuthMenu");
    Route::post('addmenu',Menus::class."@addMenus");
    Route::get('menuselect',Menus::class."@menuSelect");
    Route::get('getmenu',Menus::class."@getMenu");
    Route::post('updatemenu',Menus::class."@updateMenu");
    Route::get('allroles',Roles::class."@allRoles");
    Route::post('addroles',Roles::class."@addRoles");
    Route::post('updateRoles',Roles::class."@updateRoles");
})->middleware(\app\middleware\JwtMiddleware::class)->allowCrossDomain();
