
<html>
<head>
<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>

<title>Qinyun Monitor</title>

<script type="text/javascript">
 
function ShowHidden(obj1){
	//alert("obj1"+obj1);
if(obj1.style.display==""){
	obj1.style.display = "none";
	if (obj1.id=="info"){
	    var a=document.body.clientWidth-15;  //取得iframe框架的实际宽度
        document.getElementById("down").style.width=a+"px";
    }
}else{
	obj1.style.display = "";
	if (obj1.id=="info"){
	    var a=document.body.clientWidth-200;  //取得iframe框架的实际宽度
	    document.getElementById("down").style.width=a+"px";
    }
}
}
</script>
   <style>
        body
        {
            width: 100%;
            margin: 0px auto;
        }
        
    </style>

</head>


<body>
<div id='up'>
<iframe style="HEIGHT: 100px;WIDTH: 100%; " name="mainFrame" scrolling="NO" noresize src="up.php">  </iframe> 
</div>
<div id='top' onClick='ShowHidden(up)' style='text-align:center;line-height:12px;height:10px;width:100%;cursor:hand;background:#678;font-size:8px;color:#fff' >
   OPEN / CLOSE</div>

<iframe frameBorder="0" id="down" name="down" scrolling="auto" src="tailfdown.php" style="position: absolute;Z-INDEX: 2; HEIGHT: 100%; VISIBILITY: inherit; WIDTH: 100%; ">    </iframe> 
</body>
</html>
