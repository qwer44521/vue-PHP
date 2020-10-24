<?php


namespace app\admin\service;


use app\admin\mapper\AdministratorsMapper;
use app\admin\model\AdministratorsModel;
use think\facade\Db;

class AdministratorsService
{
    private $mapper;

    public function __construct(){
        $this -> mapper = new AdministratorsMapper();
    }
    public function add_admin($data){
        return  $this->mapper->addAdmin($data);
    }
    public function loginInfo($data){
        return $this->mapper->getAdminPwd($data);
    }
    public function getAdminInfo($id){
        $res = Db::name('admin_roles')->alias('a')
            ->join("administrators u",'a.uid = u.id')
            ->join("roles r",'r.id = role_id' )
            ->where('u.id',$id)->find();
        return $res;

    }



}