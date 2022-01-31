


<!DOCTYPE html>
<html>
<head><title>
        在线充值
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'] ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" type="text/css" href="css/userPay.css">

    <style>
        a:link {
            text-decoration: none;
        }

        　　 a:active {
            text-decoration: blink
        }

        　　 a:hover {
            text-decoration: underline;
        }

        　　 a:visited {
            text-decoration: none;
        }

        *, :after, :before {
            /* -webkit-box-sizing: border-box; */
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        button, html input[type=button], input[type=reset], input[type=submit] {
            -webkit-appearance: button;
            cursor: pointer;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="loadingPicBlock" style="max-width: 720px;margin:0 auto;" class="pay">
 <div id="app">
    <header class="g-header">

        <div class="head-r">
            <a href="/" class="z-HReturn" data-dismiss="modal" aria-hidden="true"><s></s><b>首页</b></a>
        </div>
    </header>

    <div class="g-Total gray9">请选择需要充值的金额</div>
    <section class="clearfix g-member">
        <div class="g-Recharge">
            <ul id="ulOption">
                <!--注意修改金额 需要同时修改前面的值 money="10" -->
                <li @click="changPrice(10)"><a >10元<s></s></a></li>
                <li @click="changPrice(20)"><a href="javascript:;">20元<s></s></a></li>
                <li @click="changPrice(50)"><a href="javascript:;" class="z-sel">50元<s></s></a></li> <!--class="z-sel" 表示默认选中50元-->
                <li @click="changPrice(100)"><a href="javascript:;">100元<s></s></a></li>
                <li @click="changPrice(200)"><a href="javascript:;">200元<s></s></a></li>
                <li @click="changPrice(500)"><a href="javascript:;">500元<s></s></a></li>
            </ul>
        </div>

            <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
                <ul id="ulBankList">
                    <li class="gray6" style="width: 100%;padding: 5px 0px 0px 10px;height: 50px;">您选择充值：<label
                            class="input" style="border: 1px solid #EAEAEA;height: 35px;font-size:30px;">
                            <input type="text"  placeholder="如：50"  v-model="pay_price"
                                   style="width: 170px;color: red;font-size:20px;">   <!--默认输入金额值50-->
                        </label> 元
                    </li>
                    <li class="gray6"
                        style="width: 100%;padding: 5px 0px 0px 10px;display: <?php echo $codepay_config['userOff'] && $user ? 'none' : 'inline'; ?>;height: 50px;">
                        充值用户名：<label
                            class="input" style="border: 1px solid #EAEAEA;height: 30px;font-size: 30px;">
                            <input type="text"  placeholder="用户名" value='<?php echo $_GET["id"] ?>'
                                   style="width: 180px;font-size: 16px;">
                        </label></li>
                        
                        
                    <li @click="paytype(1)" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;" class="z-initsel"><img src="img/alipay.jpg"><s></s></a>

                    </li>
                    <li @click="paytype(2)" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;"><img src="img/weixin.jpg"><s></s></a>

                    </li>
                    <li @click="paytype(3)" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;"><img src="img/qqpay.jpg"><s></s></a>
                    </li>
                    
                    
                </ul>
            </article>
            <input type="hidden" id="pay_type" value="1" name="type"> <!--值1表示支付宝默认-->
            <input type="hidden" value="<?php echo $salt; ?>" name="salt">
    
            <div class="mt10 f-Recharge-btn">

                <button id="btnSubmit" type="submit" @click="payApi()" class="orgBtn">确认支付</button>
            </div>
       
    </section>

    <input id="hidIsHttps" type="hidden" value="0"/>
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/vue.min.js" type="text/javascript"></script>
        <script src="js/axios.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
             $(function () {
            var c;
            var g = false;
            var a = null;
            var e = function () {
                $("#ulOption > li").each(function () {
                    var n = $(this);
                    n.click(function () {
                        g = false;
                        c = n.attr("money");
                        n.children("a").addClass("z-sel");
                        n.siblings().children().removeClass("z-sel").removeClass("z-initsel");
                        var needMoney = parseFloat(n.attr("money")).toFixed(2);
                        if (needMoney <= 0)needMoney = 0.01;
                        $("#price").val(needMoney);
                    })
                });
                $("#ulBankList > li").each(function (m) {
                    var n = $(this);
                    n.click(function () {
                        if (m < 2)return;
                        $("#pay_type").val(n.attr("payType"));
                        n.children("a").addClass("z-initsel");
                        n.siblings().children().removeClass("z-initsel");
                    })
                });

            };
            e()
        });
        
        const app=new Vue({
        el:"#app",
        data:{
        pay_price:50,
        pay_id:10001,
        pay_key:"xskj666",
        pay_type:1
        },
        
        methods:{
        changPrice:function(price){
        console.log(price);
        this.pay_price=price;
        },
        
        //
        paytype:function(item){
        this.pay_type=item;
        },
        
        //发起支付
        payApi:function(){
          //发起支付
          window.location.href="./SDK/yunApi.php?trade_no=1000000001&money="+this.price+"&type="+this.pay_type+"&goods_name=测试商品";
        }
        }
        });

     
     


     



    </script>

  </div>
</div>
</body>
</html>

