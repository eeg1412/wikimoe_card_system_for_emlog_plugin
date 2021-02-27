!function(n){"use strict";function t(n,t){var r=(65535&n)+(65535&t);return(n>>16)+(t>>16)+(r>>16)<<16|65535&r}function r(n,t){return n<<t|n>>>32-t}function e(n,e,o,u,c,f){return t(r(t(t(e,n),t(u,f)),c),o)}function o(n,t,r,o,u,c,f){return e(t&r|~t&o,n,t,u,c,f)}function u(n,t,r,o,u,c,f){return e(t&o|r&~o,n,t,u,c,f)}function c(n,t,r,o,u,c,f){return e(t^r^o,n,t,u,c,f)}function f(n,t,r,o,u,c,f){return e(r^(t|~o),n,t,u,c,f)}function i(n,r){n[r>>5]|=128<<r%32,n[14+(r+64>>>9<<4)]=r;var e,i,a,d,h,l=1732584193,g=-271733879,v=-1732584194,m=271733878;for(e=0;e<n.length;e+=16)i=l,a=g,d=v,h=m,g=f(g=f(g=f(g=f(g=c(g=c(g=c(g=c(g=u(g=u(g=u(g=u(g=o(g=o(g=o(g=o(g,v=o(v,m=o(m,l=o(l,g,v,m,n[e],7,-680876936),g,v,n[e+1],12,-389564586),l,g,n[e+2],17,606105819),m,l,n[e+3],22,-1044525330),v=o(v,m=o(m,l=o(l,g,v,m,n[e+4],7,-176418897),g,v,n[e+5],12,1200080426),l,g,n[e+6],17,-1473231341),m,l,n[e+7],22,-45705983),v=o(v,m=o(m,l=o(l,g,v,m,n[e+8],7,1770035416),g,v,n[e+9],12,-1958414417),l,g,n[e+10],17,-42063),m,l,n[e+11],22,-1990404162),v=o(v,m=o(m,l=o(l,g,v,m,n[e+12],7,1804603682),g,v,n[e+13],12,-40341101),l,g,n[e+14],17,-1502002290),m,l,n[e+15],22,1236535329),v=u(v,m=u(m,l=u(l,g,v,m,n[e+1],5,-165796510),g,v,n[e+6],9,-1069501632),l,g,n[e+11],14,643717713),m,l,n[e],20,-373897302),v=u(v,m=u(m,l=u(l,g,v,m,n[e+5],5,-701558691),g,v,n[e+10],9,38016083),l,g,n[e+15],14,-660478335),m,l,n[e+4],20,-405537848),v=u(v,m=u(m,l=u(l,g,v,m,n[e+9],5,568446438),g,v,n[e+14],9,-1019803690),l,g,n[e+3],14,-187363961),m,l,n[e+8],20,1163531501),v=u(v,m=u(m,l=u(l,g,v,m,n[e+13],5,-1444681467),g,v,n[e+2],9,-51403784),l,g,n[e+7],14,1735328473),m,l,n[e+12],20,-1926607734),v=c(v,m=c(m,l=c(l,g,v,m,n[e+5],4,-378558),g,v,n[e+8],11,-2022574463),l,g,n[e+11],16,1839030562),m,l,n[e+14],23,-35309556),v=c(v,m=c(m,l=c(l,g,v,m,n[e+1],4,-1530992060),g,v,n[e+4],11,1272893353),l,g,n[e+7],16,-155497632),m,l,n[e+10],23,-1094730640),v=c(v,m=c(m,l=c(l,g,v,m,n[e+13],4,681279174),g,v,n[e],11,-358537222),l,g,n[e+3],16,-722521979),m,l,n[e+6],23,76029189),v=c(v,m=c(m,l=c(l,g,v,m,n[e+9],4,-640364487),g,v,n[e+12],11,-421815835),l,g,n[e+15],16,530742520),m,l,n[e+2],23,-995338651),v=f(v,m=f(m,l=f(l,g,v,m,n[e],6,-198630844),g,v,n[e+7],10,1126891415),l,g,n[e+14],15,-1416354905),m,l,n[e+5],21,-57434055),v=f(v,m=f(m,l=f(l,g,v,m,n[e+12],6,1700485571),g,v,n[e+3],10,-1894986606),l,g,n[e+10],15,-1051523),m,l,n[e+1],21,-2054922799),v=f(v,m=f(m,l=f(l,g,v,m,n[e+8],6,1873313359),g,v,n[e+15],10,-30611744),l,g,n[e+6],15,-1560198380),m,l,n[e+13],21,1309151649),v=f(v,m=f(m,l=f(l,g,v,m,n[e+4],6,-145523070),g,v,n[e+11],10,-1120210379),l,g,n[e+2],15,718787259),m,l,n[e+9],21,-343485551),l=t(l,i),g=t(g,a),v=t(v,d),m=t(m,h);return[l,g,v,m]}function a(n){var t,r="",e=32*n.length;for(t=0;t<e;t+=8)r+=String.fromCharCode(n[t>>5]>>>t%32&255);return r}function d(n){var t,r=[];for(r[(n.length>>2)-1]=void 0,t=0;t<r.length;t+=1)r[t]=0;var e=8*n.length;for(t=0;t<e;t+=8)r[t>>5]|=(255&n.charCodeAt(t/8))<<t%32;return r}function h(n){return a(i(d(n),8*n.length))}function l(n,t){var r,e,o=d(n),u=[],c=[];for(u[15]=c[15]=void 0,o.length>16&&(o=i(o,8*n.length)),r=0;r<16;r+=1)u[r]=909522486^o[r],c[r]=1549556828^o[r];return e=i(u.concat(d(t)),512+8*t.length),a(i(c.concat(e),640))}function g(n){var t,r,e="";for(r=0;r<n.length;r+=1)t=n.charCodeAt(r),e+="0123456789abcdef".charAt(t>>>4&15)+"0123456789abcdef".charAt(15&t);return e}function v(n){return unescape(encodeURIComponent(n))}function m(n){return h(v(n))}function p(n){return g(m(n))}function s(n,t){return l(v(n),v(t))}function C(n,t){return g(s(n,t))}function A(n,t,r){return t?r?s(t,n):C(t,n):r?m(n):p(n)}"function"==typeof define&&define.amd?define(function(){return A}):"object"==typeof module&&module.exports?module.exports=A:n.md5=A}(this);
//# sourceMappingURL=md5.min.js.map
(function($){
	$.fn.rotate_box = function(){
		var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                            window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
		var	elm = $(this),
			elm_in = $('.inner', this),
			btn = $('.face, .back', elm),
			deg = 0,
			turn = false,
			turn_cls = 'reverse';

		var rotate_anm = function(){
			elm_in.css({
				'transform' : 'rotateY(' + deg * -2 + 'deg)'
			});
		};

		var rotate = function(){
			requestAnimationFrame(function(){
				rotate_anm();
				if( deg == 45 ){
					if( turn === false ){
						elm.addClass(turn_cls);
					} else {
						elm.removeClass(turn_cls);
					}
					deg = 315;
				}
				if( deg <= 45 ){
					deg += 5;
					rotate();
				} else if( deg < 360 && deg > 45 ) {
					deg += 3;
					rotate();
				} else {
					deg = 0;
					elm_in.attr('style', '');
					if( turn === false ){
						turn = true;
					} else {
						turn = false;
					}
				}
			});
		};
		
		rotate();
	};
})(jQuery);


