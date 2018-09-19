<?php 
//老端口检测程序，从HOSTS？文件里读取设定
//設定更新時間 
header("Refresh:600"); 
//標題 
$title = "服务器状态监控："; 
//取得現在的日期時間,並轉換成 'YYYY 年 M 月 D 日' 的格式 
$date = date("Y 年 m 月 j 日",time()); 
//取得今天的星期, 0 為 '星期天' , 1 為 '星期一' , ... , 6 為 '星期六' 
$week = date("w",time()); 
//陣列查表,將數字的星期,轉換成中文 
$weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六'); 
//顯示表格 
//table1----------------------------------------------------------------------------------------------------------------------
echo "<TABLE BORDER=10 WIDTH='100%'  BGCOLOR=#00ff00>"; 
//顯示標題 
echo "<TR><TD ALIGN=CENTER COLSPAN=15 BGCOLOR=#ffffff><FONT SIZE=5><B> $title </B><BR> $date " . $weekday[$week] . "</FONT></TD></TR>"; 
//顯示檢測項目 
echo "<TR BGCOLOR=#ccddee><TH>主机名称</TH><TH>侦测时间</TH><TH>http</TH><TH>https</TH><TH>mysql</TH><TH>8090</TH><TH>2201ssh</TH><TH>8080</TH><TH>8081</TH><TH>8082</TH><TH>8093</TH><TH>8014</TH><TH>2181</TH></TR>"; 
//檢測檔案名稱,檔案內容的格式如下所示,以 @ 符號分隔,一列表示一個監測主機,監測項目共有 13 項, 1 代表要監測 , 
// 0 代表不監測, 13 個項目分別表示 FTP、SSH、MSTSC、SMTP、DNS、DHCP、HTTP、POP3、SAMBA、IMAP、SNMP、SQL2k、MySQL 
// 
//格式: 
// 主機名稱@IP 位址或主機名稱@監測項目 
//範例: 
// 嘟嘟學習網@192.168.0.254@1100110011101 

$file = "host.txt"; 
//取得檔案內容存入陣列,一個元素代表一列 
$get = file("$file"); 

//取得測試主機數量,計算 $get 陣列的元素數目即可得知 
$host_count = count($get); 

//定義測試 port 清單 
$port = array(80,443,3306,8090,2201,8080,8081,8082,8093,8014,2181); 

for ( $i = 0 ; $i < $host_count ; $i++ ) { 
//切割每一列的資料存入陣列,以 @ 為分割符號, $get_line[$i][0] 為主機名稱 , $get_line[$i][1] 為測試的 IP 或主機名稱 
//$get_line[$i][2] 為測試項目,共有 13 項 
$get_line[$i] = split("\@",$get[$i]); 

//顯示欄位名稱 
date_default_timezone_set("PRC");
echo "<TR><TD BGCOLOR=#62defe>" . $get_line[$i][0] . $get_line[$i][1] . "</TD><TD BGCOLOR=#77ff00 ALIGN=CENTER>" . date("H:i:s",time()) . "</TD>"; 

//取得測試項目的長度,並去除頭尾的空白字元 
$len = strlen(trim($get_line[$i][2])); 

//測試 timeout 時間 
$timeout = 5; 

for ( $j = 0 ; $j < $len ; $j++) { 

//各別取出比對項目每一項的值,若等於 1 ,就做測試 , 0 測不做測試 
if (substr($get_line[$i][2],$j,1) == "1") { 
//進行測試,並抑制錯誤訊息輸出 
$test[$j] = @fsockopen($get_line[$i][1],$port[$j],$errno,$errstr,$timeout); 
//顯示測試結果 
if ($test[$j]) { 
echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>"; 
} else { 
echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失败</FONT></TD>"; 
} 
} else { 
echo "<TD BGCOLOR=#fed19a align=center><FONT COLOR=blue> N/A </FONT></TD>"; 
} 
} 
echo "</TR>"; 
} 
//備註 
//$message = "<B>备注：</B><BR>　　1.N/A 表示未测试 <BR>　　3.本页面10分钟更新一次"; 
//echo "<TR><TD COLSPAN=15 BGCOLOR=#ffffff> $message </TD><TR>"; 
echo "</TABLE>"; 

//table2----------------------------------------------------------------------------------------------------------------------
echo "<TABLE BORDER=10 WIDTH='100%'  BGCOLOR=#00ff00>"; 
//顯示標題 
echo "<TR><TD ALIGN=CENTER COLSPAN=15 BGCOLOR=#ffffff><FONT SIZE=5><B> 第二组 </B> </FONT></TD></TR>"; 
//顯示檢測項目 
echo "<TR BGCOLOR=#ccddee><TH>主机名称</TH><TH>侦测时间</TH><TH>6379</TH><TH>26379</TH><TH>26380</TH><TH>26381</TH><TH>8096</TH><TH>8066</TH><TH>9066</TH><TH>80</TH><TH>27017</TH></TR>"; 
//檢測檔案名稱,檔案內容的格式如下所示,以 @ 符號分隔,一列表示一個監測主機, 1 代表要監測 , 
// 0 代表不監測
//格式: 
// 主機名稱@IP 位址或主機名稱@監測項目 
//範例: 
// 嘟嘟學習網@192.168.0.254@1100110011101 

$file = "host2.txt"; 
//取得檔案內容存入陣列,一個元素代表一列 
$get = file("$file"); 

//取得測試主機數量,計算 $get 陣列的元素數目即可得知 
$host_count = count($get); 

//定義測試 port 清單 
$port = array(6379,26379,26380,26381,8096,8066,9066,80,27017); 

for ( $i = 0 ; $i < $host_count ; $i++ ) { 
//切割每一列的資料存入陣列,以 @ 為分割符號, $get_line[$i][0] 為主機名稱 , $get_line[$i][1] 為測試的 IP 或主機名稱 
//$get_line[$i][2] 為測試項目,共有 13 項 
$get_line[$i] = split("\@",$get[$i]); 

//顯示欄位名稱 
date_default_timezone_set("PRC");
echo "<TR><TD BGCOLOR=#62defe>" . $get_line[$i][0] . $get_line[$i][1] . "</TD><TD BGCOLOR=#77ff00 ALIGN=CENTER>" . date("H:i:s",time()) . "</TD>"; 

//取得測試項目的長度,並去除頭尾的空白字元 
$len = strlen(trim($get_line[$i][2])); 

//測試 timeout 時間 
$timeout = 5; 

for ( $j = 0 ; $j < $len ; $j++) { 

//各別取出比對項目每一項的值,若等於 1 ,就做測試 , 0 測不做測試 
if (substr($get_line[$i][2],$j,1) == "1") { 
//進行測試,並抑制錯誤訊息輸出 
$test[$j] = @fsockopen($get_line[$i][1],$port[$j],$errno,$errstr,$timeout); 
//顯示測試結果 
if ($test[$j]) { 
echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>"; 
} else { 
echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失败</FONT></TD>"; 
} 
} else { 
echo "<TD BGCOLOR=#fed19a align=center><FONT COLOR=blue> N/A </FONT></TD>"; 
} 
} 
echo "</TR>"; 
} 
//備註 
$message = "<B>备注：</B><BR>　　1.N/A 表示未测试 <BR>　　2.本页面10分钟更新一次"; 
echo "<TR><TD COLSPAN=15 BGCOLOR=#ffffff> $message </TD><TR>"; 
echo "</TABLE>"; 
?>
