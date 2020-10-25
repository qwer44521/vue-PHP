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

    //生成列表数据
    public function getTreeText($cate , $lefthtml = '— — ' , $pid=0 , $lvl=0, $leftpin=0){
        $arr=array();
        foreach ($cate as $v){
            if($v['pid']==$pid){
                $v['title']=str_repeat($lefthtml,$lvl).$v['title'];
                $arr[]=$v;
                $arr= array_merge($arr,$this->getTreeText($cate,$lefthtml,$v['id'],$lvl+1 , $leftpin+20));
            }
        }
        return $arr;
    }









}