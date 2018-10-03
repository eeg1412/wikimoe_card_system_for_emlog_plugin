<?php
require_once('../../../init.php');
function getCardInfo($emailMD5){//获取卡片数组
			$DB = MySql::getInstance();
			$comment_author_email = "\"".$emailMD5."\"";
			$mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$comment_author_email."");
			$mgidinfo=$DB->fetch_array($mgid);
			//循环遍历卡组
			$originCarIDArr = explode(",",$mgidinfo['cardID']);//1001,1002,1003
			$originCarCountArr = explode(",",$mgidinfo['cardCount']);//1,2,1
			$CarIDArr=$originCarIDArr;
			// $CarIDArr=array();
			// for($j=0; $j<count($originCarIDArr); $j++){
			// 	for($i=0; $i<intval($originCarCountArr[$j]); $i++){
			// 		array_push($CarIDArr,$originCarIDArr[$j]);
			// 	}
			// }
			$CardInfo = array($CarIDArr,$mgidinfo);
			return $CardInfo;
}
function cardSet($cardArr,$setNUM){//牌太多的时候随机取牌
	//初始化每种卡牌数量
	$sixStarCardCount = 10;
	$fiveStarCardCount = 5;
	$fourStarCardCount = 3;
	$threeStarCardCount = 2;

	//初始化每种卡牌数组
	$sixStarCardArr = array();
	$fiveStarCardArr = array();
	$fourStarCardArr = array();
	$threeStarCardArr = array();

	$cardCount = count($cardArr);
	$cardResetArr = array();
	//随机打乱
	shuffle($cardArr);
	//给卡牌分类
	for ($i=0; $i < $cardCount; $i++) {
		$intCardId = intval($cardArr[$i]);
		if($intCardId>3000){
			array_push($sixStarCardArr,$cardArr[$i]);
		}else if($intCardId>2000){
			array_push($fiveStarCardArr,$cardArr[$i]);
		}else if($intCardId>1000){
			array_push($fourStarCardArr,$cardArr[$i]);
		}else{
			array_push($threeStarCardArr,$cardArr[$i]);
		}
	}
	//如果卡牌不够设置则数量下移
	if(count($sixStarCardArr)<$sixStarCardCount){
		$fiveStarCardCount = $fiveStarCardCount + ($sixStarCardCount - count($sixStarCardArr));
		$sixStarCardCount = count($sixStarCardArr);
	}
	if(count($fiveStarCardArr)<$fiveStarCardCount){
		$fourStarCardCount = $fourStarCardCount + ($fiveStarCardCount - count($fiveStarCardArr));
		$fiveStarCardCount = count($fiveStarCardArr);
	}
	if(count($fourStarCardArr)<$fourStarCardCount){
		$threeStarCardCount = $threeStarCardCount + ($fourStarCardCount - count($fourStarCardArr));
		$fourStarCardCount = count($fourStarCardArr);
	}
	//填充新数组
	for ($j=0; $j < $sixStarCardCount; $j++) {
        array_push($cardResetArr,$sixStarCardArr[$j]);
	}
	for ($j=0; $j < $fiveStarCardCount; $j++) {
        array_push($cardResetArr,$fiveStarCardArr[$j]);
	}
	for ($j=0; $j < $fourStarCardCount; $j++) {
        array_push($cardResetArr,$fourStarCardArr[$j]);
	}
	for ($j=0; $j < $threeStarCardCount; $j++) {
        array_push($cardResetArr,$threeStarCardArr[$j]);
	}

	return $cardResetArr;
}
function setStatStart($cardData,$CardArr,$HP,$Gong,$Fang,$Su,$levelPlus){//计算初始攻防速
	$HP_ = $HP;
	$Gong_ =$Gong;
	$Fang_ =$Fang;
	$Su_ = $Su;
	$resultStatArr = array();
	$stat_ = null;
	for($i=0; $i<count($CardArr); $i++){
		//全1：攻防+1
		//兵2：攻+1
		//盾3：防+1
		//速4：速+1
		//爱5：HP增加10%
		$stat_ = $cardData["cardData"][$CardArr[$i]];
		$HP_ = $HP_+ $stat_["star"];
		$Gong_ = $Gong_+ $stat_["star"];
		$Fang_ = $Fang_+ $stat_["star"];
		if($stat_["leftType"]==1){
			$Gong_ = $Gong_+1;
			$Fang_ = $Fang_+1;
		}else if($stat_["leftType"]==2){
			$Gong_ = $Gong_+1;
		}else if($stat_["leftType"]==3){
			$Fang_ = $Fang_+1;
		}else if($stat_["leftType"]==4){
			$Su_ = $Su_+1;
		}else if($stat_["leftType"]==5){
			$HP_ = round($HP_*1.1);
		}
	}
	$HP_ = round($HP_)*1000*3+$levelPlus;
	$Gong_ = round($Gong_)*1000+$levelPlus;
	$Fang_ = round($Fang_)*1000+$levelPlus;
	$Su_ = round($Su_);
	
	array_push($resultStatArr,$HP_,$Gong_,$Fang_,$Su_);
	return $resultStatArr;
	
}
function setCry($cardData,$MyCardArr,$EMCardArr){//计算水晶攻击加成
	//红1
	//蓝2
	//绿3
	//光4
	//暗5	
	$Myred = 0;
	$Myblue = 0;
	$Mygreen = 0;
	$Mylight = 0;
	$Myblack = 0;
	
	$EMred = 0;
	$EMblue = 0;
	$EMgreen = 0;
	$EMlight = 0;
	$EMblack = 0;
	
	for($i=0; $i<count($MyCardArr); $i++){
		$stat_ = $cardData["cardData"][$MyCardArr[$i]];
		if($stat_["cry"]==1){
			$Myred = $Myred+1;
		}else if($stat_["cry"]==2){
			$Myblue = $Myblue+1;
		}else if($stat_["cry"]==3){
			$Mygreen = $Mygreen+1;
		}else if($stat_["cry"]==4){
			$Mylight = $Mylight+1;
		}else if($stat_["cry"]==5){
			$Myblack = $Myblack+1;
		}
	}
	$MyCryArr = array($Myred,$Myblue,$Mygreen,$Mylight,$Myblack);
	
	for($i=0; $i<count($EMCardArr); $i++){
		$stat_ = $cardData["cardData"][$EMCardArr[$i]];
		if($stat_["cry"]==1){
			$EMred = $EMred+1;
		}else if($stat_["cry"]==2){
			$EMblue = $EMblue+1;
		}else if($stat_["cry"]==3){
			$EMgreen = $EMgreen+1;
		}else if($stat_["cry"]==4){
			$EMlight = $EMlight+1;
		}else if($stat_["cry"]==5){
			$EMblack = $EMblack+1;
		}
	}
	$EMCryArr = array($EMred,$EMblue,$EMgreen,$EMlight,$EMblack);
	
	$MyGong_ = ($MyCryArr[0]*2-$EMCryArr[1])+($MyCryArr[1]*2-$EMCryArr[2])+($MyCryArr[2]*2-$EMCryArr[0])+($MyCryArr[3]*2-$EMCryArr[4])+($MyCryArr[4]*2-($EMCryArr[0]+$EMCryArr[1]+$EMCryArr[2]));
	$EMGong_ = ($EMCryArr[0]*2-$MyCryArr[1])+($EMCryArr[1]*2-$MyCryArr[2])+($EMCryArr[2]*2-$MyCryArr[0])+($EMCryArr[3]*2-$MyCryArr[4])+($EMCryArr[4]*2-($MyCryArr[0]+$MyCryArr[1]+$MyCryArr[2]));
	//(1*2-1)+(1*2-0)+(1*2-0)+(1*2-1)+(0*2-(0+1+0))
	
	
	$plusGong = array($MyGong_,$EMGong_);
	return $plusGong;
	
}
function setScore($Score,$emailMD5,$setBattleTime){
	$DB = MySql::getInstance();
	if($Score>2147483647){
		$Score = 2147483647;
	}
	$comment_author_email = "\"".$emailMD5."\"";
	if($setBattleTime==0){
		$query = "Update wikimoeindex_wm_card set score=".$Score." where email=".$comment_author_email."";
	}else{
		$timeStamp = time();
		$query = "Update wikimoeindex_wm_card set score=".$Score." , battleStamp=".$timeStamp." where email=".$comment_author_email."";
	}
	$result=$DB->query($query);
}
function setLevel($level,$getexp,$emailMD5){
	$DB = MySql::getInstance();
	if($level>2147483647){
		$level = 2147483647;
	}
	$comment_author_email = "\"".$emailMD5."\"";
	$query = "Update wikimoeindex_wm_card set level=".$level." , exp=".$getexp." where email=".$comment_author_email."";
	$result=$DB->query($query);
}
function gameStart(){
	$data = null;
	$EMemailAddr = strip_tags($_POST['EMemail']);
	$MyemailAddr = strip_tags($_POST['Myemail']);
	if(!preg_match("/^[A-Za-z0-9]+$/",$EMemailAddr)||!preg_match("/^[A-Za-z0-9]+$/",$MyemailAddr)||$EMemailAddr==$MyemailAddr){
		$data = json_encode(array('code'=>"0"));
	}else{
		$MyHP = 0;
		$MyGong = 0;
		$MyFang = 0;
		$MySu = 0;
		
		$EMHP = 0;
		$EMGong = 0;
		$EMFang = 0;
		$EMSu = 0;
		$EMCard = null;
		$MyCard = null;
		$cardData = null;
		$roundNum = 0;
		//初始化
		$json_string = file_get_contents('cardData.json');
		$cardData = json_decode($json_string, true); 
			
		$EMCardInfo = getCardInfo($EMemailAddr);//取得敌方的卡牌和数据库信息[0]是卡牌数据[1]是数据库信息
		$MyCardInfo = getCardInfo($MyemailAddr);//取得自己的卡牌和数据库信息
		
		$EMCard = $EMCardInfo[0];
		$MyCard = $MyCardInfo[0];
		
		$timeStamp = time();
		$wmBattleEMBaseStamp = intval ($MyCardInfo[1]['battleStamp']);
		$wmBattleNowDate = date("Ymd", $timeStamp);//现在的时间
		$wmBattleEMBaseDate =  date("Ymd", $wmBattleEMBaseStamp);//数据库敌方的时间

		if(count($EMCard) <= 0 || count($MyCard) <= 0){
			$data = json_encode(array('code'=>"1"));//没有牌
		}else if(empty($EMCard[0]) || empty($MyCard[0])){
			$data = json_encode(array('code'=>"1"));//没有牌
		}else if($wmBattleNowDate == $wmBattleEMBaseDate){
			$data = json_encode(array('code'=>"2"));//今天已经挑战过了
		}else{
			if(count($EMCard)>20){//牌大于20张的时候取20张
				$EMCard = cardSet($EMCard,20);
			}
			if(count($MyCard)>20){//牌大于20张的时候取20张
				$MyCard = cardSet($MyCard,20);
			}
			
			$MylevelPlus = $MyCardInfo[1]['level']*1000;
			$EMlevelPlus = $EMCardInfo[1]['level']*1000;
			
			//开始设定数值
			$MyStartStat = setStatStart($cardData,$MyCard,$MyHP,$MyGong,$MyFang,$MySu,$MylevelPlus);
			$EMStartStat = setStatStart($cardData,$EMCard,$MyHP,$MyGong,$MyFang,$MySu,$EMlevelPlus);
			
			$MyHP = $MyStartStat[0];
			$MyGong = $MyStartStat[1];
			$MyFang = $MyStartStat[2];
			$MySu = $MyStartStat[3];
			
			$EMHP = $EMStartStat[0];
			$EMGong = $EMStartStat[1];
			$EMFang = $EMStartStat[2];
			$EMSu = $EMStartStat[3];
			
			$CryPlus = setCry($cardData,$MyCard,$EMCard);
			
			$MyGong = round($MyGong + $CryPlus[0]*500);
			$EMGong = round($EMGong + $CryPlus[1]*500);
			
			$MyHP_ = $MyHP;
			$MyGong_ = $MyGong;
			$MyFang_ = $MyFang;
			
			$EMHP_ = $EMHP;
			$EMGong_ = $EMGong;
			$EMFang_ = $EMFang;
			
			$maxRound = 50;//最大回数
			$defendXiShu = 0.9;//防御系数
			$roundData = array();
			$IsWin = 0;//0胜利1输3平
			$Myturn = 0;//0我的回合1对方的回合
			if($MySu>$EMSu){
					$Myturn = 0;
				}else if($MySu<$EMSu){
					$Myturn = 1;
				}else{
					$Myturn = mt_rand(0,1);
			}
			
			
			for($i=0; $i<$maxRound; $i++){
				
				if($Myturn == 0){
					$MycardLength = count($MyCard);
					$randomCard = mt_rand(0,$MycardLength-1);
					$useCard = $MyCard[$randomCard];
					$useType = $cardData["cardData"][$useCard]["rightType"];
					$Mo = false;//判断是不是魔
					$EMHP__ = $EMHP;
					$MyHP__ = $MyHP;
					//物1：攻击力+1
					//魔2：攻击回血攻击的10%
					//防3：防御+1
					//治4：回血20%
					//妨5：对方防御-1
					//支6：攻击力增加5%
					//特7：攻防各加1 回血5%
					if($useType==1){
						$MyGong = round($MyGong+1000);
					}else if($useType==2){
						$Mo = true;
					}else if($useType==3){
						$MyFang = round($MyFang +1000);	
					}else if($useType==4){
						$MyHP = round($MyHP*1.02);
					}else if($useType==5){
						$EMFang = round($EMFang -1000);
					}else if($useType==6){
						$MyGong = round($MyGong*1.005);
					}else if($useType==7){
						$MyGong = round($MyGong+1000);
						$MyFang = round($MyFang +1000);
						$MyHP = round($MyHP*1.005);
					}
					$Fudong = 1-(mt_rand(-5,5)/100);
					$attack = round(($MyGong-$EMFang*$defendXiShu)*$Fudong);
					if($attack<=0){
						$attack = 1;
					}
					$EMHP = $EMHP-$attack;
					if($Mo){
						$MyHP = round($MyHP + $attack*0.5);
					}
					$thisRoundArr = array('myTurn'=>$Myturn,'cardIndex'=>$randomCard,'useCard'=>$useCard,'useType'=>$useType,'attack'=>$attack,'MyHP'=>$MyHP,'originMyHP'=>$MyHP__,'EMHP'=>$EMHP,'originEMHP'=>$EMHP__,'Myre'=>($MyHP-$MyHP__),'EMre'=>($EMHP-$EMHP__));
					array_push($roundData,$thisRoundArr);
					
					if($EMHP<=0){
						$IsWin = 0;
						break;
					}
					
					$Myturn = 1;
					
				}else{
					$EMcardLength = count($EMCard);
					$randomCard = mt_rand(0,$EMcardLength-1);
					$useCard = $EMCard[$randomCard];
					$useType = $cardData["cardData"][$useCard]["rightType"];
					$Mo = false;//判断是不是魔
					$EMHP__ = $EMHP;
					$MyHP__ = $MyHP;
					//物1：攻击力+1
					//魔2：攻击回血攻击的10%
					//防3：防御+1
					//治4：回血20%
					//妨5：对方防御-1
					//支6：攻击力增加5%
					//特7：攻防各加1 回血5%
					if($useType==1){
						$EMGong = round($EMGong+1000);
					}else if($useType==2){
						$Mo = true;
					}else if($useType==3){
						$EMFang = round($EMFang +1000);	
					}else if($useType==4){
						$EMHP = round($EMHP*1.02);
					}else if($useType==5){
						$MyFang = round($MyFang -1000);
					}else if($useType==6){
						$EMGong = round($EMGong*1.005);
					}else if($useType==7){
						$EMGong = round($EMGong+1000);
						$EMFang = round($EMFang +1000);
						$EMHP = round($EMHP*1.005);
					}
					$Fudong = 1-(mt_rand(-5,5)/100);
					$attack = round(($EMGong-$MyFang*$defendXiShu)*$Fudong);
					if($attack<=0){
						$attack = 1;
					}
					$MyHP = $MyHP-$attack;
					if($Mo){
						$EMHP = round($EMHP + $attack*0.5);
					}
					$thisRoundArr = array('myTurn'=>$Myturn,'cardIndex'=>$randomCard,'useCard'=>$useCard,'useType'=>$useType,'attack'=>$attack,'MyHP'=>$MyHP,'originMyHP'=>$MyHP__,'EMHP'=>$EMHP,'originEMHP'=>$EMHP__,'Myre'=>($MyHP-$MyHP__),'EMre'=>($EMHP-$EMHP__));
					array_push($roundData,$thisRoundArr);
					
					if($MyHP<=0){
						$IsWin = 1;
						break;
					}
					
					$Myturn = 0;
				}
				
				if($i==$maxRound-1){
					$IsWin = 3;
				}
			}
			//开始结算分数和经验
			$MyGetScore = 0;//我方获得分数
			$EMGetScore = 0;//敌方获得分数
			
			$EMScoreOrigin = $EMCardInfo[1]["score"];
			$MyScoreOrigin = $MyCardInfo[1]["score"];
			
			$MyLevelOrigin = intval($MyCardInfo[1]["level"]);
			$EMLevelOrigin = intval($EMCardInfo[1]["level"]);
			
			$MyEXPOrigin = intval($MyCardInfo[1]["exp"]);
			
			$levelData = $cardData["level"];
			
			$MyGetScore_ = 0;
			
			$MyGetScore_post = 0;
				
			if($IsWin==0){//我方赢了
				$MyGetScore = intval(($EMScoreOrigin - $MyScoreOrigin)/2);
				if($MyGetScore<=10){
					$MyGetScore = 10;
				}
				$MyGetScore_ = $MyGetScore;
				$MyGetScore_post = $MyGetScore;
				
				$EMGetScore = -$MyGetScore;
				
				$MyGetScore = $MyGetScore + $MyScoreOrigin;
				$EMGetScore = $EMGetScore + $EMScoreOrigin;
				
				if($MyGetScore<=0){
					$MyGetScore=0;
				}
				if($EMGetScore<=0){
					$EMGetScore = 0;
				}
				
				setScore($EMGetScore,$EMemailAddr,0);
				setScore($MyGetScore,$MyemailAddr,1);
					
			}else if($IsWin==1){//敌方赢了
				$MyGetScore_ = 10;
				$EMGetScore = intval(($MyScoreOrigin - $EMScoreOrigin/2));
				if($EMGetScore<=10){
					$EMGetScore = 10;
				}
				$MyGetScore = -$EMGetScore;	
				$MyGetScore_post = $MyGetScore;
				
				$MyGetScore = $MyGetScore + $MyScoreOrigin;
				$EMGetScore = $EMGetScore + $EMScoreOrigin;
				
				if($MyGetScore<=0){
					$MyGetScore=0;
					$MyGetScore_post = 0;
				}
				if($EMGetScore<=0){
					$EMGetScore = 0;
				}
				
				setScore($EMGetScore,$EMemailAddr,0);
				setScore($MyGetScore,$MyemailAddr,1);
			}
			
			$shouldEXP = 0;//所需经验值
			$levelSet = $MyLevelOrigin;//升级后的等级
			$nextLevelData = $MyLevelOrigin;//下一个等级的数据获取条件等级
			$GetEXP = $MyGetScore_+$MyEXPOrigin;//获取的经验值
			
			if($MyLevelOrigin>5){
				$nextLevelData = 5;
			}
			$shouldEXP = $levelData[$nextLevelData];
			$GetEXP_ = $GetEXP;
			if($GetEXP>=$shouldEXP){
				$levelSet = $levelSet+1;
				$GetEXP = $GetEXP - $shouldEXP;
				$nextLevelData = $nextLevelData+1;
				if($nextLevelData>5){
					$nextLevelData = 5;
				}
				$shouldEXP = $levelData[$nextLevelData];
				if($GetEXP>$shouldEXP){
					$GetEXP = $shouldEXP -1;
				}
			}else{
				$GetEXP = $GetEXP;
			}
			setLevel($levelSet,$GetEXP,$MyemailAddr);
			
			//写入或更新最动态列表json
			$gameJsonData = array('mailMD5'=>$MyemailAddr,'MyGetScore'=>$MyGetScore_post,'GETEXP'=>$MyGetScore_,'Win'=>$IsWin,'massageType'=>'battle');
			if(file_exists('cardGetList.json')){//判断json文件是否存在
				$cardGetList = json_decode(file_get_contents('cardGetList.json'),true);
				array_unshift($cardGetList,$gameJsonData);
				if(count($cardGetList)>30){//判断数据量是否超过30条
					array_pop($cardGetList);
				}
				$cardJsonDataEncode = json_encode($cardGetList);
				file_put_contents('cardGetList.json', $cardJsonDataEncode);
			}else{
				$cardJsonDataEncode = json_encode(array($gameJsonData));
				file_put_contents('cardGetList.json', $cardJsonDataEncode);
			}
			$data = json_encode(array('code'=>"202",'cardData'=>$cardData,'EMCard'=>$EMCard,'MyCard'=>$MyCard,'MyStartStat'=>array($MyHP_,$MyGong_,$MyFang_,$MySu),'EMStartStat'=>array($EMHP_,$EMGong_,$EMFang_,$EMSu),'roundData'=>$roundData,'Win'=>$IsWin,'MyGetScore'=>$MyGetScore_post,'MyScoreOrigin'=>$MyScoreOrigin,'EMGetScore'=>$EMGetScore,'EMScoreOrigin'=>$EMScoreOrigin,'GETEXP'=>$MyGetScore_,'EMLevelOrigin'=>$EMLevelOrigin,'MyLevelOrigin'=>$MyLevelOrigin,'MyEXPOrigin'=>$MyEXPOrigin,'MyLevel'=>$levelSet));
		}
			

	}
	//code0为邮箱格式错误1为双方有一方没有牌2为今天已经发起过挑战
	echo $data;
}
gameStart()
?>