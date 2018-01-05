<?php
namespace Jy_api\Model;
use Think\Model;
class OppoModel extends \Common\Model\ComFunModel {
    protected $autoCheckFields = false;

    /***
    *  登陆
    *  @param $Ssoid string unkonw
    *  @param $Token string unkonw
    */
     public function  Login($Ssoid,$Token){
        $Url = 'http://i.open.game.oppomobile.com/gameopen/user/fileIdInfo?fileId='.urlencode($Ssoid).'&token='.urlencode($Token);
        $baseStr = array(
            'oauthConsumerKey'      =>    'av4Vtq0LkYGc00Kwo04O400sK',
            'oauthToken'            =>    $Token,
            'oauthSignatureMethod'  =>    'HMAC-SHA1',
            'oauthTimestamp'        =>    time(),
            'oauthNonce'            =>    rand(10,10000000),
            'oauthVersion'          =>    '1.0',
        ) ;
        $Param = $this->MosaicUrl($baseStr);
        $AppSecret = "7d560F0F49D2EdeD648818a005346107&";
        $Sign = $this->Sign($Param,$AppSecret);
        $Content = array(
                    'param'=>$Param,
                    'oauthSignature'=>$Sign,
        );
        $Response = $this->Tocurl($Url,'',$Content);

        if($Response == -2){
            return false;
        }
        return json_decode($Response,true);
     }
     /***
     * 加签
     * @param  $param string  unkonw
     * @param  $key   string  key
     * return  string  签名
     **/
     public function Sign($param,$key){
         openssl_sign($param, $Sign, $key);
         openssl_free_key($key);
         return base64_encode($Sign);
     }
}
