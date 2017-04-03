<?php
namespace app\Admin\controller;
use think\Controller;
use app\Admin\model\Links as LinksModel;
class Links extends Common {

	//载入链接列表并显示列表模板
	public function lists () {
		$list = LinksModel::paginate(3);
		$this->assign('list',$list);
		return $this->fetch();
	}

    //载入链接添加模板
	public function add () {
		return $this->fetch();		
	}

	//处理添加链接表单
	public function sub_add () {

		if (!request()->isPost()) return $this->error('页面不存在');

		$data=[
            'title' => input('title'),
            'url'   => input('url'),
            'desc'  => input('desc'),
		];


        //验证提交的数据
        $validate = \think\Loader::validate('Links');
        if(!$validate->scene('add')->check($data)){
           $this->error($validate->getError());
        }

        //添加链接
		if (db('Links')->insert($data)) {
             return $this->success('添加链接成功','lists');
		}
	}

	public function del () {
		$id=input('id');
			if(db('Links')->delete($id)){
				$this->success('删除链接成功','lists');
			}else{
				$this->error('删除链接失败,请重试...');
			}
	}
    //编辑链接并显示其初始值
	public function edit () {
		$id = input('id');
		$edit_Links = db('Links')->find($id);
		$this->assign('edit_Links',$edit_Links);
		return $this->fetch();
	}

	//处理编辑修改链接表单
	public function sub_edit () {
       if (!request()->isPost()) return $this->error('页面不存在');
       $id = input('id');
	   $edit_Links = db('Links')->find($id);
       $data = [
          'id' => input('id'),
          'desc' => input('desc'),
       ];
       //判断url是否需要修改(判断提交时未修改)
       if (input('url')) {
             $data['url'] = input('url');
        } else {
          	 $data['url'] = $edit_Links['url'];
        }
        //判名称是否需要修改(判断提交时未修改)
       if (input('title')) {
             $data['title'] = input('title');
        } else {
          	 $data['title'] = $edit_Links['title'];
        }
       

        
       if (db('Links')->update($data)) {
       	  $this->success('修改链接信息成功','lists');
        } else {
       	   $this->success('修改链接信息成功','lists');
        }
	}		
	
}