<?php
require_once('../../../init.php');	
function wm_cardsearch(){
	$DB = MySql::getInstance();
	$data = null;
	$emailAddr = strip_tags($_POST['email']);
	if(!preg_match("/^[A-Za-z0-9]+$/",$emailAddr)){
		$data = json_encode(array('code'=>"0"));
	}else{
		$comment_author_email = "\"".$emailAddr."\"";
		$mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$comment_author_email."");
		$mgidinfo=$DB->fetch_array($mgid);
		if ($mgidinfo) {
			$json_string = json_decode(file_get_contents('cardData.json'), true);//查询卡牌数据
			$data = json_encode(array('code'=>"202",'data'=>$mgidinfo['cardID'],'cardCount'=>$mgidinfo['cardCount'],'score'=>$mgidinfo['score'],'level'=>$mgidinfo['level'],'cardLength'=>count($json_string['cardData'])));
		}else{
			$data = json_encode(array('code'=>"1"));
		}
	}
	//0为字符串有误,1为没数据
	echo $data;
}
wm_cardsearch();
?>