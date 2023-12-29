<?php

// 数据库配置

$databases_config = array(

    // 数据库服务器
    'host' => 'localhost',

    // 数据库用户名
    'user' => 'root',

    // 数据库密码
    'password' => 'root',

    // 数据库昵称
    'user_name' => 'donorc',

    // 数据库端口
    'port' => 8889


);

try {
    $GLOBALS['databases'] = mysqli_connect(
        $databases_config['host'],
        $databases_config['user'],
        $databases_config['password'],
        $databases_config['user_name'],
        $databases_config['port']
    );
}catch (Exception $e){
    // 连接失败不响应任何信息
}