<?php
namespace Blog\Model;
use Think\Model;


class CateModel extends Model {

/**
     * 获取指定分类子分类ID(含本级),为0则取出全部ID
     * @param  string $cate 分类ID
     * @return string       id列表
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function getChildrenId($cate){
        $field = 'id,name,pid';
        $catelist = $this->getTree($cate, $field, $array);
        
        
        
        if($cate==0){
        foreach ($catelist as $keyv =>$vo){
        	$ids[] = $vo['id'];
            foreach ($vo['_'] as $key => $value) {
            $ids[] = $value['id'];
            }
        	
        }
        	
        	
        }else{
        $ids[]    = $cate;
        foreach ($catelist['_'] as $key => $value) {
            $ids[] = $value['id'];
        }	
        }
        
        return implode(',', $ids);
    }
 /**
     * 获取分类详细信息
     * @param  milit   $id 分类ID或标识
     * @param  boolean $field 查询字段
     * @return array     分类信息
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function info($id, $field = true){
        /* 获取分类信息 */
        $map = array();
        if(is_numeric($id)){ //通过ID查询
            $map['id'] = $id;
        } else { //通过标识查询
            $map['name'] = $id;
        }
        return $this->field($field)->where($map)->find();
    }
    /**
     * 获取分类树，指定分类则返回指定分类极其子分类，不指定则返回所有分类树
     * @param  integer $id    分类ID
     * @param  boolean $field 查询字段
     * @return array          分类树
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function getTree($id = 0, $field = true ,$array){
        /* 获取当前分类信息 */
        if($id){
            $info = $this->info($id);
            $id   = $info['id'];
        }

        /* 获取所有分类 */
        $map['status']  = 1;
        
        $list = $this->field($field)->where($map)->order('ordid')->select();
        $list = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_', $root = $id);
        
        /* 获取返回数据 */
        if(isset($info)){ //指定分类则返回当前分类极其子分类
            $info['_'] = $list;
        } else { //否则返回所有分类
            $info = $list;
        }

        return $info;
    }

    
   
}
