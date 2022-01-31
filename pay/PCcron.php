<?php
// 用于验证PC端网页是否刷新的

$cron_tmp = 'cron.txt';
$order_no_tmp = 'order_no.txt';


if(file_exists($cron_tmp) && file_exists($order_no_tmp)){
    // 存在支付监听请求，执行刷新请求

    // 删除cron_tmp.txt
    if(unlink($cron_tmp)){
        //1 代表可以执行刷新
        $msg = 1;
    }else{
        $msg = "文件删除失败！";
    }

}else{
    // 不能执行刷新
    $msg = 0;
}

echo $msg;