<?php
/**
 * 功能：联想支付平台签名使用方法示例
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究联想支付平台接口使用，只是提供一个参考。
 * @date		2014/10/30
 */

require_once("lib/lenovo_cashier_rsa.inc.php");

$priKey = 'MIICXAIBAAKBgQC8rPqGGsar+BWI7vAtaaDOqphy41j5186hCU9DcchV4HWiv0HvQ3KXAEqHfZiAHZSyMSRMmDZVnqJwCVWFvKUPqU1RsCPZ9Imk+9ZXVkM3DDdw74v/s6YMNx8cTuxybRCJUfOKbyC79cnHgmQqqkODv+EnprBtNKE4k8g90jNmbwIDAQABAoGAS06Hl+ssDQuyHLux5Y5ZfuOcgY64vtAiSyhaGMNbgNtcWJ8aBBPZsueM19OLgOdNqGnw4RmH5liw4SL4na6T+qGpblEW/4G1eQXXJvfIBhlYJupaSvhuTf3msFw4z9GY8V29deGPx5/6FRVTPTqnLoxUlfloOCYCeDJrXa9+YGECQQD24cdN9MT3HqfP3S+UEDHO3XaDq38V3sCnKQ5mSYtnst/NV/g4bqYUOYElQW27p0YgwhHLlxWPke8a4Jz/r4lnAkEAw6TfA36kUZfnFIXNM/0250jyZDE/yEKBXhThO8DAXAyAaEHjxA7K+eprXP7ayFIfy+nrz/W5Iy81ibP5G/4tuQJBALaDn9ZP+DVBIoqXWI87kbb/Hpik9mTysrZhsdWI1Viqcq3aNRVzJ7CX+pPSVQ9/0GZzUriST0w+dOgH2clkuk0CQDXXhdh8XdRmrZ2kRRjtstJr7OlN9HO0ec3eiS3cmhO7DQukNn6aY5nrvahWKve+QinoMpGE2nKoZ1+CPChMB2ECQG8utIhzAGH0lKbv/3+SzDERStrFYn/WqpWG3qSXAMyes24khuRPtMYPzIxI/wZYPazbKgxuERAhiRtpz0e9jvI=';

$transdata = trim($_POST['transdata']);
$sign =  trim($_POST['sign']);

if (empty($transdata)) {
	echo '{"error":"3"}';
	return false;
}

if (empty($sign)) {
	echo '{"error":"3"}';
	return false;
}

$sign_local = sign($transdata, $priKey);
$result = verify($transdata, $priKey, $sign_local);
if ($result) {
    echo 'SUCCESS';
} else {
    echo 'FAILTURE';
}