<?php
namespace Jy_api\Model;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Model;
class PayComModel extends Model{
    protected $autoCheckFields = false;
    /***
    *  查询订单
    *  @param string  $PlatformOrder 订单号
    *  @param string  $playerid      用户ID
    */
    public function CatOrder($OrderID,$playerid =''){

        if(empty($OrderID)){
            return false;
        }

        $Field = array(
            'VipLevel',
            'VipExp',
            'playerid',
            'appuserid',
            'Price',
            'Status',
            'PayID',
            'Form',
        );
        if(!empty($playerid)){
            $where = 'playerid = '.$playerid.' PlatformOrder = "'.$OrderID.'"';
        }else{
            $where = ' PlatformOrder = "'.$OrderID.'"';
        }
        $CatData = M('jy_users_order_info')
                  ->where($where)
                  ->field($Field)
                  ->find();
        return $CatData;
    }
    /***
    * 查询商品
    * @param  int $GoodsID 商品ID
    */
    public function  CatGoods($OrderID,$playerid){
        $Field = array(
            'GoodsName',
            'GoodsCode',
            'GetNum',
            'Proportion',
            'GoodsID',
            'IsGive',
            'Number',
            'Type',
        );
        $CatData = M('jy_users_order_goods')
            ->where('playerid = '.$playerid.' and  PlatformOrder = "'.$OrderID.'"')
            ->field($Field)
            ->select();
        return $CatData;
    }
}
