<?php
/***
 * 定时礼包
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;
class TimedBagController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();
        $msgArr[2001] = "获取成功！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "物品不存在！";
        $msgArr[4008] = "物品不存在！";
        $msgArr[7001] = "超过购买次数！";
        $playerid = $DataInfo['playerid'];
        $Status = 2;
        //查询物品
        $catData = M('jy_goods_all')
            ->where('CateGory = 0 and  ShowType = 7  and  Type = 0  and IsDel = 1')
            ->field(array(
                'Id',
                'CurrencyNum as Price',
                'Name',
                'GiveInfo',
                'Code',
                'IosCode',
            ))
            ->select();
        if(empty($catData)){
            $result = 4007;
            goto  response;
        }
        foreach ($catData as $k=>$v){
            $GiveInfo    =  $v['GiveInfo'];
            $catGiveInfo = array();
            if(!empty($GiveInfo)){
                $GiveInfo     = json_decode($GiveInfo,true);
                $GiveInfoSort = array();
                $GoodsID = array();
                foreach ($GiveInfo as $key=>$val){
                    $GoodsID[] = $val['Id'];
                    $GiveInfoSort[$val['Id']] = $val;
                }
                if(!empty($GoodsID)){
                    $GoodsID = implode(',',$GoodsID);
                }
                $catGiveInfo = M('jy_goods_all')
                    ->where('Id in ('.$GoodsID.') and IsDel = 1')
                    ->field(array(
                        'GetNum',
                        'ImgCode',
                        'Type',
                        'Id',
                    ))
                    ->select();
                if(!empty($catGiveInfo)){
                    foreach ($catGiveInfo as $key=>$val){
                        $SortVal =  $GiveInfoSort[$val['Id']];
                        if($SortVal){
                            $catGiveInfo[$key]['Number'] = $val['GetNum']*$SortVal['GetNum'];
                            $catGiveInfo[$key]['Name'] = $SortVal['Name'];
                            unset($catGiveInfo[$key]['GetNum']);
                        }else{
                            unset($catGiveInfo[$key]);
                        }
                    }
                }
                $catData[$k]['GiveInfo']          = $catGiveInfo;
            }
            $LimitShop[] = $v['Id'];
        }
        $MoreThan = $playerid%10;
        $LimitShop = implode(',',$LimitShop);
        $where = ' playerid = '.$playerid.' and GoodsID in ('.$LimitShop.') and  TO_DAYS(DateTime) = TO_DAYS(NOW())';
        $logUsersShop = M('log_users_shop_'.$MoreThan)
            ->where($where)
            ->field(
                array(
                    'GoodsID',
                    'Code'
                ))
            ->select();
        $Num = count($logUsersShop);

        //查询是点开过
        $LogTimedSend = M('log_timed_send')
                        ->where(' playerid = '.$playerid.' and   TO_DAYS(DateTime) = TO_DAYS(NOW())')
                        ->field(
                            array(
                                'playerid'
                            )
                        )
                        ->find();
        //是超过购买次数
        if($Num == 1 || !empty($LogTimedSend)){
            $Status = 1;
            $info['GoodsInfo'] = array();
            $result = 7002;
            goto response;
        }
         $info['GoodsInfo'] = $catData[0];
        response:

            $info['Status'] = $Status;
            $response = array(
                'result'    => $result,
                'msg'       => $msgArr[$result],
                'sessionid' => $DataInfo['sessionid'],
                'data'      => $info,
            );
       $this->response($response,'json');
    }
}