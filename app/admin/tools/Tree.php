<?php


namespace app\admin\tools;




class Tree
{
    /**
     * 构造菜单树形结构
     * @param $data
     * @return array
     */
    function generateTree($data){
        $items = array();
        foreach($data as $v){
//            $v["meta"]["title"] = $v["title"];
//            $v["meta"]["ico"] = $v["ico"];
//            unset($v["title"]);
//            unset($v["ico"]);
            $items[$v['id']] = $v;
        }
        $tree = array();
        foreach($items as $k => $item){
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['children'][] = &$items[$k];
            }else{
                $tree[] = &$items[$k];
            }
        }
        return $tree;
    }









}