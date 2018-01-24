<?php
/***
*   付费分析
*/
namespace Jy_statistics\Controller;
use Think\Controller;
use Think\Model;
defined('THINK_PATH') or exit('Access Defined!');
class PayAnalysisController extends ComController {
    //日付费统计
    public function DailyPay(){
        $page      = $this->page;
        $num       = $this->num;
        //默认30天数据
        $time =  strtotime(date('Y-m-d',time()-24*60*60));
        $DayTime  = 24*60*60;
        $StartTime  = date('Y-m-d',$time-$DayTime*29);
        $EndTime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['Channel']     = I('param.Channel','','trim');
        $search['Num']         = I('param.Num',$num,'trim');
        $where = '1';
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        if($search['datemin'] != ''){
            $where .= ' and DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['Channel'] != ''){
            $where .= ' and Channel = "'.$search['Channel'].'"';
        }
        $count  = M('log_channel_data')

            ->field(
                array(
                    'sum(ActiveNum) as ActiveNum ',
                    'sum(RegNum) as RegNum',
                    'sum(UserPayNum)as UserPayNum ',
                    'sum(UserPayNum)-sum(UserPayNumOld) as  RegPayUsers',
                    'sum(First) as First',
                    'round(sum(TotalMoney),2) as TotalMoney',
                    'round(sum(TotalMoney) - sum(OrderTotalOld),2)  as  RegPayMoney',
                    'if(sum(TotalMoney)/sum(ActiveNum),round(sum(TotalMoney)/sum(ActiveNum),2),0) as ARPU',
                    'if(sum(TotalMoney)/sum(UserPayNum),round(sum(TotalMoney)/sum(UserPayNum),2),0)  as ARPPU',
                    'if((sum(TotalMoney) - sum(OrderTotalOld))/sum(RegNum),round((sum(TotalMoney) - sum(OrderTotalOld))/sum(RegNum),2),0)  as RegARPU',
                    'if((sum(TotalMoney)-sum(OrderTotalOld))/(sum(UserPayNum)-sum(UserPayNumOld)),round((sum(TotalMoney)-sum(OrderTotalOld))/(sum(UserPayNum)-sum(UserPayNumOld)),2),0)  as RegARPU',
                    'if(sum(MallGold),round(sum(MallGold),2),0)  as MallGold',
                    'if(sum(MallDiamonds),round(sum(MallDiamonds),2),0) as MallDiamonds',
                    'count(Id) as Num',
                )

            )
            ->where($where)
            ->select();
        $Page       = new \Common\Lib\Page($count[0]['Num'],$search['Num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)


        $catData = M('log_channel_data')
            ->where($where)
            ->field(
                array(
                    'Channel',
                    'DateTime',
                    'ActiveNum',
                    'RegNum',
                    'UserPayNum',
                    '(UserPayNum-UserPayNumOld) as RegPayUsers',
                    'First',
                    'TotalMoney',
                    'round(TotalMoney - OrderTotalOld,2)  as  RegPayMoney',
                    'if(TotalMoney/ActiveNum,round(TotalMoney/ActiveNum,2),0) as ARPU',
                    'if(TotalMoney/UserPayNum,round(TotalMoney/UserPayNum,2),0)  as ARPPU',
                    ' if((TotalMoney-OrderTotalOld )/RegNum,round((TotalMoney-OrderTotalOld )/RegNum,2),0)  as RegARPU',
                    ' if((TotalMoney-OrderTotalOld )/(UserPayNum-UserPayNumOld),round((TotalMoney-OrderTotalOld )/(UserPayNum-UserPayNumOld),2),0)  as RegARPU',
                    'MallGold',
                    'MallDiamonds',
                )
            )->order('DateTime desc')
            ->limit($page*$search['Num'],$search['Num'])
            ->select();
        $show  = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('Channel',$Channel);
        $this->assign('info',$catData);
        $this->assign('count',$count);
        $this->display();
    }

    /***
    *   日付费统计 导出
    */
    public function  DailyPayExcel(){
        $ComFun = D('ComFun');
        $Data   = I('param.data','','trim');

        $expTitle = "付费分析 -日付费统计";
        $expCellName = array(
            '日期',
            '渠道',
            '登陆账号数DAU',
            '新账号数',
            '付费人数APA',
            '新增账号付费人数',
            '首次付费人数',
            '付费总金额',
            '新增账号付费金额',
            'ARPU',
            'ARPPU',
            '新增ARPU',
            '新增ARPPU',
            '商城金币购买付费',
            '商城钻石购买付费',
        );

        $ComFun->exportExcel($expTitle,$expCellName,json_decode($Data,true));
    }

    //首充付费时间统计
    public function TimeStatistics(){

        $page      = $this->page;
        $num       = $this->num;
        //默认30天数据
        $time =  strtotime(date('Y-m-d',time()-24*60*60));
        $DayTime  = 24*60*60;
        $StartTime  = date('Y-m-d',$time-$DayTime*29);
        $EndTime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['Channel']     = I('param.Channel','','trim');
        $search['Num']         = I('param.Num',$num,'trim');
        $where = '1';
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        if($search['datemin'] != ''){
            $where .= ' and DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['Channel'] != ''){
            $where .= ' and Channel = "'.$search['Channel'].'"';
        }
        $count  = M('log_channel_data')

            ->field(
                array(
                    'sum(RegNum) as RegNum',
                    'sum(First) as First',
                    'round(sum(FirstMoney),2) as FirstMoney',
                    'count(Id) as Num',
                )
            )
            ->where($where)
            ->select();
        $Page       = new \Common\Lib\Page($count[0]['Num'],$search['Num']);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $catData = M('log_channel_data')
            ->where($where)
            ->field(
                array(
                    'Channel',
                    'DateTime',
                    'First',
                    'FirstMoney',
                )
            )->order('DateTime desc')
            ->limit($page*$search['Num'],$search['Num'])
            ->select();
        $show  = $Page->show();// 分页显示输出
        $this->assign('search',$search);
        $this->assign('page',$show);
        $this->assign('Channel',$Channel);
        $this->assign('info',$catData);
        $this->assign('count',$count);
        $this->display();
    }
    /***
     *   首充付费时间统计 导出
     */
    public function  TimeStatisticsExcel(){
        $ComFun = D('ComFun');
        $Data   = I('param.data','','trim');
        $expTitle = "付费分析 -付费总金额";
        $expCellName = array(
            '日期',
            '渠道',
            '购买用户数',
            '付费总金额',

        );
        $ComFun->exportExcel($expTitle,$expCellName,json_decode($Data,true));
    }

    //订单流水
    public function OrderFlow(){
        //默认30天数据
        $time =  strtotime(date('Y-m-d',time()-24*60*60));
        $DayTime  = 24*60*60;
        $StartTime  = date('Y-m-d',$time-$DayTime*29);
        $EndTime    = date('Y-m-d',$time);
        $search['datemin']     = I('param.datemin',$StartTime,'trim');
        $search['datemax']     = I('param.datemax',$EndTime,'trim');
        $search['Channel']     = I('param.Channel','','trim');
        $where = 'a.Status = 2';
        //渠道列表
        $Channel = M('jy_admin_users')
            ->where('channel = 2 and isdel = 1')
            ->field(array(
                'account',
                'name',
            ))
            ->select();
        //购买物品
        $MallGoods = M('jy_goods_all')
                    ->where('ShowType = 1 and IsDel = 1 or Code in (11,12,13,7) and IsDel = 1')
                    ->field(array(
                        'Id',
                        'Name',
                    ))
                    ->select();
        if($search['datemin'] != ''){
            $where .= ' and DateTime >= str_to_date("'.$search['datemin'].'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['datemax'] != ''){
            $datemax = date('Y-m-d',strtotime($search['datemax'])+$DayTime);
            $where .= ' and DateTime < str_to_date("'.$datemax.'","%Y-%m-%d %H:%i:%s")';
        }
        if($search['Channel'] != ''){
            $where .= ' and a.PayChannel = "'.$search['Channel'].'"';
        }
        $catData = M('jy_users_order_info as a ')
            ->join('jy_users_order_goods as b on 
                    a.playerid = b.playerid 
                    and a.PlatformOrder = b.PlatformOrder and b.IsGive = 1')
            ->field(
                array(
                    'round(sum(a.Price),2) as TPrice',
                    'count(a.Id) as PayNum',
                    'a.Price',
                    'b.GoodsID',
                    'b.GoodsName',
                    'b.GoodsCode',
                    'count(distinct a.playerid) as UserPayNum',
                )
            )
            ->where($where)
            ->group('b.GoodsID')
            ->select();
        $total = array();
        foreach ($catData as $k=>$v){
            $total['TPrice'] = $v['TPrice']+ $total['TPrice'];
            $total['PayNum'] = $v['PayNum']+ $total['PayNum'];

            $catDataSort[$v['GoodsID']] = $v;
        }
        foreach ($MallGoods as $k=>$v){
                if($catDataSort[$v['Id']]){
                    $MallGoods[$k]['TPrice']     = $catDataSort[$v['Id']]['TPrice'];
                    $MallGoods[$k]['PayNum']     = $catDataSort[$v['Id']]['PayNum'];
                    $MallGoods[$k]['Price']      = $catDataSort[$v['Id']]['Price'];
                    $MallGoods[$k]['UserPayNum'] = $catDataSort[$v['Id']]['UserPayNum'];
                    $MallGoods[$k]['Numratio']   =   $catDataSort[$v['Id']]['PayNum']?round( $catDataSort[$v['Id']]['PayNum']*100/$total['PayNum'],2).'%':"0.00%";
                    $MallGoods[$k]['Payratio']   =  $catDataSort[$v['Id']]['TPrice']/$total['TPrice']?round( $catDataSort[$v['Id']]['TPrice']*100/$total['TPrice'],2).'%':"0.00%";
                }else{
                    $MallGoods[$k]['TPrice']     = 0;
                    $MallGoods[$k]['PayNum']     = 0;
                    $MallGoods[$k]['Price']      = 0;
                    $MallGoods[$k]['UserPayNum'] = 0;
                    $MallGoods[$k]['Numratio']   = "0.00%";
                    $MallGoods[$k]['Payratio']   = "0.00%";
                }
        }
        $this->assign('search',$search);
        $this->assign('Channel',$Channel);
        $this->assign('info',$MallGoods);
        $this->display();
    }

    /***
     *   首充付费时间统计 导出
     */
    public function  OrderFlowExcel(){
        $ComFun = D('ComFun');
        $Data   = I('param.data','','trim');
        $expTitle = "付费分析 -订单流水";
        $expCellName = array(
            '商品名',
            '单价',
            '付费次数',
            '付费金额',
            '数量占比',
            '收入占比',
        );

        $ComFun->exportExcel($expTitle,$expCellName,json_decode($Data,true));
    }


}