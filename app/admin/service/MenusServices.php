<?php


namespace app\admin\service;


use app\admin\mapper\AuthMapper;
use app\admin\mapper\MenusMapper;
use app\admin\mapper\UserHasRolesMapper;
use app\admin\tools\Tree;

class MenusServices
{
    private $mapper;

    public function __construct()
    {
        $this->mapper = new MenusMapper();
    }


    /**
     * 获取所有菜单结构
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function MenusSelect(){
        $res =  $this->mapper ->allMenu();
        $tree = new Tree();
        $resl = $tree->generateTree($res);
        return $resl;
    }
    public function allMenus(){
        $res =  $this->mapper ->allMenu();
        $tree = new Tree();
        $resl = $tree->getTreeText($res);
        return $resl;
    }


    /**
     * 获取权限菜单
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function getAdminMenu($id){
        $role_id = (new UserHasRolesMapper())->getRolesIdByAdmin($id);
        if (in_array(1,$role_id)){
            $treemenu = (new MenusMapper())->allShowMenu()->toArray();
        }else{
            $rule_id = (new AuthMapper())->getRuleId($role_id);

            $treemenu = (new MenusMapper())->getMenuByAuth(["id" =>$rule_id])->toArray();
        }
         $tree = new Tree();
         $resl = $tree->generateTree($treemenu);
         return $resl;

    }

    public function addMenu($data){
        $dat = [
            "pid"          => $data['pid'],
            "name"         => $data['name'],
            "title"        => $data['title'],
            "ico"          => $data['icon'],
            "createtor_id" => request()->admin['data']->uid,
            "hidden"       => $data['hidden'],
            "sort"         => $data['sort'],
            "redirect"     => $data['redirect'],
            "component"    =>$data['component'],
            "path"         =>$data['path'],
            "c_time"       =>time()
        ];
        $res = (new MenusMapper())->addMenu($dat);
        return $res;
    }



}