<?php
namespace Jy_script\Model;
use Think\Model;
class ChannelInfoModel extends Model{
     //停止表名检查
      protected $autoCheckFields = false;
      //渠道账号
      public function  ChannelList(){
          $ChannelListField = array(
              'account as GroupChannel'
          );
          $info = M('jy_admin_users')
                  ->where('channel = 2 and IsDel = 1')
                  ->field($ChannelListField)
                  ->select();
          if(empty($info)){
              return false;
          }
          $ChannelListSort = array();
          foreach($info as $k=>$v){
              $ChannelListSort[] = '"'.$v['GroupChannel'].'"';
          }
          $response = array(
              'ChannelIn'=>implode(',',$ChannelListSort),
              'ChannelList'=>$info,
          );


          return $response;
      }
}