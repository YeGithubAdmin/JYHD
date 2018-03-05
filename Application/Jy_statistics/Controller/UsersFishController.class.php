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
                ->join('game_item as b on a.playerid = b.playerid')
                ->join('game_account as c on a.playerid = c.playerid')
                ->where('a.rmb >= 1')
                ->field(array(
                    'c.reg_channel as Channel',
                    'sum(b.item6_num) as Num',
                    'elt(interval(a.`rmb`,1,50,100,200,300,500,1000,2000)
                              ,
                              "less0",
                              "50to100",
                              "100to200",
                              "200to300",
                              "300to500",
                              "500to1000",
                              "1000to2000",
                              "more2000") as Section'
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
              $catChannel[$k]['less0']        = 0;
              $catChannel[$k]['50to100']      = 0;
              $catChannel[$k]['100to200']     = 0;
              $catChannel[$k]['200to300']     = 0;
              $catChannel[$k]['300to500']     = 0;
              $catChannel[$k]['500to1000']    = 0;
              $catChannel[$k]['1000to2000']   = 0;
              $catChannel[$k]['more2000']     = 0;
         }
         foreach ($catChannel as $k=>$v){
                foreach ($v as $key=>$val){
                    if($DataSort[$v['account'].$key]){
                        $catChannel[$k][$key] =  $DataSort[$v['account'].$key]['Num'];
                    }
                }
         }
         $ComFun = D('ComFun');
         $expTitle = "付费渔劵总数";
         $expCellName = array(
            '渠道号',
            '渠道',
            '50一下',
            '50到100',
            '100到200',
            '200到300',
            '300到500',
            '500到1000',
            '1000到2000',
            '大于2000',
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