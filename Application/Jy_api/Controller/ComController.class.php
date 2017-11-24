<?php
/***
 * 公共验证
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 * @param array   $ChannelModel 渠道模块列表
 ***/
namespace Jy_api\Controller;
use Think\Controller\RestController;
class ComController extends RestController{
    protected $allowMethod              = array('post');                        // REST允许的请求类型列表
    protected $allowType                = array('xml','json');                  // REST允许请求的资源类型列表
    protected $allowOutputType          = array('json'=>'application/json');    //REST允许输出的资源类型列表
    public    $msgArr;
    public    $DataInfo;
    public   $platform;
    public   $version;
    public   $channelid;
    public   $page;
    public   $num;
    public   $tagKey;

    public function __construct(){
        parent::__construct();
        $result  = 2001;
        //错误码
        $msgArr = array(
            '2001' =>   '请求成功。',
            '4001' =>    '请求参数不合法。',
            '4002' =>    '渠道号不存在。',
            '4003' =>    '平台号不存在。',
            '4004' =>    '版本号不存在。',
            '4005' =>    '回调标识不存在',
            '6001' =>    '请求方式不合法。',
            '6002' =>    '平台号不存在。',
            '6003' =>    '渠道不存在。',
            '0'    =>    '占位符',
            '1'    =>    '请求成功',
            '2'    =>    '重复创建',
            '3'    =>    '数据保存错误',
            '4'    =>    '参数错误',
            '5'    =>    '服务器逻辑错误',
            '6'    =>    '金币不足',
            '7'    =>    '没有玩家信息',
            '8'    =>    '重复登录',
            '9'    =>    '正在进行游戏',
            '10'   =>    '没有这个玩家',
            '11'   =>    '服务器满载',
            '12'   =>    '帐号被封',
            '13'   =>    '没有该帐号信息',
            '14'   =>    '钻石不足',
            '15'   =>    '没有游戏服',
            '16'   =>    '该帐号被另一台设备登录',
            '17'   =>    '创建次数达到最大',
            '18'   =>    '账号名不符合规则',
            '19'   =>    '密码不符合规则',
            '20'   =>    '操作不合法',
            '21'   =>    '账号密码不匹配',
            '22'   =>    '物品数量不足',
            '23'   =>    '没有该配置信息',
            '24'   =>    '炮倍率不合法',
            '25'   =>    '没有该id',
            '26'   =>    '物品未提取',
            '27'   =>    '购买失败',
        );

//        $StatusTime = 60;
//        $Status =  session('StatusTime');
//        file_put_contents('test.log',$Status,FILE_APPEND);
//        if(!isset($Status)){
//            session('StatusTime',time());
//            $Status = time();
//        }
//
//        if($Status+$StatusTime>time()){
//            $result = 7000;
//            goto end;
//        }
//
//        if($Status+$StatusTime<time()){
//           session('StatusTime',time());
//        }

        //设置超时时间
        ini_set("max_execution_time",10);
        set_time_limit(10);






        $tagKey = '/Jy_api/'.CONTROLLER_NAME.'/'.ACTION_NAME;

        //判断请求方式
        $RequestType =  $this->_method;
        $RequestTypeData =  array(
            'post',
        );
        if(!in_array($RequestType,$RequestTypeData)){
                $result  =  6001;
                goto end;
        }

        //请求数据
        $DataInfo = file_get_contents('php://input');
        //数据是否为空你
        if(empty($DataInfo)){
            $result  =  4001;
            goto end;
        }

        //写入日志

        $obj = new  \Common\Lib\func();
        if(C('ACCESS_lOGS')){
            $dir = C('YQ_ROOT').'Log/api/'.date('Y').'/'.date('m').'/'.date('d').'/';
            $obj->record_log($dir,'access_'.date('Ymd').'.log',$DataInfo);
        }
        $DataInfo = json_decode($DataInfo,true);

        //aes验证

        //过滤参数
        foreach ($DataInfo as $k=>$v){
            $DataInfo[$k] = $obj->safe_replace($v);
        }

        //token 验证
        //渠道
        if(empty($DataInfo['channel'])){
            $result  =  4002;
            goto end;
        }
        //平台号
        if(empty($DataInfo['platform'])){
            $result  =  4003;
            goto end;
        }
        //版本号
        if(empty($DataInfo['version'])){
            $result  =  4004;
            goto end;
        }
        //回调标识
        if(empty($DataInfo['sessionid'])){
            $result  =  4005;
            goto end;
        }
        //脚本版本号
        if(empty($DataInfo['PackageVersion'])){
            $result  =  4004;
            goto end;
        }
        //平台号映射
        $platform = array(
            'ios'       =>  1,
            'android'   =>  2,
        );
        $platform = $platform[$DataInfo['platform']];
        if(empty($platform)){
            $result  =  6002;
            goto end;
        }

        //渠道号信息验证
        $ChannelInfo = M('jy_admin_users as a')
                       ->join('jy_channel_info as b on a.id = b.adminUserID')
                       ->where('a.account = "'.$DataInfo['channel'].'" and  a.channel  = 2')
                       ->field('a.account,a.id,b.pattern,b.DividedInto,b.RegisterNum,b.RechargeNum')
                       ->find();

        if(empty($ChannelInfo)){
            $result  =  6003;
            goto end;
        }

        //渠道功能验证
        end:
        if($result != 2001){
            $end = array(
                     'result'    => $result,
                     'msg'       => $msgArr[$result],
                     'sessionid' => $DataInfo['sessionid'],
                     'data'      => array(),
            );

            $dataApiVisitLog = array(
                'Name'=>'',
                'Url'=>$tagKey,
                'Msg'=>$msgArr[$result],
                'Code'=>$result,
                'TimeOut'=>'',
                'AccessIP'=>$_SERVER['REMOTE_ADDR'],
            );
            $addApiVisitLog = M('jy_api_visit_log')
                ->add($dataApiVisitLog);
            $this->response($end,'json');
        }else{
            $this->channelid = $ChannelInfo['id'];
            $this->platform  = $platform;
            $this->version   = $DataInfo['version'];
            $this->DataInfo  = $DataInfo;
            $this->page      = isset($DataInfo['page'])? $DataInfo['page']: 1;
            $this->num       = isset($DataInfo['num']) ? $DataInfo['num']  : C('NUM');
            $this->msgArr    = $msgArr;
            $this->tagKey    = $tagKey;
        }



    }

}