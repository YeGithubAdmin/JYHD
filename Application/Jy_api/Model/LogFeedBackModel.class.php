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
            ->select();
        return $Data;

    }
    //插入数据
    public function AddDate($field){
        $Add  =  M('log_feed_back')
                 ->add($field);
        return   $Add;
    }

}
