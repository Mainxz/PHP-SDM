<?php

// 接口调用主方法入口

namespace App;

// 配置接口根目录
$_SERVER['DOCUMENT_ROOT'] .= '/';

use App\Api\main;
use App\Api\Posh;

include $_SERVER['DOCUMENT_ROOT'] . '/src/main.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/Posh.php';
include $_SERVER['DOCUMENT_ROOT'] . '/config/databases.php';

ini_set("display_errors", "On");//打开错误提示
ini_set("error_reporting",E_ALL);//显示所有错误

date_default_timezone_set('PRC'); // 设置时区

// 推送客户端数据
Posh::Poshs(

    // 传递服务对象
    main::servioc(

        main::get_serves(),                     // 获取服务标识

        'model',                           // 服务层 默认第一层 model模型层

        (array)null,                            // 传递服务对象数据

        (array)null                             // 传递服务方法数据

    )

);


