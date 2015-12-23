<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
<center>
	<h2>登入TNFSH測試 (使用成績登入查詢系統)</h2>
	<h3>Open Source: <a href="https://github.com/Xi-Plus/school/tree/master/tnfsh/login" target="_blank">On Github</a></h3>
	<form action="" method="post">
		帳號： <input name="id" type="text"><br>
		密碼： <input name="pwd" type="password"><br>
		<input name="" type="submit" value="送出">
	</form>
	<?php
	require_once("func.php");
	if(isset($_POST["id"])){
		$cookie;
		if(checklogin($_POST["id"],$_POST["pwd"]))echo "登入成功";
		else echo "登入失敗";
	}
	?>
</center>
</body>
</html>