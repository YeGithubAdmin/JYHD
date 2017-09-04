<?php
header("Content-type: text/html; charset=utf-8");

require_once ("base.php");
$respData="transdata={\"transid\":\"32441611021004347926\"}&sign=DxJ5Cw/GTLzT4oEOtzm2bE0Hjb1HPRmXT+OVJj5TRBqC+Zrwdgt7yCW8cbd2IsERqSTlVqQqAx5Bc/ztO6hQVBWZTl7tPZ4jQKs3JOT7r8mcJL6FNCcfItDNZWprcmrTjDZcwsW9+pX+TkP07ouolOg+/sLDC4OE7vu2BURb2mg=&signtype=RSA";
$platpkey="MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCWAsHq1iezR1zZzGlmXTX0o88hpuOMWUnCO2iEBHSHVB+WuizLmps89Kz90XFHzqZoYtJ0U1aFSYlcboQZQfp/CelToDCrbXyAu43yVpvKIAkZVEpTPvc61HmhyHT4AnbPZ3H6DmS8ljAb8F/jtihZCdvi4JWWY8eOeRuvz5hwAQIDAQAB";
if(!parseResp($respData, $platpkey, $respJson)) {
        echo "failed";
    }else{
    	echo "success";
    	echo "服务端下单完成，trasnid:<br/>";
    	print_r($respJson);
    	//     下单成功之后获取 transid
    	$transid=$respJson->transid;
    }
?>