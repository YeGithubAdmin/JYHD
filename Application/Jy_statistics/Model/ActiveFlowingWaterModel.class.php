<?php
namespace Jy_statistics\Model;
use Think\Model;
class ActiveFlowingWaterModel extends Model{

    protected $autoCheckFields = false;

    public function CatGoodsInfo($where){
          $catData = M('conf_activity_son as a')
                     ->join('log_users_activity_goods as b on b.ActSonId = a.Id')
                     ->where($where)
                     ->field(
                         array(
                             'a.Id',
                             'date_format(b.`DateTime`,"%Y-%m-%d") as T',
                             'count(distinct b.`playerid`) as UsersNum',
                             'a.SonTitle',
                             'b.GoodsID',
                             'b.GoodsName',
                             'b.Style',
                             'a.FatherID',
                             'sum(b.GetNum*b.Number) as Number',
                         )
                     )
                     ->group('a.Id,T,b.GoodsID')
                     ->select();
          return $catData;

    }

    //查询活动
    public function  ActiveList(){
            $catData = M('conf_activity_father as a')
                       ->field(array(
                            'a.Id',
                            'a.AbroadTitle',
                            'b.TypeCode',
                            'b.GiveInfo',
                            'b.SonTitle',
                            'a.Style',
                       ))
                       ->join('conf_activity_son as b')
                       ->where('a.Channel = "global" and a.Style  <> 5 ')
                       ->select();

            $catDataSort = array();
            foreach ($catData as $k=>$v){
                $dataSort['TypeCode']                        = $v['TypeCode'];
                $dataSort['SonTitle']                        = $v['SonTitle'];
                $dataSort['GiveInfo']                        = json_decode($v['GiveInfo'],true);
                $catDataSort[$v['Style']]['AbroadTitle']     =  $v['AbroadTitle'];
                $catDataSort[$v['Style']]['Style']           =  $v['Style'];
                $catDataSort[$v['Style']]['data'][]          =  $dataSort;
            }
            return $catDataSort;
    }


    //查询物品
    public function  CatGoods(){
            $CatGoods  = M('jy_goods_all')->field(
                array(
                    'Id',
                    'Name',
                )
            )->select();
        foreach ($CatGoods as $k=>$v) $CatGoodsSort[$v['Id']] = $v;
        return $CatGoodsSort;
    }


}
