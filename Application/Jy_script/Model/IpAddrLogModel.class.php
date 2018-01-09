<?php
namespace Jy_script\Model;
use Think\Model;
class IpAddrLogModel extends Model{
     //停止表名检查
      protected $autoCheckFields = false;
    //活跃设备号
    public function EquipmentAct($StartTime,$EndTime){
        $EquipmentAndroidField = array(
            'Channel',
            'ActiveNum',
            'EquipmentActNum',
        );
        $EquipmentAndroid   = M('log_channel_data')
            ->where('DateTime< str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and
                                DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")')
            ->field($EquipmentAndroidField)

            ->select();
        $EquipmentAndroidSort    = array();
        foreach ($EquipmentAndroid as $k=>$v){
            $EquipmentAndroidSort[$v['Channel']] = $v;
        }
        return $EquipmentAndroidSort ;

    }
}