<?php
namespace Jy_statistics\Model;
use Think\Model;
class ChannelDataModel extends Model{

    protected $autoCheckFields = false;
    //查询当前表数据
    public function  RealTimeData($Channel){
        $StartTime = date('Y-m-d',time());
        $EndTime   = date('Y-m-d',time()+24*60*60);
        $model  = new Model;
        $where  = '';
        if($Channel != ''){
            $where = ' and  a.`account` = "'.$Channel.'"';
        }
        $info = $model->query('
                  SELECT * FROM (
                  SELECT 
                  a.account as GroupChannel,
                  a.name,
                  c.PayNum,
                  c.DateTime,
                  c.UserPayNum,
                  c.RegNum,
                  c.TotalMoney/UserPayNum as ARPPU ,
                  c.EquipmentRegNum,
                  CONVERT(a.account USING gbk) as OrderChannel,
                  c.ActiveNum,
                  if(round((c.TotalMoney/c.RegNum),2),
                  round((c.TotalMoney/c.RegNum),2),0)  as  RegArpu,
                  if(round((c.TotalMoney/c.ActiveNum),2),
                  round((c.TotalMoney/c.ActiveNum),2),0)    as  ActiveArpu,
                  c.Success,
                  if(round((c.UserPayNum/c.ActiveNum)*100,2),round((c.UserPayNum/c.ActiveNum)*100,2) ,0) as   PayConversion,
                  if(round((c.UserPayNumOld/c.ActiveNum)*100,2),round((c.UserPayNumOld/c.ActiveNum)*100,2) ,0)  as  PayConversionOld,
                  c.TotalMoney,
                  round(c.UsersOneNum*100,2) as UsersOneNum,
                  round(c.UsersTowNum*100,2) as UsersTowNum,
                  round(c.UsersThreeNum*100,2) as UsersThreeNum,
                  round(c.UsersSevenNum*100,2) as UsersSevenNum,
                  round(c.UsersFifteenNum*100,2) as UsersFifteenNum,
                  round(c.UsersThirtyNum*100,2) as UsersThirtyNum,
                  c.UserPayNumOld,
                  c.OrderTotalOld,
                  date_format(c.DateTime,"%Y-%m-%d") as t  
                  FROM jy_admin_users as a INNER JOIN jy_channel_info as b on b.adminUserID = a.Id
                  INNER JOIN jy_statistics_users_pay as c on c.Channel = a.account  
                  WHERE (  a.channel = 2 and a.Isdel = 1 and   c.DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") 
                          and  c.DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") '.$where.'  ) ORDER BY c.DateTime desc) as 
                  catData GROUP BY  catData.`GroupChannel`,catData.`t`');

        return $info;

    }

    //查询列表数据
    public function  NumberCount($where){
        $Field = array(
            'count(c.Id)            as Num',
            'sum(c.RegNum)          as RegNum',
            'sum(c.UserPayNum)      as UserPayNum',
            'sum(c.EquipmentRegNum) as EquipmentRegNum',
            'sum(c.TotalMoney)      as TotalMoney',
            'sum(c.OrderTotalOld)   as OrderTotalOld',
            'sum(c.ActiveNum)       as ActiveNum',
            'sum(c.UserPayNumOld)   as UserPayNumOld',
            'sum(c.Success)         as Success',
        );
        $info = M('jy_admin_users as a')
            ->join('jy_channel_info as b on b.adminUserID = a.Id')
            ->join('log_channel_data as c on c.Channel = a.account')
            ->field($Field)
            ->where($where)
            ->select();
        return $info;
    }
    public function  Info($where,$page,$num){


        $info = M('jy_admin_users as a')
                ->join('jy_channel_info as b on b.adminUserID = a.Id')
                ->join('log_channel_data as c on c.Channel = a.account')
                ->where($where)
                ->field(' a.account as GroupChannel,
                  a.name,
                  c.PayNum,
                  c.DateTime,
                  CONVERT(a.account USING gbk) as OrderChannel,
                  c.UserPayNum,
                  c.RegNum,
                  c.EquipmentRegNum,
                  c.ActiveNum,
                  c.TotalMoney/UserPayNum as ARPPU,
                  if(round((c.TotalMoney/c.RegNum),2),
                  round((c.TotalMoney/c.RegNum),2),0)  as  RegArpu,
                  if(round((c.TotalMoney/c.ActiveNum),2),
                  round((c.TotalMoney/c.ActiveNum),2),0)    as  ActiveArpu,
                  c.Success,
                  if(round((c.UserPayNum/c.ActiveNum)*100,2),
                  round((c.UserPayNum/c.ActiveNum)*100,2) ,0)  PayConversion,
                  if(round((c.UserPayNumOld/c.ActiveNum)*100,2),
                  round((c.UserPayNumOld/c.ActiveNum)*100,2) ,0)  PayConversionOld,
                  c.TotalMoney,
                  round(c.UsersOneNum*100,2) as UsersOneNum,
                  round(c.UsersTowNum*100,2) as UsersTowNum,
                  round(c.UsersThreeNum*100,2) as UsersThreeNum,
                  round(c.UsersSevenNum*100,2) as UsersSevenNum,
                  round(c.UsersFifteenNum*100,2) as UsersFifteenNum,
                  round(c.UsersThirtyNum*100,2) as UsersThirtyNum,
                  c.UserPayNumOld,
                  c.OrderTotalOld,
                  date_format(c.DateTime,"%Y-%m-%d") as t  '
            )->order('DateTime desc,OrderChannel asc')
            ->limit($page*$num,$num)
            ->select();
        return $info;
    }







}
