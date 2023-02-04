# 聚合云支付系统(yunPay)=自建的监控支付系统+集成官方支付+自带监控(移动+PC端)软件+后台管理系统+商户后台管理系统
![image](https://user-images.githubusercontent.com/70237653/216788412-4eecc4b4-0adb-4520-af41-e2ebc0a29bb1.png)

## 开发者

- 所有人:小松科技
- 邮箱: 1466718670@qq.com
- 说明:本系统是我花费大量精力和时间完成的，给我 star 下我就满足了。有任何问题都可以私信我


## 环境说明
* php: 建议7.0 如果出现一些问题请切换php版本
## 鸣谢 🍓

- vue
- Ant Design vue
- element
- Euiadmin
- thinkphp
- autojs
- electron
- nodejs
## 在线文档
https://www.showdoc.com.cn/1819524507474584/8398407783645943
## 文档引导

- [下载](#1)
- [项目目录结构](#2)
- [项目截图](#3)
- [体验](#4)
- [集成支付](#12)
- [系统搭建方法](#7)
- [支付接口文档](#13)
- [官方支付方法参数](#14)
- [SDK 文档](#5)
- [监控软件](#6)
- [通用接口地址](#8)
- [商户对接说明](#9)
- [日志更新](#10)
- [注意事项](#11)

## 监听软件演示

http://pay.xskj.store/down/pSAzEFVCtePI


## <a id="12">支付集成:</a>

- 支付宝支付
- 微信支付
- 云支付(自建软件监控支付--安卓端+PC端)

## 软件支付监听对象:

- 支付-------ok
- 微信支付------ok
- QQ------暂时不支持
- PC端仅支持监听支付宝，而且需要以管理员身份运行应用。现在处于实际场景测试中。
- 声明：监控软件不能保证100%的能监控层弄，可能会有掉单的情况，而且不适用大的业务场景和高请求量监控。

## 安全声明:

- 不建议软件监听支付用于商业用途，该程序不适用于大型支付场景，适用于小型支付场景。监听成功比例与支付接口调用频率成反比。
- 每个个体支付时间间隔需要大于 2 分钟。该时长与支付页面等待时长一致。
- 设置不同金额会增加监听支付成功比例。
- 后期会不断优化提高支付成功比例。

## <a id="1">下载:</a>

#### 完整包下载:

- v1.0 下载(仅支持软件支付监听): [点我下载](https://fusong.lanzous.com/i43H8ma4h2f)
- v2.0 下载(集成官方支付宝):[点我下载](https://fusong.lanzous.com/b01c5xw7g)密码:fw9w
- v3.x 下载(添加PC端监控支付):  [点我下载](https://fusong.lanzoul.com/b01d562xg)  密码:co5g

#### 拓展包下载:

- SDK 下载:[请下载对应版本的 SDK](https://fusong.lanzoul.com/b01c5y0ib)密码:e6y9
- 移动端监控软件下载:[下载](https://fusong.lanzoul.com/b01d5633c)密码:g87s
- PC端监控软件下载:[下载](https://fusong.lanzoul.com/b01d5632b)密码:d8ug
- 手动更新包:[请对外对应版本的更新包](https://fusong.lanzous.com/b01c5y4uh)密码:3z2p
- 云端监控脚本:  [下载][(https://fusong.lanzous.com/b01c5y4uh](https://fusong.lanzoul.com/b01egtwad
)密码:9ym6
## 介绍:

- 前端利用 vue 开发，
- 后端利用 thinkphp 开发

## <a id="2">项目核心目录结构 </a>

```
├─application           接口目录
│  ├─index             首页接口目录
│  ├─admin             管理员后台接口目录
│  ├─user              商户后台接口目录
│  ├─pay               官方支付接口目录
│  └─route.php         路由配置文件
├─demo                 支付系统测试目录(demo)
│
├─SDK                  支付系统集成sdk下载目录(更新时保持其文件名不变！！！，否则会下载出错)
│  ├─sdk.zip          集成支付系统SDK压缩包
│  └─云支付.apk        监控软件
│
├─template               模版目录
│  ├─admin              管理员后台模版目录
│  └─user               商户后台模版目录
│
├─pay                    支付系统核心源码{核心源码}
│  ├─js                 js类库目录
│  ├─lib                相关类库目录
│  ├─payPage            支付界面模版目录
│  │ └─pay_pages_default.php    默认支付界面文件
│  ├─corn.php           监控软件端请求接口
│  ├─api.php            支付接口(核心接口)
│  ├─payCorn.php        网页端付款状态循环请求状态接口
│  ├─notifaction.php    支付回调通知处理文件(常用于同步通知和异步通知处理)
│  ├─qr.php             支付二维码生成文件
│  ├─database.php       数据库配置文件
│  └─db.sql             数据库备份文件
│
├─public                 WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─install            系统程序安装引导文件目录
│     ├─config.db.php   系统数据库配置文件(修改数据库信息在这里修改)
│     └─install.lock    安装锁文件(需要重新安装程序时删除该文件和config.db.php文件即可)
│
├─thinkphp              thinkphp核心类库源码目录
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
├─vendor                第三方类库文件目录
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─index.phhp            项目入口文件
```

## <a id="13">支付接口文档:</a>

> 默认支付接口 api:

```
http://域名或ip/public/index.php/pay
```

> 请求方法:GET

#### 请求参数:

|     参数     |                   含义                   |  类型  |                         说明                         |
| :----------: | :--------------------------------------: | :----: | :--------------------------------------------------: |
|      id      |                 商户 id                 |  int  |                         必传                         |
|     sign     |                签名 (md5)                |  int  |            必传(具体签名规则下面会有说明)            |
|   trade_no   |             商户网站订单编号             | string |                         必传                         |
|     type     |   支付类型(支付宝 1，微信 2，云支付 3)   |  int  |                         必传                         |
|   subject   |                 商品名称                 | string |                         必传                         |
|   yun_type   |              云支付支付类型              |  int  | (默认支付宝:支付宝 1，微信 2)主要是在 软件监听时用到 |
| total_amount |                   金额                   | float |                         必传                         |
| description |                 商品描述                 | string |                         可传                         |
|    remark    |                 商品备注                 | string |                         可传                         |
|   category   |                 商品分类                 | string |                         可传                         |
| pay_methods | 官方支付方法(默认 web 类型:下面会有说明) | string |                         可传                         |
|  return_url  |               同步通知地址               | string |                         必传                         |
|  notify_url  |               异步通知地址               | string |             可传(默认通知地址为同步通知)             |

#### <a id="14">微信支付 pay_methods 方法参数:</a>

|     参数     |        含义        |
| :----------: | :----------------: |
|      mp      |     公众号支付     |
|     wap     | 手机网站支付(默认) |
|     app     |      APP 支付      |
|     pos     |      刷卡支付      |
|     scan     |      扫码支付      |
|   transfer   |      账户转账      |
|     mini     |     小程序支付     |
|   redpack   |      普通红包      |
| groupRedpack |      裂变红包      |

#### `<a id="14">`支付宝支付 pay_methods 方法参数:`</a>`

|   参数   |      含义      |
| :------: | :------------: |
|   web   | 电脑支付(默认) |
|   wap   |  手机网站支付  |
|   app   |    APP 支付    |
|   pos   |    刷卡支付    |
|   scan   |    扫码支付    |
| transfer |    账户转账    |
|   mini   |   小程序支付   |

#### 签名:

- 签名算法:MD5
- 算法规则:
  total_amount(金额)+trade_no(商户网站订单编号)+key(商户密钥)
- php 签名:(其他语言需要自行百度)

```php
$sign=md5($total_amount.$trade_no.$key)
```

### 云支付(软件监控支付)核心后端源码文件:

- api.php:网页端请求接口
- corn.php:监控软件端请求接口
- db.sql:创建数据库文件(导入即可)
- payCorn.php:网页端付款状态循环请求状态接口
- notifaction.php 支付成功支付回调处理文件

## <a id="3">截图展示 </a>

#### 支付界面截图:

[![DkpxF1.jpg](https://s3.ax1x.com/2020/11/16/DkpxF1.jpg)](https://imgchr.com/i/DkpxF1)

#### 后台管理系统截图:

[![69CbKP.jpg](https://s3.ax1x.com/2021/02/27/69CbKP.jpg)](https://imgtu.com/i/69CbKP)

#### 商户后台系统截图:

[![69C2DK.jpg](https://s3.ax1x.com/2021/02/27/69C2DK.jpg)](https://imgtu.com/i/69C2DK)

## <a id="4">体验:</a>

> 如果不想自己搭建系统，可以在这里申请商户集成。

- 管理员后台:[点我进入](http://pay.xskj.store/public/index.php/admin)
- 商户后台:[点我进入](http://pay.xskj.store/public/index.php/user)
- 支付测试:[点我进入](http://pay.xskj.store/demo)

## <a id="7">系统搭建使用方法:</a>

- 解压放入网站目录下访问域名即可(如果需要全新安装只需要删除/public/install 目录下的 install.lock 和 config.db.php 文件即可)
- 提示:在宝塔环境下会出现没有入口文件的情况 ,需要删除宝塔生成的防跨站文件.user.ini 文件即可

## <a id="8">通用接口地址:</a>

- 支付接口:`http://域名/public/index.php/pay`
- 移动端软件监控地址:`http://域名/pay/corn.php`
- demo 测试地址:`http://域名/demo`
- 移动端监控软件下载地址:`http://域名/SDK/云支付.apk`
- 集成包 SDK 下载地址:`http://域名/SDK/sdk.zip`

## <a id="9">商户对接方法:</a>

- 第一步:申请商户:到官网[这里的官网指用该程序搭建的网站]注册申请商户信息([点我注册](http://103.152.170.170:8083/public/index.php/user))
- 第二步:下载监控软件和 SDK 集成包:登陆商户后台，
- 第三步:基层 SDK 到自己网站:下载集成 SDK 包集成到自己的网站(看开发文档)

## SDK 文档说明:

#### <a id="5">SDK 对接文档:</a>

###### 核心文件:

- yunPay.config.php:商户信息配置文件
- yunApi.php: 调用 SDK 支付接口文件
- notify_url.php: 异步支付处理文件
- return_url.php: 同步跳转处理文件(主要 SDK 集成业务逻辑处理文件)

###### yunApi.php 接收参数:

> 请求方法:同时支持 GET 或 POST

> 说明:具体参数详见 SDK 下的 help.txt 文件说明。具体以 SDK 下的 help.txt 文件为准

|    参数    |                        含义                        |  类型  |                         说明                         |
| :---------: | :------------------------------------------------: | :----: | :--------------------------------------------------: |
|  trade_no  |                  商户网站订单编号                  |  int  |                         必传                         |
|    type    | 支付类型 (支付宝 1，微信 2，云支付(软件监控支付)3) |  int  |                         必传                         |
| goods_name |                       商品名                       | string |                         必传                         |
|    money    |                        金额                        | float |                         必传                         |
| pay_methods |               官方支付方法(默认也可)               | string |                  可传 官方支付用到                  |
|  yun_type  |                   云支付支付类型                   |  int  | (默认支付宝:支付宝 1，微信 2)主要是在 软件监听时用到 |
|   pay_tag   |                      商品备注                      | string |                         可传                         |
| description |                      商品描述                      | string |                         可传                         |
|  sitename  |                      站点名称                      | string |                         可传                         |
|  category  |                      商品分类                      | string |                         可传                         |

###### 商户信息配置文件 yunPay.config.php:

```php
<?php
/* *
 * 功能：云支付商户信息配置
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究云支付接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 */

/**********↓↓↓↓↓云支付商户信息↓↓↓↓↓↓**********/

//云支付商户ID
$yunPay_config['id'] =  10008 ;

//云支付商户密钥
$yunPay_config['key'] = "Pyy9USk7cVyi2MZNI7LghulwugkGVrGL";

//云支付签名token 必填
$yunPay_config['token'] = "xskj";

//签名方式 不需修改
$yunPay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$yunPay_config['input_charset']= strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$yunPay_config['transport']    = 'http';

//异步通知地址，如果改SDK上传在根目录则默认不用修改，否则应该修改
$yunPay_config['notify_url'] = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/yunPay/notify_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数

//页面跳转同步通知页面路径
$yunPay_config['return_url'] = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/yunPay/return_url.php";
//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

//支付API地址   后面不要加"/"
$yunPay_config['apiurl']    = 'http://103.152.170.170:8083/pay/api.php';
```

###### 支付回调参数(暂时为同步通知回调 return_url.php):

> 回调方法:GET

> 说明:具体参数详见 SDK 下的 help.txt 文件说明。具体以 SDK 下的 help.txt 文件为准

|   参数   |                  含义                  |           类型           |
| :------: | :------------------------------------: | :----------------------: |
|  status  |                支付状态                | int(1:支付成功;0:未支付) |
|   type   | 支付类型 (支付宝 1，微信 2，QQ 支付 3) |           int           |
|  money  |                  金额                  |          float          |
| trade_no |      商户网站订单编号(非云订单号)      |          string          |
|   sign   |                  签名                  |          string          |

- 签名算法:md5
- 算法公式:
  total_amount(金额)+trade_no(商户网站订单编号)+key(商户密钥)
- php 签名算法例子:

```php
$sign=md5($total_amount.$trade_no.$key)
```

- 说明:sdk 已经为您封装好了签名算法，您只需要处理接收参数逻辑即可
- 同步回调(return_url.php)SDK 代码:

```php
<?php
/*
*介绍:这是同步通知处理
*时间:2021-2-27
*开发者:小松科技
*/

/****接口参数文档:
Methods:GET
接收参数:
@param: status   支付状态  int  1:成功;0:失败
@param: money   支付金额  int
@param: type  支付类型 int  1：支付宝 2：QQ钱包 3：微信支付。默认值：1
@param: trade_no  商户网站订单编号 int
@param: sign    签名   string
**/
require_once("lib/Sign.php");
$order=array(
  "sign"=>$_GET["sign"],
  "status"=>$_GET["status"],
  "money"=>$_GET["money"],
  "type"=>$_GET["type"],
  "trade_no"=>$_GET["trade_no"]
);
//验证签名算法
$result=new Sign($order);
$is=$result->verify_sign();
if($is){
//验证签名成功↓↓↓↓↓↓↓↓↓这里处理自己的业务逻辑

echo "支付成功！";

}else{
//验证签名失败
echo "签名验证失败！";
}
```

##### <a id="6">监听软件设置:</a>

- 声明:该支付监听软件只监听微信和支付宝支付金额信息。不会监听其他敏感信息。更不会监听用户个人信息。源代码完全开放(如下)(请大家下载正版官网的监听软件，以防被二次开发从事用户信息监听。！！！)

```javascript
auto();
var str;
var str1;
//启动通知栏监控
events.observeNotification();
events.on("notification", function (n) {
  if (n.getTitle() != null) {
    //支付宝监听
    if (n.getPackageName() == "com.eg.android.AlipayGphone") {
      str = n.getTitle();
      //支付宝通过正则判断提取
      str1 = str.match(/你已成功收款(.*)元/);
      if (str1 != null) {
        //获取成功
        log(str1);
        log(str1[1]);
        //调用api
        var response = payApi(str1[1], 1);
        //写进日志文件
        writeLog(response, 1);
        toast("小松云支付:" + response);
      }
    }
    //微信支付监听
    if (n.getPackageName() == "com.tencent.mm" && n.getTitle() == "微信支付") {
      str1 = n.getText();
      //支付宝通过正则判断提取
      str2 = str1.match(/微信支付收款(.*)元/);
      log(str2);
      if (str2 != null) {
        //获取成功
        log(str2);
        log(str2[1]);
        //调用api
        var response1 = payApi(str2[1], 2);
        //写进日志文件
        writeLog(response1, 2);
        toast("小松云支付:" + response1);
      }
    }
    //打印
    log(n.getTitle());
  }
});
//支付异步回调api
function payApi(money, type) {
  /*参数说明:
   *@param:money  金额
   *@param:type   支付方式(支付宝1,微信2, QQ3)
   */
  //本地数据获取
  var storage = storages.create("pay");
  var data = storage.get("paySite");
  //接口地址
  var url = data.url;
  //传输内容
  var data1 = {
    id: data.ID,
    key: data.key,
    money: money,
    type: type,
  };
  //发起请求
  var res = http.get(
    url +
      "?id=" +
      data1.id +
      "&key=" +
      data1.key +
      "&money=" +
      data1.money +
      "&type=" +
      data1.type
  );
  log(res.statusCode);
  //res响应判断
  if (res.statusCode == 404) {
    return "网络异常或url有误！";
  } else if (res.statusCode >= 200 && res.statusCode < 300) {
    //回调成功
    var resp = res.body.string();
    log(resp);
    return resp;
  } else {
    return "未知异常";
  }
}
function writeLog(inform, type) {
  /*参数说明:
   *@param:inform  返回信息
   *@param:type   支付方式(支付宝1,微信2, QQ3)
   */
  //获取当前时间
  var date = new Date();
  //年
  var year = date.getFullYear();
  //月
  var month = date.getMonth() + 1;
  //日
  var day = date.getDate();
  //时
  var hh = date.getHours();
  //分
  var mm = date.getMinutes();
  //秒
  var ss = date.getSeconds();
  var time = year + "年" + month + "月" + day + "日" + hh + ":" + mm + ":" + ss;
  //支付方式判断
  if (type == 1) {
    pay_type = "支付宝";
  } else if (type == 2) {
    pay_type = "微信";
  } else if (type == 3) {
    pay_type = "QQ";
  } else {
    pay_type = "未知支付方式";
  }
  //订单编号 正则匹配
  var order_no = inform.match(/\d+/i);
  //服务器返回信息
  var information =
    "时间:" +
    time +
    "\r\n" +
    "订单编号:" +
    order_no +
    "\r\n" +
    "支付方式:" +
    pay_type +
    "\r\n" +
    "状态信息:" +
    inform +
    "\r\n" +
    "\r\n";
  var path = "/sdcard/payLog.txt";
  if (!files.exists(path)) {
    files.create(path);
    files.append(path, "软件监控服务器日志信息:\r\n");
  }
  files.append(path, information);
  log(information);
}
```

- 所需权限:通知栏权限,无障碍。
- 支付宝:支付宝请打开收款语音提示(不要调成静音模式)
- 微信:开启微信收款到账提示
- 监听软件(云支付):保持软件持续运行,让软件保持存活状态,以免被系统查杀。

## <a id="11">注意事项:</a>

- 软件一定要给予通知栏权限！！(否则无法监控)，自启动，以防被杀死
- 支付宝语音一定要打开，保证能正常播报,授予微信消息通知权限
- 软件监控订单日志文件在 sd 卡目录下的 payLog.txt 文件

## 对接开发文档:

- 开发中

# <a id="10">日志:</a>

## 2020-12-14 全新改版！功能全部实现。

## 2020-12-15 修复监控 bug，添加跳转到支付宝 app，修复监控安全问题，强制更新！

## 2021-1-11 添加支付成功提示

## 2021-1-13 添加监听微信支付和 qq 支付(暂时监听功能不可用)

## 2020-1-14 添加集成 SDK 包，全新 SDK 版支付系统重构

## 2021-3-1 集成官方支------支付宝和微信(重构集成聚合支付接口)------文档全面更新+后端更新(请下载版本 v2.0)

## 2021-3-2 更新前端模版部分 bug

## 2022-1-28 更新v3.0版本，增加PC端监控，修改SDK开发包，修复部分bug。修复user表添加失败的bug。添加SDK接口字段:category  商品分类。

## 2023-2-4 添加支付宝PC端监控软件，更加稳定，以及云端监控脚本，挂载服务器运行即可。具体用法见上方文档。
## 捐赠:


# PC新版监控软件使用说明
###[下载链接](https://fusong.lanzoul.com/b01d5632b  "下载链接")
密码: d8ug
![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=5c24e014ec7ee109f99cd55f9bfd48fc&file=file.png)

###文件介绍
![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=641d503daa24df1d970191f3d63e992d&file=file.png)
### 使用方法
* 1 管理员身份打开
![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=ec2aa809aefcfe164ef6064e66e971cf&file=file.png)
* 2 填写信息登录：这里的服务器地址是你申请的地址
![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=938e416d34cc1d8e7fdc0e3fd6f6f8be&file=file.png)
* 3 这里不是核心！！！
	 - 第一：点击扫码登录按钮，等待右下角出现二维码图片
	 - 第二：打开支付宝，扫码登录，这里注意！只要你手机显示登录成功即可，因为这里不会给提示是否登录成功，以你的手机支付宝为准。
	 - 第三：开始监控，点击“启动监控”按钮，
	 - 当你要关闭时，只要将窗口1关闭即可

![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=99ecbcb8e9907cf015c8f948bae8c960&file=file.png)

![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=a21f4c2592fa19c6d688ddfa3007e098&file=file.png)

![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=f5d75529b80b5b30cd1f0b85a1a34d24&file=file.png)
![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=523ae054f17836c58d25c611157c102a&file=file.png)

![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=24b4a7fa9d75e844b520c8d293671d55&file=file.png)

![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=660397a342e9d9c96527e3ca5d429e03&file=file.png)
![](https://www.showdoc.com.cn/server/api/attachment/visitFile?sign=390ea20546b2a2622aa23becf1d950ed&file=file.png)
# 云端监控脚本使用说明





[捐赠](http://103.152.170.170:8083/demo)
