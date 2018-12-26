<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function callback_init(){
	$DB = MySql::getInstance();
	$check_table_exist = $DB->query('SHOW TABLES LIKE "'.DB_PREFIX.'wm_card"');
	if($DB->num_rows($check_table_exist) == 0){// 新建数据表
		$dbcharset = 'utf8mb4';
		$type = 'MYISAM';
		$add = $DB->getMysqlVersion() > '4.1' ? "ENGINE=".$type." DEFAULT CHARSET=".$dbcharset.";":"TYPE=".$type.";";
		$sql = "CREATE TABLE  `".DB_PREFIX."wm_card` (
		`id` mediumint(8) unsigned NOT NULL auto_increment,
		`email` varchar(255) NOT NULL default '0',
		`cardID` longtext NOT NULL,
		`cardCount` longtext NOT NULL,
		`timeStamp` bigint(20) NOT NULL,
		`todayCount` int(10) NOT NULL,
		`score` int(10) NOT NULL default '0',
		`level` int(10) NOT NULL default '0',
		`exp` int(10) NOT NULL default '0',
		`battleStamp` bigint(20) NOT NULL,
		`exData` longtext NOT NULL,
		`starCount` bigint(20) NOT NULL default '0',
		`verifyCode` int(10) NOT NULL default '0',
		`verifyCodeRemember` int(10) NOT NULL default '0',
		`verifyCodeStamp` bigint(20) NOT NULL,
		`verifyCodeCount` int(10) NOT NULL,
		`deminingStamp` bigint(20) NOT NULL,
		`deminingStarCount` bigint(20) NOT NULL default '0',
		`bouerse` longtext NOT NULL,
		PRIMARY KEY  (`id`)
)".$add;
		$DB->query($sql);
	}
}

function callback_rm(){
	$wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
	if(intval($wmCard_set['delDatabase'])=='1'){
		$DB = MySql::getInstance();
		$query = $DB->query("DROP TABLE IF EXISTS ".DB_PREFIX."wm_card");
	}
}
?>
