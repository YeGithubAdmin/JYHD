<?php
/***
*   活跃玩家分析
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class UsersFishController extends ComController {

    public  function  index(){

         $Data = M('game_player as a')
                ->join('game_account as c on a.playerid = c.playerid')
                ->where('a.rmb > 1')
                ->field(array(
                    'c.reg_channel as Channel',
                    'count(a.playerid) Num',
                    'elt(interval(a.`rmb`,1, 50,100,200,300,500,1000,2000,)
                              ,
                              "less0",
                              "50to100",
                              "100to200",
                              "1000to2000",
                              "2000to3000",
                              "3000to4000",
                              "4000to5000",
                              "more5000") as Section'
                ))
                ->group('Channel,Section')
                ->select();
           //查询渠道



          $catChannel = M('jy_admin_users')
                        ->field(array(
                            'account',
                            'name',
                        ))
                        ->where('channel = 2  and isdel = 1')
                        ->select();
          foreach ($Data as $k=>$v) {
              $DataSort[$v['Channel'].$v['Section']] = $v;
          }

          $info = array();
          foreach ($catChannel as $k=>$v){
              $catChannel[$k]['less0']       = 0;
              $catChannel[$k]['1to100']      = 0;
              $catChannel[$k]['100to1000']   = 0;
              $catChannel[$k]['1000to2000']  = 0;
              $catChannel[$k]['2000to3000']  = 0;
              $catChannel[$k]['3000to4000']  = 0;
              $catChannel[$k]['4000to5000']  = 0;
              $catChannel[$k]['more5000']    = 0;
          }

         foreach ($catChannel as $k=>$v){
                foreach ($v as $key=>$val){
                    if($DataSort[$v['account'].$key]){
                        $catChannel[$k][$key] =  $DataSort[$v['account'].$key]['Num'];
                    }
                }
         }
        print_r($catChannel);die;
        $ComFun = D('ComFun');


        $expTitle = "数据表";
        $expCellName = array(
            '渠道号',
            '渠道',
            '0',
            '1到100',
            '100到1000',
            '1000到2000',
            '2000到3000',
            '3000到4000',
            '4000到5000',
            '大于5000',
        );

        $ComFun->exportExcel($expTitle,$expCellName,$catChannel);




    }

    public function UsersNumExcel(){


    }
    /***
    * 游戏天数
    */
    public function  GameDay(){
        $time       = date("Y-m-d",time());
        $time       = strtotime($time);
        $Statime    = date('Y-m-d',$time-15*24*60*60);
        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['Channel']     = I('param.Channel','','trim');

        $Data = array(
         1=>array(
             'Name'=>'2-3天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         2=>array(
             'Name'=>'4-7天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         3=>array(
             'Name'=>'8-14天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         4=>array(
             'Name'=>'15-30天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         5=>array(
             'Name'=>'31-90天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         6=>array(
             'Name'=>'90天-180天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         7=>array(
             'Name'=>'180-365天',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
         8=>array(
             'Name'=>'1年以上',
             'StartTime'=>'',
             'EndTime'=>'',
         ),
     );





    }
    /***
    * 区域情况
    */
    public function region(){

    }
}