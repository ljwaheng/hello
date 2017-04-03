<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends validate {
	protected $rule = [
        'catename'  =>  'require|max:30|unique:cate',
    ];

    protected $message  =   [
        'catename.require' => '名称必须填写',
        'catename.max' => '名称不能超过30位',
        'catename.unique' => '栏目名称已存在',
    ];
    
    //验证场景
    protected $scene = [
        'add'    => ['catename','password'],
        'update' => ['catename'=>'require|unique:cate'],
    ];
}
