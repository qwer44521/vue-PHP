<?php


namespace app\admin\controller;


use app\admin\service\RolersService;
use app\Code;
use think\console\Input;

class Roles extends Base
{
    /**
     * 获取所有角色
     * @return \think\response\Json
     */
    public function allRoles(){
       $service = new RolersService();
       $res = $service->allRolers();
       return $this->ajaxReturn(Code::SUCCESS,"获取角色列表成功",$res);
    }
    public function addRoles(){
        $params = input('post.');
        return $this->ajaxReturn(Code::SUCCESS,"添加角色成功",$params);
    }

}