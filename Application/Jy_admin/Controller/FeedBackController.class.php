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
        $StartTime = date("Y-m-d",$time-15*60*60*24);
        $EndTime   =  date("Y-m-d",$time);
        $search['datemin']                   =      I('param.datemin',$StartTime,'trim');        //下单时间
        $search['datemax']                   =      I('param.datemax',$EndTime,'trim');        //下单时间
        $search['playerid']                  =      I('param.playerid','','intval');         //用户ID
        $search['Channel']                   =      I('param.Channel','','trim');        //渠道
        $search['Status']                    =      I('param.Status',0,'intval');         //状态
        $search['Type']                    =      I('param.Type',0,'intval');         //状态
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
            $where .= ' and `Channel`="'.$search['Channel'].'"';
        }
        //用户ID
        if ($search['playerid'] != 0 ){
            $where .= ' and `playerid`='.$search['playerid'];
        }else{
            $search['playerid'] = '';
        }
        //状态
        if ($search['Status'] != 0 ){
            $where .= ' and `Status`='.$search['Status'];
        }
        //起始时间
        if ($search['datemin'] != ''){
            $where .= ' and `DateTime`>= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        //结束时间
        if ($search['datemax'] != ''){
            $datemax = date("Y-m-d H:i:s",strtotime($search['datemax'])+24*60*60) ;
            $where .= ' and `DateTime` < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        $count =  M('log_feed_back')
                  ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catData = M('log_feed_back')
                   ->where($where)
                   ->field(array(
                        'Id',
                        'playerid',
                        'Status',
                        'PackageVersion',
                        'TxQq',
                        'Phone',
                        'Channel',
                        'VerSion',
                        'UpName',
                        'UpDateTime',
                        'DateTime',
                   ))
                   ->order('DateTime desc')
                   ->limit($page*$num,$num)
                   ->select();
        $this->assign('page',$show);
        $this->assign('Channel',$Channel);
        $this->assign('info',$catData);
        $this->assign('search',$search);
        $this->display('index');
    }
    //
    public  function authority(){
        $Id = I('param.Id',0,'intval');
        $obj = new \Common\Lib\func();
        $UserInfo = $this->userInfo;
        if($Id<=0){
            $obj->showmessage('非法操作');
        }
        $catData = M('log_feed_back')
                   ->where('Id = '.$Id.' and  IsDel = 1')
                   ->field(array(
                       'Id',
                       'playerid',
                       'Status',
                       'Type',
                       'Fcontent',
                       'Rcontent',
                       'TxQq',
                       'Phone',
                       'DateTime',
                   ))
                   ->find();
        if(IS_POST){
            $Rcontent = I('param.Rcontent','','trim');
            $db = M('log_feed_back');
            $UpData = $db
                      ->where('Id = '.$Id)
                      ->save(array(
                          'Rcontent'=>$Rcontent,
                          'Status'=>2,
                          'UpDateTime'=>date('Y-m-d H:i:s'),
                          'UpName'=>$UserInfo['name'],
                      ));
            if($UpData){
                $obj->showmessage('回复成功','/jy_admin/FeedBack/index');
            }else{
                $obj->showmessage('回复失败');
            }
        }
        $this->assign('info',$catData);
        $this->display('authority');
    }
}