<?php
require_once('../../../init.php');	
function wm_cardWrite(){
	$DB = MySql::getInstance();
	$data = null;
	$emailAddr = strip_tags($_POST['email']);
	$choiseIndex = intval(strip_tags($_POST['choiseIndex']));
	$checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
	if(isset($emailAddr) && $emailAddr!=""){
		if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
           //邮箱地址正确
		   	$comment_author_email = "\"".$emailAddr."\"";
			$sql = "SELECT cid as author_count FROM ".DB_PREFIX."comment WHERE mail = ".$comment_author_email." and hide ='n'";
			$res = $DB->query($sql);
			$author_count = mysql_num_rows($res);
			if($author_count<1){
				//没有在评论里查询到邮箱地址
				$data = json_encode(array('code'=>"3")); 
			}else{
				//评论表里有
				$comment_author_email = "\"".md5($emailAddr)."\"";
				$mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$comment_author_email."");
				$mgidinfo=$DB->fetch_array($mgid);
				$timeStamp = time();
				$wmoriginDate = null;
				$wmnowDate_ = null;
				$originToday = null;
				$DateCheck = true;
				$wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
				//次数的基数（次数-1）
				$canGetCardChance = intval($wmCard_set['chance'])-1;
				if($canGetCardChance<0){
					$canGetCardChance = 0;
				}
				$leftGetChance = $canGetCardChance;
				if ($mgidinfo) {
					$wmoriginTime = intval ($mgidinfo[timeStamp]);
					$wmnowDate_ = date("Ymd", $timeStamp);
					$wmoriginDate =  date("Ymd", $wmoriginTime);
					//根据竞技分数增加抽卡次数
					$canGetCardChancePlus = floor($mgidinfo[score]/1000);
					if($canGetCardChancePlus>5){//加成最多5次
						$canGetCardChancePlus = 5;
					}
					if($wmoriginDate==$wmnowDate_){
						//判断今天抽了几次
						//获取抽卡次数
						$originToday = $mgidinfo[todayCount];
						$canGetCardChance = $canGetCardChance + $canGetCardChancePlus;
						$leftGetChance = $canGetCardChance - $originToday; 
						if($leftGetChance<0){
							$DateCheck = false;
						}
					}else{
						$leftGetChance = $canGetCardChance;
						$query = "Update ".DB_PREFIX."wm_card set todayCount=0 where email=".$comment_author_email."";
						$result=$DB->query($query);
					}
				}
				if($DateCheck){
					//正常抽
					$randomCardID = null;
					$cardChoiseList = array();
					$testCount = 0;
					while (count($cardChoiseList)<3 && $testCount<100) {
						$randomCardR = mt_rand(1, 100);
						if($randomCardR>=1&&$randomCardR<=64){
							//N
							$randomCardN_ = mt_rand(1, 66);
							array_push($cardChoiseList,'0'.sprintf("%03d", $randomCardN_));
						}else if($randomCardR>=65&&$randomCardR<=86){
							//R
							$randomCardR_ = mt_rand(1, 40);
							array_push($cardChoiseList,'1'.sprintf("%03d", $randomCardR_));
						}else if($randomCardR>=87&&$randomCardR<=97){
							//SR
							$randomCardSR_ = mt_rand(1, 31);
							array_push($cardChoiseList,'2'.sprintf("%03d", $randomCardSR_));
						}else if($randomCardR>97){
							//SSR
							$randomCardSSR_ = mt_rand(1, 19);
							array_push($cardChoiseList,'3'.sprintf("%03d", $randomCardSSR_));
						}
						$testCount = $testCount +1;
						$cardChoiseList = array_values(array_unique($cardChoiseList,SORT_REGULAR));
					}

					if(!($choiseIndex>=0&&$choiseIndex<=2)){
						$choiseIndex = 1;
					}

					$randomCardID = $cardChoiseList[$choiseIndex];

					if(empty($randomCardID)){//防止抽到空牌
						//空牌
						$data = json_encode(array('code'=>"4"));
					}else{
						$json_string = json_decode(file_get_contents('cardData.json'), true);//查询卡牌数据
						$getCardData = $json_string['cardData'][$randomCardID];//抽中卡牌数据
						$cardJsonData = array('mailMD5'=>md5($emailAddr),'cardInfo'=>$getCardData,'cardID'=>$randomCardID);
						//写入或更新最新抽奖列表json
						if(file_exists('cardGetList.json')){//判断json文件是否存在
							$cardGetList = json_decode(file_get_contents('cardGetList.json'),true);
							array_unshift($cardGetList,$cardJsonData);
							if(count($cardGetList)>30){//判断数据量是否超过30条
								array_pop($cardGetList);
							}
							$cardJsonDataEncode = json_encode($cardGetList);
							file_put_contents('cardGetList.json', $cardJsonDataEncode);
						}else{
							$cardJsonDataEncode = json_encode(array($cardJsonData));
							file_put_contents('cardGetList.json', $cardJsonDataEncode);
						}
						//判断数据库是否存在这个用户的抽奖信息
						if (!$mgidinfo) {
							$sqli="INSERT INTO ".DB_PREFIX."wm_card (email,cardID,cardCount,timeStamp,todayCount,score,level,exp,battleStamp,exData) VALUES(".$comment_author_email.",'".$randomCardID."','1',".$timeStamp.",1,0,0,0,".$timeStamp.",'')";
							$DB->query($sqli);
						}else{
							$originCarID = $mgidinfo[cardID];
							$originCardCount = $mgidinfo[cardCount];
							//循环遍历卡组
							$originCarIDArr = explode(",",$originCarID);//1001,1002,1003
							$originCarCountArr = explode(",",$originCardCount);//1,2,1
							$hasReapt = false;
							for ($i=0; $i<count($originCarIDArr); $i++)
							{
								if(intval($originCarIDArr[$i])==$randomCardID){
									$originCarCountArr[$i] = intval($originCarCountArr[$i])+1;
									$hasReapt = true;
									break;
								}
							}
							$originCarIDText = '';
							$originCardCountText = '';
							if($hasReapt){
								$originCarIDText = $originCarID;
								$originCardCountText = implode(",",$originCarCountArr);
							}else{
								$originCarIDText = $originCarID.",".$randomCardID;
								$originCardCountText = $originCardCount.",1";
							}
							$query = "Update ".DB_PREFIX."wm_card set cardID='".$originCarIDText."' , cardCount='".$originCardCountText."' , timeStamp=".$timeStamp." , todayCount=todayCount+1 where email=".$comment_author_email."";
							$result=$DB->query($query);
						}
						$data = json_encode(array('code'=>"202",'card'=>$randomCardID,'emailmd5'=>md5($emailAddr),'todaycount'=>$originToday,'cardChoiseList'=>$cardChoiseList,'choiseIndex'=>$choiseIndex,'leftGetChance'=>$leftGetChance));
					}
				}else{
					$data = json_encode(array('code'=>"2" , 'data'=>$wmoriginDate , 'datanow'=>$wmnowDate_,'emailmd5'=>md5($emailAddr)));  
				}
			}
		   
        }else{  
			//邮箱地址错误
           $data = json_encode(array('code'=>"1"));  
        }    
	}else{
		//邮箱地址为空
		$data = json_encode(array('code'=>"0")); 
	}
	//0为邮箱地址为空，1为邮箱地址不合格，2为今天已经抽过了，3为评论表里找不到邮箱地址，4为空牌，202为正常输出
	echo $data;
}
wm_cardWrite();
?>