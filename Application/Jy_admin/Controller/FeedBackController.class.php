<?php
/****
 *
 **/
namespace Jy_admin\Controller;
use Think\Controller;
class FeedBackController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $time = strtotime(date('Y-m-d',time()));
        $StartTime = date("Y-m-d",$time);
        $EndTime   =  date("Y-m-d",$time+24*60*60);
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');        //下单时间
        $search['datemax']                   =      I('param.datemax',$EndTime,'trim');        //下单时间
        $search['playerid']                  =      I('param.playerid','','intval');         //用户ID
        $search['Channel']                   =      I('param.Channel','','trim');        //渠道
        $search['Status']                    =      I('param.Status','','intval');         //状态
        $where = '1';
        //查询渠道
        $ChannelFiled = array(
            'account',
            'name',
        );
        $Channel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($ChannelFiled)
            ->select();
        //渠道
        if ($search['Channel'] != ''){
            $where .= ' and `PayChannel`="'.$search['Channel'].'"';
        }
        //用户ID
        if ($search['playerid'] != '' && $search['playerid'] != 0 ){
            $where .= ' and `playerid`='.$search['playerid'];
        }
        //支付状态
        if ($search['Status'] != '' && $search['Status'] != 0 ){
            $where .= ' and `Status`='.$search['Status'];
        }
        //起始时间
        if ($search['datemin'] != ''){
            $where .= ' and `FoundTime`>= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        //结束时间
        if ($search['datemax'] != ''){
            $datemax = date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60) ;
            $where .= ' and `FoundTime` < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $this->assign('Channel',$Channel);
        $this->assign('search',$search);
        $this->display('index');
    }
    //物品列表
    public  function authority(){

        $this->display('authority');
    }
}