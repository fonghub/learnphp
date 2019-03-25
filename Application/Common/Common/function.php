<?php
	
function create_pager_html($total, $page=1, $perpage=20) {
    if ($total <= $perpage)return '';
    $dataFrom=($page-1)*$perpage+1;
    $dataTo=($page)*$perpage;
    //url
    $url=array();
    foreach ($_GET as $k => $v) {
        if ($k!='page') {
            $url[]=urlencode($k).'='.urlencode($v);
        }
    }
    $url1='?'.implode('&', $url);
    if(count($url)>0){
        $url1=$url1.'&page=';
    }else{
        $url1=$url1.'?page=';
    }

    $url[]='page={page}';
    $url='?'.implode('&', $url);
    //总页数
    $totalPage=((int)($total/$perpage))+($total%$perpage==0?0:1);
    
    //侧边数量
    $cellNum=2;
    $indexStart=$page-$cellNum;
    $indexEnd=$page+$cellNum;
    if($indexStart<1){
        $indexEnd+=(-$indexStart+1);
        $indexStart=1;
    }
    if($indexEnd>$totalPage){
        $indexStart+=($totalPage-$indexEnd);
        $indexEnd=$totalPage;
    }
    if($indexStart<1)$indexStart=1;
    //生成
    $urlIndex=str_replace('{page}',1,$url);
    $urlFinal=str_replace('{page}',$totalPage,$url);
    if($page==1){
        
    }else{
        $firstUrl=str_replace('{page}',1, $url);
        $prevUrl=str_replace('{page}',$page-1, $url);
        $first='<a href="'.$firstUrl.'" class="first">1...</a>';
        $prev ='<a href="'.$prevUrl .'" class="prev">&lsaquo;&lsaquo;</a>';
    }
    if($page==$totalPage){
        
    }else{
        $nextUrl=str_replace('{page}',$page+1, $url);
        $lastUrl=str_replace('{page}',$totalPage, $url);
        $next='<a href="'.$nextUrl.'" class="next">&rsaquo;&rsaquo;</a>';
        $last='<a href="'.$lastUrl.'" class="last">...'.$totalPage.'</a>';
    }
    for($i=$indexStart;$i<=$indexEnd;$i++){
        if($i==$page){
            $cells[]='<strong>'.$i.'</strong>';
        }else{
            $cellUrl=str_replace('{page}',$i, $url);
            $cells[]='<a href="'.$cellUrl.'">'.$i.'</a>';
        }
    }
    $cells=implode('', $cells);
    $tmp=<<<TMP
<div class="pages">
    <em>总共{$total}条</em>
    $first
    $prev
    $cells
    $next
    $last
    <kbd>
        <input type="text" style="height:24px! important;" name="custompage" size="3" onkeydown="if(event.keyCode==13){var val=this.value;if(this.value==''){val=1;} window.location='$url1'+val; return false;}" />
    </kbd>
</div>
TMP;
    return $tmp;
}

    
function create_mobile_pager_html($total, $page=1, $perpage=20) {
    if ($total <= $perpage)return '';
    $dataFrom=($page-1)*$perpage+1;
    $dataTo=($page)*$perpage;
    //url
    $url=array();
    foreach ($_GET as $k => $v) {
        if ($k!='page') {
            $url[]=urlencode($k).'='.urlencode($v);
        }
    }
    $url1='?'.implode('&', $url);
    if(count($url)>0){
        $url1=$url1.'&page=';
    }else{
        $url1=$url1.'?page=';
    }

    $url[]='page={page}';
    $url='?'.implode('&', $url);
    //总页数
    $totalPage=((int)($total/$perpage))+($total%$perpage==0?0:1);
    
    //侧边数量
    $cellNumLeft=2;
    $cellNumRight=2;
    if($page>10){
        $cellNumLeft=1;
    }
    if($page>100){
        $cellNumLeft=0;
        $cellNumRight=0;
    }
    $indexStart=$page-$cellNumLeft;
    $indexEnd=$page+$cellNumRight;
    if($indexStart<1){
        $indexEnd+=(-$indexStart+1);
        $indexStart=1;
    }
    if($indexEnd>$totalPage){
        $indexStart+=($totalPage-$indexEnd);
        $indexEnd=$totalPage;
    }
    if($indexStart<1)$indexStart=1;
    //生成
    $urlIndex=str_replace('{page}',1,$url);
    $urlFinal=str_replace('{page}',$totalPage,$url);
    if($page==1){
        
    }else{
        $firstUrl=str_replace('{page}',1, $url);
        $prevUrl=str_replace('{page}',$page-1, $url);
        $first='<a href="'.$firstUrl.'" class="first">1..</a>';
        $prev ='<a href="'.$prevUrl .'" class="prev">&lsaquo;&lsaquo;</a>';
    }
    if($page==$totalPage){
        
    }else{
        $nextUrl=str_replace('{page}',$page+1, $url);
        $lastUrl=str_replace('{page}',$totalPage, $url);
        $next='<a href="'.$nextUrl.'" class="next">&rsaquo;&rsaquo;</a>';
        $last='<a href="'.$lastUrl.'" class="last">..'.$totalPage.'</a>';
    }
    for($i=$indexStart;$i<=$indexEnd;$i++){
        if($i==$page){
            $cells[]='<strong>'.$i.'</strong>';
        }else{
            $cellUrl=str_replace('{page}',$i, $url);
            $cells[]='<a href="'.$cellUrl.'">'.$i.'</a>';
        }
    }
    $cells=implode('', $cells);
    $tmp=<<<TMP
<div class="pages">
    <em>{$total}条</em>
    $first
    $prev
    $cells
    $next
    $last
    <input type="text" style="height:24px! important; width:2.2em;" name="custompage" size="3" onkeydown="if(event.keyCode==13){var val=this.value;if(this.value==''){val=1;} window.location='$url1'+val; return false;}" />
   
</div>
TMP;
    return $tmp;
}

