<?php
namespace Jy_Thirdpay\Model;
use Think\Model;
class OppoBackModel extends Model{
    protected $autoCheckFields = false;

    /***
    * 验签
    *
    */
    public function Verification($param,$sign,$key){
            ksort($param);
    }
    /***
    * 回调参数
    */
    public function Elements($param){
        $elements = split('&', $param);
        $valueMap = array();
        foreach ($elements as $element) {
            $single = split('=', $element);
            $valueMap[$single[0]] = $single[1];
        }
        return $valueMap;
    }

}
