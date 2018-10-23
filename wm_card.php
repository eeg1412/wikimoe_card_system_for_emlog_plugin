<?php
/*
Plugin Name: 抽卡系统
Version: 2.3.11
Plugin URL:http://wikimoe.com
Description: <p>为了更灵活，需要在页面添加自定义钩子<br/><?php doAction('wm_card_plugin'); ?></p>
Author: 广树
Author URL: http://wikimoe.com
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function wm_card_loghook() {
	$wm_card_jsfile = BLOG_URL.'content/plugins/wm_card/card/card.js?ver=0.55';
	$wm_card_layerjsfile = BLOG_URL.'content/plugins/wm_card/layer/layer.js';
	$wm_card_layercssfile = BLOG_URL.'content/plugins/wm_card/layer/theme/default/layer.css';
	$wm_card_cssfile = BLOG_URL.'content/plugins/wm_card/card/card.css?ver=0.55';
	$wm_card_pluginpath = BLOG_URL.'content/plugins/wm_card/';
	$wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
	$wm_card_img_path = empty($wmCard_set['cdn'])?$wm_card_pluginpath.'card/img/':$wmCard_set['cdn'];
	$wm_donate_el = empty($wmCard_set['donate'])?'':'<div class="swiper-slide" data-type="donate" data-address="'.$wmCard_set['donate'].'"><img src="'.$wm_card_pluginpath.'/banner/banner2.jpg" /></div>';
	
	echo '<link href="'.$wm_card_cssfile.'" rel="stylesheet" type="text/css" />';
	echo '<link href="'.$wm_card_layercssfile.'" rel="stylesheet" type="text/css" />';
	echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css" type="text/css" />';
	echo '<div class="wm_card_body" id="wmCardBody">
			<div class="jar_loading_body" id="wmCardLoading">
				<div class="jar_loading_content">
					<div class="jar_loading_box">
						<div class="jar_loading_bg"></div>
						<div class="jar_loading">
						<div class="base_loading">
							<div class="liquid_loading"> </div>
							<div class="wave_loading"></div>
							<div class="wave_loading"></div>
							<div class="bubble_loading"></div>
							<div class="bubble_loading"></div>
						</div>
						<div class="bubble_loading"></div>
						<div class="bubble_loading"></div>
						</div>
					</div>
					<p class="jar_loading_text">正在炼制卡牌...</p>
				</div>
			</div>
			<div class="wm_card_mailcheck" id="wmMailCheckBody">
				<input type="password" name="email" class="wm_card_email_starshop" id="wmPassword" placeholder="请输入动态密码"><button type="button" class="wm_search_star_btn" id="wmGetPassword" data-email="">获取</button>
			</div>
			<div class="wm_card_cardmix_input_body" id="wmCardMixInputBody">
				<input type="text" name="email" class="wm_card_email_cardmix" id="wmCardMixInput" placeholder="请先输入邮箱查询卡牌" />
			</div>
			<div class="wm_card_demining_body" id="wmDeminingBody">
				<p class="wm_card_demining_tip">Tip:第一次点击选中矿区，再次点击挖开矿区！</p>
				<div class="wm_card_demining_input_body" id="wmDeminingInputBody">
					<input type="text" name="email" class="wm_card_email_demining" id="wmDeminingInput" placeholder="请先输入邮箱然后挖掘星星" />
				</div>
				<div class="wm_card_demining_table_box">
					<table class="wm_card_demining_table">
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="wm_card_cardmix_cardlist_body" id="wmCardMixListBody">
				<div class="wm_card_cardmix_cardlist_title">
					<h3>请选择多出的卡牌来分解成星星</h3>
					<p>Tip:系统已经自动预留一张卡牌 全部分解不影响收集率</p>
				</div>
				<div class="wm_card_cardmix_cardlist_box" id="wmCardMixListBox"></div>
				<div class="wm_mixcardmore_body">
					<button type="button" class="wm_mixcardmore_btn" id="wm_mixcardmore_btn">加载更多卡牌</button>
				</div>
			</div>
			<div class="wm_card_starshop_input_body" id="wmStarSearchInputBody">
				<input type="text" name="email" class="wm_card_email_starshop" id="wmStarSearchInput" placeholder="请先输入邮箱查询星星" />
			</div>
			<div class="wm_card_starshop_body" id="starshopBody">
				<div class="wm_star_count_body">
					星星 × <span id="wm_my_star" data-star="0" data-mail="">--<span>
				</div>
				<div class="wm_starshop_card_list" id="wmStarshopBody">
					<div class="wm_starshop_card_list_item">
						<div class="card selectcard" data-type="3" data-price="30">
							<div class="wm_starshop_rebuy_body">
								<button type="button" class="wm_search_star_btn wm_rebuy_btn">重置</button>
							</div>
							<div class="inner">
								<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
								<div class="back"></div>
							</div>
						</div>
						<p>普通抽卡</p>
						<p>需要：30星星</p>
					</div>
					<div class="wm_starshop_card_list_item">
						<div class="card selectcard" data-type="4" data-price="125">
							<div class="wm_starshop_rebuy_body">
								<button type="button" class="wm_search_star_btn wm_rebuy_btn">重置</button>
							</div>
							<div class="inner">
								<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
								<div class="back"></div>
							</div>
						</div>
						<p>4星抽卡</p>
						<p>需要：125星星</p>
					</div>
					<div class="wm_starshop_card_list_item">
						<div class="card selectcard" data-type="5" data-price="260">
							<div class="wm_starshop_rebuy_body">
								<button type="button" class="wm_search_star_btn wm_rebuy_btn">重置</button>
							</div>
							<div class="inner">
								<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
								<div class="back"></div>
							</div>
						</div>
						<p>5星抽卡</p>
						<p>需要：260星星</p>
					</div>
					<div class="wm_starshop_card_list_item">
						<div class="card selectcard" data-type="6" data-price="900">
							<div class="wm_starshop_rebuy_body">
								<button type="button" class="wm_search_star_btn wm_rebuy_btn">重置</button>
							</div>
							<div class="inner">
								<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
								<div class="back"></div>
							</div>
						</div>
						<p>6星抽卡</p>
						<p>需要：900星星</p>
					</div>
				</div>
			</div>
			<h5 class="wm_card_chiose_title" id="alertTitle">每天一次神抽</h5>
			<div class="wm_card_email_body" id="wmCardChioseInputBody">
				<input type="text" name="email" class="wm_card_email" id="wm_card_email" placeholder="请先输入邮箱地址再点击卡片">
				<div class="wm_card_remember_body">
					<div class="wm_card_remember_box" title="公共场合慎用！" id="wmRememberEmail">抽卡并保存邮箱地址</div>
				</div>
			</div>
			<div class="wm_card_restart_body">
				<button type="button" class="wm_restart_btn" id="wm_card_restart_btn">换号重来</button><button type="button" class="wm_restart_btn" id="wm_card_rechiose_btn">再抽一次</button></div>
			<div class="cardList" id="wmCardList">
			  <div class="cardList_body" id="wmGetCard">
				<div class="card selectcard" data-id="0">
					<div class="inner">
					<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
					<div class="back"></div>
					</div>
				</div>
				<div class="card selectcard" data-id="1">
					<div class="inner">
					<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
					<div class="back"></div>
					</div>
				</div>
				<div class="card selectcard" data-id="2">
					<div class="inner">
					<div class="face"><img src="'.$wm_card_pluginpath.'/card/img/back.jpg" alt="" class="wm_card_img"></div>
					<div class="back"></div>
					</div>
				</div>
			  </div>
			</div>
			<h5 class="wm_card_chiose_title" id="wm_mylist_title">您一共获得的卡牌</h5>
			<div class="wm_user_info_body">
				<table class="wm_user_info_table">
					<thead>
						<tr>
							<th>等级</th>
							<th>竞技点</th>
							<th>收集率</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="wm_user_level"></td>
							<td class="wm_user_score"></td>
							<td class="wm_user_getcard_count"></td>
						</tr>
					</tbody>
				</table>
				<div class="wm_tiaozhan_body">
					<input type="text" name="email" class="wm_card_email" id="wm_tiaozhan_email" placeholder="输入自己的邮箱地址挑战TA！">
					<button type="button" class="wm_tiaozhan_btn" id="wm_tiaozhan_btn">挑战TA</button>
				</div>
				<div class="wm_mycard_list"></div>
				<div class="wm_cardmore_body">
					<button type="button" class="wm_cardmore_btn" id="wm_cardmore_btn">加载更多卡牌</button>
				</div>
			</div>
        </div>
		<div class="wm_card_game_body">
        	<canvas class="wm_cardGame_canvas" id="wm_cardGame_canvas"></canvas>
		</div>
		<div class="wm_banner_body" id="wmBannerBody">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide" data-type="starDemining">
						<img src="'.$wm_card_pluginpath.'/banner/banner4.jpg" />
					</div>
					<div class="swiper-slide" data-type="starShop">
						<img src="'.$wm_card_pluginpath.'/banner/banner1.jpg" />
					</div>
					<div class="swiper-slide" data-type="cardMix">
						<img src="'.$wm_card_pluginpath.'/banner/banner3.jpg" />
					</div>
					'.$wm_donate_el.'
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
		<div class="wm_card_rank_body" id="wmCardRankBody">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide wm_card_rank_item_box" id="wmScoreRankBox">
						<h5 class="wm_card_chiose_title" id="wm_card_rank_title">竞技点排行榜</h5>
						<p class="wm_card_rank_last_updata">最后更新：<span class="wm_card_rank_last_time"></span></p>
						<div class="wm_card_rank_list"></div>
					</div>
					<div class="swiper-slide wm_card_rank_item_box" id="wmLevelRankBox">
						<h5 class="wm_card_chiose_title" id="wm_card_rank_title">等级排行榜</h5>
						<p class="wm_card_rank_last_updata">最后更新：<span class="wm_card_rank_last_time"></span></p>
						<div class="wm_card_rank_list"></div>
					</div>
					<div class="swiper-slide wm_card_rank_item_box" id="wmCardRankBox">
						<h5 class="wm_card_chiose_title" id="wm_card_rank_title">卡牌收集排行榜</h5>
						<p class="wm_card_rank_last_updata">最后更新：<span class="wm_card_rank_last_time"></span></p>
						<div class="wm_card_rank_list"></div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
		<div class="wm_card_get_list_body">
			<h5 class="wm_card_chiose_title">最新动态</h5>
			<div class="wm_card_get_list_item_body" id="wmCardGetList">
				
			</div>
			<div class="wm_get_list_more_body">
				<button type="button" class="wm_get_list_more_btn" id="wm_get_list_more_btn">加载更多动态</button>
			</div>
		</div>';
	echo '<script src="'.$wm_card_layerjsfile.'"></script>';
	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.jquery.js"></script>';
	echo '<script src="'.$wm_card_jsfile.'"></script>';
	echo '<script>var wmCardPluginpath = "'.$wm_card_pluginpath.'"</script>';
	echo '<script>var wmCardImgPath = "'.$wm_card_img_path.'"</script>';
}
addAction('wm_card_plugin','wm_card_loghook');
function wm_card_menu()
{
	echo '<div class="sidebarsubmenu" id="wm_card"><a href="./plugin.php?plugin=wm_card">卡牌设置</a></div>';
}
addAction('adm_sidebar_ext', 'wm_card_menu');
function wm_card_backup(){
	global $tables;
	$DB = MySql::getInstance();
	$is_exist_album_query = $DB->query('show tables like "'.DB_PREFIX.'wm_card"');
	if($DB->num_rows($is_exist_album_query) != 0) array_push($tables, 'wm_card');
}
addAction('data_prebakup', 'wm_card_backup');
?>