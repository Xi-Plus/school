<html>
<?php
ini_set("display_errors", 1);
?>
<head>
	<meta charset="UTF-8">
	<title>台南女中課表查詢系統 for Google Chrome</title>
	<!--<base href="http://w3.tngs.tn.edu.tw/departments/teach/classtable/">-->
</head>
<body bgColor="#ccccff" background="http://w3.tngs.tn.edu.tw/departments/teach/classtable/images/bg.jpg" marginheight="">
<center>
<h2>台南女中課表查詢系統 for Google Chrome</h2>
若你現在使用的是 <b>Internet Explorer 8</b> 或是<b>更舊版本</b>，建議你使用<a href="http://w3.tngs.tn.edu.tw/departments/teach/classtable/">正版網站</a><br><br>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center">

<form action="" method="get">
<input name="type" type="hidden" value="class">
<?php
$html=file_get_contents("http://w3.tngs.tn.edu.tw/departments/teach/classtable/top.asp");
$html=str_replace("\r\n", "", $html);
$html=iconv("BIG5", "UTF-8//IGNORE", $html);
preg_match('(<select name="select1".*?<\/select>)', $html, $match);
$temp=$match[0];
$temp=preg_replace('/style=".*?"/', "", $temp);
$temp=preg_replace('/onChange=".*?"/', "", $temp);
$temp=preg_replace('/onFocus=".*?"/', "", $temp);
$temp=preg_replace('/name=".*?"/', 'name="sqlstr"', $temp);
echo $temp;
// echo $html;
?>
<input name="" type="submit" value="submit">
</form>

</td><td>

<form action="" method="get">
<input name="type" type="hidden" value="teacher">
<?php
preg_match('(<select id="s2" name="select2".*?<\/select>)', $html, $match);
$temp=$match[0];
$temp=preg_replace('/style=".*?"/', "", $temp);
$temp=preg_replace('/onChange=".*?"/', "", $temp);
$temp=preg_replace('/onFocus=".*?"/', "", $temp);
$temp=preg_replace('/name=".*?"/', 'name="sqlstr"', $temp);
echo $temp;
// echo $html;
?>
<input name="" type="submit" value="submit">
</form>

</td><td>

<form action="" method="get">
<input name="type" type="hidden" value="room">
<?php
preg_match('(<SELECT id="s3" name="Select3".*?<\/SELECT>)', $html, $match);
$temp=$match[0];
$temp=preg_replace('/style=".*?"/', "", $temp);
$temp=preg_replace('/onChange=".*?"/', "", $temp);
$temp=preg_replace('/onFocus=".*?"/', "", $temp);
$temp=preg_replace('/name=".*?"/', 'name="sqlstr"', $temp);
echo $temp;
?>
<input name="" type="submit" value="submit">
</form>

</td>
</tr>
</table>
<?php
if(isset($_GET["sqlstr"])){
	$url="http://w3.tngs.tn.edu.tw/departments/teach/classtable/down.asp?sqlstr=".urlencode($_GET["sqlstr"])."&type=".urlencode($_GET["type"]);
	$html=file_get_contents($url);
	$html=iconv("BIG5", "UTF-8//IGNORE", $html);
	$html=str_replace("down.asp", "", $html);
	$html=str_replace("images/bg.jpg", "http://w3.tngs.tn.edu.tw/departments/teach/classtable/images/bg.jpg", $html);
	echo $html;
	?>
<script>
<?php 
	$typelist=array(
		"class"=>1,
		"teacher"=>2,
		"room"=>3
	);
	echo 's'.$typelist[$_GET["type"]].'.value="'.urldecode($_GET["sqlstr"]).'"';
?>
</script>
<?php
}
?>
</center>
</body>
</html>