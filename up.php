<?php
echo " <html>  \n";
echo "<head>\n";
header("Refresh:3000"); 
echo "  <meta charset='utf-8'>\n";
echo "  <meta name='viewport' content='width=device-width, initial-scale=1'>\n";
echo "  <title>欢迎您使用项目日志查看程序</title>\n";

echo "<!-- CSS goes in the document HEAD or added to your external stylesheet --> \n";
echo " <style type='text/css'> \n";
echo ".basic-grey {";
echo "margin-top:10px;";
echo "margin-left:10px;";
echo "margin-right:auto;";
echo "max-width: 500px;";
echo "background: #F7F7F7;";
echo "padding: 25px 15px 25px 10px;";
echo "font: 12px Georgia, \"Times New Roman\", Times, serif;";
echo "color: #888;";
echo "text-shadow: 1px 1px 1px #FFF;";
echo "border:1px solid #E4E4E4;";
echo "}";
echo ".basic-grey h1 {";
echo "font-size: 25px;";
echo "padding: 0px 0px 10px 40px;";
echo "display: block;";
echo "border-bottom:1px solid #E4E4E4;";
echo "margin: -10px -15px 30px -10px;";
echo "color: #888;";
echo "}";
echo ".basic-grey h1>span {";
echo "display: block;";
echo "font-size: 11px;";
echo "}";
echo ".basic-grey label {";
echo "display: block;";
echo "margin: 0px;";
echo "}";
echo ".basic-grey label>span {";
echo "float: left;";
echo "width: 20%;";
echo "text-align: right;";
echo "padding-right: 10px;";
echo "margin-top: 10px;";
echo "color: #888;";
echo "}";
echo ".basic-grey input[type=\"text\"], .basic-grey input[type=\"email\"], .basic-grey textarea, .basic-grey select {";
echo "border: 1px solid #DADADA;";
echo "color: #888;";
echo "height: 30px;";
echo "margin-bottom: 16px;";
echo "margin-right: 6px;";
echo "margin-top: 2px;";
echo "outline: 0 none;";
echo "padding: 3px 3px 3px 5px;";
echo "width: 70%;";
echo "font-size: 12px;";
echo "line-height:15px;";
echo "box-shadow: inset 0px 1px 4px #ECECEC;";
echo "-moz-box-shadow: inset 0px 1px 4px #ECECEC;";
echo "-webkit-box-shadow: inset 0px 1px 4px #ECECEC;";
echo "}";
echo ".basic-grey textarea{";
echo "padding: 5px 3px 3px 5px;";
echo "}";
echo ".basic-grey select {";
echo "background: #FFF url('down-arrow.png') no-repeat right;";
echo "background: #FFF url('down-arrow.png') no-repeat right);";
echo "appearance:none;";
echo "-webkit-appearance:none;";
echo "-moz-appearance: none;";
echo "text-indent: 0.01px;";
echo "text-overflow: '';";
echo "width: 70%;";
echo "height: 35px;";
echo "line-height: 25px;";
echo "}";
echo ".basic-grey textarea{";
echo "height:100px;";
echo "}";
echo ".basic-grey .button {";
echo "background: #E27575;";
echo "border: none;";
echo "padding: 10px 25px 10px 25px;";
echo "color: #FFF;";
echo "box-shadow: 1px 1px 5px #B6B6B6;";
echo "border-radius: 3px;";
echo "text-shadow: 1px 1px 1px #9E3F3F;";
echo "cursor: pointer;";
echo "}";
echo ".basic-grey .button:hover {";
echo "background: #CF7A7A";
echo "}";

echo " </style>\n";
echo " </head>\n";
echo "<body style='margin:0 auto;align:center;'>\n";

?>
<?php 

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


function showform(){
	global $hostip;
	global $projnames;
	global $imagename;
	global $totaltimes;
	echo "<form name='form' action='tailfdown.php' target='down' method='post' class='' > \n";
    echo "&nbsp&nbsp&nbsp&nbsp<label style='color:black;font-size:18px;'>请选择：</label> \n ";
    echo "&nbsp&nbsp&nbsp&nbsp<label for='selhostname' style='color:black;font-size:14px;width:150'>主机</label> \n ";
    echo "<select name='selhostname' onclick=''>    \n ";
    for ($i=0; $i<count($hostip); $i++) {
        echo "<option value='".$hostip[$i]."'>".$hostip[$i]."</option>  \n ";
    }
    echo "</select>   \n ";
    //echo "<br> <br>  \n ";	 
    echo "&nbsp&nbsp&nbsp&nbsp<label for='selprojname' style='color:black;font-size:14px;width:150'>项目</label> \n ";
    echo "<select name='selprojname' onclick=''>    \n ";
    for ($i=0; $i<count($projnames); $i++) {
        echo "<option value='".$projnames[$i]."'>".$projnames[$i]."</option>  \n ";
    }
    echo "</select>   \n ";      
    echo "&nbsp&nbsp&nbsp&nbsp<label for='lines' style='color:black;font-size:14px;width:150'>起始行数:</label> \n ";
    echo "<input type='text' name='lines' id='lines'  value='20'>\n";
    echo "&nbsp&nbsp&nbsp&nbsp<label for='keyword' style='color:black;font-size:14px;width:150'>关键字加亮:</label> \n ";
    echo "<input type='text' name='keyword' id='keyword'  value='food'>\n";
    echo "&nbsp&nbsp&nbsp&nbsp<input  type='submit' name='tailf' value='查看日志' /> \n";     
	echo "&nbsp&nbsp&nbsp&nbsp<input  type='submit' name='stoptail' value='  停止  ' /> \n";   	
    echo "</form>\n"; 
}

selectdb();
showform();


?>