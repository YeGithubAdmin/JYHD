<?php
/***
*   渠道数据
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class ChannelDataController extends ComController {
    //列表
    public function index(){
        $userInfo  = $this->userInfo;
        $default   = $userInfo['default'];
        $channel   = $userInfo['channel'];
        $page      = $this->page;
        $lowerAdminUser = $this->lowerAdminUser;    //我的下级组
        $time = date("Y-m-d",time());

        $DateTime = $time;

        $time = strtotime($time);
        $Statime = date('Y-m-d',$time-15*24*60*60);
        $Endtime = date('Y-m-d',$time);

        $search['datemin']     = I('param.datemin',$Statime,'trim');
        $search['datemax']     = I('param.datemax',$Endtime,'trim');
        $search['num']         = I('param.num',30,'intval');
        $search['channel']     = I('param.channel','','trim');
        $model = new Model;

        $Channel = '';

        //判断管理还是运营
        $whereData = 'a.channel = 2 and a.Isdel = 1';
        if($channel == 2){
            $whereData .="  and  a.account = '".$userInfo['account']."'";
            $Channel = $userInfo['account'];
            //渠道
        }else{
            //管理
            if($default != 2){
                $lowerAdminUser[]   =   $userInfo['id'];
                $lowerAdminUser     =   implode(',',$lowerAdminUser);
                $whereData  .= ' and a.addId in('.$lowerAdminUser.')';
            }
            $ChannelListField = array(
                'a.Id',
                'a.name',
                'a.account',
            );
            $ChannelList = $model
                ->table('jy_admin_users as a')
                ->join('jy_channel_info as b on b.adminUserID = a.Id')
                ->where($whereData)
                ->field($ChannelListField)
                ->select();
            if ($search['channel'] != ''){
                $whereData .= ' and a.`account`="'.$search['channel'].'"';
                $Channel = $search['channel'];
            }

        }
        //默认前15天数据
        $datemin = date('Y-m-d H:i:s',strtotime($search['datemin']));
        $datemax = date('Y-m-d H:i:s',strtotime($search['datemax'])+24*60*60);
        if ($search['datemin'] != ''){
            $whereData .= ' and  c.DateTime >= str_to_date("'.$datemin.'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemax'] != ''){
            $whereData .= ' and  c.DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
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
        $ChannelData  =  D('ChannelData');
        $count        =  $ChannelData->NumberCount($whereData);
        $info         =  $ChannelData->Info($whereData,$page,$search['num']);

        $RealTime     =  $search['datemax'] == $DateTime ||   $search['datemin'] == $DateTime ?2:1 ;
        $countNum     =  $count[0]['Num'];

        if($RealTime == 2){
            $RealTimeData = $ChannelData->RealTimeData($Channel);
            if(!empty($RealTimeData)){
                $countNum = $countNum+count($RealTimeData);
                if($page < 1){
                    foreach ($RealTimeData as $k=>$v){
                        $count[0]['RegNum']        += $v['RegNum'];
                        $count[0]['UserPayNum']    += $v['UserPayNum'];
                        $count[0]['TotalMoney']    += $v['TotalMoney'];
                        $count[0]['OrderTotalOld'] += $v['OrderTotalOld'];
                        $count[0]['ActiveNum']     += $v['ActiveNum'];
                        $count[0]['UserPayNumOld'] += $v['UserPayNumOld'];
                        $count[0]['Success']       += $v['Success'];
                    }
                    $info = array_merge($RealTimeData,$info);
                }

            }

        }
        $Page       = new \Common\Lib\Page($countNum,$search['num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('ChannelList',$ChannelList);
        $this->assign('userinfo',$userInfo);
        $this->assign('info',$info);
        $this->assign('count',$count);
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


                $GroupChannel = array(
                    'JYHD_HUAWEI',
                    'JYHD_MI',
                    'JYHD_OPPO',
                    'JYHD_VIVO',
                );

                //活跃设备
                if(in_array($v['GroupChannel'],$GroupChannel)){
                    $Sheet->setCellValue('D'.$i,$v['RegNum']);
                }else{
                    $Sheet->setCellValue('D'.$i,$v['EquipmentRegNum']);
                }

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


                $GroupChannel = array(
                    'JYHD_HUAWEI',
                    'JYHD_MI',
                    'JYHD_OPPO',
                    'JYHD_VIVO',
                );

                //活跃设备
                if(in_array($v['GroupChannel'],$GroupChannel)){
                    $Sheet->setCellValue('E'.$i,$v['RegNum']);
                }else{
                    $Sheet->setCellValue('E'.$i,$v['EquipmentRegNum']);
                }
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