<?php
namespace app\admin\model;
use think\Model;
//一个栏目有多篇文章一对多关联 一片文章对应栏目是多对一  栏目对文章是hasmany  文章对栏目是belongsto
class Article extends Model{

       public function cate () {
        return $this->belongsTo('cate','cateid');
    }

}

