<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use think\View;

class Index extends Controller
{
  
    //初始化操作
    var $arrData;
    var $DbSearch;
    function __construct(){
    $this->DbSearch=new DbSearch();
    $this->arrData=$this->DbSearch->getConfig();
    }


//网站配置信息接口
public function getWebsiteInformation(){
//连接数据库获取参数变量
$data=Db::name('websystem')->find();

$data=array(
"code"=>200,
"description"=>"这是网站配置信息",
"data"=>$data
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
}



//网站幻灯片信息接口
public function getSlide(){
//连接数据库获取参数变量
$data=Db::name('websystem')->find();

$slide=explode("|", $data["slide"]);  //返回结果数组


$data=array(
"code"=>200,
"description"=>"这是网站首页幻灯片信息",
"data"=>$slide
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
}





//最新资讯接口(采用分页查询)
public function getNews(){
/*
*@请求参数:
*@param:page  int  页数
*@param:eachPageNum  int  每页的数量
*/

//参数接收
$page=(int)input('get.page');  //页数
$eachPageNum=(int)input('get.eachPageNum'); //每页显示数量
//参数复写
$this->arrData["necessary"]["table"]="news";//查询表名
$this->arrData["arrStatu"]["status"]=4;  //分页查询
$this->arrData["page"]["numPage"]=$page;  //从第几行开始查询
$this->arrData["page"]["eachPageNum"]=$eachPageNum;  //每页查询数量
//dump($this->arrData);
//调用分页查询接口
$data=$this->DbSearch->search($this->arrData);

//dump($data);
$data=array(
"code"=>200,
"description"=>"这是网站资讯新闻",
"data"=>$data
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
}






//题库资源显示接口(分页显示)
public function getQu(){
/*
*@请求参数:
*@param:page  int  页数
*@param:eachPageNum  int  每页的数量
*@param:is  boolean  排序
*/

//参数接收
$page=(int)input('get.page');  //页数
$eachPageNum=(int)input('get.eachPageNum'); //每页显示数量
//参数复写
$this->arrData["necessary"]["table"]="answer_source";//查询表名
$this->arrData["arrStatu"]["status"]=4;  //分页查询
$this->arrData["page"]["numPage"]=$page;  //从第几行开始查询
$this->arrData["page"]["eachPageNum"]=$eachPageNum;  //每页查询数量
//dump($this->arrData);
//调用分页查询接口
$data=$this->DbSearch->search($this->arrData);

$data=array(
"code"=>200,
"description"=>"这是题库资源",
"data"=>$data
);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
}






//文档资源显示接口(分页显示)
public function getDoc(){
/*
*@请求参数:
*@param:page  int  页数
*@param:eachPageNum  int  每页的数量
*@param:is  boolean  排序
*/

//参数接收
$page=(int)input('get.page');  //页数
$eachPageNum=(int)input('get.eachPageNum'); //每页显示数量
//参数复写
$this->arrData["necessary"]["table"]="upload_file_source";//查询表名
$this->arrData["arrStatu"]["status"]=4;  //分页查询
$this->arrData["page"]["numPage"]=$page;  //从第几行开始查询
$this->arrData["page"]["eachPageNum"]=$eachPageNum;  //每页查询数量
//dump($this->arrData);
//调用分页查询接口
$data=$this->DbSearch->search($this->arrData);

$data=array(
"code"=>200,
"description"=>"这是文档资源",
"data"=>$data
);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
}









//题目查询接口
public function searchQu(){
/*
*@请求参数:
*@param:question  string   题目
*@param:type    int     查询接口类型  (自建题库1, 导入题库2, 第三方接口3)
*/

//参数接收
$question=input('get.question');  //题目
$type=(int)input('get.type'); //密钥
//参数复写
$this->arrData["arrStatu"]["status"]=0;  //模糊查询
$this->arrData["item"]["item"]=2;  //一级数组下标
$this->arrData["item"]["item_item"]=1;  //二级数组下标
if($type==1){
$this->arrData["necessary"]["table"]="bank1";//查询表名
$this->arrData["necessary"]["name"]=$question;  //题目赋值
$this->arrData["necessary"]["column"]="yquestion";  //搜索字段
$data=empty($this->DbSearch->search($this->arrData))?$this->DbSearch->search($this->arrData):$this->DbSearch->search($this->arrData)[0];
}else if($type==2){
$this->arrData["necessary"]["table"]="bank2";//查询表名
$this->arrData["necessary"]["name"]=$question;  //题目赋值
$this->arrData["necessary"]["column"]="topic";  //搜索字段
$data=empty($this->DbSearch->search($this->arrData))?$this->DbSearch->search($this->arrData):$this->DbSearch->search($this->arrData)[0];
  $is=true;
  if(empty($data)||$data["answers"]=="[]"){
  $is=false;
  $this->arrData["necessary"]["table"]="bank3";//查询表名
  $this->arrData["necessary"]["column"]="question";  //搜索字段
  $data=empty($this->DbSearch->search($this->arrData))?$this->DbSearch->search($this->arrData):$this->DbSearch->search($this->arrData)[0];
  }

 // dump($data);
}else if($type==3){
//默认第三方接口
$url='https://www.wkdnb.cn/wkd.php?tm='.$question;
$html = file_get_contents($url);

//添加到自己数据库
//dump(json_decode($html,JSON_UNESCAPED_UNICODE));
$insert=json_decode($html,JSON_UNESCAPED_UNICODE);
//数据封装
$data2=['answer'=>$insert["answer"],'question'=>$insert["question"],'category'=>"接口类",'user'=>"接口自动爬取"];
//添加数据
$result=Db::name("answer_source")->insert($data2);
$data=$html;
}



if($type==1||$type==2){
$arr=$data;
}


if(empty($data)){
$data=array(
"question"=>"未能查询到",
"answer"=>"未能查询到"
);
}else{

if($type==1){
$data=array(
"question"=>$arr["question"],
"answer"=>empty($arr["answer1"])?$arr["answer2"]:$arr["answer1"]
);
}


if($type==2){ 
  if(!$is){
  
  $data=array(
"question"=>$arr["question"],
"answer"=>(object)$arr["answer"]
);
}else{
  $data=array(
"question"=>$arr["topic"],
"answer"=>$arr["answers"]
);
  }

}

if($type==3){
$data=(array)json_decode($data);

$arr=$data;
$data=array(
"question"=>$arr["question"],
"answer"=>$arr["answer"]=="微信关注公众号：网课答案宝 ，查题更准确"?"抱歉！该接口暂时不能用":$arr["answer"]
);
}



$data=array(
"code"=>200,
"description"=>"这是查询数据",
"data"=>$data
);
return json_encode($data, JSON_UNESCAPED_UNICODE);
}


$data=array(
"code"=>200,
"description"=>"这是查询数据",
"data"=>$data
);

return json_encode($data, JSON_UNESCAPED_UNICODE);
}




//文章详情页接口
public function getNewsDetail(){
   /*
   *请求参数:
   *@param id int 文章id
   */
   $id=input("get.id");
   //参数复写
$this->arrData["necessary"]["table"]="news";//查询表名
$this->arrData["arrStatu"]["status"]=5;  //精准查询
$this->arrData["necessary"]["column"]="id";  //字段id
$this->arrData["necessary"]["name"]=$id;  //文章id

//调用文章详情页接口
$data=$this->DbSearch->search($this->arrData);

//dump($data);

//返回数据
echo json_encode($data[0], JSON_UNESCAPED_UNICODE);

}




//资源提交-------问答形式提交资源接口api
public function answerSubmit(){
   /*
   *请求参数:
   *@param  question string 问答题目
   *@param  answer string 问答答案
   *@param   category string 问答分类
   *@param  user  string 提交用户
   */
   $question=input("get.question");
   $answer=input("get.answer");
   $category=input("get.category");
   $user=input("get.user");
   //数据封装
   $data=['answer'=>$answer,'question'=>$question,'category'=>$category,'user'=>$user];
   
   //添加数据
   $result=Db::name("answer_source")->insert($data);
   
   if($result==1){
    $data1=array(
     "code"=>200,
     "message"=>"提交成功！",
     "status"=>$result,
          "data"=>$data
    );
   }else if($result==0){
       $data1=array(
     "code"=>300,
     "message"=>"提交失败！",
     "status"=> $result,
     "data"=>$data
      );
   }else{
       $data1=array(
     "code"=>500,
     "message"=>"接口异常！",
     "status"=> $result,
        "data"=>$data
      );
   }
   
   echo json_encode($data1, JSON_UNESCAPED_UNICODE);
}



//资源提交-------单资源形式提交资源接口api
public function singleSubmit(){
   /*
   *请求参数:
   *@param   source string 资源数据
   *@param   category string 问答分类
   */
   $source=input("get.source");
   $category=input("get.category");
   $user=input("get.user");
   //数据封装
   $data=['source'=>$source,'category'=>$category,'user'=>$user];
   
   //添加数据
   $result=Db::name("single_source")->insert($data);
   
   if($result==1){
    $data1=array(
     "code"=>200,
     "message"=>"提交成功！",
     "status"=>$result,
          "data"=>$data
    );
   }else if($result==0){
       $data1=array(
     "code"=>300,
     "message"=>"提交失败！",
     "status"=> $result,
     "data"=>$data
      );
   }else{
       $data1=array(
     "code"=>500,
     "message"=>"接口异常！",
     "status"=> $result,
        "data"=>$data
      );
   }
   
   echo json_encode($data1, JSON_UNESCAPED_UNICODE);

}








//资源提交-------文件形式提交资源接口api(支持多文件上传)
public function fileSubmit(){
/*
*存放模式:网站目录存放文件+数据库存放路径
*文件上传文档说明:
*技术:采用FormData结合axios(也可以是其他http请求)实现数据请求提交
*请求方法:POST
*参数:
*@param: description string 文件描述
*@param: label string  用户自定义标签
*@param: classify string 文件分类
*@param: user string 文件提交用户
*@param: doc_id int 文件归类id值
*@param: file string 文件的二进制数据的文件对象用$_FILES["file"]获取其文件对象
*说明:在表单构造中，除了file用$_FILES["file"]获取外，其余用$_POST获取其值
*/
//配置信息
$file_root_path= $_SERVER['DOCUMENT_ROOT']."/upload/";   //上传文件根路径 这里一定注意由于采用的是系统的缓存机制，所以一定要设置绝对路径才能找到
$file_size=31457280;    // 31457280=30M    上传文件大小限制   
$allowedExts = array("gif", "jpeg", "jpg", "png","txt","cvs","doc","ppt","xls"); // 允许上传的图片后缀
$date=date("YmdHis");
//文件前缀命名规则:日期+classify

/*
说明:都已每次上传一个的信息为一条键值对信息，最终进行返回
返回格式:array(
"code"=>代码,    根据判断次数比对来确定
"massage"=>"提示信息",
"doc_id"=>dm$doc_id,  //文件归类id值
"data"=>array(
  "error"=>$error,
  "success"=>$success
)
)

其中:$error和$success主要包含
such as:
$success=array(
[0]=>array(
"code"=>code  //上传状态码 1为成功 2为写入数据库失败到上传成功
"file_path"=>"http://".$_SERVER["HTTP_HOST"]."/upload/other/".$file_rename  文件路径
)   //第一次
)

最终以json返回
*/

//上传文件错误记录
$error=array();
//上传文件成功记录
$success=array();




//接收参数
$description=$_POST["description"];      
$label=$_POST["label"];            
$classify=$_POST["classify"];      
$user=$_POST["user"];      
$files= $_FILES["file"];  //为数组
$doc_id=$_POST["doc_id"];

//其中当js中FormData为的一个file属性为数组时，其$_FILES返回值为一个三维数组
//$files再次封装
$fileList=[];
$item=[];
for($i=0;$i<count($files["name"]);$i++){
$item["name"]=$files["name"][$i];
$item["type"]=$files["type"][$i];
$item["tmp_name"]=$files["tmp_name"][$i];
$item["error"]=$files["error"][$i];
$item["size"]=$files["size"][$i];
//文件列表赋值
$fileList[$i]=$item;
}
//dump($fileList);

//dump($_FILES);

//for遍历
foreach ($fileList as $key=>$file){

$temp = explode(".", $file["name"]);
$file_type=end($temp);//文件类型


//生成随机字符串
$strs="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
$name=substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),10);

//文件名
$file_rename=$date.$name.".".$file_type;

//文件上传状态判断
if($file["error"] > 0){
//文件上传失败记录错误次数
$error[$key]=array(
"code"=>500,
"massage"=>"上传失败",
"error_message"=>$file["error"],
"file_name"=>$file["name"]
);

}else if(end($temp)==$allowedExts[0]||end($temp)==$allowedExts[1]||end($temp)==$allowedExts[2]||end($temp)==$allowedExts[3]){

   //图片绝对路径
   $image_path=$file_root_path."image/".$file_rename;
   //保存图片
   if(move_uploaded_file($file["tmp_name"], $image_path)){
   //保存成功写入数据库
      //数据封装
   $data=[
   'file_path'=>"/upload/image/".$file_rename,
   'classify'=>$classify,
   'file_type'=>$file_type,
   'status'=>1, 
   'user'=>$user,
   'file_size'=>$file["size"],   //b为单位
   'description'=>$description,
   'user_defined_label'=>$label,
   'doc_id'=>$doc_id
   ];
   //添加数据
   $result=Db::name("upload_file_source")->insert($data);
   if($result==0){
   $success[$key]=array(
        "code"=>300,            
        "massage"=>"上传图片成功,插入数据库信息失败!",
        "error_message"=>$result,
        "file_name"=>$file["name"],
        "http_path"=>"http://".$_SERVER["HTTP_HOST"]."/upload/image/".$file_rename
         );
    }else{
    
   $success[$key]=array(
        "code"=>300,            
        "massage"=>"上传图片成功!",
        "file_name"=>$file["name"],
        "http_path"=>"http://".$_SERVER["HTTP_HOST"]."/upload/image/".$file_rename
         );
    }
  }
}else{//其他文件操作

   //绝对路径
   $other_path=$file_root_path."other/".$file_rename;
   //保存图片
   if(move_uploaded_file($file["tmp_name"], $other_path)){
   //保存成功写入数据库
      //数据封装
   $data=[
   'file_path'=>"/upload/other/".$file_rename,
   'classify'=>$classify,
   'file_type'=>$file_type,
   'status'=>1, 
   'user'=>$user,
   'file_size'=>$file["size"],   //b为单位
   'description'=>$description,
   'user_defined_label'=>$label,
   'doc_id'=>$doc_id
   ];
   //添加数据
   $result=Db::name("upload_file_source")->insert($data);
   if($result==0){
       $success[$key]=array(
        "code"=>300,            
        "massage"=>"上传图片成功,插入数据库信息失败!",
        "error_message"=>$result,
        "file_name"=>$file["name"],
        "http_path"=>"http://".$_SERVER["HTTP_HOST"]."/upload/image/".$file_rename
         );
    }else{
    
   $success[$key]=array(
        "code"=>300,            
        "massage"=>"上传图片成功!",
        "file_name"=>$file["name"],
        "http_path"=>"http://".$_SERVER["HTTP_HOST"]."/upload/image/".$file_rename
         );
      }
   }
 }
}

//数据封装返回
$data=array(
"code"=>200,
"doc_id"=>$doc_id,  //文件归类id值
"data"=>array(
  "error"=>$error,
  "success"=>$success
)
);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
}



//请求文档资源详情页接口
public function getDocSource(){
/*
   *请求参数:
   *@param id int 文档id
   */
$id=input("get.id");
   //参数复写
$this->arrData["necessary"]["table"]="upload_file_source";//查询表名
$this->arrData["arrStatu"]["status"]=5;  //精准查询
$this->arrData["necessary"]["column"]="id";  //字段id
$this->arrData["necessary"]["name"]=$id;  //文章id

//调用文章详情页接口
$data=$this->DbSearch->search($this->arrData);

//dump($data);

//返回数据
echo json_encode($data[0], JSON_UNESCAPED_UNICODE);

}


//请求社区动态详情页接口
public function getCommunityDetail(){
/*
   *请求参数:
   *@param id int 文档id
   */
$id=(int)input("get.id");
   //参数复写
$this->arrData["necessary"]["table"]="community";//查询表名
$this->arrData["arrStatu"]["status"]=5;  //精准查询
$this->arrData["necessary"]["column"]="id";  //字段id
$this->arrData["necessary"]["name"]=$id;  //文章id

//调用文章详情页接口
$data=$this->DbSearch->search($this->arrData);

//dump($data);

//返回数据
echo json_encode($data[0], JSON_UNESCAPED_UNICODE);

}


//请求最新题库资源详情页接口
public function getQuSource(){
/*
   *请求参数:
   *@param id int 文档id
   */
$id=(int)input("get.id");
   //参数复写
$this->arrData["necessary"]["table"]="answer_source";//查询表名
$this->arrData["arrStatu"]["status"]=5;  //精准查询
$this->arrData["necessary"]["column"]="id";  //字段id
$this->arrData["necessary"]["name"]=$id;  //文章id

//调用文章详情页接口
$data=$this->DbSearch->search($this->arrData);

//dump($data);

//返回数据
echo json_encode($data[0], JSON_UNESCAPED_UNICODE);

}




//doc_id验证函数
public function ruler(){
  /*
   *请求参数:
   *@param doc_id int 文档归类唯一id值
   */
$doc_id=input("get.doc_id");
   //参数复写
$this->arrData["necessary"]["table"]="upload_file_source";//查询表名
$this->arrData["arrStatu"]["status"]=5;  //精准查询
$this->arrData["necessary"]["column"]="doc_id";  //字段id
$this->arrData["necessary"]["name"]=$doc_id;  //文章id

//调用文章详情页接口
$data=$this->DbSearch->search($this->arrData);

//dump($data);
if(count($data)==0){
echo 0;
}else{
echo 1;
}
}



//分页获取社区动态信息
public function getComments(){
/*
*@请求参数:
*@param:page  int  页数
*@param:eachPageNum  int  每页的数量
*@param:is  boolean  排序
*/

//参数接收
$page=(int)input('get.page');  //页数
$eachPageNum=(int)input('get.eachPageNum'); //每页显示数量
//参数复写
$this->arrData["necessary"]["table"]="community";//查询表名
$this->arrData["arrStatu"]["status"]=4;  //分页查询
$this->arrData["page"]["numPage"]=$page;  //从第几行开始查询
$this->arrData["page"]["eachPageNum"]=$eachPageNum;  //每页查询数量
//dump($this->arrData);
//调用分页查询接口
$data=$this->DbSearch->search($this->arrData);

$data=array(
"code"=>200,
"description"=>"这是社区动态资源",
"data"=>$data
);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
}



//模版首页路由
public function index()
{

//模版选择
$template="m1";


$this->redirect('/template/'.$template.'/index.html');

}
    
   
    
}

