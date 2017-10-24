<?php
/***
 *  活跃分析-等级
 ***/
namespace Jy_statistics\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class ActiveLevelController extends ComController {
    //列表
    public function index(){

        //天数
        $DayNum = I('param.DayNum',7,'intval');
        //选择时间
        $DateTime = I('param.DateTime','','trim');
        //一天的秒数
        $DayTime = 24*60*60;
        if($DateTime == ''){
            $DayDate  = date('Y-m-d',time());
            $DayDate  = strtotime($DayDate)-$DayTime;
            $DateTime =  date('Y-m-d H:i:s',$DayDate);
        }
        $strtotime = strtotime($DateTime);
        //起始时间
        $StartTime = date('Y-m-d H:i:s',$strtotime-($DayTime-1)*$DayNum) ;
        //结束时间
        $EndTime  = date('Y-m-d H:i:s',$strtotime+$DayTime);
        //时间范围
        $erverDay = array();
        for ($i=0;$i<$DayNum;$i++){
            $erverDayTime = $strtotime-$i*$DayTime;
            $erverDay[$i]['time'] = date('n月j日',$erverDayTime);
            $erverDay[$i]['date'] = date('Y-m-d',$erverDayTime);
        }

        //等级访问
        $HighestLevel = 99;

        $dataLevel = array();

        for($i = 1;$i<=$HighestLevel;$i++){

            $dataLevel[]['level'] = $i;
        }

        //查询数据
        $catDataField = array(
            'Version',
            'UserNum',
            'date_format(DateTime,"%Y-%m-%d")  as t'
        );
        $catData = M('jy_statistics_activem_version')
            ->where(' DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                            and  DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")','left')
            ->field($catDataField)
            ->select();
        //分组
        $catDataSort = array();
        foreach ($catData as $k=>$v)$catDataSort[$v['Version']]['data'][] = $v;
        //组装
        foreach ($dataLevel as $k=>$v){
            $dataGameVersion = array();
            if($catDataSort[$v['level']]){
                $dataCurrency = $catDataSort[$v['level']]['data'];
                $dateArr      = array();
                foreach ($dataCurrency as $key=>$val) $dateArr[$val['t']] = $val;
                foreach ($erverDay as $key=>$val){
                    if($dateArr[$val['date']]){
                        $dataGameVersion[$key]['DateTime'] =$val['time'];
                        $dataGameVersion[$key]['UserNum'] =  $dateArr[$val['date']]['UserNum'];
                    }else{
                        $dataGameVersion[$key]['DateTime'] = $val['time'];
                        $dataGameVersion[$key]['UserNum'] =  0;
                    }
                }
            }else{
                foreach ($erverDay as $key=>$val){
                    $dataGameVersion[$key]['DateTime'] = $val['time'];
                    $dataGameVersion[$key]['UserNum'] =  0;
                }
            }
            $dataLevel[$k]['data'] = $dataGameVersion;
        }


        $this->assign('erverDay',$erverDay);
        $this->assign('info',$dataLevel);
        $this->assign('DateTime',$DateTime);
        $this->assign('DayNum',$DayNum);
        $this->display();
    }

    //计算脚本
    public function Script(){
        $time = strtotime(date('Y-m-d',time()));
        $Day  = 24*60*60;
        $StartTime = date('Y-m-d H:i:s',$time-$Day);
        $EndTime   = date('Y-m-d H:i:s',$time);
        $infoFiled  = array(
            'Level',
            'count(distinct playerid) as UserNum'
        );
        $info = M('jy_users_login_log')
            ->where('
                    LastTime <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and  
                    str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  <= LastTime','left')
            ->field($infoFiled)
            ->group('Level')
            ->select();
        if(!empty($info)){
            foreach ($info as $k=>$v){
                $info[$k]['DateTime'] = $StartTime;
            }
            $addDb = M('jy_statistics_activem_level')->addAll($info);
        }

    }

}