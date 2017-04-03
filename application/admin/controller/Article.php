<?php
namespace app\Admin\controller;
use think\Controller;
use app\Admin\model\Article as ArticleModel;
class Article extends Common {

	//载入文章列表并显示列表模板 
	public function lists () {
		$list = ArticleModel::paginate(8);
		// 连接查询 $list=db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')->paginate(3);
		$this->assign('list',$list);
		return $this->fetch();
	}

    //载入文章添加模板
	public function add () {
		$cateres = db("cate")->select();
		$this->assign('cateres',$cateres);
		return $this->fetch();		
	}

	//处理添加文章表单
	public function sub_add () {

		if (!request()->isPost()) return $this->error('页面不存在');

		$data=[
            'title'    => input('title'),
            'author'   => input('author'),
            'keyword'  => str_replace('，' , ',' , input('keyword')),
            'desc'     => input('desc'),
            'cateid'   => input('cateid'),
            'content'  => input('content'),
            'time'     => time(),
		];
		if (input('state')) {
			$data['state'] = 1; 
		}
         
        if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
        

        //验证提交的数据
        $validate = \think\Loader::validate('Article');
        if(!$validate->scene('add')->check($data)){
           $this->error($validate->getError());
        }

        //添加文章
		if (db('Article')->insert($data)) {
             return $this->success('添加文章成功','lists');
		}
	}
     
     //删除文章
	public function del () {
		$id=input('id');
			if(db('Article')->delete($id)){
				$this->success('删除文章成功','lists');
			}else{
				$this->error('删除文章失败,请重试...');
			}
	}
    //编辑文章并显示其初始值
	public function edit () {
		$id = input('id');
		$edit_Article = db('Article')->find($id);
		$this->assign('edit_Article',$edit_Article);
		$cateres = db("cate")->select();
		$this->assign('cateres',$cateres);
		return $this->fetch();
	}

	//处理编辑修改文章表单
	public function sub_edit () {
       if (!request()->isPost()) return $this->error('页面不存在');
       $id = input('id');
	   $edit_Article = db('Article')->find($id);
       $data=[
             'id'      => input('id'),
            'title'    => input('title'),
            'author'   => input('author'),
            'keyword'  => str_replace('，' , ',' , input('keyword')),
            'desc'     => input('desc'),
            'cateid'   => input('cateid'),
            'content'  => input('content'),
            'time'     => time(),
		];
		if (input('state')) {
			$data['state'] = 1; 
		} else {
			$data['state'] = 0; 
		}
         
        if($_FILES['pic']['tmp_name']){
        	    $oldpic=SITE_URL.'/public/static'.$edit_Article['pic'];
        	    @unlink($oldpic);
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
            }
        
       if (db('Article')->update($data)) {
       	  $this->success('修改文章信息成功','lists');
        } else {
       	   $this->success('修改文章信息成功','lists');
        }
	}		
	
}