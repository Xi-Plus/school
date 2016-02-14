<html>
<head>
	<meta charset="UTF-8">
	<title>台南一中課表查詢系統 for UTF-8</title>
</head>
<body bgColor="#D0D0D0">
<center>
<h2>台南一中課表查詢系統 for UTF-8</h2>
若你想要使用 <b>BIG5</b> 或是想看<b>亂碼</b>，建議你使用<a href="http://w3.tnfsh.tn.edu.tw/deanofstudies/course/course.html">正版網站</a><br><br>
<?php
if(isset($_GET["class"])){
	$url="http://w3.tnfsh.tn.edu.tw/deanofstudies/course/c101".urlencode($_GET["class"]).".html";
	$html=@file_get_contents($url);
	$html=iconv("BIG5", "UTF-8//IGNORE", $html);
	$html=preg_replace('/href=".*?t(.*?).html"/','href="?teach=$1"',$html);
	$html=preg_replace('/href=".*?_(.*?).html"/','href="?main=$1"',$html);
}
else if(isset($_GET["teach"])){
	$url="http://w3.tnfsh.tn.edu.tw/deanofstudies/course/t".urlencode($_GET["teach"]).".html";
	$html=@file_get_contents($url);
	$html=iconv("BIG5", "UTF-8//IGNORE", $html);
	$html=preg_replace('/href=".*?c101(.*?).html"/','href="?class=$1"',$html);
	$html=preg_replace('/href=".*?_(.*?).html"/','href="?main=$1"',$html);
}
else if(isset($_GET["main"])){
	$url="http://w3.tnfsh.tn.edu.tw/deanofstudies/course/_".urlencode($_GET["main"]).".html";
	$html=@file_get_contents($url);
	$html=iconv("BIG5", "UTF-8//IGNORE", $html);
	$html=preg_replace('/href=".*?c101(.*?).html"/','href="?class=$1"',$html);
	$html=preg_replace('/href=".*?t(.*?).html"/','href="?teach=$1"',$html);
}
else {
	$url="http://w3.tnfsh.tn.edu.tw/deanofstudies/course/course.html";
	$html=@file_get_contents($url);
	$html=iconv("BIG5", "UTF-8//IGNORE", $html);
	$html=preg_replace('/href=".*?_(.*?).html"/','href="?main=$1"',$html);
}
echo $html;
?>
<hr>
<?php
include("../../function/Xiplus-Facebook-Badge/badge.php");
?>
</center>
</body>
</html>