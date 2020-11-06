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
        try {
            $res = $service->allRolers();

        }catch (\Exception $exception){
            return $this->ajaxReturn(Code::ERROR,$exception->getMessage());
        }
        if (!$res){
            return $this->ajaxReturn(Code::ERROR,"暂无数据");

        }
        return $this->ajaxReturn(Code::SUCCESS,"获取角色列表成功",$res);
    }

    /**
     * 添加角色
     * @return \think\response\Json
     */
    public function addRoles(){
        $params = input('post.');
        $service = new RolersService();
        try {
            $res = $service->addRoles($params);
        }catch (\Exception $exception){
            return $this->ajaxReturn(Code::ERROR,$exception->getMessage());
        }
        if (!$res){
            return $this->ajaxReturn(Code::ERROR,"添加失败");
        }
        return $this->ajaxReturn(Code::SUCCESS,"添加成功");

    }

    /**
     * 更新角色
     * @param $id
     * @return \think\response\Json
     */
    public function updateRoles($id){
        $params = input("post.");
        $service = new RolersService();
        try{
            $res = $service->updateRoles($id,$params);
        }catch (\Exception $exception){
            return $this->ajaxReturn(Code::ERROR,$exception->getMessage());
        }
        if (!$res){
            return $this->ajaxReturn(Code::ERROR,"添加失败");
        }
        return $this->ajaxReturn(Code::SUCCESS,"角色修改成功",$res);
    }






}
