<?php
namespace Common\Model;

use Think\Model;
class ComFunModel extends Model{
    protected $autoCheckFields = false;
    /***
    * rsa  私钥加签
    **/
    public  function SignPrivate($param,$private,$type = ''){
        $res = openssl_pkey_get_private($private);
        // $data=sha1($data); //sha1加密（如果需要的话，如果进行加密，则对方也要进行加密后做对比）
        if($type != ''){
            openssl_sign($param, $Sign, $res,$type);
        }else{
            openssl_sign($param, $Sign, $res);
        }
        openssl_sign($param, $Sign, $res);
        openssl_free_key($res);
        //base64编码
        $Sign = base64_encode($Sign);
        return $Sign;
    }
    /***
     * rsa  公钥加签
     **/
    public function SignPublic($param,$public,$type =''){
        $res = openssl_pkey_get_public($public);
        // $data=sha1($data); //sha1加密（如果需要的话，如果进行加密，则对方也要进行加密后做对比）
        if($type !=''){
            openssl_sign($param, $Sign, $res,$type);
        }else{
            openssl_sign($param, $Sign, $res);
        }
        openssl_free_key($res);
        //base64编码
        $Sign = base64_encode($Sign);
        return $Sign;
    }
    /***
    * rsa  私钥验签
    **/
    public function Everification($valueMap,$sign,$private,$type =''){
        $openssl_private_key = @openssl_pkey_get_private($private);
        if($type != '') {
            $res = openssl_verify($valueMap, base64_decode($sign), $openssl_private_key,$type);
        }else{
            $res = openssl_verify($valueMap, base64_decode($sign), $openssl_private_key);
        }
        @openssl_free_key($openssl_private_key);
        return $res;
    }
    /***
     * rsa  公钥验签
     **/
    public function PayVerification($valueMap,$sign,$public,$type =''){
        $openssl_public_key = @openssl_pkey_get_public($public);

        if($type != '') {
            $res = openssl_verify($valueMap,base64_decode($sign), $openssl_public_key,$type);
        }else{
            $res = openssl_verify($valueMap,base64_decode($sign), $openssl_public_key);
        }
        @openssl_free_key($openssl_public_key);
        return $res;
    }
    /***
    * url参数转数组
    * @param $param string  url参数
    */
    public function UrlToArry($param,$IsUrl=array()){
        $elements = split('&', $param);
        $valueMap = array();
        foreach ($elements as $element) {
            $single = split('=', $element);

            if (in_array($single[1],$IsUrl)){
                $single[1]  = urldecode($single[1]);
            }
            $valueMap[$single[0]] = $single[1];
        }

        return $valueMap;
    }

    /***
    * 拼装
    * @param $array array  参数
    * @param $unset array  过滤参数
    * @param $IsUrl array  urlencode
    */
    public function MosaicUrl($array,$unset=array(),$IsUrl=array()){
          $MosaicUrl = '';
          ksort($array);
          foreach ($array as $k=>$v){
              if(!in_array($v,$unset)){
                  if(in_array($v,$IsUrl)){
                      $Value = urlencode($v);
                  }else{
                      $Value =$v;
                  }
                  $MosaicUrl.=$k."=".$Value."&";
              }

          }
          return substr($MosaicUrl,0,-1);
    }


    /***
    * curl
    * @param  $url      string  地址
    * @param  $content  unknow  内容
    * @param  $header   unknow  头信息
    * @param  $timeOut  int     请求超时间
    */
    public function Tocurl($url,$content='',$header ='',$timeOut = 5){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT , $timeOut);
        if($header !=''){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if($content != ''){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        $response = curl_exec($ch);
        if($response === false){
            if(curl_errno($ch) == CURLE_OPERATION_TIMEDOUT){
                return -2;
            }
        }
        curl_close($ch);
        return $response;
    }

    public function exportExcel($expTitle,$expCellName,$expTableData,$setWidth = 20){
        include JY_ROOT."PHPExcel/PHPExcel.php";
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA');
        //实例对象
        $PHPExcel = new \PHPExcel();
        //创建工作区
        $PHPExcel->createSheet(0);
        // 设置当前激活的工作表编号
        $PHPExcel->setActiveSheetIndex(0);
        // 获取当前激活的工作表
        $Sheet = $PHPExcel->getActiveSheet();
        //居中
        $PHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPExcel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //设置背景样色
        $PHPExcel-> getActiveSheet()->getStyle( 'A1:T1')-> getFill() -> setFillType(\PHPExcel_Style_Fill :: FILL_SOLID);
        $PHPExcel-> getActiveSheet() -> getStyle('A1:T1') -> getFill() -> getStartColor() -> setARGB('#abd4e8');
        foreach ($cellName as $k=>$v){
            $Sheet->getColumnDimension($v)->setWidth(20);
            $Sheet->setCellValue($v.'1',$expCellName[$k]);
        }
        foreach ($expTableData as $k=>$v){
            $i = $k+2;
            $j = 0;
            foreach ($v as $key=>$val){
                $Sheet->setCellValue($cellName[$j].$i,$val);
                $j++;
            }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$expTitle.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }



   public function getRand($proArr) {
         $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }







}
