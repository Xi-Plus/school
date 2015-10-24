<?php
require("config.php");
$today_realtime = strtotime(date("Y-m-d"));
$endday_realtime = strtotime($lastdate);
$today_count=(int)($today_realtime/86400);
$endday_count=(int)($endday_realtime/86400);
$datadiff=$endday_count-$today_count+1;
echo "距考試還有 ".$datadiff." 天<br>";
$daycount=array();
for($i=0;$i<7;$i++){
	$daycount[$i]=(int)($datadiff/7);
}
for($i=date("w",$today_realtime);$i<date("w",$today_realtime)+$datadiff%7;$i++){
	$daycount[$i%7]++;
}
$classcount=array();
for($i=1;$i<=8;$i++){
	for ($j=1; $j <=5; $j++) {
		@$classcount[$classtable[$i][$j]]+=$daycount[$j];
	}
}
$date=date("Y-m-d");
$time=date("Hi");
$day=date("w");
echo "現在是 ".$date." ";
for ($i=0; $i < count($timelist)-1; $i++){
	if(date("w")==0||date("w")==6){
		echo "非上課日";
		break;
	}else if($timelist[$i][0]<=$time&&$time<$timelist[$i+1][0]){
		if($timelist[$i][1]=="Attend")echo "第".$timelist[$i][2]."節 ".$classtable[$timelist[$i][2]][$day];
		else if($timelist[$i][1]=="Finish")echo "第".$timelist[$i][2]."節下課";
		else echo $timelist[$i][3];
		$class=$timelist[$i][2];
		break;
	}else if($timelist[$i][1]=="Attend"){
		$classcount[$classtable[$timelist[$i][2]][$day]]--;
	}
}
foreach ($special as $key => $value) {
	if(($date==$value[0]&&$class<=$value[1]||$date<$value[0])&&$value[0]<=$lastdate){
		$classcount[$classtable[$value[1]][date("w",strtotime($value[0]))]]--;
		if($value[2]!=""){
			$classcount[$value[2]]++;
		}
	}
}
echo "<hr>";
foreach ($classlist as $key => $value) {
	if(@$classcount[$value]){
		echo $value." 還有 ".$classcount[$value]." 堂課<br>";
	}
}
?>