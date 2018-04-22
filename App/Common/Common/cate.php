<?php
function get_cate($id, $field = null){
        static $list;

        /* 非法分类ID */
        if(empty($id) || !is_numeric($id)){
            return '';
        }

        /* 读取缓存数据 */
        if(empty($list)){
            $list = S('sys_cate_list');
        }

        /* 获取分类名称 */
        if(!isset($list[$id])){
        	
            $cate = M('Cate')->find($id);
            if(!$cate || 1 != $cate['status']){ //不存在分类，或分类被禁用
                return '';
            }
            $list[$id] = $cate;
            S('sys_cate_list', $list); //更新缓存
        }
        return is_null($field) ? $list[$id] : $list[$id][$field];
}
function get_cate_nameByid($id){
	
	$map['id']=$id;
	$name = M('Cate')->where($map)->getField('name');
	return $name;
}
function get_cate_typeByid($id){

	$map['id']=$id;
	$type = M('Cate')->where($map)->getField('type');
	return $type;
}

function getcpid($id){
	
	
	$map['id']=$id;
	$pid = M('Cate')->where($map)->getField('pid');
	if($id==0){
		$pid=0;
	}
	
	return $pid;
}
function getcidparent($cid){
	
	$map['id']=$cid;
	$spid = M('Cate')->where($map)->getField('spid');
	
	$arr=explode('|', $spid);
	if($arr[0]==0){
		return $cid;
	}
   if($cid==0){
   	
   	return 0;
   }
	return $arr[0];
}
function getcidinfo($id){
	$map['id']=$id;
    $cid=M('Article')->where($map)->getField('cid');
    $cidinfo=M('Cate')->where('id='.$cid)->find();
    $navigation=" <a href=''>主页</a> > <a href=''>".$cidinfo['name']."</a>  ";
    if($cidinfo['pid']!=0){
    	$p2=M('Cate')->where('id='.$cidinfo['pid'])->find();
    	$navigation=" <a href='/'>主页</a> > <a href='/index.php?m=Blog&c=Index&a=artlist&cid=".$p2['id']."'>".$p2['name']."</a> > <a href='/index.php?m=Blog&c=Index&a=artlist&cid=".$cidinfo['id']."'>".$cidinfo['name']."</a>  ";
        if($p2['pid']!=0){
        	$p3=M('Cate')->where('id='.$p2['pid'])->find();
        	$navigation="<a href='/'>主页</a> > <a href='/index.php?m=Blog&c=Index&a=artlist&cid=".$p3['id']."'>".$p3['name']."</a> > <a href='/index.php?m=Blog&c=Index&a=artlist&cid=".$p2['id']."'>".$p2['name']."</a> > <a href='/index.php?m=Blog&c=Index&a=artlist&cid=".$cidinfo['id']."'>".$cidinfo['name']."</a> ";
        }
    }
    
    return($navigation);

}