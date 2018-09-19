<?php
session_start(); 
if(!isset($_SESSION['login_status']))    
	header('Location:/dockermg/login.html');
?>
<?php

echo " <html>  \n";
echo "<head>\n";
header("Refresh:300"); 
echo "  <meta charset='utf-8'>\n";
echo "  <meta name='viewport' content='width=device-width, initial-scale=1'>\n";
echo "  <title>欢迎您使用进程启停</title>\n";

echo " <script type='text/javascript'> \n";
echo " function altRows(id){           \n";
echo " 	if(document.getElementsByTagName){  \n";		
echo " 		var table = document.getElementById(id);  \n";
echo " 		var rows = table.getElementsByTagName(\"tr\");\n"; 		 
echo " 		for(i = 0; i < rows.length; i++){          \n";
echo " 			if(i % 2 == 0){                        \n";
echo " 				rows[i].className = 'evenrowcolor';\n";
echo " 			}else{                                 \n";
echo " 				rows[i].className = 'oddrowcolor'; \n";
echo " 			}      \n";
echo " 		}          \n";
echo " 	}              \n";
echo " }               \n";

echo " window.onload=function(){ \n";
echo " 	altRows('alternatecolor');\n";
echo " } \n";
echo " </script>\n";

echo "<!-- CSS goes in the document HEAD or added to your external stylesheet --> \n";
echo " <style type='text/css'> \n";
echo " table.altrowstable {\n";
echo " 	font-family: verdana,arial,sans-serif;\n";
echo " 	font-size:11px;\n";
echo " 	color:#333333;\n";
echo " 	border-width: 1px;\n";
echo " 	border-color: #a9c6c9;\n";
echo " 	border-collapse: collapse;\n";
echo " }\n";
echo " table.altrowstable th {\n";
echo " 	border-width: 1px;\n";
echo " 	padding: 8px;\n";
echo " 	border-style: solid;\n";
echo " 	border-color: #a9c6c9;\n";
echo " 	background-color:#ccd4d4;\n";
echo " }\n";
echo " table.altrowstable td {\n";
echo " 	border-width: 1px;\n";
echo " 	padding: 8px;\n";
echo " 	border-style: solid;\n";
echo " 	border-color: #a9c6c9;\n";
echo " }\n";
echo " .oddrowcolor{\n";
echo " 	background-color: #FFF8DC;\n";
echo " }\n";
echo " .evenrowcolor{\n";
echo " /*	background-color:#c3dde0; */\n";
echo " background-color:#ffffff;\n";
echo " }\n";
echo " .shiny-blue {\n";
echo "   background-color: #759ae9;\n";
echo "   background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #759ae9), color-stop(50%, #376fe0), color-stop(50%, #1a5ad9), color-stop(100%, #2463de));\n";
echo "   background-image: -webkit-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
echo "   background-image: -moz-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
echo "   background-image: -ms-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%); \n";
echo "   background-image: -o-linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
echo "   background-image: linear-gradient(top, #759ae9 0%, #376fe0 50%, #1a5ad9 50%, #2463de 100%);\n";
echo "   border-top: 1px solid #1f58cc;\n";
echo "   border-right: 1px solid #1b4db3;\n";
echo "   border-bottom: 1px solid #174299; \n";
echo "   border-left: 1px solid #1b4db3; \n";
echo "   border-radius: 4px; \n";
echo "   -webkit-box-shadow: inset 0 0 2px 0 rgba(57, 140, 255, 0.8);\n";
echo "   box-shadow: inset 0 0 2px 0 rgba(57, 140, 255, 0.8); \n";
echo "   color: #fff; \n";
echo "   font: bold 12px/1 'helvetica neue', helvetica, arial, sans-serif;\n";
echo "   padding: 7px 0; \n";
echo "   text-shadow: 0 -1px 1px #1a5ad9;\n";
echo "   max-width:200px;\n";
echo "    }\n";
echo " </style>\n";
echo " </head>\n";
 echo "<SCRIPT LANGUAGE='JavaScript'>\n";
 echo " function selectall(t){  \n";
 echo "    for(var i=0;i<document.form.length;i++){   \n";
 echo "       var element=document.form[i];    \n";
 echo "       if(element.type=='checkbox' && t.checked==true){    \n";
 echo "          element.checked=true;    \n";
 echo "       }    \n";
 echo "       if(element.type=='checkbox' && t.checked==false){    \n";
 echo "          element.checked=false;    \n";
 echo "       }    \n";
 echo "    }    \n";
 echo " }  \n";
 echo "</SCRIPT>\n";
echo "<body style='margin:0 auto;align:center;'>\n";

?>


