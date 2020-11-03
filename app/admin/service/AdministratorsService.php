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

    /**
     * 添加管理员
     * @param $data
     * @return int
     */
    public function add_admin($data){
        return  $this->mapper->addAdmin($data);
    }

    /**
     * 登录验证信息
     * @param $data
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function loginInfo($data){
        return $this->mapper->getAdminPwd($data);
    }

    /**
     * 获取正在登陆的管理员信息
     * @param $id
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminInfo($id){
        $res = Db::name('admin_roles')->alias('a')
            ->join("administrators u",'a.uid = u.id')
            ->join("roles r",'r.id = role_id' )
            ->where('u.id',$id)->find();
        return $res;

    }

    /**
     * 获取管理员列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function allAdministrator(){
       $res = Db::name('administrators')->alias('a')
            -> join('admin_roles r','a.id = r.uid')
            -> join('roles o','r.role_id = o.id')->select()->toArray();
//        $res = (new AdministratorsModel())->roles()->select();
//        $res = AdministratorsModel::with(["roles" => function($query) {
//            return $query->field("qs_roles.id, r_name");
//        }])->field("qs_administrators.id, username")->select()->toArray();
       return $res;
    }



}
