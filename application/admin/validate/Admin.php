<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends validate {
	protected $rule = [
        'username'  =>  'require|max:20|unique：admin',
        'password'  =>  'require',
    ];

    protected $message  =   [
        'username.require' => '名称必须填写',
        'username.max' => '名称不能超过20位',
        'username.unique' => '管理员名称已存在',
        'password.require' => '密码必须填写', 
    ];
    
    //验证场景
    protected $scene = [
        'add'    =>  ['username'=>'require|unique:admin','password'],
        'update' =>  ['username'=>'require|unique:admin'],
    ];
}
