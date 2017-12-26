<?php
/****
*  CDK 列表
**/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;

class CdkListController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $search['Status']    = I('param.Status',0,'intval');
        $search['Code']      = I('param.Code',0,'intval');
        $search['Hair']      = I('param.Hair',0,'intval');
        $search['StartTime'] = I('param.StartTime','','trim');
        $search['EndTime']   = I('param.EndTime','','trim');
        $search['Cid']       = I('param.Cid',0,'intval');
        $search['playerid']  = I('param.playerid',0,'intval');
        $where = '1';
        //查询活动
        $CatConfigure = M('conf_cdk_configure')
                        ->field(array(
                            'Aname',
                            'Id',
                        ))->select();
        //礼包
        $CatPakeList  = M('conf_ckd_good_continuity')
                       ->where('Status = 2')
                       ->field(
                           array(
                               'Aname',
                               'Code',
                           )
                       )->select();

        if($search['Code'] != 0){
            $where .= '  and  `Code`='.$search['Code'];
        }
        if($search['Status'] != 0){
            $where .= '  and  `Status`='.$search['Status'];
        }
        if($search['Hair'] != 0){
            $where .= '  and  `Hair`='.$search['Hair'];
        }
        if($search['Cid'] != 0){
            $where .= '  and  `Cid`='.$search['Cid'];
        }
        if($search['playerid'] != 0){
            $where .= '  and  `playerid`='.$search['playerid'];
        }else{
            $search['playerid'] = '';
        }
        if($search['StartTime'] != ''){
            $where .= '  and  `StartTime` >=  str_to_date("'.$search['StartTime'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['EndTime'] != ''){
            $where .= '  and  `EndTime`  <= str_to_date("'.$search['EndTime'].'","%Y-%m-%d %H:%i:%s")';
        }
        $count  = M('conf_cdk_list')
                  ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $Field = array(
            'Id',
            'CDK',
            'Code',
            'Cid',
            'Hair',
            'playerid',
            'StartTime',
            'EndTime',
            'UpId',
            'UseTime',
            'UpName',
            'Dateime',
        );
        $catData = M('conf_cdk_list')
            ->where($where)
            ->limit($page*$num,$num)
            ->field($Field)
            ->order('Code asc')
            ->select();
        $this->assign('page',$show);
        $this->assign('info',$catData);
        $this->assign('CatConfigure',$CatConfigure);
        $this->assign('CatPakeList',$CatPakeList);
        $this->assign('search',$search);
        $this->display('index');
    }


}