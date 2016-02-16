<?php
function getcatgory($text){
	require("config.php");
	foreach ($config["category"] as $catename => $keywordlist) {
		foreach ($keywordlist as $keyword) {
			if (preg_match("/".$keyword."/", $text)) {
				return $catename;
			}
		}
	}
	return $config["other_category"];
}
function getyear($month){
	require("config.php");
	if ($month >= $config["month"]) {
		return $config["year"];
	} else {
		return $config["year"]+1;
	}
}
?>