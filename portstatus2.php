<?php 
//显示端口连接状态，并且将结果存入数据库和文件中，以备检查报警
function table($portnames,$port,$get,$protocols){
	echo "<TABLE BORDER=10 WIDTH='100%'  BGCOLOR=#00ff00>"; 
    //顯示標題 
	echo "<TR BGCOLOR=#ccddee><TH>主机名称</TH><TH>侦测时间</TH>";
	#<TH>http</TH><TH>https</TH><TH>mysql</TH><TH>8090</TH><TH>2201ssh</TH><TH>8080</TH><TH>8081</TH><TH>8082</TH><TH>8093</TH><TH>8014</TH><TH>2181</TH>
	$portnum=count($portnames);
	for($i=0; $i < $portnum; $i++){
		echo "<TH>$portnames[$i]</TH>";
	}
	echo "</TR>";
	 
//取得測試主機數量,計算 $get 陣列的元素數目即可得知 
	$host_count = count($get); 	 
	$testresult = array();
	GLOBAL $tofile;
	for ( $i = 0 ; $i < $host_count ; $i++ ) { 
//切割每一列的資料存入陣列, $get_line[$i][0] 為主機名稱 , $get_line[$i][1] 為測試的 IP 或主機名稱 
//$get_line[$i][2] 為測試項目,共有 N 項，$get_line[$i][3]为分组号
	//$get_line[$i] = split("\@",$get[$i]); 
		$get_line[$i]=$get[$i];
//顯示欄位名稱 
		date_default_timezone_set("PRC");
		echo "<TR><TD BGCOLOR=#62defe>" . $get_line[$i][0] . $get_line[$i][1] . "</TD><TD BGCOLOR=#77ff00 ALIGN=CENTER>" . date("H:i:s",time()) . "</TD>"; 
//取得測試項目的長度,並去除頭尾的空白字元 
		$testresult[$i][0] = $get_line[$i][1];
		$testresult[$i][1] = date("Ymd H:i:s",time());
		$testresult[$i][3] = $get_line[$i][3];
		$len = strlen(trim($get_line[$i][2])); 
//測試 timeout 時間 
		$timeout = 5; 
		for ( $j = 0 ; $j < $len ; $j++) { 
	//各別取出比對項目每一項的值,若等於 1 ,就做測試 , 0 測不做測試 
			if (substr($get_line[$i][2],$j,1) == "1") { 
	//進行測試,並抑制錯誤訊息輸出 
				//$test[$j] = @fsockopen($get_line[$i][1],$port[$j],$errno,$errstr,$timeout); 
				//使用stream_socket_client代替@fsockopen以支持UDP；
				if (substr($protocols,$j,1)=='T') {$protocol="tcp";}
				else{$protocol="udp";}
				$test[$j] = stream_socket_client("{$protocol}://{$get_line[$i][1]}:{$port[$j]}", $errno, $errstr,$timeout); 
	//顯示測試結果 
				if ($test[$j]) { 
					echo "<TD BGCOLOR=yellow align=center>成功</FONT></TD>"; 
					$testresult[$i][2] .= "1"; 
				} else { 
					echo "<TD BGCOLOR=red align=center><FONT COLOR=white>失败</FONT></TD>"; 
					$testresult[$i][2] .= "0"; 
				} 
			} else { 
				echo "<TD BGCOLOR=#fed19a align=center><FONT COLOR=blue> N/A </FONT></TD>"; 
				$testresult[$i][2] .= "2"; 
			} 
		} 
		echo "</TR>"; 
		$tofile .= implode(",",$testresult[$i])."\n";
	} 
	//print_r($testresult);

	echo "</TABLE>"; 
}

function GetSetData(){
	global $tabs;
	global $portnamess;
	global $portss;
	global $gets;
	global $protocolss;
	global $MysqlHost;
	global $MysqlUser;
	global $MysqlPass;
	global $mondb;	

	$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
	mysql_select_db($mondb,$conn);
	mysql_query("SET NAMES UTF8");
    
    //取得ID数量，即表格分组数量；
    $sql="select count(distinct id) from portstatussetting";
    $res=mysql_query($sql,$conn);
    $row=mysql_fetch_array($res);
    $tabs=$row[0];
    //echo "tabs:".$tabs;
    
    $sql1="select b.hostname,a.ip,a.monif,a.id from portstatussetting as a  inner join hostip as b on trim(a.ip)=trim(b.ip) order by id,hostname;";       
    $res1=mysql_query($sql1,$conn);
    $rows1=mysql_affected_rows($conn);//获取行数
    $colums1=mysql_num_fields($res1);//获取列数
    while($row=mysql_fetch_array($res1))  {
       for($i=0;$i<$tabs;$i++){
    	   if ($row['id']==$i+1){  $gets[$i][]=$row; }
       }
    }
    
    $sql2="select id,portsnames,ports,protocols from monports order by id;";
    $res2=mysql_query($sql2,$conn);
    $rows2=mysql_affected_rows($conn);//获取行数
    $colums2=mysql_num_fields($res2);//获取列数
    
    while($row2=mysql_fetch_array($res2)){
       for($i=0;$i<$tabs;$i++){
    	   if ($row2['id']==$i+1){  
    			$portnamess[$i]=split(" ",$row2[portsnames]);
    			$portss[$i]=split(" ",$row2[ports]); 
    			$protocolss[$i]=$row2[protocols];
    	   }
       }	
    }
}

include_once("qinconfig.inc.php");
//设置mysql参数
$MysqlHost="localhost";
$MysqlUser="root";
$MysqlPass="";
$mondb="moninfo";

//设置时区
date_default_timezone_set("PRC");

$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
mysql_select_db($mondb,$conn);
mysql_query("SET NAMES UTF8");

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
echo "<TABLE BORDER=10 WIDTH='100%'  BGCOLOR=#00ff00>"; 
//顯示標題 
echo "<TR><TD ALIGN=CENTER COLSPAN=15 BGCOLOR=#ffffff><FONT SIZE=5><B> $title </B><BR> $date " . $weekday[$week] . "</FONT></TD></TR>"; 
//用于存放测试结果
$tofile = "";
//取得设置数据
GetSetData();
//分组顯示檢測項目 
for($i=0;$i<$tabs;$i++){
	table($portnamess[$i],$portss[$i],$gets[$i],$protocolss[$i]);
}

//把测试结果存入文件中
$fp = fopen("/root/portstatus", "w");      
if($fp) {                              
   fwrite($fp,$tofile);
}else {                                 
   echo "打开文件失败:/root/portstatus";
}
//结果存入数据库
$sql="delete from portstatusinfo";
$res=mysql_query($sql,$conn);
$sql="LOAD DATA INFILE '/root/portstatus' INTO TABLE `portstatusinfo` FIELDS TERMINATED BY ','  (`ip`, `time`, `id`, `portstatus` );";
$res=mysql_query($sql,$conn);
$sql="LOAD DATA INFILE '/root/portstatus' INTO TABLE `portstatusinfohis` FIELDS TERMINATED BY ','  (`ip`, `time`, `id`, `portstatus`);";
$res=mysql_query($sql,$conn);

//備註 
echo "<TABLE BORDER=10 WIDTH='100%'  BGCOLOR=#00ff00>"; 
$message = "<B>备注：</B><BR>　　1.N/A 表示未测试 <BR>　　2.本页面10分钟更新一次"; 
echo "<TR><TD COLSPAN=15 BGCOLOR=#ffffff> $message </TD><TR>"; 
echo "</TABLE>"; 
?>
