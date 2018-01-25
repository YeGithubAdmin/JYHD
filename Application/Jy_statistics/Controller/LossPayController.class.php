<?php
/***
*   用户流失 - 付费金额
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class LossPayController extends ComController {
    //列表
    public function index(){
        $SameDay = date('Y-m-d',time()-7*24*60*60);
        $search['datemin']     =    I('param.datemin',$SameDay,'trim');
        $search['Channel']     =    I('param.Channel','','trim');
        $LossUsers = D('LossUsers');
        $CatDate = $LossUsers->LossUsers(7,$search['datemin'],$search['Channel']);
        $Section = array(
            'less3'=>array(
                   'Name'=>'小于3'
            ),
            '3to5'=>array(
                'Name'=>'3-5'
            ),
            '5to10'=>array(
                'Name'=>'5-10'
            ),
            '10to20'=>array(
                'Name'=>'10-20'
            ),
            '50to100'=>array(
                'Name'=>'20-50'
            ),
            '100to200'=>array(
                'Name'=>'50-100'
            ),
            '200to500'=>array(
                'Name'=>'100-200'
            ),
            '500to1000'=>array(
                'Name'=>'200-500'
            ),
            '1000to2000'=>array(
                'Name'=>'500-1000'
            ),
            '2000to10000'=>array(
                'Name'=>'2000-10000'
            ),
            'more10000'=>array(
                'Name'=>'大于10000'
            ),
        );
        $LossNum = 0;
        foreach ($Section as $k=>$v){
            if($CatDate[$k]){
                $Section[$k]['Num'] = $CatDate[$k]['Num'];
                $LossNum = $LossNum+$CatDate[$k]['Num'];
            }else{
                $Section[$k]['Num'] = 0;
            }
        }
        foreach ($Section as $k=>$v){
            $Rete = $v['Num']/$LossNum;
            $Section[$k]['Rate'] =  $Rete?round($Rete*100,2):"0.00%";
        }
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        $Section = array_values($Section);
        $this->assign('search',$search);
        $this->assign('info',$Section);
        $this->assign('Channel',$Channel);
        $this->display('index');


    }
    //到出excel
    public  function excelData(){
        $data       = I('param.data','','trim');
        $expTitle = "用户流失分析-付费金额";

            $expCellName = array(
                '付费金额（元）',
                '账号数',
                '百分比',
            );
        $this->exportExcel($expTitle,$expCellName,json_decode($data,true),25);
    }

    public function exportExcel($expTitle,$expCellName,$expTableData,$setWidth = 20){
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