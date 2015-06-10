<?php
function httpRequest( $url , $post = null , $usepost =true ){
	if( is_array($post) )
	{
		ksort( $post );
		$post = http_build_query( $post );
	}
	
	$ch = curl_init();
	curl_setopt( $ch , CURLOPT_URL , $url );
	curl_setopt( $ch , CURLOPT_ENCODING, "UTF-8" );
	if($usepost)
	{
		curl_setopt( $ch , CURLOPT_POST, true );
		curl_setopt( $ch , CURLOPT_POSTFIELDS , $post );
	}
	curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
	curl_setopt ($ch , CURLOPT_COOKIEFILE, "cookie.txt" );
	curl_setopt ($ch , CURLOPT_COOKIEJAR , "cookie.txt" );
	
	$data = curl_exec($ch);
	curl_close($ch);
	if(!$data)
	{
		return false;
	}
	return $data;
}
function checklogin($id,$pwd){
	$post=array(
		"txtID"=>$id,
		"txtPWD"=>$pwd,
		"Chk"=>"Y"
	);
	httpRequest("http://svrsql.tnfsh.tn.edu.tw/webschool/",$post,true);
	$html=httpRequest("http://svrsql.tnfsh.tn.edu.tw/webschool/STDINFO.asp",$post,true);
	$html=iconv("BIG5", "UTF-8", $html);
	if(strpos($html, "學生個人基本資料"))return true;
	else return false;
}
?>