<?php
/***
*  渠道列表
*/
namespace Jy_admin\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class ChannelController extends ComController {
    //列表
    public function index(){

        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $userInfo       = $this->userInfo;          //用户信息
        $lowerAdminUser = $this->lowerAdminUser;    //我的下级组

        //已入方法类
        $obj = new \Common\Lib\func();

        $search['datemax']     =      I('param.datemax','','trim');
        $search['datemin']     =      I('param.datemin','','trim');
        $search['account']        =      I('param.account','','trim');
        $search['islock']      =      I('param.islock','','intval');
        $where = 'a.id = b.adminUserID and a.isdel = 1';
        if ($search['datemax'] != ''){
            $where .= ' and a.`mtime`<="'.$search['datemax'].'"';
        }
        if ($search['datemin'] != ''){
            $where .= ' and a.`mtime`>="'.$search['datemin'].'"';
        }
        if ($search['account'] != ''){
            $where .= ' and a.`account`="'.$search['account'].'"';
        }
        if ($search['islock'] != '') {
            $where .= ' and a.`islock`=' . $search['islock'];
        }
        if($userInfo['default'] == 1 && $userInfo['channel'] == 1){
            $lowerAdminUser[] = $userInfo['id'];
            $lowerAdminUser  = implode(',',$lowerAdminUser);
            $where .= ' and a.addId in('.$lowerAdminUser.')';
        }elseif ($userInfo['channel'] == 2){
            $where  = 'b.adminUserID = '.$userInfo['id'];
        }
        $count  = M('jy_admin_users as a')
                 ->join('jy_channel_info as b')
                 ->where($where)
                  ->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $info = M('jy_admin_users as a')
            ->join('jy_channel_info as b')
            ->where($where)
            ->limit($page*$num,$num)
            ->field('b.adminUserID,b.platform,b.pattern,b.DividedInto,b.RegisterNum,b.RechargeNum,
                     b.CorporateName,b.CompanyPhone,b.contacts,b.ContactNumber,b.ContactMailbox
                     ,b.addName,b.addId,b.isown,a.islock,b.remark,b.mtime,a.account,a.name')
            ->select();

        $this->assign('page',$show);
        $this->assign('info',$info);
        $this->assign('userInfo',$userInfo);
        $this->display('index');
    }
    //添加
    public function add(){
        $userInfo       = $this->userInfo;          //用户信息


        $obj = new \Common\Lib\func();
        //管理信息
        $adminUsers = M('jy_admin_users as a')
            ->join('jy_admin_group as b')
            ->where('b.id = a.admingroup and a.channel = 1  and b.channel and a.isdel = 1')
            ->field('a.id,account,a.name')
            ->select();
        if(IS_POST){
            $adminUserID                    =       I('param.adminUserID',0,'intval');             //管理员ID
            $platform                       =       I('param.platform',1,'intval');                //平台
            $pattern                        =       I('param.pattern',1,'intval');                 //合作方式
            $DividedInto                    =       I('param.DividedInto','','trim');              //分成
            $RegisterNum                    =       I('param.RegisterNum','','trim');              //注册人数（结算率）
            $RechargeNum                    =       I('param.RechargeNum','','trim');              //充值人数（结算率）
            $CorporateName                  =       I('param.CorporateName','','trim');            //公司名称
            $CompanyAddress                 =       I('param.CompanyAddress','','trim');           //公司地址
            $CompanyPhone                   =       I('param.CompanyPhone','','trim');             //联系电话
            $contacts                       =       I('param.contacts','','trim');                 //联系人
            $ContactNumber                  =       I('param.ContactNumber','','trim');            //联系电话
            $ContactMailbox                 =       I('param.ContactMailbox','','trim');           //联系邮箱
            $remark                         =       I('param.remark','','trim');                   //备注信息
            $isown                          =       I('param.isown',1,'intval');                   //是否本公司渠道

            $addName                        =       $userInfo['name'];                          //添加人名
            $addId                          =       $userInfo['id'];                            //添加人ID

            if($adminUserID <=0){
                $obj->showmessage('非法操作');
            }

            //渠道信息
            $dataChannelInfo = array(
                    'adminUserID'=> $adminUserID,
                    'platform'=>$platform,
                    'pattern'=>$pattern,
                    'DividedInto'=>$DividedInto,
                    'RegisterNum'=>$RegisterNum,
                    'RechargeNum'=>$RechargeNum,
                    'CorporateName'=>$CorporateName,
                    'CompanyAddress'=>$CompanyAddress,
                    'CompanyPhone'=>$CompanyPhone,
                    'contacts'=>$contacts,
                    'ContactNumber'=>$ContactNumber,
                    'ContactMailbox'=>$ContactMailbox,
                    'remark'=>$remark,
                    'isown'=>$isown,
                    'addName'=>$addName,
                    'addId'=>$addId,
                );


            $model = new Model();
            //开启事物
            $model->startTrans();
            //渠道信息
            $addChannelInfo = $model
                              ->table('jy_channel_info')
                              ->add($dataChannelInfo);
            //修改管理信息
            $dataAdminUser =  array(
                'channel'=>2
            );
            $upAdminUser = $model
                            ->table('jy_admin_users')
                            ->where('id = %d',$dataChannelInfo['adminUserID'])
                            ->save($dataAdminUser);
            if($upAdminUser && $addChannelInfo){
                //提交事物
                $model->commit();
                $obj->showmessage('添加成功','/jy_admin/Channel/index');
            }else{
                //回滚
                $model->rollback();
                $obj->showmessage('添加失败');
            }

        }
        $this->assign('adminUsers',$adminUsers);
        $this->display('add');
    }
    //修改
    public function  edit(){
        //菜单
        $obj = new \Common\Lib\func();
        $id = I('param.id',0,'intval');
        if($id == 0){
            $obj->showmessage('非法操作');
        }

        $db = M('jy_system_menu');
        $menuList = $db
            ->where('upid = 0  and islock = 1')
            ->field('id,upid,name')
            ->select();

        //菜单信息
        $menuInfo = $db
                    ->where('id = '.$id)
                    ->field('id,upid,name,sort,icon,url,islock,remark,mtime')
                    ->find();



        if(IS_POST){
            $dataMenu['icon'] = I('param.icon','','trim');
            $dataMenu['sort'] = I('param.sort',0,'intval');
            $dataMenu['remark'] = I('param.remark','','trim');
            $dataMenu['url'] = I('param.url','','trim');
            $dataMenu['name'] = I('param.name','','trim');
            $dataMenu['upid'] = I('param.upid',0,'intval');
            $dataMenu['islock'] = I('param.islock',1,'intval');
            $upMenu = $db
                ->where('id = '.$id)
                ->save($dataMenu);
            if($upMenu){
                $obj->showmessage('修改成功','/yq_admin/menu/index');
            }else{
                $obj->showmessage('修改失败');
            }
        }

        $this->assign('menu',$menuList);
        $this->assign('info',$menuInfo);
        $this->display('edit');
    }
    //删除
    public function  del(){
        $id = I('param.id',0,'intval');

        if($id == 0){
           echo  0;
        }else{
            $db = M('jy_system_menu');
            //是否有下级菜单
            $upInfo =  $db
                ->where('upid = '.$id)
                ->find();

            if(!empty($upInfo)){
                echo 2;
            }else{
                $info = $db
                    ->where('id = '.$id)
                    ->delete();
                if($info){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
        exit();
    }

    //渠道商品
    public function goods(){
        $id         =  I('param.id',0,'intval');
        $Platform   =  I('param.platform',0,'intval');
        $search['ShowType']        =      I('param.ShowType','','intval');         //展示方式
        $search['CateGory']        =      I('param.CateGory','','intval');      //类别
        $search['Type']            =      I('param.Type','','intval');        //类型

        $catGoodsAllWhere   = 'IsDel = 1 and  Platform  in ('.$Platform.',1)';
        $ChannelGoodsWhere  = 'b.adminUserID = '.$id.'  and a.IsDel = 1';

        if ($search['ShowType'] != '' && $search['ShowType'] != 0 ) {
            $catGoodsAllWhere  .= ' and `ShowType`=' . $search['ShowType'];
            $ChannelGoodsWhere .= ' and a.`ShowType`=' . $search['ShowType'];
        }
        if ($search['CateGory'] != '' && $search['CateGory'] != 0 ) {
            $catGoodsAllWhere  .= ' and `CateGory`=' . $search['CateGory'];
            $ChannelGoodsWhere .= ' and a.`CateGory`=' . $search['CateGory'];
        }
        if ($search['Type'] != '' && $search['Type'] != 0 ) {
            $catGoodsAllWhere  .= ' and `Type`=' . $search['Type'];
            $ChannelGoodsWhere .= ' and a.`Type`=' . $search['Type'];
        }

        //所有商品
        $catGoodsAll = M('jy_goods_all')
                        ->where($catGoodsAllWhere)
                        ->field('Id,Name,CateGory,ShowType,Type')
                        ->select();

        //渠道商品
        $ChannelGoods = M('jy_goods_all as a')
                        ->join('jy_channel_goods as b on  b.goodsID = a.Id')
                        ->field('a.Id,a.Name')
                        ->where($ChannelGoodsWhere)
                        ->select();

        $this->assign('adminUserID',$id);
        $this->assign('search',$search);
        $this->assign('catGoodsAll',$catGoodsAll);
        $this->assign('ChannelGoods',$ChannelGoods);
        $this->display('goods');
    }
    //渠道商品添加
    public  function goodsAdd(){
        $goods = I('param.goods','','trim');
        $adminUserID = I('param.adminUserID',0,'intval');

        $result  = 1;
        if($goods == '' || $adminUserID <= 0){
            $result  = 0;
            goto response;
        }

        $goods = explode(',',$goods);

        $dataChannelGoods = array();
        foreach ($goods as $k=>$v){
            $dataChannelGoods[$k]['goodsID']     = $v;
            $dataChannelGoods[$k]['adminUserID'] = $adminUserID;
        }

        $addChannelGoods = M('jy_channel_goods')
                           ->addAll($dataChannelGoods);
        if(!$addChannelGoods){
             $result  = 0;
             goto response;
        }
         response:
         echo  $result;
         exit();

    }
    //渠道商品删除
    public function goodsDel(){
        $goods = I('param.goods','','trim');
        $adminUserID = I('param.adminUserID',0,'intval');
        $result  = 1;
        if($goods == '' || $adminUserID <= 0){
            $result  = 0;
            goto response;
        }
        $delChannelGoods = M('jy_channel_goods')
            ->where('adminUserID = '.$adminUserID.' and goodsID in('.$goods.')')
            ->delete();
        if(!$delChannelGoods){
            $result  = 0;
            goto response;
        }
        response:
        echo  $result;
        exit();
    }

    //渠道支付
    public function pay(){
        $id                         =  I('param.id',0,'intval');
        $Platform                   =  I('param.platform',0,'intval');
        $search['Type']             =      I('param.Type','','intval');        //类型

        $catPayWhere   = 'IsDel = 1  and  Platform = '.$Platform;
        $ChannelPayWhere  = 'b.adminUserID = '.$id;
        if ($search['Type'] != '' && $search['Type'] != 0 ) {
            $catPayWhere  .= ' and `Type`=' . $search['Type'];
            $ChannelPayWhere .= ' and a.`Type`=' . $search['Type'];
        }


        //支付列表
        $catThirdpay = M('jy_thirdpay')
                      ->where($catPayWhere)
                      ->field('Id,Name,PassAgeWay')
                      ->select();

        //渠道列表
        $catChannelPay = M('jy_thirdpay as a')
                        ->join('jy_channel_thirdpay as b on a.Id = b.PayID')
                        ->where($ChannelPayWhere)
                        ->field('a.Id,a.PassAgeWay,a.Name')
                        ->select();

        $this->assign('adminUserID',$id);
        $this->assign('search',$search);
        $this->assign('catGoodsAll',$catThirdpay);
        $this->assign('ChannelGoods',$catChannelPay);
        $this->display('Pay');

    }

    //渠道支付添加
    public  function payAdd(){
        $pay = I('param.pay','','trim');
        $adminUserID = I('param.adminUserID',0,'intval');

        $result  = 1;
        if($pay == '' || $adminUserID <= 0){
            $result  = 0;
            goto response;
        }
        $pay = explode(',',$pay);
        $dataChannelPay = array();
        foreach ($pay as $k=>$v){
            $dataChannelPay[$k]['PayID']     = $v;
            $dataChannelPay[$k]['adminUserID'] = $adminUserID;
        }

        $addChannelGoods = M('jy_channel_thirdpay')
            ->addAll($dataChannelPay);
        if(!$addChannelGoods){
            $result  = 0;
            goto response;
        }
        response:
        echo  $result;
        exit();

    }

    //渠道商品删除
    public function payDel(){
        $pay = I('param.pay','','trim');
        $adminUserID = I('param.adminUserID',0,'intval');
        $result  = 1;
        if($pay == '' || $adminUserID <= 0){
            $result  = 0;
            goto response;
        }
        $delChannelThirdpay = M('jy_channel_thirdpay')
            ->where('adminUserID = '.$adminUserID.' and PayID in('.$pay.')')
            ->delete();
        if(!$delChannelThirdpay){
            $result  = 0;
            goto response;
        }
        response:
        echo  $result;
        exit();
    }


    //渠道信息
    public  function  information(){
        $obj = new \Common\Lib\func();
        $id = I('param.id',0,'intval');
        if($id <= 0){
            $obj->showmessage('非法操作');
        }
        $catChannel = M('jy_channel_info')
                      ->where('adminUserID = '.$id)
                      ->field('RechargeNum,CompanyAddress,CompanyPhone,ContactMailbox,CompanyPhone,contacts')
                      ->find();
        $this->assign('info',$catChannel);
        $this->display('information');
    }

}