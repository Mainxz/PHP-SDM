# SDM框架

本框架专为API打造快速简单高效并且轻量化处理
https://sdm.feicman.com

# 框架介绍

结构：sdm框架主打面向对象编程开发可后端开发且兼容MVC模式开发，后端服务SERVER入口/public

优势：面向对象编程同时且可以动态指定整个程序中任意函数使用，轻量化处理线程做到无关当前调用对象代码一律不读节省服务器资源，开发简单易学

稳定性：稳定堪比java spring boot，性能基于开发者使用当前框架对程序的细节把控，处理直奔对象，在于服务器性能决定处理速度，框架系统代码极少几乎无任何消耗服务器资源，做到秒处理，稳定，开发效率高

# 架构目录

/public  服务路径

/src  程序目录

/src/model  模型层

/src/build  业务层

/src/components  复用层

/src/basesdata  数据层

/config  配置服务

# 接口调用

域名/public/?s=服务对象

# return传参架构

返回数据结构一共为3个参数，(bool) s 处理结果， (array) d 数据，(String) (m) 提示

例如:

return array(
    's' => true,
    'd' => array('name' => 'test'),
    'm' => '这是一个提示'
);

推送客户端：

{
state: 1,
data: {
name: "test"
},
msg: "这是一个提示"
}

其中s参数如果为false，state值将为0，true则state值为1

# 推送配置

可在/src/Posh.php内配置新增推送方法自定义数据结构

# main::serveioc 创建服务对象

可参考/public/index.php程序入口内serveioc方法递交参数结构

该方法可以创建自定义动态空间类方法实例并且执行，可实现自定义处理层级递交处理从而达到a层处理后交给b层处理，大大的可细分程序业务且提交运行效率

# 数据库配置

/config/databases.php

# 数据库调用

main::databases(SQL命令)

返回类型：数据库执行返回

# 版本

v1.0.9

# 声明

作者：Main/小泽
作者微信/QQ：700498
BY©️昆明高新技术产业开发区冈川网络工作室

# 更新日志

v1.0.9

1.新增接口根目录配置
2.新增数据库语句错误提示调用错误位置
3.新增获取服务标识方法

v1.0.8

1.新增代码报错显示
2.新增设置时区

v1.0.7

1.新增error报错函数增加系统可维护性

v1.0.6

1.修复提取basesdata全部数据row的错误
2.新增basesdata数据库批量执行sql语句函数

v1.0.5

1.修复Posh推送报错空变量
2.修复对象不齐全或缺少报错
3.新增basesdata_get方法获取数据库数据

v1.0.4

1.修复Posh推送state状态问题
2.新增serveioc服务对象不存在显示对象路径
3.新增isset函数预验证变量提升兼容
4.优化Posh推送客户端Poshs的sdm数据架构

v1.0.3

1.修复服务对象serveioc重复重名无法运行
2.新增全局服务对象实例分区SERVER_OBJECT
3.优化服务运行架构提升性能

v1.0.2

1.修复serveioc异常不推送
2.修复mysql数据库执行成功报错
3.新增src目录basesdata数据层
4.新增显示不存在的服务和对象

v1.0.1

1.Posh::Poshs新增exit函数
2.无需Posh::Poshs后使用exit结束
