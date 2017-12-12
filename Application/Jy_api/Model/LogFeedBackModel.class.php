<?php
namespace Jy_api\Model;
use Think\Model;
class LogFeedBackModel extends Model{
    protected $autoCheckFields = false;
    //查询数据
    public  function  Info($field,$where){
        $Data = M('log_feed_back')
            ->where($where)
            ->field($field)
            ->order('DateTime desc')
            ->limit(0,30)
            ->select();
        return $Data;

    }
    //插入数据
    public function AddDate($field){
        $Add  =  M('log_feed_back')
                 ->add($field);
        return   $Add;
    }

    //查询是否超过条数
    public  function  CatCount($playerid){

        $time        = time();
        $DayNum      = 24*60*60;
        $DayTime     = strtotime(date('Y-m-d'),$time);
        $StartTime   = date('Y-m-d H:i:s',$DayTime-15*$DayNum);
        $EndTime     = date('Y-m-d H:i:s',$DayTime+$DayNum);
        //反馈记录
        $where = 'playerid = '.$playerid.' and  DateTime < str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s")  
                 and  DateTime >= str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") and IsDel = 1';
        $Data = M('log_feed_back')
            ->where($where)
            ->field('Id')
            ->order('DateTime desc')
            ->limit(0,30)
            ->select();
        $count = count($Data);
        if($count >= 30){
            return false;
        }
        return true;
    }

    //一个小时是否发送6次
    public function SendCount($playerid){
        $StartTime = date('Y-m-d H:i:s',time()-60*60);
        $EndTime   = date('Y-m-d H:i:s',time());
        $Data = M('log_feed_back')
            ->where('playerid =  '.$playerid.' and  str_to_date("'.$StartTime.'","%Y-%m-%d %H:%i:%s") >= DateTime 
                    and str_to_date("'.$EndTime.'","%Y-%m-%d %H:%i:%s") <= DateTime')
            ->field('Id')
            ->select();
        $count = count($Data);
        if($count >= 6) {
            return false;
        }
        return true;
    }


    //过滤敏感词
    public function  SensitiveWords($Content){
        $SensitiveWords = @file_get_contents(JY_ROOT.'/resources/Words/SensitiveWords.txt');
        $SensitiveWords = explode("\n",$SensitiveWords);
        $Replace = $Content;
        foreach ($SensitiveWords as $k=>$v){
            $Replace =   str_replace($v,"*",$Replace);
        }
        return $Replace;
    }



     public  function TimeAgo($agoTime){
        $agoTime = (int)$agoTime;
        // 计算出当前日期时间到之前的日期时间的毫秒数，以便进行下一步的计算
        $time = time() - $agoTime;
        if ($time >= 31104000) { // N年前
            $num = (int)($time / 31104000);
            return $num.'年前';
        }
        if ($time >= 2592000) { // N月前
            $num = (int)($time / 2592000);
            return $num.'月前';
        }
        if ($time >= 86400) { // N天前
            $num = (int)($time / 86400);
            return $num.'天前';
        }
        if ($time >= 3600) { // N小时前
            $num = (int)($time / 3600);
            return $num.'小时前';
        }
        if ($time > 60) { // N分钟前
            $num = (int)($time / 60);
            return $num.'分钟前';
        }
        return '1分钟前';
    }


}
