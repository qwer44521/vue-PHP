<?php


namespace app\admin\controller;


use jwt\Jwt;

class Base
{

//    protected $user;
//
//    private $allow = [
//        "/admin/login",
//
//    ];
//    public function __construct(){
//        if (!in_array(request()->url(), $this->allow)) {
//            $token = request()->header("Admin-Token");
//            $this->user = (array)Jwt::decodedToken($token)["data"];
//        }
//    }
    /**
     * 返回值处理
     * @param int $code
     * @param string $msg
     * @param null $data
     * @param string $token
     * @return \think\response\Json
     */
    public function ajaxReturn($code = 1, $msg = "success", $data = null, $token = "") {
        return json(["code" => $code, "msg" => $msg, "data" => $data, 'token'=> $token]);
    }













}