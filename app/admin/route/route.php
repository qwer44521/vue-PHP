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
    // 获取登录者的信息
    Route::get('info', Administrators::class."@getAdminInfo");
    // 获取所有菜单
    Route::get('menus', Menus::class."@allMenu");
    // 测试路由，开发结束后删除
    Route::get('test', Administrators::class."@test");
    // 获取权限菜单
    Route::get('authmenu',Menus::class."@getAuthMenu");
    // 添加菜单
    Route::post('addmenu',Menus::class."@addMenus");
    // 构建菜单结构
    Route::get('menuselect',Menus::class."@menuSelect");
    // 获取单个菜单数据
    Route::get('getmenu',Menus::class."@getMenu");
    // 更新菜单
    Route::post('updatemenu',Menus::class."@updateMenu");
    // 获取所有角色
    Route::get('allroles',Roles::class."@allRoles");
    // 添加角色
    Route::post('addroles',Roles::class."@addRoles");
    // 更新角色
    Route::post('updateRoles',Roles::class."@updateRoles");
    // 获取管理员列表
    Route::get('administrstor',Administrators::class."@adminList");
    // 管理员添加页面获取角色列表
    Route::get('adminroles',Administrators::class."@adminroles");
})->middleware(\app\middleware\JwtMiddleware::class)->allowCrossDomain();
