<?php


namespace app\admin\mapper;


use app\admin\model\AdministratorsModel;
use app\admin\model\RolesModel;
use app\admin\model\UserHasRolesModel;

class AdministratorsMapper
{

    /**
    *测试添加管理员
     * @param $data
     * @return int
     */
    public function addAdmin($data){
        return (new AdministratorsModel())->insert($data);
    }

    /**
     * 获取用户密码
     * @param $data
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminPwd($data){
        return AdministratorsModel::where(['username' =>$data])->find();
    }


    /**
     * 获取用户信息
     * @param $id
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminInfo($id){
        return AdministratorsModel::where(['id' =>$id])->field("username,nickname,email,avatar,status,last_login_time,last_login_ip")->find();
    }

    /**
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminRoles($id){
        return AdministratorsModel::with(["roles" => function($query) {
            return $query->field("qs_roles.id, qs_roles.r_name");
        }])->where("id",$id)->field("id,username,nickname,email,avatar,status,last_login_time,last_login_ip")->find()->toArray();
    }
}