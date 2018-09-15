<?php
require_once('../../../init.php');	
function wm_cardWrite(){
	$DB = MySql::getInstance();
	$data = null;
	$emailAddr = strip_tags($_POST['email']);
	$checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
	if(isset($emailAddr) && $emailAddr!=""){
		if(preg_match($checkmail,$emailAddr)){                       //用正则表达式函数进行判断  
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
				if ($mgidinfo) {
					$wmoriginTime = intval ($mgidinfo[timeStamp]);
					$wmnowDate_ = date("Ymd", $timeStamp);
					$wmoriginDate =  date("Ymd", $wmoriginTime);
					
					if($wmoriginDate==$wmnowDate_){
						//判断今天抽了几次
						$originToday = $mgidinfo[todayCount];
						if(intval($originToday)>0){
							$DateCheck = false;
						}
					}else{
						$query = "Update ".DB_PREFIX."wm_card set todayCount=0 where email=".$comment_author_email."";
						$result=$DB->query($query);
					}
				}
				if($DateCheck){
					//正常抽
					$randomCardID = null;
					$randomCardR = mt_rand(1, 100);
					if($randomCardR>=1&&$randomCardR<=70){
						//N
						$randomCardN_ = mt_rand(1, 42);
						$randomCardID = '0'.sprintf("%03d", $randomCardN_);
					}else if($randomCardR>=71&&$randomCardR<=90){
						//R
						$randomCardR_ = mt_rand(1, 24);
						$randomCardID = '1'.sprintf("%03d", $randomCardR_);
					}else if($randomCardR>=91&&$randomCardR<=98){
						//SR
						$randomCardSR_ = mt_rand(1, 19);
						$randomCardID = '2'.sprintf("%03d", $randomCardSR_);
					}else if($randomCardR>98){
						//SSR
						$randomCardSSR_ = mt_rand(1, 15);
						$randomCardID = '3'.sprintf("%03d", $randomCardSSR_);
					}
					$json_string = json_decode(file_get_contents('cardData.json'), true);//获取卡牌数据
					$getCardData = $json_string['cardData'][$randomCardID];//抽中卡牌数据
					$cardJsonData = array('mailMD5'=>md5($emailAddr),'cardInfo'=>$getCardData,'cardID'=>$randomCardID);
					//写入或更新最新抽奖列表json
					if(file_exists('cardGetList.json')){//判断json文件是否存在
						$cardGetList = json_decode(file_get_contents('cardGetList.json'),true);
						array_unshift($cardGetList,$cardJsonData);
						if(count($cardGetList)>5){//判断数据量是否超过5条
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
						$sqli="INSERT INTO ".DB_PREFIX."wm_card (email,cardID,cardCount,timeStamp,todayCount,score,level,exp) VALUES(".$comment_author_email.",'".$randomCardID."','1',".$timeStamp.",1,0,0,0)";
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
					$data = json_encode(array('code'=>"202",'card'=>$randomCardID,'radom'=>$randomCardR,'emailmd5'=>md5($emailAddr),'todaycount'=>$originToday));
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
	//0为邮箱地址为空，1为邮箱地址不合格，2为今天已经抽过了，3为评论表里找不到邮箱地址，202为正常输出
	echo $data;
}
wm_cardWrite();
?>