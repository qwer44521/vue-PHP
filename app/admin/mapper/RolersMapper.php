<?php


namespace app\admin\mapper;


use app\admin\model\RolesModel;

class RolersMapper
{
    public function allRoles(){
        return (new RolesModel())->select()->toArray();
    }
}