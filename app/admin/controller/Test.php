<?php


namespace app\admin\controller;


class Test extends Base
{
    public function test(){
        $data = array();
        $a = [2, 3, 5];
        foreach($a as $a_key=>$a_val){
            $tmp_ary = array(
                'role' => $a_val,
                'rule' => 2
            );

            $data[] = $tmp_ary;
        }
        dump($data);
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
//
//        $data = array();
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");
//        $data[] = array("A"=>1, "B"=> "2");



      $a = [2,3,5,];
      foreach ($a as $k=>$v){
          $b[]=array(['role'=>2,'rule'=>$v]);
      }
      dump($b);
    }
}
