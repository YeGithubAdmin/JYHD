<?php
namespace Common\Model;

use Think\Model;
class ComFunModel extends Model{
    protected $autoCheckFields = false;
    /***
    * rsa  私钥加签
    **/
    public  function SignPrivate($param,$private,$type = ''){
        $res = openssl_pkey_get_private($private);
        // $data=sha1($data); //sha1加密（如果需要的话，如果进行加密，则对方也要进行加密后做对比）
        if($type != ''){
            openssl_sign($param, $Sign, $res,$type);
        }else{
            openssl_sign($param, $Sign, $res);
        }
        openssl_sign($param, $Sign, $res);
        openssl_free_key($res);
        //base64编码
        $Sign = base64_encode($Sign);
        return $Sign;
    }
    /***
     * rsa  公钥加签
     **/
    public function SignPublic($param,$public,$type =''){
        $res = openssl_pkey_get_public($public);
        // $data=sha1($data); //sha1加密（如果需要的话，如果进行加密，则对方也要进行加密后做对比）
        if($type !=''){
            openssl_sign($param, $Sign, $res,$type);
        }else{
            openssl_sign($param, $Sign, $res);
        }
        openssl_free_key($res);
        //base64编码
        $Sign = base64_encode($Sign);
        return $Sign;
    }
    /***
    * rsa  私钥验签
    **/
    public function Everification($valueMap,$sign,$private,$type =''){
        $openssl_private_key = @openssl_pkey_get_private($private);
        if($type != '') {
            $res = openssl_verify($valueMap, base64_decode($sign), $openssl_private_key,$type);
        }else{
            $res = openssl_verify($valueMap, base64_decode($sign), $openssl_private_key);
        }
        @openssl_free_key($openssl_private_key);
        return $res;
    }
    /***
     * rsa  公钥验签
     **/
    public function PayVerification($valueMap,$sign,$public,$type =''){
        $openssl_public_key = @openssl_pkey_get_public($public);

        if($type != '') {
            $res = openssl_verify($valueMap,base64_decode($sign), $openssl_public_key,$type);
        }else{
            $res = openssl_verify($valueMap,base64_decode($sign), $openssl_public_key);
        }
        @openssl_free_key($openssl_public_key);
        return $res;
    }
    /***
    * url参数转数组
    * @param $param string  url参数
    */
    public function UrlToArry($param,$IsUrl=array()){
        $elements = split('&', $param);
        $valueMap = array();
        foreach ($elements as $element) {
            $single = split('=', $element);

            if (in_array($single[1],$IsUrl)){
                $single[1]  = urldecode($single[1]);
            }
            $valueMap[$single[0]] = $single[1];
        }

        return $valueMap;
    }

    /***
    * 拼装
    * @param $array array  参数
    * @param $unset array  过滤参数
    * @param $IsUrl array  urlencode
    */
    public function MosaicUrl($array,$unset=array(),$IsUrl=array()){
          $MosaicUrl = '';
          ksort($array);
          foreach ($array as $k=>$v){
              if(!in_array($v,$unset)){
                  if(in_array($v,$IsUrl)){
                      $Value = urlencode($v);
                  }else{
                      $Value =$v;
                  }
                  $MosaicUrl.=$k."=".$Value."&";
              }

          }
          return substr($MosaicUrl,0,-1);
    }


