<?php
//define evirmoment console
// header('Access-Control-Allow-Origin:*');

define('XS_ENTER','/public/index.php');
define("XS_PHP_VERSION_HINT","<script>alert(\"您php版本过小，请调节至大于7.0\");</script>");
//php version check
if(PHP_VERSION<5.6){
echo XS_PHP_VERSION_HINT;
die;
}


// 检测是否是新安装
if(!file_exists("./public/install/install.lock")){
    // 组装安装url
    // $url=$_SERVER['HTTP_HOST'].trim($_SERVER['SCRIPT_NAME'],'index.php').'./install/guide.html';
    // 使用http://域名方式访问；避免./Public/install 路径方式的兼容性和其他出错问题
    header("Location:/public/install/guide.html");
    die;
}


//define progress enter
header("Location:./template/index/");
// header("Location:".XS_ENTER);
//

?>