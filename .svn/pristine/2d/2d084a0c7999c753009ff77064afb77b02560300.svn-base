<?php
header("Content-type: text/html; charset=utf-8");
/**
 *功能：配置文件
 *版本：1.0
 *修改日期：2014-06-26
 '说明：
 '以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己的需要，按照技术文档编写,并非一定要使用该代码。
 '该代码仅供学习和研究爱贝云计费接口使用，只是提供一个参考。
 */
 
//爱贝商户后台接入url
// $coolyunCpUrl="http://pay.coolyun.com:6988";
$iapppayCpUrl="http://ipay.iapppay.com:9999";
//登录令牌认证接口 url
$tokenCheckUrl=$iapppayCpUrl . "/openid/openidcheck";

//下单接口 url
// $orderUrl=$coolyunCpUrl . "/payapi/order";
$orderUrl=$iapppayCpUrl . "/payapi/order";

//支付结果查询接口 url
$queryResultUrl=$iapppayCpUrl ."/payapi/queryresult";

//契约查询接口url
$querysubsUrl=$iapppayCpUrl."/payapi/subsquery";

//契约鉴权接口Url
$ContractAuthenticationUrl=$iapppayCpUrl."/payapi/subsauth";

//取消契约接口Url
$subcancel=$iapppayCpUrl."/payapi/subcancel";
//H5和PC跳转版支付接口Url
$h5url="https://web.iapppay.com/h5/gateway?";
$pcurl="https://web.iapppay.com/pc/gateway?";

//应用编号
$appid="3015007654"; //3015007654
//应用私钥  //MIICXAIBAAKBgQCR/ZyLQ7Z2pCv8sZcNuqDcgEoEhPQPOT9Ci8l43mIBhjbSCIPuDPiiZJJ9HjaMpy+X1cUZP1SY9TtZDzA3R5pAWd1HY+Ps/Q8aDiRou2mNESlWor5/xmG8TcQcWLshS3VzHWz4cY7i8o+EIACfHbDTSTkqTxCIyjw1BYxGTyqLVwIDAQABAoGAGDGseNPu8DiC5azUuLy+HezQ13DlNYSqPDAIYpSQL2p7uVEZ9CCIL/l04XFZXvPyCjquIGIDdhnmDPtcZTzjjhfltp6N3Uqmtp4D2cPWruR6B2icvve2bno2Lu6OULuAYyEkVMHCdEf5GSSHjShIG6CBahHfHZhWzjoPYZWAZ9ECQQDd/NGvmzcLVHOXM4muml6leF9OmQNqA+qVec9Sqb39t2CNJY4QxdJ/AzQnLeskqVBydQm60P2lbi3M1eCMW+sPAkEAqFvpB1vgkj6dlbySyHGu5mzTiJBRSVvz4c5XAA01iLCNPGdtQGT7jslnkyueXMwdiq3pBDpGuzL9v9QIuw17OQJADv+h+0d1dKKEHNcymkV715pGdj0IagVRuD++rkshtx7Iu0CqVJ/JFSPWRj9n/9YgxVr7CVBNkvvaxFg/D7y2KQJARCqKjG832x69IU5rw/q7jRKNB2MfdmtjsI6iDSRMA58wYD+kLYl1jReg9yaXBQ2j/G1zxkFuOAdqVEweiNXpiQJBAJjblicX+Y7y0EwKfOXP9oU2KjbxGAy5Et5AL+6AdloVbjZAU1o3LYfjuCz+YaU3jPx38FIT1Npe/WWIuTyusZ8=
$appkey="MIICXAIBAAKBgQCR/ZyLQ7Z2pCv8sZcNuqDcgEoEhPQPOT9Ci8l43mIBhjbSCIPuDPiiZJJ9HjaMpy+X1cUZP1SY9TtZDzA3R5pAWd1HY+Ps/Q8aDiRou2mNESlWor5/xmG8TcQcWLshS3VzHWz4cY7i8o+EIACfHbDTSTkqTxCIyjw1BYxGTyqLVwIDAQABAoGAGDGseNPu8DiC5azUuLy+HezQ13DlNYSqPDAIYpSQL2p7uVEZ9CCIL/l04XFZXvPyCjquIGIDdhnmDPtcZTzjjhfltp6N3Uqmtp4D2cPWruR6B2icvve2bno2Lu6OULuAYyEkVMHCdEf5GSSHjShIG6CBahHfHZhWzjoPYZWAZ9ECQQDd/NGvmzcLVHOXM4muml6leF9OmQNqA+qVec9Sqb39t2CNJY4QxdJ/AzQnLeskqVBydQm60P2lbi3M1eCMW+sPAkEAqFvpB1vgkj6dlbySyHGu5mzTiJBRSVvz4c5XAA01iLCNPGdtQGT7jslnkyueXMwdiq3pBDpGuzL9v9QIuw17OQJADv+h+0d1dKKEHNcymkV715pGdj0IagVRuD++rkshtx7Iu0CqVJ/JFSPWRj9n/9YgxVr7CVBNkvvaxFg/D7y2KQJARCqKjG832x69IU5rw/q7jRKNB2MfdmtjsI6iDSRMA58wYD+kLYl1jReg9yaXBQ2j/G1zxkFuOAdqVEweiNXpiQJBAJjblicX+Y7y0EwKfOXP9oU2KjbxGAy5Et5AL+6AdloVbjZAU1o3LYfjuCz+YaU3jPx38FIT1Npe/WWIuTyusZ8=";
//平台公钥  MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtv7IzXBGp486UAFwaLIXsSua8JiTSe5kSKU6IXNiJxZIMZ/2dlKOV66hFIQjP/0u8YV9Du+uk8/3nmTMhdBpanzp9awkXnO2g104ng9x34YxoDMMv24MmOhT7c2mnhCuEyFbz/KkvnhzQn6L+MAwYvkkQInpw/ArHDJ0NkbyJNQIDAQAB
$platpkey="MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDtv7IzXBGp486UAFwaLIXsSua8JiTSe5kSKU6IXNiJxZIMZ/2dlKOV66hFIQjP/0u8YV9Du+uk8/3nmTMhdBpanzp9awkXnO2g104ng9x34YxoDMMv24MmOhT7c2mnhCuEyFbz/KkvnhzQn6L+MAwYvkkQInpw/ArHDJ0NkbyJNQIDAQAB";
?>