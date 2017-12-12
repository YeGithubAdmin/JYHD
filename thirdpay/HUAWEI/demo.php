<?php
header("Content-Type: application/json; charset=utf-8");
$oriContent = file_get_contents('php://input');
if (null === $oriContent || "" === $oriContent)
{
    echo "{\"result\":1}";
    return;
}

$elements = split('&', $oriContent);
$valueMap = array();
foreach ($elements as $element)
{
    $single = split('=', $element);
    $valueMap[$single[0]] = $single[1];
}

if(null !== $valueMap["sign"])
{
    $valueMap["sign"] = urldecode($valueMap["sign"]);
}
if(null !== $valueMap["extReserved"])
{
    $valueMap["extReserved"]= urldecode($valueMap["extReserved"]);
}
if(null !== $valueMap["sysReserved"])
{
    $valueMap["sysReserved"] = urldecode($valueMap["sysReserved"]);
}

ksort($valueMap);
$sign = $valueMap["sign"];

if(empty($sign))
{
    echo "{\"result\":1}";
    return;
}

$content = "";
$i = 0;
foreach($valueMap as $key=>$value)
{
    if($key != "sign" )
    {
       $content .= ($i == 0 ? '' : '&').$key.'='.$value;
    }
    $i++;
}
$filename = dirname(__FILE__)."/payPublicKey.pem";

if(!file_exists($filename))
{
    echo "{\"result\" : 1 }";
    return;
}
$pubKey = @file_get_contents($filename);
$openssl_public_key = @openssl_get_publickey($pubKey);

$ok = @openssl_verify($content,base64_decode($sign), $openssl_public_key);
@openssl_free_key($openssl_public_key);

$result = "";

if($ok)
{
    $result = "0";//支付成功处理业务
}
else
{
    $result = "1";
}
$res = "{ \"result\": $result} ";
echo $res;
?>