function listWithNo($list,$page=1,$pageSize=0){
    if(!isset($page)||$page<1)$page=1;
    foreach ($list as $k => $v) {
        $list[$k]['asc_no']=$pageSize*($page-1)+$k+1;
    }
    return $list;
}

function ajaxPagerHtml($total, $page=1, $pageSize=20) {
    //if ($total <= $pageSize)return '&nbsp;';
    $dataFrom=($page-1)*$pageSize+1;
    $dataTo=($page)*$pageSize;

    //总页数
    $totalPage=((int)($total/$pageSize))+($total%$pageSize==0?0:1);
    $prevPage=$page-1;
    $nextPage=$page+1;
    if($prevPage<1)$prevPage=1;
    if($nextPage>$totalPage)$nextPage=$totalPage;

    //侧边数量
    $cellNum=5;
    $indexStart=$page-$cellNum;
    $indexEnd=$page+$cellNum;
    if($indexStart<1){
        $indexEnd+=(-$indexStart+1);
        $indexStart=1;
    }
    if($indexEnd>$totalPage){
        $indexStart+=($totalPage-$indexEnd);
        $indexEnd=$totalPage;
    }
    if($indexStart<1)$indexStart=1;
    //生成
    if($page==1)$firstDis="disabled";
    if($prevPage==1)$prevDis="disabled";
    if($page==$totalPage)$lastDis="disabled";
    if($page==$totalPage)$nextDis="disabled";

    for($i=$indexStart;$i<=$indexEnd;$i++){
        if($i==$page)$active='active';
        else $active='';
        $cells[]="<li class='paginate_button page-item {$active}'><a href='javascript:getPageList({$i});' class='page-link'>{$i}</a></li>";
    }
    $cells=implode('', $cells);
    $tmp=<<<TMP
  <div class="col-5">
    <span>总共{$totalPage}页,{$total}条记录</span>
  </div>
  <div class="col-7">
    <div class="dataTables_paginate paging_simple_numbers">
      <ul class="pagination m-0 float-right">
        <li class="paginate_button page-item previous {$firstDis}" ">
          <a href="javascript:getPageList(1);" class="page-link">首页</a>
        </li>
        <li class="paginate_button page-item {$firstDis}">
          <a href="javascript:getPageList({$prevPage});" class="page-link">上页</a>
        </li>
        $cells
        <li class="paginate_button page-item {$nextDis}">
          <a href="javascript:getPageList({$nextPage});" class="page-link">下页</a>
        </li>
        <li class="paginate_button page-item next {$lastDis}">
          <a href="javascript:getPageList({$totalPage});" class="page-link">末页</a>
        </li>
      </ul>
    </div>
  </div>
TMP;
    return $tmp;
}

#密码加密
function QEnPassword($password){
	return md5('jinpin'.$password.'2018');
}

#jsonerror
function jsonerror($msg='',$code=0){
    echo json_encode(array(
        'ret'=>false,
        'msg'=>$msg,
        'code'=>$code
        ));
    exit;
}

#jsonsuccess
function jsonsuccess($msg='',$data=array()){
    $json=json_encode(array(
        'ret'=>true,
        'msg'=>$msg,
        'data'=>$data
        ));
    //$json=str_replace('"', '\"', $json);
    echo $json;
    exit;
}

#拷贝数组
function copyArray($arr){
    foreach ($arr as $key => $item) {
        $ret[$key]=$item;
    }
    return $ret;
}

function ipformat($ip){
    $parts=explode('.', $ip);
    if(empty($parts)||count($parts)!==4)return '--';
    return "{$parts[0]}.{$parts[1]}.*.*";
}

#获取用户真实IP
function getRealIp(){
    if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "127.0.0.1")) 
        $ip=getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "127.0.0.1")) 
        $ip=getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "127.0.0.1")) 
        $ip=getenv("REMOTE_ADDR");
    else if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "127.0.0.1")) 
        $ip=$_SERVER['REMOTE_ADDR'];
    else 
        $ip="127.0.0.1";
    return ($ip); 
}

/**
 * 随机生成字符串
 * @param int $length
 * @return null|string
 */
function getRandChar($length = 8){
  $str = null;
  $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
  $max = strlen($strPol)-1;
  
  for($i=0;$i<$length;$i++){
    $str.=$strPol[ranQEnPasswordd(0,$max)]; //rand($min,$max)生成介于min和max两个数之间的一个随机整数
  }
  
  return $str;
}


if (!function_exists('getallheaders')) {
 
    function getallheaders() {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
 
}


?>
