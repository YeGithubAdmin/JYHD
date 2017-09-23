<?php
/***
 *  活跃分析-金币
 ***/
namespace Jy_admin\Controller;
use Think\Controller;
defined('THINK_PATH') or exit('Access Defined!');
class GoldStreamController extends ComController {
    //列表
    public function index(){

        $time = date('Y-m-d', time());                                                                      //当前时间
        $btime = date('Y-m-d', time() - 24 * 60 * 60);                                          //默认当前昨天
        $datemin = I('param.datemin', $btime, 'trim');                                                            //搜索时间
        if ($datemin == $time) {
            $datemin = $btime;
        }
        $timeEndDay = I('param.day',4,'intval');
        $dayTime = 24 * 60 * 60;
        $Strtotime = strtotime($datemin);
        $StartTime  = date('Y-m-d H:i:s',$Strtotime-$dayTime*$timeEndDay);
        $EndTime    = date('Y-m-d H:i:s',$Strtotime+$dayTime);
        $erverDay = array();
        //时间范围
        for ($i = 0;$i<$timeEndDay;$i++){
            $dataStartTime  =  $Strtotime-$dayTime*$i;
            $erverDay[$i]['time'] =$dataStartTime;
            $erverDay[$i]['date'] = date('Y-m-d',$dataStartTime);
        }
        //查询渠道
        $catChannelField  = array(
            'account',
            'Name',
        );
        $catChannel = M('jy_admin_users')
                      ->where('channel = 2 and isdel = 1')
                      ->field($catChannelField)
                      ->select();
        $search['Channel']        =      I('param.Channel','','trim');
        $search['Screenings']     =      I('param.Screenings',0,'intval');
        $search['Income']         =      I('param.Income',0,'intval');
        $where = '  CurrencyType =1 and DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  and DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")';
        if ($search['Income'] != 0){
            $where .= ' and `Income`="'.$search['Income'].'"';
        }
        if ($search['Screenings'] != 0){
            $where .= ' and `Screenings`="'.$search['Screenings'].'"';
        }

        if ($search['Channel'] != '') {
            $where .= ' and `Channel`=' . $search['Channel'];
        }

        //查询信息
        $cataDataField = array(
            'sum(Number) as Number',
            'count(distinct playerid) UserNum',
            'Type as GroupType',
            'count(Id) Frequency',
            'date_format(DateTime,"%Y-%m-%d") as t',
        );
        $cataData = M('jy_users_currency_stream')
                    ->where($where)
                    ->field($cataDataField)
                    ->group('GroupType,t')
                    ->select();

        $catGameFormField = array(
            'Name',
            'Type',
        );
        $catGameForm  = M('jy_game_form')
                        ->field($catGameFormField)
                        ->select();

        foreach ($catGameForm as $k=>$v){
            $dataInfo = array();
            $dataTimeArr = array();
            if(!empty($catGameForm)){
               foreach ($cataData as $key=>$val){
                   if($v['Type'] == $val['GroupType']){
                       $dataTimeArr[$key] = $val;
                   }
               }
               if(!empty($dataTimeArr)){
                   foreach ($erverDay as $key=>$val){
                       foreach ($dataTimeArr as $keys=>$value){
                           if($value['t'] == $val['date']){
                               $dataInfo[$key]['DateTime'] = date('Y年m月d日',$val['time']);
                               $dataInfo[$key]['Number']     = $value['Number'];
                               $dataInfo[$key]['UserNum']    = $value['UserNum'];
                               $dataInfo[$key]['Frequency']  = $value['Frequency'];
                           }else{
                               $dataInfo[$key]['DateTime'] = date('Y年m月d日',$val['time']);
                               $dataInfo[$key]['Number']     = 0;
                               $dataInfo[$key]['UserNum']    = 0;
                               $dataInfo[$key]['Frequency']  = 0;
                           }
                       }
                   }
               }else{
                   foreach ($erverDay as $key=>$val){
                       $dataInfo[$key]['DateTime'] = date('Y年m月d日',$val['time']);
                       $dataInfo[$key]['Number']     = 0;
                       $dataInfo[$key]['UserNum']    = 0;
                       $dataInfo[$key]['Frequency']  = 0;
                   }
               }
            }else{
                foreach ($erverDay as $key=>$val){
                    $dataInfo[$key]['DateTime'] = date('Y年m月d日',$val['time']);
                    $dataInfo[$key]['Number']     = 0;
                    $dataInfo[$key]['UserNum']    = 0;
                    $dataInfo[$key]['Frequency']  = 0;
                }
            }
            $catGameForm[$k]['data'] = $dataInfo;
        }
        $this->assign('datemin',$datemin);
        $this->assign('info',$catGameForm);
        $this->assign('dayNum',$timeEndDay);
        $this->assign('search',$search);
        $this->assign('ChannelInfo',$catChannel);
        $this->assign('day',$erverDay);
        $this->display('index');

    }


}