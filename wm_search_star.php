<?php
require_once('../../../init.php');	
function wm_star_search(){
	$DB = Database::getInstance();
	$data = null;
	$emailAddr = strip_tags($_POST['email']);
	if(!preg_match("/^[A-Za-z0-9]+$/",$emailAddr)){
		$data = json_encode(array('code'=>"0"));
	}else{
		$comment_author_email = "\"".$emailAddr."\"";
		$mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$comment_author_email."");
		$mgidinfo=$DB->fetch_array($mgid);
		if ($mgidinfo) {
			$data = json_encode(array('code'=>"202",'star'=>$mgidinfo['starCount']));
		}else{
			$data = json_encode(array('code'=>"1"));
		}
	}
	//0为字符串有误,1为没数据
	echo $data;
}
wm_star_search();
?>