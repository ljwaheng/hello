<?php
namespace app\admin\validate;
use think\Validate;
class Member extends validate {
    protected $rule = [
        'name'  =>  'require|max:20|unique：member',
    ];

    protected $message  =   [
        'name.require' => '名称必须填写',
        'name.max' => '名称不能超过20位',
        'name.unique' => '名称已存在', 
    ];
    
    //验证场景
    protected $scene = [
        'add'    =>  ['name'=>'require|unique:member',],
        'update' =>  ['name'=>'require|unique:member'],
    ];
}
