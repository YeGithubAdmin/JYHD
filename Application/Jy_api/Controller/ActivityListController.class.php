<?php
/***
 * 活动列表
 * @param array   $msgArr  2*  成功  3.* 超时无响应  4.*丢失或参数缺失  5.* 服务器配置问题  6.*来不明  7.* 权限问题 8.* 配置问题
 * @param int     $page         页码
 * @param int     $num          页数
 * @param int     $channelid    渠道id
 * @param int     $platform     平台号  1-iso  2-安卓
 * @param unknow  $version      版本号
 ***/
namespace Jy_api\Controller;
use Jy_api\Controller\ComController;
use Think\Controller;
class ActivityListController extends ComController {
    public function index(){
        $DataInfo       =       $this->DataInfo;
        $msgArr         =       $this->msgArr;


        $obj = new  \Common\Lib\func();

        $ChannelID =   $this->channelid;
        $result = 2001;
        $info   =  array();
        //当前时间
        $time = date('Y-m-d H:i:s',time());
        //状态码
        $msgArr[4006] = "用户信息缺失！";

        $activityFatherListField = array(
            'a.Type',
            'a.Title',

            'unix_timestamp(a.AddUpStartTime) as AddUpStartTime',
            'unix_timestamp(a.AddUpEndTime) as AddUpEndTime',
            'a.Describe',
            'b.Title as TitleSon',
            'b.Schedule',
            'b.ImgCode',
            'c.GetNum*b.Number as Number',
            'c.Name as GoodsName',
            'c.Type as GoodsType',
            'b.ImgUrl',
            'b.Id as activityID',
        );
        $playerid = $DataInfo['playerid'];
        if(empty($playerid)){
            $result  = 4006;
            goto response;
        }
        $activityFatherList = M('jy_activity_father_list as a')
                            ->join('jy_activity_son_list as b on b.FatherID = a.Id','left')
                            ->join('jy_goods_all as c on b.GoodsID  = c.Id')
                            ->field($activityFatherListField)
                            ->order('b.Schedule asc')
                            ->where('a.Channel = '.$ChannelID.' and 
                                    a.ShowStartTime <= str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s")         
                                    and  str_to_date("'.$time.'","%Y-%m-%d %H:%i:%s") <= a.ShowEndTime')
                            ->select();

        //查询充值记录   PayMax   单笔充值最大数  PapUp 累计充值
        $catUserOrderField = array(
            'count(b.Id) as Id',
            'sum(b.Price) as PriceNum',
            'max(b.Price) as PriceMax',
            'a.Type',
            'a.AddUpEndTime',
            'a.AddUpStartTime'
        );
        $MoreThan = $playerid%10;
        $catUserOrder = M('jy_activity_father_list as a')
                        ->join('log_users_shop_'.$MoreThan.' as b on b.DateTime <= a.AddUpEndTime 
                                and  b.DateTime >= a.AddUpStartTime','left')
                        ->where(' a.Channel = '.$ChannelID.' and  b.playerid = '.$playerid)
                        ->group('a.Type')
                        ->field($catUserOrderField)
                        ->select();


        $newUserOder  =  array();
        foreach ($catUserOrder as $k=>$v){
            $newUserOder[$v['Type']] = $v;
        }
        //查询领奖记录
        $catUsersActivityTheawardFile = array(
                                            'a.activityID',
                                            'a.activityID as ID',
                                            'a.Type',
                                            'count(a.activityID) as num'
                                        );
        $catUsersActivityTheawardLog = M('jy_users_activity_theaward_log as a ')
                                        ->join('jy_activity_father_list as b')
                                        ->where('a.playerid = '.$playerid.'  and  a.Type = b.Type  and a.DateTime  <= b.AddUpEndTime  and   a.DateTime >= a.AddUpStartTime ')
                                        ->field($catUsersActivityTheawardFile)
                                        ->group('a.activityID')
                                        ->select();




        $UsersTheawardLog = array();
        foreach ($catUsersActivityTheawardLog as $key=>$val){
            $UsersTheawardLog[$val['activityID']] = $val;
        }
        foreach ($activityFatherList as $k=>$v){
            if(empty($v['activityID'])){
                   unset($activityFatherList[$k]);
            }
        }
        // 1-不可领  2-可领  3-已领取
        $NewactivityFatherList = array();
        foreach ($activityFatherList as $k=>$v){
            $dataInfo  = array();
            $status = 1;          //状态
            $PriceNum   =   empty($newUserOder[$v['Type']]['PriceNum']) ? 0:$newUserOder[$v['Type']]['PriceNum'];        //充值数
            $PriceNum   =   round($PriceNum);
            $PriceMax   =   empty($newUserOder[$v['Type']]['PriceMax']) ? 0:$newUserOder[$v['Type']]['PriceMax'];        //充值最大数
            $Cumulative =   $UsersTheawardLog[$v['activityID']];
            $SureNum    =   0;    //领取次数
                //类型
            switch ($v['Type']){
                //累计充值
                case 1 :
                  if(!empty($Cumulative)){
                      $status = 3;
                  }else{
                      if($PriceNum == 0 ){
                          $status = 1;
                      }elseif($v['Schedule'] > $PriceNum){
                          $status = 1;
                      }elseif($v['Schedule'] <= $PriceNum && empty($Cumulative)){
                          $status = 2;
                      }
                  }
                break;
                //单笔充值
                case 2 :
                    if(!empty($Cumulative)){
                        $status = 3;
                    }else{
                        if($PriceMax == 0 ){
                            $status = 1;
                        }elseif($v['Schedule'] > $PriceMax){
                            $status = 1;
                        }elseif($v['Schedule'] <= $PriceMax && empty($Cumulative)){
                            $status = 2;
                        }
                    }

                    break;
                //循环充值
                case 3 :
                    if(empty($Cumulative)){
                        $Num = 0;
                    }else{
                        $Num = $Cumulative['num'];
                    }
                    if($PriceNum == 0){
                        $status = 1;
                    }
                    $ScheduleNum = floor($PriceNum/$v['Schedule']);         //总共可以领取次数
                    $SureNum     =  $ScheduleNum-$Num;
                    if($SureNum>0){
                        $status = 2;
                    }else{
                        $status = 1;
                    }

                    break;
            }
            if($v['Type']<=3){
                $dataInfo['Status']                     =       $status;
                $dataInfo['TitleSon']                   =       $v['TitleSon'];
                $dataInfo['activityID']                 =       $v['activityID'];
                $dataInfo['ImgCode']                    =       $v['ImgCode'];
                $dataInfo['GoodsName']                  =       $v['GoodsName'];
                $dataInfo['GoodsType']                  =       $v['GoodsType'];
                $dataInfo['Number']                     =       $v['Number'];
                $dataInfo['Schedule']                   =       $v['Schedule'];
                $dataInfo['PriceNum']                   =       $PriceNum;
                if($v['Type']==3){
                    $dataInfo['SureNum']                 =       $SureNum;
                }
            }else{
                if(!empty($v['ImgUrl'])){
                    $dataInfo['ImgUrl'] = strstr($v['ImgUrl'],C('AGREEMENT')) ? $v['ImgUrl'] :  $v['ImgUrl'] = C('IMGURL').'/'.$v['ImgUrl'];
                }else{
                    $dataInfo['ImgUrl'] = $v['ImgUrl'];
                }
            }
            $AddUpEndTime  = array(
                'year'=>date('Y',$v['AddUpEndTime']),
                'month'=>date('m',$v['AddUpEndTime']),
                'day'=>date('d',$v['AddUpEndTime']),
                'dateTime'=>date('H:i',$v['AddUpEndTime']),
            );
            $AddUpStartTime = array(
                'year'=>date('Y',$v['AddUpStartTime']),
                'month'=>date('m',$v['AddUpStartTime']),
                'day'=>date('d',$v['AddUpStartTime']),
                'dateTime'=>date('H:i',$v['AddUpStartTime']),
            );
            $NewactivityFatherList[$v['Type']]['Son'][]                 =     $dataInfo;
            $NewactivityFatherList[$v['Type']]['Type']                  =     $v['Type']  ;
            $NewactivityFatherList[$v['Type']]['AddUpStartTime']        =     $AddUpStartTime  ;
            $NewactivityFatherList[$v['Type']]['AddUpEndTime']          =     $AddUpEndTime;
            $NewactivityFatherList[$v['Type']]['Title']                 =     $v['Title']  ;
            $NewactivityFatherList[$v['Type']]['Describe']              =     $v['Describe']  ;
        }
        //组装数组





        foreach ($NewactivityFatherList as $k=>$v){
                $info[] =  $v;
        }
        response:
            $response = array(
                'result' => $result,
                'msg' => $msgArr[$result],
                'sessionid'=>$DataInfo['sessionid'],
                'data' => $info,
            );


            $this->response($response,'json');

    }
}