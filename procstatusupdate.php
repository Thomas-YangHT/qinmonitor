<?php
		
function updatedb($sql){
	$conn=mysql_connect("localhost","root","")	or die("无法连接数据库，请重来");
    mysql_select_db("moninfo",$conn);
    mysql_query("SET NAMES UTF8");
    $res=mysql_query($sql,$conn);
	if ( $res === FALSE) { echo "<br>\n执行失败：".$sql."<br>\n";}
	else{echo "<br>\n更新成功：".$sql."<br>\n";}
}
//-----------------start process status update to DB-----------------------------
		include_once("qinconfig.inc.php");
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db($mondb,$conn);
		mysql_query("SET NAMES UTF8");
        $sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) order by ip";        
        $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数
	    while($row=mysql_fetch_array($res)){
			exec("sudo ssh ".$row[ip]." \"ps auxwww|grep ".$row['procname']."|grep -v grep|awk '{print \\\$2}'\" 2>&1",$output,$ret);
			#if ($ret==0 and !empty($output[0])){ $row['status']=$output[0];}
			#else{ $row['status']='';}
			$sql="update procsetting set status='".$output[0]."'  where ip='".$row[ip]."' and procname='".$row['procname']."'";
			updatedb($sql);
			unset($output);
        }
?>