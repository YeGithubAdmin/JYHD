<?php
namespace  Common\Lib;
class Page {
    // 起始行数
    public $firstRow    ;
    // 列表每页显示行数
    public $listRows    ;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页栏每页显示的页数
    protected $rollPage   ;
    // 分页显示定制
    protected $config  =    array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页','theme'=>' <span style="color:black">%totalRow% %header% %nowPage%/%totalPage% 页</span> %upPage% %first%  %prePage%  %linkPage%  %nextPage% %end% %downPage%');
 
    public function __construct($totalRows,$listRows=6,$parameter='',$rollPage=5) {
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        $this->rollPage = $rollPage;
        $this->listRows = $listRows;
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = !empty($_GET['page'])?$_GET['page']:1;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }
 
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }
 
    public function show() {
        if(0 == $this->totalRows) return '';
        $p = 'page';
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
//             $upPage="<a href='".$url."&".$p."=$upRow'>".$this->config['prev']."</a>";
            $upPage="<a href='".$url."&".$p."=$upRow' class='paginate_button previous disabled' >".$this->config['prev']."</a>";
        }else{
            $upPage="";
        }
 
        if ($downRow <= $this->totalPages){
//             $downPage="<a href='".$url."&".$p."=$downRow'>".$this->config['next']."</a>";
            $downPage="<a href='".$url."&".$p."=$downRow' class='paginate_button next'>".$this->config['next']."</a>";
        }else{
            $downPage="";
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<a href='".$url."&".$p."=$preRow' class='paginate_button'>上".$this->rollPage."页</a>";
            $theFirst = "<a href='".$url."&".$p."=1' class='paginate_button'>".$this->config['first']."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='".$url."&".$p."=$nextRow' class='paginate_button'>下".$this->rollPage."页</a>";
            $theEnd = "<a href='".$url."&".$p."=$theEndRow' class='paginate_button'>".$this->config['last']."</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
//                     $linkPage .= "&nbsp;<a href='".$url."&".$p."=$page'>&nbsp;".$page."&nbsp;</a>";
                    $linkPage .= "<a href='".$url."&".$p."=$page' class='paginate_button'>&nbsp;".$page."&nbsp;</a>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
//                     $linkPage .= "&nbsp;<span class='current'>".$page."</span>&nbsp;";
                    $linkPage .= "<a href='".$url."&".$p."=$page' class='paginate_button current'>&nbsp;".$page."&nbsp;</a>";
                }
            }
        }
        $pageStr     =   str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%','%downPage%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd,$downPage),$this->config['theme']);
        return $pageStr;
    }
 
}
?>