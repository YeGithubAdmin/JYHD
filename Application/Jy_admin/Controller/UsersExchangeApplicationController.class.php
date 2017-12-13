<?php
/****
*  用户兑换申请
**/
namespace Jy_admin\Controller;
use Protos\OptSrc;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class UsersExchangeApplicationController extends ComController {
    public function index(){
        $page           = $this->page;              //页码
        $num            = $this->num;               //条数
        $search['datemax']      =      I('param.datemax','','trim');
        $search['datemin']      =      I('param.datemin','','trim');
        $search['Order']        =      I('param.Order','','trim');
        $search['playerid']     =      I('param.playerid','','trim');
        $search['Status']       =      I('param.Status',1,'intval');
        $search['Type']         =      I('param.Type',0,'intval');
        $where = '1';
        if ($search['datemax'] != ''){
            $where .= ' and `DateTime`  <=  str_to_date("'.$search['datemax'].'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['datemin'] != ''){
            $where .= ' and `DateTime`  >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if ($search['Order'] != ''){
            $where .= ' and `Order`="'.$search['Order'].'"';
        }
        if ($search['playerid'] != '') {
            $where .= ' and `playerid`=' . $search['playerid'];
        }
        if ($search['Status'] != 0) {
            $where .= ' and `Status`=' . $search['Status'];
        }
        if ($search['Type'] != 0) {
            if($search['Type'] >3){
                $where .= ' and `Type`>=' . $search['Type'];
            }else{
                $where .= ' and `Type`=' . $search['Type'];
            }
        }
        print_r($where);
        $count  = M('jy_users_exchange_log')->where($where)->count();
        $Page       = new \Common\Lib\Page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        $UsersExchangeLogField = array(
            'Id',
            'GoodsName',
            'playerid',
            'Status',
            'Order',
            'StockNum',
            'GoodsID',
            'UpTime',
            'DateTime',
        );
        $UsersExchangeLog = M('jy_users_exchange_log')
            ->where($where)
            ->limit($page*$num,$num)
            ->order('DateTime desc')
            ->field($UsersExchangeLogField)
            ->select();
        $this->assign('page',$show);
        $this->assign('info',$UsersExchangeLog);
        $this->assign('search',$search);
        $this->display('index');
    }
    //审核
    public function ToExamine(){
        $obj = new  \Common\Lib\func();
        $Id= I('param.Id',0,'intval');

        $msgArr = array(
            2001=>'更新成功！',
            3001=>'网络错误，请稍后再试',
            3002=>'与游戏服务器断开，请稍后再试！',
            3003=>'与游戏服务器断开，请稍后再试！',
            4001=>'审核状态不明确',
            4002=>'非法操作。',
            5002=>'系统错误，请稍后再试！',
            0=> "占位符",
            1=>"请求成功",
            2=>"重复创建",
            3=>"数据保存错误",
            4=>"参数错误",
            5=>"服务器逻辑错误",
            6=>"金币不足",
            7=>"没有玩家信息",
            8=>"重复登录",
            9=>"正在进行游戏",
            10=>"没有这个玩家",
            11=>"服务器满载",
            12=>"帐号被封",
            13=>"没有该帐号信息",
            14=>"钻石不足",
            15=>"没有游戏服",
            16=>"该帐号被另一台设备登录",
            17=>"创建次数达到最大",
            18=>"账号名不符合规则",
            19=>"密码不符合规则",
            20=>"操作不合法",
            21=>"账号密码不匹配",
        );
        $result = 2001;


        if($Id <= 0){
            $result = 4002;
            goto  response;
        }
        //查询物品
        $CatUsersExchangeLogField = array( 'a.Id',
            'a.GoodsName',
            'a.playerid',
            'a.StockNum',
            'a.Order',
            'b.Type',
            'b.FaceValue',
            'a.DateTime',
            );
        $CatUsersExchangeLog = M('jy_users_exchange_log as a')
                               ->join('jy_goods_all as b on b.Id = a.GoodsID')
                               ->where('a.Id = '.$Id)
                               ->field($CatUsersExchangeLogField)
                               ->find();
        if(IS_POST){
            $Status          =      I('param.Status',0,'intval');       //状态  2-审核通过  3-审核不通过
            $Type            =      I('param.Type',0,'intval');         //类型 4-话费卡  5-京东卡  6-西实物
            $cardNum         =      I('param.cardNum','','trim');       //卡号
            $cardPwd         =      I('param.cardPwd','','trim');       //卡密
            $FaceValue         =      I('param.FaceValue',0,'intval');       //卡密
            $ExpressName     =      I('param.ExpressName','','trim');   //快递名称
            $ExpressOrder    =      I('param.ExpressOrder','','trim');  //快递名称
            $MessAge         =      I('param.MessAge','','trim');       //失败通知

            if($Status<=1){
                $result = 4001;
                goto  response;
            }
            $obj->ProtobufObj(array(
                'Protos/PBS_UsrDataOprater.php',
                'Protos/PBS_UsrDataOpraterReturn.php',
                'Protos/UsrDataOpt.php',
                'Protos/OptSrc.php',
                'EmailType.php',
                'OptReason.php',
                'RPB_PlayerNumerical.php',
                'PB_Item.php',
                'PB_Email.php',
            ));
            $PBS_UsrDataOprater             =   new PBS_UsrDataOprater();
            $PBS_UsrDataOpraterReturn       =   new PBS_UsrDataOpraterReturn();
            $EmailType                      =   new \EmailType();
            $UsrDataOpt                     =   new UsrDataOpt();
            $OptSrc                         =   new OptSrc();
            $OptReason                      =   new \OptReason();



            $PBS_UsrDataOprater->setPlayerid($CatUsersExchangeLog['playerid']);
            $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);

            $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
            $PB_Email = new \PB_Email();
            $PB_Email->setSender('系统');
            $PB_Email->setTitle($CatUsersExchangeLog['GoodsName']);
            if($Status == 2){
            //审核通过
                $PBS_UsrDataOprater->setReason($OptReason::exchange);
                if($Type == 4){
                    //话费卡
                    $PB_Email->setCardNum($cardNum);
                    $PB_Email->setType($EmailType::EmailType_Card);
                    $PB_Email->setCardPwd($cardPwd);
                }elseif ($Type == 5){
                    //京东卡
                    $PB_Email->setCardNum($cardNum);
                    $PB_Email->setCardPwd($cardPwd);
                    $PB_Email->setType($EmailType::EmailType_Card);
                }elseif ($Type == 6){
                    //实物
                    $PB_Email->setType($EmailType::EmailType_Sys);
                    $dataText = '快递：'.$ExpressName.'，快递单号：'.$ExpressOrder.'。';
                    $PB_Email->setData($dataText);
                }
            }elseif($Status == 3){
                $PBS_UsrDataOprater->setReason($OptReason::gm_tool);
             //审核不通过
                 $PB_Item    =  new \PB_Item();
                 $PB_Item   ->  setId(6);
                $PB_Email->setType($EmailType::EmailType_Sys);
                 $PB_Item   ->  setNum($CatUsersExchangeLog['StockNum']);
                 $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                 $PB_Email  ->  setData($MessAge);

            }
            $PBS_UsrDataOprater->setSendEmail($PB_Email);
            $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
            //发送请求
            $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$CatUsersExchangeLog['playerid']);

            if($PBS_UsrDataOpraterRespond  == 504){
               $result = 3002;
               goto response;
            }
            if(strlen($PBS_UsrDataOpraterRespond)==0){
                $result = 3003;
                goto response;
            }
            //接受回应
            $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
            $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
            if($Status == 2){
                $PBS_UsrDataOprater->reset();
                $PB_Email->reset();
                $PBS_UsrDataOpraterReturn->reset();

                $PBS_UsrDataOprater->setPlayerid($CatUsersExchangeLog['playerid']);
                $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
                $PBS_UsrDataOprater->setReason($OptReason::gm_tool);
                $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
                $PB_Email = new \PB_Email();
                $PB_Email->setSender('系统');
                $PB_Email->setTitle('兑换通知');
                $PB_Email->setData('您兑换的'.$CatUsersExchangeLog['GoodsName'].',审核已通过，请在兑换邮件查收。');
                $PB_Email->setType($EmailType::EmailType_Sys);
                $PBS_UsrDataOprater->setSendEmail($PB_Email);
                $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
                //发送请求
                $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$CatUsersExchangeLog['playerid']);

                if($PBS_UsrDataOpraterRespond  == 504){
                    $result = 3002;
                    goto response;
                }
                if(strlen($PBS_UsrDataOpraterRespond)==0){
                    $result = 3003;
                    goto response;
                }
                //接受回应
                $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
                $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();

            }


            //判断结果
            if($ReplyCode != 1){
               $result =  $ReplyCode;
               goto response;
            }else{
                //修改信息
                $dataUsersExchangeLog = array(
                    'MessAge'=>$MessAge,
                    'Status'=>$Status,
                    'UpTime'=>date('Y-m-d H:i:s',time())
                );
                $upUsersExchangeLog = M('jy_users_exchange_log')
                                      ->where('Id = '.$Id)
                                      ->save($dataUsersExchangeLog);
                if($upUsersExchangeLog){

                }else{
                   $result = 5002;
                   goto  response;
                }
            }
            response:

              if($result != 2001){
                    $obj->showmessage('更新失败：错误码'.$result.';提示信息：'.$msgArr[$result].'；');
                }else{
                  $obj->showmessage('更新成功','/jy_admin/UsersExchangeApplication/index');
              }

            ;


        }
        $this->assign('info',$CatUsersExchangeLog);
        $this->display();

    }

}