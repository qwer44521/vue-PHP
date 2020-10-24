<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class LoginValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [

        'username'  => 'require',

        'password'   => 'require',

    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     * @var array
     */
    protected $message = [

        'username.require' => '用户名必须填写',

        'password.require' => '密码必须填写',

    ];
    /**
     * @var \string[][]
     */
    protected $scene = [

        'login'  =>  ['username','password'],

    ];
}
