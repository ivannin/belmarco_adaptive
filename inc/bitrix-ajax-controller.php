<?php
/*if (!session_id())
    session_start();
if( ( isset($_POST["phone"]) && !isset($_POST["save_session"]) ) || ( isset($_POST["send_session"]) && session_id() )){
	$title_lid = "Брошенная корзина";
	$param=array();
	if(isset($_POST["title_lid"]))
		$title_lid = $_POST["title_lid"];

	if(isset($_POST["send_session"])){
		$title_lid = "Брошенная корзина - ушел с других страниц сайта";
		$param['phone'] = $_SESSION["belmarco_phone_lid"];
	}
	else{
		$param['phone'] = $_POST["phone"];
	}

	$param['login'] = 'belmarcodir@yandex.ru';
	$param['password'] = 'goodweb';
	$param['title'] = $title_lid;
	date_default_timezone_set('Etc/GMT-4');
	$param['time'] = urlencode(date('H:i:s', time()));
	$param['phone']= str_replace([' ', '(', ')', '-', '+'], '', $param['phone']);
	$cid= '';
	if ( isset($_COOKIE["_ga"]) ) 
		$cid= $_COOKIE["_ga"];
	if(!empty($param['phone'])){
		$url_params_bitrix = 'https://belmarko.bitrix24.ru/crm/configs/import/lead.php?LOGIN='.$param['login']
		.'&PASSWORD='.$param['password']
		.'&TITLE='.$param['title']
		.'&PHONE_MOBILE='.$param['phone']
		.'&UF_CRM_1452845894='.$cid
		.'&UF_CRM_1421648024='.$param['time']
		.'&UF_CRM_1490857988=false';
		$r = file_get_contents( $url_params_bitrix );
		unset($_SESSION["belmarco_title_lid"]);
		unset($_SESSION["belmarco_phone_lid"]);
		echo $r;
	}
}
if(isset($_POST["save_session"]) && isset($_POST["phone"])){
	$_SESSION["belmarco_title_lid"] = "Брошенная корзина";
	$_SESSION["belmarco_phone_lid"] = $_POST["phone"];
	echo "save session";
}*/
?>