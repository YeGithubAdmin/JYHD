<?php
/***
* 生命周期价值
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class PeriodicValueController extends ComController {
    //列表
    public function index(){
        $page                  =    $this->page;
        $time                  =    date("Y-m-d",time()-24*60*60);
        $DateTime              =    $time;
        $time                  =    strtotime($time);
        $Statime               =    date('Y-m-d',$time-15*24*60*60);
        $Endtime               =    date('Y-m-d',$time);
        $search['datemin']     =    I('param.datemin',$Statime,'trim');
        $search['datemax']     =    I('param.datemax',$Endtime,'trim');
        $search['Channel']     =    I('param.Channel','','trim');
        $search['num']         =    I('param.num',30,'intval');
        $where = '1';
        //默认前15天数据
        if ($search['datemin'] != ''){
            $where .= ' and  DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $datemax =  date('Y-m-d',strtotime($search['datemax'] )+24*60*60);
            $where .= ' and  DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }

        if ($search['Channel'] != ''){
            $where .= ' and  Channel = "'.$search['Channel'].'"';
        }
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();



        $LogUsersLoss = M('log_users_loss');
        //总计
        $count        =  $LogUsersLoss
                          ->where($where)->field(
                                array(
                                    'count(Id) as Num',
                                    'sum(Loss) as Loss',
                                    'round(sum(Loss)/7,2) as CycleLt',
                                    'sum(LossPrice) as LossPrice',
                                    'round(sum(LossPrice)/sum(Loss),2) as CycleLtLtv',
                                    'sum(WLoss) as WLoss',
                                    'sum(WLossPrice) as WLossPrice',
                                    'round(sum(WLossPrice)/sum(WLoss),2) as WCycleLtLtv'
                                )
                            )
                            ->select();
        //列表
        $info         =  $LogUsersLoss
                         ->where($where)
                         ->field(
                             array(
                                 'DateTime',
                                 'Channel',
                                 'Loss',
                                 'round(Loss/7,2) as CycleLt',
                                 'LossPrice',
                                 'if(round(LossPrice/Loss,2),round(LossPrice/Loss,2),0) as CycleLtLtv',
                                 'WLoss',
                                 'WLossPrice',
                                 'if(round(WLossPrice/WLoss,2),round(WLossPrice/WLoss,2),0) as WCycleLtLtv'
                             )
                         )
                         ->limit($page* $search['num'],$search['num'])
                         ->select();
        $countNum     =  $count[0]['Num'];
        $Page       = new \Common\Lib\Page($countNum,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('Channel',$Channel);
        $this->assign('count',$count);
        $this->display('index');
    }
    //到出excel
    public  function excelData(){
        $data       = I('param.data','','trim');
        $channel    = I('param.channel',2,'intval');
        $expTitle = "生命周期价值";

            $expCellName = array(
                '日期',
                '渠道',
                '流失账号数（人）',
                '生命周期LT(人/天)',
                '流失账号付费金额（元）',
                '生命周期价值LTV（人/元）',
                '非次日流失账号数',
                '非次日流失账号付费金额（元）',
                '非次日流失LTV（人/元）',
            );

        $this->exportExcel($expTitle,$expCellName,json_decode($data,true),$channel);
    }
    public function exportExcel($expTitle,$expCellName,$expTableData){
        include JY_ROOT."PHPExcel/PHPExcel.php";
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA');
        //实例对象
        $PHPExcel = new \PHPExcel();
        //创建工作区
        $PHPExcel->createSheet(0);
        // 设置当前激活的工作表编号
        $PHPExcel->setActiveSheetIndex(0);
        // 获取当前激活的工作表
        $Sheet = $PHPExcel->getActiveSheet();
        //居中
        $PHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPExcel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        //设置背景样色
        $PHPExcel-> getActiveSheet()->getStyle( 'A1:T1')-> getFill() -> setFillType(\PHPExcel_Style_Fill :: FILL_SOLID);
        $PHPExcel-> getActiveSheet() -> getStyle('A1:T1') -> getFill() -> getStartColor() -> setARGB('#abd4e8');
        foreach ($cellName as $k=>$v){
            $Sheet->getColumnDimension($v)->setWidth(20);
            $Sheet->setCellValue($v.'1',$expCellName[$k]);
        }
        foreach ($expTableData as $k=>$v){
            $i = $k+2;
            $j = 0;
            foreach ($v as $key=>$val){
                $Sheet->setCellValue($cellName[$j].$i,$val);
                $j++;
            }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$expTitle.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
}