<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
class Admin extends Common {

	//载入管理员列表并显示列表模板
	public function lists () {
		$list = AdminModel::paginate(3);
		$this->assign('list',$list);
		return $this->fetch();
	}

    //载入管理员添加模板
	public function add () {
		return $this->fetch();		
	}

	//处理添加管理员表单
	public function sub_add () {

		if (!request()->isPost()) return $this->error('页面不存在');

		$data=[
            'username' => input('username'),
            'password' => md5(input('password')),
		];


        //验证提交的数据
        $validate = \think\Loader::validate('Admin');
        if(!$validate->scene('add')->check($data)){
           $this->error($validate->getError());
        }

        //添加管理员
		if (db('admin')->insert($data)) {
             return $this->success('添加管理员成功','lists');
		}
	}

	public function del () {
		$id=input('id');
		if($id != 1) {
			if(db('admin')->delete($id)){
				$this->success('删除管理员成功','lists');
			}else{
				$this->error('删除管理员失败,请重试...');
			}
		}else{
			$this->error('初始化管理员不能删除');
		}
	}
    //编辑管理员并显示其初始值
	public function edit () {
		$id = input('id');
		$edit_admin = db('admin')->find($id);
		$this->assign('edit_admin',$edit_admin);
		return $this->fetch();
	}

	//处理编辑修改管理员表单
	public function sub_edit () {
       if (!request()->isPost()) return $this->error('页面不存在');
       $id = input('id');
	   $edit_admin = db('admin')->find($id);
       $data = [
          'id' => input('id'),
          'username' => input('username'),
       ];
       //判断密码是否需要修改(判断提交时未修改)
       if (input('password')) {
             $data['password'] = md5(input('password'));
        } else {
          	 $data['password'] = $edit_admin['password'];
        }

        //验证提交的数据
        $validate = \think\Loader::validate('Admin');
        if(!$validate->scene('update')->check($data)){
           $this->error($validate->getError());
        }
        $save=db('admin')->update($data);
       if ($save !== false) {
       	  $this->success('修改管理员信息成功','lists');
        } else {
       	   $this->error('修改管理员信息失败,请重试...');
        }
	}

	//管理员退出登录
	public function logout () {
		session(null);
		$this->success('退出成功','login/index');
	}		
	
}