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
        $res = Db::name('administrators')->alias('a')
                ->join('roles r',"r.id = role_id")
                ->where('a.id',$id)->find();
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
            ->join('roles r',"r.id = role_id")
            ->field("a.id,a.username,a.nickname,a.status,r.r_name")
            ->select()->toArray();
//        $res = AdministratorsModel::with(["roles" => function($query) {
//            return $query->field("qs_roles.id, r_name");
//        }])->field("qs_administrators.id, username")->select()->toArray();
       return $res;
    }



}
