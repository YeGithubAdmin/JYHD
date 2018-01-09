<?php
/**
 *   用户留存
 */
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class UsersRetainedController extends ComController {
    //列表
    public function index(){
        $page      = $this->page;
        $num       = $this->num;
        //默认30天数据
        $time =  strtotime(date('Y-m-d',time()-24*60*60));
        $DayTime  = 24*60*60;
        $StartTime  = date('Y-m-d',$time-$DayTime*29);
        $EndTime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['Channel']     = I('param.Channel',1,'trim');
        $search['Num']         = I('param.Num',$num,'trim');
        $search['Type']         = I('param.Type',1,'trim');
        $where = '1';
        //渠道列表
        $UsersRetained = D('UsersRetained');
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        if($search['datemin'] != ''){
            $where .= ' and DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['Channel'] != 1){
            $where .= ' and Channel = "'.$search['Channel'].'"';
        }
        if( $search['Type'] == 1){
            if($search['Channel'] == 1){
                $count  = $UsersRetained->GlobalCountReg($where);
                $catData = $UsersRetained->GlobalInfoReg($where,$page,$search['Num']);
            }else{
                $count  = $UsersRetained->NumberCount($where);
                $catData = $UsersRetained->Info($where,$page,$search['Num']);
            }
        }
        $Page       = new \Common\Lib\Page($count,$search['Num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show  = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('Channel',$Channel);
        $this->assign('info',$catData);
        $this->display('index');
    }

    //到出excel
    public  function excelData(){
        $data       = I('param.data','','trim');
        $channel    = I('param.channel',2,'intval');
        $type       = I('param.type',1,'intval');
        if($type == 1){
            $expTitle = "注册留存";
        }

        $expCellName = array(
            '日期',
            '渠道',
            '次留',
            '3日留存',
            '7日留存',
            '月留（30天）',

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
            $Sheet->setCellValue('A'.$i,$v['DateTime']);
            if(empty($v['Channel'])) {
                $Sheet->setCellValue('B' . $i, '全渠道');
            }else{
                $Sheet->setCellValue('B' . $i, $v['Channel']);
            }
            $Sheet->setCellValue('C'.$i,$v['UsersOneNum'].'%');
            $Sheet->setCellValue('D'.$i,$v['UsersThreeNum'].'%');
            $Sheet->setCellValue('E'.$i,$v['UsersSevenNum'].'%');
            $Sheet->setCellValue('F'.$i,$v['UsersThirtyNum'].'%');

        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$expTitle.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }


}