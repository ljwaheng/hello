<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller {

    public function index () {
        return $this->fetch('login');
    }

    public function login () {
       if (!request()->isPost()) return $this->error('页面不存在');

        $admin = new Admin();

        $data = input('post.');


        if ($admin->login($data) == 2) {
            $this->success('登录成功,正在为您跳转...','index/index');

        }elseif($admin->login($data) == 3){
            $this->error('验证码错误','login/index');
        }else{
            $this->error('用户名或密码错误','login/index');
        }
    }

    

    
}
