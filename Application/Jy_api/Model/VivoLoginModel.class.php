<?php
namespace Jy_api\Model;
use Think\Model;
class VivoLoginModel extends Model{
    protected $autoCheckFields = false;
    /**
     * 登录
     * @param  $Authtoken  string
     * return  array
     */
    public  function Login($Authtoken){
        $Url = 'https://usrsys.vivo.com.cn/sdk/user/auth.do';
        $ParamString = 'authtoken='.$Authtoken.'&from=vivo';
        $Response  =  $this->tocurl($Url,$ParamString);
        if($Response == -2){
            return false;
        }
        return json_decode($Response,true);
    }
    /***
     * proto 请求
     * @param  string  $url    地址
     * @param  array  $header  头信息
     * @param  string  $content   proto 体
     * @param  int  $timeOut   请求超时
     **/
    public function tocurl($url,$content='',$header ='',$timeOut = 5){
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
