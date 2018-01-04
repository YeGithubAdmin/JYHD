<?php
namespace Jy_api\Model;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Model;
class PayComModel extends Model{
    protected $autoCheckFields = false;
    /***
    *  查询订单
    *  @param string  $PlatformOrder 订单号
    *  @param string  $playerid      用户ID
    */
    public function CatOrder($OrderID,$playerid =''){

        if(empty($OrderID)){
            return false;
        }

        $Field = array(
            'VipLevel',
            'VipExp',
            'playerid',
            'appuserid',
            'Price',
            'Status',
            'PayID',
            'Form',
        );
        if(!empty($playerid)){
            $where = 'playerid = '.$playerid.' PlatformOrder = "'.$OrderID.'"';
        }else{
            $where = ' PlatformOrder = "'.$OrderID.'"';
        }
        $CatData = M('jy_users_order_info')
                  ->where($where)
                  ->field($Field)
                  ->find();
        return $CatData;
    }
    /***
    * 查询商品
    * @param  int $GoodsID 商品ID
    */
    public function  CatGoods($OrderID,$playerid){
        $Field = array(
            'GoodsName',
            'GoodsCode',
            'GetNum',
            'Proportion',
            'GoodsID',
            'IsGive',
            'Number',
            'Type',
        );
        $CatData = M('jy_users_order_goods')
            ->where('playerid = '.$playerid.' and  PlatformOrder = "'.$OrderID.'"')
            ->field($Field)
            ->select();
        return $CatData;
    }
    /***
    * 拼接字符串
    * @param  $param array 参数
    * @param  $IsUrl bool  是否进行urlencode
    * return  string
    */
    public function MosaicString($param,$IsUrl = false){
        ksort($param);
        $str = '';
        foreach ($param as $k=>$v){
            $ParamVal = $v;
            if($IsUrl){
                $ParamVal = urlencode($ParamVal);
            }
            $str .= $k.'='.$ParamVal.'&';
        }
        return  substr($str,0,-1);
    }
    /***
    * vivo 下单
    * @param $param array 参数
    * @parma $appkey string 秘钥
    * return
    */
    public function VivoPayOrder($param,$appkey){
        $MosaicString = $this->MosaicString($param);
        ksort($param);
        $str = '';
        foreach ($param as $k=>$v){
            if($k != "signMethod"){
                $str .= $k.'='.$v.'&';
            }
        }
        $str  =  substr($str,0,-1);
        $signature = $this->GetMd5($str.'&'.$this->GetMd5($appkey));
        $PayParam = $MosaicString.'&signature='.$signature;
        $Url = 'https://pay.vivo.com.cn/vcoin/trade';
        $response= $this->tocurl($Url,$PayParam);
        if($response == -2){
            return false;
        }
        return json_decode($response,true);
    }
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
     * proto 请求
     * @param  string  $url    地址
     * @param  array  $header  头信息
     * @param  string  $content   proto 体
     * @param  int  $timeOut   请求超时
     **/
    public function tocurl($url,$content='',$header ='',$timeOut = 5){
        $ch = curl_init();
//        if(substr($url,0,5)=='https'){
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
//        }
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
