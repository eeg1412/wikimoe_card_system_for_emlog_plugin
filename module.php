<?php
function wmCaptchaCheck($Ticket,$Randstr,$UserIP){
    // require_once('clicaptcha/clicaptcha.class.php');
    $wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
    if($wmCard_set['deminingCaptcha']=='1'){
        if(empty($Ticket)||empty($Randstr)||empty($UserIP)){   
            return false;
        }else{
            //----------------------------------
            // 腾讯验证码后台接入demo
            //----------------------------------
            header('Content-type:text/html;charset=utf-8');

            $AppSecretKey = $wmCard_set['appSecretKey']; //$_GET["AppSecretKey"]
            $appid = $wmCard_set['appID']; //$_GET["appid"]
            $Ticket = $Ticket; //$_GET["Ticket"]
            $Randstr = $Randstr; //$_GET["Randstr"]
            $UserIP = $UserIP; //$_GET["UserIP"]

            /**
             * 请求接口返回内容
             * @param  string $url [请求的URL地址]
             * @param  string $params [请求的参数]
             * @param  int $ipost [是否采用POST形式]
             * @return  string
            */
            function txcurl($url,$params=false,$ispost=0){
                $httpInfo = array();
                $ch = curl_init();

                curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
                curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
                curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
                curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                if( $ispost )
                {
                    curl_setopt( $ch , CURLOPT_POST , true );
                    curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
                    curl_setopt( $ch , CURLOPT_URL , $url );
                }
                else
                {
                    if($params){
                        curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
                    }else{
                        curl_setopt( $ch , CURLOPT_URL , $url);
                    }
                }
                $response = curl_exec( $ch );
                if ($response === FALSE) {
                    //echo "cURL Error: " . curl_error($ch);
                    return false;
                }
                $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
                $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
                curl_close( $ch );
                return $response;
            }

            $url = "https://ssl.captcha.qq.com/ticket/verify";
            $params = array(
                "aid" => $appid,
                "AppSecretKey" => $AppSecretKey,
                "Ticket" => $Ticket,
                "Randstr" => $Randstr,
                "UserIP" => $UserIP
            );
            $paramstring = http_build_query($params);
            $content = txcurl($url,$paramstring);
            $result = json_decode($content,true);
            if($result){
                if($result['response'] == 1){
                    // print_r($result);
                    return true;
                }else{
                    return false;
                }
            }else{
                // echo "请求失败";
                return false;
            }
            // $clicaptcha = new clicaptcha();
            // $wmClicaptchaRes =  $clicaptcha->check($wmCaptcha);
            // if(!$wmClicaptchaRes){
            //     return false;
            // }else{
            //     return true;
            // }
        }
    }else{
        return true;
    }
}
function wmCreatCardId($randomCardRate){
    $randomCardID = null;
    if($randomCardRate>=1&&$randomCardRate<=64){
        //N
        $randomCardN_ = mt_rand(1, 97);
        $randomCardID = '0'.sprintf("%03d", $randomCardN_);
    }else if($randomCardRate>=65&&$randomCardRate<=86){
        //R
        $randomCardR_ = mt_rand(1, 81);
        $randomCardID = '1'.sprintf("%03d", $randomCardR_);
    }else if($randomCardRate>=87&&$randomCardRate<=97){
        //SR
        $randomCardSR_ = mt_rand(1, 65);
        $randomCardID = '2'.sprintf("%03d", $randomCardSR_);
    }else if($randomCardRate>97){
        //SSR
        $randomCardSSR_ = mt_rand(1, 34);
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
//产生不重复的随机数
function  wmunique_rand($min,$max,$num){
    $count = 0;
    $return_arr = array();
    while($count < $num){
        $return_arr[] = mt_rand($min,$max);
        $return_arr = array_flip(array_flip($return_arr));
        $count = count($return_arr);
    }
    shuffle($return_arr);
    return $return_arr;
}
//密码验证
function wmPasswordCheck($mgidinfo,$password){
    $bdPassword = intval($mgidinfo['verifyCode']);
    if($password==$bdPassword&&$bdPassword!=0){
        $timeStamp = time();
        $passwordTime = intval($mgidinfo['verifyCodeStamp']);
        $verifyCodeRemember = intval($mgidinfo['verifyCodeRemember']);
        if((($timeStamp - $passwordTime)<1800&&($timeStamp - $passwordTime)>0)||$verifyCodeRemember==1){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
//根据条件查询出新的对象
function wmKeyForobject($objectArr,$k,$v){
    $arrCache = array();
    for($i=0; $i<count($objectArr); $i++){
        if($objectArr[$i][$k] == $v){
            $arrCache;
            array_push($arrCache,$objectArr[$i]);
        };
    }
    return $arrCache;
}
?>