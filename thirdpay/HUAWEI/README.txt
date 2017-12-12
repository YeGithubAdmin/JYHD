PHP支付demo包含3个文件：
1、productPublicFile.php：用于生成必要的pem文件，是安全验证所必须得,若更改公钥需重新运行此程序，会自动更换生成的pem文件
2、demo.php: 用于支付安全验证，利用上步生成的pem文件，来完成支付的验证
3、validSign：用于验证登录后获取的签名，请参考文件中的校验方式，仅供参考

环境：PHP5.0或以上(需要支持openssl模块)

步骤
1、将productPublicFile.php中的公钥替换为自己在开发者社区上取得的。
2、运行productPublicFile.php，将生成文件payPublicKey.pem。
3、将手机demo中回调url改为公网能访问到的链接（即http://ip:port/.../demo.php)
4、做一笔测试支付，若程序能够走到

	$result = "0";//支付成功处理业务

说明支付成功。

注：商户在支付成功处理业务时，对必要的信息（如发货的订单）要做好维护，以便于校验该订单的发货状态以保证不会发货重复。


注：PEM文件格式说明：
一、公钥
-----BEGIN PUBLIC KEY-----
##公钥信息，每64个字符加回车
-----END PUBLIC KEY-----

二、私钥
-----BEGIN RSA PRIVATE KEY-----
##公钥信息，每64个字符加回车
MIICXQIBAAKBgQDKYTFpXm8qwlDIsJAruhFrcDhRUTz0IxX5BTodz/Z5IAJKh5V4
m0IJjNXzjtghTO7Nh+1S9+N3q5PWyRm9sgL+GOjazBzck2PoEwtH80RPkiX362ay
iHiHivXE+o4sj1j1eycUk6RSqmSp6teGvZC9pH6a4DdGAssqxGgzkGUvfQIDAQAB
AoGAfORWFeyNNhoMuI0dq558OY1bc/NqZk9ws+ih4NwCAuXaBByABZnquvIK5u90
Obi8dmI390e7PJLJ/XbFR+efKA8gV6hF6Moxi2oiA66vz+LCu7Yd3+zApDiUgb5A
0qPmlpFQ/1uQT98mtvaaJk0qPWDoLP1MpBLfsBOZH/OQMAECQQDsBT+Mgv7E3H1f
FWkAItQ3MTk5WXed05HObDVEpS80I6IAtBbVBOf40wQ+9u1iVokxzeyPlrYWVmCk
gY2Pl4h9AkEA24LryL5yEu0P78E4pn5V5GvhWg7p4Rh1doAgxVAopanhAww3nsYI
IVxwSmrpKoKgVmYnvD9uE0WND0839mvzAQJBAOD7f8BpfoIZzEi/GABRMwoJmgrZ
BfUkoHCtJXnyHDUPYnZZNQqKSrYeMIX0zARZiR44ta+KcriITkeCV3bxc+ECQBoK
syxSo7fpFe3sr2rZLBl4TvjfMhH5U94mHz0pYFkfCUnSRjr45XgHvm6ltlnLu3fk
kKw9njJ9GtoJHOuILQECQQDLop/Qil+Nkd5i/MCgNoKewLa5ZX56p4FUm5zXn4e0
KdXZ0c8VTHzqoMR+MWcMPMAmDyQIiziL8/wMrOs26VCH
-----END RSA PRIVATE KEY-----


