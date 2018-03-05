<?php
namespace Common\Model;

use Think\Model;
class AppliedTreasureModel extends Model{
    protected $autoCheckFields = false;
    public function pay_m($accout_type,$server_name,$pay_appkey,$params, $cookie =array()){
         $script_name = '/mpay/pay_m';
         $cookie["org_loc"] = urlencode($script_name);
         return $this->api_pay($script_name,$server_name,$pay_appkey,$accout_type,$params,'post','https');
    }

    public function makeSig($method, $url_path, $params, $secret){
        $mk = self::makeSource($method, $url_path, $params);
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

    public function api_pay($script_name,$server_name,$pay_appkey,$accout_type,$params,$method='post', $protocol='http'){
        // 添加一些参数
        $cookie=array();
        $cookie["org_loc"] = urlencode($script_name);
        if( $accout_type == "qq"){
            $cookie["session_id"] = "openid";
            $cookie["session_type"] = "kp_actoken";
        }else if( $accout_type == "wx" ){
            $cookie["session_id"] = "hy_gameid";
            $cookie["session_type"] = "wc_actoken";
        }else{
            return false;
        }
        // 生成签名
        $secret = $pay_appkey.'&';
        $script_sig_name="/v3/r".$script_name;
        $sig = $this->makeSig($method, $script_sig_name, $params, $secret);
        $params['sig'] = $sig;
        $url = $protocol . '://'. $server_name . $script_name;
        // 发起请求
        $ret = $this->makeRequest($url, $params, $cookie, $method, $protocol);
        if (false === $ret['result']){
            return false;
        }
        $result_array = json_decode($ret['msg'], true);
        // 远程返回的不是 json 格式, 说明返回包有问题
        if (is_null($result_array)) {
            return false;
        }
        return $ret;
    }

    public function makeRequest($url, $params, $cookie, $method='post', $protocol='http'){
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

    public function makeQueryString($params){
        if (is_string($params))
            return $params;
        $query_string = array();
        foreach ($params as $key => $value) {
            array_push($query_string, rawurlencode($key) . '=' . rawurlencode($value));
        }
        $query_string = join('&', $query_string);
        return $query_string;
    }
    public function makeCookieString($params){
        if (is_string($params))
            return $params;

        $cookie_string = array();
        foreach ($params as $key => $value){
            array_push($cookie_string, $key . '=' . $value);
        }
        $cookie_string = join('; ', $cookie_string);
        return $cookie_string;
    }
    /**
     * 执行API调用，返回结果数组
     *
     * @param string $script_name 调用的API方法，比如/auth/verify_login，
     *                             参考 http://wiki.dev.4g.qq.com/v2/ZH_CN/router/index.html#!qq.md#2.1 Oauth服务
     * @param array  $params 调用API时带的参数
     * @param string $method 请求方法 post
     * @param string $protocol 协议类型 http / https
     * @return array 结果数组
     */
    public function api_ysdk($script_name, $params,$server_name,$method='post', $protocol='http'){
        // add some params: 'version'
        $params['version'] = 'PHP YSDK v1.0.0';
        $url = $protocol . '://' . $server_name . $script_name;
        $cookie = array();
        // 发起请求
        $ret = $this->makeRequest($url, $params, $cookie, $method, $protocol);
        if (false === $ret['result']){
            return false;
        }else{
            $result_array = json_decode($ret['msg'], true);
            // 远程返回的不是 json 格式, 说明返回包有问题
            if (is_null($result_array)) {
               return false;
            }
        }
        return $ret;
    }
    /**
     *
     * 验证登录票据是否有效
     *
     * @param object $sdk YSDK Object
     * @param array $params
     *
     * @return array
     *
     *
     */
    public function qq_check_token($params,$server_name){
        $method = 'get';
        $script_name = '/auth/qq_check_token';
        return $this->api_ysdk($script_name, $params,$server_name,$method);
    }
    /**
     *
     * 验证授权凭证(access_token)是否有效
     *
     * @param object $sdk YSDK Object
     * @param array $params
     *
     * @return array
     *
     *
     */
    public function wx_check_token($params,$server_name){
        $method = 'get';
        $script_name = '/auth/wx_check_token';
        return $this->api_ysdk($script_name, $params,$server_name,$method);
    }

    /***
     *  应用宝下单
     *
     */
    public function  ATPlaceAnOrder($params,$server_name,$accout_type,$pay_appkey){
        $script_name = '/mpay/buy_goods_m';
        $cookie["org_loc"] = urlencode($script_name);
        return $this->api_pay($script_name,$server_name,$pay_appkey,$accout_type,$params,'post','https');
    }
}