$(document).ready(function(e) {
	//猜卡
	function getGuesscard(){
		layer.open({
			type: 1,
			title:'查询信息',
			zIndex:1003,
			content:$('#wmGuesscardInputBody'),
			btn: ['查询','取消'], //按钮
			btn1 :function(index){
				var info = {
					'type':2,
					'email':$('#wmGuesscardInput').val(),
					'cardID':'',
					'rememberPass':'',
					'password':'',
				}
				wmGetguesscardInfo(index,info);
			}
		});
	}
	var guessBodyIndex = null;//猜卡窗口ID
	function wmGetguesscardInfo(index,info){
		var wmEmail = info.email;
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmEmail === ""){ //输入不能为空
			layer.alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
			layer.alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
			var wmCardBouersepath_ = wmCardPluginpath + 'wm_card_guesscard.php';
			$('#wmCardLoading').stop(true, false).fadeIn(100);
			$.ajax({
				type: 'POST',
				url: wmCardBouersepath_,
				data: info,
				success: function(result){
					console.log(result);
					if(result.code==202){
						if(info.type==2){
							//查询
							$('#wmGuesscardListBody').empty();
							$('#wmGuesscardListBody').removeClass('selected');
							for(var i=0;i<result.data.card.length;i++){
								var html_ = '<div class="wm_card_guesscard_list_box" data-id="'+result.data.card[i]+'"><img src="'+wmCardImgPath+result.data.card[i]+'.jpg" /></div>';
								$('#wmGuesscardListBody').append(html_);
							}
							$('#wm_my_star_guesscard').text(result.star);
							var wmGuesscardBtnName = '';
							var wmguesscardType = result.data.type;
							if(wmguesscardType==0){
								//猜卡日
								$('#wmGuessDayType').text('猜卡日');
								$('#wmGuesscardTip').text('Tip:每次猜卡会消耗10颗星星！');
								wmGuesscardBtnName = '猜卡';
								if(result.myData!=''){
									if(result.myData.time==result.data.time){
										$('#wmGuesscardListBody').addClass('selected');
										for(var j=0;j<result.myData.cardID.length;j++){
											$('.wm_card_guesscard_list_box[data-id='+result.myData.cardID[j]+']').addClass('active');
										}
									}
								}
							}else{
								//兑奖日
								$('#wmGuessDayType').text('兑奖日');
								$('#wmGuesscardTip').text('Tip:本次卡牌抽选结果如下，高亮为您猜中的卡牌！');
								$('#wmGuesscardListBody').addClass('selected');
								wmGuesscardBtnName = '兑换';
								if(result.myData!=''){
									if(result.myData.time==result.data.fromTime){
										$('#wmGuesscardListBody').addClass('selected');
										for(var j=0;j<result.myData.cardID.length;j++){
											$('.wm_card_guesscard_list_box[data-id='+result.myData.cardID[j]+']').addClass('active');
										}
									}
								}
							}
							$('#wmGetPassword').attr('data-email',$('#wmGuesscardInput').val());
							guessBodyIndex = layer.open({
								type: 1,
								title:'星星猜卡',
								maxWidth:'100%',
								zIndex:1003,
								content:$('#wmGuessCardBody'),
								btn: [wmGuesscardBtnName,'说明','关闭'], //按钮
								btn1 :function(index){
									if(wmguesscardType==0){
										if($('#wmGuesscardListBody').hasClass('selected')){
											layer.alert("您已经提交过卡牌，请耐心等待明天的结果吧！");
									　　　　return false;
										}
										if($('.wm_card_guesscard_list_box.active').length!=5){
											layer.alert('请选择5张卡牌！');
											return false;
										}
										layer.open({
											type: 1,
											title:'请输入密码或动态密码',
											maxWidth:'100%',
											zIndex:1005,
											content:$('#wmMailCheckBody'),
											btn: ['确定','取消'], //按钮
											btn1 :function(index_){
												var wmEmail = $('#wmGuesscardInput').val();
												var wmPassword = $('#wmPassword').val();
												var wmRememberPass = 0;
												if($('#wmRememberPass').hasClass('active')){
													wmRememberPass = 1;
												}
												var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
												if(wmEmail === ""){ //输入不能为空
													layer.alert("邮箱地址不能为空");
											　　　　return false;
											　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
													layer.alert("邮箱地址有误!");
											　　　　return false;
											　　}else if(wmPassword==''){
													layer.alert("请输入密码!");
												　　return false;
												}else{
													var guessSeledcard = [];
													for(var k=0;k<$('.wm_card_guesscard_list_box.active').length;k++){
														guessSeledcard.push($('.wm_card_guesscard_list_box.active').eq(k).attr('data-id'));
													}
													guessSeledcard = guessSeledcard.join(',');
													var info_ = {
														'type':0,
														'email':wmEmail,
														'cardID':guessSeledcard,
														'rememberPass':wmRememberPass,
														'password':wmPassword,
													}
													wmGetguesscardInfo(index_,info_);
												}
											}
										});
									}else{
										if($('.wm_card_guesscard_list_box.active').length<=0){
											layer.alert('您并没有猜中任何一张卡牌！请明天再来吧！');
											return false;
										}
										var info = {
											'type':1,
											'email':$('#wmGuesscardInput').val(),
											'cardID':'',
											'rememberPass':'',
											'password':'',
										}
										wmGetguesscardInfo(null,info);
									}
								},
								btn2 :function(index__){
									layer.alert('星星猜卡分为两个阶段，猜卡日与兑奖日。猜卡日每位大佬可以选择5张心仪的卡牌，点击【猜卡】按钮消费10颗星星上传选中的卡牌（每次猜卡日只能猜1次）。兑奖日大佬们可以查看自己所选择的卡牌有没有被系统选中，系统将会自动高亮猜中的卡牌，如果有猜中的卡牌请点击【兑换】按钮换取星星，系统将会根据猜中卡牌的张数发送对应的星星。猜中一张卡牌：1颗星星、猜中两张卡牌：10颗星星、猜中三张卡牌：100颗星星、猜中四张卡牌：2500颗星星、猜中五张卡牌：50万颗星星！');
									return false;
								}
							});
						}else if(info.type==0){
							if($('#wmRememberPass').hasClass('active')){
								wmSetDefaultPassWord($('#wmPassword').val())
							}else{
								wmDelDefaultMaillPassWord();
							}
							$('#wmGuesscardListBody').addClass('selected');
							layer.alert('猜卡信息提交成功！请耐心等待明日的兑奖日！');
							$('#wm_my_star_guesscard').text(result.star);
							getNewCardList();
						}else if(info.type==1){
							layer.alert('您成功兑换了'+result.getStar+'颗星星!');
							$('#wm_my_star_guesscard').text(result.star);
							getNewCardList();
							// if(guessBodyIndex!==null){
							// 	layer.close(guessBodyIndex);
							// }
							// setTimeout(function(){
							// 	var info__ = {
							// 		'type':2,
							// 		'email':$('#wmGuesscardInput').val(),
							// 		'cardID':'',
							// 		'rememberPass':'',
							// 		'password':'',
							// 	}
							// 	wmGetguesscardInfo(null,info__);
							// },200);
						}
						if(index!==null){
							layer.close(index);
						}
					}else if(result.code==306){
						layer.alert('数据已过期，请重新获取！');
						if(index!==null){
							layer.close(index);
						}
						layer.close(guessBodyIndex);
					}else if(result.code==301){
						layer.alert('密码或动态密码不正确！');
					}else if(result.code==302){
						layer.alert('星星不足！');
					}else if(result.code==305||result.code==303){
						layer.alert('数据有误！');
					}else if(result.code==304){
						layer.alert('已参加本期猜卡，不能重复参加！');
					}else if(result.code==404||result.code==405){
						layer.alert('并未参加本次猜卡！');
					}else if(result.code==406){
						layer.alert('您已兑换！');
					}else if(result.code==999){
						layer.alert('您持有的星星已经超过最大值，请先消费掉一些星星吧！');
					}else if(result.code==3){
						layer.alert('无该用户数据，请先抽一张卡牌来创建用户！');
					}else if(result.code==2){
						layer.alert('邮箱有误！');
					}
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				error:function(){
					layer.alert('网络异常！');
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				dataType: 'json'
			});
		}
	}
	$('#wmGuesscardListBody').on('click','.wm_card_guesscard_list_box',function(){
		if($('#wmGuesscardListBody').hasClass('selected')){
			return false;
		}
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}else{
			if($('.wm_card_guesscard_list_box.active').length>=5){
				layer.alert('最多只能选择5张卡牌！');
			}else{
				$(this).addClass('active');
			}
			
		}
	});
	// -----------------------------------------------------------------------------------------------
	//股市
	function wmGetBouerseInfo(index){
		var wmEmail = $('#wmBouerseInput').val();
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmEmail === ""){ //输入不能为空
			layer.alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
			layer.alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
			var wmCardBouersepath_ = wmCardPluginpath + 'wm_card_bouerse.php';
			$('#wmCardLoading').stop(true, false).fadeIn(100);
			$.ajax({
				type: 'POST',
				url: wmCardBouersepath_,
				data: {type:'search',email:wmEmail},
				success: function(result){
					console.log(result);
					if(result.code==202){
						if(index!==null){
							layer.close(index);
						}
						$('#wmBouersTable tbody').empty();
						var wmMybouerse = result.bouerse;
						// if(wmMybouerse!==''){
						// 	wmMybouerse = JSON.parse(wmMybouerse);
						// }
						for(var i=0;i<result.listData.data.length;i++){
							var bouerseZD = result.listData.data[i].price - result.listData.data[i].prePrice;
							var wmbouerseUpDownClass = '';
							if(bouerseZD>0){
								wmbouerseUpDownClass = ' type_up'
							}else if(bouerseZD<0){
								wmbouerseUpDownClass = ' type_down'
							}
							var wmBuyed = '0';
							var wmBouerseHistoryTrans = '';
							if(wmMybouerse!==''){
								wmBuyed = wmMybouerse[i];
								if(wmBuyed==undefined){
									wmBuyed = '0';
								}else{
									wmBouerseHistoryTrans = JSON.stringify(wmMybouerse[i]['exData']);
									wmBuyed = wmBuyed['have'];
								}
							}
							var wmBouerseHistory = JSON.stringify(result.listData.data[i].history);
							var wmBouerseInfo = [result.listData.data[i].price,bouerseZD,result.listData.data[i].trans,wmBuyed].join(',');
							var bouerseHtml = '<tr data-trans="'+wmBouerseHistoryTrans+'" data-info="'+wmBouerseInfo+'" data-history="'+wmBouerseHistory+'" data-name="'+result.listData.data[i].name+'" data-id="'+result.listData.data[i].id+'"><td>'+result.listData.data[i].name+'</td><td>'+result.listData.data[i].price+'</td><td class="'+wmbouerseUpDownClass+'">'+bouerseZD+'</td><td>'+wmBuyed+'</td></tr>';
							$('#wmBouersTable tbody').append(bouerseHtml);
						}
						if(result.news==''){
							$('#bouerseNews').attr('data-news','');
						}else{
							$('#bouerseNews').attr('data-news',JSON.stringify(result.news));
						}
						$('#wm_my_star_bouerse').text(result.starCount);
						if(index!==null){
							layer.open({
								type: 1,
								title:'星星股票交易所',
								maxWidth:'100%',
								zIndex:1003,
								content:$('#wmBouerseBody'),
								btn: ['新闻','刷新','说明','离开'], //按钮
								btn1 :function(index){
									var wmBouerseNews = $('#bouerseNews').attr('data-news');;
									if(wmBouerseNews==''){
										layer.alert('暂无新闻！');
									}else{
										wmBouerseNews = JSON.parse(wmBouerseNews);
										var wmDataNewsHtml = '';
										for(var j=0;j<wmBouerseNews.length;j++){
											wmDataNewsHtml = wmDataNewsHtml+'<li><span>'+capitalize(wmBouerseNews[j]['time']*1000)+' </span>'+wmBouerseNews[j]['text']+'</li>';
											
										}
										wmDataNewsHtml = '<ul class="wm_data_trans_list_ul type_news">' + wmDataNewsHtml + '</ul>';
										layer.open({
											type: 1,
											title:'股市新闻',
											maxWidth:'100%',
											zIndex:1005,
											content:wmDataNewsHtml,
											btn: ['关闭'], //按钮
										});
									}
									return false;
								},
								btn2 :function(index){
									wmGetBouerseInfo(null);
									return false;
								},
								btn3 :function(index){
									layer.alert('股市有风险，入市请谨慎！股票数据会在每个半点更新一次。如果某一只股票股价过低将会被锁定买卖导致无法交易，购买时请慎重挑选！卖出股票的时候将会产生5%且最低20星星的手续费！每只股票最多只能持有9份！如果股价过低将会进入破产重组期。');
									return false;
								}
							});
						}
					}else if(result.code==3){
						layer.alert('无该用户信息，请抽一张卡牌来创建用户！');
					}else if(result.code==2){
						layer.alert('邮箱有误！');
					}else{
						layer.alert('未知错误！');
					}
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				error:function(){
					layer.alert('网络异常！');
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				dataType: 'json'
			});
		}
	};
	function wmPaintChart(name_,data_){
		// 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('wmBouerseChartBox'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: name_
            },
            xAxis: {
				type: 'category'
			},
			yAxis: {
				type: 'value'
			},
			series: [{
				data: data_,
				type: 'line'
			}]
        };

        // 使用刚指定的配置项和数据显示图表。
		myChart.setOption(option);
	};
	function wmBouerseStarCalc(){
		var wmBouerseBuySellInput = Number($('#wmBouerseBuySellInput').val());
		if(isNaN(wmBouerseBuySellInput)){
			$('#bouerseShouldStarCount').text('0');
		}else{
			var bouerseType = $('#wmBouerseBuySellInput').attr('data-type');
			wmBouerseBuySellInput = Math.floor(wmBouerseBuySellInput);
			var wmStarCalcAfter = Math.round(Number($('#wmBouerseChartOneInfo').attr('data-price'))*wmBouerseBuySellInput);
			console.log(bouerseType);
			if(bouerseType=='sell'){
				var bouerseFee = wmStarCalcAfter*0.05;
				if(bouerseFee<20){
					bouerseFee = 20;
				}
				wmStarCalcAfter = wmStarCalcAfter - Math.round(bouerseFee);
			}
			$('#wmBouerseBuySellInput').val(wmBouerseBuySellInput);
			$('#bouerseShouldStarCount').text(wmStarCalcAfter);
		}
	}
	//按钮绑定
	$('#wmBouerseBuySellInput').on('input',function(){
		wmBouerseStarCalc();
	});
	$('#wmBouersTable tbody').on('click','tr',function(){
		var name_ = $(this).attr('data-name');
		var data_ = JSON.parse($(this).attr('data-history'));
		var id_ = $(this).attr('data-id');
		var wmBouerserInfoArr = $(this).attr('data-info').split(',');
		var wmDataTrans = $(this).attr('data-trans');
		// $('#wmBouerseChartOneInfo').text('当前价格：'+data_[data_.length-1]);
		$('#wmBouerseChartOneInfo').attr('data-price',data_[data_.length-1]);
		$('#wmBouerseBuySellInput').attr('data-id',id_);
		$('#wmCardBouerseDetailImgBox').empty().html('<img class="wm_card_bouerse_ico" src="'+wmCardPluginpath+'icon/bouerse/'+id_+'.jpg" />');
		$('#wmBouersInfoTable tbody').empty().html('<tr><th>名称：</th><td>'+name_+'</td></tr><tr><th>价格：</th><td>'+wmBouerserInfoArr[0]+'</td></tr><tr><th>涨跌：</th><td>'+wmBouerserInfoArr[1]+'</td></tr><tr><th>持有：</th><td>'+wmBouerserInfoArr[3]+'</td></tr><tr><th>成交量：</th><td>'+wmBouerserInfoArr[2]+'</td></tr><tr><th>星星：</th><td>'+$('#wm_my_star_bouerse').text()+'</td></tr>')
		layer.open({
			type: 1,
			title:name_,
			maxWidth:'100%',
			zIndex:1004,
			content:$('#wmBouerseChartBody'),
			btn: ['历史','买入','卖出','关闭'], //按钮
			btn1 :function(index){
				if(wmDataTrans==''){
					layer.alert('暂无历史记录！');
				}else{
					var wmDataTransObj = JSON.parse(wmDataTrans);
					var wmDataTransHtml = '';
					for(var j=0;j<wmDataTransObj.length;j++){
						var wmDataTransJ = wmDataTransObj.length - 1 - j;
						if(wmDataTransObj[wmDataTransJ][4]){
							wmDataTransHtml = wmDataTransHtml+'<li class="type_sell"><span>'+capitalize(wmDataTransObj[wmDataTransJ][0]*1000)+' </span>以单价 '+wmDataTransObj[wmDataTransJ][1]+' 抛售了 '+wmDataTransObj[wmDataTransJ][2]+' 份该股票，共获得了 '+wmDataTransObj[wmDataTransJ][3]+' 颗星星</li>';
						}else{
							wmDataTransHtml = wmDataTransHtml+'<li><span>'+capitalize(wmDataTransObj[wmDataTransJ][0]*1000)+' </span>以单价 '+wmDataTransObj[wmDataTransJ][1]+' 购买了 '+wmDataTransObj[wmDataTransJ][2]+' 份该股票，共花费了 '+wmDataTransObj[wmDataTransJ][3]+' 颗星星</li>';
						}
						
					}
					wmDataTransHtml = '<ul class="wm_data_trans_list_ul">' + wmDataTransHtml + '</ul>';
					console.log(wmDataTransHtml);
					layer.open({
						type: 1,
						title:'历史记录',
						maxWidth:'100%',
						zIndex:1005,
						content:wmDataTransHtml,
						btn: ['关闭'], //按钮
					});
				}
				
			},
			btn2 :function(index){
				var wmBouersePrice = Number(wmBouerserInfoArr[0]);
				var wmBouerseMyStar = Number($('#wm_my_star_bouerse').text());
				if(wmBouersePrice<=10){
					layer.alert('抱歉，该股由于价格过低暂时被禁止买卖！');
					return false;
				}
				$('#wmBouserseSellTips').hide();
				wmBouerseGoTrans('buy',index,wmBouersePrice,wmBouerseMyStar,Number(wmBouerserInfoArr[3]));
				return false;
			},
			btn3 :function(index){
				var wmBouersePrice = Number(wmBouerserInfoArr[0]);
				var wmBouerseMyStar = Number($('#wm_my_star_bouerse').text());
				if(wmBouersePrice<=10){
					layer.alert('抱歉，该股由于价格过低暂时被禁止买卖！');
					return false;
				}
				$('#wmBouserseSellTips').show();
				wmBouerseGoTrans('sell',index,wmBouersePrice,wmBouerseMyStar,Number(wmBouerserInfoArr[3]));
				return false;
			}
		});
		wmPaintChart(name_,data_);
	});
	function wmBouerseGoTrans(type_,windowId,price,myStar,have){
		$('#wmBouerseBuySellInput').attr('data-type',type_);
		$('#wmBouerseBuySellInput').val('');
		$('#bouerseShouldStarCount').text('0');
		var wmType = $('#wmBouerseBuySellInput').attr('data-type');
		layer.open({
			type: 1,
			title:'请输入份数',
			zIndex:1005,
			content:$('#wmBouerseBuySellInputBody'),
			btn: ['确定','最大','取消'], //按钮
			btn2 :function(index){
				if(wmType=='buy'){
					var wmBouerseCanBuy = Math.floor(myStar/price);
					if(wmBouerseCanBuy+have>9){
						wmBouerseCanBuy = Math.floor(9-have);
					}
					if(wmBouerseCanBuy<0){
						wmBouerseCanBuy = 0;
					}
					$('#wmBouerseBuySellInput').val(wmBouerseCanBuy);
					wmBouerseStarCalc();
				}else{
					var wmBouerseCanBuy = have;
					$('#wmBouerseBuySellInput').val(wmBouerseCanBuy);
					wmBouerseStarCalc();
				}
				return false;
			},
			btn1 :function(index){
				var wmBouerseVal = Math.floor($('#wmBouerseBuySellInput').val());
				if(isNaN(wmBouerseVal)||wmBouerseVal==0){
					layer.alert('请输入0以上的数字！');
				}else{
					$('#wmBouerseBuySellInput').val(wmBouerseVal);
					if(wmType=='buy'){
						if(Number($('#bouerseShouldStarCount').text())>myStar){
							layer.alert('星星不足，如果您确定持有这么多星星的话请返回上一级刷新数据！');
							return false;
						}
						if(wmBouerseVal+have>9){
							layer.alert('每只股票最多只能持有9份！');
							return false;
						}
					}else{
						if(have<Number($('#wmBouerseBuySellInput').val())){
							layer.alert('您并没有这么多股份！');
							return false;
						}
						if(Number($('#bouerseShouldStarCount').text())<=0){
							layer.alert('卖出不够手续费！');
							return false;
						}
						
					}
					$('#wmGetPassword').attr('data-email',$('#wmBouerseInput').val());
					var inputValueWindow = index;
					layer.open({
						type: 1,
						title:'请输入密码或动态密码',
						maxWidth:'100%',
						zIndex:1005,
						content:$('#wmMailCheckBody'),
						btn: ['确定','取消'], //按钮
						btn1 :function(index){
							var wmEmail = $('#wmBouerseInput').val();
							var wmPassword = $('#wmPassword').val();
							var wmTransId = $('#wmBouerseBuySellInput').attr('data-id');
							var wmPrice = $('#wmBouerseChartOneInfo').attr('data-price');
							var wmValue = $('#wmBouerseBuySellInput').val();
							var wmRememberPass = 0;
							if($('#wmRememberPass').hasClass('active')){
								wmRememberPass = 1;
							}
							var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
							if(wmEmail === ""){ //输入不能为空
								layer.alert("邮箱地址不能为空");
						　　　　return false;
						　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
								layer.alert("邮箱地址有误!");
						　　　　return false;
						　　}else if(wmPassword==''){
								layer.alert("请输入密码!");
							　　return false;
							}else{
								var wmCardStarpath_ = wmCardPluginpath + 'wm_card_bouerse.php';
								$('#wmCardLoading').stop(true, false).fadeIn(100);
								var wmRememberPass = 0;
								if($('#wmRememberPass').hasClass('active')){
									wmRememberPass = 1;
								}
								$.ajax({
									type: 'POST',
									url: wmCardStarpath_,
									data: {type:wmType,email:wmEmail,id:wmTransId,price:wmPrice,value:wmValue,password:wmPassword,rememberPass:wmRememberPass},
									success: function(result){
										if(result.code==202){
											if($('#wmRememberPass').hasClass('active')){
												wmSetDefaultPassWord(wmPassword)
											}else{
												wmDelDefaultMaillPassWord();
											}
											layer.alert('交易成功！');
											layer.close(index);
											layer.close(windowId);
											layer.close(inputValueWindow);
											wmGetBouerseInfo(null);
											getNewCardList();
										}else if(result.code==3){
											layer.alert('无该用户信息，请抽一张卡牌来创建用户！');
										}else if(result.code==2){
											layer.alert('邮箱有误！');
										}else if(result.code==301){
											layer.alert('密码有误或者已经过期！');
										}else if(result.code==4){
											layer.alert('无该股票信息或者已经破产！');
											layer.close(index);
											layer.close(windowId);
											layer.close(inputValueWindow);
											wmGetBouerseInfo(null);
										}else if(result.code==5){
											layer.alert('抱歉，该股由于价格过低暂时被禁止买卖！');
										}else if(result.code==6){
											layer.alert('价格已经发生波动，请重新尝试！');
											layer.close(index);
											layer.close(windowId);
											layer.close(inputValueWindow);
											wmGetBouerseInfo(null);
										}else if(result.code==7){
											layer.alert('购入数量有误！');
										}else if(result.code==8){
											layer.alert('持有的星星不足');
										}else if(result.code==9){
											if(wmType=='buy'){
												layer.alert('已经超过该股票的持有上限！');
											}else{
												layer.alert('好像没有持有这么多股！');
											}
										}else if(result.code==10){
											layer.alert('手续费不足！');
										}else{
											layer.alert('未知错误！');
										}
										console.log(result);
										$('#wmCardLoading').stop(true, false).fadeOut(100);
									},
									error:function(){
										layer.alert('网络异常！');
										$('#wmCardLoading').stop(true, false).fadeOut(100);
									},
									dataType: 'json'
								});
							}
						}
					});
				}
			}
		});
	}
	$('#wmRememberEmail').on('click',function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}else{
			$(this).addClass('active');
		}
	});
	$('#wmRememberPass').on('click',function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
		}else{
			$(this).addClass('active');
		}
	});
	// 设置默认密码
	function wmSetDefaultPassWord(passWord){
		$('#wmPassword').val(passWord);
		localStorage.setItem("wmSetDefaultMaillPassWord", passWord);
		$('#wmRememberPass').addClass('active');
	};
	function wmDelDefaultMaillPassWord(){
		localStorage.removeItem("wmSetDefaultMaillPassWord");
	}
	function wmSetStoragePassWord(){
		var wmStorangePassWord = localStorage.getItem("wmSetDefaultMaillPassWord");
		if(wmStorangePassWord!=null&&wmStorangePassWord!=undefined&&wmStorangePassWord!=''){
			wmSetDefaultPassWord(wmStorangePassWord);
		}
	}
	//设置默认邮箱地址
	function wmSetDefaultMaillAddress(mailAddr){
		$('#wm_card_email').val(mailAddr);
		$('#wmDeminingInput').val(mailAddr);
		$('#wmStarSearchInput').val(mailAddr);
		$('#wmCardMixInput').val(mailAddr);
		$('#wm_tiaozhan_email').val(mailAddr);
		$('#wmBouerseInput').val(mailAddr);
		$('#wmGuesscardInput').val(mailAddr);
		localStorage.setItem("wmSetDefaultMaillAddress", mailAddr);
		$('#wmRememberEmail').addClass('active');
	}
	function wmDelDefaultMaillAddress(){
		$('#wmDeminingInput').val('');
		$('#wmStarSearchInput').val('');
		$('#wmCardMixInput').val('');
		$('#wm_tiaozhan_email').val('');
		$('#wmBouerseInput').val('');
		$('#wmGuesscardInput').val('');
		localStorage.removeItem("wmSetDefaultMaillAddress");
	}
	function wmSetsessionStorageMail(){
		var wmSetsessionStorageMailCache = localStorage.getItem("wmSetDefaultMaillAddress");
		if(wmSetsessionStorageMailCache!=null&&wmSetsessionStorageMailCache!=undefined&&wmSetsessionStorageMailCache!=''){
			wmSetDefaultMaillAddress(wmSetsessionStorageMailCache);
		}
	}
	// 判断是否有缓存地址
	wmSetsessionStorageMail();
	// 判断是否保存密码
	wmSetStoragePassWord();
	// 挖星星
	function getwmStarDemMap(){

		var wmCardStarpath_ = wmCardPluginpath + 'wm_game_demining.php';
		$('#wmCardLoading').stop(true, false).fadeIn(100);
		$.ajax({
			type: 'GET',
			url: wmCardStarpath_,
			success: function(result){
				console.log(result);
				setwmStarDemMap(result);
				layer.open({
					type: 1,
					title:'星星矿场',
					maxWidth:'100%',
					zIndex:1003,
					content:$('#wmDeminingBody'),
					btn: ['离开'], //按钮
					}
				);
				$('#wmCardLoading').stop(true, false).fadeOut(100);
			},
			error:function(){
				layer.alert('网络异常！');
				$('#wmCardLoading').stop(true, false).fadeOut(100);
			},
			dataType: 'json'
		});
	};
	function setwmStarDemMap(result){
		$('#wmDeminingBody table tbody').empty();
		var wmSearDemMapWidth = Math.floor(10/result.cols*50);
		for(var i =0;i<result.rows;i++){
			$('#wmDeminingBody table tbody').append('<tr></tr>');
			for(var j =0;j<result.cols;j++){
				var wmDemItemInfo = result.map['data'+i+'_'+j];
				if(wmDemItemInfo == undefined){
					$('#wmDeminingBody table tbody tr').eq(i).append('<td><div style="width:'+wmSearDemMapWidth+'px;height:'+wmSearDemMapWidth+'px;line-height:'+wmSearDemMapWidth+'px;background-image: url('+wmCardPluginpath+'icon/demining/bg'+result.mapType+'.png'+');" class="wm_demining_item" data-info="'+i+'_'+j+'" data-xy="'+i+'_'+j+'"></div></td>');
				}else{
					var wmDemIsStarClass = '';
					if(wmDemItemInfo == 100){
						wmDemItemInfo = '★';
						wmDemIsStarClass = ' is_wmdmstar';
					}
					$('#wmDeminingBody table tbody tr').eq(i).append('<td><div style="width:'+wmSearDemMapWidth+'px;height:'+wmSearDemMapWidth+'px;line-height:'+wmSearDemMapWidth+'px;background-image: url('+wmCardPluginpath+'icon/demining/bg'+result.mapType+'.png'+');" class="wm_demining_item type_is_opened'+wmDemIsStarClass+'" data-info="opened" data-xy="'+i+'_'+j+'">'+wmDemItemInfo+'</div></td>');
				}
			}
		}
		for(var k=0;k<result.player.length;k++){
			var wmEemXY = result.player[k].xy;
			var wmEMHTML = '<img class="wm_demining_img" src="https://cdn.v2ex.com/gravatar/'+result.player[k].emailMD5+'?s=100&d=mm&r=g&d=robohash" width="50" height="50" />';
			$('.wm_demining_item[data-xy="'+wmEemXY+'"]').append(wmEMHTML);
		}
	}
	$('#wmDeminingBody table').on('click','.wm_demining_item',function(){
		var wmDMinfo = $(this).attr('data-info');
		var wmEmail = $('#wmDeminingInput').val();
		if(wmDMinfo!=='opened'){
			if($(this).hasClass('selected')){
				var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
				if(wmEmail === ""){ //输入不能为空
					layer.alert("邮箱地址不能为空");
			　　　　return false;
			　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
					layer.alert("邮箱地址有误!");
			　　　　return false;
			　　}else{
					function getPasswordAndDem(ticket,randstr){
						console.log($('#clicaptcha-submit-info').val());
						var captcha = $('#clicaptcha-submit-info').val();
						var wmCardStarpath_ = wmCardPluginpath + 'wm_game_demining.php';
						var wmPassword = $('#wmPassword').val();
						$('#wmCardLoading').stop(true, false).fadeIn(100);
						$.ajax({
							type: 'POST',
							url: wmCardStarpath_,
							data: {type:'open',node:wmDMinfo,email:wmEmail,password:wmPassword,Ticket:ticket,Randstr:randstr},
							success: function(result){
								if(result.code == 202){
									if(result.boom==0){
										var wmDemTipText = '';
										if(result.clickNum>0){
											wmDemTipText = '不过根据探测器显示，您的周围可能存在'+result.clickNum+'片星星矿！'
										}else{
											wmDemTipText = '根据探测器显示，周围什么都没有……'
										}
										layer.alert('很可惜什么都没有挖到！'+wmDemTipText+'请2小时后再来尝试吧！');
									}else{
										var lastText = '';
										if(result.lastBoom==1){
											lastText = '另外数据显示这已经是最后一片星矿了！新的矿场已经为您准备，同时您获得了额外1次挖掘机会！！';
										}
										layer.alert('感觉地底在发光，挖开一看，发现了'+result.getStar+'颗星星！'+lastText);
									}
									getNewCardList();
									setwmStarDemMap(result);
									var wmNowTime = result.timeStamp * 1000;
									localStorage.setItem("demining" + md5(wmEmail),wmNowTime);
								}else if(result.code == 2){
									layer.alert('邮箱地址有误！');
								}else if(result.code == 3){
									layer.alert('无该用户信息，请抽一张卡牌来创建用户！');
								}else if(result.code == 203){
									var wmNextTime = result.deminingStamp+7200;
									var wmNextTimeDate = new Date(wmNextTime * 1000);    //根据时间戳生成的时间对象
									var wmNextTimeText = (wmNextTimeDate.getFullYear()) + "年" + 
											(wmNextTimeDate.getMonth() + 1) + "月" +
											(wmNextTimeDate.getDate()) + "日" + 
											(wmNextTimeDate.getHours()) + "点" + 
											(wmNextTimeDate.getMinutes()) + "分" + 
											(wmNextTimeDate.getSeconds()) + "秒";
									layer.alert('感觉身体被掏空，会在 '+wmNextTimeText+' 后恢复！请在这个点后再来！');
									localStorage.setItem("demining" + md5(wmEmail),result.deminingStamp*1000);
								}else if(result.code == 0){
									layer.alert('传入的信息有误，不要搞事情喔！');
								}else if(result.code == 403){
									layer.alert('验证失败！请刷新页面后尝试！');
								}else if(result.code == 101){
									layer.alert('这片矿区可能已经被人抢先了！重新选择矿区吧！');
									setwmStarDemMap(result);
								}
								$('#wmCardLoading').stop(true, false).fadeOut(100);
							},
							error:function(){
								$('#wmCardLoading').stop(true, false).fadeOut(100);
								layer.alert('网络异常！');
							},
							dataType: 'json'
						});
					}
					function wmDeminingCaptchaFcuntion(){
						if(wmDeminingCaptcha=='1'){
							function TencentCaptchaCallback(res){
								console.log(res)
								// res（未通过验证）= {ret: 1, ticket: null}
								// res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
								if(res.ret === 0){
									getPasswordAndDem(res.ticket,res.randstr);
								}else{
									layer.alert('验证失败！');
								}
							}
							var TencentCaptchaShow = new TencentCaptcha(wmDeminingCaptchaAppId, TencentCaptchaCallback);
							TencentCaptchaShow.show();
							// $('#clicaptcha-submit-info').clicaptcha({
							// 	src: wmCardPluginpath + 'clicaptcha/clicaptcha.php',
							// 	success_tip: '验证成功！',
							// 	error_tip: '未点中正确区域，请重试！',
							// 	callback: function(){
							// 		getPasswordAndDem();
							// 	}
							// });
						}else{
							getPasswordAndDem();
						}
					}
					var deminingTime = Number(localStorage.getItem("demining" + md5(wmEmail)));
					if(deminingTime == null){
						wmDeminingCaptchaFcuntion();
					}else{
						var wmNowTime = new Date().getTime();
						if(wmNowTime - deminingTime <7200*1000){
							var wmNextTime = Math.floor(deminingTime/1000+7200);
							var wmNextTimeDate = new Date(wmNextTime * 1000);    //根据时间戳生成的时间对象
							var wmNextTimeText = (wmNextTimeDate.getFullYear()) + "年" + 
									(wmNextTimeDate.getMonth() + 1) + "月" +
									(wmNextTimeDate.getDate()) + "日" + 
									(wmNextTimeDate.getHours()) + "点" + 
									(wmNextTimeDate.getMinutes()) + "分" + 
									(wmNextTimeDate.getSeconds()) + "秒";
							layer.confirm('您的星星矿场可能还在冷却期内，预计在'+wmNextTimeText+'解除，要尝试继续吗？', {
								zIndex:1002,
								btn: ['继续','不了'] //按钮
								}, function(index){
									layer.close(index);
									wmDeminingCaptchaFcuntion();
								}, function(){
									
								}
							);
						}else{
							wmDeminingCaptchaFcuntion();
						}

					}
				}
			}else{
				$('#wmDeminingBody table .wm_demining_item.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		}
	});
	// 查询排行榜
	function searchWmRank(){
		var wmCardStarpath_ = wmCardPluginpath + 'wm_card_rank.php';
		$.ajax({
			type: 'GET',
			url: wmCardStarpath_,
			success: function(result){
				console.log(result);
				if(result.card.length==10){
					var time = new Date(result.updataTime*1000);
					var y = time.getFullYear();
					var m = time.getMonth()+1;
					var d = time.getDate();
					var h = time.getHours();
					$('.wm_card_rank_last_time').text(y+'年'+m+'月'+d+'日 '+h+'时');
					var html_ = '';
					for(var i=0;i<result.score.length;i++){
						var rank_ = i+1;
						if(rank_ == 1){
							rank_ = '1st';
						}else if(rank_ == 2){
							rank_ = '2nd';
						}else if(rank_ == 3){
							rank_ = '3rd';
						}else{
							rank_ = rank_ + 'th';
						}
						html_ = '<div class="clearfix wm_card_rank_box" title="查看TA的卡牌"><div class="fl wm_card_rank_text">'+rank_+'</div><div class="fl wm_card_rank_img"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+result.score[i].email+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45" data-md5="'+result.score[i].email+'"></div><div class="fr wm_card_rank_point">'+result.score[i].score+'点</div></div>';
						if(i<=4){
							$('#wmScoreRankBox .wm_card_rank_list').append(html_);
						}else{
							$('#wmScoreRankBox .wm_card_rank_list .wm_card_rank_box').eq((i-5)*2).after(html_);
						}
					}
					html_ = '';
					for(var i=0;i<result.level.length;i++){
						var rank_ = i+1;
						if(rank_ == 1){
							rank_ = '1st';
						}else if(rank_ == 2){
							rank_ = '2nd';
						}else if(rank_ == 3){
							rank_ = '3rd';
						}else{
							rank_ = rank_ + 'th';
						}
						html_ = '<div class="clearfix wm_card_rank_box" title="查看TA的卡牌"><div class="fl wm_card_rank_text">'+rank_+'</div><div class="fl wm_card_rank_img"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+result.level[i].email+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45" data-md5="'+result.level[i].email+'"></div><div class="fr wm_card_rank_point">'+result.level[i].level+'级</div></div>';
						if(i<=4){
							$('#wmLevelRankBox .wm_card_rank_list').append(html_);
						}else{
							$('#wmLevelRankBox .wm_card_rank_list .wm_card_rank_box').eq((i-5)*2).after(html_);
						}
					}
					for(var i=0;i<result.card.length;i++){
						var rank_ = i+1;
						var cardCount = result.card[i].cardID.split(',').length;
						if(rank_ == 1){
							rank_ = '1st';
						}else if(rank_ == 2){
							rank_ = '2nd';
						}else if(rank_ == 3){
							rank_ = '3rd';
						}else{
							rank_ = rank_ + 'th';
						}
						html_ = '<div class="clearfix wm_card_rank_box" title="查看TA的卡牌"><div class="fl wm_card_rank_text">'+rank_+'</div><div class="fl wm_card_rank_img"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+result.card[i].email+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45" data-md5="'+result.card[i].email+'"></div><div class="fr wm_card_rank_point">'+cardCount+'种卡牌</div></div>';
						if(i<=4){
							$('#wmCardRankBox .wm_card_rank_list').append(html_);
						}else{
							$('#wmCardRankBox .wm_card_rank_list .wm_card_rank_box').eq((i-5)*2).after(html_);
						}
					}
					for(var i=0;i<result.deminingStarCount.length;i++){
						var rank_ = i+1;
						if(rank_ == 1){
							rank_ = '1st';
						}else if(rank_ == 2){
							rank_ = '2nd';
						}else if(rank_ == 3){
							rank_ = '3rd';
						}else{
							rank_ = rank_ + 'th';
						}
						html_ = '<div class="clearfix wm_card_rank_box" title="查看TA的卡牌"><div class="fl wm_card_rank_text">'+rank_+'</div><div class="fl wm_card_rank_img"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+result.deminingStarCount[i].email+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45" data-md5="'+result.deminingStarCount[i].email+'"></div><div class="fr wm_card_rank_point">'+result.deminingStarCount[i].deminingStarCount+'颗星星</div></div>';
						if(i<=4){
							$('#wmDeminingRankBox .wm_card_rank_list').append(html_);
						}else{
							$('#wmDeminingRankBox .wm_card_rank_list .wm_card_rank_box').eq((i-5)*2).after(html_);
						}
					}
					$('#wmCardRankBody').fadeIn(300,function(){
						var rankSwiper = new Swiper ('#wmCardRankBody .swiper-container', {
							direction: 'horizontal',
							loop: true,
							autoplay : 10000,
							mousewheelControl : true,
							autoplayDisableOnInteraction : false,
							paginationClickable :true,	
							// 如果需要分页器
							pagination: '.swiper-pagination',
						});
					});
				}
			},
			error:function(){
				layer.alert('网络异常！');
			},
			dataType: 'json'
		});
	}
	searchWmRank();
	$('#wmCardRankBody').on('click','.wm_card_rank_box',function(){
		var wmEmail_ = $(this).find('.wm_card_get_list_avatar_pic').attr('data-md5');
		$('#wm_tiaozhan_btn').attr('data-md5',wmEmail_);
		wmsearchCard(wmEmail_,false,true);
		$('html, body').animate({scrollTop: $('#wmGetCard').offset().top+200}, 300);
	});
	//幻灯片
	var mySwiper = new Swiper ('.wm_banner_body .swiper-container', {
		direction: 'horizontal',
		loop: true,
		mousewheelControl : true,
		autoplay : 5000,
		autoplayDisableOnInteraction : false,
		paginationClickable :true,	
		// 如果需要分页器
		pagination: '.swiper-pagination',
	});
	//查询星星方法
	function searchStar(windowIndex,starShopOpen){
		var wmStarSearchInput = $('#wmStarSearchInput').val();
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmStarSearchInput === ""){ //输入不能为空
	　　　　layer.alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmStarSearchInput)){ //正则验证不通过，格式不对
	　　　　layer.alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
			var starEmailmd5_ = md5(wmStarSearchInput);
			var wmCardStarpath_ = wmCardPluginpath + 'wm_search_star.php';
			$('#wmCardLoading').stop(true, false).fadeIn(100);
			$.ajax({
				type: 'POST',
				url: wmCardStarpath_,
				data: {email:starEmailmd5_},
				success: function(result){
					if(result.code=="202"){
						$('#wm_my_star').empty();
						$('#wm_my_star').attr('data-star',result.star);
						$('#wm_my_star').attr('data-mail',wmStarSearchInput);
						$('#wm_my_star').text(result.star);
						if(windowIndex||windowIndex==0){
							layer.close(windowIndex);
						}
						if(starShopOpen){
							layer.open({
								type:1,
								maxWidth:'100%',
								btn: [],
								title: '星星商店',
								zIndex:1001,
								content:$('#starshopBody')
							}, function(value, index, elem){});
						}
					}else if(result.code=="1"){
						layer.alert('无该用户数据，请先抽一张卡牌来创建用户！');
					}else if(result.code=="0"){
						layer.alert('邮箱地址有误！');
					}
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				error:function(){
					layer.alert('网络异常！');
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				dataType: 'json'
			});	
		}
	};
	//查询星星弹窗
	function openStarSearchWindow(starShopIsOpen){
		var starShopIsOpen = starShopIsOpen;
		layer.open({
			type: 1,
			title:'查询星星',
			zIndex:1003,
			content:$('#wmStarSearchInputBody'),
			btn: ['查询','取消'], //按钮
			btn1 :function(index){
				searchStar(index,starShopIsOpen);
			}
		});
	}
	//获取动态密码
	$('#wmGetPassword').on('click',function(){
		var wmStarSearchInput = $('#wmGetPassword').attr('data-email');
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmStarSearchInput === ""){ //输入不能为空
			layer.alert('邮箱地址不能为空');
	　　　　return false;
	　　}else if(!reg.test(wmStarSearchInput)){ //正则验证不通过，格式不对
			layer.alert('邮箱地址有误');
	　　　　return false;
	　　}else{
			var wmCardStarpath_ = wmCardPluginpath + 'wm_card_email_send.php';
			$('#wmCardLoading').stop(true, false).fadeIn(100);
			$('#wmGetPassword').attr('disabled','true');
			var wmEmailCoolDownTime = 60;
			function wmEmailTimer(){
				setTimeout(function(){
					if(wmEmailCoolDownTime===0){
						$('#wmGetPassword').text('获取');
						$('#wmGetPassword').removeAttr('disabled');
						wmEmailCoolDownTime = 60;
					}else{
						$('#wmGetPassword').text(wmEmailCoolDownTime);
						wmEmailCoolDownTime = wmEmailCoolDownTime-1;
						wmEmailTimer();
					}
				},1000)
			}
			wmEmailTimer();
			$.ajax({
				type: 'POST',
				url: wmCardStarpath_,
				data: {email:wmStarSearchInput},
				success: function(result){
					if(result.code=="1"){
						layer.alert('动态密码已经成功发送到邮箱！如果长时间没有收到请检查是否进入了垃圾邮件中。');
					}else if(result.code=="0"){
						layer.alert('邮件发送失败！');
					}else if(result.code=="2"){
						layer.alert('邮箱地址有误！');
						$('#wmGetPassword').removeAttr('disabled');
					}else if(result.code=="3"){
						layer.alert('无该用户数据，请先抽一张卡牌来创建用户！');
						$('#wmGetPassword').removeAttr('disabled');
					}else if(result.code=="4"){
						layer.alert('该邮箱超过发送次数或者发送过于频繁！');
					}
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				error:function(){
					layer.alert('网络异常！');
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				dataType: 'json'
			});	
		}
	});
	// 重置
	$('.wm_starshop_rebuy_body').on('click',function(){
		event.stopPropagation();
	});
	$('#wmStarshopBody .wm_rebuy_btn').on('click',function(){
		var this_ = $(this);
		this_.parents('.wm_starshop_card_list_item').addClass('animated fadeOutDown');
		this_.parents('.wm_starshop_card_list_item').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			this_.parents('.selectcard').attr('class','card selectcard');
			this_.parents('.wm_starshop_card_list_item').removeClass('fadeOutDown').addClass('fadeInDown');
			this_.parents('.wm_starshop_card_list_item').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
				this_.parents('.wm_starshop_card_list_item').removeClass('fadeInDown').removeClass('animated');
			});
		});
	});
	// 连抽点击结果
	$('#wmCardChainChoiseList').on('click','.selectcard',function(){
		if(!$(this).hasClass('selectedcard')){
			$(this).rotate_box();
			$(this).addClass('selectedcard');
		}
	});
	//星星抽卡
	$('#wmStarshopBody').on('click','.selectcard',function(){
		var this_ = $(this);
		console.log(this_);
		var myStar = parseInt($('#wm_my_star').attr('data-star'));
		var wmPrice = parseInt(this_.attr('data-price'));
		if(isNaN(myStar)||isNaN(wmPrice)){
			layer.alert('数据有误');
			return false;
		}else{
			if(myStar<wmPrice){
				layer.confirm('星星不足，如果您确定有足够的星星请重新查询星星。', {
					zIndex:1002,
					btn: ['查询','返回'] //按钮
					}, function(index){
						layer.close(index);
						openStarSearchWindow(false);
					}, function(){
						
					}
				);
				return false;
			}
		}
		if(!this_.hasClass('selectedcard')){
			layer.confirm('您确定要使用星星吗？', {
				zIndex:1002,
				btn: ['使用','不了'] //按钮
				}, function(index){
					$('#wmGetPassword').attr('data-email',$('#wm_my_star').attr('data-mail'));
					layer.open({
						type: 1,
						title:'请输入密码或动态密码',
						zIndex:1003,
						content:$('#wmMailCheckBody'),
						btn: ['确定','取消'], //按钮
						btn1 :function(index){
							var embuyemail = $('#wm_my_star').attr('data-mail');
							var empassword = $('#wmPassword').val();
							var emBuyType = this_.attr('data-type');
							var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
							if(embuyemail === ""){ //输入不能为空
								layer.alert("邮箱地址不能为空");
						　　　　return false;
						　　}else if(!reg.test(embuyemail)){ //正则验证不通过，格式不对
								layer.alert("邮箱地址有误!");
						　　　　return false;
						　　}else if(empassword==''){
								layer.alert("请输入密码!");
							　　return false;
							}else{
								var wmCardStarpath_ = wmCardPluginpath + 'wm_card_buy.php';
								$('#wmCardLoading').stop(true, false).fadeIn(100);
								var wmRememberPass = 0;
								if($('#wmRememberPass').hasClass('active')){
									wmRememberPass = 1;
								}
								$.ajax({
									type: 'POST',
									url: wmCardStarpath_,
									data: {email:embuyemail,password:empassword,type:emBuyType,rememberPass:wmRememberPass},
									success: function(result){
										$('#wmCardLoading').stop(true, false).fadeOut(100);
										if(result.code=="202"){
											if($('#wmRememberPass').hasClass('active')){
												wmSetDefaultPassWord(empassword)
											}else{
												wmDelDefaultMaillPassWord();
											}
											if(result.buyClass == 2){
												$('#wmCardChainChoiseList').empty();
												for(var i=0;i<result.card.length;i++){
													var cardHtml = '<div class="card selectcard" data-type="3" data-price="30"><div class="inner"><div class="face"><img src="'+wmCardImgPath+result.card[i]+'.jpg" alt="" class="wm_card_img"></div><div class="back"></div></div></div>';
													$('#wmCardChainChoiseList').append(cardHtml);
												}
												layer.open({
													type: 1,
													title:'查看卡牌',
													zIndex:1004,
													maxWidth:'100%',
													content:$('#wmCardChainChoiseBody'),
													btn: ['全部翻开','关闭'], //按钮
													btn1 :function(index){
														$('#wmCardChainChoiseList .selectcard').trigger('click');
													},
													btn2 :function(){
														if($('#wm_card_email').val()==$('#wm_my_star').attr('data-mail')){
															wmsearchCard(md5(embuyemail));
														}
														getNewCardList();
													},
													cancel: function(){ 
														if($('#wm_card_email').val()==$('#wm_my_star').attr('data-mail')){
															wmsearchCard(md5(embuyemail));
														}
														getNewCardList();
													}
												});
											}else{
												var cardId = result.card;
												var imgSrc = wmCardImgPath+ cardId+'.jpg';
												this_.find('.wm_card_img').attr('src',imgSrc);
												this_.addClass('selectedcard');
												setTimeout(function(){
													this_.rotate_box();
												},200);
												if($('#wm_card_email').val()==$('#wm_my_star').attr('data-mail')){
													wmsearchCard(md5(embuyemail));
												}
												getNewCardList();
											}
											$('#wm_my_star').empty();
											$('#wm_my_star').attr('data-star',result.starCountAfter);
											$('#wm_my_star').text(result.starCountAfter);
											layer.close(index);
										}else if(result.code=="0"){
											layer.alert('邮箱地址为空！');
											return false;
										}else if(result.code=="1"){
											layer.alert('邮箱地址有误！');
											return false;
										}else if(result.code=="6"){
											layer.alert('无该用户数据，请先抽一张卡牌来创建用户！');
											return false;
										}else if(result.code=="301"){
											layer.alert('密码有误或已经过期！');
											return false;
										}else if(result.code=="4"){
											layer.alert('该物品不存在！');
											return false;
										}else if(result.code=="5"){
											layer.alert('星星不够！');
											return false;
										}else{
											layer.alert('未知错误！');
											return false;
										}
									},
									error:function(){
										layer.alert('网络异常！');
										$('#wmCardLoading').stop(true, false).fadeOut(100);
									},
									dataType: 'json'
								});	
							}
						}
					});
					layer.close(index);
	
				}, function(){
					
				}
			);
		}
	});
	$('#wmBannerBody').on('click','.swiper-slide',function(){
		var bannerType = $(this).attr('data-type');
		console.log(bannerType);
		if(bannerType == 'starShop'){
			openStarSearchWindow(true);
		}else if(bannerType=="donate"){
			var bannerAddress = $(this).attr('data-address');
			layer.confirm('感谢您赞助本站', {
				btn: ['赞助','取消'] //按钮
			  }, function(){
				window.location.href=bannerAddress;
			  }
			);
		}else if(bannerType=="cardMix"){
			openCardMixWindow();
		}else if(bannerType=="starDemining"){
			getwmStarDemMap();
		}else if(bannerType=="bouerse"){
			getwmBouerse();
		}else if(bannerType=="guesscard"){
			getGuesscard();
		}
	});
	//分解列表页面生成
	var wmcardMixAllInfoArr = [];
	var wmcardDatabase = null;
	var wmcardMixNowLength = 0;//已经展示了多少
	var wmcardMixPage = 20;//一页显示几个
	var wmcardMixWindowIndex = null;
	function wmCardMixList(cardID,cardCount,alertWindowIndex,showModWindow){
		wmcardMixAllInfoArr = [];
		wmcardDatabase = null;
		wmcardMixNowLength = 0;//已经展示了多少
		wmcardMixPage = 20;//一页显示几个
		var wmcardarr = cardID.split(",");
		var wmcardCountarr = cardCount.split(",");
		for(var i=0;i<wmcardarr.length;i++){
			var thisCardCount = wmcardCountarr[i]-1;
			for(var j=0;j<thisCardCount;j++){
				wmcardMixAllInfoArr.push(wmcardarr[i]);
			}
		}
		wmcardMixAllInfoArr.sort(function(a,b){return b<a?1:-1});//从卡牌ID大到小排列
		if(wmcardMixAllInfoArr.length<=0){
			layer.alert('您没有多余的卡牌了！');
			layer.close(wmcardMixWindowIndex);
			wmcardMixWindowIndex = null;
			$('#wmCardLoading').stop(true, false).fadeOut(100);
		}else{
			wmCardMixCardDatabase(showModWindow);
		}
	};
	//显示分解卡牌
	function wmCardMixListCardShow(){
		var wmpageLength = 0;
		for(wmcardMixNowLength;wmcardMixNowLength<wmcardMixAllInfoArr.length;wmcardMixNowLength++){
			console.log(wmcardMixNowLength);
			var cardHtml = '<div class="wm_mix_card_img_item" data-cardid="'+wmcardMixAllInfoArr[wmcardMixNowLength]+'" data-star="'+wmcardDatabase.cardData[wmcardMixAllInfoArr[wmcardMixNowLength]].star+'"><img src="'+wmCardImgPath+wmcardMixAllInfoArr[wmcardMixNowLength]+'.jpg" class="wm_mix_card_img" /></div>'
			$('#wmCardMixListBox').append(cardHtml);
			$('#wmCardMixListBox .wm_mix_card_img').last().fadeIn(300);
			wmpageLength++;
			if(wmpageLength>=wmcardMixPage){
				wmcardMixNowLength++
				break;
			}
		}
		if(wmcardMixNowLength>=wmcardMixAllInfoArr.length){
			$('#wm_mixcardmore_btn').hide();
		}else{
			$('#wm_mixcardmore_btn').show();
		}
	};
	$('#wmCardMixListBox').on('click','.wm_mix_card_img_item',function(){
		if($(this).hasClass('card_selected')){
			$(this).removeClass('card_selected');
		}else{
			$(this).addClass('card_selected');
		}
	});
	$('#wm_mixcardmore_btn').on('click',function(){
		wmCardMixListCardShow();
	});
	//查询卡牌数据
	function wmCardMixCardDatabase(showModWindow){
		var getTimeStamp = new Date().getTime();
		$('#wmCardLoading').stop(true, false).fadeIn(100);
		$.ajax({
			type: 'GET',
			url: wmCardPluginpath + 'cardData.json?time=' + getTimeStamp,
			success: function(result){
				$('#wmCardLoading').stop(true, false).fadeOut(100);
				wmcardDatabase = result;
				$('#wmCardMixListBox').empty();
				wmCardMixListCardShow();
				if(showModWindow){	
					wmcardMixWindowIndex = layer.open({
						type: 1,
						maxWidth:'100%',
						title:'卡牌分解',
						zIndex:1002,
						content:$('#wmCardMixListBody'),
						btn: ['分解','全部分解','关闭'], //按钮
						btn1 :function(index){
							var wmMixcardSendCard = [];
							var wmMixcardSendCardEl = $('.wm_mix_card_img_item.card_selected');
							for(var i =0;i<wmMixcardSendCardEl.length;i++){
								var mixcardID = wmMixcardSendCardEl.eq(i).attr('data-cardid');
								wmMixcardSendCard.push(mixcardID);
							}
							if(wmMixcardSendCard.length<=0){
								layer.alert('请选择要分解的卡牌！');
							}else{
								wmMixcardSendData = wmCalcMixcard(wmMixcardSendCard);
								wmCheckMixCard(wmMixcardSendData[2],wmMixcardSendData[0],wmMixcardSendData[1],false);
								console.log(wmMixcardSendData);
							}
						},
						btn2 :function(index){
							$('.wm_mix_card_img_item').addClass('card_selected');
							wmMixcardSendData = wmCalcMixcard(wmcardMixAllInfoArr);
							wmCheckMixCard(wmMixcardSendData[2],wmMixcardSendData[0],wmMixcardSendData[1],true);
							console.log(wmMixcardSendData);
							return false;
						}
					});
				}
			},error:function(){
				layer.alert('网络异常！');
				$('#wmCardLoading').stop(true, false).fadeOut(100);
			},
			dataType: 'json'
		});
	}
	//二次确认卡牌是否分解
	function wmCheckMixCard(star,cardID,cardCount,isAll){
		var wmMixText = '';
		if(isAll){
			wmMixText = '全部';
		}
		layer.confirm('确定要分解'+wmMixText+'卡牌吗？分解后所选卡牌将会减少相应数量，并预计会获得'+star+'颗星星。', {
			btn: ['分解','取消'] //按钮
		  }, function(index){
			wmMixCardPassword(cardID,cardCount);
			layer.close(index);
		  }
		);
	}
	//弹出分解卡牌密码确认
	function wmMixCardPassword(cardID,cardCount){
		$('#wmGetPassword').attr('data-email',$('#wmCardMixInput').val());
		var wmSendCardID = cardID.join(',');
		var wmSendCardCount = cardCount.join(',');
		console.log(wmSendCardID);
		console.log(wmSendCardCount);
		layer.open({
			type: 1,
			title:'请输入密码或动态密码',
			zIndex:1003,
			content:$('#wmMailCheckBody'),
			btn: ['确定','取消'], //按钮
			btn1 :function(index){
				var wmMixcardEmail = $('#wmCardMixInput').val();
				var wmMixcardPassword = $('#wmPassword').val();
				var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
				if(wmMixcardEmail === ""){ //输入不能为空
					layer.alert("邮箱地址不能为空");
			　　　　return false;
			　　}else if(!reg.test(wmMixcardEmail)){ //正则验证不通过，格式不对
					layer.alert("邮箱地址有误!");
			　　　　return false;
			　　}else if(wmMixcardPassword==''){
					layer.alert("请输入密码!");
				　　return false;
				}else{
					var wmCardStarpath_ = wmCardPluginpath + 'wm_card_mixcard.php';
					$('#wmCardLoading').stop(true, false).fadeIn(100);
					var wmRememberPass = 0;
					if($('#wmRememberPass').hasClass('active')){
						wmRememberPass = 1;
					}
					$.ajax({
						type: 'POST',
						url: wmCardStarpath_,
						data: {email:wmMixcardEmail,password:wmMixcardPassword,cardID:wmSendCardID,cardCount:wmSendCardCount,rememberPass:wmRememberPass},
						success: function(result){
							$('#wmCardLoading').stop(true, false).fadeOut(100);
							if(result.code=="202"){
								if($('#wmRememberPass').hasClass('active')){
									wmSetDefaultPassWord(wmMixcardPassword);
								}else{
									wmDelDefaultMaillPassWord();
								}
								layer.confirm('成功分解了'+result.useCardNumbe+'张卡牌，获得了'+result.addStar+'颗星星！您现在剩余星星数量有'+result.starCount+'颗了！', {
									btn: ['确定']
									,btn1: function(index){
										wmMixSearchCard(index,false);
										layer.close(index);
									},cancel: function(){ 
										wmMixSearchCard(index,false);
									  }
								  });
								getNewCardList();
								layer.close(index);
							}else if(result.code=="0"){
								layer.alert('邮箱有误！');
							}else if(result.code=="100"){
								layer.alert('传送的参数有误！');
							}else if(result.code=="200"){
								layer.alert('无该用户数据，请先抽一张卡牌来创建用户！');
							}else if(result.code=="201"){
								layer.alert('密码错误或者密码过期！');
							}else if(result.code=="300"){
								layer.alert('非法参数，伙计你要做什么？！');
							}
						},
						error:function(){
							layer.alert('网络异常！');
							$('#wmCardLoading').stop(true, false).fadeOut(100);
						},
						dataType: 'json'
					});	
				}
			}
			}
		);
	};
	//计算提交的分解卡牌
	function wmCalcMixcard(wmMixcardSendCard){
		console.log(wmMixcardSendCard);
		var wmGetStar = 0;
		var wmMixcardSendData = [];
		var wmMixcardSendDataCardID = [];
		var wmMixcardSendDataCardCount = [];
		for(var i =0;i<wmMixcardSendCard.length;i++){
			var wmForCardID = wmMixcardSendCard[i];
			var wmHasreapt = false;
			wmGetStar = wmGetStar + wmcardDatabase.cardData[wmForCardID].star;
			for(var j=0;j<wmMixcardSendDataCardID.length;j++){
				if(wmForCardID==wmMixcardSendDataCardID[j]){
					wmHasreapt = true;
					wmMixcardSendDataCardCount[j]=wmMixcardSendDataCardCount[j]+1;
					break;
				}else{
					wmHasreapt = false;
				}
			};
			if(!wmHasreapt){
				wmMixcardSendDataCardID.push(wmForCardID);
				wmMixcardSendDataCardCount.push(1);
			}
		};
		wmMixcardSendData = [wmMixcardSendDataCardID,wmMixcardSendDataCardCount,wmGetStar]
		return wmMixcardSendData
	};
	//星星分解用到的卡牌查询
	function wmMixSearchCard(alertWindowIndex,showModWindow){
		var wmMixCardemail = $('#wmCardMixInput').val();
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmMixCardemail === ""){ //输入不能为空
			layer.alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmMixCardemail)){ //正则验证不通过，格式不对
			layer.alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
			$('#wmCardLoading').stop(true, false).fadeIn(100);
			var emailmd5_ = md5(wmMixCardemail);
			var wmCardPluginpath_ = wmCardPluginpath + 'wm_card_search.php';
			$.ajax({
				type: 'POST',
				url: wmCardPluginpath_,
				data: {email:emailmd5_},
				success: function(result){
					console.log(result);
					if(result.code=="202"){
						wmCardMixList(result.data,result.cardCount,alertWindowIndex,showModWindow);
						layer.close(alertWindowIndex);
					}else if(result.code=="1"){
						layer.alert("无该用户数据，请先抽一张卡牌来创建用户！");
					}
				},
				error:function(){
					layer.alert('网络异常！');
					$('#wmCardLoading').stop(true, false).fadeOut(100);
				},
				dataType: 'json'
			});
		}
	}
	// 股市
	function getwmBouerse(){
		layer.open({
			type: 1,
			title:'查询股票',
			zIndex:1003,
			content:$('#wmBouerseInputBody'),
			btn: ['查询','取消'], //按钮
			btn1 :function(index){
				wmGetBouerseInfo(index);
			}
		});
	}
	// 星星分解
	function openCardMixWindow(){
		layer.open({
			type: 1,
			title:'查询卡牌',
			zIndex:1003,
			content:$('#wmCardMixInputBody'),
			btn: ['查询','取消'], //按钮
			btn1 :function(index){
				wmMixSearchCard(index,true);
			}
		});
	}

	var chiosed = false;
	var wmcardAllInfoArr = [];//卡牌与卡牌数量的合集
	var showedWmCard = 0;//显示多少张
	var wmPageSize = 8;//一次显示多少张
	var wmNewListSize = 5;//一次显示多少动态
	var showedWmNewList = 0;//显示了多少条
	var wmNewListInfoArr = [];//储存最新动态

	function wmsearchCard(emailmd5_,addrsearch,newListSearch){
		$('#wmCardLoading').stop(true, false).delay(800).fadeIn(100);
		var wmCardPluginpath_ = wmCardPluginpath + 'wm_card_search.php';
		$.ajax({
			type: 'POST',
			url: wmCardPluginpath_,
			data: {email:emailmd5_},
			success: function(result){
				console.log(result);
				if(result.code=="202"){
					$('#wm_mylist_title').html('<img class="wm_title_info_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+emailmd5_+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45"><br />您的当前信息');
					if(addrsearch){
						var usernick = GetQueryString('usernick');
						if(usernick){
							usernick = urldecode(usernick);
							$('.wm_tiaozhan_body').show();
							$('#wm_mylist_title').html('<img class="wm_title_info_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+emailmd5_+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45"><br />' + usernick + '的当前信息');
						}else{
							$('.wm_tiaozhan_body').hide();
							$('#wm_mylist_title').html('<img class="wm_title_info_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+emailmd5_+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45"><br />您的当前信息');
						}
					}else if(newListSearch){
						$('.wm_tiaozhan_body').show();
						$('#wm_mylist_title').html('<img class="wm_title_info_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+emailmd5_+'?s=100&amp;d=mm&amp;r=g&amp;d=robohash" width="45" height="45"><br />TA的当前信息');
					}else{
						$('.wm_tiaozhan_body').hide();
					}
					$('#wm_mylist_title').fadeIn(500);
					var wmcard = result.data;
					var wmcardarr = wmcard.split(",");
					var wmcardCount = result.cardCount;
					var wmcardCountarr = wmcardCount.split(",");
					$('.wm_user_level').empty().text(result.level);
					$('.wm_user_score').empty().text(result.score);
					$('.wm_user_getcard_count').empty().text(String(wmcardarr.length)+'/'+String(result.cardLength));
					$('.wm_user_info_table').show();
					$('.wm_user_info_body').fadeIn(300);
					wmcardAllInfoArr = [];//清空卡牌数量的合集数组
					for(var i =0;i<wmcardarr.length;i++){//循环存入合集
						var wmcardItemInfoArr = [wmcardarr[i],wmcardCountarr[i]];
						wmcardAllInfoArr.push(wmcardItemInfoArr);
					}
					showedWmCard = 0;//清空显示卡牌计数
					wmcardAllInfoArr.sort(function(a,b){return a<b?1:-1});//从卡牌ID大到小排列
					$('.wm_mycard_list').empty();
					showWmCard();
					if(wmcardAllInfoArr.length>wmPageSize){
						$('#wm_cardmore_btn').fadeIn('200');
					}
				}else if(result.code=="1"){
					$('#wm_mylist_title').text('还没有获得过卡牌');
					$('#wm_mylist_title').fadeIn(500);
				}
				$('#wmCardLoading').stop(true, false).fadeOut(100);
			},
			error:function(){
				layer.alert('网络异常！');
				$('#wmCardLoading').stop(true, false).fadeOut(100);
			},
			dataType: 'json'
		});
	}
	function showWmCard(){
		showedWmCard = showedWmCard + wmPageSize;
		var wmPageCount = Math.ceil(showedWmCard/wmPageSize)-1;
		var wmAddCount = wmPageCount*wmPageSize;
		if(showedWmCard>=wmcardAllInfoArr.length){
			showedWmCard = wmcardAllInfoArr.length;
			$('#wm_cardmore_btn').fadeOut('200');
		}
		var delay = 0;
		for(var i =0;i<showedWmCard-wmAddCount;i++){
			var html_ = '<a href="'+wmCardImgPath+wmcardAllInfoArr[i+wmAddCount][0]+'.jpg" class="wm_getcard_box" style="display:none;" target="_blank"><img class="wm_getcard_img" src="'+wmCardImgPath+wmcardAllInfoArr[i+wmAddCount][0]+'.jpg"><br><span class="wm_card_nums">×'+wmcardAllInfoArr[i+wmAddCount][1]+'</span></a>';
			$('.wm_mycard_list').append(html_);
			$('.wm_getcard_box').last().delay(delay).fadeIn(400);
			delay = delay + 200;
		}
	}
	function alertTitle(text){
		$('#alertTitle').text(text);
	}
	function urldecode(encodedString)
	{
		var output = encodedString;
		var binVal, thisString;
		var myregexp = /(%[^%]{2})/;
		function utf8to16(str)
		{
			var out, i, len, c;
			var char2, char3;
	
			out = "";
			len = str.length;
			i = 0;
			while(i < len) 
			{
				c = str.charCodeAt(i++);
				switch(c >> 4)
				{ 
					case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
					out += str.charAt(i-1);
					break;
					case 12: case 13:
					char2 = str.charCodeAt(i++);
					out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
					break;
					case 14:
					char2 = str.charCodeAt(i++);
					char3 = str.charCodeAt(i++);
					out += String.fromCharCode(((c & 0x0F) << 12) |
							((char2 & 0x3F) << 6) |
							((char3 & 0x3F) << 0));
					break;
				}
			}
			return out;
		}
		while((match = myregexp.exec(output)) != null
					&& match.length > 1
					&& match[1] != '')
		{
			binVal = parseInt(match[1].substr(1),16);
			thisString = String.fromCharCode(binVal);
			output = output.replace(match[1], thisString);
		}
		
		//output = utf8to16(output);
		output = output.replace(/\\+/g, " ");
		output = utf8to16(output);
		return output;
	}
	//获取地址栏参数
	function GetQueryString(name) {
		var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		
		if(r!=null) {
			return  unescape(r[2]);
		} else {
			return null;
		}      
	}
	//动态显示效果
	function wmGetListShow(){
		var delay = 0;
		$('#wm_get_list_more_btn').attr('disabled','true');
		if(showedWmNewList+wmNewListSize > wmNewListInfoArr.length){
			wmNewListSize = wmNewListSize-(showedWmNewList+wmNewListSize - wmNewListInfoArr.length);
		}
		for(var i=showedWmNewList;i<showedWmNewList+wmNewListSize;i++){
			var listHtml = '';
			if(wmNewListInfoArr[i].massageType=='dailyCard' || wmNewListInfoArr[i].massageType==undefined){
				var getText = '虽然卡牌星级不高，但是我也很喜欢！';
				var wmSixStarCardShake = '';
				if(wmNewListInfoArr[i].cardInfo.star===4){
					getText = '不好不差，证明我既不是非洲人也不是欧洲人。'
				}else if(wmNewListInfoArr[i].cardInfo.star===5){
					getText = '运气不错，距离欧皇就差一点点。'
				}else if(wmNewListInfoArr[i].cardInfo.star>=6){
					getText = '欧气满满，欧耶~';
					wmSixStarCardShake = ' wm_six_star_card_shake'
				}
				listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我抽中了出自作品《'+wmNewListInfoArr[i].cardInfo.title+'》的'+wmNewListInfoArr[i].cardInfo.star+'星卡<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID+'.jpg" class="wm_card_get_list_card_link'+wmSixStarCardShake+'" target="_blank">'+wmNewListInfoArr[i].cardInfo.name+'</a>。'+getText+'</div></div>'
			}else if(wmNewListInfoArr[i].massageType=='buy'){
				if(wmNewListInfoArr[i].buyClass == 2){
					var wmbuy2_6Card = 0;
					var wmbuy2_5Card = 0;
					var wmbuy2_4Card = 0;
					var wmbuy2_3Card = 0;
					var wmbuy2_6CardArr = [];
					var wmbuy2_5CardArr = [];
					var wmbuy2_4CardArr = [];
					var wmbuy2_3CardArr = [];
					wmcardChioseAllInfoArr = wmNewListInfoArr[i].card;
					wmcardChioseAllInfoArr.sort(function(a,b){return a<b?1:-1});//从卡牌ID大到小排列
					for(var k =0;k<wmcardChioseAllInfoArr.length;k++){
						if(Number(wmcardChioseAllInfoArr[k])>3000){//是六星卡
							wmbuy2_6Card = wmbuy2_6Card+1;
							wmbuy2_6CardArr.push(wmcardChioseAllInfoArr[k]);
						}else if(Number(wmcardChioseAllInfoArr[k])>2000){
							wmbuy2_5Card = wmbuy2_5Card+1;
							wmbuy2_5CardArr.push(wmcardChioseAllInfoArr[k]);
						}else if(Number(wmcardChioseAllInfoArr[k])>1000){
							wmbuy2_4Card = wmbuy2_4Card+1;
							wmbuy2_4CardArr.push(wmcardChioseAllInfoArr[k]);
						}else{
							wmbuy2_3Card = wmbuy2_3Card+1;
							wmbuy2_3CardArr.push(wmcardChioseAllInfoArr[k]);
						}
					};
					
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我在<a href="javascript:;" class="wm_getlist_link wm_goto_starshop">星星商店</a>使用了'+wmNewListInfoArr[i].useStar+'颗星星进行了'+wmNewListInfoArr[i].chinChioseCardNum+'连抽。一共抽中了<a href="javascript:;" class="goto_wm_chiose_card" target="_blank" data-card="'+wmbuy2_6CardArr.join(',')+'">'+wmbuy2_6Card+'</a>张六星卡，<a href="javascript:;" class="goto_wm_chiose_card" target="_blank" data-card="'+wmbuy2_5CardArr.join(',')+'">'+wmbuy2_5Card+'</a>张五星卡，<a href="javascript:;" class="goto_wm_chiose_card" target="_blank" data-card="'+wmbuy2_4CardArr.join(',')+'">'+wmbuy2_4Card+'</a>张四星卡，<a href="javascript:;" class="goto_wm_chiose_card" target="_blank" data-card="'+wmbuy2_3CardArr.join(',')+'">'+wmbuy2_3Card+'</a>张三星及其以下的卡。</div></div>';
				}else{
					var getText = '虽然卡牌星级不高，但是我也很喜欢！';
					var wmSixStarCardShake = '';
					if(wmNewListInfoArr[i].useStar<=30){
						if(wmNewListInfoArr[i].cardInfo.star===4){
							getText = '不好不差，证明我既不是非洲人也不是欧洲人。'
						}else if(wmNewListInfoArr[i].cardInfo.star===5){
							getText = '运气不错，距离欧皇就差一点点。'
						}else if(wmNewListInfoArr[i].cardInfo.star>=6){
							getText = '欧气满满，欧耶~';
							wmSixStarCardShake = ' wm_six_star_card_shake'
						}
					}else{
						if(wmNewListInfoArr[i].cardInfo.star===4){
							getText = '哪怕是4星卡，我也要用星星抽！'
						}else if(wmNewListInfoArr[i].cardInfo.star===5){
							getText = '我要用尽我的星星来抽出我喜欢的5星卡！'
						}else if(wmNewListInfoArr[i].cardInfo.star>=6){
							getText = '有星星6星卡也随便抽！';
							wmSixStarCardShake = ' wm_six_star_card_shake'
						}
					}
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我在<a href="javascript:;" class="wm_getlist_link wm_goto_starshop">星星商店</a>使用了'+wmNewListInfoArr[i].useStar+'颗星星抽中了出自作品《'+wmNewListInfoArr[i].cardInfo.title+'》的'+wmNewListInfoArr[i].cardInfo.star+'星卡<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID+'.jpg" class="wm_card_get_list_card_link'+wmSixStarCardShake+'" target="_blank">'+wmNewListInfoArr[i].cardInfo.name+'</a>。'+getText+'</div></div>';
				}
			}else if(wmNewListInfoArr[i].massageType=='battle'){
				// 兼容老版本是否有对方的邮箱MD5
				var wmDalaoHtml = '大佬';
				if(wmNewListInfoArr[i].EMmailMD5 !== undefined){
					wmDalaoHtml = '<a href="javascript:;" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].EMmailMD5+'" class="wm_getlist_link wm_goto_dalao_info">大佬</a>';
				}
				if(wmNewListInfoArr[i].Win == 0){
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我成功挑战了一名'+wmDalaoHtml+'，并从中获得了'+wmNewListInfoArr[i].MyGetScore+'点竞技点与'+wmNewListInfoArr[i].GETEXP+'点经验值。抱歉，竞技点我收走啦！</div></div>';
				}else if(wmNewListInfoArr[i].Win == 1){
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我在对战中败给了一名'+wmDalaoHtml+'，失去了'+Math.abs(wmNewListInfoArr[i].MyGetScore)+'点竞技点，获得了'+wmNewListInfoArr[i].GETEXP+'点经验值。我的竞技点……</div></div>';
				}
			}else if(wmNewListInfoArr[i].massageType=='mixcard'){
				listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我通过<a href="javascript:;" class="wm_getlist_link wm_goto_mixcard">卡牌分解</a>，用公式2NaAlO2+CO2+3H2O+'+wmNewListInfoArr[i].useCardNumbe+'张卡牌分解出了2Al(OH)3↓+Na2CO3+'+wmNewListInfoArr[i].addStar+'颗星星！</div></div>';
			}else if(wmNewListInfoArr[i].massageType=='demining'){
				if(wmNewListInfoArr[i].getStar>0){
					//判断是否获取经验值
					var wmBoomExpText = '';
					if(wmNewListInfoArr[i].MyGetExp !== undefined){
						wmBoomExpText = '并获得了'+wmNewListInfoArr[i].MyGetExp+'点经验值'
					}
					var wmLastBoomText = '';
					if(wmNewListInfoArr[i].lastBoom==1){
						wmLastBoomText = '另外这已经是最后一片星星矿了，我将带大家去新的矿场。当然，新的矿场将由我来铲下这第一铲，嘻嘻！';
					}
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">真是功夫不负有心人，我在<a href="javascript:;" class="wm_getlist_link wm_goto_stardemining">星星矿场</a>，挖出了'+wmNewListInfoArr[i].getStar+'颗星星'+wmBoomExpText+'！！看来我已经是一名专业的矿工了呢！'+wmLastBoomText+'</div></div>';
				}else{
					//判断是否获取经验值
					var wmBoomExpText = '';
					if(wmNewListInfoArr[i].MyGetExp !== undefined){
						wmBoomExpText = '虽然获得了'+wmNewListInfoArr[i].MyGetExp+'点经验值，'
					}
					if(wmNewListInfoArr[i].attackNum>0){
						listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我尝试在<a href="javascript:;" class="wm_getlist_link wm_goto_stardemining">星星矿场</a>挖星星，'+wmBoomExpText+'但是很可惜什么都没挖到。不过根据探测器显示，我的周围有'+wmNewListInfoArr[i].attackNum+'片星星矿！到时候大佬们不要和我抢呀！</div></div>';
					}else{
						listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我尝试在<a href="javascript:;" class="wm_getlist_link wm_goto_stardemining">星星矿场</a>挖星星，'+wmBoomExpText+'但是很可惜什么都没挖到。根据探测器显示我的周围什么都没有，所以大家还是别来凑热闹了……</div></div>';
					}
				}
			}else if(wmNewListInfoArr[i].massageType=='bouerseBuy'){
				listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我在<a href="javascript:;" class="wm_getlist_link wm_goto_starbouerse">星星股票交易所</a>花了'+wmNewListInfoArr[i].useStar+'颗星星买入了'+wmNewListInfoArr[i].value+'份<a href="javascript:;" class="wm_getlist_link wm_goto_starbouerse">'+wmNewListInfoArr[i].name+'</a>股，省吃俭用入股市，但愿大涨把卡抽！</div></div>';
			}else if(wmNewListInfoArr[i].massageType=='bouerseSell'){
				listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我在<a href="javascript:;" class="wm_getlist_link wm_goto_starbouerse">星星股票交易所</a>卖了'+wmNewListInfoArr[i].value+'份<a href="javascript:;" class="wm_getlist_link wm_goto_starbouerse">'+wmNewListInfoArr[i].name+'</a>股，换取了'+wmNewListInfoArr[i].useStar+'颗星星，是时候收割一波换星星了！</div></div>';
			}
			else if(wmNewListInfoArr[i].massageType=='guesscard'){
				if(wmNewListInfoArr[i].type==0){
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我猜<a href="javascript:;" class="wm_getlist_link wm_goto_guesscard">星星猜卡</a>这一次的卡牌为<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID[0]+'.jpg" class="wm_card_get_list_card_link" target="_blank">'+wmNewListInfoArr[i].cardName[0]+'</a>、<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID[1]+'.jpg" class="wm_card_get_list_card_link" target="_blank">'+wmNewListInfoArr[i].cardName[1]+'</a>、<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID[2]+'.jpg" class="wm_card_get_list_card_link" target="_blank">'+wmNewListInfoArr[i].cardName[2]+'</a>、<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID[3]+'.jpg" class="wm_card_get_list_card_link" target="_blank">'+wmNewListInfoArr[i].cardName[3]+'</a>、<a href="'+wmCardImgPath+wmNewListInfoArr[i].cardID[4]+'.jpg" class="wm_card_get_list_card_link" target="_blank">'+wmNewListInfoArr[i].cardName[4]+'</a>。相信我没错！</div></div>';
				}else{
					var attackText = '';
					if(wmNewListInfoArr[i].wmAttackNum==1){
						attackText='马马虎虎猜中了1张，虽然星星很少，但总比没有好吧！';
					}else if(wmNewListInfoArr[i].wmAttackNum==2){
						attackText='运气还不错，猜中2张，保本保本！';
					}else if(wmNewListInfoArr[i].wmAttackNum==3){
						attackText='运气不赖呀，猜中3张，小赚了一把！';
					}else if(wmNewListInfoArr[i].wmAttackNum==4){
						attackText='虽然还差一点就全中了，但是已经心满意足了！';
					}else if(wmNewListInfoArr[i].wmAttackNum==5){
						attackText='我的天！我居然全猜中了！请叫我欧皇！！！';
					}
					listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://cdn.v2ex.com/gravatar/'+wmNewListInfoArr[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+wmNewListInfoArr[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我在<a href="javascript:;" class="wm_getlist_link wm_goto_guesscard">星星猜卡</a>中猜中了'+wmNewListInfoArr[i].wmAttackNum+'张牌。获得了'+wmNewListInfoArr[i].getStar+'颗星星！'+attackText+'</div></div>';
				}
				
			}
			if(listHtml!=''){
				$('#wmCardGetList').append(listHtml);
				$('.wm_card_get_list_item').last().delay(delay).fadeIn(300);
				delay = delay + 300;
			}
		}
		showedWmNewList = showedWmNewList+wmNewListSize;
		if(showedWmNewList == wmNewListInfoArr.length){
			$('#wm_get_list_more_btn').fadeOut(300);
		}else{
			$('#wm_get_list_more_btn').show();
		}
		$('#wm_get_list_more_btn').removeAttr('disabled');
	}
	// 点击去星星猜卡
	$('#wmCardGetList').on('click','.wm_goto_guesscard',function(){
		$('#wmBannerBody .swiper-slide[data-type="guesscard"]').eq(0).trigger('click');
	});
	//点击去星星股市
	$('#wmCardGetList').on('click','.wm_goto_starbouerse',function(){
		$('#wmBannerBody .swiper-slide[data-type="bouerse"]').eq(0).trigger('click');
	});
	//点击去星星矿场
	$('#wmCardGetList').on('click','.wm_goto_stardemining',function(){
		$('#wmBannerBody .swiper-slide[data-type="starDemining"]').eq(0).trigger('click');
	});
	// 点击去卡牌分解动态
	$('#wmCardGetList').on('click','.wm_goto_mixcard',function(){
		$('#wmBannerBody .swiper-slide[data-type="cardMix"]').eq(0).trigger('click');
	});
	// 点击星星商店动态
	$('#wmCardGetList').on('click','.wm_goto_starshop',function(){
		$('#wmBannerBody .swiper-slide[data-type="starShop"]').eq(0).trigger('click');
	});
	//查看连抽卡牌
	$('#wmCardGetList').on('click','.goto_wm_chiose_card',function(){
		if($(this).attr('data-card')!=''){
			var wmChioseCardList = $(this).attr('data-card').split(",");
			var wmCardHtml = '';
			for(var i=0;i<wmChioseCardList.length;i++){
				wmCardHtml = wmCardHtml + '<a href="'+wmCardImgPath+wmChioseCardList[i]+'.jpg" class="wm_getcard_box" style="width:170px;height:239px;" target="_blank"><img class="wm_getcard_img" style="width:170px;height:239px;" src="'+wmCardImgPath+wmChioseCardList[i]+'.jpg"></a>';
				
			}
			wmCardHtml = '<div class="wm_card_getlist_watch_card">'+wmCardHtml+'</div>';
			layer.open({
				type: 1,
				title:'查看卡牌',
				maxWidth: '100%', //宽高
				content: wmCardHtml,
				btn: ['关闭'], //按钮
			});
		}
	});
	// 点击动态查看大佬
	$('#wmCardGetList').on('click','.wm_goto_dalao_info',function(){
		var addrmd5 = $(this).attr('data-md5');
		$('#wm_tiaozhan_btn').attr('data-md5',addrmd5);
		wmsearchCard(addrmd5,false,true);
		$('html, body').animate({scrollTop: $('#wmGetCard').offset().top+200}, 300);
	});
	//获取最新抽卡动态
	function getNewCardList(){
		var getTimeStamp = new Date().getTime();
		$.ajax({
			type: 'GET',
			url: wmCardPluginpath + 'cardGetList.json?time=' + getTimeStamp,
			success: function(result){
				console.log(result);
				if(result.length>0){
					$('.wm_card_get_list_body').fadeIn(300);
					$('#wmCardGetList').empty();
					wmNewListSize = 5;//一次显示多少动态
					showedWmNewList = 0;//显示了多少条
					wmNewListInfoArr = result;
					wmGetListShow();
				}
			},
			dataType: 'json'
		});
	}
	function setCardScroll(positionType){
		//小屏滚动条
		var cardListWidth = $('#wmCardList').width();
		var wmGetCardWidth = $('#wmGetCard').width();
		if(wmGetCardWidth>cardListWidth){
			if(positionType=='left'){
				$('#wmCardList').animate({scrollLeft: 0}, 200);
			}else if(positionType=='center'){
				$('#wmCardList').animate({scrollLeft: (wmGetCardWidth-cardListWidth)/2}, 200);
			}else if(positionType=='right'){
				$('#wmCardList').animate({scrollLeft: wmGetCardWidth-cardListWidth}, 200);
			}
		}
	}
	function reChioseBtn(shouldAccount){
		$('#wm_card_restart_btn').attr('disabled','true');
		$('#wm_card_rechiose_btn').attr('disabled','true');
		$('.no-selectedcard').removeClass('no-selectedcard');
		$('#wmGetCard').addClass('animated fadeOutDown');
		$('#wmGetCard').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$('#wmGetCard .selectcard').attr('class','card selectcard');
			$('#wmGetCard').removeClass('fadeOutDown').addClass('fadeInDown');
			$('#wmGetCard').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
				$('#wmGetCard').removeClass('fadeInDown').removeClass('animated');
				if(shouldAccount){
					$('.wm_card_restart_body').hide();
					$('#wmCardChioseInputBody').fadeIn(300);
				}
				$('#wm_card_restart_btn').removeAttr('disabled');
				$('#alertTitle').text('继续神抽吧');
				chiosed = false;
			});
		});
	}
	//加载最新动态按钮
	$('#wm_get_list_more_btn').on('click',function(){
		wmGetListShow();
	})
	//重抽
	$('#wm_card_restart_btn').on('click',function(){
		reChioseBtn(true);
		$('#wm_card_email').val('');
	});
	$('#wm_card_rechiose_btn').on('click',function(){
		reChioseBtn(false);
	})
	//小屏滚动条居中
	setCardScroll('center');
	//绑定更多事件
	$('#wm_cardmore_btn').on('click',function(){
		showWmCard();
	})
	// 查看最新抽卡动态的所获卡牌
	$('#wmCardGetList').on('click','.wm_card_get_list_avatar_pic',function(){
		var addrmd5 = $(this).attr('data-md5');
		$('#wm_tiaozhan_btn').attr('data-md5',addrmd5);
		wmsearchCard(addrmd5,false,true);
		$('html, body').animate({scrollTop: $('#wmGetCard').offset().top+200}, 300);
	})
	//获取最新抽卡动态
	getNewCardList();
	//挑战
	var addrmd5 = GetQueryString('useraddr');
	if(addrmd5){
		wmsearchCard(addrmd5,true);
	}
	$('#wm_tiaozhan_btn').attr('data-md5',addrmd5);
	$('#wm_tiaozhan_btn').on('click',function(){
		var wmEmail = $('#wm_tiaozhan_email').val();
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmEmail === ""){ //输入不能为空
			layer.alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
			layer.alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
			var MyEmailMD5 = md5(wmEmail);
			var EMEmailMD5 = $('#wm_tiaozhan_btn').attr('data-md5');
			gameInit(MyEmailMD5,EMEmailMD5);
			
		}
	});
	
   $('#wmGetCard').on('click','.selectcard',function(){
		if(chiosed){
			return false;
		}
		var wmCardPluginpath_ = wmCardPluginpath + 'cardCallback.php';
		var wmEmail = $('#wm_card_email').val();
		var choiseIndex = $(this).attr('data-id');
		//console.log(wmEmail);
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmEmail === ""){ //输入不能为空
			layer.alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
			layer.alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
		chiosed = true;
		$('#wmCardLoading').stop(true, false).delay(800).fadeIn(100);
	　　　　$.ajax({
			  type: 'POST',
			  url: wmCardPluginpath_,
			  data: {email:wmEmail,choiseIndex:choiseIndex},
			  success: function(result){
				  console.log(result);
				  //0为邮箱地址为空，1为邮箱地址不合格，2为今天已经抽过了，3为评论表里找不到邮箱地址，202
				  $('#wmCardLoading').stop(true, false).fadeOut(100);
				  if(result.code == '0'){
					  layer.alert('邮箱地址为空');
					  chiosed = false;
				  }else if(result.code == '1'){
					  layer.alert('为邮箱地址不正确');
					  chiosed = false;
				  }else if(result.code == '2'){
					  alertTitle('您已经超过每天的抽卡次数')
					  chiosed = false;
					  var emailmd5_ = result.emailmd5;
					  if($('#wmRememberEmail').hasClass('active')){
						wmSetDefaultMaillAddress(wmEmail);
					  }else{
						wmDelDefaultMaillAddress();
					  }
					  wmsearchCard(emailmd5_);
				  }else if(result.code == '3'){
					  layer.alert('请先在文章中评论并等待管理员审核后抽卡');
					  chiosed = false;
				  }else if(result.code == '202'){
					  alertTitle('快看看都抽到了什么吧');
					  if($('#wmRememberEmail').hasClass('active')){
						wmSetDefaultMaillAddress(wmEmail);
					  }else{
						wmDelDefaultMaillAddress();
					  }
					  var emailmd5_ = result.emailmd5;
					  for(var i=0;i<result.cardChoiseList.length;i++){
						var cardId = result.cardChoiseList[i];
						var imgSrc = wmCardImgPath+ cardId+'.jpg';
						$('#wmGetCard').find('.selectcard .wm_card_img').eq(i).attr('src',imgSrc);
					  }
					  $('#wmCardChioseInputBody').fadeOut(300,function(){
						if(result.leftGetChance<=0){
							$('#wm_card_rechiose_btn').attr('disabled','true');
						}else{
							$('#wm_card_rechiose_btn').removeAttr('disabled');
							$('#wm_card_rechiose_btn').show();
						}
						$('.wm_card_restart_body').show();
					  });
					  $('#wmGetCard').find('.selectcard').eq(result.choiseIndex).addClass('selectedcard');
					  //小屏模式滚动
					  if(result.choiseIndex==0){
						setCardScroll('left');
					  }else if(result.choiseIndex==1){
						setCardScroll('center');
					  }else if(result.choiseIndex==2){
						setCardScroll('right');
					  }
					  $('#wmGetCard').find('.selectcard.selectedcard').rotate_box();
					  setTimeout(function(){
						var selElem_ = $('#wmGetCard').find('.selectcard');
						for(var j=0;j<selElem_.length;j++){
							if(!selElem_.eq(j).hasClass('selectedcard')){
								selElem_.eq(j).addClass('no-selectedcard');
							}
						}
						$('#wmGetCard').find('.selectcard.no-selectedcard').rotate_box();
					  },700)
					  chiosed = true;
					  wmsearchCard(emailmd5_);
					  getNewCardList();
				  }else{
					  layer.alert('未知错误 请联系管理员');
				  }
			  },
			  error:function(){
				  chiosed = false;
				  layer.alert('网络异常！');
				  $('#wmCardLoading').stop(true, false).fadeOut(100);
			  },
			  dataType: 'json'
		   });
	　　}
		 
	});
	//时间戳转换
	function capitalize(value) {
		var date = new Date(parseInt(value));
		var tt = [date.getFullYear(), ((date.getMonth()+1)<10?'0'+(date.getMonth()+1):date.getMonth()+1), (date.getDate()<10?'0'+date.getDate():date.getDate())].join('-') + '  ' +[(date.getHours()<10?'0'+date.getHours():date.getHours()), (date.getMinutes()<10?'0'+date.getMinutes():date.getMinutes()), (date.getSeconds()<10?'0'+date.getSeconds():date.getSeconds())].join(':');
        return tt;
	}
 
	var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
                            window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

	var cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;
	//游戏部分
	var WMGameData = null;
	var canvas=document.getElementById('wm_cardGame_canvas');//获取画布
	canvas.width=1280;
	canvas.height=720;
	var ctx=canvas.getContext('2d');//用于在画布上绘图的环境
	ctx.font = "40px Courier New";//设定字体
	ctx.fillStyle = "#fff";//设定字颜色
	ctx.textAlign="center";//设定字居中
	ctx.fillText("读取中...", Math.round(1280/2), 300);
	var images = [];
	
	var EMCardXYGlobal = [];//全局储存敌方卡牌数据
	var MyCardXYGlobal = [];//全局储存我方卡牌数据
	
	var MyHP = 0;
	var EMHP = 0;
	var gameRound = 0;
	
	var globalAlpha = 1;
	var globalAlphaSetIn = 0;
	var globalAlphaSetOut = 1;
	var fadeInTime = 50;
	var fadeInFlag = true;
	var fadeOutFlag = true;
	
	var skillInfo = ['增加固定攻击力','攻击回复生命值','增加固定防御力','增加生命值','减少对方固定防御力','增加攻击力百分比','增加固定攻防并增加生命值'];
	var skillFlag = false;
	var turnEnd = true;
	
	var VSFLag = true;
	
	var attcackEffectFlag = false;
	
	var whiteAl = 0;
	var whitefadeIn = true;
	
	var attcackRedEffectFlag = true;
	var redAl = 0;
	var redfadeIn = true;
	
	var nextTimer = 10;
	var gameTimer = null;
	var gameOverFlag = false;
	
	function fadeReset(){
		globalAlpha = 1;
		globalAlphaSetIn = 0;
		globalAlphaSetOut = 1;
		fadeInTime = 50;
		fadeInFlag = true;
		fadeOutFlag = true;
	}
	
	function VarReset(){//重置数据
		ctx.fillStyle="rgba(0,0,0,1)";
		ctx.fillRect(0,0,1280,720);
		ctx.font = "40px Courier New";//设定字体
		ctx.fillStyle = "#fff";//设定字颜色
		ctx.textAlign="center";//设定字居中
		ctx.fillText("读取中...", Math.round(1280/2), 300);
		images = [];
		
		EMCardXYGlobal = [];//全局储存敌方卡牌数据
		MyCardXYGlobal = [];//全局储存我方卡牌数据
		
		MyHP = 0;
		EMHP = 0;
		gameRound = 0;
		
		globalAlpha = 1;
		globalAlphaSetIn = 0;
		globalAlphaSetOut = 1;
		fadeInTime = 50;
		fadeInFlag = true;
		fadeOutFlag = true;
		
		skillInfo = ['增加固定攻击力','攻击回复生命值','增加固定防御力','增加生命值','减少对方固定防御力','增加攻击力百分比','增加固定攻防并增加生命值'];
		skillFlag = false;
		turnEnd = true;
		
		VSFLag = true;
		
		attcackEffectFlag = false;
		
		whiteAl = 0;
		whitefadeIn = true;
		
		attcackRedEffectFlag = true;
		redAl = 0;
		redfadeIn = true;
		
		nextTimer = 10;
		gameTimer = null;
		gameOverFlag = false;
	}
	
	//游戏加载
	function loading(imgSrc){
		var imgLength = imgSrc.length;
		var loadingNum = 0;
		for(var i=0;i<imgLength;i++){
			images[i] = new Image();
			images[i].src = imgSrc[i];
			images[i].onload = function(){
				loadingNum++;
				if(loadingNum===imgLength){
					gameStart();
				}
			};
		}
	}
	//游戏初始化
	function gameInit(Mymd5,EMmd5){
		VarReset();
		var MyIco = 'https://cdn.v2ex.com/gravatar/'+Mymd5+'?s=300&d=mm&r=g&d=robohash';
		var EMIco = 'https://cdn.v2ex.com/gravatar/'+EMmd5+'?s=300&d=mm&r=g&d=robohash';
		var imgSrcArr = [];
		imgSrcArr.push(wmCardPluginpath+'/card/img/game_bg.jpg');
		imgSrcArr.push(MyIco);
		imgSrcArr.push(EMIco);
		fadeReset();
		resetFightAni();
		$('.wm_card_game_body').fadeIn(500);
		
		var wmCardPluginpath__ = wmCardPluginpath+'cardGame.php';
		
			$.ajax({
				type: 'POST',
				url: wmCardPluginpath__,
				data: {EMemail:EMmd5,Myemail:Mymd5},
				success: function(result){
					console.log(result);
					if(result.code=="202"){
						WMGameData = result;
						MyHP = WMGameData.MyStartStat[0];
						EMHP = WMGameData.EMStartStat[0];
						var MycardAddrArr = WMGameData.MyCard;
						var EMcardAddrArr = WMGameData.EMCard;
						var thisAddr = null;		
						for(var i =0;i<MycardAddrArr.length;i++){
							thisAddr = wmCardImgPath+MycardAddrArr[i]+'.jpg';
							imgSrcArr.push(thisAddr);
						}
									
						for(var j =0;j<EMcardAddrArr.length;j++){
							thisAddr = wmCardImgPath+EMcardAddrArr[j]+'.jpg';
							imgSrcArr.push(thisAddr);
						}
						
						loading(imgSrcArr);
					}else if(result.code=="1"){
						layer.alert('双方有一方并没有牌');
						$('.wm_card_game_body').hide();
					}else if(result.code=="0"){
						layer.alert('邮箱地址有误或者游戏双方为同一邮箱');
						$('.wm_card_game_body').hide();
					}else if(result.code=="2"){
						layer.alert('您今天已经发起过挑战了，请明天再来吧！');
						$('.wm_card_game_body').hide();
					}
				},
				dataType: 'json'
			});
	}
	function gameStart(){
		var drawFunction = function(){
			//console.log('123');
			drawBG();
			drawMyHP();
			drawEMHP();
			drawMyCard();
			drawEMCard();
			
			if(VSFLag){
				drawVS();
			}else{
				Fight();
			}
			if(!gameOverFlag){
				gameTimer = requestAnimationFrame(drawFunction);
			}
		};
		gameTimer = requestAnimationFrame(drawFunction);
	}
	
	function drawBG(){
		ctx.drawImage(images[0],0,0,canvas.width,canvas.height);
		ctx.drawImage(images[1],25,16,80,80);
		ctx.drawImage(images[2],1175,16,80,80);
	}
	function drawMyCard(){
		var MyCardXY = [];//PIC,X,Y
		var MycardLength = WMGameData.MyCard.length;
		var PICY = -1;
		var PICX = -1;
		for(var i =0;i<MycardLength;i++){
			var num = i+3;
			if(i%5===0){
				PICY = PICY+1;
				PICX = 0;
			}
			var PICX_ = 25+84*PICX+13*PICX;
			PICX++;
			var arrCache = [images[num],PICX_,130+PICY*150];
			MyCardXY.push(arrCache);
		}
		MyCardXYGlobal = MyCardXY;
		for(var j=0;j<MyCardXY.length;j++){
			ctx.drawImage(MyCardXY[j][0],MyCardXY[j][1],MyCardXY[j][2],84,118);
		}
	}
	
	function drawEMCard(){
		var EMCardXY = [];//PIC,X,Y
		var EMcardLength = WMGameData.EMCard.length;
		var MycardLength = WMGameData.MyCard.length;
		var PICY = -1;
		var PICX = -1;
		for(var i =0;i<EMcardLength;i++){
			var num = i+3+MycardLength;
			if(i%5===0){
				PICY = PICY+1;
				PICX = 0;
			}
			var PICX_ = 783+84*PICX+13*PICX;
			PICX++;
			var arrCache = [images[num],PICX_,130+PICY*150];
			EMCardXY.push(arrCache);
		}
		EMCardXYGlobal = EMCardXY;
		for(var j=0;j<EMCardXY.length;j++){
			ctx.drawImage(EMCardXY[j][0],EMCardXY[j][1],EMCardXY[j][2],84,118);
		}
	}
	
	function drawMyHP(){
		ctx.font = "48px Arial";//设定字体
		ctx.fillStyle = "#FFF";//设定字颜色
		ctx.textAlign="left";//设定字居中
		ctx.fillText('HP:'+MyHP, 121, 72 ,365);
		
	}
	
	function drawEMHP(){
		ctx.font = "48px Arial";//设定字体
		ctx.fillStyle = "#FFF";//设定字颜色
		ctx.textAlign="right";//设定字居中
		ctx.fillText('HP:'+EMHP, 1158, 72 ,365);
		
	}
	
	function drawVS(){
		if(fadeInFlag){
			ctx.globalAlpha=globalAlphaSetIn;
		}else{
			if(fadeInTime<=0){
				if(globalAlphaSetOut>=0){
					ctx.globalAlpha=globalAlphaSetOut;
					globalAlphaSetOut = globalAlphaSetOut - 0.05;
				}else{
					fadeOutFlag = false;
					VSFLag = false;
					fadeReset();
				}
			
			}else{
				fadeInTime = fadeInTime -1;
				//console.log(fadeInTime );
			}
		}
		if(VSFLag){
			ctx.fillStyle="rgba(0,0,0,0.8)";
			ctx.fillRect(0,0,1280,720);
			ctx.drawImage(images[1],358,280,160,160);
			ctx.drawImage(images[2],763,280,160,160);
			ctx.font = "100px Arial";//设定字体
			ctx.fillStyle = "#FFF";//设定字颜色
			ctx.textAlign="left";//设定字居中
			ctx.fillText('VS', 580, 390);
		}
		if(globalAlphaSetIn>=1){
			globalAlphaSetIn = 0;
			fadeInFlag = false;
		}else{
			if(fadeInFlag){
				globalAlphaSetIn = globalAlphaSetIn+0.05;
			}
		}
		ctx.globalAlpha=1;
	}
	function resetFightAni(){
		whitefadeIn = true;//初始化下动画
		whiteAl = 0;
		attcackRedEffectFlag = true;
		redAl = 0;
		redfadeIn = true;
		nextTimer = 10;
	}
	function Fight(){
		if(turnEnd){
			resetFightAni();
			if(gameRound>=WMGameData.roundData.length){//回合结束
				gameEnd();
			}else{
				skillFlag = true;
				turnEnd = false;
			}
		}
		if(skillFlag){
			useSkill();
		}else if(attcackEffectFlag){
			attackEffect();
		}else if(setHPflag){
			setHP();
		}else if(!turnEnd){
	
		}
	}
	function useSkill(){
		if(fadeInFlag){
			ctx.globalAlpha=globalAlphaSetIn;
		}else{
			if(fadeInTime<=0){
				if(globalAlphaSetOut>=0){
					ctx.globalAlpha=globalAlphaSetOut;
					globalAlphaSetOut = globalAlphaSetOut - 0.05;
				}else{//动画结束后
					fadeOutFlag = false;
					skillFlag = false;
					fadeReset();
					attcackEffectFlag = true;
				}
			
			}else{
				fadeInTime = fadeInTime -1;
				//console.log(fadeInTime );
			}
		}
		if(skillFlag){
			ctx.fillStyle="rgba(0,0,0,0.8)";
			ctx.fillRect(0,0,1280,720);
			var roundUseCardIndex = WMGameData.roundData[gameRound]["cardIndex"];
			var whoUse = WMGameData.roundData[gameRound]["myTurn"];
			var useCardType = WMGameData.roundData[gameRound]["useType"]-1;
			var useCardIndex = 3;
			if(whoUse===1){
				useCardIndex = useCardIndex+WMGameData.MyCard.length;
			}
			useCardIndex = useCardIndex+roundUseCardIndex;
			ctx.drawImage(images[useCardIndex],442,43,396,556);
			ctx.font = "36px Arial";//设定字体
			ctx.fillStyle = "#FFF";//设定字颜色
			ctx.textAlign="center";//设定字居中
			ctx.fillText(skillInfo[useCardType], 645, 660);
		}
		if(globalAlphaSetIn>=1){
			globalAlphaSetIn = 0;
			fadeInFlag = false;
		}else{
			if(fadeInFlag){
				globalAlphaSetIn = globalAlphaSetIn+0.05;
			}
		}
		ctx.globalAlpha=1;
	}

	function attackEffect(){
		var whiteXY = [];
		var whoUse = WMGameData.roundData[gameRound]["myTurn"];
		if(whoUse===0){
			for(var i=0;i<MyCardXYGlobal.length;i++){
				var arrCahe = [MyCardXYGlobal[i][1],MyCardXYGlobal[i][2]];
				whiteXY.push(arrCahe);
			}
		}else{
			for(var g=0;g<EMCardXYGlobal.length;g++){
				var arrCahe_ = [EMCardXYGlobal[g][1],EMCardXYGlobal[g][2]];
				whiteXY.push(arrCahe_);
			}
		}
		for(var j=0;j<whiteXY.length;j++){
			ctx.fillStyle="rgba(255,255,255,"+whiteAl+")";
			ctx.fillRect(whiteXY[j][0],whiteXY[j][1],84,118);
		}
		if(whitefadeIn){
			whiteAl = whiteAl+0.05;
		}else{
			whiteAl = whiteAl-0.05;
		}
		if(whiteAl>=0.6){
			whiteAl = 0.6;
			whitefadeIn = false;
		}else if(whiteAl<=0){
			whiteAl = 0;
			attcackEffectFlag = false;
			setHPflag = true;
		}
	}
	var setHPflag = false;
	var HPJieSuan = 0;
	function setHP(){
		if(attcackRedEffectFlag){
			var whiteXY = [];
			var whoUse = WMGameData.roundData[gameRound]["myTurn"];
			if(whoUse===1){
				for(var i=0;i<MyCardXYGlobal.length;i++){
					var arrCahe = [MyCardXYGlobal[i][1],MyCardXYGlobal[i][2]];
					whiteXY.push(arrCahe);
				}
			}else{
				for(var g=0;g<EMCardXYGlobal.length;g++){
					var arrCahe_ = [EMCardXYGlobal[g][1],EMCardXYGlobal[g][2]];
					whiteXY.push(arrCahe_);
				}
			}
			for(var j=0;j<whiteXY.length;j++){
				ctx.fillStyle="rgba(255,0,0,"+redAl+")";
				ctx.fillRect(whiteXY[j][0],whiteXY[j][1],84,118);
			}
			if(redfadeIn){
				redAl = redAl+0.05;
			}else{
				redAl = redAl-0.05;
			}
			if(redAl>=0.6){
				redAl = 0.6;
				redfadeIn = false;
			}else if(redAl<=0){
				redAl = 0;
				attcackRedEffectFlag = false;
			}
		}
		
		
		var MyHPreFlag = false;
		var EMHPreFlag = false;
		
		var setHPX = 0;
		var whoUse = WMGameData.roundData[gameRound]["myTurn"];
		var MyHPChange = WMGameData.roundData[gameRound]["MyHP"];
		var EMHPChange = WMGameData.roundData[gameRound]["EMHP"];
		if(whoUse===0){
			setHPX = 1013;
			if(WMGameData.roundData[gameRound]["Myre"]>0){
				ctx.font = "36px Arial";//设定字体
				ctx.fillStyle = "#00ff00";//设定字颜色
				ctx.textAlign="left";//设定字居中
				ctx.fillText('+'+(WMGameData.roundData[gameRound]["Myre"]), 205, 102);
			}
		}else{
			setHPX = 205;
			if(WMGameData.roundData[gameRound]["EMre"]>0){
				ctx.font = "36px Arial";//设定字体
				ctx.fillStyle = "#00ff00";//设定字颜色
				ctx.textAlign="left";//设定字居中
				ctx.fillText('+'+(WMGameData.roundData[gameRound]["EMre"]), 1013, 102);
			}
		}
		ctx.font = "36px Arial";//设定字体
		ctx.fillStyle = "#ff0000";//设定字颜色
		ctx.textAlign="left";//设定字居中
		ctx.fillText(-WMGameData.roundData[gameRound]["attack"], setHPX, 102);
		if(MyHPChange<=0){
			MyHPChange = 0;
		}
		if(EMHPChange<=0){
			EMHPChange = 0;
		}
		MyHP = MyHPChange;
		EMHP = EMHPChange;
		nextTimer = nextTimer-0.2;
		if(nextTimer<=0){
			turnEnd =true;
			gameRound++;
			setHPflag = false;
		}
	}
	function gameEnd(){
		if(fadeInFlag){
			ctx.globalAlpha=globalAlphaSetIn;
		}else{
			if(fadeInTime<=0){
					fadeOutFlag = false;
					fadeReset();
					gameOverFlag = true;
					cancelAnimationFrame(gameTimer);
					console.log('end');
					getNewCardList();
					setTimeout(function(){
						$('.wm_card_game_body').fadeOut(500);
					},1000)
			
			}else{
				fadeInTime = fadeInTime -1;
				//console.log(fadeInTime );
			}
		}

		ctx.fillStyle="rgba(0,0,0,0.8)";
		ctx.fillRect(0,0,1280,720);
		ctx.drawImage(images[1],569,236,160,160);
		ctx.font = "36px Arial";//设定字体
		ctx.fillStyle = "#fff";//设定字颜色
		ctx.textAlign="center";//设定字居中
		var winText = '';
		if(WMGameData.Win==0){
			winText = '胜利！';
		}else if(WMGameData.Win==1){
			winText = '失败！';
		}else{
			winText = '平局';
		}
		ctx.fillText(winText, 665, 180);
		ctx.fillText('原竞技点（增减）：'+WMGameData.MyScoreOrigin+'('+WMGameData.MyGetScore+')', 650, 455);
		ctx.fillText('获得经验值：'+WMGameData.GETEXP, 650, 515);
		ctx.fillText('当前等级：'+WMGameData.MyLevel, 650, 575);
		
			

		if(globalAlphaSetIn>=1){
			globalAlphaSetIn = 0;
			fadeInFlag = false;
		}else{
			if(fadeInFlag){
				globalAlphaSetIn = globalAlphaSetIn+0.05;
			}
		}
		ctx.globalAlpha=1;
	}
	//gameInit('97eb21cf0bacc7c517bd3b9d716c69b1','0b8f57c2844f330d6a36cbcf79271543');
});