    /***
    * curl
    * @param  $url      string  地址
    * @param  $content  unknow  内容
    * @param  $header   unknow  头信息
    * @param  $timeOut  int     请求超时间
    */
    public function Tocurl($url,$content='',$header ='',$timeOut = 5){
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

    public function exportExcel($expTitle,$expCellName,$expTableData,$setWidth = 20){
        include JY_ROOT."PHPExcel/PHPExcel.php";
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA');
        //实例对象
        $PHPExcel = new \PHPExcel();
        //创建工作区
        $PHPExcel->createSheet(0);
        // 设置当前激活的工作表编号
        $PHPExcel->setActiveSheetIndex(0);
        // 获取当前激活的工作表
        $Sheet = $PHPExcel->getActiveSheet();
        //居中
        $PHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPExcel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //设置背景样色
        $PHPExcel-> getActiveSheet()->getStyle( 'A1:T1')-> getFill() -> setFillType(\PHPExcel_Style_Fill :: FILL_SOLID);
        $PHPExcel-> getActiveSheet() -> getStyle('A1:T1') -> getFill() -> getStartColor() -> setARGB('#abd4e8');
        foreach ($cellName as $k=>$v){
            $Sheet->getColumnDimension($v)->setWidth(20);
            $Sheet->setCellValue($v.'1',$expCellName[$k]);
        }
        foreach ($expTableData as $k=>$v){
            $i = $k+2;
            $j = 0;
            foreach ($v as $key=>$val){
                $Sheet->setCellValue($cellName[$j].$i,$val);
                $j++;
            }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$expTitle.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

     public function getRand($proArr) {
         $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }


    /***
     * proto 请求
     * @param  string  $url    地址
     * @param  array  $header  头信息
     * @param  string  $content   proto 体
     * @param  int  $timeOut   请求超时
     **/
    public function Prototocurl($url, $header, $content,$timeOut = 5){
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

    /***
     * protobuf发送请求
     * @param $PBName    string       包名
     * @param $content   protobuf     包体
     */
    public function   ProtobufSend($Header,$content,$Server=''){
        $TheBagBody = array(
            'body'=>$content
        );
        if(empty($Server)){
            $Server = SERVER_PROTO;
        }
        $Respond = $this->Prototocurl($Server,$Header,$TheBagBody);
        if($Respond  == 504){
            return  504;
        }
        return $Respond;
    }

    /**
     * 获取当前页面完整URL地址
     * return string URL
     */
    public function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $this->safe_replace($_SERVER['PHP_SELF']) : $this->safe_replace($_SERVER['SCRIPT_NAME']);
        $path_info = isset($_SERVER['PATH_INFO']) ? $this->safe_replace($_SERVER['PATH_INFO']) : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $this->safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$this->safe_replace($_SERVER['QUERY_STRING']) : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }

    /**
    * 日志
    * @param $level  日志等级
    * @parm
    */
    public function  SeasLog($info,$level ="INFO",$default=''){
        if($default != ''){
             \SeasLog::setLogger($default);
        }
        $InfoJson    = json_encode($info);
        $InfoExport =  var_export($info,true);
        $data = "\nTime:".date('Y-m-d H:i:s')
            ."\nIP:".$_SERVER['REMOTE_ADDR']
            ."\nUrl:" .$this->get_url()
            ."\n".$InfoJson
            ."\n".$InfoExport
            ."\n--------------------------------------------------------------------------------------------------------";
        \SeasLog::log($level,$data);
    }

    /**
    * 应用宝登录验证
    * @param $data   array  请求数据
    */
    public function ATCheckCoken($data,$server_name,$script_name){
        if(empty($data)){
            return false;
        }
        $data['version'] = 'PHP YSDK v1.0.0';
        $url =    $server_name.$script_name.'?'.$this->MosaicUrl($data);
        $makeRequest = $this->Tocurl($url);
        if($makeRequest == 504){
            return false;
        }
        return  json_decode($makeRequest,true);
    }

    /***
    *  应用宝下单
    *
    */
    public function  ATPlaceAnOrder($data,$server_name,$script_name,$accout_type,$pay_appkey,$method){
        $cookie["org_loc"] = urlencode($script_name);



        if( $accout_type == 1) {
            $cookie["session_id"] = "openid";
            $cookie["session_type"] = "kp_actoken";
        }else if( $accout_type == "wx" ){
            $cookie["session_id"] = "hy_gameid";
            $cookie["session_type"] = "wc_actoken";
        }
        $secret = $pay_appkey.'&';
        $script_sig_name="/v3/r".$script_name;
        $data['sign'] = $this->ATmakeSign($method, $script_sig_name, $data, $secret);;
        $url = $server_name . $script_name;
        // 发起请求
        $ret = $this->makeRequest($url, $data, $cookie, $method, 'https');
        if (false === $ret['result']){
           return false;
        }else{
            $result_array = json_decode($ret['msg'], true);
            // 远程返回的不是 json 格式, 说明返回包有问题
            if (is_null($result_array)) {
               return false;
            }
        }
        return json_decode($ret, true);
    }


    public function makeRequest($url, $params, $cookie, $method='post', $protocol='http')
    {
        $query_string = $this->makeQueryString($params);
        $cookie_string = $this->makeCookieString($cookie);
        $ch = curl_init();
        if ('get' == $method){
            curl_setopt($ch, CURLOPT_URL, "$url?$query_string");
        }
        else{
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
        }
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        // disable 100-continue
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        if (!empty($cookie_string)){
            curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        }
        if ('https' == $protocol){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        $ret = curl_exec($ch);
        $err = curl_error($ch);
        if (false === $ret || !empty($err)){
            $errno = curl_errno($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);

            return array(
                'result' => false,
                'errno' => $errno,
                'msg' => $err,
                'info' => $info,
            );
        }
        curl_close($ch);
        return array(
            'result' => true,
            'msg' => $ret,
        );
    }

    private function makeQueryString($params){
        if (is_string($params))
            return $params;
        $query_string = array();
        foreach ($params as $key => $value){
            array_push($query_string, rawurlencode($key) . '=' . rawurlencode($value));
        }
        $query_string = join('&', $query_string);
        return $query_string;
    }
    private function makeCookieString($params){
        if (is_string($params))
            return $params;
        $cookie_string = array();
        foreach ($params as $key => $value){
            array_push($cookie_string, $key . '=' . $value);
        }
        $cookie_string = join('; ', $cookie_string);
        return $cookie_string;
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
    /**
     * 生成签名
     *
     * @param string 	$method 请求方法 "get" or "post"
     * @param string 	$url_path
     * @param array 	$params 表单参数
     * @param string 	$secret 密钥
     */
    public  function  ATmakeSign($method, $url_path, $params, $secret){
        $mk = $this->makeSource($method, $url_path, $params);
        $my_sign = hash_hmac("sha1", $mk, strtr($secret, '-_', '+/'), true);
        $my_sign = base64_encode($my_sign);
        return $my_sign;
    }
    private function makeSource($method, $url_path, $params){
        $strs = strtoupper($method) . '&' . rawurlencode($url_path) . '&';
        ksort($params);
        $query_string = array();
        foreach ($params as $key => $val ){
            array_push($query_string, $key . '=' . $val);
        }
        $query_string = join('&', $query_string);
        return $strs . str_replace('~', '%7E', rawurlencode($query_string));
    }
    /**
     * 验证回调发货URL的签名 (注意和普通的OpenAPI签名算法不一样，详见@refer的说明)
     * @param string 	$method 请求方法 "get" or "post"
     * @param string 	$url_path
     * @param array 	$params 腾讯调用发货回调URL携带的请求参数
     * @param string 	$secret 密钥
     * @param string 	$sig 腾讯调用发货回调URL时传递的签名
     *
     * @refer
     *  http://wiki.open.qq.com/wiki/%E5%9B%9E%E8%B0%83%E5%8F%91%E8%B4%A7URL%E7%9A%84%E5%8D%8F%E8%AE%AE%E8%AF%B4%E6%98%8E_V3
     */
    public function ATverifySig($method, $url_path, $params, $secret, $sig){
        unset($params['sig']);
        // 先使用专用的编码规则对value编码
        foreach ($params as $k => $v) {
            $params[$k] = $this->encodeValue($v);
        }
        // 再计算签名
        $sig_new = $this->ATmakeSign($method, $url_path, $params, $secret);
        return $sig_new == $sig;
    }
    /**
     * 回调发货URL专用的编码算法
     *  编码规则为：除了 0~9 a~z A~Z !*()之外其他字符按其ASCII码的十六进制加%进行表示，例如"-"编码为"%2D"
     * @refer
     *  http://wiki.open.qq.com/wiki/%E5%9B%9E%E8%B0%83%E5%8F%91%E8%B4%A7URL%E7%9A%84%E5%8D%8F%E8%AE%AE%E8%AF%B4%E6%98%8E_V3
     */
    private function encodeValue($value){
        $rst = '';
        $len = strlen($value);
        for ($i=0; $i<$len; $i++){
            $c = $value[$i];
            if (preg_match ("/[a-zA-Z0-9!\(\)*]{1,1}/", $c)) {
                $rst .= $c;
            }else{
                $rst .= ("%" . sprintf("%02X", ord($c)));
            }
        }
        return $rst;
    }

}
