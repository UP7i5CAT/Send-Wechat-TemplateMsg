<?php
/**
 * 名称：GetAccess_token.php
 * 功能：获取access_token，并保存到文件
 * 运行方式：需使用定时任务，每隔1小时执行一次（微信access_token有效期为2小时）
 * 
 * 作者：UP7i5CAT
 */


//appid和secret 填写自己的真实数据
$appid = "wxxxxxxxxxxxxxxxxxx";
$secret = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

//获取access_token
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=". $appid ."&secret=". $secret;; 
$result = http_request($url); 

//生成文件，保存token 
$dir = __DIR__; //真实路径，crontab命令的php执行在cli模式下，不能正确识别相对路径，所以使用__DIR__ 
$filename = $dir."/access_token.php"; 
create_file($filename, $result); 
 
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

//生成文件 
function create_file($filename, $content){ 
    $fp = fopen($filename, "w"); 
    fwrite($fp, "" . $content); 
    fclose($fp); 
}

?>