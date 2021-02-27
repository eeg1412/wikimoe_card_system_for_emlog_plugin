<?php
require_once('../../../init.php');
require_once('module.php');
function wmBouerseNews($wmNewsInfo){
	if(file_exists('bouerseNews.json')){//判断json文件是否存在
		$wmBouerseNewsList = json_decode(file_get_contents('bouerseNews.json'),true);
		$wmBouerseNewsList = array_merge($wmNewsInfo,$wmBouerseNewsList);
		if(count($wmBouerseNewsList)>20){
			$wmBouerseNewsList = array_slice($wmBouerseNewsList,0,20);
		}
		file_put_contents('bouerseNews.json', json_encode($wmBouerseNewsList),LOCK_EX);
	}else{
		file_put_contents('bouerseNews.json', json_encode($wmNewsInfo),LOCK_EX);
	}
}
function wmBouerse($getMode,$updataMode){
    if(file_exists('bouerse.json')){//判断json文件是否存在
		$bourseListJson = json_decode(file_get_contents('bouerse.json'),true);
		$bourseTime = $bourseListJson['updateTime'];
		$bourseNowTime = time();
		if($bourseNowTime - $bourseTime>1800){//如果有30分钟没更新了
			$bourseRunTime = intval(($bourseNowTime - $bourseTime)/1800);//间隔几个30分钟
			if($bourseRunTime>100){//最多刷新一天份
				$bourseRunTime = 100;
			}
			$bourseList = $bourseListJson['data'];
			for($j=0;$j<$bourseRunTime;$j++){
				for($i=0; $i<count($bourseList); $i++){
					if($bourseList[$i]['bankrupted']===0){//判断是否破产
						$gailvYinzi = 0;
						if($bourseList[$i]['preTrans']!=0){
							$gailvYinzi = $bourseList[$i]['trans'] - $bourseList[$i]['preTrans'];
							if($gailvYinzi>150){
								$gailvYinzi = 150;
							}else if($gailvYinzi<-150){
								$gailvYinzi = -150;
							}
						}
						$upOrDown = BouerseGailv($gailvYinzi);
						$upDownLiang = mt_rand(0, 5);
						if($upOrDown===0){
							$bourseList[$i]['prePrice'] = $bourseList[$i]['price'];
							$bourseList[$i]['price'] = $bourseList[$i]['price'] + $upDownLiang>233?233:$bourseList[$i]['price'] + $upDownLiang;
							array_push($bourseList[$i]['history'],$bourseList[$i]['price']);
							if(count($bourseList[$i]['history'])>100){
								array_shift($bourseList[$i]['history']);
							}
						}else{
							$bourseList[$i]['prePrice'] = $bourseList[$i]['price'];
							$bourseList[$i]['price'] = $bourseList[$i]['price'] - $upDownLiang<1?1:$bourseList[$i]['price'] - $upDownLiang;
							array_push($bourseList[$i]['history'],$bourseList[$i]['price']);
							if(count($bourseList[$i]['history'])>100){
								array_shift($bourseList[$i]['history']);
							}
						}
						if($bourseList[$i]['price']<=1){//如果价格小于等于1则破产
							//产生新的股票
							$noBankrupted = wmKeyForobject($bourseList,'bankrupted',1);
							$randomBouerseIndex = mt_rand(0, count($noBankrupted)-1);
							$newBouerseId = $noBankrupted[$randomBouerseIndex]['id'];
							$isBankrupted = false;//是否是破产重组
							if($bourseList[$newBouerseId]['price']<=1){
								$isBankrupted = true;
								$bourseList[$newBouerseId]['prePrice'] = $bourseList[$newBouerseId]['price'];
								$randomBouersePriceYinzi = mt_rand(1, 100);
								$randomBouersePriceAdd = 0;
								if($randomBouersePriceYinzi>98){
									$randomBouersePriceAdd = 40;
								}else if($randomBouersePriceYinzi>=91&&$randomBouersePriceYinzi>=98){
									$randomBouersePriceAdd = 15;
								}
								//随机重组金额
								$randomBouersePrice = mt_rand(10, 15);
								$randomBouersePrice = $randomBouersePrice + $randomBouersePriceAdd;
								$bourseList[$newBouerseId]['price'] = $randomBouersePrice;
								array_push($bourseList[$newBouerseId]['history'],$bourseList[$newBouerseId]['price']);
								if(count($bourseList[$newBouerseId]['history'])>100){
									array_shift($bourseList[$newBouerseId]['history']);
								}
							}
							$bourseList[$newBouerseId]['bankrupted'] = 0;
							$bourseList[$i]['bankrupted'] = 1;
							$bourseNewsText = '';
							if($isBankrupted){//如果是破产重组
								$bourseNewsText = $bourseList[$newBouerseId]['name'].'股已成功重组并上市，初始股价为'.$randomBouersePrice;
							}else{
								$bourseNewsText = $bourseList[$newBouerseId]['name'].'股已上市。';
							}
							$newsTime = intval($bourseNowTime - ($bourseNowTime%1800));
							$newsBankruptedText = $bourseList[$i]['name'].'股已破产，进入重组阶段。';
							$bourseNewsArr = array(array('time'=>$newsTime,'text'=>$bourseNewsText),array('time'=>$newsTime,'text'=>$newsBankruptedText));
							wmBouerseNews($bourseNewsArr);
						}
						$bourseList[$i]['preTrans'] = $bourseList[$i]['trans'];
					}
				}
			}
			$bourseNowTime_ = intval($bourseNowTime - ($bourseNowTime%1800));//矫正到三十分
			$wmBouerseData = array('data'=>$bourseList , 'updateTime'=>$bourseNowTime_);
			file_put_contents('bouerse.json', json_encode($wmBouerseData),LOCK_EX);
		}
		
    }else{
        initBouerse();
	}
	if(!$updataMode){
		$bourseListOutData = json_decode(file_get_contents('bouerse.json'),true);
		$initBouerseData_ = json_decode(file_get_contents('initBouerList.json'),true);
		$bourseListOutDataCount = count($bourseListOutData['data']);
		if(count($initBouerseData_['data'])>$bourseListOutDataCount){
			$addBouerseLength = count($initBouerseData_['data']) - $bourseListOutDataCount;
			for($k=0;$k<$addBouerseLength;$k++){
				$addBouerseData = $initBouerseData_['data'][$bourseListOutDataCount+$k];
				array_push($bourseListOutData['data'],$addBouerseData);
				file_put_contents('bouerse.json', json_encode($bourseListOutData),LOCK_EX);
			}
		}
		//过滤仅显示未破产的
		$bourseListOutData['data'] = wmKeyForobject($bourseListOutData['data'],'bankrupted',0);
		$bouerseOutData = array('listData'=>$bourseListOutData);
		if($getMode){
			echo json_encode($bouerseOutData);
		}else{
			return $bouerseOutData;
		}
	}
	
}
function wmSearchUserBouerse(){
	$DB = Database::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
				$bouerseOutData = wmBouerse(false,false);
				$userBouerseInfo = $mgidinfo['bouerse'];
				$userBouerseInfoObject = null;
				$userBouerseInfoForId = '';
				if($userBouerseInfo!=''){
					$userBouerseInfoObject = json_decode($userBouerseInfo,true);
					$userBouerseInfoForId = array();
					//过滤仅输出上市的
					for($i=0; $i<count($bouerseOutData['listData']['data']); $i++){
						if(isset($userBouerseInfoObject[$bouerseOutData['listData']['data'][$i]['id']])){
							$userObjectSingle = $userBouerseInfoObject[$bouerseOutData['listData']['data'][$i]['id']];
							$userObjectSingle['id'] = $bouerseOutData['listData']['data'][$i]['id'];
							array_push($userBouerseInfoForId,$userObjectSingle);
						}else{
							array_push($userBouerseInfoForId,null);
						}
					}
				}
				$bourseListNewsData = '';
				if(file_exists('bouerseNews.json')){//判断json文件是否存在
					$bourseListNewsData = json_decode(file_get_contents('bouerseNews.json'),true);
				}
				$userStar = $mgidinfo['starCount'];
				$bouerseOutData['code'] = 202;
				$bouerseOutData['news'] = $bourseListNewsData;
				$bouerseOutData['starCount'] = $userStar;
				$bouerseOutData['bouerse'] = $userBouerseInfoForId;
				echo json_encode($bouerseOutData);
			}else{
				$bouerseOutData = array('code'=>3);//无该用户
                echo json_encode($bouerseOutData);
			}
		}else{
			$bouerseOutData = array('code'=>2);//邮箱有误
            echo json_encode($bouerseOutData);
		}
	}else{
		$bouerseOutData = array('code'=>2);//邮箱有误
        echo json_encode($bouerseOutData);
	}
}
function initBouerse(){
	$initBouerseData = json_decode(file_get_contents('initBouerList.json'),true);
	for($i=0; $i<15; $i++){
        $initBouerseData['data'][$i]['bankrupted'] = 0;
    }
	$initNowTime = time();
	$initBouerseData['updateTime'] = $initNowTime - ($initNowTime % 1800);
    file_put_contents('bouerse.json', json_encode($initBouerseData),LOCK_EX);
}
function BouerseGailv($gailvYinzi){
	$randN = mt_rand(1, 1000);
	
    if($randN>(500-$gailvYinzi)){
        return 0;
    }else{
        return 1;
    }
}
function wmBuyBouerse(){
	$DB = Database::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
				$password = intval($_POST['password']);
				$bdPassword = intval($mgidinfo['verifyCode']);
                if($password==$bdPassword&&$bdPassword!=0){
                    $timeStamp = time();
                    $passwordTime = intval($mgidinfo['verifyCodeStamp']);
                    $verifyCodeRemember = intval($mgidinfo['verifyCodeRemember']);
                    if((($timeStamp - $passwordTime)<1800&&($timeStamp - $passwordTime)>0)||$verifyCodeRemember==1){
						wmBouerse(false,true);
						$buyId = intval($_POST['id']);
						$buyPrice = intval($_POST['price']);
						$buyValue = intval($_POST['value']);
						$bourseListOrigin = json_decode(file_get_contents('bouerse.json'),true);
						$bourseList = $bourseListOrigin['data'];
						$myStar = intval($mgidinfo['starCount']);
						if(!isset($bourseList[$buyId])){
							
							$bouerseOutData = array('code'=>4);//无该股票
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['bankrupted']==1){
							$bouerseOutData = array('code'=>4);//破产股票
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['price']!=$buyPrice){
							$bouerseOutData = array('code'=>6);//价格对不上
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['price']<=10){
							$bouerseOutData = array('code'=>5);//价格过低无法购买
							echo json_encode($bouerseOutData);
							return false;
						}
						if($buyValue<=0){
							$bouerseOutData = array('code'=>7);//购买数量不能为0
							echo json_encode($bouerseOutData);
							return false;
						}
						$shoudStar = $bourseList[$buyId]['price'] * $buyValue;
						if($shoudStar>$myStar){
							$bouerseOutData = array('code'=>8);//星星不足
							echo json_encode($bouerseOutData);
							return false;
						}
						$mybouerse = $mgidinfo['bouerse'];
						if($mgidinfo['bouerse']==''){
							$mybouerse = '{}';
						}
						$mybouerse = json_decode($mybouerse,true);
						if(!isset($mybouerse[$buyId])){//如果用户没有该股票信息
							if($buyValue>9){
								$bouerseOutData = array('code'=>9);//已经超过购买上限
								echo json_encode($bouerseOutData);
								return false;
							}
							//购买信息：时间、价格、多少股、花费、类型（0买1卖）
							$mybouerse[$buyId] = array('have'=>$buyValue , 'exData'=>array(array($timeStamp,$bourseList[$buyId]['price'],$buyValue,$shoudStar,0)));
						}else{
							$mybouerse[$buyId]['have'] = $mybouerse[$buyId]['have'] + $buyValue;
							if($mybouerse[$buyId]['have']>9){
								$bouerseOutData = array('code'=>9);//已经超过购买上限
								echo json_encode($bouerseOutData);
								return false;
							}
							array_push($mybouerse[$buyId]['exData'],array($timeStamp,$bourseList[$buyId]['price'],$buyValue,$shoudStar,0));
							if(count($mybouerse[$buyId]['exData'])>10){
								array_shift($mybouerse[$buyId]['exData']);
							}
						}
						$starCountAfter = $myStar - $shoudStar;
						$databaseBouerse = json_encode($mybouerse);
						$verifyCodeRemember = intval($mgidinfo['verifyCodeRemember']);
						$rememberPass = intval($_POST['rememberPass']);
						//如果保存密码的话则verifyCodeRemember为1
						$verifyCodeRemember = 0;
						if($rememberPass==1){
							$verifyCodeRemember = 1;
						}
						$wmBourseNowTrans = $bourseListOrigin['data'][$buyId]['trans'] + $buyValue;
						$bourseListOrigin['data'][$buyId]['trans'] = $wmBourseNowTrans;
						file_put_contents('bouerse.json', json_encode($bourseListOrigin),LOCK_EX);
						$query = "Update ".DB_PREFIX."wm_card set verifyCodeRemember='".$verifyCodeRemember."' , starCount=".$starCountAfter." , bouerse='".$databaseBouerse."' where email=".$emailAddrMd5."";
						$result=$DB->query($query);
						$cardJsonData = array('mailMD5'=>md5($emailAddr),'name'=>$bourseList[$buyId]['name'],'value'=>$buyValue,'useStar'=>$shoudStar,'massageType'=>'bouerseBuy');
						wmWriteJson($cardJsonData);
						$bouerseOutData = array('code'=>202);//成功
						echo json_encode($bouerseOutData);
					}else{
						//密码不对
						$bouerseOutData = array('code'=>301);
						echo json_encode($bouerseOutData);
					}
				}else{
					//密码不对
                    $bouerseOutData = array('code'=>301);
					echo json_encode($bouerseOutData);
				}
			}else{
				$bouerseOutData = array('code'=>3);//无该用户
                echo json_encode($bouerseOutData);
			}
		}else{
			$bouerseOutData = array('code'=>2);//邮箱有误
            echo json_encode($bouerseOutData);
		}
	}else{
		$bouerseOutData = array('code'=>2);//邮箱有误
        echo json_encode($bouerseOutData);
	}
}
function wmSellBouerse(){
	$DB = Database::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
				$password = intval($_POST['password']);
				$bdPassword = intval($mgidinfo['verifyCode']);
                if($password==$bdPassword&&$bdPassword!=0){
                    $timeStamp = time();
                    $passwordTime = intval($mgidinfo['verifyCodeStamp']);
                    $verifyCodeRemember = intval($mgidinfo['verifyCodeRemember']);
                    if((($timeStamp - $passwordTime)<1800&&($timeStamp - $passwordTime)>0)||$verifyCodeRemember==1){
						wmBouerse(false,true);
						$buyId = intval($_POST['id']);
						$buyPrice = intval($_POST['price']);
						$buyValue = intval($_POST['value']);
						$bourseListOrigin = json_decode(file_get_contents('bouerse.json'),true);
						$bourseList = $bourseListOrigin['data'];
						$myStar = intval($mgidinfo['starCount']);
						if(!isset($bourseList[$buyId])){
							
							$bouerseOutData = array('code'=>4);//无该股票
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['bankrupted']==1){
							$bouerseOutData = array('code'=>4);//破产股票
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['price']!=$buyPrice){
							$bouerseOutData = array('code'=>6);//价格对不上
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['price']<=10){
							$bouerseOutData = array('code'=>5);//价格过低无法交易
							echo json_encode($bouerseOutData);
							return false;
						}
						if($buyValue<=0){
							$bouerseOutData = array('code'=>7);//购买数量不能为0
							echo json_encode($bouerseOutData);
							return false;
						}
						$mybouerse = $mgidinfo['bouerse'];
						if($mgidinfo['bouerse']==''){
							$mybouerse = '{}';
						}
						$mybouerse = json_decode($mybouerse,true);
						if(!isset($mybouerse[$buyId])){//如果用户没有该股票信息
							$bouerseOutData = array('code'=>9);//没有那么多持有
							echo json_encode($bouerseOutData);
							return false;
						}
						$havBouerseAfter = $mybouerse[$buyId]['have'] - $buyValue;
						if($havBouerseAfter<0){
							$bouerseOutData = array('code'=>9);//没有那么多持有
							echo json_encode($bouerseOutData);
							return false;
						}
						$getStar = $bourseList[$buyId]['price'] * $buyValue;
						$wmFee = round($getStar*0.05);
						if($wmFee<20){
							$wmFee =20;
						}
						$getStar = intval($getStar - $wmFee);//扣除税
						if($getStar<=0){
							$bouerseOutData = array('code'=>10);//卖出不够税
							echo json_encode($bouerseOutData);
							return false;
						}
						array_push($mybouerse[$buyId]['exData'],array($timeStamp,$bourseList[$buyId]['price'],$buyValue,$getStar,1));
						if(count($mybouerse[$buyId]['exData'])>10){
							array_shift($mybouerse[$buyId]['exData']);
						}
						$mybouerse[$buyId]['have'] = $havBouerseAfter;
						$starCountAfter = $myStar + $getStar;
						$databaseBouerse = json_encode($mybouerse);
						$verifyCodeRemember = intval($mgidinfo['verifyCodeRemember']);
						$rememberPass = intval($_POST['rememberPass']);
						//如果保存密码的话则verifyCodeRemember为1
						$verifyCodeRemember = 0;
						if($rememberPass==1){
							$verifyCodeRemember = 1;
						}
						$wmBourseNowTrans = $bourseListOrigin['data'][$buyId]['trans'] - $buyValue;
						if($wmBourseNowTrans<0){
							$wmBourseNowTrans = 0;
						}
						$bourseListOrigin['data'][$buyId]['trans'] = $wmBourseNowTrans;
						file_put_contents('bouerse.json', json_encode($bourseListOrigin),LOCK_EX);
						$query = "Update ".DB_PREFIX."wm_card set verifyCodeRemember='".$verifyCodeRemember."' , starCount=".$starCountAfter." , bouerse='".$databaseBouerse."' where email=".$emailAddrMd5."";
						$result=$DB->query($query);
						$cardJsonData = array('mailMD5'=>md5($emailAddr),'name'=>$bourseList[$buyId]['name'],'value'=>$buyValue,'useStar'=>$getStar,'massageType'=>'bouerseSell');
						wmWriteJson($cardJsonData);
						$bouerseOutData = array('code'=>202);//成功
						echo json_encode($bouerseOutData);
					}else{
						//密码不对
						$bouerseOutData = array('code'=>301);
						echo json_encode($bouerseOutData);
					}
				}else{
					//密码不对
                    $bouerseOutData = array('code'=>301);
					echo json_encode($bouerseOutData);
				}
			}else{
				$bouerseOutData = array('code'=>3);//无该用户
                echo json_encode($bouerseOutData);
			}
		}else{
			$bouerseOutData = array('code'=>2);//邮箱有误
            echo json_encode($bouerseOutData);
		}
	}else{
		$bouerseOutData = array('code'=>2);//邮箱有误
        echo json_encode($bouerseOutData);
	}
}
if(isset($_POST['type']) && isset($_POST['email'])){
	if($_POST['type']=='search'){
		wmSearchUserBouerse();
	}else if($_POST['type']=='buy'){
		if(isset($_POST['id'])&&isset($_POST['price'])&&isset($_POST['value'])&&isset($_POST['password'])&&isset($_POST['rememberPass'])){
			wmBuyBouerse();
		}
	}else if($_POST['type']=='sell'){
		if(isset($_POST['id'])&&isset($_POST['price'])&&isset($_POST['value'])&&isset($_POST['password'])&&isset($_POST['rememberPass'])){
			wmSellBouerse();
		}
	}
}else{
	wmBouerse(true,false);
}
?>