PHP֧��demo����3���ļ���
1��productPublicFile.php���������ɱ�Ҫ��pem�ļ����ǰ�ȫ��֤�������,�����Ĺ�Կ���������д˳��򣬻��Զ��������ɵ�pem�ļ�
2��demo.php: ����֧����ȫ��֤�������ϲ����ɵ�pem�ļ��������֧������֤
3��validSign��������֤��¼���ȡ��ǩ������ο��ļ��е�У�鷽ʽ�������ο�

������PHP5.0������(��Ҫ֧��opensslģ��)

����
1����productPublicFile.php�еĹ�Կ�滻Ϊ�Լ��ڿ�����������ȡ�õġ�
2������productPublicFile.php���������ļ�payPublicKey.pem��
3�����ֻ�demo�лص�url��Ϊ�����ܷ��ʵ������ӣ���http://ip:port/.../demo.php)
4����һ�ʲ���֧�����������ܹ��ߵ�

	$result = "0";//֧���ɹ�����ҵ��

˵��֧���ɹ���

ע���̻���֧���ɹ�����ҵ��ʱ���Ա�Ҫ����Ϣ���緢���Ķ�����Ҫ����ά�����Ա���У��ö����ķ���״̬�Ա�֤���ᷢ���ظ���


ע��PEM�ļ���ʽ˵����
һ����Կ
-----BEGIN PUBLIC KEY-----
##��Կ��Ϣ��ÿ64���ַ��ӻس�
-----END PUBLIC KEY-----

����˽Կ
-----BEGIN RSA PRIVATE KEY-----
##��Կ��Ϣ��ÿ64���ַ��ӻس�
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


