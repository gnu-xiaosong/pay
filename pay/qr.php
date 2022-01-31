<?php
session_start();
include("./database.php");
header("Content-Type: text/html; charset=utf-8");
include("./lib/phpqrcode.php");
 /*
 参量
     字符串$ text要编码的文本字符串
     字符串$ outfile（可选）输出文件名，如果使用必需的标头向浏览器输出错误的字符串
     整数$ level（可选）纠错级别QR_ECLEVEL_L，QR_ECLEVEL_M，QR_ECLEVEL_Q或QR_ECLEVEL_H
     整数$ size（可选）像素大小，每个“虚拟”像素的乘数
     “虚拟”像素的整数$ margin（可选）代码余量（静默区域）
     布尔值$ saveandprint（可选），如果将正确的代码输出到浏览器并保存到文件，否则仅保存到文件。 仅在指定$ outfile时有效。
*/

//获取最新商户的收款码
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}


$sql="SELECT * FROM pay_user where id=".$_SESSION["id"];
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
//var_dump($row);
//config for setting

//判断支付类型
if($_SESSION["type"]==3){
//QQ
$qr_url=$row["qq_qr_url"];
}else if($_SESSION["type"]==2){
$qr_url=$row["wechat_qr_url"];
}else{
//默认支付宝
$qr_url=$row["alipay_qr_url"];
}

$outputfile=false;
$level= QR_ECLEVEL_H;     //QR_ECLEVEL_L, QR_ECLEVEL_M, QR_ECLEVEL_Q or QR_ECLEVEL_H
$size=210;
$margin=0;
//var_dump($_SESSION['pay']);
//打开缓存区
ob_start();
//
QRcode::png($qr_url,$outputfile,$level,$size,$margin);
//这里就是把生成的图片流从缓冲区保存到内存对象上，使用base64_encode变成编码字符串，通过json返回给页面。
$imageString = base64_encode(ob_get_contents());

//关闭缓存区
ob_end_clean();

//数据封装
$data = array(
        'code'=>200,   
        'qr_url'=>$qr_url,
        'type'=>$_SESSION["type"],  //支付类型
        'user_id'=>$_SESSION["id"],     //商户id值
        'order_no'=>$_SESSION["order_no"],
        'return_url'=>$_SESSION["return_url"],   //同步跳转url
        'data'=>$imageString
    );


echo json_encode($data);