<?php
/****
*  CDK 礼包配置
**/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;

class CdkGoodsConfigureController extends ComController {
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
        $count  = M('conf_ckd_good_continuity')
                  ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $Field = array(
            'Id',
            'Code',
            'Remark',
            'Aname',
            'Status',
            'UpName',
            'DateTime',
        );
        $catData = M('conf_ckd_good_continuity')
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
        $obj = new \Common\Lib\func();
        $UserInfo = $this->userInfo;
        $Model = new Model();
        $catGoodsAll = $Model
            ->table('jy_goods_all')
            ->where('IsDel = 1')
            ->field('Id,Type,GetNum,Name')
            ->select();
        if(IS_POST){
            //数据
            $Code      = I('param.Code',0,'intval');
            $Aname     = I('param.Aname','','trim');
            $submit    = I('param.submit','','trim');
            $GiveInfo  = I('param.GiveInfo','','trim');
            $Remark  = I('param.Remark','','trim');
            if($submit == ''){
                 $obj->showmessage('非法操作');
            }
            if($submit =='保存配置'){
                $Status = 1;
            }elseif($submit =='发布配置') {
                $Status = 2;
            }
            $GiveInfo = array_values($GiveInfo);
            $Continuity = array(
                'Code'=>$Code,
                'Aname'=>$Aname,
                'Status'=>$Status,
                'UpName'=>$UserInfo['name'],
                'UpId'=>$UserInfo['id'],
                'GiveInfo'=>json_encode($GiveInfo),
                'Remark'=>$Remark,
            );
            $addContinuity = $Model
                             ->table('conf_ckd_good_continuity')
                             ->add($Continuity);
            if($addContinuity) {
                $Model->commit();
                $obj->showmessage('添加成功','/jy_admin/CdkGoodsConfigure/index');
            }else{
                $Model->rollback();
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('GoodsAllList',$catGoodsAll);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $Id = I('param.Id',0,'intval');
        $UserInfo = $this->userInfo;
        $Model = new Model();
        $catGoodsAll = $Model
            ->table('jy_goods_all')
            ->where('IsDel = 1')
            ->field('Id,Type,GetNum,Name')
            ->select();
        //查询物品
        $CatContinuity = $Model
                         ->table('conf_ckd_good_continuity')
                         ->where('Id = '.$Id)
                         ->field(array(
                             'Id',
                             'Code',
                             'UpName',
                             'UpId',
                             'Aname',
                             'Status',
                             'GiveInfo',
                             'Remark',
                         ))
                         ->find();
        if(empty($CatContinuity)){
            $obj->showmessage('配置不存在！');
        }

        if(IS_POST){
            $Aname     = I('param.Aname','','trim');
            $submit    = I('param.submit','','trim');
            $GiveInfo  = I('param.GiveInfo','','trim');
            $Remark  = I('param.Remark','','trim');
            if($submit == ''){
                $obj->showmessage('非法操作');
            }
            if($submit =='保存配置'){
                $Status = 1;
            }elseif($submit =='发布配置'){
                $Status = 2;
            }

            $GiveInfo = array_values($GiveInfo);

            $Continuity = array(
                'Aname'=>$Aname,
                'Status'=>$Status,
                'UpName'=>$UserInfo['name'],
                'UpId'=>$UserInfo['id'],
                'GiveInfo'=>json_encode($GiveInfo),
                'Remark'=>$Remark,
            );
            $upContinuity = $Model
                ->table('conf_ckd_good_continuity')
                ->where('Id = '.$Id)
                ->save($Continuity);
            //过滤产品
            if($upContinuity !== false){
                $obj->showmessage('修改成功','/jy_admin/CdkGoodsConfigure/index');
            }else{
                $obj->showmessage('修改失败');
            }

        }
        $GiveInfo = json_decode($CatContinuity['GiveInfo'],true);

        $this->assign('info',$CatContinuity);
        $this->assign('GoodsAllList',$catGoodsAll);
        $this->assign('GiveInfo',$GiveInfo);
        $this->display('edit');
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
    //验证等级是否存在
    public function Verification(){
        $Code = I('param.Code',0,'intval');
        if($Code < 0){
            echo 0;

            exit();
        }
        $catVipInfo = M('conf_ckd_good_continuity')
            ->where('Code = '.$Code)
            ->field('Code')
            ->find();
        if(empty($catVipInfo)){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }

    }

}