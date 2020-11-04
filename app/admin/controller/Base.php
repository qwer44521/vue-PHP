<?php


namespace app\admin\controller;


use jwt\Jwt;

class Base
{
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
