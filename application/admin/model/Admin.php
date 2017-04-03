<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model{
     
     public function login ($data) {
        if(!captcha_check($data['code'])){
           return 3;
        }
         $user = Db::name('admin')->where('username','=',$data['username'])->find();
         if ($user) {
            if ($user['password'] == md5($data['password'])) {   
               session('id',$user['id']);
               session('username',$user['username']);
               return 2;//登录成功
            }else{
                return 1;//密码错误
            }
         }else{
         	return 0; //用户不存在
         }
     }

}