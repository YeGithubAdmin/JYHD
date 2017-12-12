<?php
class  HuaWeiFun{

  /***
  * 登录验签
  */
  public function  LoginVerification($content,$sign){
      $filename = HUAWEISDK.'payPublicKey.pem';
      if(!file_exists($filename)){
            return false;
      }
      $pubKey = @file_get_contents($filename);
      $openssl_public_key = @openssl_get_publickey($pubKey);
      $ok = @openssl_verify($content, base64_decode($sign), $openssl_public_key, OPENSSL_ALGO_SHA256);
      @openssl_free_key($openssl_public_key);
      return $ok;
  }
  /***
  * 支付回调验证
  */
  public function PayVerification($valueMap,$sign){
      $filename = HUAWEISDK.'payPublicKey.pem';
      if(!file_exists($filename)){
          return false;
      }
      $content = "";
      $i = 0;
      foreach($valueMap as $key=>$value) {
          if($key != "sign" ) {
              $content .= ($i == 0 ? '' : '&').$key.'='.$value;
          }
          $i++;
      }
      $pubKey = @file_get_contents($filename);
      $openssl_public_key = @openssl_get_publickey($pubKey);
      $ok = @openssl_verify($content,base64_decode($sign), $openssl_public_key);
      @openssl_free_key($openssl_public_key);
      return $ok;
  }
  /**
  *  支付参数
  */
  public function Elements($dataThirdpay){
      $elements = split('&', $dataThirdpay);
      $valueMap = array();
      foreach ($elements as $element)
      {
          $single = split('=', $element);
          $valueMap[$single[0]] = $single[1];
      }
      if(null !== $valueMap["sign"])
      {
          $valueMap["sign"] = urldecode($valueMap["sign"]);
      }
      if(null !== $valueMap["extReserved"])
      {
          $valueMap["extReserved"]= urldecode($valueMap["extReserved"]);
      }
      if(null !== $valueMap["sysReserved"])
      {
          $valueMap["sysReserved"] = urldecode($valueMap["sysReserved"]);
      }
      ksort($valueMap);
      return $valueMap;
  }
  //签名私钥
  public  function redSignkey($param){
      ksort($param);
      $arg = "";
      while (list ($key, $val) = each ($param)) {
          $arg.=$key."=".$val."&";
      }
      $Filename = HUAWEISDK.'Privatekey.pem';
      if(!file_exists($Filename)){
        return false;
      }
      //去掉最后一个&字符
      $arg = substr($arg,0,count($arg)-2);
      //如果存在转义字符，那么去掉转义
      if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

      $Private =   @file_get_contents($Filename);
      $res = openssl_get_privatekey($Private);
        // $data=sha1($data); //sha1加密（如果需要的话，如果进行加密，则对方也要进行加密后做对比）
      openssl_sign($arg, $Sign, $res);
      openssl_free_key($res);
      //base64编码
      $Sign = base64_encode($Sign);
      return $Sign;
  }
}



