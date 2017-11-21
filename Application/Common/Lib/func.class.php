<?php
namespace  Common\Lib;
class func{
/**
 * 获取当前页面完整URL地址
 */
	public function get_url() {
			$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
			$php_self = $_SERVER['PHP_SELF'] ? $this->safe_replace($_SERVER['PHP_SELF']) : $this->safe_replace($_SERVER['SCRIPT_NAME']);
			$path_info = isset($_SERVER['PATH_INFO']) ? $this->safe_replace($_SERVER['PATH_INFO']) : '';
			$relate_url = isset($_SERVER['REQUEST_URI']) ? $this->safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$this->safe_replace($_SERVER['QUERY_STRING']) : $path_info);
			return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
	
	/**
	 * 获取string中的参数
	 * @param string $par_data		string
	 * @return $return_data
	 */
	public  function getPar($par_data){
		$return_data = array();
		if ($par_data != ''){
			$tmp = explode('&', $par_data);
			if ($tmp){
				foreach ($tmp as $v){
					if ($v != ''){
						$arr = explode('=', $v);
						if ($arr){
							$return_data[$arr[0]] = isset($arr[1]) ? $arr[1] : '';
						}
					}
				}
			}

		}
		return $return_data;
	}

	/**
	 * 检查手机格式
	 * @param string $phone
	 * @return boolean
	 */
	public function checkPhone($phone=''){
		if(!preg_match('/^1[34578]\d{9}$/', $phone)){
			//手机号码格式不正确
			return false;
		}
		return true;
	}

	/**
	 * 检查密码格式
	 * @param string $pwd
	 * @return boolean
	 */
	public function checkPwd($pwd=''){
		if (strlen($pwd) != 32){
			//密码格式md5错误
			return false;
		}
		return true;
	}
	/**
	*记录文本
	*@param string $file_name 文件路径
	*@param string $msg       记录类型
	*/
	public function record_log($dir,$file_name,$msg){
		    $separator = '*********************************';
            if(!file_exists($dir)){
                @mkdir($dir,0777,true);
            }
		    @file_put_contents($dir.$file_name, $separator."\nTime:".date('Y-m-d H:i:s')."\nIP:".$_SERVER['REMOTE_ADDR']."\nUrl:".$this->get_url()."\n$msg\n$separator\n", FILE_APPEND);
	}
  /**
 * function showmessage()			提示信息
 * @param string $info				信息内容
 * @param string $url_forward		跳转地址
 * @param number $ms				等待时间
 */
   public function showmessage($info='参数错误', $url_forward='goback', $ms=3){
        echo
        '<div class="layui-layer-shade" id="layui-layer-shade1" times="1" style="z-index:19891014; background-color:#000; opacity:0.3; filter:alpha(opacity=30);"></div>
         <div class="layui-layer layui-anim layui-layer-dialog " id="layui-layer1" type="dialog" times="1" showtime="0" contype="string" style="z-index: 19891015; top: 40%; left: 40%;">
            <div class="layui-layer-content" style="text-align: center"><a href="###">'.$info.'</a></div>
            <span class="layui-layer-setwin"></span>
            <div class="layui-layer-btn">
             <a class="layui-layer-btn0" onclick="showmessage()">确定</a>
         </div>
         </div>';
        if($url_forward != "goback" ){
            echo "<script>      
        function showmessage() {
            var obj = window.parent.document;obj.location.reload()
            var index = parent.layer.getFrameIndex(window.name);
            parent.$('.btn-refresh').click();
            parent.layer.close(index);
            }
          </script>";
        }else{
            echo "<script>      
                function showmessage() {
                   window.history.back();
                  }
          </script>";
        }

    }
	 /**
	 * 安全过滤函数
	 * @param $string
	 * @return string
	 */
	public function safe_replace($string) {
			$string = str_replace('%20','',$string);
			$string = str_replace('%27','',$string);
			$string = str_replace('%2527','',$string);
			$string = str_replace('*','',$string);
			$string = str_replace('"','&quot;',$string);
			$string = str_replace("'",'',$string);
			$string = str_replace('"','',$string);
			$string = str_replace(';','',$string);
			$string = str_replace('<','&lt;',$string);
			$string = str_replace('>','&gt;',$string);
			$string = str_replace("{",'',$string);
			$string = str_replace('}','',$string);
			$string = str_replace('\\','',$string);
			return $string;
	}
	/**
	* 随机整形数字
	* @param int  $num  随机位数
	* return string
	*/
    public function getrand($num){
		$data = '';
		for($i=0;$i<$num;$i++){
			$data .= rand(0,9);
		}
		return $data;
    }
	/**
	*curl
	* @param string $url 请求地址
	* @param string $data   null  为gei  有值为 post
	* return string
	*/
	Public function httpsRequest($url, $data = null ) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
    /**
    *获取每个月的天数
    *
     */
    Public  function get_days_by_year($year,$month){
        //首先判断闰年
        if($year%400 == 0  || ($year%4 == 0 && $year%100 !== 0)){
            $rday = 29;
        }else{
            $rday = 28;
        }
        if($month==2){
            $days = $rday;
        }else{
            //判断是大月（31），还是小月（30）
            $days = (($month - 1)%7%2) ? 30 : 31;
        }
        return $days;
    }

