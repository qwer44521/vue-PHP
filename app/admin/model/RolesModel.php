<?php


namespace app\admin\model;


use think\Model;

class RolesModel extends Model
{
    protected $table = 'qs_roles';
    protected $pk = 'id';


    public function auths() {
        return $this->hasMany(AuthModel::class, "role_id", "id");
    }
}
