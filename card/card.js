// JavaScript Document
!function(n){"use strict";function t(n,t){var r=(65535&n)+(65535&t);return(n>>16)+(t>>16)+(r>>16)<<16|65535&r}function r(n,t){return n<<t|n>>>32-t}function e(n,e,o,u,c,f){return t(r(t(t(e,n),t(u,f)),c),o)}function o(n,t,r,o,u,c,f){return e(t&r|~t&o,n,t,u,c,f)}function u(n,t,r,o,u,c,f){return e(t&o|r&~o,n,t,u,c,f)}function c(n,t,r,o,u,c,f){return e(t^r^o,n,t,u,c,f)}function f(n,t,r,o,u,c,f){return e(r^(t|~o),n,t,u,c,f)}function i(n,r){n[r>>5]|=128<<r%32,n[14+(r+64>>>9<<4)]=r;var e,i,a,d,h,l=1732584193,g=-271733879,v=-1732584194,m=271733878;for(e=0;e<n.length;e+=16)i=l,a=g,d=v,h=m,g=f(g=f(g=f(g=f(g=c(g=c(g=c(g=c(g=u(g=u(g=u(g=u(g=o(g=o(g=o(g=o(g,v=o(v,m=o(m,l=o(l,g,v,m,n[e],7,-680876936),g,v,n[e+1],12,-389564586),l,g,n[e+2],17,606105819),m,l,n[e+3],22,-1044525330),v=o(v,m=o(m,l=o(l,g,v,m,n[e+4],7,-176418897),g,v,n[e+5],12,1200080426),l,g,n[e+6],17,-1473231341),m,l,n[e+7],22,-45705983),v=o(v,m=o(m,l=o(l,g,v,m,n[e+8],7,1770035416),g,v,n[e+9],12,-1958414417),l,g,n[e+10],17,-42063),m,l,n[e+11],22,-1990404162),v=o(v,m=o(m,l=o(l,g,v,m,n[e+12],7,1804603682),g,v,n[e+13],12,-40341101),l,g,n[e+14],17,-1502002290),m,l,n[e+15],22,1236535329),v=u(v,m=u(m,l=u(l,g,v,m,n[e+1],5,-165796510),g,v,n[e+6],9,-1069501632),l,g,n[e+11],14,643717713),m,l,n[e],20,-373897302),v=u(v,m=u(m,l=u(l,g,v,m,n[e+5],5,-701558691),g,v,n[e+10],9,38016083),l,g,n[e+15],14,-660478335),m,l,n[e+4],20,-405537848),v=u(v,m=u(m,l=u(l,g,v,m,n[e+9],5,568446438),g,v,n[e+14],9,-1019803690),l,g,n[e+3],14,-187363961),m,l,n[e+8],20,1163531501),v=u(v,m=u(m,l=u(l,g,v,m,n[e+13],5,-1444681467),g,v,n[e+2],9,-51403784),l,g,n[e+7],14,1735328473),m,l,n[e+12],20,-1926607734),v=c(v,m=c(m,l=c(l,g,v,m,n[e+5],4,-378558),g,v,n[e+8],11,-2022574463),l,g,n[e+11],16,1839030562),m,l,n[e+14],23,-35309556),v=c(v,m=c(m,l=c(l,g,v,m,n[e+1],4,-1530992060),g,v,n[e+4],11,1272893353),l,g,n[e+7],16,-155497632),m,l,n[e+10],23,-1094730640),v=c(v,m=c(m,l=c(l,g,v,m,n[e+13],4,681279174),g,v,n[e],11,-358537222),l,g,n[e+3],16,-722521979),m,l,n[e+6],23,76029189),v=c(v,m=c(m,l=c(l,g,v,m,n[e+9],4,-640364487),g,v,n[e+12],11,-421815835),l,g,n[e+15],16,530742520),m,l,n[e+2],23,-995338651),v=f(v,m=f(m,l=f(l,g,v,m,n[e],6,-198630844),g,v,n[e+7],10,1126891415),l,g,n[e+14],15,-1416354905),m,l,n[e+5],21,-57434055),v=f(v,m=f(m,l=f(l,g,v,m,n[e+12],6,1700485571),g,v,n[e+3],10,-1894986606),l,g,n[e+10],15,-1051523),m,l,n[e+1],21,-2054922799),v=f(v,m=f(m,l=f(l,g,v,m,n[e+8],6,1873313359),g,v,n[e+15],10,-30611744),l,g,n[e+6],15,-1560198380),m,l,n[e+13],21,1309151649),v=f(v,m=f(m,l=f(l,g,v,m,n[e+4],6,-145523070),g,v,n[e+11],10,-1120210379),l,g,n[e+2],15,718787259),m,l,n[e+9],21,-343485551),l=t(l,i),g=t(g,a),v=t(v,d),m=t(m,h);return[l,g,v,m]}function a(n){var t,r="",e=32*n.length;for(t=0;t<e;t+=8)r+=String.fromCharCode(n[t>>5]>>>t%32&255);return r}function d(n){var t,r=[];for(r[(n.length>>2)-1]=void 0,t=0;t<r.length;t+=1)r[t]=0;var e=8*n.length;for(t=0;t<e;t+=8)r[t>>5]|=(255&n.charCodeAt(t/8))<<t%32;return r}function h(n){return a(i(d(n),8*n.length))}function l(n,t){var r,e,o=d(n),u=[],c=[];for(u[15]=c[15]=void 0,o.length>16&&(o=i(o,8*n.length)),r=0;r<16;r+=1)u[r]=909522486^o[r],c[r]=1549556828^o[r];return e=i(u.concat(d(t)),512+8*t.length),a(i(c.concat(e),640))}function g(n){var t,r,e="";for(r=0;r<n.length;r+=1)t=n.charCodeAt(r),e+="0123456789abcdef".charAt(t>>>4&15)+"0123456789abcdef".charAt(15&t);return e}function v(n){return unescape(encodeURIComponent(n))}function m(n){return h(v(n))}function p(n){return g(m(n))}function s(n,t){return l(v(n),v(t))}function C(n,t){return g(s(n,t))}function A(n,t,r){return t?r?s(t,n):C(t,n):r?m(n):p(n)}"function"==typeof define&&define.amd?define(function(){return A}):"object"==typeof module&&module.exports?module.exports=A:n.md5=A}(this);
//# sourceMappingURL=md5.min.js.map
(function($){
	$.fn.rotate_box = function(){
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
			setTimeout(function(){
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
					deg += 3;
					rotate();
				} else if( deg < 360 && deg > 45 ) {
					deg += 1;
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
			}, 5);
		};
		
		rotate();
	};
})(jQuery);

