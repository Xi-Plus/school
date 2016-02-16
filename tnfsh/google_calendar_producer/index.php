<?php
require("function.php");
$chitext=array(
"一 月"=>"CUT month=1;",
"二 月"=>"CUT month=2;",
"三 月"=>"CUT month=3;",
"四 月"=>"CUT month=4;",
"五 月"=>"CUT month=5;",
"六 月"=>"CUT month=6;",
"七 月"=>"CUT month=7;",
"八 月"=>"CUT month=8;",
"九 月"=>"CUT month=9;",
"十 月"=>"CUT month=10;",
"十 一 月"=>"CUT month=11;",
"十 二 月"=>"CUT month=12;",
);
$text=file_get_contents("input.txt");
$text=str_replace(array("\r\n","\n")," ",$text);
foreach ($chitext as $index => $temp){
	$text=str_replace($index,$temp,$text);
}
$text=explode("CUT",$text);
$output="Category,Subject,Start Date,Start Time,End Date,End Time,All Day Event,Description,Location,Private\r\n";
foreach ($text as $monthtext){
	if(preg_match("/month=(\d+);/",$monthtext,$month)){
		$month=$month[1];
		$monthtext=explode("。",$monthtext);
		foreach ($monthtext as $daylist){
			$startmonth=$month;
			$startdate=false;
			$endmonth=$month;
			$daylist=str_replace("至","～",$daylist);
			if(preg_match('/(\d+?)月(\d+?)日～(\d+?)月(\d+?)日/',$daylist,$temp)){
				$startmonth=$temp[1];
				$startdate=$temp[2];
				$endmonth=$temp[3];
				$enddate=$temp[4];
			}else if(preg_match('/(\d+?)日～(\d+?)月(\d+?)日/',$daylist,$temp)){
				$startdate=$temp[1];
				$endmonth=$temp[2];
				$enddate=$temp[3];
			}else if(preg_match('/(\d+?)～(\d+?)日/',$daylist,$temp)){
				$startdate=$temp[1];
				$enddate=$temp[2];
			}else if(preg_match('/((\d+、)*\d+)日/',$daylist,$temp)){
				$temp2=$temp[1];
				$temp2=explode("、",$temp2);
				$startdate=$temp2[0];
				$enddate=$temp2[count($temp2)-1];
			}else if(preg_match('/(\d+)：/',$daylist,$temp)){
				$startdate=$temp[1];
				$enddate=$temp[1];
			}
			if($startdate===false)continue;
			$daylist=str_replace(":","：",$daylist);
			preg_match('/：(.+)/',$daylist,$temp);
			$daytext=$temp[1];
			$daytext=str_replace(array(" "),"",$daytext);
			$daytext=explode("；",$daytext);
			foreach ($daytext as $text){
				$output.=
					getcatgory($text).",".$text.",".
					str_pad($startmonth, 2, "0", STR_PAD_LEFT)."/".str_pad($startdate, 2, "0", STR_PAD_LEFT)."/".getyear($startmonth).",".
					",".
					str_pad($endmonth, 2, "0", STR_PAD_LEFT)."/".str_pad($enddate, 2, "0", STR_PAD_LEFT)."/".getyear($endmonth).",".
					",".
					"True,".
					",".
					",".
					"False\r\n"
				;
			}
		}
	}
}
file_put_contents("output.csv",$output);
?>
