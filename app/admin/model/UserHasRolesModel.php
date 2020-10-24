<?php


namespace app\admin\model;


use think\Model;
use think\model\Pivot;

class UserHasRolesModel extends Pivot
{
    protected $table = 'qs_admin_roles';
    protected $pk = 'id';

}