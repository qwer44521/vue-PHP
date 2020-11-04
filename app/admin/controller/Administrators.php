<?php


namespace app\admin\controller;


use app\admin\service\AdministratorsService;
use app\Code;
use http\Client\Request;
use PouDuo\IpLocation\IpLocation;

class Administrators extends Base
{

    public function test(Request $request)
    {
        $IpLocation = new IpLocation();
        $area = $IpLocation->getlocation($request -> ip());
        return $area;
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
