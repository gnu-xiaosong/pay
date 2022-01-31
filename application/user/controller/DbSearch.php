<?php
namespace app\user\controller;
use think\Controller;
use think\Db;
use think\Help;  

class DbSearch
{
      
/************************相关状态值提示:****************************************************

**********************************************************************************************
状态值*一级状态值status:
**********************************************************************************************
       |                   param-------$item----------meaning
       |               "%".$name       0        左包含
       |                $name."%"      1          右包含
 0     | 模糊查询 -> "%".$name."%"    2          全包含
       |                 '_'.$name.'_'    3          三个字符中间一个为$name[一个_代表一个字符]
       |                  $name.'_'      4          三个字符左一个为$name
       |                 '_'.$name       5          三个字符右一个为$name
**********************************************************************************************
1      |     数据处理类 (大小比较)
**********************************************************************************************
2      |      链式条件查询
**********************************************************************************************
3      |      数据统计处理类(二级状态值statu2)

[
***************************
0:获取字段最大值
***************************
1:获取某字段的最小值
***************************
2:获取某字段的平均值
***************************
3:获取某字段的总和
***************************
4:个数统计
***************************
]
**********************************************************************************************
4      |      分页查询 (常用于文章等)
**********************************************************************************************
5      |      精准查询
**********************************************************************************************/

    var $arrData;
    
