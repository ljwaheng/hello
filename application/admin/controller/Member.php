<?php
namespace app\Admin\controller;
use think\Controller;
use app\Admin\model\Member as MemberModel;
class Member extends Common {

	//载入成员列表并显示列表模板 
	public function lists () {
		$list = MemberModel::paginate(5);
		$this->assign('list',$list);
		return $this->fetch();
	}

    //载入成员添加模板
	public function add () {
		// $cateres = db("cate")->select();
		// $this->assign('cateres',$cateres);
		return $this->fetch();		
	}

	//处理添加成员表单
	public function sub_add () {

		if (!request()->isPost()) return $this->error('页面不存在');

		$data=[
            'name'      =>  input('name'),
            'position'  =>  input('position'),
            'phone'     =>  input('phone'),
            'fax'       =>  input('fax'),
            'email'     =>  input('email'),
            'location'  =>  input('location'),
            'postcode'  =>  input('postcode'),
            'resume'    =>  input('resume'),
            'direction' =>  input('direction'),
            'honor'     =>  input('honor'),
            'project'   =>  input('project'),
            'course'    =>  input('course'),
		];
         
        if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/faces');
                $data['pic']='/faces/'.$info->getSaveName();
            }
        

        //验证提交的数据
        $validate = \think\Loader::validate('Member');
        if(!$validate->scene('add')->check($data)){
           $this->error($validate->getError());
        }

        //添加成员
		if (db('Member')->insert($data)) {
             return $this->success('添加成员成功','lists');
		}
	}
     
     //删除成员
	public function del () {
		$id=input('id');
			if(db('Member')->delete($id)){
				$this->success('删除成员成功','lists');
			}else{
				$this->error('删除成员失败,请重试...');
			}
	}
    //编辑成员并显示其初始值
	public function edit () {
		$id = input('id');
		$edit_Member = db('Member')->find($id);
		$this->assign('edit_Member',$edit_Member);
		return $this->fetch();
	}

	//处理编辑修改成员表单
	public function sub_edit () {
       if (!request()->isPost()) return $this->error('页面不存在');
       $id = input('id');
	   $edit_Member = db('Member')->find($id);
       $data=[
            'id'        =>  input('id'),
            'name'      =>  input('name'),
            'position'  =>  input('position'),
            'phone'     =>  input('phone'),
            'fax'       =>  input('fax'),
            'email'     =>  input('email'),
            'location'  =>  input('location'),
            'postcode'  =>  input('postcode'),
            'resume'    =>  input('resume'),
            'direction' =>  input('direction'),
            'honor'     =>  input('honor'),
            'project'   =>  input('project'),
            'course'    =>  input('course'),
		];
         
        if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/faces');
                $data['pic']='/faces/'.$info->getSaveName();
            }

        //验证提交的数据
        $validate = \think\Loader::validate('Member');
        if(!$validate->scene('update')->check($data)){
           $this->error($validate->getError());
        }
        
       if (db('Member')->update($data)) {
       	  $this->success('修改成员信息成功','lists');
        } else {
       	   $this->success('修改成员信息成功','lists');
        }
	}		
	
}