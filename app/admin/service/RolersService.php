<?php


namespace app\admin\service;


use app\admin\mapper\RolersMapper;

class RolersService
{
    public function allRolers(){
        return (new RolersMapper())->allRoles();
    }
}