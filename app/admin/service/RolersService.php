<?php


namespace app\admin\service;


use app\admin\mapper\AuthMapper;
use app\admin\mapper\RolersMapper;
use app\admin\model\AuthModel;
use app\admin\model\RolesModel;
use think\Exception;
use think\facade\Db;

class RolersService
{
    /**
     * 获取全部角色列表
     * @return array
     */
    public function allRolers(){
        return (new RolersMapper())->allRoles();
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
                    'ruleid' => $a_val
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
}