<?php
     function ShowTable($table_name) {
		include_once("qinconfig.inc.php");
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db($mondb,$conn);
		mysql_query("SET NAMES UTF8");        
		if ( isset($_GET['procip']) ){
			//echo "ProcIP:".$_GET['procip'];
			$sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) where trim(a.ip)='".$_GET['procip']."'";
		}elseif( isset($_GET['status']) ){
			$sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) where a.status=''";
		}elseif ( isset($_GET['projname']) ){
			$selprojname=split('_',$_GET['projname']);
			$sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) where a.projname='".$selprojname[1]."'";
			//echo "sql:".$sql;
		}else{
			$sql="select b.hostname,a.* from $table_name as a inner join hostip as b on trim(a.ip)=trim(b.ip) order by ip";       
		}		
        $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数

        echo "<div style='margin:0 auto;align:center;font-size:22px;font-family:SimHei;width:800px'>".'欢迎您，进程运行信息如下：(共计:'.$rows.'行'.$colums.'列)'."</div>\n";
        echo " <form id='form2' name='form2' method='post' action='$PHP_SELF'>\n";
		echo "   <input class='shiny-blue' type='submit' name='freshstatus' value='  立即刷新  ' />\n";
		echo " </form>\n";
        echo "<table class='altrowstable' id='alternatecolor' style='margin:0 auto;align:center;word-break:break-all; word-wrap:break-all;'> <tr>\n";
		echo "<h3 style='margin:0 auto;align:center;font-size:16px;width:800px'><input type='checkbox' name='allunchecked' onclick='selectall(this)' />全选/取消</h3>\n";
		echo " <form id='form' name='form' method='post' action='$PHP_SELF'>\n";
		echo "<th>选择</th>\n";
		echo "<th>sn</th>\n";
        for($i=0; $i < $colums; $i++){
            $field_name=mysql_field_name($res,$i);
  	          echo "<th>".$field_name."</th>\n";
        }
		//echo "<th>状态</th>\n";
        echo "</tr>\n";
    	$j=0;
		//$output=array();
        while($row=mysql_fetch_array($res)){
            if($j/2==round($j/2)){echo "<tr class='oddrowcolor'>\n";}
		    else{echo "<tr class='evenrowcolor'>\n";}
			$j++;
			echo "<td> <input type='checkbox' style='float:left' name='".str_replace(".","_",$row['ip']).":".$row['procname']."' /></td>\n";
			echo "<td>".$j."</td>\n";
			for($i=0; $i<$colums; $i++){
				if($i==3 or $i==4 ){
					echo "<td width='300px'>".$row[$i]."</td>\n";
				}else{
					echo "<td>".$row[$i]."</td>\n";
				}
            }
			//unset($output);
			//exec("sudo ssh ".$row[ip]." \"ps auxwww|grep ".$row['procname']."|grep -v grep|awk '{print \\\$2}'\" 2>&1",$output,$ret);
			//if ($ret==0 and !empty($output[0])){ $status=$output[0];$color="#008000";}
			//else{$status="no running"; $color="#FF0000";}
			//echo "<td style='color:$color'>".$status."</td>\n";
            echo "</tr>\n";
        }
		echo "<TR><TD COLSPAN=15 align='right'> "; 
		echo "   <input class='shiny-blue' type='submit' name='querylog' value=' 查询日志 ' />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp\n";		
		echo "   <input class='shiny-blue' type='submit' name='startproc' value='   起动   ' />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp\n";
		echo "   <input class='shiny-blue' type='submit' name='stopproc' value='   停止   ' />\n";
		echo "</TD><TR>"; 
		echo " </form>\n";
        echo "</table>\n";
     }
	
    function getdata() {
		include_once("qinconfig.inc.php");
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db($mondb,$conn);
		mysql_query("SET NAMES UTF8");
		if ( isset($_GET['procip']) ){
			echo "ProcIP:".$_GET['procip'];
			$sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) where a.ip='".$_GET['procip']."'";
		}elseif( isset($_GET['status']) ){
			$sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) where a.status=''";
		}else{
			$sql="select b.hostname,a.* from procsetting as a inner join hostip as b on trim(a.ip)=trim(b.ip) order by ip";    
		}
        $res=mysql_query($sql,$conn);
		global $procres;
		$procres=array();
        while($row=mysql_fetch_array($res)){
			$procres[]=$row;
        }		
	}

