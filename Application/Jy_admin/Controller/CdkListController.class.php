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
            'Status',
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

    //到出excel
    public  function excelData(){
        $ObjFun = new \Common\Lib\func();
        $data       = I('param.data','','trim');
        if($data == ''){
            $ObjFun->showmessage('操作异常');
        }
        $search = json_decode($data,true);

        $where = '1';
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


        $Field = array(
            'CDK',
            'Code',
            'StartTime',
            'EndTime',
            'UpName',
            'Dateime',
        );
        $catData = M('conf_cdk_list')
            ->where($where)
            ->field($Field)
            ->order('Code asc')
            ->select();
        $expTitle = "CDK";
        $expCellName = array(
            'CDK',
            '礼包编码',
            '起始时间',
            '结束时间',
            '产出人',
            '产出时间',
        );
        $this->exportExcel($expTitle,$expCellName,$catData);
    }
    public function exportExcel($expTitle,$expCellName,$expTableData){
        include JY_ROOT."PHPExcel/PHPExcel.php";
        $xlsTitle = iconv('utf-8', 'gb2312',$expTitle);//文件名称
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M');
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
        //设置宽度
        foreach ($cellName as $k=>$v){
            $lenth = strlen($expCellName[$k]);
            $Sheet->getColumnDimension($v)->setWidth(25);
            $Sheet->setCellValue($v.'1',$expCellName[$k]);
        }
        foreach ($expTableData as $k=>$v){
            $i = $k+2;
            $Sheet->setCellValue('A'.$i,$v['CDK']);
            $Sheet->setCellValue('B'.$i,$v['Code']);
            $Sheet->setCellValue('C'.$i,$v['StartTime']);
            $Sheet->setCellValue('D'.$i,$v['EndTime']);
            $Sheet->setCellValue('E'.$i,$v['UpName']);
            $Sheet->setCellValue('F'.$i,$v['Dateime']);

        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$expTitle.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

}