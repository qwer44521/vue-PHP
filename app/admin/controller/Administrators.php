<?php


namespace app\admin\controller;


use app\admin\service\AdministratorsService;
use app\admin\service\RolersService;
use app\Code;
class Administrators extends Base
{

    public function test()
    {

    }

    /**
     * @return array|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function adminList(){
       $service = new AdministratorsService();
       $res = $service->allAdministrator();
     return $this->ajaxReturn(Code::SUCCESS,'获取管理员数据成功',$res);
    }
    /**
     * 获取个人信息
     * @return \think\response\Json
     */
    public function getAdminInfo(){
        $service = new AdministratorsService();
        $res = $service->getAdminInfo(request()->admin['data']->uid);
        return $this->ajaxReturn(1,'数据请求成功',$res);
    }

    /**
     * 获取角色列表
     * @return array|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function adminroles(){
        $service = new RolersService();
        try {
            $res = $service->getRolesAdmin();
        }catch (\Exception $exception){
            return $this->ajaxReturn(Code::ERROR,$exception->getMessage());
        }
       if ($res){
           return $this->ajaxReturn(Code::SUCCESS,"角色列表请求成功",$res);
       }
        return $this->ajaxReturn(Code::ERROR,"角色列表请求失败");
    }

    /**
     * 添加管理员
     * @return \think\response\Json
     */
    public function addAdministrator(){
        $params = input("post.");
        $service = new AdministratorsService();
        try {
            $res = $service->add_admin($params);

        }catch (\Exception $exception){
            return $this->ajaxReturn(Code::ERROR,$exception->getMessage());
        }
        if ($res){
            return $this->ajaxReturn(Code::SUCCESS,"添加管理员成功");
        }
        return $this->ajaxReturn(Code::ERROR,"添加管理员失败");

    }
    public function updateAdmin($id){
        $params = input("post.");
        return $this->ajaxReturn(Code::SUCCESS,"修改管理员信息成功",$id);

    }
//    public function getAdminByid($id){
//
//    }
    public function avatarUpload(){
        $files = request()->file('file');
        return $files;
    }
}
