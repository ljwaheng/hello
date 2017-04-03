<?php
namespace app\admin\validate;
use think\Validate;
class Links extends validate {
	protected $rule = [
        'title'  =>  'require|max：25',
        'url'  =>  'require',
    ];

    protected $message  =   [
        'title.require' => '名称必须填写',
        'title.max' => '名称不能超过25位',
        'url.require' => 'url必须填写', 
    ];
    
    //验证场景
    protected $scene = [
        'add'  =>  ['title'=>'require|max'],
        'add'  =>  ['url'=>'require'],
        'edit' =>  ['title'=>'require|max'],
        'edit' =>  ['url'=>'require'],
    ];
}
