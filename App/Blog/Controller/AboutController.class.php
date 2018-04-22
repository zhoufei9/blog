<?php
namespace Blog\Controller;
use Org\Util\Tree;

class AboutController extends BlogController{
	
	public function _initialize(){
		
		
		parent::_initialize();
	}
	
	
	//系统首页
    public function index(){
    	
       //一级分类大于2时首页才显示

        $this->display();
    }
    
 
}