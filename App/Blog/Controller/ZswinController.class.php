<?php
namespace Blog\Controller;


class ZswinController extends BlogController{

	// 远程获取升级包信息
	
	
    public function update_json(){
    	$version=I('get.version','','int');
    	$new_version=C ( 'SYSTEM_UPDATRE_VERSION' );
    	$res['ver']=$new_version;
    	if($new_version > $version){
    		$res['status']=1;
    	}else{
    		$res['status']=0;
    	}
    	
    	$this->ajaxReturn($res);
    }
}