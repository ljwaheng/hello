<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Show extends Common {
	
    public function index () {
    	//显示最新的文章
    	$newarticle = Db::name('article')->where('cateid','=',2)->order('time')->limit(0,10)->select();
         $this->assign('newarticle',$newarticle);
         //显示文章详情
    	$id=input('artid');
        db('article')->where(array('id'=>$id))->setInc('click');
    	$article = db('Article')->find($id);
		$this->assign('article',$article);
        return $this->fetch('show');

    }

    public function show_member () {
         $id=input('memid');
         $member = db('member')->find($id);
         $this->assign('member',$member);
         return $this->fetch();
    }




}