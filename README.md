#  pay第三方支付系统，自带监控软件和后台管理系统+商户后台管理系统
## 全新开发的第三方支付系统源码，自带软件监控。对接支付宝，后续将会陆续添加更多特性。
## 下载:
* 蓝奏云下载: [点我下载](https://fusong.lanzous.com/b01c5m8aj
)密码:felk 
## 介绍:
* 前端利用vue开发，
* 后端利用thinkphp开发
## 文档说明:
### 体验:
* 管理员后台:[点我进入](http://103.152.170.170:8083/public/index.php/admin)
* 商户后台:[点我进入](http://103.152.170.170:8083/public/index.php/user)
## 系统搭建使用方法:
* 解压放入网站目录下访问域名即可(如果需要全新安装只需要删除/public/install 目录下的install.lock和config.db.php文件即可)
## 商户对接方法:
* 下载监控软件
* 到官网注册申请商户信息
* 填写商户信息到软件启动运行
* 下载集成SDK包集成到自己的网站(看开发文档)
## 注意事项:
* 软件一定要给予通知栏权限！！(否则无法监控)，自启动，以防被杀死
* 支付宝语音一定要打开，保证能正常播报,授予微信消息通知权限
* 软件监控订单日志文件在sd卡目录下的payLog.txt文件
## 项目目录结构:
~~~
├─application           应用目录
│  ├─index            公共模块目录（可以更改）
│          模块目录
│  │  ├─common.php      模块函数文件
│  │  ├─controller      控制器目录
│  │  ├─model           模型目录
│  │  ├─view            视图目录
│  │  └─ ...            更多类库目录
│  │
│  ├─command.php        命令行定义文件
│  ├─common.php         公共函数文件
│  └─tags.php           应用行为扩展定义文件
│
├─config                应用配置目录
│  ├─module_name        模块配置目录
│  │  ├─database.php    数据库配置
│  │  ├─cache           缓存配置
│  │  └─ ...            
│  │
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─cookie.php         Cookie配置
│  ├─database.php       数据库配置
│  ├─log.php            日志配置
│  ├─session.php        Session配置
│  ├─template.php       模板引擎配置
│  └─trace.php          Trace配置
│
├─route                 路由定义目录
│  ├─route.php          路由定义
│  └─...                更多
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~

### 核心后端源码接口:
* api.php:网页端请求接口
* corn.php:监控软件端请求接口
* db.sql:创建数据库文件(导入即可)
* payCorn.php:网页端付款状态循环请求状态接口
* notifaction.php 支付成功支付回调处理文件
### 支付界面截图:
[![DkpxF1.jpg](https://s3.ax1x.com/2020/11/16/DkpxF1.jpg)](https://imgchr.com/i/DkpxF1)
### 后台管理系统截图:
[![69CbKP.jpg](https://s3.ax1x.com/2021/02/27/69CbKP.jpg)](https://imgtu.com/i/69CbKP)
### 商户后台系统截图:
[![69C2DK.jpg](https://s3.ax1x.com/2021/02/27/69C2DK.jpg)](https://imgtu.com/i/69C2DK)
## 对接开发文档:
* 开发中
# 日志:
## 2020-12-14 全新改版！功能全部实现。
## 2020-12-15 修复监控bug，添加跳转到支付宝app，修复监控安全问题，强制更新！
## 2021-1-11  添加支付成功提示
## 2021-1-13  添加监听微信支付和qq支付(暂时监听功能不可用)
## 2020-1-14  添加集成SDK包，全新SDK版支付系统重构
## 捐赠:
[捐赠](http://103.152.170.170:8088/demo/counter1.php)
