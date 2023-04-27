<?php
/**
 * 名称：Send.php
 * 功能：发送模板消息（API调用）
 * 
 * 作者：UP7i5CAT
 */
include_once 'fun_readaccess_token.php';
header('Content-Type:text/html;charset=utf-8');
$touser = $_GET['touser'];
$template_id = $_GET['template_id'];
$first = $_GET['first'];
$keyword1 = $_GET['keyword1'];
$keyword2 = $_GET['keyword2'];
$remark = $_GET['remark'];


sendappointmentmsg($touser,$template_id,$first,$keyword1,$keyword2,$remark);

function sendappointmentmsg($touser,$template_id,$first,$keyword1,$keyword2,$remark){

    $token = readaccess_token();


    $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;
   
    $need = array(
        //接收方openid
        'touser'=>$touser,
        //模板id
        'template_id'=>$template_id,
        //关键词数组
        'data'=>array(
          'first'=>array('value'=>$first),
          'keyword1'=>array('value'=>$keyword1),
          'keyword2'=>array('value'=>$keyword2),
          'remark'=>array('value'=>$remark)
        )
      );
   send_post($url,$need);
  
}

function http_request($url,$data = null){ 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
    if (!empty($data)){ 
        curl_setopt($curl, CURLOPT_POST, 1); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
    } 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($curl); 
    curl_close($curl); 
    return $output; 
} 
 


function send_post($url, $post_data) {
  $good=json_encode($post_data);
    $options = array(
      'http' => array(
      'method' => 'POST',
      'header' => '',
      'content' => $good,
      'timeout' => 15 * 60 // 超时时间（单位:s）
      )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    return $result;
  
  }
  
  
 
?>