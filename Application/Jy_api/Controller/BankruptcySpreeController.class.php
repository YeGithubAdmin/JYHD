<?php
/***
 * 破产礼包
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
class BankruptcySpreeController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $result = 2001;
        $info   =  array();
        $msgArr[2001] = "获取成功！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "物品不存在！";
        $msgArr[4008] = "物品不存在！";
        $playerid = $DataInfo['playerid'];

        $ComFun = D('ComFun');
        $LogLevel = 'INFO';

        $Status = 2;
        //物品概率
        $Rate =  array(
            array(
                'Code'=>17,
                'Rate'=>30,
            ),
            array(
                'Code'=>18,
                'Rate'=>50,
            ),
            array(
                'Code'=>19,
                'Rate'=>20,
            ),
        );
        //查询物品
        $catData = M('jy_goods_all')
            ->where('CateGory = 0 and  ShowType = 6  and  Type = 0  and IsDel = 1')
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
            $LogLevel = 'ERROR';
            goto  response;
        }
        $NewData = array();
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
                $NewData[$v['Code']]['Id']          = $v['Id'];
                $NewData[$v['Code']]['GiveInfo']    = $catGiveInfo;
                $NewData[$v['Code']]['Price']       = $v['Price'];
                $NewData[$v['Code']]['Name']        = $v['Name'];
                $NewData[$v['Code']]['IosCode']     = $v['IosCode'];
                $NewData[$v['Code']]['Code']        = $v['Code'];
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
        $random = 1;  //是否想随机 1 否 2 是
        $BagData = array();

        //是超过购买次数
        if($Num ==  2){
            $info['GoodsInfo'] = array();
            $Status = 1;
            goto  response;
        }elseif ($Num ==  1){
            //查询随机信息
            $BankruptcybagReta = M('log_bankruptcybag_reta')
                                ->where('playerid = '.$playerid.'  and  TO_DAYS(DateTime) = TO_DAYS(NOW())')
                                ->field(array(
                                       'Code',
                                       'GoodsID'
                                ))->select();
            $RetaNum = count($BankruptcybagReta);
            if($RetaNum >= 2){
                 //筛选物品
                 foreach ($BankruptcybagReta as $k=>$v) $BankruptcybagRetaSort[$v['Code']] = $v;
                 foreach ($BankruptcybagReta as $k=>$v){
                      foreach ($logUsersShop as $key=>$val){
                            if($val['Code'] != $v['Code'] && count($BankruptcybagRetaSort) == 2){
                                $BagData['Code']    = $v['Code'];
                            }else if($val['Code'] == $v['Code']  && count($BankruptcybagRetaSort) == 1){
                                $BagData['Code']    = $v['Code'];
                            }
                      }
                 }



            }else if ($Num == 1){
                $random = 2;
            }
        }elseif ($Num == 0){
            //查询随机信息
            $BankruptcybagReta = M('log_bankruptcybag_reta')
                ->where('playerid = '.$playerid.'  and  TO_DAYS(DateTime) = TO_DAYS(NOW())')
                ->field(array(
                    'Code',
                    'GoodsID'
                ))->select();


            $RetaNum = count($BankruptcybagReta);
            $BagData = array();
            if($RetaNum == 1){
                //筛选物品
                $BagData['Code']   = $BankruptcybagReta[0]['Code'];
            }else if ($RetaNum == 0){
                $random = 2;
            }
        }



        //是否随机
        if($random == 2){
            foreach ($Rate as $key => $value) {
                $proArr[$value['Code']] = $value['Rate'];
            }
            $GoodsCode= $ComFun->getRand($proArr);
            $BagData['Code'] = $GoodsCode;
            $RateInfo =  $NewData[$GoodsCode];
            if(empty($RateInfo)){
                $result = 4007;
                $LogLevel = 'ERROR';
                goto  response;
            }
            $BankruptcybagReta = array(
                'playerid'  =>  $playerid,
                'Code'      =>  $RateInfo['Code'],
                'GoodsID'   =>  $RateInfo['Id']
            );
            $addBankruptcybagReta = M('log_bankruptcybag_reta')->add($BankruptcybagReta);
            if(!$addBankruptcybagReta){
                $result = 3002;
                $LogLevel = 'CRITICAL';
                goto  response;
            }
        }
        if($NewData[$BagData['Code']]){
            $info['GoodsInfo'] = $NewData[$BagData['Code']];
        }else{
            $info['GoodsInfo'] = array();
        }
        response:

            $info['Status'] = $Status;
            $response = array(
                'result'    => $result,
                'msg'       => $msgArr[$result],
                'sessionid' => $DataInfo['sessionid'],
                'data'      => $info,
            );
        $ComFun->SeasLog($response,$LogLevel);
        $this->response($response,'json');
    }
}