<?php
/*
Plugin Name: 抽卡系统
Version: 1.0
Plugin URL:http://wikimoe.com
Description: <p>为了更灵活，需要在页面添加自定义钩子<br/><?php doAction('wm_card_plugin'); ?></p>
Author: 广树
Author URL: http://wikimoe.com
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function wm_card_init() {
	global $tables;
	$DB = MySql::getInstance();
	$mgid=$DB->query("SELECT cardID FROM ".DB_PREFIX."wm_card");
	$mgidinfo=$DB->fetch_array($mgid);
	if (!$mgidinfo) {
		$sqli="INSERT INTO ".DB_PREFIX."qingzz_zan (zanid,zancount) VALUES('".$blogid."',0)";
		$DB->query($sqli);
	}
}
function wm_card_loghook() {
	$wm_card_jsfile = BLOG_URL.'content/plugins/wm_card/card/card.js?ver=0.2';
	$wm_card_cssfile = BLOG_URL.'content/plugins/wm_card/card/card.css?ver=0.2';
	$wm_card_pluginpath = BLOG_URL.'content/plugins/wm_card/';
	echo '<link href="'.$wm_card_cssfile.'" rel="stylesheet" type="text/css" />';
	echo '<div class="wm_card_body">
			<h5 class="wm_card_chiose_title" id="alertTitle">每天一次神抽</h5>
			<div class="wm_card_email_body"><input type="text" name="email" class="wm_card_email" id="wm_card_email" placeholder="请先输入邮箱地址再点击卡片"></div>
            <div class="cardList">
              <div class="card" id="wmGetCard">
                <div class="inner">
                  <div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" id="wm_card_img"></div>
                  <div class="back"></div>
                </div>
              </div>
			</div>
			<h5 class="wm_card_chiose_title" id="wm_mylist_title">您一共获得的卡牌</h5>
			<div class="wm_user_info_body">
				<table class="wm_user_info_table">
					<tr>
						<th>等级</th>
						<th>竞技点</th>
					</tr>
					<tr>
						<td class="wm_user_level"></td>
						<td class="wm_user_score"></td>
					</tr>
				</table>
				<div class="wm_tiaozhan_body">
					<input type="text" name="email" class="wm_card_email" id="wm_tiaozhan_email" placeholder="输入自己的邮箱地址挑战TA！">
					<button type="button" class="wm_tiaozhan_btn" id="wm_tiaozhan_btn">挑战TA</button>
				</div>
				<div class="wm_mycard_list"></div>
			</div>
        </div>
		<div class="wm_card_game_body">
        	<canvas class="wm_cardGame_canvas" id="wm_cardGame_canvas"></canvas>
        </div>';
	echo '<script src="'.$wm_card_jsfile.'"></script>';
	echo '<script>var wmCardPluginpath = "'.$wm_card_pluginpath.'"</script>';
}
addAction('wm_card_plugin','wm_card_loghook');
function wm_card_backup(){
	global $tables;
	$DB = MySql::getInstance();
	$is_exist_album_query = $DB->query('show tables like "'.DB_PREFIX.'wm_card"');
	if($DB->num_rows($is_exist_album_query) != 0) array_push($tables, 'wm_card');
}
addAction('data_prebakup', 'wm_card_backup');
?>