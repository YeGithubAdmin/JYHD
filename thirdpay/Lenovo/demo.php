<?php
/**
 * ���ܣ�����֧��ƽ̨ǩ��ʹ�÷���ʾ��
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�����֧��ƽ̨�ӿ�ʹ�ã�ֻ���ṩһ���ο���
 * @date		2014/10/30
 */

require_once("lib/lenovo_cashier_rsa.inc.php");

$priKey = '-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAJGJxco40lHD0OQBsEBNQvrkN6o+
K4EqiZndCUXmHb5pA8UmGz7HZODA+7SGUT682Elm6ojckUHXPyPJl7vb+cxfWToN9lVVvJMcjmVU
/IdJ4f2i8PZLmTdfkBTDVOuIx39UOWbyK8dA9aOTzf1fqciIh+LYS+MBm3aHmfmtOgGbAgMBAAEC
gYA98JjRO+WnDuO0ZlOQylEbXk2iktsJGgV+CmiL6yf1hdQo79LgoRP546g8aH3jaZPTiY1/uf/I
OceRf5aoSTLCd9MCg3xDOWLV1G1nLFYDRfem1nIxosn2KXbMoimjVyI8uaj+qDn2CVI3B7PSlVRs
57og9knUYMlGRcomjodGAQJBAMj2o5GyipuRp7PSIGOJrc59Ah8JU397glXE0zOWxYZuzuah6P1U
r0OXPLMm69T6VQ7Z8W6hr7/09ZRhaW28DsECQQC5ZVHh7zeHjuV356rz5cPSTdiLkYGi7X6GUNXo
+Ke+9qqqQzuRamcAtRP/piE1JzBAmXzO7jR7De7XPeI41INbAkEApYDh4rrMhiRlnaVewTsA5f5z
wcW3e1TnWOV5HpJ76CPXx37uV7vnf13NQqm6LTNg25NHz1nfWNJPcbzry9DFwQJAVsXXZ1ohsW7u
dAqYdwNpffs1iU2XUXy7JX6cQChxyu2Ev6AsN0mH4Ergi11kWY54BSRRyECxi47f5Rpv0Y2V1QJA
MJjszD+sekJkJfuLU+HMkjpiuRIqFpJQZojYV0mnA36U2zSkcZooks8Hvs0oLLexdSRFXd2AQrsL
idBIjCsmug==
-----END PRIVATE KEY-----';

$data ='123456';

$sign = 'Cm0nsl5cQIjB839jgvMYSEGnc8VS0BmgFdAbaTUP0TkaYVkRmBgq/3elUpoJhrnfm4PQTF0kVJGxTcHyXfF1iT8hXo5v+yA2WqWcsTxWRoqkBklx4WwPX7CaR3/ZnrPcyCMcjXN0UHte1tzjEF+UnLHQdHe5Atsy3mDOWFVBS/M=';//sign($data, $priKey);
echo "data:".$data;
echo "<br>sign:".$sign;
echo "<br><br>";

$result = verify($data, $priKey, $sign);
echo "<br>verify result:".$result;
echo "<br><br>";

?>