<?php
namespace Jy_statistics\Model;
use Think\Model;
class WholeKpiModel extends Model{

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
                  c.EquipmentActNum,
                  c.ActiveNum,
                  c.EquipmentRegNum,
                  c.RegNum,
                  c.UsersOneNum,
                  c.UsersThreeNum,
                  c.UsersSevenNum,
                  c.UserPayNum,
                  c.First,
                  c.TotalMoney,
                  date_format(c.DateTime,"%Y-%m-%d") as t  
                  FROM jy_admin_users as a INNER JOIN jy_channel_info as b on b.adminUserID = a.Id
                  INNER JOIN jy_statistics_users_pay as c on c.Channel = a.account  
                  WHERE (  a.channel = 2 and a.Isdel = 1 and   c.DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") 
                          and  c.DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")   ) ORDER BY c.DateTime desc) as 
                  catData GROUP BY  catData.`GroupChannel`,catData.`t`');

        $Data = array(
            'EquipmentActNum'   =>  0,
            'ActiveNum'         =>  0,
            'EquipmentRegNum'   =>  0,
            'RegNum'            =>  0,
            'UsersOneNum'     =>  0,
            'UsersThreeNum'     =>  0,
            'UsersSevenNum'     =>  0,
            'UserPayNum'        =>  0,
            'First'             =>  0,
            'TotalMoney'        =>  0,
        );
        foreach ($info as $k=>$v){
            $Data['EquipmentActNum'] = $v['EquipmentActNum']+$Data['EquipmentActNum'];
            $Data['ActiveNum']       = $v['ActiveNum']+$Data['ActiveNum'];
            $Data['EquipmentRegNum'] = $v['EquipmentRegNum']+$Data['EquipmentRegNum'];
            $Data['RegNum']          = $v['RegNum']+$Data['RegNum'];
            $Data['UsersOneNum']     = $v['UsersOneNum']*$v['RegNum']+$Data['UsersOneNum'];
            $Data['UsersThreeNum']   = $v['UsersThreeNum']*$v['RegNum']+$Data['UsersThreeNum'];
            $Data['UsersSevenNum']   = $v['UsersSevenNum']*$v['RegNum']+$Data['UsersOneNum'];
            $Data['UserPayNum']      = $v['UserPayNum']+$Data['UserPayNum'];
            $Data['First']           = $v['First']+$Data['First'];
            $Data['TotalMoney']      = $v['TotalMoney']+$Data['TotalMoney'];
            $Data['t']               = $v['t'];
        }
        $Data['UsersOneNum']         = $Data['UsersOneNum']/$Data['RegNum'];
        $Data['UsersThreeNum']       = $Data['UsersThreeNum']/$Data['RegNum'];
        $Data['UsersSevenNum']       = $Data['UsersSevenNum']/$Data['RegNum'];
        $Data['PayArppu']            = $Data['TotalMoney']/$Data['UserPayNum'];
        $Data['ActiveArppu']         = $Data['TotalMoney']/$Data['ActiveNum'];
        return $Data;

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
        $info = M('log_channel_data')
                ->where($where)
                ->field(array(
                        'date_format(DateTime,"%Y-%m-%d") as t',
                        'sum(EquipmentActNum) as EquipmentActNum',
                        'sum(ActiveNum) as ActiveNum' ,
                        'sum(EquipmentRegNum) as EquipmentRegNum' ,
                        'sum(RegNum) as RegNum',
                        'sum((UsersOneNum*RegNum))/sum(RegNum) as UsersOneNum',
                        'sum((UsersThreeNum*RegNum))/sum(RegNum) as UsersThreeNum',
                        'sum((UsersSevenNum*RegNum))/sum(RegNum) as UsersSevenNum',
                        'sum(UserPayNum) as UserPayNum',
                        'sum(First) as First',
                        'sum(TotalMoney) as TotalMoney',
                        'sum(ActiveNum)',
                        'sum(TotalMoney)/sum(UserPayNum) as PayArppu',
                        'sum(TotalMoney)/sum(ActiveNum) as ActiveArppu',
                )
            )->group('t')
            ->order('DateTime desc')
            ->limit($page*$num,$num)
            ->select();
        return $info;
    }







}
