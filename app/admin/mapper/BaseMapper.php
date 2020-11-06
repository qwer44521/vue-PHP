<?php


namespace app\admin\mapper;


class BaseMapper
{
    protected $model;

    public function findBy($where = [], $field = "*") {
        return $this->model::where($where)->field($field)->find()->toArray;
    }

    public function selectBy($where = [], $field = "*") {
        return $this->model::where($where)->field($field)->select()->toArray;
    }

    public function deleteBy($where = []) {
        return $this->model::where($where)->delete();
    }
}
