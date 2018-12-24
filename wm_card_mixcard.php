<?php
require_once('../../../init.php');
require_once('module.php');
function mixCard(){
    $data = null;
    $emailAddr = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    $rememberPass = intval($_POST['rememberPass']);
    $cardIDArr = explode(",",strip_tags($_POST['cardID']));//1001,1002,1003
    $cardCountArr = explode(",",strip_tags($_POST['cardCount']));//1,2,1
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断 
            if(count($cardIDArr)==count($cardCountArr)){//判断是否数据一致
                $DB = MySql::getInstance();
                $emailAddrMd5 = "\"".md5($emailAddr)."\"";
                $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
                $mgidinfo=$DB->fetch_array($mgid);
                if ($mgidinfo) {
                    //有该用户
                    $bdPassword = intval($mgidinfo['verifyCode']);
                    if($password==$bdPassword&&$bdPassword!=0){
                        $timeStamp = time();
                        $passwordTime = intval($mgidinfo['verifyCodeStamp']);
                        $verifyCodeRemember = intval($mgidinfo['verifyCodeRemember']);
                        if((($timeStamp - $passwordTime)<1800&&($timeStamp - $passwordTime)>0)||$verifyCodeRemember==1){
                            $json_string = json_decode(file_get_contents('cardData.json'), true);//查询卡牌数据
                            $useCardNumber = 0;
                            $addStarCount = 0;//增加的星星
                            $originCarID = $mgidinfo['cardID'];
                            $originCardCount = $mgidinfo['cardCount'];
                            //如果保存密码的话则verifyCodeRemember为1
                            $verifyCodeRemember = 0;
                            if($rememberPass==1){
                                $verifyCodeRemember = 1;
                            }
                            //循环遍历卡组
                            $originCarIDArr = explode(",",$originCarID);//1001,1002,1003
                            $originCarCountArr = explode(",",$originCardCount);//1,2,1
                            $countIsError = false;//错误标记
                            for ($i=0; $i<count($cardIDArr); $i++){
                                $mixCheckErrorPass = false;
                                for($j=0; $j<count($originCarIDArr); $j++){
                                    if($originCarIDArr[$j]==$cardIDArr[$i]){
                                        if(intval($cardCountArr[$i])<=0){//如果传入的数字小于等于零 抛出错误
                                            $mixCheckErrorPass = false;
                                        }else{
                                            $mixCheckErrorPass = true;
                                        }
                                        $originCarCountArr[$j] = intval($originCarCountArr[$j])-intval($cardCountArr[$i]);
                                        $useCardNumber = $useCardNumber + intval($cardCountArr[$i]);
                                        if($originCarCountArr[$j]<1){
                                            $mixCheckErrorPass = false;
                                        }else{
                                            $mixCheckErrorPass = true;
                                        }
                                        break;
                                    }
                                }
                                if(!$mixCheckErrorPass){
                                    $countIsError = true;
                                    break;
                                }
                                $addStarCount = $addStarCount + intval($json_string['cardData'][$cardIDArr[$i]]['star'])*intval($cardCountArr[$i]);
                                if($addStarCount<=0){
                                    $countIsError = true;
                                }
                            }
                            if($countIsError){
                                $data = json_encode(array('code'=>"300")); //数值有误
                            }else{
                                $originCardCountText = implode(",",$originCarCountArr);
                                //写入数据库
                                $starCount = intval($mgidinfo['starCount'])+$addStarCount;
                                $query = "Update ".DB_PREFIX."wm_card set verifyCodeRemember='".$verifyCodeRemember."' , cardCount='".$originCardCountText."' , starCount=".$starCount." where email=".$emailAddrMd5."";
                                $result=$DB->query($query);
                                $data = json_encode(array('code'=>"202",'addStar'=>$addStarCount,'starCount'=>$starCount,'useCardNumbe'=>$useCardNumber)); //成功
                                $cardJsonData = array('mailMD5'=>md5($emailAddr),'addStar'=>$addStarCount,'useCardNumbe'=>$useCardNumber,'massageType'=>'mixcard');
                                //写入或动态列表json
                                wmWriteJson($cardJsonData);
                            }
                        }else{
                            $data = json_encode(array('code'=>"201")); //密码有误或者过期
                        }
                    }else{
                        $data = json_encode(array('code'=>"201")); //密码有误或者过期
                    }
                    
                }else{
                    $data = json_encode(array('code'=>"200")); //无该用户
                }
            }else{
                $data = json_encode(array('code'=>"100")); //数据有误
            }
        }else{
            $data = json_encode(array('code'=>"0")); //邮箱有误
        }
    }else{
        $data = json_encode(array('code'=>"0")); //邮箱有误
    }
    echo $data;
}
if(isset($_POST['email'])&&isset($_POST['cardID'])&&isset($_POST['cardCount'])&&isset($_POST['password'])){
    mixCard();
}
?>