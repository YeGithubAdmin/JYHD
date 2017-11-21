<?php
namespace Jy_Test\Controller;
use Think\Controller;
use Think\Model;
class RetainedController extends Controller {
    public function index(){
        //统计时间
        $time = strtotime(date('Y-m-d'),time());
        $day  = 24*60*60;


        $model = new Model();
        $result = 0;
        //渠道列表
        $ChannelListField = array(
            'account as GroupChannel'
        );
        $ChannelList  = $model
            ->table('jy_admin_users')
            ->where('channel = 2 and IsDel = 1')
            ->field($ChannelListField)
            ->select();
        $ChannelListSort = array();
        foreach($ChannelList as $k=>$v) $ChannelListSort[] = '"'.$v['GroupChannel'].'"';
        if(empty($ChannelList)){
            die('不存在渠道');
        }

        //测试
        while (true){
            $DateTime = date('Y-m-d',$time);
            if($DateTime =='2017-10-01'){
                break;
            }
            $EndTime   = date('Y-m-d H:i:s',$time+$day);
            $StartTime = date('Y-m-d H:i:s',$time);
            $model = new Model();
            //次日 UsersOneNum
            $OneNumStartTime        =   date("Y-m-d H:i:s",$time-24*60*60);
            $OneNumEndTime          =   date('Y-m-d H:i:s',$time) ;
            $UsersOneNumSql         =   $this->UpdateDb($EndTime,$StartTime,$OneNumEndTime,$OneNumStartTime,'UsersOneNum');
            $SelectUpdate           =   $model->query($UsersOneNumSql);
            if(!$SelectUpdate){
                $result = 1;
            }
            //二日 UsersTowNum
            $TowNumStartTime        =   date("Y-m-d H:i:s",$time-2*24*60*60);
            $TowNumEndTime          =   date('Y-m-d H:i:s',$time-24*60*60) ;
            $UsersOneNumSql         =   $this->UpdateDb($EndTime,$StartTime,$TowNumEndTime,$TowNumStartTime,'UsersTowNum');
            $SelectUpdate           =   $model->query($UsersOneNumSql);
            if(!$SelectUpdate){
                $result = 2;
            }
            //3日 UsersThreeNum
            $ThreeNumStartTime      =  date("Y-m-d H:i:s",$time-3*24*60*60);
            $ThreeNumEndTime        =  date('Y-m-d H:i:s',$time-2*60*60*24) ;
            $UsersOneNumSql         =  $this->UpdateDb($EndTime,$StartTime,$ThreeNumEndTime,$ThreeNumStartTime,'UsersThreeNum');
            $SelectUpdate           =  $model->query($UsersOneNumSql);
            if(!$SelectUpdate){
                $result = 3;
            }
            //7日 UsersSevenNum
            $SevenNumStartTime      =  date("Y-m-d H:i:s",$time-7*24*60*60);
            $SevenNumEndTime        =  date('Y-m-d H:i:s',$time-6*60*60*24) ;
            $UsersOneNumSql         =  $this->UpdateDb($EndTime,$StartTime,$SevenNumEndTime,$SevenNumStartTime,'UsersSevenNum');
            $SelectUpdate           =  $model->query($UsersOneNumSql);
            if(!$SelectUpdate){
                $result = 4;
            }
            //15日  UsersFifteenNum
            $FifteenNumStartTime    =  date("Y-m-d H:i:s",$time-15*24*60*60);
            $FifteenNumEndTime      =  date('Y-m-d H:i:s',$time-14*60*60*24) ;
            $UsersOneNumSql         =  $this->UpdateDb($EndTime,$StartTime,$FifteenNumEndTime,$FifteenNumStartTime,'UsersFifteenNum');
            $SelectUpdate           =  $model->query($UsersOneNumSql);
            if(!$SelectUpdate){
                $result = 5;
            }
            //30日  UsersThirtyNum
            $ThirtyNumStartTime     =  date("Y-m-d H:i:s",$time-30*24*60*60);
            $ThirtyNumEndTime       =  date('Y-m-d H:i:s',$time-29*60*60*24) ;
            $UsersOneNumSql         =  $this->UpdateDb($EndTime,$StartTime,$ThirtyNumEndTime,$ThirtyNumStartTime,'UsersThirtyNum');
            $SelectUpdate           =  $model->query($UsersOneNumSql);
            if(!$SelectUpdate){
                $result = 6;
            }
            if($result != 0){
                $obj = new  \Common\Lib\func();
                if(C('ACCESS_lOGS')){
                    $dir = C('YQ_ROOT').'Log/api/'.date('Y').'/'.date('m').'/'.date('d').'/';
                    $obj->record_log($dir,'access_'.date('Ymd').'.log',$result);
                }
            }
            $time = $time-$day;
        }
    }
    /***
    * 查询更新留存
    * @param  $EndTime       string  登录结束时间
    * @param  $StartTime     string  登录开始时间
    * @param  $RegEndTime    string  登录借宿时间
    * @param  $RegStartTime  string  登录开始时间
    */
     private  function  UpdateDb($EndTime,$StartTime,$RegEndTime,$RegStartTime,$item){
            $Sql = '
                    UPDATE  
                        log_channel_data as a,
                        (
                            SELECT 
                            a.reg_channel as  GroupChannel,
                            count(distinct a.playerid) as UserNum,
                            a.regtime,
                            b.login_time,
                            count(distinct b.playerid) as UsersOneNum,
                            count(distinct b.playerid)/count(a.playerid)  Retained 
                            FROM game_account as a left JOIN game_login_action as b on  a.reg_channel = b.login_channel 
                            and  a.playerid = b.playerid  
                            and  b.login_time < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") 
                            and  b.login_time >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") 
                            WHERE ( a.regtime < str_to_date("'.$RegEndTime.'","%Y-%m-%d %H:%i:%s")
                            and a.regtime >= str_to_date("'.$RegStartTime.'","%Y-%m-%d %H:%i:%s") ) 
                            GROUP BY GroupChannel
                        ) AS  b SET a.'.$item.' = b.Retained 
                    WHERE 
                        a.Channel = b.GroupChannel
                            AND    a.`DateTime` < str_to_date("'.$RegEndTime.'","%Y-%m-%d %H:%i:%s") 
                            AND    a.`DateTime` >= str_to_date("'.$RegStartTime.'","%Y-%m-%d %H:%i:%s")
                        ';
            return    $Sql;
     }

}