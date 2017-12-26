<?php
/****
*  CDK 配置
**/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;

class CdkConfigureController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $search['Status'] = I('param.Status',0,'intval');
        $search['Code'] = I('param.Code',0,'intval');
        $where = '1';
        if($search['Code'] != 0){
            $where .= '  and  `Code`='.$search['Code'];
        }
        if($search['Status'] != 0){
            $where .= '  and  `Status`='.$search['Status'];
        }
        $count  = M('conf_cdk_configure')
                  ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $Field = array(
            'Id',
            'Code',
            'Remark',
            'Lenth',
            'Aname',
            'Number',
            'StartTime',
            'EndTime',
            'UpName',
            'DateTime',
        );
        $catData = M('conf_cdk_configure')
            ->where($where)
            ->limit($page*$num,$num)
            ->field($Field)
            ->order('Code asc')
            ->select();
        $this->assign('page',$show);
        $this->assign('info',$catData);
        $this->display('index');
    }
    //添加
    public function  add(){
        //查询礼包
        $CatPackList  = M('conf_ckd_good_continuity')
                        ->where('Status = 2')
                        ->field(
                            array(
                                'Aname',
                                'Code',
                            )
                        )
                        ->select();
        $this->assign('PackList',$CatPackList);
        $this->display('add');
    }
    public function addAjax(){
        $UserInfo = $this->userInfo;
        $Model = new Model();
        if(!IS_POST){
            $result =  0;
            goto response;
        }
        $Aname      = I('param.Aname','','trim');
        $Lenth      = I('param.Lenth',0,'intval');
        $Code       = I('param.Code',0,'intval');
        $StartTime  = I('param.StartTime','','trim');
        $Number     = I('param.Number',0,'intval');
        $EndTime    = I('param.EndTime','','trim');
        $Remark     = I('param.Remark','','trim');
        $Data = array(
            'Aname'       =>  $Aname,
            'Lenth'       =>  $Lenth,
            'Code'        =>  $Code,
            'StartTime'   =>  $StartTime,
            'EndTime'     =>  $EndTime,
            'Number'      =>  $Number,
            'UpName'      =>  $UserInfo['name'],
            'UpId'        =>  $UserInfo['id'],
            'Remark'      =>  $Remark,
        );
        $AddData = $Model
            ->table('conf_cdk_configure')
            ->add($Data);
        if(!$AddData){
            $result =  0;
            goto  response;
        }
        $result = $AddData;
        response:
           echo json_encode(array(
                   'result'=>$result,
           )) ;
           exit();
    }
    //修改
    public function edit(){
        $ObjFun = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        if($Id <= 0){
            $ObjFun->showmessage('非法操作');
        }
        //查询礼包
        $CatPackList  = M('conf_ckd_good_continuity')
            ->where('Status = 2')
            ->field(
                array(
                    'Aname',
                    'Code',
                )
            )
            ->select();
        $CatData = M('conf_cdk_configure')
                   ->where('Id = '.$Id)
                   ->field(
                       array(
                           'Id',
                           'Aname',
                           'Lenth',
                           'Number',
                           'Code',
                           'StartTime',
                           'EndTime',
                           'DateTime',
                           'UpName',
                           'UpId',
                           'Remark',
                       )
                   )
                   ->find();

        $this->assign('PackList',$CatPackList);
        $this->assign('info',$CatData);
        $this->display();
    }


    public function editAjax(){
        $UserInfo = $this->userInfo;
        $Model = new Model();
        $result = 1;
        if(!IS_POST){
            $result =  0;
            goto response;
        }

        $Id         = I('param.Id','','intval');
        $Aname      = I('param.Aname','','trim');
        $Lenth      = I('param.Lenth',0,'intval');
        $Code       = I('param.Code',0,'intval');
        $StartTime  = I('param.StartTime','','trim');
        $Number     = I('param.Number',0,'intval');
        $EndTime    = I('param.EndTime','','trim');
        $Remark     = I('param.Remark','','trim');
        $Data = array(
            'Aname'       =>  $Aname,
            'Lenth'       =>  $Lenth,
            'Code'        =>  $Code,
            'StartTime'   =>  $StartTime,
            'EndTime'     =>  $EndTime,
            'Number'      =>  $Number,
            'UpName'      =>  $UserInfo['name'],
            'UpId'        =>  $UserInfo['id'],
            'Remark'      =>  $Remark,
        );

        $AddData = $Model
            ->table('conf_cdk_configure')
            ->where('Id = '.$Id)
            ->save($Data);
        if($AddData === false){
            $result =  0;
            goto  response;
        }
        response:
        echo json_encode(array(
            'result'=>$result,
        )) ;
        exit();
    }





    //删除
    public function  del(){
        $level = I('param.level',0,'intval');
        if($level < 0){
            echo  0;
        }else{
            $db = M('jy_vip_info');
            $info = $db
                ->where('level = '.$level)
                ->delete();
            if($info){
                echo 1;
            }else{
                echo 0;
            }
        }
        exit();
     }
     public function GenerateCDK(){
         $UserInfo = $this->userInfo;
         $Model = new Model();
         $result = 1;
         if(!IS_POST){
             $result =  0;
             goto response;
         }
         $Lenth      = I('param.Lenth',0,'intval');
         $Number     = I('param.Number',0,'intval');
         $Cid        = I('param.Cid',0,'intval');
         $Code       = I('param.Code',0,'intval');
         $StartTime  = I('param.StartTime','','trim');
         $EndTime    = I('param.EndTime','','trim');
         $Data = array();
         for ($i=0;$i<$Number;$i++){
             $Data[$i]['Cid']       =   $Cid;
             $Data[$i]['Code']      =   $Code;
             $Data[$i]['StartTime'] =   $StartTime;
             $Data[$i]['EndTime']   =   $EndTime;
             $Data[$i]['UpId']      =   $UserInfo['id'];
             $Data[$i]['UpName']    =   $UserInfo['name'];
             $Data[$i]['CDK']       =   $this->generateCode($Lenth);
         }
         $AddData = $Model
                    ->table('conf_cdk_list')
                    ->addAll($Data);
         if(!$AddData){
             $result = 0;
         }
         response:
         echo json_encode(array(
             'result'=>$result,
         )) ;
         exit();
    }

   public function generateCode($code_length = 18) {
        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz";
        $code = '';
        for ($i = 0; $i < $code_length; $i++) {
            $code .= $characters[mt_rand(0, strlen($characters)-1)];
        }
        //如果生成的4位随机数不再我们定义的$promotion_codes数组里面
        return $code;
    }
}