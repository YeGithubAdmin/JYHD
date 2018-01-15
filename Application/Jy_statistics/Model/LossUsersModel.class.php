<?php
/**
 * 用户流失分析
 */
namespace Jy_statistics\Model;
use Think\Model;
class LossUsersModel extends Model{
     //停止表名检查
      protected $autoCheckFields = false;
      /**
       * 统计流失账号
       */
      public function  LossUsers($Day,$Date,$Channel =''){
            //统计日登录的用户
            $model         =  new Model();
            $time          =  strtotime($Date);
            $StarTime      =  date('Y-m-d H:i:s',$time);
            $EndTime       =  date('Y-m-d H:i:s',$time+24*60*60);
            //统计流失 时间
            $LossStartTime = date('Y-m-d H:i:s',$time+24*60*60);
            $LossEndTime   =  date('Y-m-d H:i:s',$time+24*60*60*($Day+1));
            //流失用户
            if($Channel != ''){
                $where = ' a.login_channel  = "'.$Channel.'"  and  a.`login_time` >= str_to_date("'.$StarTime.'","%Y-%m-%d %H:%i:%s")
                      and  a.`login_time` <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  and b.`playerid` is null ';
            }else{
                $where = 'a.`login_time` >= str_to_date("'.$StarTime.'","%Y-%m-%d %H:%i:%s")
                      and  a.`login_time` <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  and b.`playerid` is null ';
            }
            $Loss = $model
                  ->table('game_login_action as  a')
                  ->join('game_login_action as b  on  a.`playerid` = b.`playerid`
                                  and  b.`login_time` >= str_to_date("'.$LossStartTime.'","%Y-%m-%d %H:%i:%s")
                                  and  b.`login_time` <  str_to_date("'.$LossEndTime.'","%Y-%m-%d %H:%i:%s") ','left')
                  ->where($where)
                  ->field(array(
                   'distinct a.`playerid` as playerid',
                   'a.login_channel',
                  ))
                  ->select(false);
            $DataLoss = $model->query('
                        select
                            count(a.`playerid`) as Num,
                            elt(interval(a.`rmb`,0, 3,5,10,20,50,100,200,500,1000,2000,10000)
                              ,"less3",
                              "3to5", 
                              "5to10",
                              "10to20",
                              "50to100",
                              "100to200",
                              "200to500",
                              "500to1000",
                              "1000to2000",
                              "2000to10000",
                              "more10000") as Section
                        from
                            game_player as a  inner join ('.$Loss.') as b on  a.`playerid` = b.`playerid`
                        group by   Section

              ');

            foreach ($DataLoss as $k=>$v)  $DataLossSort[$v['Section']] = $v;
            return $DataLossSort;

      }
     /***
     * 非次日用户流失
     */
      public function WLossUsers($Day){
          //统计日登录的用户
          $model    =  new Model();
          $time     =  strtotime(date('Y-m-d H:i:s',time()));
          $StarTime =  date('Y-m-d H:i:s',$time-24*60*60*($Day+1));
          $EndTime  =  date('Y-m-d H:i:s',$time-24*60*60*($Day));
          //次日存在用户
          $LossStartTime = date('Y-m-d H:i:s',$time-24*60*60*($Day));
          $LossEndTime   = date('Y-m-d H:i:s',$time-24*60*60*($Day-1));
          //次日流失时间段
          $WLossStartTime = $LossEndTime;
          $WLossEndTime   =  date('Y-m-d H:i:s',$time);

          $Loss = $model
              ->table('game_login_action as  a')
              ->join('game_login_action as b  on  a.`playerid` = b.`playerid`
                                  and  b.`login_time` >= str_to_date("'.$LossStartTime.'","%Y-%m-%d %H:%i:%s")
                                  and  b.`login_time` <  str_to_date("'.$LossEndTime.'","%Y-%m-%d %H:%i:%s")')
              ->join('game_login_action as c  on  b.`playerid` = c.`playerid`
                                  and  c.`login_time` >= str_to_date("'.$WLossStartTime.'","%Y-%m-%d %H:%i:%s")
                                  and  c.`login_time` <  str_to_date("'.$WLossEndTime.'","%Y-%m-%d %H:%i:%s")','left')
              ->where('a.`login_time` >= str_to_date("'.$StarTime.'","%Y-%m-%d %H:%i:%s")
                                  and  a.`login_time` <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") and c.`playerid` is null')
              ->field(array(
                  'distinct a.`playerid` as playerid',
                  'a.login_channel',
              ))
              ->select(false);
          //次日开始流失的用户


          $DataLoss = $model->query('
                        select 
                           b.`login_channel` as Channel,
                           count(b.`playerid`) as WLoss,
                           sum(a.`rmb`) as WLossPrice
                        from 
                            game_player as a  inner join ('.$Loss.') as b on  a.`playerid` = b.`playerid`
                        group by     Channel 
                  
              ');

          foreach ($DataLoss as $k=>$v)  $DataLossSort[$v['Channel']] = $v;
          return $DataLossSort;


      }
      /***
      *  上个统计日 流失用户
      */
      public function Backflow($Day){
          //统计日登录的用户
          $model = new Model();
          $time = strtotime(date('Y-m-d H:i:s',time()-24*60*60));
          $StarTime =  date('Y-m-d H:i:s',$time-24*60*60*$Day);
          $EndTime  =  date('Y-m-d H:i:s',$time-24*60*60*($Day-1));
          //统计流失 时间
          $LossStartTime =  $EndTime;
          $LossEndTime   =  date('Y-m-d H:i:s',$time);
          //流失用户
          $Loss = $model
              ->table('game_login_action as  a')
              ->join('game_login_action as b  on  a.`playerid` = b.`playerid`
                                  and  b.`login_time` >= str_to_date("'.$LossStartTime.'","%Y-%m-%d %H:%i:%s")
                                  and  b.`login_time` <  str_to_date("'.$LossEndTime.'","%Y-%m-%d %H:%i:%s") ','left')
              ->where('a.`login_time` >= str_to_date("'.$StarTime.'","%Y-%m-%d %H:%i:%s")
                                  and  a.`login_time` <  str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  and b.`playerid` is null ')
              ->field(array(
                  'distinct a.`playerid` as playerid',
              ))
              ->select(false);
          //当前统计日时间
          $SameTime      =  strtotime(date('Y-m-d H:i:s',time()));
          $LossStartTime =  date('Y-m-d H:i:s',$SameTime-24*60*60*($Day-1));
          $LossEndTime   =  date('Y-m-d H:i:s',$SameTime);

          $Backflow = $model->query('
            select 
              count(distinct a.`playerid`) as Backflow, 
                a.`login_channel` as Channel
            from    
                game_login_action as a   
                inner join ('.$Loss.') as b on a.`playerid` = b.`playerid`
            where  
                    a.`login_time` >= str_to_date("'.$LossStartTime.'","%Y-%m-%d %H:%i:%s")
                    and  a.`login_time` <  str_to_date("'.$LossEndTime.'","%Y-%m-%d %H:%i:%s")       
            group by  Channel    
          
          
          ');

          foreach ($Backflow as $k=>$v)  $BackflowSort[$v['Channel']] = $v;
          return $BackflowSort;
      }



      public function  CalculationPrice($data){
             foreach ($data as $k=>$v){
                    $GroupLogin  =  explode(',',$v['Channel']);
                    $GroupLoss   =  explode(',',$v['GroupLoss']);
                    $Diff        =  array_diff($GroupLogin,$GroupLoss);
             }
      }

}