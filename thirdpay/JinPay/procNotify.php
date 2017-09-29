<?php
/*
 * 充值后的回调处理，不需要手动运行。运行地址要注册到创建订单中，见createOrder.php。
*/

function rsa_verify($post_arr){
	ksort($post_arr);
	foreach($post_arr as $key => $value){
		if($key == 'sign') continue;
		$signature_str .= $key.'='.$value.'&';
	}
	$signature_str = substr($signature_str,0,-1);
	// 【NOTE】跑通demo后替换成商户自己的publickey
	$publickey= 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCYqyyVTZiOgM6fK8f4FoEN8IK8lWYDK0iTAkamGlXe00h1jsrSb23pVlBUr6y0WHoq2J2xC6Fh4ama8P22INyNXC0dvokcmBK9rWD6kmJMTZxWC9rMa1wFUGQDbQHVVUDM+zGXw4rMntcLVdu/fzCf6xL5HjyjQ1qTR1xuWePkzQIDAQAB';
	$pem = chunk_split($publickey,64,"\n");
	$pem = "-----BEGIN PUBLIC KEY-----\n".$pem."-----END PUBLIC KEY-----\n";
	$public_key_id = openssl_pkey_get_public($pem);
	$signature =base64_decode($post_arr['sign']);
	return openssl_verify($signature_str, $signature, $public_key_id);
}

/*
 充值回调信息
*/
$contents = $_POST;

if(!rsa_verify($contents)){
    die('error sign');
}

/*
 【NOTE】先查询到给过来的内部订单号对应的金立的订单号，然后是自己的发货流程
*/


echo "success"; // 需要返回success字符串
