<?php


namespace app\admin\controller;


use app\admin\service\AdministratorsService;

class Administrators extends Base
{

    public function test(){
        $res= request()->admin['data']->uid;
        dump($res);
    }
    public function adminList(){
       $service = new AdministratorsService();
       $res = $service->allAdministrator();
       return $res;
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
     * 添加管理员
     * 目前只是添加临时数据，欧系需要优化 2020-10-10
     * @return int
     */
    public function addAdministrator(){
        $params = input(".post");
        $data=[
            "username" => 'admin',
            "password" => password_hash("123456",PASSWORD_DEFAULT),
            "nickname" => "超级管理员",
            "avatar"   => "https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif",
            "ctime"    => time()
        ];
        $add_admin = new AdministratorsService();
        $res = $add_admin->add_admin($data);
        return $res;
    }
}
