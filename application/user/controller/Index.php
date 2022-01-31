<?php
namespace app\user\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
  
    //初始化操作
    var $arrData;
    var $DbSearch;
    function __construct(){
    $this->DbSearch=new DbSearch();
    $this->arrData=$this->DbSearch->getConfig();
    }
    
    
    
    //商户后台模版接口
   public function user()
   {
        //模版选择
        $template="user";
        $this->redirect('/template/'.$template.'/index.html');
    }
    



    public function login(){

      // 接受参数
      $id = input("get.id");
      $key = input("get.key");

      // 验证商户
      $result=Db::name('user')->where('id', $id)->find();
      
      if (empty($result)) {
          //商户不存在
          $data=array(
          "code"=>300,
          "msg"=>"该商户不存在！"
          );
      }else if($result["key"] != $key){
          //商户存在
          $data = array(
            "code" => 400,
            "msg" => "秘钥错误！"
          );
      }else{
          //商户存在
          $data = array(
            "code" => 200,
            "msg" => "登录成功！"
          );
      }
      
      return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }



    
    //用户登陆接口
    public function user_login(){
    
    //接收参数
    $username=input('get.username');
    $password=input('get.password');
    //验证用户
    $result=Db::name('user')->where('username', $username)->find();
    if(empty($result)){
    //用户不存在
    $data=array(
      "code"=>300,
      "msg"=>"该用户不存在！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    //用户账号验证
   if($result["status"]==0){
    //用户不存在
    $data=array(
      "code"=>100,
      "msg"=>"该用户暂时被冻结！暂时不能登陆！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    //验证密码
    if(md5($password)!=$result["password"]){
  //  echo md5($password);
     $data=array(
      "code"=>400,
      "msg"=>"密码错误！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    //验证成功返回用户id值和token
    
    //生成token
    $id =  $result["id"];
    $key = mt_rand();
    $hash = md5($key . $id . mt_rand() . time());
    $token = base64_encode($hash);
    
    //更新token
    $re=Db::name('user')->where("username",  $username)->update(["token"=> $token]);  //重复注册
     
   if($re==1){
    //封装数据返回
    $data=array(
      "code"=>200,
      "data"=>array(
      "id"=>$id,
      "token"=>$token
      ),
      "msg"=>"登陆成功！"
    );
    }else{
    $data=array(
      "code"=>200,
      "msg"=>"更新token失败！数据库异常"
    );
    }
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
        
    //请求管理员后台首页信息新增信息
    public function getUserIndex(){
    /*
    *接收参数:
    *user_id 商户id值
    */
    $user_id=input('get.user_id');
    
    
    $map['user_id'] =$user_id;
    $map['status'] = 1;
    
    $map1['user_id'] =$user_id;
    $map1['status'] = 0;
    //获取今日新增订单数
    $today_order=Db::name('order')->where('user_id', $user_id)->whereTime('time', 'today')->count();
    //获取总订单数
    $total_order=Db::name('order')->where('user_id', $user_id)->count();
    //获取今日成交额
    $today_money=Db::name('order')->where($map)->whereTime('time', 'today')->sum('money');
    //获取总成交额
    $total_money=Db::name('order')->where($map)->sum('money');
    //今日未支付订单数
    $no_pay_today_order=Db::name('order')->where($map1)->whereTime('time', 'today')->count();
    //总未支付数
    $no_pay_total_order=Db::name('order')->where($map1)->count();
    
    
    $data=array(
       "code"=>200,
       "description"=>"这是商户后台首页信息显示数据",
       "data"=>array(
         "today_order"=> $today_order,
         "total_order"=>$total_order,
         "today_money"=>$today_money,
         "total_money"=> $total_money,
         "no_pay_today_order"=>$no_pay_today_order,
         "no_pay_total_order"=>$no_pay_total_order
        )
       );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    //请求商户个人信息
    public function getUser(){
    /*
    *接收参数:
    *token 商户token值
    */
    
    //验证token
    
    $token=input('get.token');
   
    $data=Db::name('user')->where('token', $token)->find();
   
   if(!$data){
      $data=array(
       "code"=>300,
       "msg"=>"token值有误"
       );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
    $data=array(
       "code"=>200,
       "description"=>"这是商户个人信息显示数据",
       "header_url"=>"https://q4.qlogo.cn/g?b=qq&nk=".$data["QQ"]."&s=140",
       "data"=>$data
       );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    
    /**************这是订单列表接口↓↓↓↓↓↓*******************/
    //获取订单列表信息接口路由
    public function getUserOrderList(){
    /*
    *@请求参数:
    *@paramuser_id  int  商户id
    *@param:page  int  页数
    *@param:eachPageNum  int  每页的数量
    */

    //参数接收
    $user_id=input('get.user_id');  //商户id
    $page=(int)input('get.page');  //页数
    $eachPageNum=(int)input('get.eachPageNum'); //每页显示数量

    //查询数据库
    //查询条件
    $map['user_id']  = ['=', $user_id];
    
    $data=Db::name('order')->where($map)->order('id desc')->page($page, $eachPageNum)->select(); 


    //获取总条数
    $count=Db::name('order')->count();

    $data=array(
      "code"=>200,
      "description"=>"这是商户订单请求信息",
      "count"=>$count,  //数据条数
      "data"=>$data
     );
     echo json_encode($data, JSON_UNESCAPED_UNICODE);
     }
    
    
    //搜索订单信息接口
    public function getUserSearchOrderList(){
    
    //接收参数
    $user_id=input('get.user_id');  //商户id
    $out_trade_no=input('get.order_no');
    $status=(int)input('get.status');
    $page=input('get.page');
    $eachPageNum=input('get.eachPageNum');
    
    //查询条件
    $map['order_no']  = ['like',"%".$out_trade_no."%"];
    $map['user_id']  = ['=', $user_id];
    if($status!=100){
     $map['status']  = ['=', $status];
    }
    
    $data=Db::name('order')->where($map)->order('id desc')->page($page, $eachPageNum)->select(); 
    //数据条数
    $count=Db::name('order')->where($map)->count();
    
    $data=array(
       "code"=>200,
       "description"=>"这是商户搜索订单请求信息",
       "count"=>$count,  //数据条数
       "data"=>$data
       );

     echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
/**************这是订单列表接口↑↑↑↑↑↑↑*******************/
   //找回密码
    public  function  findPasswd(){
     $password=$_GET["p"];
     $email=$_GET["email"];
     
     //更新修改
    $result=Db::name('user')->where("email", $email)->update(["password"=>md5($password)]);
    if(!empty($result)){
      $data=array(
       "code"=>200,
       "msg"=>"修改成功！",
       "description"=>"这是找回商户密码信息",
       );
    return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    $data=array(
       "code"=>300,
       "msg"=>"修改失败！",
       "description"=>"这是找回商户密码信息",
       );
    return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    //修改商户信息
   public  function setUser(){
     //接收post的数据json格式数据
    $data=file_get_contents('php://input');
    $data=(array)json_decode($data);  //转化为数组
    
    
    $data["password"]=md5($data["password"]);
    
    $result=Db::name('user')->where("token", $data["token"])->update($data);
  
    $data=array(
       "code"=>200,
       "msg"=>"修改成功！",
       "description"=>"这是商户信息",
       );

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
   
   
    //用户注册路由
    public function register(){
     //插入数据库中
    $data=[
     "username"=>$_POST["user_pet_name"],
     "password"=>md5($_POST["user_password"]),
     "key"=>$_POST["key"],
     "email"=>$_POST["user_email"],
     "QQ"=>$_POST["QQ"],
     "level"=>2,  //用户级别:(0:超级管理员;1:中级用户;2:普通用户)
     "status"=>1
     ];

     $re=Db::name('user')->where("email",  $data["email"])->find();  //重复注册
     
     if(!empty($re)){
    $data=array(
      "code"=>400,
      "msg"=>"该邮箱已被注册，注册失败！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     $re1=Db::name('user')->where("username",  $data["username"])->find();  //重复注册
     
     if(!empty($re)){
    $data=array(
      "code"=>800,
      "msg"=>"该用户名已经存在！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     $result=Db::name('user')->insert($data);
     
     if($result!=1){
     $data=array(
      "code"=>300,
      "msg"=>"注册失败！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     $data=array(
      "code"=>200,
      "msg"=>"注册成功！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    
    
    
    
    
    
    /********分割线************/
    
    

    //用户注册信息校验接口
    public function isValid(){
    
    $result=Db::name('user')->where($_POST["col"], $_POST["data"])->find();
    if(!empty($result)){
      //已经存在
     $data=array(
      "code"=>true,
      "msg"=>$_POST["err"]
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
    $data=array(
      "code"=>false,
      "msg"=>"可以使用！"
     );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     
    }
    
    
    
    
    
    

 
 
   //用户动态发表接口
   public function announce(){
    //参数接收
    $title=input('post.title');
    $content=input('post.editor');
    $id=input('post.id');   //用户id
    
    //插入数据库
   $data=[
     "user_id"=>$id,
     "title"=>$title,
     "content"=>$content
     ];
    $re=Db::name('community')->insert($data);  
   
   if($re!=1){
    $data=array(
      "code"=>300,
      "msg"=>"动态信息插入数据库失败！"
    );
   }else{
   $data=array(
      "code"=>200,
      "msg"=>"动态信息插入数据库成功！"
    );
   }
    return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
 
 
   //用户松币规则接口
   public function CoinRuler(){
   //接收参数
   $ruler=$_GET["ruler"];  //积分规则:+或- string
   $token=$_GET["token"];   //操作积分对象(用户token) string 
   $coin_count=$_GET["coin_count"];  //积分操作数目(松币为单位) int
   
   
   //判断积分规则
   
   //查询积分规则表
  //$re=Db::name('ruler')->where("ruler_id",  0)->find();  
   //获取操作对象用户积分数
  $reg=Db::name('user')->where("token", $token)->find();  
//  dump( $reg);
   //加积分
   if($ruler==1){
     $cores=(int)$reg["cores"]+(int)$coin_count;
          
     //积分不足
     if($cores<1){
      $data=array(
      "code"=>400,
      "msg"=>"积分不足！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     // dump("积分:".$cores);
   //插入数据库中
     $reg=Db::name('user')->where("token",  $token)->update(["cores"=>(int)$cores]);
    // dump($reg);
     if($reg==1){
       $data=array(
      "code"=>200,
      "msg"=>"操作用户积分成功！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
    $data=array(
      "code"=>300,
      "msg"=>"操作用户积分失败！",
      "cores"=> $cores
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   
   //减积分
   if($ruler==0){
     $cores=(int)$reg["cores"]-(int)$coin_count;
     
     //积分不足
     if($cores<0){
      $data=array(
      "code"=>400,
      "msg"=>"积分不足！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
     
     
   //插入数据库中
     $reg=Db::name('user')->where("token",  $token)->update(["cores"=>(int)$cores]);
     if($reg==1){
       $data=array(
      "code"=>200,
      "msg"=>"操作用户积分成功！",
      "cores"=> $cores
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
     }
    $data=array(
      "code"=>300,
      "msg"=>"操作用户积分失败！"
    );
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   }
 
 
   //获取qq信息
   public function getQQ(){
     header("Content-type: text/html; charset=utf-8");
     $qq = $_GET['qq'];
    // $is=$_GET['is'];
     ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
    $get_info = file_get_contents('http://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
     //正则匹配
     $ruler='/portraitCallBack\((.*)\)/';
     preg_match($ruler,$get_info,$result);
    
     //dump($this->gzdecode($get_info));
     //正则匹配昵称
     $ruler1='/,"(.*)",/';
     preg_match($ruler1,$result[1],$name);
     $name=$name[1];
     
     if(isset($_GET['is'])){
     
      $reg=Db::name('user')->where("QQ", $qq)->find();
      return $reg["username"];
     }
     
     
    // echo $name;
    // echo mbconvertencoding($name, "utf-8", "GBK");
     //匹配获取头像url
     //$ruler2='/\["(.*?)"/';
   //  preg_match($ruler2,$result[1],$header);

    // $name = urldecode($data["nickname"]);
     $txurl = 'http://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=640';

     $info =array(
      "code"=>200,
      "imgurl"=>$txurl
    );
     return json_encode($info, JSON_UNESCAPED_UNICODE);
   }
   
   
   //获取用户信息
   public function getUserData(){
   //注意:修改php.ini，把allow_url_fopen给启用，改成allow_url_fopen = On
   //接收参数
   $token=input('get.token');
   
   $reg=Db::name('user')->where("token", $token)->find();
   
   if(empty($reg)){
     //token不正确，或者已实现，
    $data=array(
      "code"=>300,
      "msg"=>"token已失效，请重新登陆！"
    );
   }else{
   //返回相关信息
     $data=array(
      "code"=>200,
      "msg"=>"获取信息成功！",
      "cores"=>$reg["cores"],
      "qq"=>$reg["QQ"],
      "username"=>$reg["username"]
    );
   }
     return  json_encode($data, JSON_UNESCAPED_UNICODE);
   }
   
   
//用户订单查询接口
public function getIndexOrder(){
//接收参数
$order_no=input('get.order_no');

//查询
$result=Db::name('order')->where('out_trade_no', $order_no)->find();

if(empty($result)){
$data=array(
"code"=>300,
"msg"=>"未查询到该订单信息!",
);
}else{
 $data=array(
"code"=>200,
"msg"=>"该订单信息查询成功!",
"data"=>$result
);
}
return json_encode($data, JSON_UNESCAPED_UNICODE);
}


}