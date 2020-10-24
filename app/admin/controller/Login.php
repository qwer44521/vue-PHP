<?php


namespace app\admin\controller;


use app\admin\service\AdministratorsService;
use app\Code;
use app\validate\LoginValidate;
use jwt\Jwt;

class Login extends Base
{
    /**
     * 登录系统
     * @param AdministratorsService $service
     * @param LoginValidate $validate
     * @return \think\response\Json
     */
    public function login(AdministratorsService $service, LoginValidate $validate){
        $params = input("post.");
        if(!$validate->scene('login')->check($params)){
            return $this->ajaxReturn(Code::ERROR_VALIDATE,$validate->getError());
        }
        $admin = $service->loginInfo($params['username']);
        if (!$admin){
            return $this->ajaxReturn(Code::ERROR,'管理员不存在');
        }
        if (!password_verify($params['password'],$admin['password'])){
            return $this->ajaxReturn(Code::ERROR,'密码错误');
        }
        $data=[
            'uid'=>$admin['id']
        ];
        $jwt = Jwt::CreateToken($data);
        return $this->ajaxReturn(Code::SUCCESS,"登陆成功",null,$jwt);
    }
    public function loginout(){
        dump(1341);
    }









}