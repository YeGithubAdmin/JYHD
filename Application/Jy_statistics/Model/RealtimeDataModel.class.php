<?php
namespace Jy_statistics\Model;
use Think\Model;
class RealtimeDataModel extends Model{

    protected $autoCheckFields = false;
     /***
     *  查询在线情况
     * @param  $where  string 条件
     */
     public function  catOnLine($where){
         $model = new Model();
         $Data = $model->query('SELECT a.`Id`,a.`UserNum`,DATE_FORMAT(a.`t`,"%k") AS i 
                                              FROM (SELECT `Id`,sum(`UserNum`) as UserNum ,DATE_FORMAT(`DateTime`,"%Y-%m-%d %H:%i")  as t
                                              FROM jy_real_time_online 
                                              WHERE  '.$where.'
                                              GROUP BY t ORDER  BY `DateTime` DESC ) AS a  
                                              GROUP BY i ORDER BY i ');
         return $Data;
     }

}
