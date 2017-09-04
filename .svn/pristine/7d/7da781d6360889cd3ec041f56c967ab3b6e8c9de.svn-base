<?php
namespace  Common\Lib;
class wechat{
    //验证签名
    public function valid($token){
        $echoStr =  $_GET['echostr'];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr==$signature){
            echo $echoStr;
            exit;
        }
    }
    function weChatCurl($url, $data = '', $type='POST', $header = array()) {
        $ch = curl_init ();
        $header['charset'] = "utf-8";
        $header['Accept-Charset'] = "utf-8";
        curl_setopt( $ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        //curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36');
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        if($type=='POST'){
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data);
        }

        $return_data = curl_exec ($ch);
        curl_close($ch);
        return $return_data;
    }

    /**
     * 获取用户信息
     * @param unknown $appid
     * @param unknown $secret
     * @return Ambigous <number, mixed>
     */
    function wxInfo($appid, $secret){
        $redirect_uri = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

        $code = isset($_GET['code']) ? $_GET['code'] : '';
        if(!$code && empty($_SESSION['code'])){
            header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=dz#wechat_redirect");
            exit;
        }
        $access_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
        $access_token_json = json_decode(curl($access_token_url,'','GET'));
        $access_token = $access_token_json->access_token;
        $openid = $access_token_json->openid;
        $wx_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;
        $wx_info_json = $this->curl($wx_info_url,'','GET');
        $info = json_decode($wx_info_json);

        if(isset($info->error)){file_put_contents('./Log/wechat/'.date('Y-m-d').'.log', date('Y-m-d H:i:s')."::".$wx_info_json.PHP_EOL.PHP_EOL,FILE_APPEND);}
        return $wx_info_json;
    }

    /**
     * 微信网页授权
     * $scope snsapi_base：静默授权；snsapi_userinfo:需要用户点击确认授权
     */
    function wechatInfo($appid,$secret,$scope = 'snsapi_userinfo'){
        //获取code
        $redirect_uri = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        if(!$code){
            header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=dz#wechat_redirect");
            exit;
        }
        //获取access_token
        $access_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
        $access_token_json = json_decode($this->weChatCurl($access_token_url,'','GET'));
        $access_token = $access_token_json->access_token;
        $openid = $access_token_json->openid;
        //获取openid，判断是否关注等
        $token = $this->token($appid,$secret);
        $wechat = $this->getWXInfo($openid,$token);
        $tmpWX = $wechat;
        if(!$tmpWX['subscribe']){ //如果没有关注  subscribe 值是1为关注，0为没关注
            $wx_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;
            $wechat = json_decode($this->weChatCurl($wx_info_url,''), true);
        }

//         $info = json_decode($wechat,true);
//         if(isset($info->error)){file_put_contents('./Log/wechat/'.date('Y-m-d').'.log', date('Y-m-d H:i:s')."::".$wx_info_json.PHP_EOL.PHP_EOL,FILE_APPEND);}
        $wechat['subscribe'] = $tmpWX['subscribe'];
        return json_encode($wechat);
    }

    /**
     * 生成带参数的二维码
     * @param  [type] $id    推广者的id
     * @param  [type] $token access_token
     * return  string $qrurl
     */
    function qrcode($id,$appid,$secret){
        $data = array('expire_seconds'=>604800,'action_name'=>'QR_SCENE','action_info'=>array('scene'=>array('scene_id'=>$id)));
        $ticket = $this->weChatCurl("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".token($appid,$secret),json_encode($data));
        $ticket = json_decode($ticket,true);
        return 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($ticket['ticket']);
    }
    /**
     * 上传二维码到公众号
     * @param  [type] $id    推广者的id
     * @param  [type] $token access_token
     * return  string $qrurl
     */
    function add_qrcode($id,$appid,$secret){
        $media_id = file_exists(ROOT_PATH."Log/".$appid."_".$id.".json") ? json_decode(file_get_contents(ROOT_PATH."Log/".$appid."_".$id.".json"),true) : '';
        if(empty($media_id) || $media_id['expire_seconds'] < time()){
            $data = array('expire_seconds'=>604800,'action_name'=>'QR_SCENE','action_info'=>array('scene'=>array('scene_id'=>$id)));
            $ticket = $this->weChatCurl("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".token($appid,$secret),json_encode($data));
            $ticket = json_decode($ticket,true);
            $url =   'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($ticket['ticket']);
            $new_array = array();
            $new_array['expire_seconds'] = $data['expire_seconds'] + time()-3600;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER,0);
            curl_setopt($ch, CURLOPT_NOBODY,0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $package = curl_exec($ch);
            $httpinfo = curl_getinfo($ch);
            curl_close($ch);
            $dirs = ROOT_PATH.'Uploads/wehcat_qrcode/'.date('Y').'/'.date('m').'/'.date('d');
            if (!file_exists($dirs)) {
                @mkdir($dirs,0777,true);
            }
            $dir_url =$dirs .getRandChar(10)."."."png";
            file_put_contents($dir_url,$package);
            if(file_exists($dir_url)){
                $res = add_material($appid,$secret,$dir_url,'image');
                if(!empty($res['media_id'])){
                    $new_array['media_id']  =  $res['media_id'];
                    $dir_media_id = ROOT_PATH.'Log/';
                    if (!file_exists($dir_media_id)) {
                        @mkdir($dir_media_id,0777,true);
                    }
                    file_put_contents($dir_media_id.$appid."_".$id.".json",json_encode( $new_array));
                    return $res['media_id'];
                }
            }
        }else{
            return  $media_id['media_id'];
        }
    }
    /**
     * 获取access_token
     * @param  [type] $appid
     * @param  [type] $secret
     * return  string $token
     */
    function token($appid,$secret){
        $access_token = file_exists(ROOT_PATH."Log/access_token_".$appid.".json") ? json_decode(file_get_contents(ROOT_PATH."Log/access_token_".$appid.".json"),true) : '';
        if( empty($access_token) || time() > $access_token['expires_s']-20  ){
            $token = $this->weChatCurl('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret,'','GET');
            $token = json_decode($token,true);
            if($token){
                $access_token =  $token;
                $access_token['expires_s'] = $token['expires_in'] + time();
                $dir = ROOT_PATH.'Log';
                if (!file_exists($dir)) {
                    @mkdir($dir,0777,true);
                }
                file_put_contents($dir.'/access_token_'.$appid.'.json', json_encode($access_token));
            }
        }
        return $access_token['access_token'];
    }
    /**
     * 发送客服文本消息
     * @param  [type] $openid
     * @param  [type] $msg
     * @param  [type] $token
     */
    function setMsg($openid,$msg,$appid,$secret){
        $data = '{
                "touser":"'.$openid.'",
                "msgtype":"text",
                "text":
                {
                     "content":"'.$msg.'"
                }
            }';
        $res = $this->weChatCurl('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.token($appid,$secret),$data);
        return $res;
    }

    /**
     * 发送客服图片消息
     * @param  [type] $openid
     * @param  [type] $msg
     * @param  [type] $token
     */
    function setImg($openid,$media_id,$appid,$secret){
        $data = '{
            "touser":"'.$openid.'",
            "msgtype":"image",
            "image":
            {
              "media_id":"'.$media_id.'"
            }
        }';
        $res = $this->weChatCurl('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->token($appid,$secret),$data);
        return $res;
    }

    /**
     * 发送客服图文
     * @param  [type] $openid
     * @param  [type] $msg
     * @param  [type] $token
     */
    function setMaterial($openid,$media_id,$appid,$secret){
        $data = '{
            "touser":"'.$openid.'",
            "msgtype":"mpnews",
            "mpnews":
            {
              "media_id":"'.$media_id.'"
            }
        }';
        $res = $this->weChatCurl('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->token($appid,$secret),$data);
        return $res;
    }

    /**
     * 群发消息
     * @param  [type] $openid
     * @param  [type] $msg
     * @param  [type] $token
     */
    function setAll($msg,$token){
        $data = '{
                   "filter":{
                      "is_to_all":true,
                      "tag_id":2
                   },
                   "text":{
                      "content":"'.$msg.'"
                   },
                    "msgtype":"text"
                }';
        $res = $this->weChatCurl('https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$token,$data);
        return $res;
    }

    /**
     * 上传图片到公众号素材
     */
    function add_material($appid,$secret,$file,$type){
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.token($appid,$secret).'&type='.$type;
        // $url = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.Token($appid,$secret).'&type='.$type;
        $ch1 = curl_init ();
        if(class_exists('\CURLFile')) {
            $data['media'] =  new CURLFile(realpath($file));
        } else {
            $data['media'] = '@' . realpath($file);
        }
        curl_setopt ( $ch1, CURLOPT_URL, $url );
        curl_setopt ( $ch1, CURLOPT_POST, 1 );
        curl_setopt ( $ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ( $ch1, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ( $ch1, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch1, CURLOPT_POSTFIELDS, $data );
        curl_setopt($ch1, CURLOPT_INFILESIZE,filesize($file));
        $result = curl_exec ( $ch1 );
        curl_close ( $ch1 );
        return json_decode($result,true);
    }

    //token获取微信用户信息
    function getWXInfo($openid,$token){
        //获取用户微信信息
        $wxInfo = $this->weChatCurl("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$token."&openid=".$openid."&lang&lang=zh_CN",'','get');
        return json_decode($wxInfo, true);
    }

    //获取素材
    function media($token){
        $media_id = file_exists(DOCUMENT_ROOT."/Log/media_id.json") ? json_decode(file_get_contents(DOCUMENT_ROOT."/Log/media_id.json")) : '';
        if(empty($media_id) || $media_id->created_at < time() || !$media_id->media_id){
            $media = add_material("https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$token."&type=image",DOCUMENT_ROOT.'/Public/img/media_id2.jpg');
            $media = json_decode($media);
            if($media){
                $media_id->created_at = time() + 216000;
                $media_id->media_id = $media->media_id;
                $fp = fopen(DOCUMENT_ROOT."/Log/media_id.json", "w");
                fwrite($fp, json_encode($media_id));
                fclose($fp);
            }
        }
        return $media_id->media_id;
    }
    /*获取自定义菜单*/
    function wx_getMenu($appid,$secret){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->token($appid,$secret);
        $data = $this->weChatCurl($url);
        return json_decode($data,true);
    }
    /*创建自定义菜单*/
    function wx_createMenu($appid,$secret,$data){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = urldecode($data); //这里小坑，注意跳过
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*删除定义菜单*/
    function wx_deleteMenu($appid,$secret){
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->token($appid,$secret);
        $data = $this->weChatCurl($url);
        return json_decode($data,true);
    }
    /*获取模板列表*/
    function wx_getTemplate($appid,$secret){

        $url =  'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.$this->token($appid,$secret);
        $data = $this->weChatCurl($url);
        return json_decode($data,true);
    }
    /*新增永久素材*/
    function wx_addResources($appid,$secret,$data){
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = urldecode($data); //这里小坑，注意跳过
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*删除永久素材*/
    function wx_delResources($appid,$secret,$data){
        $url = 'https://api.weixin.qq.com/cgi-bin/material/del_material?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = urldecode($data); //这里小坑，注意跳过
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*获取素材*/
    function wx_getResources($appid,$secret,$data){
        $url  ='https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = urldecode($data);
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*获取素材条数*/
    function wx_getResourcesCount($appid,$secret){
        $url  ='https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token='.$this->token($appid,$secret);
        $data = $this->weChatCurl($url);
        return json_decode($data,true);
    }
    /*获取素材列表*/
    function wx_getResourcesList($appid,$secret,$data){
        $url  ='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*群发功能*/
    function wx_groupSend($appid,$secret,$data){
        $url  = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = urldecode($data);
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*发送模板消息*/
    function wx_TemSend($appid,$secret,$data){
        $url  = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->token($appid,$secret);
        $data = json_encode($data);
        $data = urldecode($data);
        $data = $this->weChatCurl($url,$data,'POST');
        return json_decode($data,true);
    }
    /*获取随机key值*/
    function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;
        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }

    /**
     *获取jsapi_ticket
     */
    function getJsApiTicket($appid,$secret){
        $jsapi_ticket = file_exists(ROOT_PATH."Log/jsapi_ticket_".$appid.".json") ? json_decode(file_get_contents(ROOT_PATH."Log/jsapi_ticket_".$appid.".json"),true) : '';
        if( empty($jsapi_ticket) || time() > $jsapi_ticket['expires_in']-20 ){
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$this->token($appid,$secret);
            $res = json_decode($this->weChatCurl($url),true) ;
            if($res){
                $jsapi_ticket =  $res;
                $jsapi_ticket['expires_in'] = $res['expires_in'] + time();
                $dir = ROOT_PATH.'Log';
                if (!file_exists($dir)) {
                    @mkdir($dir,0777,true);
                }
                file_put_contents($dir.'/jsapi_ticket_'.$appid.'.json', json_encode($jsapi_ticket));
            }
        }
        return $jsapi_ticket['ticket'];
    }

    /**
     *获取jsSDK验证内容
     */
    function getSignPackage($appid,$secret){
        $jsapiTicket = $this->getJsApiTicket($appid,$secret);
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appId"     => $appid,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }
    /*随机字符串*/
    function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    /*获取用户信息*/
    function wx_get_user($openid,$appid,$secret){
        $url  ='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.token($appid,$secret).'&openid='.$openid.'&lang=zh_CN';
        $data = $this->weChatCurl($url);
        return json_decode($data,true);
    }
}
