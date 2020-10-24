<?php


namespace app\admin\model;


use think\Model;



class AdministratorsModel extends Model
{
    protected $table = 'qs_administrators';
    protected $pk = 'id';
//    public function roles() {
//        return $this->belongsToMany(RolesModel::class, UserHasRolesModel::class, "role_id", "uid");
//    }
}