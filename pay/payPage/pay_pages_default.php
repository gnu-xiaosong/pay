<?php
session_start();
//使用轮训不断发起http请求确认服务器最新订单支付状态
//定时器
//var_dump($_GET["data"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title >支付-爱生活，爱支付</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="shortcut icon" href="http://www.imdsx.cn/wp-content/themes/QQ/images/logo.jpg">
    <link href="./css/wechat_pay.css?v=1.0" rel="stylesheet" media="screen">
 
</head>
<body>
  <div id="app">
          <h1 class="mod-title">
         <span  color="red" :class="setClass()"></span>
          </h1>
  
       <div  class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">￥<?php echo $_GET["money"]; ?></div>
        <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
            <div data-role="qrPayImg" class="qrcode-img-area">
                <div class="ui-loading qrcode-loading" data-role="qrPayImgLoading" style="display: none;">加载中</div>
                <div style="position: relative;display: inline-block;">
                    <img id="show_qrcode" alt="加载中..." :src=' "data:image/png;base64,"+imgData' width="210" height="210" style="display: block;">
                    <img  src="./img/use1;.png" style="position: absolute; top: 50%; left: 50%; width: 32px; height: 32px; margin-left: -16px; margin-top: -16px; display: none;">
                </div>
            </div>
        </div>
        
        <div class="time-item">

        <div class="time-item" id="msg">
          <h1>
            <div class="tps_btn" style="padding-top: 10px;">
            <a id="alipay_open_btn" :href="qr_url" target="_blank" style="color: #fff;text-decoration: none; text-align: center;padding: .55rem 0; display: inline-block; width: 88%; border-radius: .3rem; font-size: 14px;background-color: #428bca; border: 1px solid #428bca;letter-spacing:normal;font-weight: normal">点击启动{{type_name}}APP支付</a></div><div class="tps_btn" style="padding-top: 10px;"><a id=""  style="color: #fff;text-decoration: none; text-align: center;padding: .55rem 0; display: inline-block; width: 88%; border-radius: .3rem; font-size: 14px;background-color: #428bca; border: 1px solid #428bca;letter-spacing:normal;font-weight: normal">如无法支付可截屏使用相册扫码</a></div></h1> </div>
            <strong id="hour_show"><s id="h"></s>0时</strong>
            <strong id="minute_show"><s></s>{{minute}}分</strong>
            <strong id="second_show"><s></s>{{second}}秒</strong>
              <div style="color:red">警告:请输入与金额匹配的数额，否则会以掉单处理而无效！！</div>
             <div>如果遇到支付成功还未跳转，则等待到计时：2:42,2:35,2:30,2:00,1:00, 00:20。如还未跳转则请向管理员反馈。</div>
        </div>

        <div id="app1" class="tip">
            <div class="ico-scan"></div>
            <div class="tip-text">
                <p>请使用{{type_name}}
                </p>
                <p>扫描二维码完成支付</p>
            </div>
        </div>
  
  
  
        <div class="detail" id="orderDetail">
            <dl class="detail-ct"  id="desc" style="display: block;"><dt>账号</dt><dd>  
            <?php
echo $_GET["account"];
?>
                </dd>
                <dt>金额</dt>
                <dd>￥<?php echo $_GET["money"]; ?></dd>
                <dt>订单编号</dt>
                <dd><?php echo $_SESSION["trade_no"]; ?></dd>
                <dt>云端订单号</dt>
                <dd><?php echo $_GET["order_no"]; ?></dd>
                <dt>创建时间</dt>
                <dd><?php echo date('Y-m-d-g:ia'); ?></dd>
                <dt>过期时间</dt>
                <dd><?php echo $_GET["outTime"]; ?>分钟</dd>
            </dl>
        </div>
      
      
        <div class="tip-text">
        </div>
         
    <div class="foot">
        <div class="inner">
            <p>手机用户可保存上方二维码到手机中</p>
            <p>在{{type_name}}扫一扫中选择“相册”即可
                </p>
        </div>
    </div>
      
  </div>
</body>
<script src="../js/vue.min.js"></script>
<script src="../js/axios.min.js"></script>
<!-- 引入样式 -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<!-- 引入组件库 -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script>

const app=new Vue({
      el:"#app",
      data:{
      user_id:10001,          //商户id值
      order_no:"",   //订单编号)
      type:"",    //支付方式
      type_name:"", //支付app名称
      imgData:"",
      return_url:"" ,  //同步跳转url
      qr_url:"" ,   //收款码url
      //支付超时时间设置
      minute:2,   
      second:59
      },
      methods:{
        
        //设置class类名
        setClass:function(){
          if(this.type==1){
          //支付宝
          this.type_name="支付宝";
          return "ico_log ico-1";
          }else if(this.type==2){
          //微信
          this.type_name="微信";
          return "ico_log ico-3";
          }else if(this.type==3){
          //qq
          this.type_name="QQ";
          return "ico_log ico-2";
          }else{
          //不显示
          return "";
          }
        },
        
     
 
 
     //获取二维码图片
         getQrImgmg:function(){
                     var that=this;//注意这里是地址转换，因为this指向的最近的类，axios而非Vue
                    axios.get('../qr.php')
  .then(function (response) {
   //给imgData赋值
    console.log(response.data);
    that.imgData=response.data.data;      //获取二维码图片数据流
    that.return_url=response.data.return_url;  //获取页面跳转url
   that.user_id=response.data.user_id;         //获取商户id值
   that.order_no=response.data.order_no;  //获取订单编号
   that.qr_url=response.data.qr_url;  //获取二维码链接
   that.type=response.data.type;  //获取支付方式
   
   
  // that.goToMobileOpenAlipay();
  //  console.log(that.imgData);
  }).catch(function (error) {
    console.log(error);
  });
     
      },
      
      //向服务器发起请求获取最新订单支付状态
      getPayStatus:function(){
      var that=this;
      axios.get('../payCorn.php?user_id='+that.user_id+"&order_no="+that.order_no)
  .then(function (response) {
       console.log(response.data);
        //返回信息判断
        if(response.data.code==200){
           
           //支付成功
           that.$message({
          message: '支付成功! 正在跳转中……',
          type: 'success',
          center:true
        });
           
           document.getElementsByTagName("title")[0].innerText=that.hint;
           //支付状态完成,return_url跳转
        //   alert(that.order_no+response.data.message);
          window.location.href="../notifaction.php";
        }else{
        // console.log(response.data.code);
         console.log(response.data.code);
        // sleep(2000);
      // alert("支付失败！");
        }
  }).catch(function (error) {
    console.log(error);
  });
      }
      },
      mounted(){
      this.getQrImgmg(); //二维码自动加载
       //判断设备，为移动端则跳转打开支付宝
      
      //设置支付类型class
      this.setClass();
      
     // this.goToMobileOpenAlipay();      //轮训
      window.setInterval(() => {
      setTimeout(this.getPayStatus(),0);
      console.log("test");
      

      this.second--;
      if(this.second==0&&this.minute!=0){
       this.minute--;
       this.second=59;
      }
      
      if(this.second==0&&this.minute==0){
      
         //支付超时
      alert("支付超时！");
       window.history.back(-1);
      }

    },1000);
    
      }
});
</script>

</body>
</html>