<?php
namespace User\Model;

use Think\Model;
use Blog\Model\MemberModel;

require_once(APP_PATH . 'User/Conf/config.php');
require_once(APP_PATH . 'User/Common/common.php');

/**
 * 会员模型
 */
class UcenterMemberModel extends Model
{
    /**
     * 数据表前缀
     * @var string
     */
    protected $tablePrefix = UC_TABLE_PREFIX;

    /**
     * 数据库连接
     * @var string
     */
    protected $connection = UC_DB_DSN;

    /* 用户模型自动验证 */
    protected $_validate = array(
        /* 验证用户名 */
        array('username', '4,16', -1, self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
        array('username', 'checkDenyMember', -2, self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
        array('username', 'checkUsername', -20, self::EXISTS_VALIDATE, 'callback'),
        array('username', '', -3, self::EXISTS_VALIDATE, 'unique'), //用户名被占用
        array('username', 'checkregtime', -35, self::EXISTS_VALIDATE, 'callback'),
        /* 验证密码 */
        array('password', '6,30', -4, self::EXISTS_VALIDATE, 'length'), //密码长度不合法
        array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
        /* 验证邮箱 */
        array('email', 'email', -5, self::EXISTS_VALIDATE), //邮箱格式不正确
        array('email', '1,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
        array('email', 'checkDenyEmail', -7, self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
        array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用

        /* 验证手机号码 */
        array('mobile', '/^1[3|4|5|7|8][0-9]\d{8}$/', -9, self::EXISTS_VALIDATE), //手机格式不正确 TODO:
      
        array('mobile', '', -11, self::EXISTS_VALIDATE, 'unique'), //手机号被占用
    );

    /* 用户模型自动完成 */
    protected $_auto = array(
        array('password', 'think_ucenter_md5', self::MODEL_BOTH, 'function', UC_AUTH_KEY),
        array('reg_time', NOW_TIME, self::MODEL_INSERT),
        array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('update_time', NOW_TIME,3),
        array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
    );
 protected function getStatus()
    {
        return true; 
    }
    protected function checkDenyMember($username)
    {
    	$bluser=explode(',', C('USER_NAME_BAOLIU'));
    	if(in_array($username, $bluser)){
    		return false;
    	}else{
    		return true; 
    	}
    }
protected function checkregtime(){
	if(!is_admin($_SESSION[C('USER_AUTH_KEY')])){
	
     $map['reg_ip'] = get_client_ip(1);
        $reg_time = $this->where($map)->max('reg_time');
    if ($reg_time+C('USER_REG_TIME')*60>time()) {
        return false;
	}else{
		return true;
	}
	}else{
		return true;
	}
}
 
    protected function checkDenyEmail($email)
    {
        return true; 
    }

    protected function checkUsername($username)
    {

        //如果用户名中有空格，不允许注册
        if (strpos($username, ' ') !== false) {
            return false;
        }
        preg_match("/^[a-zA-Z0-9_]{1,30}$/", $username, $result);

        if (!$result) {
            return false;
        }
        return true;
    }


 

    /**
     * 注册一个新用户
     * @param  string $username 用户名
     * @param  string $nickname 昵称
     * @param  string $password 用户密码
     * @param  string $email 用户邮箱
     * @param  string $mobile 用户手机号码
     * @return integer          注册成功-用户信息，注册失败-错误编号
     */
    public function register($username, $nickname, $password, $email, $mobile,$addrole=true)
    {
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'mobile' => $mobile,
        );

        //验证手机
        if (empty($data['mobile'])) unset($data['mobile']);

        /* 添加用户 */
        $usercenter_member=$this->create($data);

        if ($usercenter_member) {
            $result=D('Blog/Member')->registerMember($nickname);
            if($result>0){
                $usercenter_member['id']=$result;
                $uid = $this->add($usercenter_member);
                
                if($addrole){
                	$RoleUser = M("MroleUser");
                	$Role['user_id'] = $uid;
                	$map['score']=array('elt',C('REGSCORE'));
                	$Role['role_id'] = M('mrole')->where($map)->max('id');
                	$RoleUser->add($Role);
                }
                return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
            }else{
                return $result;
            }
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }

    /**
     * 用户登录认证
     * @param  string $username 用户名
     * @param  string $password 用户密码
     * @param  integer $type 用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function login($username, $password, $type = 1)
    {
        $map = array();
        switch ($type) {
            case 1:
                $map['username'] = $username;
                break;
            case 2:
                $map['email'] = $username;
                break;
            case 3:
                $map['mobile'] = $username;
                break;
            case 4:
                $map['id'] = $username;
                break;
            default:
                return 0; //参数错误
        }

        /* 获取用户数据 */
        $user = M('ucenter_member')->where($map)->find();
        if (is_array($user) && $user['status']) {
            return $user['id']; //登录成功，返回用户ID
            /* 验证用户密码 */
            if (think_ucenter_md5($password, UC_AUTH_KEY) === $user['password']) {
                $this->updateLogin($user['id']); //更新用户登录信息
                return $user['id']; //登录成功，返回用户ID
            } else {
                return -2; //密码错误
            }
        } else {
            return -1; //用户不存在或被禁用
        }
    }

    /**
     * 用户密码找回认证
     * @param  string $username 用户名
     * @param  string $password 用户密码
     * @param  integer $type 用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function lomi($username, $email)
    {
        $map = array();
        $map['username'] = $username;
        $map['email'] = $email;
        /* 获取用户数据 */
        $user = $this->where($map)->find();
        if (is_array($user)) {
            /* 验证用户 */
            //if($user['last_login_time']){
            //return $user['last_login_time']; //成功，返回用户最后登录时间
            return $user; //成功，返回用户最后登录时间
            //}else{
            //return $user['reg_time']; //返回用户注册时间
            //return -1; //成功，返回用户最后登录时间
            //}
        } else {
            return -2; //用户和邮箱不符
        }
    }

    /**
     * 用户密码找回认证2
     * @param  string $username 用户名
     * @param  string $password 用户密码
     * @param  integer $type 用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function reset($uid)
    {
        $map = array();
        $map['id'] = $uid;
        /* 获取用户数据 */
        $user = $this->where($map)->find();
        if (is_array($user)) {
            return $user; //成功，返回用户数据

        } else {
            return -2; //用户和邮箱不符
        }
    }

    /**
     * 根据IP获取用户最后注册时间
     * @param  string $uid 用户ID或用户名
     * @param  boolean $is_username 是否使用用户名查询
     * @return array                用户信息
     */
    public function infos($regip)
    {
        $map['reg_ip'] = $regip;
        $user = $this->where($map)->max('reg_time');
        if ($user) {
            return $user;
        } else {
            return -1; //用户不存在或被禁用
        }
    }

    /**
     * 获取用户信息
     * @param  string $uid 用户ID或用户名
     * @param  boolean $is_username 是否使用用户名查询
     * @return array                用户信息
     */
    public function info($uid, $is_username = false)
    {
        $map = array();
        if ($is_username) { //通过用户名获取
            $map['username'] = $uid;
        } else {
            $map['id'] = $uid;
        }

        $user = $this->where($map)->field('id,username,email,mobile,status')->find();
        if (is_array($user) && $user['status'] = 1) {
            return array($user['id'], $user['username'], $user['email'], $user['mobile']);
        } else {
            return -1; //用户不存在或被禁用
        }
    }

    /**
     * 检测用户信息
     * @param  string $field 用户名
     * @param  integer $type 用户名类型 1-用户名，2-用户邮箱，3-用户电话
     * @return integer         错误编号
     */
    public function checkField($field, $type = 1)
    {
        $data = array();
        switch ($type) {
            case 1:
                $data['username'] = $field;
                break;
            case 2:
                $data['email'] = $field;
                break;
            case 3:
                $data['mobile'] = $field;
                break;
            default:
                return 0; //参数错误
        }

        return $this->create($data) ? 1 : $this->getError();
    }

    /**
     * 更新用户登录信息
     * @param  integer $uid 用户ID
     */
    protected function updateLogin($uid)
    {
        $data = array(
            'id' => $uid,
            'last_login_time' => NOW_TIME,
            'last_login_ip' => get_client_ip(1),
        );
        $this->save($data);
    }

    /**
     * 更新用户信息
     * @param int $uid 用户id
     * @param string $password 密码，用来验证
     * @param array $data 修改的字段数组
     * @return true 修改成功，false 修改失败
     * @author huajie <banhuajie@163.com>
     */
    public function updateUserFields($uid, $password, $data)
    {
        if (empty($uid) || empty($password) || empty($data)) {
            $this->error = '参数错误！25';
            return false;
        }

        if($password!='admin'){
        //更新前检查用户密码
        if (!$this->verifyUser($uid, $password)) {
            $this->error = '密码不正确！';
            return false;
        }
        }
        

        //更新用户信息
        $data= $this->create($data, 2); //指定此处为更新数据
        //$data2 = D('Blog/Member')->create($data, 2); //指定此处为更新数据
        if ($data) {
        	
        	
            return $this->where(array('id' => $uid))->save($data);
        }
        return false;
    }

    /**
     * 
     * @param int $uid 用户id
     * @param string $password 密码，用来验证
     * @param array $data 修改的字段数组
     * @return true 修改成功，false 修改失败
     * @author huajie <banhuajie@163.com>
     */
    public function updateUserFieldss($uid, $data)
    {
        if (empty($uid) || empty($data)) {
            $this->error = '参数错误！26';
            return false;
        }
        
       
        	$pass=$this->where(array('id' => $uid))->getField('password');
        
        
        
        //更新用户信息
        
       if (false === $res = $this->create($data, 2)) {

			return  false;
		}else{
		  $res['password']=$pass;
          $res =  array_filter($res);
         
            return $this->save($res);
          
		}
        
      
        
    }

    /**
     * 验证用户密码
     * @param int $uid 用户id
     * @param string $password_in 密码
     * @return true 验证成功，false 验证失败
     * @author huajie <banhuajie@163.com>
     */
    public function verifyUser($uid, $password_in)
    {
        $password = $this->getFieldById($uid, 'password');
        if (think_ucenter_md5($password_in, UC_AUTH_KEY) === $password) {
            return true;
        }
        return false;
    }


    public function addSyncData()
    {

        $data['username'] = $this->rand_username();
        $data['email'] = $this->rand_email();
        $data['password'] = $this->create_rand(10);
        $data1 = $this->create($data);
        $uid = $this->add($data1);
        return $uid;
    }

    public function rand_email()
    {
        $email = $this->create_rand(10) . '@qq.com';
        if ($this->where(array('email' => $email))->select()) {
            $this->rand_email();
        } else {
            return $email;
        }
    }

    public function rand_username()
    {
        $username = $this->create_rand(10);
        if ($this->where(array('username' => $username))->select()) {
            $this->rand_username();
        } else {
            return $username;
        }
    }

    function create_rand($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }


}