var chiosed = false;
var wmcardAllInfoArr = [];//卡牌与卡牌数量的合集
var showedWmCard = 0;//显示多少张
var wmPageSize = 8;//一次显示多少张

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
				$('#wm_mylist_title').text('您的当前信息');
				if(addrsearch){
					var usernick = GetQueryString('usernick');
					if(usernick){
						usernick = urldecode(usernick);
						$('.wm_user_info_table').show();
						$('.wm_tiaozhan_body').show();
						$('#wm_mylist_title').text(usernick + '的当前信息');
					}else{
						$('.wm_user_info_table').hide();
						$('.wm_tiaozhan_body').hide();
						$('#wm_mylist_title').text('您的当前信息');
					}
				}else if(newListSearch){
					$('.wm_user_info_table').show();
					$('.wm_tiaozhan_body').hide();
					$('#wm_mylist_title').text('TA的当前信息');
				}else{
					$('.wm_tiaozhan_body').hide();
				}
				$('#wm_mylist_title').fadeIn(500);
				var wmcard = result.data;
				$('.wm_user_level').empty().text(result.level);
				$('.wm_user_score').empty().text(result.score);
				$('.wm_user_info_table').show();
				$('.wm_user_info_body').fadeIn(300);
				var wmcardarr = wmcard.split(",");
				var wmcardCount = result.cardCount;
				var wmcardCountarr = wmcardCount.split(",");
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
			alert('网络异常！');
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
		var html_ = '<a href="'+wmCardPluginpath+'/card/img/'+wmcardAllInfoArr[i+wmAddCount][0]+'.jpg" class="wm_getcard_box" style="display:none;" target="_blank"><img class="wm_getcard_img" src="'+wmCardPluginpath+'/card/img/'+wmcardAllInfoArr[i+wmAddCount][0]+'.jpg"><br><span class="wm_card_nums">×'+wmcardAllInfoArr[i+wmAddCount][1]+'</span></a>';
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
				var delay = 0;
				for(var i=0;i<result.length;i++){
					var getText = '虽然卡牌星级不高，但是我也很喜欢！';
					var wmSixStarCardShake = '';
					if(result[i].cardInfo.star===4){
						getText = '不好不差，证明我既不是非洲人也不是欧洲人。'
					}else if(result[i].cardInfo.star===5){
						getText = '运气不错，距离欧皇就差一点点。'
					}else if(result[i].cardInfo.star>=6){
						getText = '欧气满满，欧耶~';
						wmSixStarCardShake = ' wm_six_star_card_shake'
					}
					var listHtml = '<div class="wm_card_get_list_item"><div class="wm_card_get_list_avatar"><img class="wm_card_get_list_avatar_pic" src="https://www.gravatar.com/avatar/'+result[i].mailMD5+'?s=100&d=mm&r=g&d=robohash" width="45" height="45" title="查看TA的卡牌" data-md5="'+result[i].mailMD5+'" /></div><div class="wm_card_get_list_comment">我抽中了出自作品《'+result[i].cardInfo.title+'》的'+result[i].cardInfo.star+'星卡<a href="'+wmCardPluginpath+'/card/img/'+result[i].cardID+'.jpg" class="wm_card_get_list_card_link'+wmSixStarCardShake+'" target="_blank">'+result[i].cardInfo.name+'</a>。'+getText+'</div></div>'
					$('#wmCardGetList').append(listHtml);
					$('.wm_card_get_list_item').last().delay(delay).fadeIn(600);
					delay = delay + 500;
				}
			}
		},
		dataType: 'json'
	});
}
$(document).ready(function(e) {
	//绑定更多事件
	$('#wm_cardmore_btn').on('click',function(){
		showWmCard();
	})
	// 查看最新抽卡动态的所获卡牌
	$('#wmCardGetList').on('click','.wm_card_get_list_avatar_pic',function(){
		var addrmd5 = $(this).attr('data-md5');
		wmsearchCard(addrmd5,false,true);
		$('html, body').animate({scrollTop: $('#wmGetCard').offset().top+210}, 300);
	})
	//获取最新抽卡动态
	getNewCardList();
	//挑战
	var addrmd5 = GetQueryString('useraddr');
	if(addrmd5){
		wmsearchCard(addrmd5,true);
	}
	$('#wm_tiaozhan_btn').on('click',function(){
		var wmEmail = $('#wm_tiaozhan_email').val();
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmEmail === ""){ //输入不能为空
	　　　　alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
	　　　　alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
			var MyEmailMD5 = md5(wmEmail);
			var EMEmailMD5 = addrmd5;
			gameInit(MyEmailMD5,EMEmailMD5);
			
		}
	});
	
   $('#wmGetCard').on('click',function(){
		if(chiosed){
			return false;
		}
		var wmCardPluginpath_ = wmCardPluginpath + 'cardCallback.php';
		var wmEmail = $('#wm_card_email').val();
		//console.log(wmEmail);
		var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
		if(wmEmail === ""){ //输入不能为空
	　　　　alert("邮箱地址不能为空");
	　　　　return false;
	　　}else if(!reg.test(wmEmail)){ //正则验证不通过，格式不对
	　　　　alert("邮箱地址有误!");
	　　　　return false;
	　　}else{
		chiosed = true;
		$('#wmCardLoading').stop(true, false).delay(800).fadeIn(100);
	　　　　$.ajax({
			  type: 'POST',
			  url: wmCardPluginpath_,
			  data: {email:wmEmail},
			  success: function(result){
				  console.log(result);
				  //0为邮箱地址为空，1为邮箱地址不合格，2为今天已经抽过了，3为评论表里找不到邮箱地址，202
				  $('#wmCardLoading').stop(true, false).fadeOut(100);
				  if(result.code == '0'){
					  alert('邮箱地址为空');
					  chiosed = false;
				  }else if(result.code == '1'){
					  alert('为邮箱地址不正确');
					  chiosed = false;
				  }else if(result.code == '2'){
					  alertTitle('您已经超过每天的抽卡次数')
					  chiosed = false;
					  var emailmd5_ = result.emailmd5;
					  wmsearchCard(emailmd5_);
				  }else if(result.code == '3'){
					  alert('请先在文章中评论并等待管理员审核后抽卡');
					  chiosed = false;
				  }else if(result.code == '202'){
					  alertTitle('快看看都抽到了什么吧！')
					  var cardId = result.card;
					  var imgSrc = wmCardPluginpath+'/card/img/'+ cardId+'.jpg';
					  var emailmd5_ = result.emailmd5;				
					  $('#wm_card_img').attr('src',imgSrc);
					  $('#wm_card_email').hide(300);
					  $('#wmGetCard').rotate_box();
					  chiosed = true;
					  wmsearchCard(emailmd5_);
					  getNewCardList();
				  }else{
					  alert('未知错误 请联系管理员');
				  }
			  },
			  error:function(){
				  chiosed = false;
				  alert('网络异常！');
				  $('#wmCardLoading').stop(true, false).fadeOut(100);
			  },
			  dataType: 'json'
		   });
	　　}
		 
	});
	
 
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
		var MyIco = 'https://www.gravatar.com/avatar/'+Mymd5+'?s=300&d=mm&r=g&d=robohash';
		var EMIco = 'https://www.gravatar.com/avatar/'+EMmd5+'?s=300&d=mm&r=g&d=robohash';
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
							thisAddr = wmCardPluginpath+'/card/img/'+MycardAddrArr[i]+'.jpg';
							imgSrcArr.push(thisAddr);
						}
									
						for(var j =0;j<EMcardAddrArr.length;j++){
							thisAddr = wmCardPluginpath+'/card/img/'+EMcardAddrArr[j]+'.jpg';
							imgSrcArr.push(thisAddr);
						}
						
						loading(imgSrcArr);
					}else if(result.code="1"){
						alert('双方有一方并没有牌或者地址有误');
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
