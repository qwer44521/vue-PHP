<?php


namespace app\admin\mapper;


use app\admin\model\MenusModel;
use app\admin\model\TestModel;

class MenusMapper
{
    /**
     * 获取所有菜单记录
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function allMenu(){
         $model = new MenusModel();
         return $model ->order("sort asc")->select()->toArray();
    }

    /**
     * 展示用户权限的菜单
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function allShowMenu(){

        return MenusModel::where("hidden",0)->select();

    }

    public function getMenuByAuth($where){
        return MenusModel::where($where)->select();
    }

    /**
     * 添加菜单
     * @param $data
     * @return int
     */
    public function addMenu($data){
        $res = (new MenusModel())->insert($data);
        return $res;
    }

    /**
     * 获取单条菜单
     * @param $id
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getMenu($id){
        return MenusModel::where('id',$id)->find();
    }

    public function updateMenu($id,$data){
        return MenusModel::where('id',$id)->update($data);
    }








}