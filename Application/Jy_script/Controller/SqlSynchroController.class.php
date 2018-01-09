<?php
/**
*  表结构同步
*/
namespace Jy_script\Controller;
use Think\Controller;
use Think\Model;
class SqlSynchroController extends Controller {
    public function index(){
            $Model       =  new  Model();
            //本地
            $LocalTable       =  $Model->query('show tables');
            $LocalFIELDS =  array();
            foreach ($LocalTable as $k=>$v){
                $LocalFIELDS[$v['Tables_in_jyhd']]  =  $Model->query('SHOW FULL FIELDS FROM '.$v['Tables_in_jyhd']);
            }

            //测试
            $TestTable        = $Model->db(1,'DB_CONFIG1')->query('show tables');
            $TetsFIELDS =  array();
            foreach ($TestTable as $k=>$v){

                $TetsFIELDS[$v['tables_in_jyhd']]   =  $Model->db(1,'DB_CONFIG1')->query('SHOW FULL FIELDS FROM '.$v['tables_in_jyhd']);
            }
            foreach ($LocalFIELDS as $k=>$v){

            }

        // 正式
            $FormalTale = $Model->db(2,'DB_CONFIG2')->query('show tables');
            $FormalFIELDS = array();
            foreach ($FormalTale as $k=>$v){
                $FormalFIELDS[$v['tables_in_jyhd']] =  $Model->db(2,'DB_CONFIG2')->query('SHOW FULL FIELDS FROM '.$v['tables_in_jyhd']);
            }
            //本地测试对比
            $LocalTestKey   = array_diff_key($LocalFIELDS,$TetsFIELDS);

            dump($LocalTestKey);
            //测试正式对比



     }
}