<?php


namespace app\admin\controller;


use app\admin\service\RolersService;
use app\Code;

class Roles extends Base
{
    public function allRoles(){
       $service = new RolersService();
       $res = $service->allRolers();
       return $this->ajaxReturn(Code::SUCCESS,"获取角色列表成功",$res);
    }
}