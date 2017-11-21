<?php
/**
*   物品流水
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class SummaryGoodsController extends ComController {
    //列表
    public function index(){
        $page      = $this->page;
        //默认30天数据
        $time =  strtotime(date('Y-m-d',time()-24*60*60));
        $DayTime  = 24*60*60;
        $StartTime  = date('Y-m-d',$time-$DayTime*29);
        $EndTime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['Num']         = I('param.Num',30,'intval');
        $search['Channel']     = I('param.Channel','','trim');
        $search['VerSion']     = I('param.VerSion','','trim');
        $search['Reason']      = I('param.Reason','','trim');
        $search['Itemid']      = I('param.Itemid','','trim');
        $where = '1';
        //渠道列表
        $Channel = M('jy_admin_users')
                   ->where('channel = 2 and isdel = 1')
                   ->field(array(
                       'account',
                       'name',
                   ))
                   ->select();
        if($search['datemin'] != ''){
            $where .= ' and a.DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and a.DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['VerSion'] != ''){
            $where .= ' and a.VerSion = "'.$search['VerSion'].'"';
        }
        if($search['Channel'] != ''){
            $where .= ' and a.Channel = "'.$search['Channel'].'"';
        }
        if($search['Reason'] != ''){
            $where .= ' and a.Reason = '.$search['Reason'];
        }
        if($search['Itemid'] != ''){
            $where .= ' and a.Itemid = '.$search['Itemid'];
        }


        $Itemid  = M('jy_prop_list as b')
            ->join('summary_goods as a on b.Code = a.Itemid and '.$where,'left')
            ->field(array(
                'b.Code',
                'sum(a.Number) as Number',
                'b.Name',
            ))
            ->group('b.Code')
            ->select();


        $count  = M('summary_goods as a')
                  ->where($where)
                  ->count();

        $Page       = new \Common\Lib\Page($count,$search['Num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $catData = M('summary_goods as a')
                  ->where($where)
                  ->field(
                    array(
                        'a.UserNum',
                        'a.Reason',
                        'a.Channel',
                        'a.Ostype',
                        'a.Number',
                        'a.VerSion',
                        'a.Itemid',
                        'a.DateTime',
                    )
                  )->order('DateTime desc')
                  ->limit($page*$search['Num'],$search['Num'])
                  ->select();
        $show  = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('Channel',$Channel);
        $this->assign('Itemid',$Itemid);
        $this->assign('info',$catData);
        $this->display('index');
    }
    //到出excel
    public  function excelData(){
        $data       = I('param.data','','trim');
        $channel    = I('param.channel',2,'intval');
        $expTitle = "渠道数据";
        if($channel == 2){
            $expCellName = array(
                '渠道ID',
                '渠道名称',
                '报表日期',
                '新增用户',
                '付费金额',
                '注册ARPU',
                '活跃ARPU',
                '次日留存',
                '付费金额（老用户',
                '活跃用户',
                '付费转化',
                '付费用户（老用户）',
                '付费转化（老用户）',
                '订单数量',
                '2日留存',
                '3日留存',
                '7日留存',
                '15日留存',
                '30日留存',
            );
        }else{
            $expCellName = array(
                '渠道ID',
                '渠道名称',
                '报表日期',
                '账号新增',
                '设备新增',
                '付费金额',
                '注册ARPU',
                '活跃ARPU',
                '次日留存',
                '付费金额（老用户',
                '活跃用户',
                '付费转化',
                '付费用户（老用户）',
                '付费转化（老用户）',
                '订单数量',
                '2日留存',
                '3日留存',
                '7日留存',
                '15日留存',
                '30日留存',
            );
        }
        $this->exportExcel($expTitle,$expCellName,json_decode($data,true),$channel);
    }
    public function exportExcel($expTitle,$expCellName,$expTableData,$channel){
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
        if($channel == 2){
            $PHPExcel-> getActiveSheet()->getStyle( 'A1:S1')-> getFill() -> setFillType(\PHPExcel_Style_Fill :: FILL_SOLID);
            $PHPExcel-> getActiveSheet() -> getStyle('A1:S1') -> getFill() -> getStartColor() -> setARGB('#abd4e8');
        }else{
            $PHPExcel-> getActiveSheet()->getStyle( 'A1:T1')-> getFill() -> setFillType(\PHPExcel_Style_Fill :: FILL_SOLID);
            $PHPExcel-> getActiveSheet() -> getStyle('A1:T1') -> getFill() -> getStartColor() -> setARGB('#abd4e8');
        }
        foreach ($cellName as $k=>$v){
            $lenth = strlen($expCellName[$k]);
            $Sheet->getColumnDimension($v)->setWidth($lenth);

            $Sheet->setCellValue($v.'1',$expCellName[$k]);

        }
        foreach ($expTableData as $k=>$v){
            $i = $k+2;
            $Sheet->setCellValue('A'.$i,$v['GroupChannel']);
            $Sheet->setCellValue('B'.$i,$v['name']);
            $Sheet->setCellValue('C'.$i,$v['t']);
            if($channel == 2){
                $Sheet->setCellValue('D'.$i,$v['EquipmentRegNum']);
                $Sheet->setCellValue('E'.$i,$v['TotalMoney']);
                $Sheet->setCellValue('F'.$i,$v['RegArpu']);
                $Sheet->setCellValue('G'.$i,$v['ActiveArpu']);
                $Sheet->setCellValue('H'.$i,$v['UsersOneNum']."%");
                $Sheet->setCellValue('I'.$i,$v['OrderTotalOld']);
                $Sheet->setCellValue('J'.$i,$v['ActiveNum']);
                $Sheet->setCellValue('K'.$i,$v['PayConversion']);
                $Sheet->setCellValue('L'.$i,$v['UserPayNumOld']."%");
                $Sheet->setCellValue('M'.$i,$v['PayConversionOld']."%");
                $Sheet->setCellValue('N'.$i,$v['Success']);
                $Sheet->setCellValue('O'.$i,$v['UsersTowNum']."%");
                $Sheet->setCellValue('P'.$i,$v['UsersThreeNum']."%");
                $Sheet->setCellValue('Q'.$i,$v['UsersSevenNum']."%");
                $Sheet->setCellValue('R'.$i,$v['UsersFifteenNum']."%");
                $Sheet->setCellValue('S'.$i,$v['UsersThirtyNum']."%");
            }else{
                $Sheet->setCellValue('D'.$i,$v['RegNum']);
                $Sheet->setCellValue('E'.$i,$v['EquipmentRegNum']);
                $Sheet->setCellValue('F'.$i,$v['TotalMoney']);
                $Sheet->setCellValue('G'.$i,$v['RegArpu']);
                $Sheet->setCellValue('H'.$i,$v['ActiveArpu']);
                $Sheet->setCellValue('I'.$i,$v['UsersOneNum']."%");
                $Sheet->setCellValue('J'.$i,$v['OrderTotalOld']);
                $Sheet->setCellValue('K'.$i,$v['ActiveNum']);
                $Sheet->setCellValue('L'.$i,$v['PayConversion']);
                $Sheet->setCellValue('M'.$i,$v['UserPayNumOld']."%");
                $Sheet->setCellValue('N'.$i,$v['PayConversionOld']."%");
                $Sheet->setCellValue('O'.$i,$v['Success']);
                $Sheet->setCellValue('P'.$i,$v['UsersTowNum']."%");
                $Sheet->setCellValue('Q'.$i,$v['UsersThreeNum']."%");
                $Sheet->setCellValue('R'.$i,$v['UsersSevenNum']."%");
                $Sheet->setCellValue('S'.$i,$v['UsersFifteenNum']."%");
                $Sheet->setCellValue('T'.$i,$v['UsersThirtyNum']."%");
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