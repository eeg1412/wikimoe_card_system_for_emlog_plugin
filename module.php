<?php
function wmCaptchaCheck($wmCaptcha){
    require_once('clicaptcha/clicaptcha.class.php');
    $wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
    if($wmCard_set['deminingCaptcha']=='1'){
        if(empty($wmCaptcha)){   
            return false;
        }else{
            $clicaptcha = new clicaptcha();
            $wmClicaptchaRes =  $clicaptcha->check($wmCaptcha);
            if(!$wmClicaptchaRes){
                return false;
            }else{
                return true;
            }
        }
    }else{
        return true;
    }
}
function wmCreatCardId($randomCardRate){
    $randomCardID = null;
    if($randomCardRate>=1&&$randomCardRate<=64){
        //N
        $randomCardN_ = mt_rand(1, 89);
        $randomCardID = '0'.sprintf("%03d", $randomCardN_);
    }else if($randomCardRate>=65&&$randomCardRate<=86){
        //R
        $randomCardR_ = mt_rand(1, 67);
        $randomCardID = '1'.sprintf("%03d", $randomCardR_);
    }else if($randomCardRate>=87&&$randomCardRate<=97){
        //SR
        $randomCardSR_ = mt_rand(1, 53);
        $randomCardID = '2'.sprintf("%03d", $randomCardSR_);
    }else if($randomCardRate>97){
        //SSR
        $randomCardSSR_ = mt_rand(1, 30);
        $randomCardID = '3'.sprintf("%03d", $randomCardSSR_);
    }
    return $randomCardID;
}
function wmWriteJson($cardJsonData){
    //写入或更新最动态列表json
    if(file_exists('cardGetList.json')){//判断json文件是否存在
        $cardGetList = json_decode(file_get_contents('cardGetList.json'),true);
        array_unshift($cardGetList,$cardJsonData);
        if(count($cardGetList)>50){//判断数据量是否超过50条
            array_pop($cardGetList);
        }
        $cardJsonDataEncode = json_encode($cardGetList);
        file_put_contents('cardGetList.json', $cardJsonDataEncode,LOCK_EX);
    }else{
        $cardJsonDataEncode = json_encode(array($cardJsonData));
        file_put_contents('cardGetList.json', $cardJsonDataEncode,LOCK_EX);
    }    
}
function wmAddCard($originCarID,$originCardCount,$randomCardID){//原卡牌ID、原卡牌数量、随机卡牌ID或者卡牌ID
    //循环遍历卡组
    $originCarIDArr = explode(",",$originCarID);//1001,1002,1003
    $originCarCountArr = explode(",",$originCardCount);//1,2,1
    $hasReapt = false;
    for ($i=0; $i<count($originCarIDArr); $i++)
    {
        if(intval($originCarIDArr[$i])==intval($randomCardID)){
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
    $callBackCardInfo = array('originCarIDText'=>$originCarIDText,'originCardCountText'=>$originCardCountText);
    return $callBackCardInfo;
}
function wmSetLevel($MyLevelOrigin,$MyEXPOrigin,$MyGetScore_){
    $json_string = file_get_contents('cardData.json');
	$cardData = json_decode($json_string, true); 
    $levelData = $cardData["level"];
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
    $setLevelInfo = array('level'=>$levelSet,'GetEXP'=>$GetEXP);
    return $setLevelInfo;
}
?>