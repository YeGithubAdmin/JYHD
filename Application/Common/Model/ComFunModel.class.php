<?php
namespace Common\Model;

use Think\Model;
class ComFunModel extends Model{
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









}
