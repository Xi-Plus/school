<?php
date_default_timezone_set('Asia/Taipei');
require("../../function/SQL-function/sql.php");
if(!is_numeric(@$_GET['page']))@$_GET['page']=1;
if(!is_numeric(@$_GET['school']))@$_GET['school']=0;
?>
<!DOCTYPE>
<html>
<head>
	<title>一中&amp;女中105級班級查詢系統</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width,user-scalable=yes">
</head>
<body>
	<center>
	<h2>一中&amp;女中105級班級查詢系統</h2>
	<form action="" method="get" id="searchform">
    學號<input name="studentid" type="number" id="studentid" value="<?php echo @$_GET['studentid']; ?>">
    姓名<input name="studentname" type="text" id="studentname" value="<?php echo @urldecode($_GET['studentname']); ?>"><br>
    組別<input name="team" type="number" id="team" value="<?php echo @$_GET['team']; ?>" min="1" max="3">
    學校
    <input name="school" id="school0" type="radio" value="0" checked="CHECKED">全部
    <input name="school" id="school1" type="radio" value="1">一中
    <input name="school" id="school2" type="radio" value="2">女中
    <script>school<?php echo $_GET["school"]; ?>.checked=true;</script>
	<br>
    一年級班級<input name="oldclass" type="number" id="oldclass" value="<?php echo @$_GET['oldclass']; ?>" min="1" max="19">
    一年級座號<input name="oldseatnum" type="number" id="oldseatnum" value="<?php echo @$_GET['oldseatnum']; ?>" min="1"><br>
    二年級班級<input name="newclass" type="number" id="newclass" value="<?php echo @$_GET['newclass']; ?>" min="1" max="19">
    二年級座號<input name="newseatnum" type="number" id="newseatnum" value="<?php echo @$_GET['newseatnum']; ?>" min="1">
    <br>
    <input type="submit" value="查詢">
    <input type="reset" value="清除">
	<br>
    <?php
	if($_GET['page']>1){
		?><input type="button" value="前一頁" onclick="go(-1)"><?php
	}
	?><input type="button" value="後一頁" onclick="go(1)">
    跳到第<input name="page" type="number" id="page" value="<?php echo $_GET["page"]; ?>" min="1">頁<input type="submit" value="Go">
	</form>
	<script>
	function go(n){
		if(n==-1)page.value--;
		else if(n==1)page.value++;
		searchform.submit();
	}
    </script>
    <table class=MsoTableGrid border=1 cellpadding=3 style='border-collapse:collapse;border:none'>
    <tr>
    <td>學校</td>
    <td>學號</td>
    <td>姓名</td>
    <td>組別</td>
    <td>一年級<br>班級</td>
    <td>一年級<br>座號</td>
    <td>二年級<br>班級</td>
    <td>二年級<br>座號</td>
    </tr>
	<?php
$query=new query;
include("config.php");
$query->dbname=$config["db"]["dbname"];
$query->table=$config["db"]["table"];
if(@$_GET['studentid']!=''){
	$query->where[]=array("studentid",$_GET['studentid']);
}
if(@$_GET['studentname']!=''){
	$query->where[]=array("name",urldecode($_GET['studentname']),"REGEXP");
}
if(is_numeric(@$_GET['team'])){
	$query->where[]=array("team",$_GET['team']);
}
if(@$_GET['oldclass']!=''){
	$query->where[]=array("oldclass",$_GET['oldclass']);
}
if(@$_GET['oldseatnum']!=''){
	$query->where[]=array("oldseatnum",$_GET['oldseatnum']);
}
if(@$_GET['newclass']!=''){
	$query->where[]=array("newclass",$_GET['newclass']);
}
if(@$_GET['newseatnum']!=''){
	$query->where[]=array("newseatnum",$_GET['newseatnum']);
}
if(@$_GET['school']==1){
	$query->where[]=array("school","1");
}else if(@$_GET['school']==2){
	$query->where[]=array("school","2");
}
$query->order=array(
	array("number")
);
$query->limit=array(($_GET['page']*30-30),30);
$temp=SELECT($query);
foreach ($temp as $row){
	?><tr>
	<td><?php echo ($row['school']==1?"一中":"女中"); ?></td>
	<td><?php echo $row['studentid']; ?></td>
	<td><?php echo $row['name']; ?></td>
	<td><?php echo $row['team']; ?></td>
	<td><?php echo $row['oldclass']; ?></td>
	<td><?php echo $row['oldseatnum']; ?></td>
	<td><?php echo $row['newclass']; ?></td>
	<td><?php echo $row['newseatnum']; ?></td>
	</tr>
	<?php
}
?>
</table>
<hr>
<?php
include("../../../function/developer.php");
?>
<font color="#666666" style="font-size: 14px"><a style="cursor:pointer" onClick="var state=getElementById('state'); 
state.style.display=state.style.display=='none'?'':'none'">聲明</a></font>
<div id="state" style="display:none">
  <font color="#666666" style="font-size: 14px">
    依據「<a href="http://law.moj.gov.tw/Eng/LawClass/LawAll.aspx?PCode=I0050021" target="_blank">Personal Information Protection Act</a>」Chapter III Article 19 Paragraph 1：「Except the information stated in Paragraph 1 of Article 6, the non-government agency should not collect or process personal information unless there is a specific purpose and should comply with one of the following conditions:」<br>
    且符合同Paragraph Item 7：「Where the personal information is obtained from publicly available resources.」本網站所有內容，其目的是「供大家方便查詢新編班」，其全部使用的資料皆來自以下所列：</font><br>
      <font color="#666666" style="font-size: 12px">
      <a href="http://www.tnfsh.tn.edu.tw" target="_blank">國立臺南第一高級中學</a> <a href="http://study.tnfsh.tn.edu.tw/ezfiles/3/1003/attach/66/pta_2621_2668579_77963.pdf" target="_blank">舊班級</a> <a href="http://study.tnfsh.tn.edu.tw/ezfiles/3/1003/attach/66/pta_3997_6848617_79104.pdf" target="_blank">新班級</a><br>
      <a href="http://www.tngs.tn.edu.tw" target="_blank">國立臺南女子高級中學</a> <a href="http://www.tngs.tn.edu.tw/tngs/board/upfiles/%E8%A8%BB%E5%86%8A%E7%B5%84_102%E5%AD%B8%E5%B9%B4%E5%BA%A6%E9%AB%98%E4%B8%80%E6%96%B0%E7%94%9F%E7%B7%A8%E7%8F%AD%E5%90%8D%E5%96%AE.pdf" target="_blank">舊班級</a> <a href="http://www.tngs.tn.edu.tw/tngs/board/upfiles/%E8%A8%BB%E5%86%8A%E7%B5%84_%E9%AB%98%E4%B8%80%E5%8D%87%E9%AB%98%E4%BA%8C%E7%B7%A8%E7%8F%AD_%E5%85%AC%E5%91%8A%E7%89%88.pdf" target="_blank">新班級</a><br>
      </font>
<font color="#666666" style="font-size: 14px">
且依據Chapter I Article 8 Paragraph 2 Item 5：「when the Party should have known the content of the notification already.」得免告知當事人。</font>
</div>
    </center>
</body>
</html>