<?php
namespace Jy_script\Controller;
use Think\Controller;
use Think\Model;
class DataController extends Controller {
    public function index(){
        $time = strtotime('2018-01-13');
        $StartTime = date('Y-m-d H:i:s',$time);
        $EndTime   =  date('Y-m-d H:i:s',$time+24*60*60);
        $where = 'login_channel = "JYHD_HUAWEI"  and reason in (8,21,22,19) and  opt_time < str_to_date("'.$EndTime.'","%Y-%m-%d  %H:%i:%s") 
        and  opt_time >= str_to_date("'.$StartTime.'","%Y-%m-%d  %H:%i:%s")';
        $catData = $this->CatData($where);

        $Data = array(
            array(
                'reason'=>8,
                'name'=>'签到',
            ),
            array(
                'reason'=>19,
                'name'=>'抽奖',
            ),
            array(
                'reason'=>21,
                'name'=>'在线奖励',
            )
            ,
            array(
                'reason'=>22,
                'name'=>'破产奖励',
            ),
        );

        foreach ($Data as $k=>$v){
            if($catData[$v['reason']]){
                $Data[$k]['UserNum'] = $catData[$v['reason']]['UserNum'];
                if($v['reason'] == 8){
                    $Data[$k]['Num'] = $catData[$v['reason']]['UserNum'];
                }else{
                    $Data[$k]['Num'] = $catData[$v['reason']]['Num'];
                }
            }else{
                $Data[$k]['UserNum'] = 0;
                $Data[$k]['Num']     = 0;
            }
        }

        $expTitle = "游戏币方法-2018-01-13";
        $expCellName = array(
            '类型值',
            '名称',
            '人数',
            '次数',

        );

        $this->exportExcel($expTitle,$expCellName,$Data);
    }

    public function CatData($where){
        $catData = M('game_reschange_action')
                   ->where($where)
                   ->field(
                       array(
                           'count(distinct playerid) as UserNum',
                           'count(playerid) as Num',
                           'reason',
                       )
                   )
                    ->group('reason')
                   ->select();
        foreach ($catData as $k=>$v) $catDataSort[$v['reason']] = $v;
        return $catDataSort;
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