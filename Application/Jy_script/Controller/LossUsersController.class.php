<?php
/**
* 用户流失分析
*/
namespace Jy_script\Controller;
use Protos\PBS_SysBroadcast;
use Protos\PBS_SysBroadcastReturn;
use Think\Controller;
class LossUsersController extends Controller {
    public function index(){
          $LossUsers = D('LossUsers');
          //用户流失
          $LossData  =   $LossUsers->LossUsers(8);
          //用户非次日流失
          $WLossData =   $LossUsers->WLossUsers(8);
          //回流用户
          $Backflow  =   $LossUsers->Backflow(8);
          $DataTime  =   strtotime(date('Y-m-d',time()-24*60*60));

          foreach ($LossData as $k=>$v){
              $LossData[$k]['DateTime']   =  date('Y-m-d',$DataTime) ;
              $LossData[$k]['MeterDate']  =  date('Y-m-d',$DataTime-7*24*60*60) ;
              if($WLossData[$v['Channel']]){
                  $LossData[$k]['WLoss']      =  $WLossData[$v['Channel']]['WLoss'];
                  $LossData[$k]['WLossPrice'] =  $WLossData[$v['Channel']]['WLossPrice'];
              }else{
                  $LossData[$k]['WLoss']      = 0;
                  $LossData[$k]['WLossPrice'] = 0;
              }
              if($Backflow[$v['Channel']]){
                  $LossData[$k]['Backflow'] =  $Backflow[$v['Channel']]['Backflow'];
              }else{
                  $LossData[$k]['Backflow'] = 0;
              }
          }
           $AddData = M('log_users_loss')
                      ->addAll($LossData);


    }

}