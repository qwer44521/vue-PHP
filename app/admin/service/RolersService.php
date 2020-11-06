<?php


namespace app\admin\service;


use app\admin\mapper\AuthMapper;
use app\admin\mapper\RolersMapper;
use app\admin\model\RolesModel;
use think\Exception;
use think\facade\Db;

class RolersService
{
    /**
     * 查询所有角色
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function allRolers(){
        $res = RolesModel::with(["auths" => function($query) {
            return $query->field("id, role_id, rule_id");
        }])->field("id, roles, r_name, status")->select()->toArray();
        foreach ($res as $k => &$v) {
            $rule_id = array_column($v["auths"], "rule_id");
            $v["idm"] = $rule_id;
        }
        return $res;
    }

    /**
     * 管理员列表中获取角色选项
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getRolesAdmin(){
        return (new RolesModel())->select()->toArray();
    }
    /**
     * 添加菜单
     * @param $data
     * @return bool
     */
    public function addRoles($data){
        $dat = [
            'roles' => $data['roles'],
            'r_name' => $data['r_name'],
            'creator_id' => request()->admin['data']->uid,
            'status' => $data['status'],
            'ctime' => time(),
            'more' => $data['remark']
        ];
        // 启动事务
        Db::startTrans();
        try {
           $role_id = (new RolersMapper())->addRoles($dat);
           if (!$role_id){
               throw new Exception("操作失败");
           }
           $auth = array();
           foreach($data['idm'] as $a_key=>$a_val){
               $tmp_ary = array(
                    'role_id' => $role_id,
                    'rule_id' => $a_val
                );
                $auth[] = $tmp_ary;
            }
            $res = (new AuthMapper())->addAuth($auth);
                if (!$res){
                    throw new Exception('操作失败');
                }
            // 提交事务
            Db::commit();
        } catch (\Exception $exception) {
            // 回滚事务
            Db::rollback();
            return false;

        }
        return true;

    }

    /**
     * 更新角色权限
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateRoles($id,$data){
        $dat=[
            'r_name'=>$data['r_name'],
            'roles'=>$data['roles'],
            'status' => $data['status'],
            'more'  => $data['remark']
        ];
        //开启事务
        Db::startTrans();
        try {
            $del = (new AuthMapper())->delAuth($id);
            if (!$del){
                throw new Exception("操作失败");
            }
            $res = (new RolersMapper())->updateRoles($id,$dat);
            if(!$res){
                throw new Exception("操作失败");

            }
            $auth = array();
            foreach($data['idm'] as $a_key=>$a_val){
                $tmp_ary = array(
                    'role_id' => $id,
                    'rule_id' => $a_val
                );
                $auth[] = $tmp_ary;
            }
            $res = (new AuthMapper())->addAuth($auth);
            if (!$res){
                throw new Exception('操作失败');
            }
            //提交事务
            Db::commit();

        }catch (\Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
        }
        return true;

    }
}
