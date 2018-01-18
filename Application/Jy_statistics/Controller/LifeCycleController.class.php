<?php
/***
*   用户流失
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class LifeCycleController extends ComController {
    //列表
    public function index(){
        $time                  =    date("Y-m-d",time()-24*60*60);
        $DateTime              =    $time;
        $time                  =    strtotime($time);
        $Statime               =    date('Y-m-d',$time-15*24*60*60);
        $search['datemin']     =    I('param.datemin',$Statime,'trim');
        $search['Channel']     =    I('param.Channel','','trim');
        $where = '1';
        $Data = array(
              1=>array(
                  'Name' => '2-3天',
                   'Day' =>2,
              ),
              2=> array(
                  'Name' => '4-7天',
                  'Day'  => 4,
              ),
              3=> array(
                  'Name' => '8-14天',
                  'Day'  =>  8,
              ),
              4=>array(
                  'Name' =>  '15-30天',
                  'Day'  =>  16,
              ),
              5=>array(
                  'Name' => '31-90天',
                  'Day'  =>  60,
              ),
              6=>array(
                  'Name' => '90天-180天',
                  'Day'  =>  91,
              ),
              7=>array(
                  'Name' =>  '180-365天',
                  'Day'  =>   186,
              ),
              8=>array(
                  'Name' =>  '1年以上',
                  'Day'  =>  365,
              ),
        );
        $LossUsers = D('LossUsers');
        $info = array();
        foreach ($Data as $k=>$v){
            $catData = $LossUsers->LifeCycle($v['Day'],$search['datemin'], $search['Channel'] );
            $Data[$k]['Rate']   =  $catData[0]['Rate'];
            $Data[$k]['Loss']   =  $catData[0]['loss']?$catData[0]['loss']:0;
            $Data[$k]['Num']    =  $catData[0]['num']?$catData[0]['num']:0;
        }
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();



        $this->assign('search',$search);
        $this->assign('info',$Data);
        $this->assign('Channel',$Channel);
        $this->display('index');
    }
    //到出excel
    public  function excelData(){
        $data       = I('param.data','','trim');
        $expTitle = "流失回流";

            $expCellName = array(
                '日期',
                '渠道',
                '流失账号数（人）',
                '流失率',
                '非次日流失账号数',
                '非次日流失率',
                '回流账号数（人）',
                '生命周期LT（人/天）',
                '非次日生命周期（人/天）',
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