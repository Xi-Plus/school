<?php
require_once("../../../function/curl/curl.php");
require_once("../login/func.php");
if(isset($_POST['id'])&&isset($_POST['pwd'])&&checklogin($_POST['id'],$_POST['pwd'])){
	?>
		<meta charset="UTF-8">
		<base href="http://svrsql.tnfsh.tn.edu.tw/webschool/STD_DAY.asp">
	<?php
	$html=cURL_HTTP_Request("http://svrsql.tnfsh.tn.edu.tw/webschool/STD_DAY.asp",null,false,"cookie.txt")->html;
	$html=iconv("BIG5", "UTF-8", $html);
	$html=str_replace("\r\n", "", $html);
	preg_match('/^(.+<td class="ColumnTDX"><font class="ColumnFONT">課外活動<\/font><\/a><\/td> <\/tr>).*?(<tr> <td colspan="14" class="ColumnTD">.+)$/', $html, $header);
	echo $header[1];
	$html=preg_match_all('/<tr><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td><td class="DataTDX?"><font class="DataFONTX?">.*?&nbsp;<\/font><\/td> <\/tr>/', $html, $match);
	foreach ($match[0] as $temp) {
		if(strpos($temp, "曠課")!==false||strpos($temp, "遲到")!==false){
			echo $temp;
		}
	}
	echo $header[2];
}else {
	?>
	<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
	<center>
		<h2>TNFSH列印曠課</h2>
		<h3>Open Source: <a href="https://github.com/Xi-Plus/school/tree/master/tnfsh/print_absence" target="_blank">On Github</a></h3>
		<form action="" method="post">
			帳號： <input name="id" type="text"><br>
			密碼： <input name="pwd" type="password"><br>
			<input name="" type="submit" value="送出">
		</form>
		<?php
		if(isset($_POST["id"])){
			echo "登入失敗";
		}
		?>
	</center>
	</body>
	</html>
	<?php
}
?>