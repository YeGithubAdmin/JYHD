<?php
/***
 * 首冲信息
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
class TheFirstPunchController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;
        $obj   = new \Common\Lib\func();
        $result = 2001;
        $info   =  array();

        //查询首冲物品
        $GoodsInfoFile = array(
            'GiveInfo',
            'CurrencyNum',

        );
        $GoodsAll = M('jy_goods_all')
            ->field($GoodsInfoFile)
            ->where('ShowType = 2 and  CateGory = 4  and IsDel = 1')
            ->find();


        $GiveInfo           = json_decode($GoodsAll['GiveInfo'],true);

        $CardGoodsInfo      = array();
        if(!empty($GiveInfo)){
            $GoodID = array();
            foreach ($GiveInfo as $k=>$v){
                $GoodID[] = $v['Id'];
            }
            $CardGoodsInfoFile  = array(
                'Id',
                'Name',
                'GetNum',
                'ImgCode',
                'Type',
            );
            $GoodID = implode(',',$GoodID);
            $CardGoodsInfo      =  M('jy_goods_all')
                ->field($CardGoodsInfoFile)
                ->where('Id in('.$GoodID.')')
                ->select();
            if(!empty($CardGoodsInfo)){
                foreach ($CardGoodsInfo as $k=>$v){
                    foreach ($GiveInfo as $key=>$val){
                        if($val['Id'] == $v['Id']){
                            $CardGoodsInfo[$k]['GetNum'] =  $v['GetNum']*$val['GetNum'];
                        }
                    }
                }
            }
        }

        $info['GoodsInfo'] = $CardGoodsInfo;
        $info['CurrencyNum'] = $GoodsAll['CurrencyNum'];


        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );
            $this->response($response,'json');


    }
}