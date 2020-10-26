<?php


namespace app\admin\controller;


use app\admin\service\MenusServices;
use app\Code;

class Menus extends Base
{
    /**
     * 获取所有菜单结构
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function allMenu(){
        $service = new MenusServices();
        $res = $service ->allMenus();
        return $this->ajaxReturn(Code::SUCCESS,"数据请求成功",$res);
    }

    /**
     * 获取菜单结构
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function menuSelect(){
        $service = new MenusServices();
        $res = $service ->MenusSelect();
        return $this->ajaxReturn(Code::SUCCESS,"数据请求成功",$res);
    }
    /**
     * 根据权限获取菜单
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAuthMenu(){
        $service = new MenusServices();
        $res = $service ->getAdminMenu(request()->admin['data']->uid);
        return $this->ajaxReturn(Code::SUCCESS,"数据请求成功",$res);
    }

    /**
     * 添加菜单
     * @return \think\response\Json
     */
    public function addMenus(){
        $params = input("post.");
//        return $this->ajaxReturn(Code::SUCCESS,"添加成功",$params);
        $service = new MenusServices();
        $res = $service->addMenu($params);
        if ($res){
            return $this->ajaxReturn(Code::SUCCESS,"添加成功");
        }else{
            return $this->ajaxReturn(Code::ERROR,"添加失败");
        }

    }

    public function getMenu($id){
        $service = new MenusServices();
       $res = $service ->getMenu($id);
        return $this->ajaxReturn(Code::SUCCESS,"添加成功", $res);
    }





}