<?php
require_once('../../../init.php');
require_once('module.php');
function wmGuessard(){
    $DB = MySql::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    $guessType = strip_tags($_POST['type']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
                $guesscardData = searchWmGuesscard(true);
                $guessTimeNow = time();
                $guessDay = date("Ymd", $guessTimeNow);
                $guesscardDataDay = date("Ymd", $guesscardData['time']);
                if($guessDay!=$guesscardDataDay){
                    if($guesscardData['type']==1){
                        initWmGuesscard();
                    }else{
                        //切换兑奖
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
    if($isRetuen){
        return $guesscardDataListJson;
    }else{
        echo json_encode($guesscardDataListJson);
    }
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
searchWmGuesscard(false);
?>