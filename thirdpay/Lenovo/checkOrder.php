<?php
$exorderno = trim($_POST['exorderno']);
if (empty($exorderno)) {
    echo '{"error":3}';
} else {
    echo '{"error":1}';
    //echo '{"ok":200}'; //订单不存在！
}
?>