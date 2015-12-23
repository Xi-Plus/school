<?php
require_once("../../../function/curl/curl.php");
function checklogin($id,$pwd){
	$post=array(
		"txtID"=>$id,
		"txtPWD"=>$pwd,
		"Chk"=>"Y"
	);
	$html=cURL_HTTP_Request("http://svrsql.tnfsh.tn.edu.tw/webschool/",$post,false,"cookie.txt");
	$html=cURL_HTTP_Request("http://svrsql.tnfsh.tn.edu.tw/webschool/STDINFO.asp",null,false,"cookie.txt")->html;
	$html=iconv("BIG5", "UTF-8", $html);
	if(strpos($html, "學生個人基本資料"))return true;
	else return false;
}
?>