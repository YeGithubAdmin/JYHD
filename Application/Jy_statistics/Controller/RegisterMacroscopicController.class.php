<?php
/***
*  注册分析-宏观数据
***/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class RegisterMacroscopicController extends ComController {
    //列表
    public function index()
    {
        $timeEndDay = 30;
        $search['datemin'] = I('param.datemin','','trim');
        $search['datemax'] = I('param.datemax','','trim');
        $search['Type'] = I('param.Type',1,'intval');
        $search['Channel']  =  I('param.Channel','','trim');
        $dayTime = 24 * 60 * 60;
        $strtotime = strtotime(date('Y-m-d'),time());
        //渠道信息
        $ChannelDataField = array(
            'Id',
            'account',
            'name',
        );
        $ChannelData = M('jy_admin_users')
            ->where('Channel = 2 and IsDel = 1')
            ->field($ChannelDataField)
            ->select();
        //排序数组
        ksort($erverDay);
        //时间范围
        $EndTime   = date('Y-m-d H:i:s',$strtotime+$dayTime);
        $StartTime = date('Y-m-d H:i:s',$strtotime-$timeEndDay*$dayTime);
        $where = '1';
        //渠道
        if( $search['Channel'] != '' ){
            $where .= ' and  c.Channel = "'.$search['Channel'].'"';
        }
        //时间范围
        if($search['datemax']  != ''){
            $datemax = strtotime($search['datemax'])+$dayTime;
            $EndTime = date('Y-m-d H:i:s',$datemax);
            $where .=  '  and  DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")';
        }else{
            $where .=  '  and  DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemin'] != ''){
            $where .=  ' and   DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }else{
            $where .=  ' and   DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")';
        }
        $model = new Model();
        //类型 Type  1-注册  2-活跃 3-付费
            //注册
            $catRegister = $model->query('  SELECT * FROM (
                  SELECT 
                  a.account as GroupChannel,
                  a.name,
                  c.RegNum,
                  c.EquipmentRegNum,
                  c.PayNum,
                  c.TotalMoney,
                  c.OrderTotalOld,
                  c.UserPayNum,
                  date_format(c.DateTime,"%Y-%m-%d") as t  
                  FROM jy_admin_users as a INNER JOIN jy_channel_info as b on b.adminUserID = a.Id
                  INNER JOIN jy_statistics_users_pay as c on c.Channel = a.account  
                  WHERE ( '.$where.') ORDER BY c.DateTime desc) as 
                  catData GROUP BY  catData.`GroupChannel`,catData.`t` ORDER BY catData.`t` ASC');
            $info = $catRegister;


        $this->assign('ChannelData',$ChannelData);
        $this->assign('search',$search);
        $this->assign('info',$info);
        $this->display();
    }



}