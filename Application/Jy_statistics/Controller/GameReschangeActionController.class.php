<?php
/****
*  用户属性物品流水
**/
namespace Jy_statistics\Controller;
use Protos\PBS_GetGameNumerical;
use Protos\PBS_GetGameNumericalReturn;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use RedisProto\RPB_PlayerData;
use Think\Controller;
use Think\Model;

class GameReschangeActionController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        //默认当天
        $Obj = new \Common\Lib\func();


        $search['playerid']                  =      I('param.playerid','','trim');

        if(empty($search['playerid']  )){
            $Obj->showmessage('非法操作');
        }



        $search['datemin']                   =      I('param.datemin',date('Y-m-d',time()),'trim');
        $search['Reason']                    =      I('param.Reason','','trim');

        $search['Num']                       =      I('param.Num',0,'intval');                    //条数
        $search['Prop']                       =      I('param.Prop','','intval');                    //条数
        $num =  $search['Num'] == 0? $num: $search['Num'] ;
        $where = 'playerid = '.$search['playerid'];

        //时间范围
        if($search['datemin']  != '' ){
            $where .= ' and   `opt_time` >=  str_to_date("'.$search['datemin'].'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['datemin']  != '' ){
            $datemax  =   date("Y-m-d H:i:s",strtotime($search['datemin'])+24*60*60);
            $where .= ' and   `opt_time` < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['Reason']  != '' ){
            $where .= ' and   `reason` =  '.$search['Reason'] ;
        }

        if($search['Prop']  != '' ){
            $where .= ' and   `itemid` =  '.$search['Prop'] ;
        }





        if(strtotime($search['datemin']) > strtotime(date('Y-m-d',time())) ){
            $info  = array();
            $count = 0;
        }elseif(strtotime($search['datemin']) < strtotime('2018-01-29')){
            $info  = array();
            $count = 0;
        }else{

            $count  =M('game_reschange_action_'.$search['datemin'])
                ->where($where)
                ->count();

            $infoField = array(
                'mdate',
                'room_level',
                'gold_pool',
                'gold_pump',
                'produce_gold',
                'consume_gold',
                'produce_fish_card',
                'produce_score',
                'produce_bomb_cu',
                'produce_bomb_ag',
                'produce_bomb_au',
                'date_format(mdate,"%Y%m%d") as T'
            );
            $info = M('game_reschange_action_'.$search['datemin'])
                ->where($where)
                ->limit($page*$num,$num)
                ->order('opt_time asc')
//                ->field($infoField)
                ->select();
        }


        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('search',$search);
        $this->display('index');
    }




}