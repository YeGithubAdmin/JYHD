<?php
namespace Jy_Thirdpay\Model;
use Think\Model;
class VivoBackModel extends Model{
    protected $autoCheckFields = false;
    /***
     * vivo md5
     * @param $param string
     * return  MD5 16位值
     */
    public function GetMd5($param){
        $Binary = unpack("c*", md5($param,true));
        $str =  '';
        foreach ($Binary as $k => $v) {
            $bin2hex =    dechex (0xFF & $v);
            if(strlen($bin2hex ) == 1){
                $bin2hex =    '0'.dechex(0xFF & $v);
            }
            $str .= $bin2hex;
        }
        return $str;
    }
    /***
    * 验签
    *
    */
    public function Verification($param,$sign,$key){
        ksort($param);
        $str = '';
        foreach ($param as $k=>$v){
            if($k != "signMethod"){
                $str .= $k.'='.$v.'&';
            }
        }
        $str  =  substr($str,0,-1);
        $signature = $this->GetMd5($str.'&'.$this->GetMd5($key));
        if($signature != $sign ){
                return false;
        }
        return true;
    }
    /***
    * 回调参数
    */
    public function Elements($param){
        $elements = split('&', $param);
        $valueMap = array();
        foreach ($elements as $element) {
            $single = split('=', $element);
            $valueMap[$single[0]] = $single[1];
        }
        return $valueMap;
    }

}
