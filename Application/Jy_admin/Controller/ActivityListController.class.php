<?php
/****
*   活动列表
**/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;

class ActivityListController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        //渠道号
        $search['Status']  = I('param.Status',0,'intval');
        $search['Channel'] = I('param.Channel',0,'intval');
        $search['Type']    = I('param.Type',0,'intval');
        $where = '1';
        if($search['Channel'] != 0 ){
            $where  .= '  and   b.id  = '.$search['Channel'];
        }
        if( $search['Status'] != 0 ){
            $where  .= '  and   a.Status  ='.$search['Status'];
        }
        if( $search['Type'] != 0 ){
            $where  .= '  and   a.Type  ='.$search['Type'];
        }
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($catChannelField)
            ->select();
        $count  = M('jy_activity_father_list as a')
            ->join('jy_admin_users as b on a.Channel = b.id and b.channel = 2')
            ->where($where)
            ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $activityFatherlistFile = array(
            'a.Id',
            'a.Type',
            'a.Title',
            'b.name',
            'a.Status',
            'a.AddUpStartTime',
            'a.AddUpEndTime',
            'a.ShowStartTime',
            'a.ShowEndTime',
            'a.Describe',
        );
        $info = M('jy_activity_father_list as a')
            ->join('jy_admin_users as b on a.Channel = b.id and b.channel = 2')
            ->where($where)
            ->limit($page*$num,$num)
            ->field($activityFatherlistFile)
            ->select();

        $this->assign('page',$show);
        $this->assign('catChannel',$catChannel);
        $this->assign('info',$info);
        $this->assign('search',$search);
        $this->display('index');
    }
    //添加
    public  function add(){
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($catChannelField)
            ->select();
        $this->assign('catChannel',$catChannel);
        $this->display('add');
    }

    public function AddAjax(){
        $result = 1;
        if(!IS_POST){
            $result = 0;
            goto response;
        }
        //是否复制
        $Cp                         = I('param.Cp',1,'intval');
        $CpChannel                  = I('param.CpChannel',1,'intval');
        $Type                       =       I('param.Type',1,'intval');                 //活动类型  1-累计充值 2-单笔充值   3-循环充值    4-图片类型
        $Channel                    =       I('param.Channel',0,'intval');
        $Model = new Model();
        if($Cp == 1){
            $Title                  =       I('param.Title','','trim');                //标题
            $AddUpStartTime         =       I('param.AddUpStartTime','','trim');       //计费开始时间
            $AddUpEndTime           =       I('param.AddUpEndTime','','trim');         //计费结束时间
            $ShowStartTime          =       I('param.ShowStartTime','','trim');        //显示开始时间
            $ShowEndTime            =       I('param.ShowEndTime','','trim');          //显示结束时间
            $Describe               =       I('param.Describe','','trim');
            $dataActivityFatherList = array(
                'Type'              =>      $Type,
                'Title'             =>      $Title,
                'Channel'           =>      $Channel,
                'AddUpStartTime'    =>      $AddUpStartTime,
                'AddUpEndTime'      =>      $AddUpEndTime,
                'ShowStartTime'     =>      $ShowStartTime,
                'ShowEndTime'       =>      $ShowEndTime,
                'Describe'          =>      $Describe,
            );
            $addActivityFatherList = $Model->table('jy_activity_father_list')
                ->add($dataActivityFatherList);
            if(!$addActivityFatherList){
                $result = 0;
                goto  response;
            }
        }else{
            //查询复制的渠道
            $CatCpChannel = $Model->table('jy_activity_father_list')
                ->where('Channel =  '.$CpChannel.' and  Type = '.$Type)
                ->field(array(
                    'Id',
                    'Type',
                    'Title',
                    'AddUpStartTime',
                    'AddUpEndTime',
                    'ShowStartTime',
                    'ShowEndTime',
                    'Describe',
                ))
                ->find();
            if(empty($CatCpChannel)){
                $result = 0;
                goto response;
            }
            $dataActivityFatherList = array(
                'Type'              =>      $Type,
                'Title'             =>      $CatCpChannel['Title'],
                'Channel'           =>      $Channel,
                'AddUpStartTime'    =>      $CatCpChannel['AddUpStartTime'],
                'AddUpEndTime'      =>      $CatCpChannel['AddUpEndTime'],
                'ShowStartTime'     =>      $CatCpChannel['ShowStartTime'],
                'ShowEndTime'       =>      $CatCpChannel['ShowEndTime'],
                'Describe'          =>      $CatCpChannel['Describe'],
            );
            //查询复制商品
            $CatSonList = $Model->table('jy_activity_son_list')
                ->where('FatherID = '.$CatCpChannel['Id'])
                ->field(array(
                    'GoodsID',
                    'Title',
                    'Number',
                    'Schedule',
                    'ImgUrl',
                    'ImgCode',
                ))
                ->select();
            $Model->startTrans();
            $FatherId = $Model->table('jy_activity_father_list')
                ->add($dataActivityFatherList);

            if(!$FatherId){
                $Model->rollback();
                $result = 0;
                goto response;
            }
            $DataSonlist = array();
            foreach ($CatSonList as $k=>$v){
                $DataSonlist[$k]['GoodsID'] =  $v['GoodsID'];
                $DataSonlist[$k]['Title']   =  $v['Title'];
                $DataSonlist[$k]['Number']  =  $v['Number'];
                $DataSonlist[$k]['ImgCode'] =  $v['ImgCode'];
                $DataSonlist[$k]['ImgUrl']  =  $v['ImgUrl'];
                $DataSonlist[$k]['FatherID']=  $FatherId;
                $DataSonlist[$k]['Schedule']=  $v['Schedule'];
            }
            $AddSonlist = $Model->table('jy_activity_son_list')->addAll($DataSonlist);
            if($AddSonlist && $FatherId){
                $Model->commit();
                $result = $FatherId;



            }else{
                $Model->rollback();
                $result = 0;
            }
        }
        response:
        echo $result;
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        $catChannelField = array(
            'name',
            'account',
            'id',
        );
        $catChannel = M('jy_admin_users')
            ->where('channel = 2')
            ->field($catChannelField)
            ->select();
        if ($Id<=0){
            $obj->showmessage('非法操作');
        }
        //查询信息
        $ActivityFatherListField = array(
            'Id',
            'Type',
            'Title',
            'AddUpStartTime',
            'AddUpEndTime',
            'ShowStartTime',
            'Channel',
            'ShowEndTime',
            'Describe',
        );
        $ActivityFatherList = M('jy_activity_father_list')
                              ->where('Id = '.$Id)
                              ->field($ActivityFatherListField)
                              ->find();
        $this->assign('info',$ActivityFatherList);
        $this->assign('catChannel',$catChannel);
        $this->display('edit');
    }


    public function  EditAjax(){
        if(!IS_POST){
            $result = 0;
            goto response;
        }
        $Id = I('param.Id',0,'intval');
        if($Id <= 0){
            $result = 0;
            goto response;
        }
        $result = $Id;
        $Title                  =       I('param.Title','','trim');                //标题
        $AddUpStartTime         =       I('param.AddUpStartTime','','trim');       //计费开始时间
        $AddUpEndTime           =       I('param.AddUpEndTime','','trim');         //计费结束时间
        $ShowStartTime          =       I('param.ShowStartTime','','trim');        //显示开始时间
        $ShowEndTime            =       I('param.ShowEndTime','','trim');          //显示结束时间
        $Describe               =       I('param.Describe','','trim');
        $DataUp = array(
            'Title'             =>      $Title,
            'AddUpStartTime'    =>      $AddUpStartTime,
            'AddUpEndTime'      =>      $AddUpEndTime,
            'ShowStartTime'     =>      $ShowStartTime,
            'ShowEndTime'       =>      $ShowEndTime,
            'Describe'          =>      $Describe,
            'Status'            =>      1,
        );
        $UpData = M('jy_activity_father_list')->where('Id = '.$Id)->save($DataUp);
        if($UpData === false){
            $result = 0;
        }
        response:
        echo $result;
    }



    //删除
    public function del(){
        $Id = I('param.Id',0,'intval');
        if($Id == 0){
            echo  0;
        }else{
            $Model = new Model();
            $Model->startTrans();
            $DelFather = $Model->table('jy_activity_father_list')->where('Id = '.$Id)->delete();
            $DelSon    = $Model->table('jy_activity_son_list')->where('FatherID = '.$Id)->delete();
            if($DelFather && $DelSon){
                $Model->commit();
                echo 1;
            }else{
                $Model->rollback();
                echo 0;
            }
        }
        exit();
    }

    //验证类型
    public function Verification(){
        $Type        =  I('param.Type',0,'intval');
        $Channel     =  I('param.Channel',0,'intval');
        $CpChannel   = I('param.CpChannel',0,'intval');
        $Cp          = I('param.Cp',0,'intval');
        $result = 1;
        if($Type == ''){
            $result = 0;
            goto end;
        }
        $activityFatherList = M('jy_activity_father_list')
            ->where('Type = "'.$Type.'" and Channel = '.$Channel)
            ->field('id')
            ->find();
        if($Cp == 2){
            $CatCpChannel = M('jy_activity_father_list')
                ->where('Type = "'.$Type.'" and Channel = '.$CpChannel)
                ->field('id')
                ->find();

            if(empty($CatCpChannel)){
                $result =  3;
                goto  end;
            }
        }

        if(!empty($activityFatherList)){
            $result =  2;
            goto  end;
        }
        end:
          echo $result;
          exit();

    }
    public function SendAjax(){
        $Id = I('param.Id',0,'intval');
        $result = 1;
        if($Id<=0){
            $result = 0;
            goto end;
        }
        $Data = array(
            'Status'=>2,
        );
        $Updata = M('jy_activity_father_list')->where('Id = '.$Id)->save($Data);
        if($Updata === false){
            $result = 0 ;
        }
        end:
            echo $result;
            exit();
    }

}