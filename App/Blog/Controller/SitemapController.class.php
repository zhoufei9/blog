<?php
namespace Blog\Controller;
use Org\Util\Tree;

class SitemapController extends BlogController{
	
	public function _initialize(){
		
		
		parent::_initialize();
	}
	
	
	//系统首页
    public function index(){
    	
       //一级分类大于2时首页才显示
       if(M('cate')->where(array('type'=>1,'pid'=>0,'status'=>1))->count()>1){
       	$idarr=M('cate')->where(array('type'=>1,'pid'=>0,'status'=>1))->order('id asc')->limit(2)->getField('id',true);
       	$this->assign('idarr',$idarr);
       }
        
        $catelist=M('cate')->field('id,name,pid,spid')->where(array('status'=>1,'pid'=>0,'type'=>1))->order('id asc')->select();
        $catelist=M('cate')->field('id,name,pid,spid')->where(array('status'=>1,'pid'=>0,'type'=>1))->order('id asc')->select();
		$this->assign('list',$catelist);
        //dump($catelist);
		$this->display();
    }

}