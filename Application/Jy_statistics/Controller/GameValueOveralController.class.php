<?php
/****
*  游戏数值 全局
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

class GameValueOveralController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $Day = 24*60*60;
        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date("Y-m-d",$time-$Day*29);
        $EndTime   =  date("Y-m-d",$time);
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');                 //注册时间
        $search['datemax']                   =      I('param.datemax',$EndTime,'trim');                 //注册时间
        $search['Status']                    =      I('param.Status',0,'intval');                       //游戏状态
        $search['num']                       =      I('param.num',0,'intval');                         //条数
        $num =  $search['num'] == 0? $num: $search['num'] ;
        $where = '1';
        $SummaryGoldWhere = 'Reason in(3,7,8,9,20) and Itemid = 8';
        $SummaryFishWhere = 'Reason = 6 AND  Itemid = 6';
        //注册时间
        if($search['datemin']  != '' ){
            $where .= ' and   `mdate` >=  str_to_date("'.$search['datemin'].'","%Y-%m-%d  %H:%i:%s") ';
            $SummaryGoldWhere .= ' and   `DateTime` >=  str_to_date("'.$search['datemin'].'","%Y-%m-%d  %H:%i:%s") ';
            $SummaryFishWhere .= ' and   `DateTime` >=  str_to_date("'.$search['datemin'].'","%Y-%m-%d  %H:%i:%s") ';
        }
        if($search['datemax']  != '' ){
            $datemax  =   date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60);
            $where .= ' and   `mdate` < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
            $SummaryGoldWhere .= ' and   `DateTime` < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
            $SummaryFishWhere .= ' and   `DateTime` < str_to_date("'.$datemax.'","%Y-%m-%d  %H:%i:%s") ';
        }
        $count  =M('game_numerical')
                ->where($where)
                ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        //发放的金币
        $SummaryGold  =  M('summary_goods')
                         ->where($SummaryGoldWhere)
                         ->field(array(
                            'sum(Number) as Gold',
                            'date_format(DateTime,"%Y%m%d") as T'
                         ))
                         ->group('T')
                         ->select();
        //兑出的鱼卷
        $SummaryFish  =  M('summary_goods')
                         ->where($SummaryFishWhere)
                         ->field(array(
                            'sum(Number) as Fish',
                            'date_format(DateTime,"%Y%m%d") as T'
                         ))
                         ->group('T')
                         ->select();



        $SummaryGoldSort = array();
        $SummaryFishSort = array();

        foreach ($SummaryGold as $k=>$v) $SummaryGoldSort[$v['T']] = $v;
        foreach ($SummaryFish as $k=>$v) $SummaryFishSort[$v['T']] = $v;

        //
        $infoField = array(
            'mdate',
            '(produce_gold_1+produce_gold_2+produce_gold_3+produce_gold_4) as produce_gold',
            '(consume_gold_1 + consume_gold_2 + consume_gold_3 +consume_gold_4) as consume_gold',
            '(fish_card_1+fish_card_2+fish_card_3+fish_card_4) as fish_card',
            '(bomb_1+bomb_2+bomb_3+bomb_4) as bomb',
            '(score_1+score_2+score_3+score_4) as score',
            '(gold_pump_1+gold_pump_2+gold_pump_3+gold_pump_4) as gold_pump',
            'boss_award_pool',
            'date_format(mdate,"%Y%m%d") as T'
        );

        $info = M('game_numerical')
                ->where($where)
                ->limit($page*$num,$num)
                ->order('mdate desc')
                ->field($infoField)
                ->select();
        foreach ($info as $k=>$v){
            if($SummaryGoldSort[$v['T']]){
                $info[$k]['Gold'] =   $SummaryGoldSort[$v['T']]['Gold'];
            }else{
                $info[$k]['Gold'] =   0;
            }
            if($SummaryFishSort[$v['T']]){
                $info[$k]['Fish'] =   $SummaryFishSort[$v['T']]['Fish'];
            }else{
                $info[$k]['Fish'] =   0;
            }

        }

//         dump($info);

        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('search',$search);
        $this->display('index');
    }
}