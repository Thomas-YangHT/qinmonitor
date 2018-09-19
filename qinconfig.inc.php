<?php
//设置mysql参数
$MysqlHost="localhost";
$MysqlUser="root";
$MysqlPass="";
$mondb="moninfo";

//设置时区
date_default_timezone_set("PRC");

//准备相关文件
$qin_logpath="/root/";
$qinlog_file   = $qin_logpath."qinmonitor.log";

if( !file_exists($qinlog_file) )   {exec("sudo -u root touch ".$qinlog_file,$tmp,$tmpout);    exec("sudo -u root chmod 666 ".$qinlog_file,$tmp,$tmpout);}



?>