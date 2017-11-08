<?php
/***
 * 新手礼包
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
class NewTheFirstPunchController extends ComController {
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
       // 查询购状态   6元 Code:12  12元 Code:13
        if(!$playerid){
            $result = 4006;
            goto response;
        }
        $MoreThan =  $playerid%10;
        //查询物品信息
        $catGoods = M('conf_novice_pack as a')
            ->join('jy_goods_all as b on  a.`GoodsID` = b.`Id` and `IsDel` = 1')
            ->field(array(
                'b.Id',
                'b.Name',
                'a.Title',
                'a.DescribeBomb',
                'a.DescribeGold',
                'a.Bomb',
                'b.GiveInfo',
                'b.LimitShop',
                'b.LimitShopNum',
                'b.OriginalPrice',
                'b.CurrencyNum as `Price`',
            ))
            ->order('`Price` asc')
            ->select();
         if(empty($catGoods)){
            $result = 4007;
            goto  response;
         }
         $logUsersShopField = array(
             'count(Id) as num'
         );
        $logUsersShopDb = M('log_users_shop_'.$MoreThan);
         foreach($catGoods as $k=>$v){
              $LimitShop =  $v['LimitShop'];
              if($v['LimitShop'] > 1) {
                 $where = ' `playerid` = '.$playerid.' and `GoodsID` = '.$v['Id'];
                 switch ($LimitShop) {
                     //日限购
                     case 2:
                         $where .= ' and  TO_DAYS(`DateTime`) = TO_DAYS(NOW())';
                         break;
                     //周先限购
                     case 3:
                         $where .= ' and  WEEKOFYEAR(`DateTime`)=WEEKOFYEAR(now())';
                         break;
                     //月限购
                     case 4:
                         $where .= ' and MONTH(`DateTime`)=MONTH(NOW()) and year(DateTime)=year(now())';
                         break;
                 }
                 $logUsersShop = $logUsersShopDb
                     ->where($where)
                     ->field($logUsersShopField)
                     ->select();
                 if($logUsersShop[0]['num'] >= $v['LimitShopNum'] &&  $v['LimitShop'] < 5 && $v['LimitShop'] > 1){
                     unset($catGoods[$k]);
                 }
                 if($v['LimitShop'] == 5 && $logUsersShop[0]['num'] >= 1){
                     unset($catGoods[$k]);
                 }
              }
              unset($catGoods[$k]['LimitShop']);
              unset($catGoods[$k]['LimitShopNum']);
         }
         foreach ($catGoods as $k=>$v){
             $GiveInfo =  $v['GiveInfo'];
             if(empty($GiveInfo)){
                 $catGoods[$k]['GiveInfo'] = array();
             }else{
                 $GiveInfo = json_decode( $GiveInfo,true);
                 $GiveInfoSrot = array();
                 $GoodsID      = array();
                 foreach ($GiveInfo as $key=>$val){
                     $GiveInfoSrot[$val['Id']] = $val;
                     $GoodsID[] = $val['Id'];
                 }
                 if(empty($GoodsID)){
                     $catGoods[$k]['GiveInfo'] = array();
                 }else{
                     $GoodsID = implode(',',$GoodsID);
                     $catGiveInfo = M('jy_goods_all')
                         ->where('Id in ('.$GoodsID.') and IsDel = 1')
                         ->field(
                             array(
                                 'Id',
                                 'ImgCode',
                                 'Code',
                                 'GetNum',
                             )
                         )
                         ->select();
                     if(empty($catGiveInfo)){
                         $catGoods[$k]['GiveInfo'] = array();
                     }else{
                         foreach ($catGiveInfo as $item=>$value){
                             $GoodVal =   $GiveInfoSrot[$value['Id']];
                             if($GoodVal){
                                 $catGiveInfo[$item]['Number'] = $value['GetNum']*$GoodVal['GetNum'];
                                 $catGiveInfo[$item]['Name'] = $GoodVal['Name'];
                                 unset($catGiveInfo[$item]['GetNum']);
                                 unset($catGiveInfo[$item]['Id']);
                             }else{
                                 unset($catGiveInfo[$item]);
                             }
                         }
                         $catGoods[$k]['index'] = $k;
                         $catGoods[$k]['GiveInfo'] = array_values($catGiveInfo);
                     }
                 }
             }
         }
         $catGoods = array_values($catGoods);
         $count = count($catGoods);
         if($count>=1){
                $info['Status']    = 2;
         }else{
                $info['Status']    = 1;
         }
         $info['Goods'] =  $catGoods;
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