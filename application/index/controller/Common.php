<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Common extends Controller {
	
    public function _initialize()
    {
    	$cateres=db('cate')->order('id asc')->select();
    	$this->assign('cateres',$cateres);
    	$catename=Db::name('cate')->where('id','=',input('cateid'))->find();
    	$this->assign('catename',$catename);
    }

}