//用于日志查询的基本数据；	
function selectdb(){
   	$conn=mysql_connect("localhost","root","")	or die("无法连接数据库，请重来");
    mysql_select_db("moninfo",$conn);
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
		$hostip[]=$j."-".trim($row[ip]);
		//$maxport[]=max(split("-",$row[ports]));
		$hostres[]=$row;
		//echo "maxport:".$maxport[$j];
		$j++;
    }
	
	$sql="select projname,logdir,logfilename from tailproject union select cname as projname,logdir,'catalina.out' as logfilename from docker.dkcreated"; 
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
//----------------------------------非DK程序启停操作---------------------------------------------------------------------------	
	if( isset($_POST["freshstatus"]) ){ 
		$cmd="sudo -u root /usr/bin/php /usr/share/nginx/html/qinmonitor/procstatusupdate.php &";
		exec($cmd,$tmp,$out);
    }
	
	if( isset($_POST['startproc']) ){
		echo "start ...";
		getdata();
        for($i=0; $i<count($procres); $i++){
			$tmpstr = str_replace(".","_",$procres[$i][ip]).":".$procres[$i]['procname'];
			//echo $tmpstr;
			if( !empty($_REQUEST[$tmpstr]) ){
				echo "<br>"."您选择了\n：".$procres[$i][ip].":".$procres[$i]['procname'];
				$cmd="sudo ssh ".$procres[$i][ip]." \"ps auxwww|grep ".$procres[$i]['procname']."|grep -v grep|awk '{print \\\$2}'\" 2>&1";
				exec($cmd,$output,$ret);
				echo "cmd:".$cmd;
				echo "output:".$output[0];
				echo "ret:".$ret;
				if ($ret==0 and !empty($output[0])){ $status=$output[0];}
				elseif ($ret==0 and empty($output[0])){$status="no running"; }
				unset($output);
				echo "status:".$status;
				if($status=="no running"){
					$cmd="sudo ssh ".$procres[$i][ip]." \"".$procres[$i]['startscript']." 2>&1\"";
					//$cmd="sudo ssh ".$procres[$i][ip]." sh -c \"cd /mnt;pwd 2>&1\"";
					echo $cmd."<br>";
					exec($cmd,$tmp,$out);
					if($out==0){
						echo "<br>起动程序成功：".$tmp[0]."<br>";
					}
					writelog(date("Y.m.d H:i:sa l")." user: ".$_SESSION['user']." proc start ".$cmd);
					unset($tmp);
				}else{echo "<br>程序运行中，不能重复启动。";}	
			}
		}		
	}elseif(isset($_POST['stopproc'])){
		echo "stop...";
		getdata();
        for($i=0; $i<count($procres); $i++){
			$tmpstr = str_replace(".","_",$procres[$i][ip]).":".$procres[$i]['procname'];
			//echo $tmpstr;
			if( !empty($_REQUEST[$tmpstr]) ){
				echo "<br>"."您选择了\n：".$procres[$i][ip].":".$procres[$i]['procname'];
				unset($output);
				exec("sudo ssh ".$procres[$i][ip]." \"ps auxwww|grep ".$procres[$i]['procname']."|grep -v grep|awk '{print \\\$2}'\" 2>&1",$output,$ret);
				if ($ret==0 and !empty($output[0])){ $status=$output[0];}
				else{$status="no running"; }
				if($status!="no running"){
					$cmd="sudo ssh ".$procres[$i][ip]." \"kill -9 ".$procres[$i]['status']." 2>&1\"";
					//$cmd="sudo ssh ".$procres[$i][ip]." sh -c \"cd /tmp;pwd 2>&1\"";
					echo $cmd."<br>";
					exec($cmd,$tmp,$out);
					if($out==0){
						echo "<br>停业程序成功：".$tmp[0]."<br>";
					}
					writelog(date("Y.m.d H:i:sa l")." user: ".$_SESSION['user']." proc stop ".$cmd);
					unset($tmp);
				}else{echo "<br>程序没有运行，无需停止。";}	
			}
		}		
	}else if( isset($_POST["querylog"]) ){
		echo "<br> querylog....<br>";
		getdata();
        for($i=0; $i<count($procres); $i++){
			$tmp = str_replace(".","_",$procres[$i][ip]).":".$procres[$i]['projname'];
			//echo $tmp;
			if( !empty($_REQUEST[$tmp]) ){
				echo "<br>"."您选择了\n：".$procres[$i][ip].":".$procres[$i]['projname'];
				//include_once("up.php");
				selectdb();
				for ($j=0; $j<count($hostip); $j++) {
					if( $hostip[$j]==$j."-".$procres[$i][ip] ){
						$selhostname=$hostip[$j];
					}
					//echo $hostip[$j]."<br>";
				}
				for ($j=0; $j<count($projnames); $j++) {
					if( $projnames[$j]==$j."-".$procres[$i]['projname'] ){
						$selprojname=$projnames[$j];
					}
					//echo $projnames[$j]."<br>";
				}
				$url="/dockermg/tailfdown.php?tailf=1&lines=50&keyword=".$procres[$i]['projname']."&selhostname=".$selhostname."&selprojname=".$selprojname;
				//echo $url;
				header('Location:'.$url);

			}
        }
	}else{
		ShowTable("procsetting");
	}
	echo "</body>\n";
	echo "</html> \n";
?>

