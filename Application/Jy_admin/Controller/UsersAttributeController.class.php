<?php
/****
*  用户属性
**/
namespace Jy_admin\Controller;
use Protos\OptReason;
use Protos\OptSrc;
use Protos\PBS_AddWhiteList;
use Protos\PBS_AddWhiteListReturn;
use Protos\PBS_ItemOpt;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Controller;
class UsersAttributeController extends ComController {
    public function index(){

        $catPropListField = array(
            'Name',
            'Code',
        );
        $catPropList = M('jy_prop_list')
                        ->field($catPropListField)
            ->select();

        if(IS_POST){
            $obj = new \Common\Lib\func();
            $msgArr = array(
                2001=>"修改成功！",
                3002=>"与游戏服务器断开，请稍后再试！",
                3003=>"与游戏服务器断开，请稍后再试！",
                4001=>"用户信息缺失！",
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
            $result  = 2001;
            $playerid       =       I('param.playerid',0,'intval');                   //用户ID
            $Name           =       I('param.Name',0,'trim');                         //昵称
            $Sex            =       I('param.Sex',0,'intval');                        //1 男 2 女
            $Vip            =       I('param.Vip',0,'intval');                        //vip 等级
            $VipExp         =       I('param.VipExp',0,'intval');                     //vip 经验
            $Gold           =       I('param.Gold',0,'intval');                       //金币
            $diamond        =       I('param.Diamond',0,'intval');                    //钻石
            $Deposit        =       I('param.Deposit',0,'intval');                    //存款
            $Profit         =       I('param.Profit',0,'intval');                     //当日盈利
            $Glevel         =       I('param.Glevel',0,'intval');                     //游戏等级
            $Gexp           =       I('param.Gexp',0,'intval');                       //游戏经验
            $SignDay        =       I('param.SignDay',0,'intval');                    //累计签到天数
            $SignTime       =       I('param.SignTime',0,'trim,strtotime');           //签到时间
            $Gunid          =       I('param.Gunid',0,'intval');                      //当前炮的id
            $IsMc           =       I('param.IsMc',0,'intval');                       //是否是月卡用户
            $McOvertime     =       I('param.McOvertime',0,'trim,strtotime');         //月卡结束时间
            $IsGive         =       I('param.IsGive',1,'intval');                     //是否赠送道具  1 -否 2-是
            $DataProp       =       I('param.Prop','','trim');                        //道具
            $platform       =       I('param.platform',2,'intval');                        //道具
            if($platform == 1){
                define('SERVER_PROTO_IOS', 'http://172.18.238.60');
            }
            if($playerid == 0){
                $result = 4001;
                goto  response;
            }

            $DataInfo = array(
                'Name'                 =>          $Name,
                'Sex'                  =>          $Sex,
                'Vip'                  =>          $Vip,
                'VipExp'               =>          $VipExp,
                'Gold'                 =>          $Gold,
                'Diamond'              =>          $diamond,
                'Deposit'              =>          $Deposit,
                'Profit'               =>          $Profit,
                'Glevel'               =>          $Glevel,
                'Gexp'                 =>          $Gexp,
                'SignDay'              =>          $SignDay,
                'SignTime'             =>          $SignTime,
                'Gunid'                =>          $Gunid,
            );

            //已入protobuf 类
            $obj->ProtobufObj(array(
                'Protos/PBS_UsrDataOprater.php',
                'Protos/PBS_UsrDataOpraterReturn.php',
                'Protos/OptSrc.php',
                'Protos/UsrDataOpt.php',
                'RedisProto/RPB_PlayerData.php',
                'PB_HallNotify.php',
                'OptReason.php',
                'PB_ResourceChange.php',
                'RPB_PlayerNumerical.php',
                'PB_Item.php',
            ));

            $PBS_UsrDataOprater = new PBS_UsrDataOprater();
            $RPB_PlayerData     = new RPB_PlayerData();
            $PB_HallNotify      = new \PB_HallNotify();
            $PB_ResourceChange  = new \PB_ResourceChange();
            $OptReason          = new \OptReason();
            $OptSrc             = new OptSrc();
            $UsrDataOpt         = new UsrDataOpt();

            $PBS_UsrDataOprater->setPlayerid($playerid);
            $PBS_UsrDataOprater->setReason($OptReason::gm_tool);
            $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
            $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
            if($IsMc == 2){
                $RPB_PlayerData->setIsMc(true);
                $RPB_PlayerData->setMcOvertime($McOvertime);
            }
            foreach ($DataInfo as $k=>$v){
                if($v != 0 && $v != '' ){
                    $setData = "set".$k;
                    $RPB_PlayerData->$setData($v);
                    if($k == "Gold"){
                        $PBS_ItemOpt        = new \PB_Item();
                        $PBS_ItemOpt->setId(8);
                        $PBS_ItemOpt->setNum($v);
                        $PB_ResourceChange->appendItems($PBS_ItemOpt);

                    }elseif ($k == "Diamond"){
                        $PBS_ItemOpt        = new \PB_Item();
                        $PBS_ItemOpt->setId(9);
                        $PBS_ItemOpt->setNum($v);
                        $PB_ResourceChange->appendItems($PBS_ItemOpt);
                    }
                }

            }
            //添加道具
            if(!empty($DataProp) && $IsGive ==2){
                foreach ($DataProp as $k=>$v){
                    $PBS_ItemOpt        = new \PB_Item();
                    $PBS_ItemOpt->setNum($v['Num']);
                    $PBS_ItemOpt->setId($v['Itemid']);
                    $PB_ResourceChange->appendItems($PBS_ItemOpt);
                    $PBS_UsrDataOprater->appendItemOpt($PBS_ItemOpt);
                }
            }
            $PB_ResourceChange->setReason($OptReason::gm_tool);
            $PB_ResourceChange->setPlayerid($playerid);
            $PB_HallNotify->setResChanged($PB_ResourceChange);
            $PBS_UsrDataOprater->setNotify($PB_HallNotify);
            $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
            $PBSUsrDataOpraterString = $PBS_UsrDataOprater->serializeToString();
            //发送请求
            G('begin');
            $PBS_UsrDataOpraterRespond =  $obj->ProtobufSend('protos.PBS_UsrDataOprater',$PBSUsrDataOpraterString,$playerid);
            G('end');

            if($PBS_UsrDataOpraterRespond  == 504){
                $result = 3002;
                goto response;
            }
            if(strlen($PBS_UsrDataOpraterRespond)==0){
                $result = 3003;
                goto response;
            }
            //接受回应
            $PBS_UsrDataOpraterReturn =  new PBS_UsrDataOpraterReturn();
            $PBS_UsrDataOpraterReturn->parseFromString($PBS_UsrDataOpraterRespond);
            $ReplyCode = $PBS_UsrDataOpraterReturn->getCode();
            //判断结果
            if($ReplyCode != 1){
                $result = $ReplyCode;
                goto response;
            }
            response:
            $obj->showmessage('code:'.$result.';msg:'.$msgArr[$result].';耗时：'.G('begin','end').'s;');

        }

        $this->assign('info',$catPropList);
        $this->display();
    }

}