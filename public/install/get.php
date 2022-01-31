<?php
//POST数据库接收
$host =$_POST["db_host"];
$username =$_POST["db_user"];
$password =$_POST["db_password"];
$database=$_POST["db_name"];
$port=$_POST["db_port"];
//POST接收网站数据
$web_title=$_POST["web_title"];//获取网站标题
$web_keyword=$_POST["web_keyword"];//获取网站标题
$web_description=$_POST["web_description"];//获取网站标题
//管理员信息获取
$admin_user=$_POST["admin_user"];
$admin_password=md5($_POST["admin_password"]);
$admin_qq=$_POST["admin_qq"];
$admin_email=$_POST["admin_email"];
//数据库文件处理
$_sql = file_get_contents('localhost.sql');
$_arr = explode(';', $_sql);//sql文件分割
//连接数据库
$conn =new mysqli($host,$username,$password,$database);
//设置编码
$conn->set_charset("utf-8");
// 判断是否连接成功
if ($conn->connect_error) {
$mistake=die("连接失败: " . $conn->connect_error);
    echo $mistake;
} 
//遍历执行sql语句
foreach ($_arr as $_value) {
$conn->query($_value.';');
}
//修改网站配置信息
//$sql1="UPDATE xs_websystem SET web_title='{$web_title}',web_keyword='{$web_keyword}',web_description='{$web_description}' WHERE ID=1";
//$result1=$conn->query($sql1);
//修改管理员信息
$sql2="UPDATE pay_admin SET username='{$admin_user}',password='{$admin_password}',QQ='{$admin_qq}',email='{$admin_email}' WHERE id=0";
$result2=$conn->query($sql2);
//生成安装锁文件
$file=fopen("install.lock","alreading lock");



//生成数据库配置信息

$dbfile = fopen("config.db.php", "w");
//写入内容
$config="<?php\n".'$hostname='."\"".$host."\"".";\n".'$port='.$port.";\n".'$database='."\"".$database."\"".";\n".'$username='."\"".$username."\"".";\n".'$password='."\"".$password."\"".";\n";
fwrite($dbfile, $config);
fclose($dbfile);



if($result2)
{
header('location:successful.html');
$conn->close();
}else{
header('location:failure.html');
$conn->close();
}

?>