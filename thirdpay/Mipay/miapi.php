<?php
class Miapi{
    /***
    * 验签  Session
    **/
    public function VerificationSession($appId,$key,$uid,$session){
        $url    = 'http://mis.migc.xiaomi.com/api/biz/service/verifySession.do?';
        $Sign = array(
            'appId'=>$appId,
            'session'=>$session,
            'uid'=>$uid,
        );
        $Sign['signature'] = $this->PlusSign($key,$Sign);
        //请求参数
        $meter = http_build_query($Sign);
        $url .=  $meter;
        return $this->Send0ut($url,'',5);
    }
    /**
    * 加签
    * @param  $Sign array  加签参数
    * @param  $key  string  秘钥：AppSecretKey
    **/
    public function PlusSign($key,$Sign){
        if(is_array($Sign)){
            $Sign = http_build_query($Sign);
        }
        $signature = bin2hex(hash_hmac("sha1",$Sign,$key,true));
        return  $signature;
    }

    /***
    * 发送请求
    */
    public function Send0ut($url,$data,$time = 60){
        $ch = curl_init();
        if(substr($url,0,5)=='https'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT , $time);
        if(!empty($data)){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $response = curl_exec($ch);
        if($response === false){
            if(curl_errno($ch) == CURLE_OPERATION_TIMEDOUT){
                return 504;
            }
        }
        curl_close($ch);
        return $response;
    }
    /****
    * 验签
    **/
    function VerificationSign($key,$meter,$Sign){
        $signature  =  $this->PlusSign($key,$meter);
        if($Sign == $signature) {
            return true;
        }else{
            return false;
        }
    }
}


