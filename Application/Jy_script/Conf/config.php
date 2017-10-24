<?php
return array(

    'DB_TYPE'               =>  'mysql',                         // 数据库类型
 //  'DB_HOST'               =>  '120.78.55.73',                  // 服务器地址
   'DB_HOST'               =>  '192.168.0.156',                  // 服务器地址
    'DB_NAME'               =>  'jyhd',                         // 数据库名
    'DB_USER'               =>  'root',                          // 用户名
    'DB_PWD'                =>  '.123456',                        // 密码
   //'DB_PWD'                =>  'jyhd.mysql.1112',                        // 密码
    'DB_PORT'               =>  '3306',                          // 端口
    'DB_PREFIX'             =>  '',                           // 数据库表前缀
    'DB_DEBUG'  			=>  false,                           // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  false,                            // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',                          // 数据库编码默认采用utf8
    'URL_MODEL'             =>  2,       // URL访问模式:0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'DB_DEPLOY_TYPE'        =>  0,                                              // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,                                          // 数据库读写是否分离 主从式有效
    'DB_PARAMS'             => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),  //数据字段名区分大小写
    'ACCESS_lOGS'           => true,
);