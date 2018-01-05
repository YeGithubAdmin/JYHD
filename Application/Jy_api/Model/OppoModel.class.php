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
            'oauthToken'            =>    urlencode($Token),
            'oauthSignatureMethod'  =>    'HMAC-SHA1',
            'oauthTimestamp'        =>    time(),
            'oauthNonce'            =>    rand(10,1000),
            'oauthVersion'          =>    '1.0',
        ) ;
         $Param ='';
         foreach ($baseStr as $k=>$v){
             $Param.=$k."=".$v."&";

         }
        $AppSecret = "7d560F0F49D2EdeD648818a005346107&";
        $Sign = base64_encode(hash_hmac("sha1", $Param, $AppSecret, true));

         $Content = array(
             'param:'.$Param,
             'oauthSignature:'.urlencode($Sign),
         );
        $Response = $this->Tocurl($Url,'',$Content);


        if($Response == -2){
            return false;
        }
        return json_decode($Response,true);
     }

}
