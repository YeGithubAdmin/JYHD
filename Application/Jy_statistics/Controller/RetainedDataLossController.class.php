<?php
/***
 *   流失
 */
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class RetainedDataLossController extends ComController {
    //列表
    public function index(){
        $userInfo  = $this->userInfo;
        $default   = $userInfo['default'];
        $channel   = $userInfo['channel'];
        $page      = $this->page;
        $lowerAdminUser = $this->lowerAdminUser;    //我的下级组
        $time = date("Y-m-d",time());

        $DateTime = $time;

        $time = strtotime($time);
        $Statime = date('Y-m-d',$time-15*24*60*60);
        $Endtime = date('Y-m-d',$time);




        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['datemax']     = I('param.datemax',$Endtime,'trim');
        $search['num']         = I('param.num',30,'intval');
        $search['channel']     = I('param.channel','','trim');
        $model = new Model;
        $Channel = '';
        //判断管理还是运营
        $whereData = 'a.channel = 2 and a.Isdel = 1';
        if($channel == 2){
            $whereData .="  and  a.account = '".$userInfo['account']."'";
            $Channel = $userInfo['account'];
            //渠道
        }else{
            //管理
            if($default != 2){
                $lowerAdminUser[]   =   $userInfo['id'];
                $lowerAdminUser     =   implode(',',$lowerAdminUser);
                $whereData  .= ' and a.addId in('.$lowerAdminUser.')';
            }
            $ChannelListField = array(
                'a.Id',
                'a.name',
                'a.account',
            );
            $ChannelList = $model
                ->table('jy_admin_users as a')
                ->join('jy_channel_info as b on b.adminUserID = a.Id')
                ->where($whereData)
                ->field($ChannelListField)
                ->select();
            if ($search['channel'] != ''){
                $whereData .= ' and a.`account`="'.$search['channel'].'"';
                $Channel = $search['channel'];
            }
        }
        //默认前15天数据
        $datemin = date('Y-m-d H:i:s',strtotime($search['datemin']));
        $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);
        if ($search['datemin'] != ''){
            $whereData .= ' and  c.DateTime >= str_to_date("'.$datemin.'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $whereData .= ' and  c.DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        /***
         *'渠道ID',    GroupChannel
         *'渠道名称',  name
         *'报表日期',  t
         *'新增用户',  RegNum
         *'付费金额',  TotalMoney
         *'注册ARPU',  RegArpu
         *'活跃ARPU',  ActiveArpu
         *'次日留存',  UsersOneNum
         *'付费金额（老用户', OrderTotalOld
         *'活跃用户', ActiveNum
         *'付费转化', PayConversion
         *'付费用户（老用户）', UserPayNumOld
         *'付费转化（老用户）', PayConversionOld
         *'订单数量',  Success
         *'2日留存',  UsersTowNum
         *'3日留存', UsersThreeNum
         *'7日留存',  UsersSevenNum
         *'15日留存', UsersFifteenNum
         *'30日留存', UsersThirtyNum
         *
         **********/
        $ChannelData  =  D('ChannelData');
        $count        =  $ChannelData->NumberCount($whereData);
        $info         =  $ChannelData->Info($whereData,$page,$search['num']);
        $RealTime     =  $search['datemax'] == $DateTime ||   $search['datemin'] == $DateTime ?2:1 ;
        $countNum     =  $count[0]['Num'];
        if($RealTime == 2){
            $RealTimeData = $ChannelData->RealTimeData($Channel);
            if(!empty($RealTimeData)){
                $countNum = $countNum+count($RealTimeData);
                if($page < 1){
                    foreach ($RealTimeData as $k=>$v){
                        $count[0]['RegNum']        += $v['RegNum'];
                        $count[0]['UserPayNum']    += $v['UserPayNum'];
                        $count[0]['TotalMoney']    += $v['TotalMoney'];
                        $count[0]['OrderTotalOld'] += $v['OrderTotalOld'];
                        $count[0]['ActiveNum']     += $v['ActiveNum'];
                        $count[0]['UserPayNumOld'] += $v['UserPayNumOld'];
                        $count[0]['Success']       += $v['Success'];
                    }
                    $info = array_merge($RealTimeData,$info);
                }
            }
        }
        $Page       = new \Common\Lib\Page($countNum,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        foreach ($info as $k=>$v){

            if($v['UsersOneNum'] != 0){
                $info[$k]['UsersOneNum']=100-$v['UsersOneNum'];
            }
            if($v['UsersThreeNum'] != 0){
                $info[$k]['UsersThreeNum']=100-$v['UsersThreeNum'];
            }
            if($v['UsersSevenNum'] != 0){
                $info[$k]['UsersSevenNum']=100-$v['UsersSevenNum'];
            }
            if($v['UsersFifteenNum'] != 0){
                $info[$k]['UsersFifteenNum']=100-$v['UsersFifteenNum'];
            }
            if($v['UsersThirtyNum'] != 0){
                $info[$k]['UsersThirtyNum']=100-$v['UsersThirtyNum'];
            }
        }
        $show       = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('ChannelList',$ChannelList);
        $this->assign('userinfo',$userInfo);
        $this->assign('info',$info);
        $this->assign('count',$count);
        $this->display('index');
    }
}