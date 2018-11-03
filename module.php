<?php
function wmCreatCardId($randomCardRate){
    $randomCardID = null;
    if($randomCardRate>=1&&$randomCardRate<=64){
        //N
        $randomCardN_ = mt_rand(1, 84);
        $randomCardID = '0'.sprintf("%03d", $randomCardN_);
    }else if($randomCardRate>=65&&$randomCardRate<=86){
        //R
        $randomCardR_ = mt_rand(1, 63);
        $randomCardID = '1'.sprintf("%03d", $randomCardR_);
    }else if($randomCardRate>=87&&$randomCardRate<=97){
        //SR
        $randomCardSR_ = mt_rand(1, 48);
        $randomCardID = '2'.sprintf("%03d", $randomCardSR_);
    }else if($randomCardRate>97){
        //SSR
        $randomCardSSR_ = mt_rand(1, 26);
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
?>