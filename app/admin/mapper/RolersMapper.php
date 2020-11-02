<?php


namespace app\admin\mapper;


use app\admin\model\RolesModel;

class RolersMapper
{

    /**
     * 查询所有角色
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function allRoles(){
        return (new RolesModel())->select()->toArray();
    }

    /**
     * 添加角色
     * @param $data
     * @return int|string
     */
    public function addRoles($data){
        return (new RolesModel())->insertGetId($data);
    }

    /**
     * 更新角色
     * @param $id
     * @param $data
     * @return RolesModel
     */
    public function updateRoles($id,$data){
        return (new RolesModel())->where('id',$id)->update($data);
    }


}
