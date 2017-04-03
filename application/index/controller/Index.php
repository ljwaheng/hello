<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Common {
	
    public function index () {
            //首页
           //显示最新的5条文章
           $newarticle = Db::name('article')->where('cateid','=',2)->order('time')->limit(0,5)->select();
           $this->assign('newarticle',$newarticle);
           //显示友情链接
           $urls = Db::name('links')->select();
           $this->assign('urls',$urls);
           return $this->fetch('lists/list');
    }

}

