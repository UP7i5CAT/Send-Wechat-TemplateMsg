<?php
/**
 * 名称：fun_readaccess_token.php
 * 功能：读取本地access_token（Send.php引入）
 * 
 * 作者：UP7i5CAT
 */
function readaccess_token(){
    $filename = "access_token.php";
    $handle=fopen($filename,"r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);
    $obj = json_decode($contents);
    return $obj->access_token;
}



?>