<?php
require_once('../../../init.php');
require_once('module.php');
function wmGuessard(){
    $DB = MySql::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    $guessType = strip_tags($_POST['type']);
    $guessSelCard = strip_tags($_POST['cardID']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
                $guesscardData = searchWmGuesscard(true);
                $myStar = intval($mgidinfo['starCount']);
                if(intval($guessType)==2){//查询
                    $myguesscardData = $mgidinfo['guessCard']==''?'':json_decode($mgidinfo['guessCard'],true);
                    $wmGuesscardPut = array('data'=>$guesscardData,'myData'=>$myguesscardData,'star'=>$myStar,'code'=>202);
                    echo json_encode($wmGuesscardPut);
                }else if(intval($guessType)==0){//申请猜卡
                    if(intval($guessType)!=$guesscardData['type']){
                        //当前不为猜卡状态
                        $wmGuesscardPut = array('code'=>306);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }else{
                        $password = intval($_POST['password']);
                        if(!wmPasswordCheck($mgidinfo,$password)){
                            //密码不对
                            $wmGuesscardPut = array('code'=>301);
                            echo json_encode($wmGuesscardPut);
                            return false;
                        }
                        if($myStar<10){
                            //星星不足
                            $wmGuesscardPut = array('code'=>302);
                            echo json_encode($wmGuesscardPut);
                            return false;
                        }
                        $guessSelCardArr = explode(",",$guessSelCard);//1001,1002,1003
                        if(count($guessSelCardArr)!=5){
                            //卡牌ID数量不对
                            $wmGuesscardPut = array('code'=>305);
                            echo json_encode($wmGuesscardPut);
                            return false;
                        }
                        for($i=0;$i<count($guessSelCardArr);$i++){
                            $wmhasAttack = false;
                            for($j=0;$j<count($guesscardData['card']);$j++){
                                if($guessSelCardArr[$i]==$guesscardData['card'][$j]){
                                    $wmhasAttack = true;
                                    break;
                                }
                            }
                            if(!$wmhasAttack){
                                //卡牌ID没对上
                                $wmGuesscardPut = array('code'=>303);
                                echo json_encode($wmGuesscardPut);
                                return false;
                                break;
                            }
                        }
                        $myGuesscard = $mgidinfo['guessCard'];
						if($mgidinfo['guessCard']==''){
							$myGuesscard = '{}';
						}
                        $myGuesscard = json_decode($myGuesscard,true);
                        if(isset($myGuesscard['time'])){
                            //如果用户有猜卡信息
                            if($myGuesscard['time']==$guesscardData['time']){
                                //如果已竞猜当期，不能重复竞猜
                                $wmGuesscardPut = array('code'=>304);
                                echo json_encode($wmGuesscardPut);
                                return false;
                            }
                        }
                        $myGuesscardDatabase = array('cardID'=>$guessSelCardArr,'time'=>$guesscardData['time'],'isUsed'=>0);
                        //写入数据库
                        $starCountAfter = $myStar-10;
                        $rememberPass = intval($_POST['rememberPass']);
						//如果保存密码的话则verifyCodeRemember为1
						$verifyCodeRemember = 0;
						if($rememberPass==1){
							$verifyCodeRemember = 1;
						}
                        $query = "Update ".DB_PREFIX."wm_card set verifyCodeRemember='".$verifyCodeRemember."' , guessCard='".json_encode($myGuesscardDatabase)."' , starCount=".$starCountAfter."  where email=".$emailAddrMd5."";
                        $result=$DB->query($query);
                        $wmcardDatabase = json_decode(file_get_contents('cardData.json'), true);//查询卡牌数据
                        $wmcardDataName = array();
                        for($k=0;$k<count($guessSelCardArr);$k++){
                            array_push($wmcardDataName,$wmcardDatabase['cardData'][$guessSelCardArr[$k]]['name']);
                        }
                        $cardJsonData = array('mailMD5'=>md5($emailAddr),'cardName'=>$wmcardDataName,'cardID'=>$guessSelCardArr,'time'=>$guesscardData['time'],'massageType'=>'guesscard','type'=>0);
						wmWriteJson($cardJsonData);
                        $wmGuesscardPut = array('code'=>202);
                        echo json_encode($wmGuesscardPut);
                    }
                }else if(intval($guessType)==1){//申请兑奖
                    if(intval($guessType)!=$guesscardData['type']){
                        //当前不为兑奖状态
                        $wmGuesscardPut = array('code'=>306);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }
                    $myGuesscard = $mgidinfo['guessCard'];
                    if($mgidinfo['guessCard']==''){
                        //没有兑奖数据
                        $wmGuesscardPut = array('code'=>404);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }
                    $myGuesscardObject = json_decode($myGuesscard,true);//我的猜卡信息
                    if($myGuesscardObject['time']!=$guesscardData['fromTime']){
                        //过期
                        $wmGuesscardPut = array('code'=>405);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }
                    if($myGuesscardObject['isUsed']==1){
                        //已经兑奖
                        $wmGuesscardPut = array('code'=>406);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }
                    $wmAttackNum = 0;
                    for($i=0;$i<count($myGuesscardObject['cardID']);$i++){
                        for($j=0;$j<count($guesscardData['card']);$j++){
                            if($myGuesscardObject['cardID'][$i]==$guesscardData['card'][$j]){
                                //有一样的
                                $wmAttackNum++;
                                break;
                            }
                        }
                    }
                    $getStar = 0;
                    if($wmAttackNum==1){
                        $getStar = 10;
                    }else if($wmAttackNum==2){
                        $getStar = 100;
                    }else if($wmAttackNum==3){
                        $getStar = 1000;
                    }else if($wmAttackNum==4){
                        $getStar = 10000;
                    }else if($wmAttackNum==5){
                        $getStar = 1000000;
                    }
                    if($getStar==0){
                        //没中奖
                        $wmGuesscardPut = array('code'=>407);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }
                    //写入数据库
                    $starCountAfter = $myStar+$getStar;
                    if($starCountAfter>99999999){
                        //超过持有星星的最大值
                        $wmGuesscardPut = array('code'=>999);
                        echo json_encode($wmGuesscardPut);
                        return false;
                    }
                    $myGuesscardDatabase = $myGuesscardObject;
                    $myGuesscardDatabase['isUsed'] = 1;
                    $query = "Update ".DB_PREFIX."wm_card set guessCard='".json_encode($myGuesscardDatabase)."' , starCount=".$starCountAfter."  where email=".$emailAddrMd5."";
                    $result=$DB->query($query);
                    $cardJsonData = array('mailMD5'=>md5($emailAddr),'getStar'=>$getStar,'wmAttackNum'=>$wmAttackNum,'time'=>$myGuesscardObject['time'],'massageType'=>'guesscard','type'=>1);
                    wmWriteJson($cardJsonData);
                    $wmGuesscardPut = array('code'=>202,'getStar'=>$getStar,'star'=>$starCountAfter);
                    echo json_encode($wmGuesscardPut);
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
function searchWmGuesscard($isRetuen){
    if(!file_exists('guesscard.json')){//判断json文件是否存在
        initWmGuesscard();
    }
    $guesscardDataListJson = json_decode(file_get_contents('guesscard.json'),true);
    $guessTimeNow = time();
    $guessDay = date("Ymd", $guessTimeNow);
    $guesscardDataDay = date("Ymd", $guesscardDataListJson['time']);
    if($guessDay!=$guesscardDataDay){
        if($guesscardDataListJson['type']==1){
            initWmGuesscard();
        }else{
            creatWmGuesscardRes($guesscardDataListJson,$guessTimeNow);
        }
        $guesscardDataListJson = json_decode(file_get_contents('guesscard.json'),true);
    }
    if($isRetuen){
        return $guesscardDataListJson;
    }else{
        echo json_encode($guesscardDataListJson);
    }
}
function creatWmGuesscardRes($guesscardDataListJson,$guessTimeNow){
    $wmrandomArr = wmunique_rand(0,29,5);
    $attackWmCardId = array();
    for($i=0;$i<5;$i++){
        array_push($attackWmCardId,$guesscardDataListJson['card'][$wmrandomArr[$i]]);
    }
    $wmGuesscardData = array('card'=>$attackWmCardId,'fromTime'=>$guesscardDataListJson['time'],'time'=>$guessTimeNow,'type'=>1);//0为猜卡、1为兑奖
    file_put_contents('guesscard.json', json_encode($wmGuesscardData),LOCK_EX);
}
function initWmGuesscard(){//初始化
    $chainChioseCardId = creatWmguesscardList();
    $initNowTime = time();
    $wmGuesscardData = array('card'=>$chainChioseCardId,'time'=>$initNowTime,'type'=>0);//0为猜卡、1为兑奖
    file_put_contents('guesscard.json', json_encode($wmGuesscardData),LOCK_EX);
}
function creatWmguesscardList(){//生成竞猜卡牌
    $chainChioseCardId = array();
    for($i=0;$i<30;$i++){
        $randomCardRate = mt_rand(1, 100);
        $randomCardID = wmCreatCardId($randomCardRate);
        $reaptFlag = false;
        for($j=0;$j<count($chainChioseCardId);$j++){
            if($chainChioseCardId[$j]==$randomCardID){
                $reaptFlag = true;
                $i--;
                break;
            }
        }
        if(!$reaptFlag){
            array_push($chainChioseCardId,$randomCardID);
        }
    }
    return $chainChioseCardId;
}
wmGuessard();
?>