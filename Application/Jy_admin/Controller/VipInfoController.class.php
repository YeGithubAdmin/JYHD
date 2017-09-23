<?php
/****
*  vip  等级信息
**/
namespace Jy_admin\Controller;
use Think\Controller;
class VipInfoController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $where = 'level >0';
        $count  = M('jy_vip_info')->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $catVipInfo = M('jy_vip_info')
            ->where($where)
            ->limit($page*$num,$num)
            ->field('level,experience,Describe,mtime')
            ->order('level asc')
            ->select();
        $this->assign('page',$show);
        $this->assign('info',$catVipInfo);
        $this->display('index');

    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();

        if(IS_POST){
            //数据
            $level          =           I('param.level',0,'intval');                   //等级
            $experience     =           I('param.experience',0,'intval');              //充值额度
            $ImgCode       =            I('param.ImgCode','','trim');                  //图片
            $Describe       =           I('param.Describe','','trim');                 //描述
            $GiveInfo      =            I('param.GiveInfo','','trim');                 //赠送信息
            $dataVipInfo = array(
                'level'           =>       $level,
                'experience'      =>       $experience,
                'Describe'        =>       $Describe,
                'ImgCode'         =>       $ImgCode,
                'GiveInfo'        =>       $GiveInfo
            );
            //添加

            $addVipInfo = M('jy_vip_info')
                ->add($dataVipInfo);
            if($addVipInfo){
                $obj->showmessage('修改成功','/jy_admin/VipInfo/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }

        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();
        $level = I('param.level',0,'intval');
        if($level< 0){
            $obj->showmessage('非法操作');
        }
        //查询用户信息
        $catVipInfo = M('jy_vip_info')
                      ->where('level = '.$level)
                      ->field('level,experience,Describe,ImgCode,GiveInfo')
                      ->find();

        if(IS_POST){
            //数据
            $experience     =           I('param.experience',0,'intval');         //充值额度
            $Describe       =           I('param.Describe',0,'trim');             //描述
            $ImgCode       =            I('param.ImgCode','','trim');             //图片
            $GiveInfo      =            I('param.GiveInfo','','trim');            //赠送信息
            $dataVipInfo = array(
                'experience'      =>       $experience,
                'Describe'        =>       $Describe,
                'ImgCode'         =>       $ImgCode,
                'GiveInfo'         =>       $GiveInfo
            );
            //添加
            $upVipInfo = M('jy_vip_info')
                ->where('level = '.$level)
                ->save($dataVipInfo);
            if($upVipInfo !== false){
                $obj->showmessage('修改成功','/jy_admin/VipInfo/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('info',$catVipInfo);
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

        $level = I('param.level',0,'intval');
        if($level < 0){
            echo 0;

            exit();
        }

        $catVipInfo = M('jy_vip_info')
            ->where('level = '.$level)
            ->field('level')
            ->find();
        if(empty($catVipInfo)){
            echo 1;
            exit();
        }else{
            echo 2;
            exit();
        }

    }
    public  function test(){
        //累计签到时间
        $SignDay =  7;

        //最近签到时间
        $SignTime = 1;

        //当天时间
        $SameTime = 1;

        //当天签到状态  1-未签到   2-已签到
        $isSign = 1;
        if($SignTime<$SameTime){
            $isSign = 1;
        }
        if($SignTime == $SameTime){
            $isSign = 2;
        }

        $SignDay = $SignDay%7;

        //签到信息列表
        $sevenDaysSign = M('jy_seven_days_sign')
                         ->field('DayName,RewardName,Code,Day')
                         ->order('Day asc')
                         ->select();

        //status 1-未签 2-已签 3-今日领取  4-明日可以领取
        foreach ($sevenDaysSign as $k=>$v){
            //未签  余 0
            if($SignDay == 0 && $isSign == 1){
                if($v['Day'] == 1){
                    $sevenDaysSign[$k]['Status'] = 3;
                }elseif($v['Day'] == 2){
                    $sevenDaysSign[$k]['Status'] = 4;
                }else{
                    $sevenDaysSign[$k]['Status'] = 1;
                }

            }
            //已签 余 0
            if($SignDay == 0 && $isSign == 2){
                if($v['Day'] == 1){
                    $sevenDaysSign[$k]['Status'] = 2;
                }elseif($v['Day'] == 2){
                    $sevenDaysSign[$k]['Status'] = 4;
                }else{
                    $sevenDaysSign[$k]['Status'] = 1;
                }

            }

            //未签 余 > 0  and  6 >
            if($SignDay >0   &&  $isSign == 1){
                  if($SignDay == $v['Day']){
                      $sevenDaysSign[$k]['Status'] = 3;
                  }elseif($SignDay + 1 == $v['Day']){
                      $sevenDaysSign[$k]['Status'] = 4;
                  }elseif($SignDay > $v['Day']){
                      $sevenDaysSign[$k]['Status'] = 2;
                  }else{
                      $sevenDaysSign[$k]['Status'] = 1;
                  }
            }
            //已签 余 > 0
            if($SignDay >0  &&  $isSign == 2){
                if($SignDay >= $v['Day']){
                    print_r($v['Day']);
                    $sevenDaysSign[$k]['Status'] = 2;
                }elseif($SignDay + 1 == $v['Day']) {
                    $sevenDaysSign[$k]['Status'] = 4;
                }else{
                    $sevenDaysSign[$k]['Status'] = 1;
                }
            }

        }
        $info['SignInfo']  =   $sevenDaysSign;
        $info['Status']    =   $isSign;


    }

}