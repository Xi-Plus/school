<html>
<head>
	<meta charset="UTF-8">
	<style type="text/css">
	.inputnum {
		width:50;
	}
	</style>
</head>
<body>
<center>
<h2>國立臺南第一高級中學學生公假單 產生器</h2>
<table>
<tr>
<td align="center" valign="top">
	步驟一：建立設定檔
	<form id="form" action="download_setting.php" method="post">
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<td>類別</td>
			<td>
				<input id="type_normal" name="type" type="radio" value="normal" checked>公假申請
				<input id="type_event" name="type" type="radio" value="event">活動公假
			</td>
		</tr>
		<tr>
			<td>申請單位</td>
			<td><input name="applicant" type="text" id="applicant" value="資訊社" required></td>
		</tr>
		<tr>
			<td>事由</td>
			<td><input name="subject" type="text" id="subject" value="培訓" required></td>
		</tr>
		<tr>
			<td>活動地點</td>
			<td><input name="place" type="text" id="place" value="302電腦教室" required></td>
		</tr>
		<tr>
			<td>申請公假日期</td>
			<td>
				<input name="date_start" type="date" id="date_start" value="<?php echo date("Y-m-d"); ?>" required>至
				<input name="date_end" type="date" id="date_end" value="<?php echo date("Y-m-d"); ?>" required>
				<br>
				<input name="date_noon" type="checkbox" id="date_noon">午休（
				<input name="date_1" type="checkbox" id="date_1">一
				<input name="date_2" type="checkbox" id="date_2">二
				<input name="date_3" type="checkbox" id="date_3">三
				<input name="date_4" type="checkbox" id="date_4">四
				<input name="date_5" type="checkbox" id="date_5">五）
				<input name="date_meet" type="checkbox" id="date_meet">班、週會
				<input name="date_class" type="checkbox" id="date_class">
				第<input name="class_start" type="number" id="class_start" class="inputnum">節
				至
				第<input name="class_end" type="number" id="class_end" class="inputnum">節
			</td>
		</tr>
		<tr>
			<td>分頁</td>
			<td>
				<input id="page_class" name="page" type="radio" value="class" checked>依班級分頁
				<input id="page_auto" name="page" type="radio" value="auto">連續
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="下載設定檔"></td>
		</tr>
		</table>
	</form>
	修改設定檔
	<form method="post" enctype="multipart/form-data">
		<input type="hidden" name="editsetting">
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<td>上傳設定檔</td>
			<td><input type="file" name="setting" required>JSON 格式</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="上傳設定檔"></td>
		</tr>
		</table>
	</form>
</td>
<td align="center" valign="top">
	步驟二：產生公假單
	<form action="produce.php" method="post" enctype="multipart/form-data">
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<td>上傳設定檔</td>
			<td><input type="file" name="setting" required>JSON 格式</td>
		</tr>
		<tr>
			<td>上傳名單</td>
			<td><input type="file" name="list" required>CSV 格式</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" formaction="produce.php?type=html" value="產生公假單 html">
				<input type="submit" formaction="produce.php?type=doc" value="產生公假單 doc">
			</td>
		</tr>
		</table>
	</form>
	名單 說明
	<table>
	<tr>
		<td>
			<ul>
				<li>CSV格式</li>
				<li>編碼為 UTF-8(檔首無BOM)</li>
				<li>每行依序為 姓名,年級,班級,座號,活動地點</li>
				<li>空行為強迫換行</li>
			</ul>
		</td>
	</tr>
	</table>
</td>
</tr>
</table>
<?php
if (isset($_POST["editsetting"])) {
	try {
		if ($_FILES["setting"]["error"] != 0) {
			throw new Exception("設定檔上傳失敗");
		}
		$setting=file_get_contents($_FILES["setting"]["tmp_name"]);
		if ($setting === false) {
			throw new Exception("設定檔上傳失敗");
		}
		$setting=json_decode($setting, true);
		if ($setting === null) {
			throw new Exception("設定檔格式錯誤");
		}
		echo '<script>';
		include("resource/element.php");
		foreach ($element["input"]["radio"] as $key) {
			if (isset($setting[$key])) {
				echo $key.'_'.$setting[$key].'.click();'."\n";
			}
		}
		foreach ($element["input"]["checkbox"] as $key) {
			if (isset($setting[$key])) {
				echo $key.'.click();'."\n";
			}
		}
		foreach ($element["input"]["text"] as $key) {
			echo $key.'.value="'.$setting[$key].'";'."\n";
		}
		echo '</script>';
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>
<hr>
<?php
include("../../function/Xiplus-Facebook-Badge/badge.php");
?>
</center>
</body>
</html>