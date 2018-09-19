
<?php

echo " <html>  \n";
echo "<head>\n";
header("Refresh:30"); 
echo "  <meta charset='utf-8'>\n";
echo "  <meta name='viewport' content='width=device-width, initial-scale=1'>\n";
echo "  <title>欢迎您使用端口进程信息查询</title>\n";

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
echo " 	background-color:#81D8D0;\n";
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
echo "   width:50px;\n";
echo "    }\n";
echo " </style>\n";
echo " </head>\n";
echo "<body style='margin:0 auto;align:center;'>\n";
echo " <form id='form' name='form' method='post' action='$PHP_SELF'>\n";
echo " 历史时间(如：20161128 10:05): <input type='text' name='datetime' id='datetime'  value=''>\n";
echo "   <input class='shiny-blue' type='submit' name='Submit' value='查询' />\n";
echo " </form>\n";
?>


<?php
     function ShowTable($table_name) {
		include_once("qinconfig.inc.php");
		$conn=mysql_connect($MysqlHost,$MysqlUser,$MysqlPass)	or die("无法连接数据库，请重来");
		mysql_select_db($mondb,$conn);
        mysql_query("SET NAMES UTF8");
        $sql="select `date`,b.hostname,a.ip,port from $table_name as a inner join hostip as b on trim(a.ip)=trim(b.ip) order by ip";
		if ( $_REQUEST["datetime"] )
		{
			$tablehis="$table_name"."his";
			$sql="select distinct `date`,b.hostname,a.ip,port from $tablehis as a inner join hostip as b on trim(a.ip)=trim(b.ip) where `date` like '%$_REQUEST[datetime]%' order by ip";
		}        
        $res=mysql_query($sql,$conn);
        $rows=mysql_affected_rows($conn);//获取行数
        $colums=mysql_num_fields($res);//获取列数

        echo "<div style='margin:0 auto;align:center;font-size:22px;font-family:SimHei;width:800px'>".'欢迎您使用端口进程信息查询，查询的数据如下：(共计:'.$rows.'行'.$colums.'列)'."</div>\n";
        echo "<table class='altrowstable' id='alternatecolor' style='margin:0 auto;align:center;word-break:break-all; word-wrap:break-all;'> <tr>\n";
		
		echo "<th>sn</th>\n";
        for($i=0; $i < $colums; $i++){
            $field_name=mysql_field_name($res,$i);
  	          echo "<th>".$field_name."</th>\n";
        }
        echo "</tr>\n";
    	$j=0;
        while($row=mysql_fetch_row($res)){
            if($j/2==round($j/2)){echo "<tr class='oddrowcolor'>\n";}
		    else{echo "<tr class='evenrowcolor'>\n";}
			$j++;
			echo "<td>".$j."</td>\n";
            for($i=0; $i<$colums; $i++){
				if($i==3){echo "<td width='50%'>".$row[$i]."</td>\n";}
				else{echo "<td>".$row[$i]."</td>\n";}
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
		echo "</br></br></br>";
     }
	 
   ShowTable("portinfo");
	 echo "</body>\n";
	 echo "</html> \n";
?>

