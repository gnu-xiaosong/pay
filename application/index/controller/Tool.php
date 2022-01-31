<?php
//这是工具接口类
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use thiagoalessio\TesseractOCR\TesseractOCR;


class Tool extends Controller
{

//图片文字识别
public function imageRecogition(){
/*
*request :
*@param: file  FormData 数据流对象 
*@param: mode  string 检测语言设置(auto ,manual)
*@param: manual_lang  array 数据流对象 
*@param: outputFileType  string 输出文件类型(支持txt,pdf,tsv等
*retrun :
*@param: text string 识别文字
*@param: url  string  下载类型链接
*/

//参数接收
$file=$_FILES["file"];
$mode=isset($_POST["mode"])?$_POST["mode"]:"auto";
$manual_lang=isset($_POST["manual_lang"])?json_decode($_POST["manual_lang"]):false;
$outputFileType=isset($_POST["outputFileType"])?$_POST["outputFileType"]:"txt";

//存放文件根路径
$tmp_path=$_SERVER['DOCUMENT_ROOT']."/upload/tmp";   //文件存放目录
$date=date("YmdHis");


//获取图片后缀
$file_type_arr=explode(".", $file["name"]);
$file_type=end($file_type_arr);
//保存文件路径
$image_path=$tmp_path.'/image/'.$date.'.'.$file_type;
//文本存在路径
$file_download_path=$tmp_path.'/text/'.$date.'.'.$outputFileType;


if(move_uploaded_file($file["tmp_name"], $image_path)){
//echo "文件上传成功！";
//$image=$file["tmp_name"];
//图像灰度处理
//$image=imagefilter(imagecreatefrompng($file_download_path), IMG_FILTER_GRAYSCALE);

//实例化一个TesseractOCR对象
$image=new TesseractOCR($image_path);

}

//语言检测设置
if($mode=="manual"){
//手动
$langArray=$manual_lang;  //传入数组
}else{
//默认自动检测语言
foreach($image->availableLanguages() as $lang){
    $langArray[]=$lang;
   }
}

//输出文本类型
$text=$image->lang($langArray)
              ->configFile($outputFileType)
              ->setOutputFile($file_download_path)
              ->run();
//返回数据封装
$data=array(
"code"=>200,
"message"=>"请求数据successful",
"data"=>array(
"text"=>$text,
"download_url"=>"http://".$_SERVER["HTTP_HOST"]."/upload/tmp/text/".$date.'.'.$outputFileType
)
);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
    
    
    
    
    
//excel操作接口
public function excel(){
         
         $file=$_FILES["excel"];
         
         $u=explode(".", $file["name"]);
         $end=end($u);
         if($end=="xlsx"){
         $suffix='Xlsx';  //excel格式
         }else if($end=="xls"){
         $suffix='Xls';  //excel格式
         }else{
           $re=array(
         "code"=>300,
         "insertData"=>0,
         "message"=>"未识别excel格式！"
        );
        return json_encode($re, JSON_UNESCAPED_UNICODE);
         }
         
         
         
         $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($suffix);
         //加载表
         $xlsx=$reader->load($file["tmp_name"]);
         //获得活动表
         $worksheet = $xlsx->getActiveSheet();
         //读取表高度和宽度
	     $highestColumn = $worksheet->getHighestColumn();
	     $highestRow = $worksheet->getHighestRow();
         
         //遍历输出cell值
         foreach($worksheet->getRowIterator() as $row){
         $cellIterator = $row->getCellIterator();
         $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                               
         //按行遍历值                                                                     //    even if a cell value is not set.                                                      // By default, only cells that have a val                                      //    set will be iterated.
         foreach ($cellIterator as $cell){
         //数组封装
         $data[]=$cell->getValue();     
           }
       
         //二维数组封装
        $data1[]=$data;
         //释放内存
        unset($data);
        }
      
      //遍历添加数据
       foreach($data1 as $key=>$item){
       //封装数据，二维数组
        $insert[]=['answer'=>isset($item[0])?$item[0]:"问题",'question'=>isset($item[1])?$item[1]:"答案",'category'=>isset($item[2])?$item[2]:"未分类",'user'=>isset($item[3])?$item[3]:"未知用户" ];
        
        }
      //   dump($insert);
        //添加数据
        $result=Db::name("answer_source")->insertAll($insert);
        
        //返回数据
        $re=array(
         "code"=>200,
         "insertData"=> $result,
         "message"=>"成功插入".$result."条数据"
        );
        echo json_encode($re, JSON_UNESCAPED_UNICODE);
      //  echo  $result;
     //打印测试(获取到的二维数组值$data1)

         
      //  echo "高度:".$highestColumn."宽度:".$highestRow;
        
        
}
    

}