<?php
date_default_timezone_set('Asia/Shanghai');
$date = date('YmdHis');
$appid = trim($_POST['appid']) === '' ? trim($_GET['appid']) : trim($_POST['appid']);
$lpsust = trim($_POST['lpsust']) === '' ? trim($_GET['lpsust']) : trim($_POST['lpsust']);
$waresid = intval($_POST['waresid']) === '' ? trim($_GET['waresid']) : trim($_POST['waresid']);
$money = intval($_POST['money']) === '' ? trim($_GET['money']) : trim($_POST['money']);
$authUrl = 'https://passport.lenovo.com/interserver/authen/1.2/getaccountid?';
if (empty($appid)) {
    echo '{"error":"3"}';
    return false;
}
if (empty($lpsust)) {
    echo '{"error":"3"}';
    return false;
}
if (empty($waresid)) {
    echo '{"error":"3"}';
    return false;
}
if (empty($money)) {
    echo '{"error":"3"}';
    return false;
}
$url = $authUrl . 'lpsust=' . $lpsust . '&realm=' . $appid;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	// 要求结果为字符串且输出到屏幕上
curl_setopt($ch, CURLOPT_HEADER, 0); // 不要http header 加快效率
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);	// https请求 不验证证书和hosts
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
$output = curl_exec($ch);
curl_close($ch);
//var_dump($output);
$orderId = intval($date. microtime() * 1000);
echo '{"orderId": "' . $orderId . '"}';
 ?>