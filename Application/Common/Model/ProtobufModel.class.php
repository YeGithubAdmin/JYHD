<?php
namespace Common\Model;
use Protos\PBS_ThirdPartyLogin;
use Protos\PBS_ThirdPartyLoginReturn;
use Think\Exception;
use Think\Model;
class ProtobufModel extends Model{
    protected $autoCheckFields = false;
    public function __construct(){
        spl_autoload_register( array($this,'ProtoClass'));
    }
    public function ProtoClass($ClassName){
        $Class  =   explode('\\',$ClassName);
        $Count  =   count($Class);
        if($Count == 2){
            $FileName = PROTOC_PATH.$Class[0].'/'.$Class[1].'.php';
        }else{
            $FileName = PROTOC_PATH.'/'.$Class[0].'.php';
        }
        try{
            if(file_exists($FileName)){
                include  $FileName;
            }else{
                throw new Exception('file is not exists');
            }
        }catch (Exception $exception){
            $exception->getMessage();
        }
    }


    /***
     * protobuf发送请求
     * @param $PBName    string       包名
     * @param $content   protobuf     包体
     */
    public function   ProtobufSend($Header,$content,$Server=SERVER_PROTO){
        $TheBagBody = array(
            'body'=>$content
        );
        $Respond = $this->tocurl($Server,$Header,$TheBagBody);
        if($Respond  == 504){
            return  504;
        }
        return $Respond;
    }

    /***
     * proto 请求
     * @param  string  $url    地址
     * @param  array  $header  头信息
     * @param  string  $content   proto 体
     * @param  int  $timeOut   请求超时
     **/
    public function tocurl($url, $header, $content,$timeOut = 5){
        $ch = curl_init();
        if(substr($url,0,5)=='https'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT , $timeOut);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $response = curl_exec($ch);
        if($response === false){
            if(curl_errno($ch) == CURLE_OPERATION_TIMEDOUT){
                return 504;
            }
        }
        curl_close($ch);
        return $response;
    }


    /***
    * 登陆协议
    * @param $data  array  请求参数
    * return  ubkonw
    */
    public function ThirdLogin($data){
        if(is_string($data)){
            return false;
        }
        $PBS_ThirdPartyLogin        = new PBS_ThirdPartyLogin();
        $PBS_ThirdPartyLoginReturn  = new PBS_ThirdPartyLoginReturn();
        $PBS_ThirdPartyLogin->setChannel($data['Channel']);
        $PBS_ThirdPartyLogin->setUid($data['Uid']);
        $PBS_ThirdPartyLogin->setLoginCode($data['LoginCode']);
        $String   = $PBS_ThirdPartyLogin->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_ThirdPartyLogin',
            'PBSize:'.strlen($String),
            'UID:1',
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$data['Version'],
        );
        $Respond  = $this->ProtobufSend($Header,$String);
        if($Respond == 504){
            return false;
        }
        $PBS_ThirdPartyLoginReturn->parseFromString($Respond);
        $ReplyCode = $PBS_ThirdPartyLoginReturn->getCode();
        return $ReplyCode;
    }


    /**
    *
    */
    public function PayBacak(){

    }


}