    /**
     * 计算两点地理坐标之间的距离
     * @param Decimal $longitude1 起点经度
     * @param Decimal $latitude1 起点纬度
     * @param Decimal $longitude2 终点经度
     * @param Decimal $latitude2 终点纬度
     * @param Int   $unit    单位 1:米 2:公里
     * @param Int   $decimal  精度 保留小数位数
     * @return Decimal
     */
    Public function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){

        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;

        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;

        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI /180.0;

        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
        $distance = $distance * $EARTH_RADIUS * 1000;

        if($unit==2){
            $distance = $distance / 1000;
        }

        return round($distance, $decimal);

    }
    /**
     * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
     * 注意：服务器需要开通fopen配置
     * @param $word 要写入日志里的文本内容 默认值：空值
     */
    public  function logResult($word='') {
        $filename = APP_ROOT.'Log/alipay/log_'.date('Ymd');
        @file_put_contents($filename, "执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n",FILE_APPEND);
    }
    /**
     * curl方法
     * @param string 	$url
     * @param string 	$param
     * @param int 	  $timeOut  超时时间（秒）
     */
    public function curl($url, $param, $timeOut=60){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_TIMEOUT,$timeOut);
        $content=curl_exec($ch);
        if(curl_errno($ch)){
            return -2;
        }
        curl_close($ch);
        return $content;
    }
    /**
    * 微信退款
     * @param string  $transaction_id 微信订单
     * @param int     $total_fee    订单总价/分
     * @param int     $refund_fee   退款金额/分
     */
    public function wechartRetreat($transactionid,$totalfee,$refundfee){
        ini_set('date.timezone', 'Asia/Shanghai');
        require_once APP_ROOT . "thirdpay/wechartRetreat/lib/WxPay.Api.php";
        require_once APP_ROOT . 'thirdpay/wechartRetreat/example/log.php';
        //初始化日志
        $logHandler = new \CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
        $log = \Log::Init($logHandler, 15);

        function printf_info($data)
        {
            foreach ($data as $key => $value) {
                echo "<font color='#f00;'>$key</font> : $value <br/>";
            }
        }

        if (isset($transactionid) && $transactionid != "") {
            $transaction_id = $transactionid;
            $total_fee = $totalfee;
            $refund_fee = $refundfee;
            $input = new \WxPayRefund();
            $input->SetTransaction_id($transaction_id);
            $input->SetTotal_fee($total_fee);
            $input->SetRefund_fee($refund_fee);
            $input->SetOut_refund_no(\WxPayConfig::MCHID . date("YmdHis"));
            $input->SetOp_user_id(\WxPayConfig::MCHID);
            return \WxPayApi::refund($input);
        }
    }
        //$_REQUEST["out_trade_no"]= "122531270220150304194108";
        ///$_REQUEST["total_fee"]= "1";
        //$_REQUEST["refund_fee"] = "1";

    /**
     * 判断是否微信浏览器登录
     * @return boolean
     */
    public function isWeixin(){
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }
	/**
	 *抽奖
	 * @param array  物品ID  概率
	 * return number 物品ID
	 */
	public function _getRand($proArr) { //计算中奖概率
		$rs = ''; //z中奖结果
		$proSum = array_sum($proArr); //概率数组的总概率精度
		//概率数组循环
		foreach ($proArr as $key => $proCur) {
			$randNum = mt_rand(1, $proSum);
			if ($randNum <= $proCur) {
				$rs = $key;
				break;
			} else {
				$proSum -= $proCur;
			}
		}
		unset($proArr);
		return $rs;
	}

	/***
	 *  无限极递菜单
	 * @param  array    $list        全部菜单
	 * @param  int      $pk          菜单ID
	 * @param  int      $upid        父级id
	 * @param  string   $sub_menu    子菜单名
	 * @param  int      $root        最上级upid
	 * return  array    返回结果集
	 ***********/
	public function make_tree($list,$pk='id',$upid='upid',$sub_menu ='sub_menu',$root=0){
		$tree=array();
		foreach($list as $k=>$v){
			if($v[$upid] == $root){
				unset($list[$k]);
				if(!empty($list)){
					$child= $this->make_tree($list,$pk,$upid,$sub_menu,$v[$pk]);
					if(!empty($child)){
						$v[$sub_menu]=$child;
					}
				}
				$tree[]=$v;
			}


		}
		return $tree;
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
    /**
    * 引入protobuf 类
    * @param   $Class  array   protobuf 文件名
    ***/
	public function  ProtobufObj($Class){
        if(!is_array($Class)){
            return false;
        }
        foreach ($Class as $k=>$v){
            $dir =  PROTOC_PATH.$v;
            if(file_exists($dir)){
                include  $dir;
            }
        }
    }

    /***
    * protobuf发送请求
    * @param $PBName    string       包名
    * @param $content   protobuf     包体
    */
    public function   ProtobufSend($PBName,$content,$uid){
        $addr =  CONTROLLER_NAME.ACTION_NAME;

        $header = array(
            'PBName:'.$PBName,
            'PBSize:'.strlen($content),
             'UID:'.$uid,
            'PBUrl:'.$addr,
        );
        $TheBagBody = array(
            'body'=>$content
        );
        $Server =  '';
        if(defined('SERVER_PROTO_IOS')){
             $Server =  SERVER_PROTO_IOS;
        }else{
             $Server = SERVER_PROTO;
        }
        $Respond = $this->tocurl($Server,$header,$TheBagBody);
        if($Respond  == 504){
            return  504;
        }
        return $Respond;
    }


    /***
    * protobuf  回应
    * @param   $ProtobufObj  protobuf 对象
    */
    public function  ProtobufRespond($ProtobufObj){
        if(is_object($ProtobufObj)) return  false;
        $ProtobufObj->parseFromString();
        $ReplyCode = $ProtobufObj->getCode();

            return $ReplyCode;

    }
    /***
     * 随机数
     * @param   $num    int     位数
     * @param   $digit  bool    是否转成16进行
     */
    public  function  RandomNumber($number=4,$Letter=4){
        $numberArr = array(
            0,1,2,3,4,5,6,7,8,9
        );
        $LetterArr = array(
            'Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L',
            'Z','X','C','V','B','N','M',
            'q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l',
            'z','x','c','v','b','n','m'
        );
        $numberCount  =  count($numberArr);
        $LetterCount  =  count($LetterArr);
        $string = '';
        for ($i=0;$i<$Letter;$i++){
            $key  = mt_rand(0,$LetterCount-1);
            $string .= $LetterArr[$key] ;
        }
        for ($i=0;$i<$number;$i++){
            $key  = mt_rand(0,$numberCount-1);

            $string .= $numberArr[$key] ;
        }
        return  $string;
    }

   /***
   * 爱贝支付下单接口
   * @param  $Info     array   下单信息
   * @param  $appkey   string  私钥
   * @param  $platpkey string  公钥
   **/
   public function IapppayOrder($Info,$appkey,$platpkey){
        include IAPPPAY."base.php";
        $orderUrl = "http://ipay.iapppay.com:9999/payapi/order";
        $reqData = composeReq($Info, $appkey);
        $respData = request_by_curl($orderUrl, $reqData, 'order test');
        $parseResp = parseResp($respData, $platpkey, $respJson);
        if(!$parseResp){
            return false;
        }else{
            return $respJson->transid;
        }
   }


   /***
   * 金立下单接口
   * @param   $arr array  下单信息
   */
    public function  JinPayCreateOrder($arr,$private_key){
        $dst_url                    =  "https://pay.gionee.com/order/create";
        $post_arr['api_key']        =  $arr['api_key']; // 【NOTE】跑通demo后替换成商户自己的api_key
        $post_arr['subject']        =  $arr['subject']; // 【NOTE】请填写你的支付标题
        $post_arr['out_order_no']   =  $arr['out_order_no']; // 【NOTE】跑通demo后替换成你自己生成的内部订单，每个订单的paynum需要不一样
        $post_arr['deliver_type']   =  $arr['deliver_type']; // 网游类型接入时固定值
        $post_arr['deal_price']     =  $arr['deal_price']; // 【NOTE】 需要支付的金额
        $post_arr['total_fee']      =  $arr['total_fee']; // 【NOTE】需要支付的金额
        $post_arr['submit_time']    =  date('YmdHis');
        $post_arr['notify_url']     =  $arr['notify_url']; // 【NOTE】请填写充值后的回调URL
        $post_arr['sign']           =  $this->JinPayOrderSign($post_arr,$private_key);
        $post_arr['player_id']      =  $arr['player_id']; // 【NOTE】请填写amigo玩家id
        $json = json_encode($post_arr);
        $return_json = $this->https_curl($dst_url, $json);
        $return_arr = json_decode($return_json, 1);
        if ($return_arr['status'] !== '200010000') {
           return false;
        }
        return $return_arr;
    }
    /***
    * 回调金立验签
    * @param   $publickey string  私钥
    * @param   $$post_arr array   回调数据
    */
    public function JinPayRsaverify($publickey,$post_arr){
        ksort($post_arr);
        $signature_str = '';
        foreach($post_arr as $key => $value){
            if($key == 'sign') continue;
            $signature_str .= $key.'='.$value.'&';
        }
        $signature_str = substr($signature_str,0,-1);
        $pem = chunk_split($publickey,64,"\n");
        $pem = "-----BEGIN PUBLIC KEY-----\n".$pem."-----END PUBLIC KEY-----\n";
        $public_key_id = openssl_pkey_get_public($pem);
        $signature =base64_decode($post_arr['sign']);
        return openssl_verify($signature_str, $signature, $public_key_id);
    }
    /***
     * 下单验证
     * @param   $publickey string  私钥
     * @param   $post_arr array    下单信息
     */

    public  function  JinPayOrderSign($post_arr,$publickey){
        ksort($post_arr);
        $signature_str = '';
        foreach($post_arr as $key => $value){
            $signature_str .= $value;
        }
        // 【NOTE】跑通demo后替换成商户自己的private_key
        $pem = chunk_split($publickey,64,"\n");
        $pem = "-----BEGIN PRIVATE KEY-----\n".$pem."-----END PRIVATE KEY-----\n";
        $private_key_id = openssl_pkey_get_private($pem);
        $signature = false;
        openssl_sign($signature_str, $signature, $private_key_id);
        $sign =  base64_encode($signature);
        return $sign;
    }

   public function https_curl($url, $post_arr = array(), $timeout = 10){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_arr);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $content = curl_exec($curl);
        curl_close($curl);
        return $content;
    }

    /* 导出excel函数*/
    public function push($data,$name='局翼互动'){
        include JY_ROOT."PHPExcel/PHPExcel.php";
        date_default_timezone_set('Europe/London');
        $objPHPExcel = new \PHPExcel();
        /*以下是一些设置 ，什么作者  标题啊之类的*/
        $objPHPExcel->getProperties()->setCreator("转弯的阳光")
            ->setLastModifiedBy("转弯的阳光")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("备份数据")
            ->setKeywords("excel")
            ->setCategory("result file");
        /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
        foreach($data as $k => $v){
            $num=$k+1;
            $objPHPExcel->setActiveSheetIndex(0)
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                ->setCellValue('A'.$num, $v['uid'])
                ->setCellValue('B'.$num, $v['email'])
                ->setCellValue('C'.$num, $v['password']);
            }
        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }






    public function excelData($datas,$titlename,$title,$filename){
        $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
        $str .="<table border=1><head>".$titlename."</head>";


        foreach ($datas as $k=>$v){
          $str .=  " <tr class='text-c'>
                    <td>".$v['GroupChannel']."</td>
                    <td>".$v['name']."</td>
                    <td>".$v['t']."</td>
                    <td>".$v['RegNum']."</td>
                    <td>".$v['TotalMoney']."</td>
                    <td>".$v['RegArpu']."</td>
                    <td>".$v['ActiveArpu']."</td>
                    <td>".$v['UsersOneNum']."%</td>
                    <td>".$v['OrderTotalOld']."%</td>
                    <td>".$v['ActiveNum']."</td>
                    <td>".$v['PayConversion']."</td>
                    <td>".$v['UserPayNumOld']."</td>
                    <td>".$v['PayConversionOld']."%</td>
                    <td>".$v['Success']."</td>
                    <td>".$v['UsersTowNum']."%</td>
                    <td>".$v['UsersThreeNum']."%</td>
                    <td>".$v['UsersSevenNum']."%</td>
                    <td>".$v['UsersFifteenNum']."%</td>
                    <td>".$v['UsersThirtyNum']."%</td>
                </tr>
          ";
        }
        $str .= "</table></body></html>";
        header( "Content-Type: application/vnd.ms-excel; name='excel'" );
        header( "Content-type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=".$filename );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );
        exit( $str );
    }

}