<?php


namespace app\admin\mapper;


use app\admin\model\AuthModel;

class AuthMapper
{
    /**
     * 根据角色获取权限
     * @param $role_id
     * @return array
     */
    public function getRuleId($role_id){
        $model = new AuthModel();
        return $model ->where(['role_id'=>$role_id])->column("rule_id");

    }

    /**
     * 添加权限
     * @param $data
     * @return int
     */
    public function addAuth($data){
        return (new AuthModel())->insertAll($data);
    }
public function delAuth($id){
        return(new AuthModel())->where('role_id',$id)->delete();

    }
}
