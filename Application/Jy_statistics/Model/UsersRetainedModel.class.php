<?php
namespace Jy_statistics\Model;
use Think\Model;
class UsersRetainedModel extends Model{

    protected $autoCheckFields = false;

    //查询列表数据
    public function  NumberCount($where){

        $info = M('log_channel_data')
            ->where($where)
            ->count();
        return $info;
    }
    public function  Info($where,$page,$num){
        $info = M('log_channel_data')
                ->where($where)
                ->field(' 
                  Channel,
                  round(UsersOneNum*100,2) as UsersOneNum,
                  round(UsersThreeNum*100,2) as UsersThreeNum,
                  round(UsersSevenNum*100,2) as UsersSevenNum,
                  round(UsersThirtyNum*100,2) as UsersThirtyNum,
                  date_format(DateTime,"%Y-%m-%d") as  DateTime'
            )->order('DateTime desc')
            ->limit($page*$num,$num)
            ->select();
        return $info;
    }

    //全渠道数据
    public function GlobalInfoReg($where,$page,$num){
        $model = new Model();
        $info  = $model->query(
            'SELECT * FROM (
                SELECT 
                  date_format(DateTime,"%Y-%m-%d") as  DateTime,
                  round(100*sum(UsersOneNum*RegNum)/sum(RegNum),2) as UsersOneNum, 
                  round(100*sum(UsersThreeNum*RegNum)/sum(RegNum),2) as UsersThreeNum, 
                  round(100*sum(UsersSevenNum*RegNum)/sum(RegNum),2) as UsersSevenNum, 
                  round(100*sum(UsersThirtyNum*RegNum)/sum(RegNum),2) as UsersThirtyNum
                FROM log_channel_data  
                WHERE ('.$where.') 
                GROUP BY DateTime 
                ) as a 
                
                ORDER BY DateTime DESC
                LIMIT '.$page*$num.','.$num
        );

        return $info;

    }

    public function GlobalCountReg($where){
        $model = new Model();
        $info  = $model->query(
            'SELECT * FROM (
                SELECT 
                  date_format(DateTime,"%Y-%m-%d") as  DateTime,
                  round(100*sum(UsersOneNum*RegNum)/sum(RegNum),2) as UsersOneNum, 
                  round(100*sum(UsersThreeNum*RegNum)/sum(RegNum),2) as UsersThreeNum, 
                  round(100*sum(UsersSevenNum*RegNum)/sum(RegNum),2) as UsersSevenNum, 
                  round(100*sum(UsersThirtyNum*RegNum)/sum(RegNum),2) as UsersThirtyNum
                FROM log_channel_data  
                WHERE ('.$where.') 
                GROUP BY DateTime 
          
                ) as a '
        );
        return count($info);
    }
}
