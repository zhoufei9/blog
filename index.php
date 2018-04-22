<?php

if(version_compare(PHP_VERSION,'5.6.0','<'))  die('require PHP > 5.6.0 !');
if (!is_file('./Data/install.lock')) {
	header('Location: ./install.php');
	exit;
}
 
/**
 * 系统调试设置
 * 项目正式部署后请设置为false
 */
define ('APP_DEBUG',true);

/**
 * 应用目录设置
 * 安全期间，建议安装调试完成后移动到非WEB目录
 */
define ( 'APP_PATH', './App/' );

/**
 * 缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define ( 'RUNTIME_PATH', './Runtime/App/' );

/**
 * 引入核心入口
 * ThinkPHP亦可移动到WEB以外的目录
 */
require './ThinkPHP/ThinkPHP.php';