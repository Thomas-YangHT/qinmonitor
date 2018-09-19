<?php 
//检查最近连接状态数据，达到$times设定则显示出来，以备报警程序使用； 


function check($get,$portsnames){
//取得測試主機數量,計算 $get 陣列的元素數目即可得知 
	$host_count = count($get); 	 
	$testresult = array();

	$k=0;
	for ( $i = 0 ; $i < $host_count ; $i++ ) { 
//$get_line[$i][0] 為主機ip , $get_line[$i][1] 為测试时间
//$get_line[$i][2] 為測試項目,共有 X 項 
		$get_line[$i]=$get[$i];
 
		//date_default_timezone_set("PRC");
        //$currenttime=date("Ymd H:i:s",time());
		//$timecha=strtotime($currenttime)-strtotime($get_line[$i][1]);
		//if( $timecha>900 ){ }
		//取得本行测试端口的数量
		$len = strlen(trim($get_line[$i][2])); 
		//设置$testresult[$k][$j+1]初值为0,$testresult[$k][0]存IP
		if ($i==0 ){
			$iptmp=$get_line[$i][0];
			$testresult[$k][0] = $iptmp;
			for ( $j=0; $j < $len ; $j++) { $testresult[$k][$j+1]=0; }
		}elseif ($i!=0 && $iptmp!=$get_line[$i][0]){
			$iptmp=$get_line[$i][0]; 
			$k++;
			$testresult[$k][0] = $iptmp;
			for ( $j=0; $j < $len ; $j++) { $testresult[$k][$j+1]=0; }	
		}
		
		for ( $j=0; $j < $len ; $j++) { 
	//分別取出比對項目每一項的值,若等於 1 ,成功的 , 0 測失败的，2是未设定 
			//echo substr($get_line[$i][2],$j,1);
			if (substr($get_line[$i][2],$j,1) == "0") { 
				$testresult[$k][$j+1]++;
			} 
		} 
	}
    //print_r($testresult); 	
	GLOBAL $times;
	$host_count = count($testresult);
	for ( $i = 0 ; $i < $host_count ; $i++ ) { 
		$len=count($testresult[$i]);
		for ( $j=0; $j < $len-1 ; $j++) { 
			if($testresult[$i][$j+1]==$times){ echo "portcheck,".$testresult[$i][0].", ".$portsnames[$j]." unconnect ".$testresult[$i][$j+1]." times\n";}
		}
	}
	
}
//----------------------------------------------------------------


//定义连续几次连接失败则报警
$times=3;

$hosts=0;
$portss=array();

include_once("qinconfig.inc.php");
$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
mysql_select_db($mondb,$conn);
mysql_query("SET NAMES UTF8");

//取得报警设定（次数）；
$sql="select value from alarmitem where item='portcheck'";
$res=mysql_query($sql,$conn);
$row=mysql_fetch_array($res);
$times=$row[0];

//取得ID数量，即表格数量；
$sql="select count(distinct id) from portstatussetting";
$res=mysql_query($sql,$conn);
$row=mysql_fetch_array($res);
$tabs=$row[0];

//得到hosts数量
$sql0="select count(*) from portstatussetting as a inner join hostip as b on trim(a.ip)=trim(b.ip);";
$res0=mysql_query($sql0,$conn);
$row0=mysql_fetch_array($res0);
$hosts=$row0[0];

//得到最近的端口状态表（$hosts*$times）
$sql1="select a.ip,a.`time`,a.portstatus,b.id from( (select * from portstatusinfohis order by `time` desc limit ".$hosts*$times.")as a  inner join portstatussetting as b on trim(a.ip)=trim(b.ip) and a.id=b.id) order by ip,id desc;";       
$res1=mysql_query($sql1,$conn);
$rows1=mysql_affected_rows($conn);//获取行数
$colums1=mysql_num_fields($res1);//获取列数
while($row=mysql_fetch_array($res1))  {
   for($i=0;$i<$tabs;$i++){
	   if ($row['id']==$i+1){  $gets[$i][]=$row; }
   }	
}


//得到端口名称表
$sql2="select id,portsnames,ports from monports order by id;";
$res2=mysql_query($sql2,$conn);
$rows2=mysql_affected_rows($conn);//获取行数
$colums2=mysql_num_fields($res2);//获取列数

while($row2=mysql_fetch_array($res2)){
	//print_r($row2);
	//if($row2['id']==1){ $portnames1=split(" ",$row2[portsnames]);  $ports1=split(" ",$row2[ports]); }
	//if($row2['id']==2){ $portnames2=split(" ",$row2[portsnames]);  $ports2=split(" ",$row2[ports]); }
   for($i=0;$i<$tabs;$i++){
	   if ($row2['id']==$i+1){  
			//$portnamess[$i]=split(" ",$row2[portsnames]);
			$portss[$i]=split(" ",$row2['ports']); 
	   }
   }		
}


for($i=0;$i<$tabs;$i++){
	check($gets[$i],$portss[$i]);
}

?>