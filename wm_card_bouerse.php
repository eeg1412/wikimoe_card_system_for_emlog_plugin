<?php
require_once('../../../init.php');
require_once('module.php');
function wmBouerse($getMode){
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
						$bourseList[$i]['price'] = $bourseList[$i]['price'] + $upDownLiang>999?999:$bourseList[$i]['price'] + $upDownLiang;
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
					$bourseList[$i]['preTrans'] = $bourseList[$i]['trans'];
				}
			}
			$bourseNowTime_ = intval($bourseNowTime - ($bourseNowTime%1800));//矫正到三十分
			$wmBouerseData = array('data'=>$bourseList , 'updateTime'=>$bourseNowTime_);
			file_put_contents('bouerse.json', json_encode($wmBouerseData),LOCK_EX);
		}
		
    }else{
        initBouerse();
	}
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
	$bouerseOutData = array('listData'=>$bourseListOutData);
	if($getMode){
		echo json_encode($bouerseOutData);
	}else{
		return $bouerseOutData;
	}
}
function wmSearchUserBouerse(){
	$DB = MySql::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
				$bouerseOutData = wmBouerse(false);
				$userBouerseInfo = $mgidinfo['bouerse'];
				$userStar = $mgidinfo['starCount'];
				$bouerseOutData['code'] = 202;
				$bouerseOutData['starCount'] = $userStar;
				$bouerseOutData['bouerse'] = $userBouerseInfo;
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
	$DB = MySql::getInstance();
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
						if($bourseList[$buyId]['price']<10){
							$bouerseOutData = array('code'=>5);//价格过低无法购买
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['price']!=$buyPrice){
							$bouerseOutData = array('code'=>6);//价格对不上
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
							$mybouerse[$buyId] = array('have'=>$buyValue , 'exData'=>'');
						}else{
							$mybouerse[$buyId]['have'] = $mybouerse[$buyId]['have'] + $buyValue;
							if($mybouerse[$buyId]['have']>999){
								$bouerseOutData = array('code'=>9);//已经超过购买上限
								echo json_encode($bouerseOutData);
								return false;
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
	$DB = MySql::getInstance();
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
						if($bourseList[$buyId]['price']<10){
							$bouerseOutData = array('code'=>5);//价格过低无法交易
							echo json_encode($bouerseOutData);
							return false;
						}
						if($bourseList[$buyId]['price']!=$buyPrice){
							$bouerseOutData = array('code'=>6);//价格对不上
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
						$havBouerseAfter = $mybouerse[$buyId]['have'] - $buyValue;
						if($havBouerseAfter<0){
							$bouerseOutData = array('code'=>9);//没有那么多持有
							echo json_encode($bouerseOutData);
							return false;
						}
						$mybouerse[$buyId]['have'] = $havBouerseAfter;
						$getStar = $bourseList[$buyId]['price'] * $buyValue;
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
	wmBouerse(true);
}
?>