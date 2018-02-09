<?php
/***
*   整体概况KPI
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class WholeKpiController extends ComController {
    //列表
    public function index(){
        $page      = $this->page;
        $time = date("Y-m-d",time());
        $DateTime = $time;
        $time = strtotime($time);
        $Statime = date('Y-m-d',$time-15*24*60*60);
        $Endtime = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['datemax']     = I('param.datemax',$Endtime,'trim');
        $search['num']         = I('param.num',30,'intval');
        //判断管理还是运营
        $whereData = '1';
        //默认前15天数据
        $datemin = date('Y-m-d H:i:s',strtotime($search['datemin']));
        $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);
        if ($search['datemin'] != ''){
            $whereData .= ' and  DateTime >= str_to_date("'.$datemin.'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $whereData .= ' and  DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        /***
        *'渠道ID',    GroupChannel
        *'渠道名称',  name
        *'报表日期',  t
        *'新增用户',  RegNum
        *'付费金额',  TotalMoney
        *'注册ARPU',  RegArpu
        *'活跃ARPU',  ActiveArpu
        *'次日留存',  UsersOneNum
        *'付费金额（老用户', OrderTotalOld
        *'活跃用户', ActiveNum
        *'付费转化', PayConversion
        *'付费用户（老用户）', UserPayNumOld
        *'付费转化（老用户）', PayConversionOld
        *'订单数量',  Success
        *'2日留存',  UsersTowNum
        *'3日留存', UsersThreeNum
        *'7日留存',  UsersSevenNum
        *'15日留存', UsersFifteenNum
        *'30日留存', UsersThirtyNum
        *
        **********/
        $ChannelData  =  D('WholeKpi');
        $count        =  $ChannelData->NumberCount($whereData);
        $info         =  $ChannelData->Info($whereData,$page,$search['num']);
        $RealTime     =  $search['datemax'] == $DateTime ||   $search['datemin'] == $DateTime ?2:1 ;
        $countNum     =  $count[0]['Num'];
        if($RealTime == 2){
            $RealTimeData = $ChannelData->RealTimeData();
            if(!empty($RealTimeData)){
                $countNum = $countNum+count($RealTimeData);
                if($page < 1){
                    $RealTimeDataSort[0] = $RealTimeData;
                    $info = array_merge($RealTimeDataSort,$info);
                }
            }
        }

        $allData = array();
        //汇总

        foreach ($info as $k=>$v){
            $allData['EquipmentActNum'] += $v['EquipmentActNum'];
            $allData['ActiveNum']       += $v['ActiveNum'];
            $allData['EquipmentRegNum'] += $v['EquipmentRegNum'];
            $allData['RegNum']          += $v['RegNum'];
            $allData['UsersOneNum']     += $v['UsersOneNum'];
            $allData['UsersThreeNum']   += $v['UsersThreeNum'];
            $allData['UsersSevenNum']   += $v['UsersSevenNum'];
            $allData['UserPayNum']      += $v['UserPayNum'];
            $allData['First']           += $v['First'];
            $allData['TotalMoney'] += $v['TotalMoney'];
            $allData['ActiveArppu'] += $v['ActiveArppu'];
            $allData['PayArppu'] += $v['PayArppu'];

        }

            $allData['EquipmentActNum']     = $allData['EquipmentActNum']/count($info);
            $allData['ActiveNum']           = $allData['ActiveNum']/count($info);
            $allData['EquipmentRegNum']     = $allData['EquipmentRegNum']/count($info);
            $allData['RegNum']              = $allData['RegNum']/count($info);
            $allData['UsersOneNum']         = $allData['UsersOneNum']/count($info);
            $allData['UsersThreeNum']       = $allData['UsersThreeNum']/count($info);
            $allData['UsersSevenNum']       = $allData['UsersSevenNum']/count($info);
            $allData['UserPayNum']          = $allData['UserPayNum']/count($info);
            $allData['First']               = $allData['First']/count($info);
            $allData['ActiveArppu']         = $allData['ActiveArppu']/count($info);
            $allData['PayArppu']            = $allData['PayArppu']/count($info);
        $Page       = new \Common\Lib\Page($countNum,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('count',$count);
        $this->assign('allData',$allData);
        $this->display('index');
    }
    //到出excel
    public  function excelData(){
        $data       = I('param.data','','trim');
        $channel    = I('param.channel',2,'intval');
        $expTitle = "整体概况KPI";

            $expCellName = array(
                '日期',
                '总设备激活',
                '活跃账号DAU',
                '新增设备激活',
                '新增账号',
                '次留',
                '3日留存',
                '7日留存',
                '付费总账号',
                '新增付费账号',
                '付费总额',
                '活跃ARPU',
                '付费ARPPU',
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
            $lenth = strlen($expCellName[$k]);
            $Sheet->getColumnDimension($v)->setWidth(20);

            $Sheet->setCellValue($v.'1',$expCellName[$k]);

        }
        foreach ($expTableData as $k=>$v){
            $i = $k+2;
            $Sheet->setCellValue('A'.$i,$v['t']);
                $Sheet->setCellValue('B'.$i,$v['EquipmentActNum']);
                $Sheet->setCellValue('C'.$i,$v['ActiveNum']);
                $Sheet->setCellValue('D'.$i,$v['EquipmentRegNum']);
                $Sheet->setCellValue('E'.$i,$v['RegNum']);
                $Sheet->setCellValue('F'.$i,round($v['UsersOneNum']*100,2)."%");
                $Sheet->setCellValue('G'.$i,round($v['UsersThreeNum']*100,2)."%");
                $Sheet->setCellValue('H'.$i,round($v['UsersSevenNum']*100,2)."%");
                $Sheet->setCellValue('I'.$i,$v['UserPayNum']);
                $Sheet->setCellValue('J'.$i,$v['First']);
                $Sheet->setCellValue('K'.$i,round($v['TotalMoney'],2));
                $Sheet->setCellValue('L'.$i,round($v['ActiveArppu'],2));
                $Sheet->setCellValue('M'.$i,round($v['PayArppu'],2));
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$expTitle.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
}