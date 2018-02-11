<?php
/***
*  活动数据
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveFlowingWaterController extends ComController {
    //列表
    public function index(){
        $page      = $this->page;
        $time = date("Y-m-d",time());
        $DateTime = $time;
        $time = strtotime($time);
        $Statime = date('Y-m-d',$time-15*24*60*60);
        $Endtime = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['datemax']     = I('param.datemax',$Endtime,'trim');
        $search['Channel']     = I('param.Channel','','trim');
        $search['Style']       = I('param.Style','','trim');
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();


        $ActiveFlowingWater = D('ActiveFlowingWater');
        //判断管理还是运营
        $where = '1';
        //活动列表
        $ActiveList = $ActiveFlowingWater->ActiveList();

        //查询物品
        $CatGoods = $ActiveFlowingWater->CatGoods();

        //默认前15天数据
        $datemin = date('Y-m-d H:i:s',strtotime($search['datemin']));
        $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);

        if ($search['Channel'] != ''){
            $where .= ' and  b.Channel = "'.$search['Channel'].'"';
        }
        if ($search['Style'] != ''){
            $where .= ' and  b.Style ='.$search['Style'];
        }
        if ($search['datemin'] != ''){
            $where .= ' and  b.DateTime >= str_to_date("'.$datemin.'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $where .= ' and  b.DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }

        $info = $ActiveFlowingWater->CatGoodsInfo($where);
        foreach ($info as $k=>$v){
            if($v['GoodsID'] == 0){
                    unset($info[$k]);
            }else if($CatGoods[$v['GoodsID']]){
                $info[$k]['Name'] = $CatGoods[$v['GoodsID']]['Name'];
            }
        }
        //查询活动栏
        $infoSort = array();
        foreach ($info as $k=>$v){
                $infoSort[$v['Style'].$v['T']]['data'][$v['Id']]['SonTitle'] = $v['SonTitle'];
                $infoSort[$v['Style'].$v['T']]['data'][$v['Id']]['data']['SonTitle']   = $v['SonTitle'];
                $infoSort[$v['Style'].$v['T']]['data'][$v['Id']]['data']['Goods'][]    = $v;
                $infoSort[$v['Style'].$v['T']]['DateTime']                   = $v['T'];
                $infoSort[$v['Style'].$v['T']]['AbroadTitle']                = $ActiveList[$v['Style']]['AbroadTitle'];
        }

        foreach ($infoSort as $k=>$v){
            foreach ($v['data'] as $key =>$val){
                $UserNum =0;
                foreach ($val['data']['Goods'] as $item =>$value){
                    $UserNum += $value['UsersNum'];
                }
                $infoSort[$k]['data'][$key]['UsersNum'] = $UserNum;

            }
        }
        $this->assign('info',$infoSort);
        $this->assign('Channel',$Channel);
        $this->assign('search',$search);
        $this->display('index');
    }



    public function LotteryRecord(){
        $obj = new  \Common\Lib\func();
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $Day = 24*60*60;

        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date("Y-m-d",$time-$Day*29);
        $EndTime   =  date("Y-m-d",$time);
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');
        $search['datemax']                   =      I('param.datemax',$EndTime,'trim');
        $search['playerid']                  =      I('param.playerid','','trim');
        $search['Style']                     =      I('param.Style',4,'trim');
        $search['num']                       =      I('param.num',0,'intval');                    //条数
        $num =  $search['num'] == 0? $num: $search['num'] ;
        $where = 'a.GoodsID > 0';
        //查询渠道
        $ChannelFiled = array(
            'account',
            'name',
        );
        $Channel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($ChannelFiled)
            ->select();
        //注册时间
        if($search['datemin']  != '' ){
            $where .= ' and   a.`DateTime` >=  str_to_date("'.$search['DateTime'].'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['datemax']  != '' ){
            $datemax  =   date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60);
            $where .= ' and   a.`DateTime` < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['playerid']  != '' ){
            $where .= ' and   a.`playerid` =  '.$search['playerid'] ;
        }
        if($search['Style']  != '' ){
            $where .= ' and   a.`Style` =  '.$search['Style'] ;
        }
        $count  =M('log_users_activity_goods as a')
            ->where($where)
            ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $infoField = array(
            'a.DateTime',
            'a.playerid',
            'a.GetNum*a.Number as Number',
            'b.Name',
        );
        $info = M('log_users_activity_goods as a')
            ->join('jy_goods_all as b on a.GoodsID = b.Id')
            ->where($where)
            ->limit($page*$num,$num)
            ->order('a.DateTime desc')
            ->field($infoField)
            ->select();


        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        $this->assign('search',$search);
        $this->display();
    }




}