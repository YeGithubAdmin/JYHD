<?php
header("Content-Type: application/json; charset=utf-8");

// 使用从客户端上传过来的参数
$content = 'appId'.'ts'.'playerId';

// 使用从客户端上传过来的参数
$sign = 'sign';

// .pem文件是一致的，请使用同目录下带的payPu
$filename = dirname(__FILE__)."/payPublicKey.pem";

if(!file_exists($filename))
{
    echo "{\"result1\" : 1 }";// failure
    return;
}
$pubKey = @file_get_contents($filename);
$openssl_public_key = @openssl_get_publickey($pubKey);

$ok = @openssl_verify($content, base64_decode($sign), $openssl_public_key, OPENSSL_ALGO_SHA256);
@openssl_free_key($openssl_public_key);

$result = "";

if($ok)
{
    $result = "0";// success
}
else
{
    $result = "1";// failure
}
$res = "{ \"result\": $result} ";
echo $res;
?>