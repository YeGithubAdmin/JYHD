<?php
namespace Jy_api\Model;
use Protos\OptSrc;
use Protos\PBS_UsrDataOprater;
use Protos\PBS_UsrDataOpraterReturn;
use Protos\UsrDataOpt;
use RedisProto\RPB_PlayerData;
use Think\Exception;
use Think\Model;
class ActivityCenterModel extends Model{
    protected $autoCheckFields = false;

    public function __construct(){
        spl_autoload_register( array($this,'ProtoClass'));
    }

    public function ProtoClass($ClassName){
        $Class  =   explode('\\',$ClassName);
        $Count  =   count($Class);
        if($Count == 2){
            $FileName = PROTOC_PATH.$Class[0].'/'.$Class[1].'.php';
        }else{
            $FileName = PROTOC_PATH.'/'.$Class[0].'.php';
        }
        try{
            if(file_exists($FileName)){

                include  $FileName;
            }else{
                throw new Exception('file is not exists');
            }
        }catch (Exception $exception){
            $exception->getMessage();
        }
    }

    /***
    *  查询活动列表
    * @param  $Channel string  渠道
    * return  array  活动数据
    */
    public function ActivityList($Channel){
        //显示时间
        $DateTime   = date('Y-m-d H:i:s',time());


        //查询是否已存在活动
        $cataChannel = M('conf_activity_father')
                    ->where('Channel = "'.$Channel.'"')
                    ->field(array(
                        'IsCp',
                        'Channel',
                        'Style',
                        'CpChannel',
                    ))->select();

        if(empty($cataChannel)){
            //查询全渠道
            $catData = M('conf_activity_father as a')
                ->join('conf_activity_son as b on a.Id = b.FatherID and b.ConfStatus = 2','left')
                ->where('a.ConfStatus = 2   and  a.Channel = "global"  and 
                            a.ShowStartTime    <= str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")   
                            and  a.ShowEndTime > str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")')
                ->field(array(
                    'a.Id',
                    'a.Style',
                    'a.AbroadTitle',
                    'a.ShowStartTime',
                    'a.ShowEndTime',
                    'a.Sort',
                    'a.Hot',
                    'a.WithinTitle',
                    'b.SonTitle',
                    'b.ImgCode',
                    'b.Schedule',
                    'b.Jump',
                    'b.Explain',
                    'b.GiveInfo',
                    'b.Id as SonId',
                    'b.TypeCode',
                ))
                ->order('b.Sort asc')
                ->select();
        }else{
            //过滤复制情况
            $CpChannel = array();
            $Style     = array();
            foreach ($cataChannel as $k=>$v){
                if($v['IsCp'] == 2){
                    $CpChannel[] = '"'.$v['CpChannel'].'"';
                }
                $Style[] = $v['Style'];
            }
            if(!empty($CpChannel)){
                $CpChannel = array_unique($CpChannel);
                $CpChannel = implode(',',$CpChannel);
                $Style = array_unique($Style);
                $Style = implode(',',$Style);
                if(empty($Style)){
                    return array();
                }
                $where = 'a.ConfStatus = 2  and a.Channel in ('.$CpChannel.') and 
                            a.Style in ('.$Style.') and         
                            a.ShowStartTime    <= str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")   
                            and  a.ShowEndTime > str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")
                            or  a.IsCp = 1  and  a.ConfStatus = 2   and  a.Channel = "'.$Channel.'"  and 
                            a.ShowStartTime    <= str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")   
                            and  a.ShowEndTime > str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")               
                            ';
            }else{
                $where = 'a.ConfStatus = 2   and  a.Channel = "'.$Channel.'"  and 
                            a.ShowStartTime    <= str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")   
                            and  a.ShowEndTime > str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")';
            }
            $catData = M('conf_activity_father as a')
                ->join('conf_activity_son as b on a.Id = b.FatherID and b.ConfStatus = 2','left')
                ->where($where)
                ->field(array(
                    'a.Id',
                    'a.Style',
                    'a.AbroadTitle',
                    'a.ShowStartTime',
                    'a.ShowEndTime',
                    'a.Sort',
                    'a.Hot',
                    'a.WithinTitle',
                    'b.SonTitle',
                    'b.ImgCode',
                    'b.Schedule',
                    'b.Jump',
                    'b.Explain',
                    'b.GiveInfo',
                    'b.Id as SonId',
                    'b.TypeCode',
                ))
                ->order('b.Sort asc')
                ->select();
        }


        return  $catData;
    }
    /***
    * 用户充值
    * @param  playerid int 用户ID
    * return  返回当前充值量
    */
    public function UsersPay($playerid,$StartTime,$EndTime){
        $More = $playerid%10;
        $CatData = M('log_users_shop_'.$More)
                   ->where('playerid = '.$playerid.'  
                            and DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  
                            and  DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")')
                   ->field(array(
                        'sum(Price) as Price'
                   ))
                   ->select();
        return $CatData;
    }

    /***
    *  查询领取情况
    *  @param  $playerid int 用户ID
    *  return  array
    */
    public function ReceiveStatus($playerid,$StartTime,$EndTime){
        $catData = M('conf_activity_son as a')
            ->join('log_users_activity as b on a.Id = b.ActSonId and b.playerid = '.$playerid,'left')
            ->where('a.ConfStatus = 2 and  b.DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")
                            and  b.DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") ')
            ->field(array(
               'a.Id as Id',
               'count(b.Id) as Num',
            ))
            ->group('Id')
            ->select();
        foreach ($catData as $k=>$v) $catDataSort[$v['Id']] = $v;
        return $catDataSort;

    }


    /***
     *  查询领取情况
     *  @param  $playerid int 用户ID
     *  return  array
     */
    public function SameReceiveStatus($playerid){
        $Time = strtotime(date('Y-m-d',time()));
        $StartTime = date('Y-m-d H:i:s',$Time);
        $EndTime   = date('Y-m-d H:i:s',$Time+24*60*60);
        $catData = M('conf_activity_son as a')
            ->join('log_users_activity as b on a.Id = b.ActSonId and b.playerid = '.$playerid,'left')
            ->where('a.ConfStatus = 2 and b.DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s")  
                            and  b.DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") ')
            ->field(array(
                'a.Id as Id',
                'count(b.Id) as Num',
            ))
            ->group('Id')
            ->select();
        foreach ($catData as $k=>$v) $catDataSort[$v['Id']] = $v;
        return $catDataSort;

    }


    /***
     *  查抽奖物品
     *  return  array
     */
    public function LuckdrawInfo(){
        $catData = M('conf_activity_luckdraw')
                   ->where('ConfStatus = 2')
                   ->field(array(
                        'ImgCode',
                        'Type',
                        'Code',
                        'GoodsName',
                        'GetNum',
                        'Number',
                   ))
                   ->order('Sort asc')
                   ->select();
        return $catData;
    }
    /***
    * 添加物品
    */
    public function  UserGoodsAdd($playerid,$VerSion,$Goods){
        $ComFun = D('ComFun');
        $PBS_UsrDataOprater          =  new PBS_UsrDataOprater();
        $RPB_PlayerData              =  new RPB_PlayerData();
        $PBS_UsrDataOpraterReturn    =  new PBS_UsrDataOpraterReturn();
        $UsrDataOpt                  =  new UsrDataOpt();
        $OptSrc                      =  new OptSrc();
        $OptReason                   =  new \OptReason();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setOpt($UsrDataOpt::Modify_Player);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PBS_UsrDataOprater->setReason($OptReason::promotion_reward);
        foreach ($Goods as $k=>$v){
            $Num  = $v['Number'];
            $Code = $v['Code'];
            switch ($v['Type']){
                //金币
                case 1:
                    $RPB_PlayerData->setGold($Num);
                    break;
                //钻石
                case 2:
                    $RPB_PlayerData->setDiamond($Num);
                    break;
                //道具
                case 3:
                    $PB_Item  =  new \PB_Item();
                    $PB_Item->setId($Code);
                    $PB_Item->setNum($Num);
                    $PBS_UsrDataOprater->appendItemOpt($PB_Item);
                    break;
            }
        }
        $PBS_UsrDataOprater->setPlayerData($RPB_PlayerData);
        $serializeToString   = $PBS_UsrDataOprater->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($serializeToString),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$VerSion,
        );
        $Response   =  $ComFun->ProtobufSend($Header,$serializeToString);
        if($Response == 504 && strlen($Response) == 0){
            return false;
        }
        $PBS_UsrDataOpraterReturn->parseFromString($Response);
        $RelyCode = $PBS_UsrDataOpraterReturn->getCode();
        if($RelyCode != 1){
            return false;
        }
        return true;
    }
    /***
    * 发送邮件
    */
    public function SenEmail($playerid,$VerSion,$Data){
        $ComFun = D('ComFun');
        $PBS_UsrDataOprater          =  new PBS_UsrDataOprater();
        $EmailType                   =  new \EmailType();
        $PB_Email                    =  new \PB_Email();
        $PBS_UsrDataOpraterReturn    =  new PBS_UsrDataOpraterReturn();
        $OptSrc                      =  new OptSrc();
        $PBS_UsrDataOprater->setPlayerid($playerid);
        $PBS_UsrDataOprater->setSrc($OptSrc::Src_PHP);
        $PB_Email->setTitle('系统通知');
        $PB_Email->setSender('系统');
        $PB_Email->setData($Data);
        $PB_Email->setType($EmailType::EmailType_Sys);
        $PBS_UsrDataOprater->setSendEmail($PB_Email);

        $serializeToString   = $PBS_UsrDataOprater->serializeToString();
        $Header = array(
            'PBName:'.'protos.PBS_UsrDataOprater',
            'PBSize:'.strlen($serializeToString),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$VerSion,
        );
        $Response   =  $ComFun->ProtobufSend($Header,$serializeToString);
        if($Response == 504 && strlen($Response) == 0){
            return false;
        }
        $PBS_UsrDataOpraterReturn->parseFromString($Response);
        $RelyCode = $PBS_UsrDataOpraterReturn->getCode();
        if($RelyCode != 1){
            return false;
        }
        return true;

    }



    /***
    * 查询单个活动信息
    */
    public function  SingleActivityInfo($ActivityID,$Channel){
        //显示时间
        $DateTime   = date('Y-m-d H:i:s',time());
        $catData = M('conf_activity_father as a')
            ->join('conf_activity_son as b on a.Id = b.FatherID and b.ConfStatus = 2 and b.Id = '.$ActivityID)
            ->where('a.ConfStatus = 2     and 
                            a.ShowStartTime    <= str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")   
                            and  a.ShowEndTime > str_to_date("'.$DateTime.'","%Y-%m-%d %H:%i:%s")')
            ->field(array(
                'a.Style',
                'b.Schedule',
                'a.ShowStartTime',
                'a.ShowEndTime',
                'b.GiveInfo',
                'b.TypeCode',
            ))
            ->find();
        return  $catData;
    }

    /***
    * 抽奖
    * @param $data array 抽奖内容
    * return  奖励信息
    */
    public function GetLuckDraw($data){
            $ComFun = D('ComFun');
            $proArr = array();
            foreach ($data as $k=>$v){
                $proArr[] = $v['Reta'];
            }
            $GoodsId= $ComFun->getRand($proArr);
            return $GoodsId;
    }
    /***
    * 获取当前炮倍信息
    * @param   $playerid int 用户ID
    * @param   $StartTime int 活动开始时间
    * @param   $EndTime   int 活动结束时间
    * return array  炮倍信息
    */
    public function  DoubleGunInfo($playerid,$VerSion,$StartTime,$EndTime){
          $ComFun = D('ComFun');
          $PB_TaskAInfoRequest = new  \PB_TaskAInfoRequest();
          $PB_TaskAInfoReturn  = new  \PB_TaskAInfoReturn();
          $PB_TaskAInfoRequest->setPlayerid($playerid);
          $PB_TaskAInfoRequest->setStart($StartTime);
          $PB_TaskAInfoRequest->setEnd($EndTime);

          $serializeToString  = $PB_TaskAInfoRequest->serializeToString();
          $Header = array(
            'PBName:'.'PB_TaskAInfoRequest',
            'PBSize:'.strlen($serializeToString),
            'UID:'.$playerid,
            'PBUrl:'.CONTROLLER_NAME.ACTION_NAME,
            'Version:'.$VerSion,
         );
        $Response   =  $ComFun->ProtobufSend($Header,$serializeToString);
        if($Response == 504 || strlen($Response) == 0){
            return false;
        }
        $PB_TaskAInfoReturn->parseFromString($Response);
        $RelyCode = $PB_TaskAInfoReturn->getCode(
        );
        if($RelyCode != 1){
            return false;
        }
        $getTasksCount =  $PB_TaskAInfoReturn->getTasksCount();
        $Data = array();
        for($i=0;$i<$getTasksCount;$i++){
            $Data[$PB_TaskAInfoReturn->getTasks()[$i]->getUnlockGun()]['unlock_gun']  = $PB_TaskAInfoReturn->getTasks()[$i]->getUnlockGun();
            $Data[$PB_TaskAInfoReturn->getTasks()[$i]->getUnlockGun()]['unlock_time'] = $PB_TaskAInfoReturn->getTasks()[$i]->getUnlockTime();
        }

        return  $Data;
    }

    /***
    * 查询子级活动
    * @param $FatherID int 父级ID
    * return array
    */
    public function catSonInfo($FatherID){
        $catData = M('conf_activity_son')
                   ->where('FatherID = '.$FatherID.' and ConfStatus = 2')
                   ->field(array(
                       'Id as ActivityID',
                   ))
                   ->select();

        return $catData;
    }

    /***
    *  查看已查看的用户活动
    *  @param $playerid int 用户ID
    *  return array
    */

    public function catUsersSon($playerid){
        $catData = M('log_cat_activity')
                   ->where('playerid = '.$playerid)
                   ->field(array(
                        'ActivityID',
                   ))
                   ->group('ActivityID')
                   ->select();
        $catDataSort = array();
        foreach ($catData as $k=>$v) $catDataSort[$v['ActivityID']] = $v['ActivityID'];
        return $catDataSort;
    }


}
