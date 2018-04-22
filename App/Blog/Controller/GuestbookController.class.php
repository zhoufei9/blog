<?php
namespace Blog\Controller;
use Org\Util\Tree;

class GuestbookController extends BlogController{
	
	public function _initialize(){
		
		
		parent::_initialize();
	}
	
	
	//系统首页
    public function index(){
       //$_REQUEST[C('VAR_PAGE')]=$_REQUEST['pageNum'];
       //一级分类大于2时首页才显示

        $this->display();
    }
    
 
}