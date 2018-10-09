<?php
require_once('../../../init.php');
function buyCard(){
    $emailAddr = strip_tags($_POST['email']);
    $buyType = intval($_POST['type']);
    $password = intval($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    $data = null;
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断 
            $DB = MySql::getInstance();
            $emailAddrMD5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMD5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
                $bdPassword = intval($mgidinfo['verifyCode']);
                if($password==$bdPassword&&$bdPassword!=0){
                    $timeStamp = time();
                    $passwordTime = intval($mgidinfo['verifyCodeStamp']);
                    if(($timeStamp - $passwordTime)<1800&&($timeStamp - $passwordTime)>0){
                        $randomCardRate = mt_rand(1, 100);
                        $starFlag = false;//true为星星不足
                        $starCount = intval ($mgidinfo['starCount']);
                        $shouldStar = 9999;
                        if($buyType==3){
                            $shouldStar = 30;
                            if($starCount<$shouldStar){
                                $starFlag = true;
                            }
                        }else if($buyType==4){
                            $randomCardRate = 65;
                            $shouldStar = 200;
                            if($starCount<$shouldStar){
                                $starFlag = true;
                            }
                        }else if($buyType==5){
                            $randomCardRate = 87;
                            $shouldStar = 400;
                            if($starCount<$shouldStar){
                                $starFlag = true;
                            }
                        }else if($buyType==6){
                            $randomCardRate = 100;
                            $shouldStar = 900;
                            if($starCount<$shouldStar){
                                $starFlag = true;
                            }
                        }else{
                            $randomCardRate = -1;
                        }
                        if($randomCardRate!=-1&&!$starFlag){
                            //正常抽
                            $randomCardID = null;
                            if($randomCardRate>=1&&$randomCardRate<=64){
                                //N
                                $randomCardN_ = mt_rand(1, 71);
                                $randomCardID = '0'.sprintf("%03d", $randomCardN_);
                            }else if($randomCardRate>=65&&$randomCardRate<=86){
                                //R
                                $randomCardR_ = mt_rand(1, 44);
                                $randomCardID = '1'.sprintf("%03d", $randomCardR_);
                            }else if($randomCardRate>=87&&$randomCardRate<=97){
                                //SR
                                $randomCardSR_ = mt_rand(1, 35);
                                $randomCardID = '2'.sprintf("%03d", $randomCardSR_);
                            }else if($randomCardRate>97){
                                //SSR
                                $randomCardSSR_ = mt_rand(1, 20);
                                $randomCardID = '3'.sprintf("%03d", $randomCardSSR_);
                            }

                            $originCarID = $mgidinfo['cardID'];
                            $originCardCount = $mgidinfo['cardCount'];
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
                            $starCountAfter = $starCount - $shouldStar;
                            if($starCountAfter<0){
                                $starCountAfter = 0;
                            }
                            $query = "Update ".DB_PREFIX."wm_card set cardID='".$originCarIDText."' , cardCount='".$originCardCountText."' , starCount=".$starCountAfter." where email=".$emailAddrMD5."";
                            $result=$DB->query($query);

                            $json_string = json_decode(file_get_contents('cardData.json'), true);//查询卡牌数据
                            
                            $getCardData = $json_string['cardData'][$randomCardID];//抽中卡牌数据
                            $cardJsonData = array('mailMD5'=>md5($emailAddr),'cardInfo'=>$getCardData,'cardID'=>$randomCardID,'useStar'=>$shouldStar,'massageType'=>'buy');
                            //写入或更新最新抽奖列表json
                            if(file_exists('cardGetList.json')){//判断json文件是否存在
                                $cardGetList = json_decode(file_get_contents('cardGetList.json'),true);
                                array_unshift($cardGetList,$cardJsonData);
                                if(count($cardGetList)>50){//判断数据量是否超过50条
                                    array_pop($cardGetList);
                                }
                                $cardJsonDataEncode = json_encode($cardGetList);
                                file_put_contents('cardGetList.json', $cardJsonDataEncode);
                            }else{
                                $cardJsonDataEncode = json_encode(array($cardJsonData));
                                file_put_contents('cardGetList.json', $cardJsonDataEncode);
                            }

                            $data = json_encode(array('code'=>"202" , 'card'=>$randomCardID ,'starCountAfter'=>$starCountAfter)); 

                        }else if($starFlag){
                            //星星不够
                            $data = json_encode(array('code'=>"5",'starCount'=>$starCount,'shouldStar'=>$shouldStar));  
                        }else{
                        //type有误
                            $data = json_encode(array('code'=>"4"));  
                        }
                    }else{
                        //密码过时
                        $data = json_encode(array('code'=>"301")); 
                    }
                }else{
                    //密码不对
                    $data = json_encode(array('code'=>"301")); 
                }
                
            }else{
                //没有该用户
                $data = json_encode(array('code'=>"6")); 
            }
        }else{
            //邮箱地址错误
           $data = json_encode(array('code'=>"1")); 
        }

    }else{
        //邮箱地址为空
		$data = json_encode(array('code'=>"0")); 
    }
    echo $data;
}
if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['type'])){
    buyCard();
}

?>