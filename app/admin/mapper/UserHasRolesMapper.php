<?php


namespace app\admin\mapper;


use app\admin\model\UserHasRolesModel;

class UserHasRolesMapper
{
    public function getRolesIdByAdmin($id){
        $model = new UserHasRolesModel();
        $res = $model->where('uid',$id)->column('role_id');

        return $res;
    }
}