    //初始化
    function __construct(){
     $this->arrData=array(
        "arrStatu"=>array(
         "status"=>0,                 //一级状态参数
         "statu2"=>4                 //二级状态参数
             ),
     
    "necessary"=>array(
        "table"=>"bank2",              //[查询]表名
        "column"=>"id",         //必要字段    $column
        "name"=>"answer"               //搜索值$name
    ),
    
    "where"=>array(                  //查询条件数组参数
    "getTerm"=>!empty("id")?"id":''   //多维数组[一维也可]  格式:array([字段1=>值1],[字段2=>值2]…) 如果为空默认采用{$column=>$name}一维单条件查询
    ),
   
    "Item"=>array(
        "item"=>2,                    //数组一级下标参数$item
        "item_item"=>1               //数组二级下标参数$item_item
    ),
    
    "page"=>array(
        "numPage"=>1,                //分页查询开始行 int类型
        "eachPageNum"=>10          //每页查询数量  从开始行开始每页查询多少个数据
     ),
     
    "configure"=>array(
        "getMakeSql"=>false,          //是否生成sql语句 boolean类型
        "ifCache"=> false,              //是否开启缓存查询 boolean累类型
        "getCacheTime"=>6,            //开启缓存查询的时间 int类型 单位秒
        "limit"=>4,                      //查询数目限制 不开启 int类型
        "transport"=>false,              //字段值不为数值时，是否强制转换成数值，boolean类型(true,false)
        "getOrderColumn"=>"ID",        //排序字段 $orderColoumn 默认id字段    $column=>$name
        "getOrderRule"=> "desc"        //排序规则$orderRule
    )
    );
    }
   //参数设置函数
    public function getConfig(){
     return $this->arrData;
    }
    
    
    
    
    public function search($arr)
    {
    //状态参数
    $status=$arr["arrStatu"]["status"];
    $statu2=$arr["arrStatu"]["statu2"];
    
    //分页参数控制
    $numPage=$arr["page"]["numPage"];
    $eachPageNum=$arr["page"]["eachPageNum"];
    
    //必要参数
    $column=$arr["necessary"]["column"];
    $name=$arr["necessary"]["name"];
    $table=$arr["necessary"]["table"];
    
    //数组下标
    $item=$arr["Item"]["item"];
    $item_item=$arr["Item"]["item_item"];
    
    //where条件参数
    $getTerm=$arr["where"]["getTerm"];

    //非必要配置参数
    $getMakeSql=$arr["configure"]["getMakeSql"];
    $ifCache=$arr["configure"]["ifCache"];
    $getCacheTime=$arr["configure"]["getCacheTime"];
    $limit=$arr["configure"]["limit"];
    $getOrderColumn=$arr["configure"]["getOrderColumn"];//排序字段
    $getOrderRule=$arr["configure"]["getOrderRule"];//排序规则
    $transport=$arr["configure"]["transport"];//字段不是数值时，是否强制转换(true,false)成数值参数
    
    
    //参数转化
    $makeSql=!empty($getMakeSql)?$getMakeSql:false;//是否生成sql语句,默认false
    $cache=!empty($ifCache)?$ifCache:false;   //缓存设置，默认不
    $cacheTime=!empty($getCacheTime)?$getCacheTime:60;   //缓存时间 单位秒 默认60秒
    $limitNum=!empty($limit)?$limit:' ';//默认不限制查询数量
    $orderRule=!empty($getOrderRule)?$getOrderRule:'asc';//默认排序规则为asc
    $orderColoumn=!empty($getOrderColumn)?$getOrderColumn:'id';//默认排序字段名为id
    
    //程序提示语
   // $hint="相关状态值提示:<br>一级状态值status:<br>0:模糊查询<br>1:数据处理类  (大小比较)<br>2:链式条件查询<br>3:数据统计处理类(二级状态值statu2)<br>[<br>0:获取字段最大值<br>1:获取某字段的最小值<br>2:获取某字段的平均值<br>3:获取某字段的总和<br>4:个数统计<br>]<br>4:分页查询 (常用于文章等)<br>5:精准查询<br>";
      $hint="************************相关状态值提示:****************************************************<br><br>**********************************************************************************************<br>状态值*一级状态值status:<br>**********************************************************************************************<br>   0 |     模糊查询      param-------$item----------meaning    |               \"%\".$name       0        左包含    |                $name.\"%\"      1          右包 0     | 模糊查询 -> \"%\".$name.\"%\"    2          全包含     |                 '_'.$name.'_'    3          三个字符中间一个为name[一个_代表一个字符]    |                  $name.'_'      4          三个字符左一个为$name    |                 '_'.$name       5          三个字符右一个为$name<br>**********************************************************************************************<br>1      |     数据处理类 (大小比较)<br>**********************************************************************************************<br>2      |      链式条件查询<br>**********************************************************************************************<br>3      |      数据统计处理类(二级状态值statu2)<br>[<br>***************************<br>0:获取字段最大值<br>***************************<br>1:获取某字段的最小值<br>***************************<br>2:获取某字段的平均值<br>***************************<br>3:获取某字段的总和<br>***************************<br>4:个数统计<br>***************************<br>]<br>**********************************************************************************************<br>4      |      分页查询 (常用于文章等)<br>**********************************************************************************************<br>5      |      精准查询<br>**********************************************************************************************";
    switch($status){ 
    case 0: 
     /*
      *@topic:模糊查询
      *@param: $name 搜索值
      *@param: $item  一级数组下标参数
      *@param: $item_item   二级数组下标参数
      */
      $reName=array(
          "%".$name,    
          $name."%",     
          "%".$name."%",
          '_'.$name.'_',
          $name.'_',
          '_'.$name
          );
     $reLike=array(
      'not like',   
      'like'       
      );
    $result=Db::name($table)->where($column,$reLike[$item_item],$reName[$item])->fetchSql($makeSql)->cache($cache,$cacheTime)->limit($limitNum)->select();
       return $result;
    break;
         
          
    case 1:
     /*
      *@topic:数据比较(data compoare)
      *@param: $name 标准比较值
      *@param: $column 比较字段名
      *@param: $item    一级数组下标控制参数
      */
    $reName=array(
    ">",
    ">=",
    "<",
    "<=",
    "="
    );
    $result=Db::name($table)->where($column,$reName[$item],(integer)$name)->fetchSql($makeSql)->limit($limitNum)->order($orderColoumn,$orderRule)->cache($cache,$cacheTime)->select();
    return $result;
    break;
       
     
    case 2: 
     /*
      *@topic:链式条件查询
      *@param: $name 搜索值
      *@param: $column 字段名
      *@param: $getTerm  数组条件 array类型 格式array([条件1],[条件2]…)
      */
   //$getTerm二次封装
    $if=!empty($getTerm)?$getTerm:array(
    $column=>$name
      );
    return $result=Db::name($table)->where($if)->fetchSql($makeSql)->limit($limitNum)->order($orderColoumn,$orderRule)->cache($cache,$cacheTime)->select();
    break;
               
               
    case 3:
     /*
      *@topic:数据统计处理类
      *@param: $name 搜索值
      *@param: $column  操作字段名
      *@param: $transport  是否强制转换(true,false)boolea类型 默认否
      *@param: $statu2   二级状态参数   int类型 默认为0
      */
    $statu=!empty($statu2)?$statu2:0;  
       switch($statu){
       case 0:
           /*
            *@topic:获取字段最大值 
            *@param:$transport  是否强制转换(true,false)
            */
          if($transport){
           $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->max($column,!$transport);
           }else{
           $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->max($column);
           //where条件嵌套
           //  $data=Db::name($table)->where([])->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->max($column);
           }
       break;
      
       case 1:
           /*
            *topic:获取某字段的最小值
            *@param:$transport  是否强制转换(true,false)
            *
            */
          if($transport){
           $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->min($column,!$transport);
           }else{
           $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->min($column);
           //where条件嵌套
         //  $data=Db::name($table)->where([])->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->min($column);
           }
       break;
       
       case 2:
           /*
            *@topic:获取某字段的平均值
            *@param:$column  操作字段名
            */
             $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->avg($column);
             //加入where条件
            // $data=Db::name($table)->where([])->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->avg($column);
       break;
        
       case 3:
           /*
            *@topic:获取某字段的总和
            *@param:$column  操作字段名
            */
             $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->sum($column);
             //加入where条件
            // $data=Db::name($table)->where([])->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->sum($column);
       break;
       
      case 4:
           /*
            *@topic:字段值个数统计
            *@param:$column  操作字段名
            */
           $data=Db::name($table)->fetchSql($makeSql)->limit($limitNum)->cache($cache,$cacheTime)->count($column);
       break;
       default:
           $data="该状态值不合法！请重新输入！".$hint;
           break;
                   }
       return $data;
    break;
    
              
    case 4:  
           /*
            *@topic:分页查询
            *@param:$numPage  开始行参数
            *@param:$eachPageNum  每页查询数量参数
            */
    $pages=array(
    'numPage'=>!empty($numPage)?$numPage:1, //默认从第一页
    'eachPageNum'=>!empty($eachPageNum)?$eachPageNum:10 //默认查询10条
    );
     $result=Db::name($table)->order([$getOrderColumn=>$getOrderRule])->page($pages['numPage'],$pages['eachPageNum'])->fetchSql($makeSql)->cache($cache,$cacheTime)->select(); 
    return $result;
    break;
                
    case 5:
    
           /*
            *@topic:精准查询
            *@param:$name  索引值参数
            *@param:$column  操作字段名
            */
     $result=Db::name($table)->where($column,$name)->cache($cache,$cacheTime)->fetchSql($makeSql)->limit($limitNum)->select(); //find()查询单个数据
       return $result;
     break;   

     default:
      return  $data="该状态值不合法！<br>请选择指定状态值<br>".$hint;
         break;
    }
    }
   
}