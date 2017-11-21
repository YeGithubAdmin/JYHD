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
        $obj    = new \Common\Lib\func();
        $result = 2001;
        $info   =  array();
        $msgArr[2001] = "获取成功！";
        $msgArr[4006] = "用户信息缺失！";
        $msgArr[4007] = "物品不存在！";
        $msgArr[4008] = "物品不存在！";
        $playerid = $DataInfo['playerid'];
        //查询礼包
        $catData = M('jy_goods_all')
                   ->where('CateGory = 4 and    Code = 11 and IsDel = 1')
                   ->field(array(
                       'Id',
                       'CurrencyNum as Price',
                       'Name',
                       'GiveInfo',
                       'LimitShopNum',
                       'LimitShop',
                       'IosCode',
                   ))
                   ->find();
        if(empty($catData)){
            $result = 4007;
            goto  response;
        }

        $MoreThan = $playerid%10;

        $GiveInfo =  $catData['GiveInfo'];
        $catGiveInfo = array();
        if(!empty($GiveInfo)){
            $GiveInfo     = json_decode($GiveInfo,true);
            $GiveInfoSort = array();
            $GoodsID = array();
            foreach ($GiveInfo as $k=>$v){
                $GoodsID[] = $v['Id'];
                $GiveInfoSort[$v['Id']] = $v;
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
                foreach ($catGiveInfo as $k=>$v){
                    $SortVal =  $GiveInfoSort[$v['Id']];
                    if($SortVal){
                        $catGiveInfo[$k]['Number'] = $v['GetNum']*$SortVal['GetNum'];
                        $catGiveInfo[$k]['Name'] = $SortVal['Name'];
                        unset($catGiveInfo[$k]['GetNum']);
                    }else{
                       unset($catGiveInfo[$k]);
                    }
                }
            }
            $catData['GiveInfo'] = $catGiveInfo;
        }
        $Status = 2;
        if($catData['LimitShop'] > 1){
            //判断是否限购
            $where = ' playerid = '.$playerid.' and GoodsID = '.$catData['Id'];
            switch ($catData['LimitShop']) {
                //日限购
                case 2:
                    $where .= ' and  TO_DAYS(DateTime) = TO_DAYS(NOW())';
                    break;
                //周先限购
                case 3:
                    $where .= ' and  WEEKOFYEAR(DateTime)=WEEKOFYEAR(now())';
                    break;
                //月限购
                case 4:
                    $where .= ' and MONTH(DateTime)=MONTH(NOW()) and year(DateTime)=year(now())';
                    break;
            }
            $logUsersShop = array(
                'count(Id) as num'
            );
            $logUsersShop = M('log_users_shop_'.$MoreThan)
                ->where($where)
                ->field($logUsersShop)
                ->select();
            $num = $logUsersShop[0]['num'];
            if($catData['LimitShop'] == 5 && $num==1){
                $Status = 1;
            }
            if($catData['LimitShop'] < 5 && $catData['LimitShopNum'] ==  $num){
                $Status = 1;
            }
        }
        $catData['Status'] = $Status;
        unset($catData['LimitShopNum']);
        unset($catData['LimitShop']);
        $info = $catData;
         response:
            $response = array(
                'result'    => $result,
                'msg'       => $msgArr[$result],
                'sessionid' => $DataInfo['sessionid'],
                'data'      => $info,
            );
       $this->response($response,'json');
    }
}