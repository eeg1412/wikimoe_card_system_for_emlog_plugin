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
                    $wmGuesscardPut = array('data'=>$guesscardData,'star'=>$myStar,'code'=>202);
                    echo json_encode($wmGuesscardPut);
                }else if(intval($guessType)==0){//申请猜卡
                    if(intval($guessType)!=$guesscardData['type']){
                        //当前不为猜卡状态
                        $wmGuesscardPut = array('code'=>300);
                        echo json_encode($wmGuesscardPut);
                    }else{
                        if($myStar<10){
                            //星星不足
                            $wmGuesscardPut = array('code'=>302);
                            echo json_encode($wmGuesscardPut);
                            return false;
                        }
                        $guessSelCardArr = explode(",",$guessSelCard);//1001,1002,1003
                        if(count($guessSelCardArr)!=5){
                            //卡牌ID没对上
                            $wmGuesscardPut = array('code'=>301);
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
                        //写入数据库

                        
                        echo json_encode($guessSelCardArr);
                    }
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
        array_push($attackWmCardId,$guesscardDataListJson['card'][$i]);
    }
    $wmGuesscardData = array('card'=>$attackWmCardId,'time'=>$guessTimeNow,'type'=>1);//0为猜卡、1为兑奖
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