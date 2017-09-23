<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

//绝对路径
define('JY_ROOT',dirname(__FILE__).DIRECTORY_SEPARATOR);

// 服务器地址

define('SERVER_DOMAIN_NAME','http://192.168.0.156/');

//图片地址
define('IMG_URL','http://192.168.0.156/');

//爱贝支付文件
define('IAPPPAY',JY_ROOT.'thirdpay/iapppayforphp/');

//proto-php 文件
define('PROTOC_PATH', JY_ROOT.'protoPhp/');

//游戏服务器请求地址
define('SERVER_PROTO', 'http://192.168.0.151:80');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单