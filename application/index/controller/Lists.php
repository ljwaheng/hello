<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Lists extends Common
{
    public function index () {
    	
        
        if(input('cateid')==1){
           //首页
           //显示最新的5条文章
           $newarticle = Db::name('article')->where('cateid','=',2)->order('time')->limit(0,5)->select();
           //显示友情链接
           $urls = Db::name('links')->select();
            $this->assign([
            'newarticle' =>  $newarticle,
            'urls'       =>  $urls
           ]);
           return $this->fetch('list');
        }elseif(input('cateid')==2){


           //新闻动态
        	//推荐的文章图片
          $where['cateid'] = 2;
          $where['state'] = 1;
        	$good_article = Db::name('article')->where($where)->order('time','desc')->limit(0,5)->select();
        	//所有的文章
        	$articles = Db::name('article')->where('cateid','=',2)->order('time')->paginate(5);
          $this->assign([
            'good_article'=>  $good_article,
            'articles'    =>  $articles
           ]);
            return $this->fetch('list2');
        }elseif(input('cateid')==5){


           //责任教授
            $member = Db::name('member')->where('id','=',1)->find();
          $this->assign([
            'member'   =>  $member
           ]);
           return $this->fetch('show/show_member');
        }elseif(input('cateid')==7){


           //成员介绍
        	$members = Db::name('member')->order('id')->paginate(5);
          $this->assign([
            'members'  =>  $members
           ]);
           return $this->fetch('list4');
        }elseif(input('cateid')==8){


           //对外服务直接在后台添加
        	$service = Db::name('article')->where('cateid','=',8)->select();
          $this->assign([
            'service'  =>  $service
           ]);
           return $this->fetch('list5');
        }elseif(input('cateid')==9){


           //研究方向
        	$direction = Db::name('article')->where('cateid','=',9)->select();
          $this->assign([
            'direction' =>  $direction
           ]);
           return $this->fetch('list6');
        }elseif(input('cateid')==10){


           //研究成果
        	$achievement = Db::name('article')->where('cateid','=',10)->select();
          $this->assign([
            'achievement' =>  $achievement
           ]);
           return $this->fetch('list7');
        }elseif(input('cateid')==11){


           //国际合作
          //推荐的文章图片
          $where['cateid'] = 11;
          $where['state'] = 1;
          $good_cooperation = Db::name('article')->where($where)->order('time','desc')->limit(0,5)->select();
          //所有的国际合作文章
        	$cooperations = Db::name('article')->where('cateid','=',11)->order('time')->paginate(7);
          $this->assign([
            'good_cooperation'=>  $good_cooperation,
            'cooperations'    =>  $cooperations
           ]);
           return $this->fetch('list8');
        }elseif(input('cateid')==12){


           //主要课程
        	$course = Db::name('article')->where('cateid','=',12)->select();
        	$this->assign('course',$course);
           return $this->fetch('list9');
        }elseif(input('cateid')==13){


           //课外生活
        	$activity = Db::name('article')->where('cateid','=',13)->select();
        	$this->assign('activity',$activity);
           return $this->fetch('list10');
        }
    }




}