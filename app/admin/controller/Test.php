<?php


namespace app\admin\controller;


use app\admin\model\RolesModel;
use think\facade\Db;

class Test extends Base
{
    public function test(){



        $res = RolesModel::with(["auths" => function($query) {
            return $query->field("id, role_id, rule_id");
        }])->field("id, roles, r_name, status")->select()->toArray();

//        dd($res);
        foreach ($res as $k => &$v) {
            $rule_id = array_column($v["auths"], "rule_id");
            $v["idm"] = $rule_id;
        }

        dd($res);




//        $r =  Db::name('roles')->select()->toArray();
//        $a = Db::name('auth')->select()->toArray();
//        foreach ($a as $k=>$v){
//            $b[]=$v['rule_id'];
//        }
//
////        $res = array_merge($res,$rule);
//            dump($b);



//       $res =  Db::name('roles')->alias('r')
//            ->join('auth a',"r.id = a.role_id")->field('r.id')->select()->toArray();
//       dump($res);
    }
//        $data = array();
//        $a = [2, 3, 5];
//        foreach($a as $a_key=>$a_val){
//            $tmp_ary = array(
//                'role' => $a_val,
//                'rule' => 2
//            );
//
//            $data[] = $tmp_ary;
//        }
//        dump($data);
//
//        $data=[
//            0=>[
//                'role'=>1,
//                'rule'=>2
//            ],
//
//
//        ]
//
//
//

//
//        $data = array();
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");


//
//      $a = [2,3,5,];
//      foreach ($a as $k=>$v){
//          $b[]=array(['role'=>2,'rule'=>$v]);
//      }
//      dump($b);
//    }
}
