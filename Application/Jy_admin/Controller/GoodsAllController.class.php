<?php
/****
*  物品
**/
namespace Jy_admin\Controller;
use Think\Controller;
class GoodsAllController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $where = 'IsDel = 1';
        $search['Platform']     =      I('param.Platform','','trim');     //平台
        $search['ShowType']     =      I('param.ShowType','','trim');         //展示方式
        $search['CateGory']        =      I('param.CateGory','','trim');      //类别
        $search['Type']      =      I('param.Type','','trim');        //类型
        $search['Status']      =      I('param.Status','','trim');        //状态
        $search['Code']      =      I('param.Code','','trim');        //商品标识
        $search['Name']      =      I('param.Name','','trim');        //商品名

        if ($search['Platform'] != ''){
            $where .= ' and `Platform`="'.$search['Platform'].'"';
        }
        if ($search['ShowType'] != '') {
            $where .= ' and `ShowType`=' . $search['ShowType'];
        }
        if ($search['CateGory'] != '') {
            $where .= ' and `CateGory`=' . $search['CateGory'];
        }
        if ($search['Type'] != '') {
            $where .= ' and `Type`=' . $search['Type'];
        }
        if ($search['Status'] != '') {
            $where .= ' and `Status`=' . $search['Status'];
        }
        if ($search['Code'] != '') {
            $where .= ' and `Code`="'.$search['Code'].'"';
        }
        if ($search['Name'] != '') {
            $where .= ' and `Name`="'.$search['Name'].'"';
        }
        $count  = M('jy_goods_all')->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        $catVipInfoField = array(
            'Id',
            'Code',
            'Name',
            'CurrencyType',
            'GetNum',
            'CurrencyNum',
            'Type',
            'CateGory',
            'LimitLevel',
            'LimitVip',
            'GiveInfo',
            'CateGory',
            'IssueNum',
            'IssueType',
            'Status',
            'ShowType',
            'DateTime',
            'UpTime',
            'OriginalPrice',
        );
        $catVipInfo = M('jy_goods_all')
            ->where($where)
            ->limit($page*$num,$num)
            ->field($catVipInfoField)
            ->order('Sort asc')
            ->select();

        $this->assign('page',$show);
        $this->assign('search',$search);
        $this->assign('info',$catVipInfo);
        $this->display('index');
    }
    //添加
    public function  add(){
        $obj = new \Common\Lib\func();
        //所有商品
        $catGoodsAll = M('jy_goods_all')
                        ->where('IsDel = 1')
                        ->field('Id,Type,GetNum,Name')
                        ->select();
        if(IS_POST){

            //数据
            $Code                        =           I('param.Code','','trim');                         //物品标识
            $ShowType                    =           I('param.ShowType',0,'intval');                    //展示方式
            $Name                        =           I('param.Name','','trim');                         //物品名
            $CurrencyType                =           I('param.CurrencyType',0,'intval');                //货币类型 1-人民币 2-金币 3-砖石
            $CurrencyNum                 =           I('param.CurrencyNum',0,'intval');                 //货币数量
            $IssueNum                    =           I('param.IssueNum',0,'intval');                    //发行量
            $IssueType                   =           I('param.IssueType',0,'intval');                   //是否限制发行量 1-否 2-是
            $Type                        =           I('param.Type',0,'intval');                        //类型 1-金币 2-钻石 3-道具
            $CateGory                    =           I('param.CateGory',0,'intval');                    //类别 1-金币 2-砖石 3-道具
            $GetNum                      =           I('param.GetNum',0,'intval');                      //获得数量
            $GiveInfo                    =           I('param.GiveInfo','','trim');                     //赠送
            $IsGroom                     =           I('param.IsGroom',0,'intval');                     //是否推荐 1-否 2-是
            $Status                      =           I('param.Status',1,'intval');                      //状态 1-上架 2-定时上架 3-定时下架 4-已下架
            $TheShelvesTime              =           I('param.TheShelvesTime','','trim');               //定时上下架时间
            $Platform                    =           I('param.Platform',1,'intval');                    //平台 1-全部 2-苹果 3-安卓
            $LimitShop                   =           I('param.LimitShop',1,'intval');                   //限购 1-不限 2-日 3-周 4-月 5-一次
            $LimitShopNum                =           I('param.LimitShopNum',0,'intval');                //限购次数
            $ExchangeType                =           I('param.ExchangeType',1,'intval');                //限购 1-不限 2-日 3-周 4-月 5-一次
            $ExchangeNum                 =           I('param.ExchangeNum',0,'intval');                 //限兑换数量
            $Describe                    =           I('param.Describe','','trim');                     //商品描述
            $Push                        =           I('param.Push','','trim');                         //推送信息
            $Broadcast                   =           I('param.Broadcast','','trim');                    //广播信息
            $Rmark                       =           I('param.Rmark','','trim');                        //备注
            $LimitLevel                  =           I('param.LimitLevel',0,'intval');                  //等级限制 0-不限制
            $LimitVip                    =           I('param.LimitVip',0,'intval');                    //会员等级限制 0-不限制
            $Sort                        =           time();                                            //排序
            $IsGive                      =           I('param.IsGive',1,'intval');                      //是否赠送 1-否 2-是
            $Proportion                  =           I('param.Proportion',0,'intval');                  //首冲比例
            $ImgCode                     =           I('param.ImgCode','','trim');                      //图片标识
            $IosCode                     =           I('param.IosCode',0,'intval');                     //Ios 标识
            $FaceValue                   =           I('param.FaceValue','','trim');                    //话费卡面值
            $OriginalPrice               =           I('param.OriginalPrice','','trim');                //话费卡面值


            //发行量
            if($IssueType == 1){
                $IssueNum = 0;
            }
            //限购
            if($LimitShop == 1){
                $LimitShopNum = 0;
            }
            //限兑
            if($ExchangeType == 1){
                $LimitShopNum = 0;
            }
            //赠送
            if($IsGive == 1){
                $GiveInfo = '';
            }else{
                $GiveInfo = json_encode($GiveInfo);
            }
            $dataGoodsAll = array(
                'Code'              =>       $Code,
                'Name'              =>       $Name,
                'CurrencyType'      =>       $CurrencyType,
                'CurrencyNum'       =>       $CurrencyNum,
                'ShowType'          =>       $ShowType,
                'IssueNum'          =>       $IssueNum,
                'IssueType'         =>       $IssueType,
                'Type'              =>       $Type,
                'CateGory'          =>       $CateGory,
                'GetNum'            =>       $GetNum,
                'GiveInfo'          =>       $GiveInfo,
                'IosCode'           =>       $IosCode,
                'IsGroom'           =>       $IsGroom,
                'Status'            =>       $Status,
                'TheShelvesTime'    =>       $TheShelvesTime,
                'Platform'          =>       $Platform,
                'LimitShop'         =>       $LimitShop,
                'LimitShopNum'      =>       $LimitShopNum,
                'ExchangeType'      =>       $ExchangeType,
                'ExchangeNum'       =>       $ExchangeNum,
                'Describe'          =>       $Describe,
                'Push'              =>       $Push,
                'Broadcast'         =>       $Broadcast,
                'Rmark'             =>       $Rmark,
                'LimitLevel'        =>       $LimitLevel,
                'LimitVip'          =>       $LimitVip,
                'Sort'              =>       $Sort,
                'Proportion'        =>       $Proportion,
                'ImgCode'           =>       $ImgCode,
                'FaceValue'         =>       $FaceValue,
                'OriginalPrice'     =>       $OriginalPrice,
            );
            $db = M('jy_goods_all');
            //添加
            $addGoodsAll = $db
                ->add($dataGoodsAll);
            if($addGoodsAll){
                $obj->showmessage('添加成功','/jy_admin/GoodsAll/index');
            }else{
                $obj->showmessage('添加失败');
            }
        }
        $this->assign('GoodsAllList',$catGoodsAll);
        $this->display('add');
    }
    //修改
    public function edit(){
        $obj = new \Common\Lib\func();

        $Id = I('param.id',0,'intval');
        if($Id<=0){
            $obj->showmessage('非法操作');
        }
        //所有商品
        $catGoodsAll = M('jy_goods_all')
            ->where('IsDel = 1')
            ->field('Id,Type,GetNum,Name')
            ->select();
        //商品信息
        $catGoodsAllInfo = M('jy_goods_all')
                            ->where('Id = '.$Id.' and IsDel = 1')
                            ->field('Id,Code,Name,IosCode,OriginalPrice,CurrencyType,CurrencyNum,IssueNum,IssueType,Type,CateGory,GiveInfo,IsGroom,Status,TheShelvesTime,Platform
                            ,LimitShop,LimitShopNum,ExchangeType,FaceValue,ShowType,ExchangeNum,ImgCode,Describe,Proportion,Push,Broadcast,Rmark,GetNum,LimitLevel,LimitVip')
                            ->find();
        if(empty($catGoodsAllInfo['GiveInfo'])){
            $catGoodsAllInfo['GiveInfo'] = array();
        }else{
            $catGoodsAllInfo['GiveInfo'] = json_decode($catGoodsAllInfo['GiveInfo'],true);
        }


        if(IS_POST){
            //数据
            $Code                        =           I('param.Code','','trim');                         //物品标识
            $Name                        =           I('param.Name','','trim');                         //物品名
            $CurrencyType                =           I('param.CurrencyType',0,'intval');                //货币类型 1-人民币 2-金币 3-砖石
            $ShowType                    =           I('param.ShowType',0,'intval');                    //展示方式
            $CurrencyNum                 =           I('param.CurrencyNum',0,'trim');                  //货币数量
            $IssueNum                    =           I('param.IssueNum',1,'intval');                    //发行量
            $IssueType                   =           I('param.IssueType',1,'intval');                   //是否限制发行量 1-否 2-是
            $Type                        =           I('param.Type',0,'intval');                        //类型 1-金币 2-钻石 3-道具
            $CateGory                    =           I('param.CateGory',1,'intval');                    //类别 1-金币 2-砖石 3-道具
            $GetNum                      =           I('param.GetNum',0,'intval');                      //获得数量
            $GiveInfo                    =           I('param.GiveInfo','','trim');                     //赠送
            $IsGroom                     =           I('param.IsGroom',0,'intval');                     //是否推荐 1-否 2-是
            $Status                      =           I('param.Status',1,'intval');                      //状态 1-上架 2-定时上架 3-定时下架 4-已下架
            $TheShelvesTime              =           I('param.TheShelvesTime','','trim');               //定时上下架时间
            $Platform                    =           I('param.Platform',1,'intval');                    //平台 1-全部 2-苹果 3-安卓
            $LimitShop                   =           I('param.LimitShop',1,'intval');                   //限购 1-不限 2-日 3-周 4-月 5-年
            $LimitShopNum                =           I('param.LimitShopNum',0,'intval');                //限购次数
            $ExchangeType                =           I('param.ExchangeType',1,'intval');                //限购 1-不限 2-日 3-周 4-月 5-年
            $ExchangeNum                 =           I('param.ExchangeNum',0,'intval');                 //限兑换数量
            $Describe                    =           I('param.Describe','','trim');                     //商品描述
            $Push                        =           I('param.Push','','trim');                         //推送信息
            $Broadcast                   =           I('param.Broadcast','','trim');                    //广播信息
            $Rmark                       =           I('param.Rmark','','trim');                        //备注
            $LimitLevel                  =           I('param.LimitLevel',0,'intval');                  //等级限制 0-不限制
            $LimitVip                    =           I('param.LimitVip',0,'intval');                    //会员等级限制 0-不限制
            $IsGive                      =           I('param.IsGive',1,'intval');                      //是否赠送 1-否 2-是
            $Proportion                  =           I('param.Proportion',0,'intval');                  //首冲比例
            $IosCode                     =           I('param.IosCode',0,'intval');                     //IOS标识
            $ImgCode                     =           I('param.ImgCode','','trim');                      //图片标识
            $FaceValue                   =           I('param.FaceValue','','trim');                     //话费卡面值
            $OriginalPrice               =           I('param.OriginalPrice','','trim');                 //原价






            //发行量
            if($IssueType == 1){
                $IssueNum = 0;
            }
            //限购
            if($LimitShop == 1){
                $LimitShopNum = 0;
            }
            //限兑
            if($ExchangeType == 1){
                $ExchangeNum = 0;
            }
            //赠送
            if($IsGive == 1){
                $GiveInfo = '';
            }else{
                $GiveInfo = json_encode($GiveInfo);
            }

            $dataGoodsAll = array(
                'Code'              =>       $Code,
                'Name'              =>       $Name,
                'CurrencyType'      =>       $CurrencyType,
                'CurrencyNum'       =>       $CurrencyNum,
                'IssueNum'          =>       $IssueNum,
                'IssueType'         =>       $IssueType,
                'Type'              =>       $Type,
                'ShowType'          =>       $ShowType,
                'CateGory'          =>       $CateGory,
                'GetNum'            =>       $GetNum,
                'GiveInfo'          =>       $GiveInfo,
                'IsGroom'           =>       $IsGroom,
                'Status'            =>       $Status,
                'TheShelvesTime'    =>       $TheShelvesTime,
                'Platform'          =>       $Platform,
                'IosCode'           =>       $IosCode,
                'LimitShop'         =>       $LimitShop,
                'LimitShopNum'      =>       $LimitShopNum,
                'ExchangeType'      =>       $ExchangeType,
                'ExchangeNum'       =>       $ExchangeNum,
                'Describe'          =>       $Describe,
                'Push'              =>       $Push,
                'Broadcast'         =>       $Broadcast,
                'Rmark'             =>       $Rmark,
                'LimitLevel'        =>       $LimitLevel,
                'LimitVip'          =>       $LimitVip,
                'Proportion'        =>       $Proportion,
                'UpTime'            =>       date('Y-m-d H:i:s',time()),
                'ImgCode'           =>       $ImgCode,
                'FaceValue'         =>       $FaceValue,
                'OriginalPrice'     =>       $OriginalPrice,
            );

            //添加
            $upGoodsAll = M('jy_goods_all')
                ->where('Id = '.$Id)
                ->save($dataGoodsAll);
            if($upGoodsAll){
                $obj->showmessage('修改成功','/jy_admin/GoodsAll/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }
        $this->assign('GoodsAllList',$catGoodsAll);
        $this->assign('info',$catGoodsAllInfo);
        $this->display('edit');
    }
    //删除
    public function  del(){
        $Id = I('param.id',0,'intval');
        if($Id < 0){
            echo  0;
        }else{
            $db = M('jy_goods_all');
            $dataGoodsAll = array(
                "IsDel" =>2,
            );
            $info = $db
                ->where('Id = '.$Id)
                ->save($dataGoodsAll);
            if($info){
                echo 1;
            }else{
                echo 0;
            }

        }
        exit();
    }
    //信息
    public function information(){
        $obj = new \Common\Lib\func();
        $Id = I('param.id',0,'intval');
        if($Id<=0){
            $obj->showmessage('非法操作');
        }
        $catGoodsAll = M('jy_goods_all')
                       ->where('Id = '.$Id.' and IsDel = 1')
                       ->field('Id,Describe,Broadcast,Push,Rmark')
                       ->find();
        $this->assign('catGoodAll',$catGoodsAll);
        $this->display();
    }
    //物品信息
    public function GiveList(){
        $obj = new \Common\Lib\func();
        $Id = I('param.id',0,'intval');
        if($Id<=0){
            $obj->showmessage('非法操作');
        }
        $catGoodsAll = M('jy_goods_all')
            ->where('Id = '.$Id.' and IsDel = 1')
            ->field('GiveInfo')
            ->find();
        $GiveInfo       = json_decode($catGoodsAll['GiveInfo'],true);
        $GoodsID        = array();
        $NewGoodsInfo   = array();
        foreach ($GiveInfo as $k=>$v){
            $GoodsID[]              = $v['Id'];
            $NewGoodsInfo[$v['Id']] = $v;
        }
        if(empty($GoodsID)){
            $obj->showmessage('非法操作');
        }
        $GoodsID = implode(',',$GoodsID);
        $GoodsAllFile = array(
            'Name',
            'Id',
        );
        $GoodsAll  = M('jy_goods_all')
                        ->where('Id in ('.$GoodsID.') and IsDel = 1')
                        ->field($GoodsAllFile)
                        ->select();
        foreach ($GoodsAll as $k=>$v){
            $GoodsAll[$k]['Number'] = $NewGoodsInfo[$v['Id']]['GetNum'];
        }
        $this->assign('info',$GoodsAll);
        $this->display();
    }



}