
<?php 
#sudo ssh $IP tail -f $filename
function  readlog_ctn2($filename,$times,$size2,$ip){
    global $lines;
	global $keyword;
	$size2=$size2-$lines;
	$cmd="sudo ssh ".$ip." tail -n +".$size2." ".$filename." 2>&1";
	echo "您选择的IP是：".$ip."文件是：".$filename."起始行数：".$lines."关键字：".$keyword."<BR>";
	//echo "cmd:".$cmd;
	exec($cmd,$tmp,$out);
	//$rows=preg_split('/\n/',$buffer);
	//print_r($tmp);
	echo "<div id='log'>";
	foreach ($tmp as $line){
		//str_ireplace($keyword,"<div color='red'>".$keyword."</div>",$line);
		echo str_ireplace($keyword,"<label style='color:red'>".$keyword."</label>",$line)."<BR>";
	}
	echo "</div>";
}
function selectdb(){
	include_once("qinconfig.inc.php");
	$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
	mysql_select_db($mondb,$conn);
	mysql_query("SET NAMES UTF8");
    $sql="select ip from hostip";    
    $res=mysql_query($sql,$conn);
    $rows=mysql_affected_rows($conn);//获取行数
    $colums=mysql_num_fields($res);//获取列数
	global $hostip;
	//global $maxport;
	global $hostres;
	$hostip=array();
	//$maxport=array();
	$hostres=array();
	$j=0;
    while($row=mysql_fetch_array($res)){
		$hostip[]=$j."-".$row[ip];
		//$maxport[]=max(split("-",$row[ports]));
		$hostres[]=$row;
		//echo "maxport:".$maxport[$j];
		$j++;
    }
	
	$sql="select projname,logdir,logfilename from tailproject"; 
	$res=mysql_query($sql,$conn);
    $rows=mysql_affected_rows($conn);//获取行数
    $colums=mysql_num_fields($res);//获取列数
	global $projnames;
	global $projectres;
	$projnames=array();
	$projectres=array();
	$j=0;
    while($row=mysql_fetch_array($res)){
		$projnames[]=$j."-".$row[projname];
		$projectres[]=$row;
		$j++;
    }
}



selectdb();

$lines=20;
$filename="/var/log/messages";
$totaltimes=100;
$i=100;
$freshtime=1000;

//读取tail参数
$cmd="cat /tmp/tail.ctl";
exec($cmd,$tmp,$out);
if($out!=0){
	$cmd="sudo sh -c \"touch /tmp/tail.ctl;chmod 666 /tmp/tail.ctl;\"";
	exec($cmd,$tmp,$out);
}
if( !empty($tmp[0]) ) {
	$ctl=split(':',$tmp[0]);
	$i=$ctl[0];
	$size2=$ctl[1];
	$hostid	 = $ctl[2];
	$projid  = $ctl[3];
	$lines   = $ctl[4];
	$keyword = $ctl[5];
	if( empty($keyword) ){
		$keyword=$projectres[$projid][projname];
	}
	$ip = $hostres[$hostid][ip];
	$filename = $projectres[$projid][logdir]."/".$projectres[$projid][logfilename];	
}


//如果点击了查看日志，
if( !empty($_POST[tailf]) ){ 
	$lines   = $_POST[lines];
	$keyword = $_POST[keyword];
	$selip       =split('-',$_POST["selhostname"]);
	$selprojname =split('-',$_POST["selprojname"]);
	$hostid	= $selip[0];
	$projid = $selprojname[0];
	$i=1; 
	$ip = $hostres[$hostid][ip];
	$filename = $projectres[$projid][logdir]."/".$projectres[$projid][logfilename];
	$cmd="sudo ssh ".$ip." wc -l ".$filename."|awk '{print $1}' 2>&1";
	exec($cmd,$tmp2,$out);
	echo "cmd:".$cmd;
	echo "tmp2[0]:".$tmp2[0];
	if($out==0){
		$size2=$tmp2[0];
		readlog_ctn2($filename,$i,$size2,$ip);
		$cmd="echo '".$i.":".$size2.":".$hostid.":".$projid.":".$lines.":".$keyword."' 2>&1 >/tmp/tail.ctl";
		$freshtime=2; 
		echo "cmd:".$cmd."<br><br><br><br><br>";
	}else{ echo "tmp2[0]:".$tmp2[0]; }
//到达刷新次数限制退出
}elseif( $i > $totaltimes or !empty($_POST[stoptail]) ){ 
	readlog_ctn2($filename,$i,$size2,$ip);
	$cmd="echo '' >/tmp/tail.ctl 2>&1 "; 
	//echo "cmd:".$cmd;
	//echo "i1:".($i > $totaltimes);
	//echo "i2:".!empty($_POST[stoptail]);
//否则继续刷新	
}elseif( $i != $totaltimes){ 
	$freshtime=2;
	$i++;
	//$ip="192.168.1.180";
	readlog_ctn2($filename,$i,$size2,$ip);
	$cmd="echo '".$i.":".$size2.":".$hostid.":".$projid.":".$lines.":".$keyword."' 2>&1 >/tmp/tail.ctl";
}
//echo "i:".$i."total:".$totaltimes;
//echo "cmd:".$cmd;
exec($cmd,$tmp,$out);
echo "<meta http-equiv='refresh' content='$freshtime'>\n";

?>