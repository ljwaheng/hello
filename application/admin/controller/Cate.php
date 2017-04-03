<?php
namespace app\admin\controller;
use think\Controller;
use app\Admin\model\Cate as CateModel;
class Cate extends Common {

	//载入栏目列表并显示列表模板
	public function lists () {
		$list = cateModel::paginate(7);
		$this->assign('list',$list);
		return $this->fetch();
	}

    //载入栏目添加模板
	public function add () {
		return $this->fetch();		
	}

	//处理添加栏目表单
	public function sub_add () {

		if (!request()->isPost()) return $this->error('页面不存在');

		$data=[
            'catename' => input('catename'),
		];


        //验证提交的数据
        $validate = \think\Loader::validate('Cate');
        if(!$validate->scene('add')->check($data)){
           $this->error($validate->getError());
        }

        //添加栏目
		if (db('cate')->insert($data)) {
             return $this->success('添加栏目成功','lists');
		}
	}

	public function del () {
		$id=input('id');
			if(db('cate')->delete($id)){
				$this->success('删除栏目成功','lists');
			}else{
				$this->error('删除栏目失败,请重试...');
			}
	}
    //编辑栏目并显示其初始值
	public function edit () {
		$id = input('id');
		$edit_cate = db('cate')->find($id);
		$this->assign('edit_cate',$edit_cate);
		return $this->fetch();
	}

	//处理编辑修改栏目表单
	public function sub_edit () {
       if (!request()->isPost()) return $this->error('页面不存在');
       $data = [
          'id' => input('id'),
          'catename' => input('catename'),
       ];

        //验证提交的数据
        $validate = \think\Loader::validate('Cate');
        if(!$validate->scene('update')->check($data)){
           $this->error($validate->getError());
        }
       if (db('cate')->update($data)) {
       	  $this->success('修改栏目信息成功','lists');
        } else {
       	   $this->error('修改栏目信息失败,请重试...');
        }
	}		
	
}