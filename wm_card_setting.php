<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
session_start();   
header("Content-Type: text/html;charset=utf-8");   
function set_wmtoken() {   
    $_SESSION['wmtoken'] = md5(microtime(true));   
};
   
function valid_wmtoken() {   
    $return = $_REQUEST['wmtoken'] === $_SESSION['wmtoken'] ? true : false;   
    set_wmtoken();   
    return $return;   
};
   
//如果wmtoken为空则生成一个wmtoken   
if(!isset($_SESSION['wmtoken']) || $_SESSION['wmtoken']=='') {   
    set_wmtoken();   
};
function plugin_setting_view(){
        $wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
        ?>
        <style>
        .card_setting label{
                padding-bottom:10px;
                display:block;
        }
        .card_setting{
                margin-bottom:30px;
                padding:10px;
                border:1px dashed #ccc;
        }
        .success_alert{
                text-align: center;
                padding: 5px 0;
                margin: 5px 0;
                background: #25c930;
                color: #fff;
        }
        .error_alert{
                text-align: center;
                padding: 5px 0;
                margin: 5px 0;
                background: #ff5050;
                color: #fff; 
        }
        </style>
        <form class="card_setting" method="post">  
                <input type="hidden" name="wmtoken" value="<?php echo $_SESSION['wmtoken']?>">
                <input type="hidden" name="settingType" value="setting" />
                <label>每日抽卡次数：<input type="number" autocomplete="off" name="chance" value="<?php echo $wmCard_set['chance']; ?>" /></label>
                <label>挖矿所获星星倍率：<input type="number" autocomplete="off" name="deminingStar" value="<?php echo $wmCard_set['deminingStar']; ?>" /></label>
                <label>卡牌CDN(注意末尾斜杆)：<input type="text" name="cdn" placeholder="不填写则为本地" value="<?php echo $wmCard_set['cdn']; ?>" /></label>
                <label>关闭插件后删除表(1为删除 0为不删除)：<input type="number" name="delDatabase" autocomplete="off" placeholder="1为删除 0为不删除" value="<?php echo $wmCard_set['delDatabase']; ?>" /></label>
                <label>挖矿设置验证码(1为设置 0为不设置)：<input type="number" name="deminingCaptcha" autocomplete="off" placeholder="1为设置 0为不设置" value="<?php echo $wmCard_set['deminingCaptcha']; ?>" /></label>
                <label>腾讯防水墙App Secret Key：<input type="text" name="appSecretKey" placeholder="请填写App Secret Key" value="<?php echo $wmCard_set['appSecretKey']; ?>" /></label>
                <label>腾讯防水墙App ID：<input type="text" name="appID" placeholder="请填写App ID" value="<?php echo $wmCard_set['appID']; ?>" /></label>
                <label>腾讯防水墙注册：<a href="http://007.qq.com" target="_blank">http://007.qq.com</a></label>
                <label>捐赠地址：<input type="text" name="donate" placeholder="填写用于捐赠显示的页面地址" value="<?php echo $wmCard_set['donate']; ?>" /></label>
                <br />
                <input type="submit" value="更改设置" />
        </form>
        <form class="card_setting" method="post">  
                <input type="hidden" name="wmtoken" value="<?php echo $_SESSION['wmtoken']?>">
                <input type="hidden" name="settingType" value="postStar" />
                <div>给邮箱<input style="margin:0 5px;" type="text" name="giveEmail" placeholder="请输入邮箱" value="" autocomplete="on" />赠送<input style="margin:0 5px;" type="number" name="star" placeholder="请输入星星数量" value="" autocomplete="off" />个星星</div>
                <br />
                <input type="submit" value="发送星星" />
        </form>
        <?php
	
}

if(!empty($_POST)&&valid_wmtoken()){
        if($_POST['settingType']=='setting'){
                $chance=empty(intval($_POST['chance']))?'1':trim($_POST['chance']);
                $deminingStar=empty(intval($_POST['deminingStar']))?'1':trim($_POST['deminingStar']);
                $cdn=empty($_POST['cdn'])?'':trim($_POST['cdn']);
                $delDatabase=empty($_POST['delDatabase'])?0:trim($_POST['delDatabase']);
                $deminingCaptcha=empty($_POST['deminingCaptcha'])?0:trim($_POST['deminingCaptcha']);
                $donate=empty($_POST['donate'])?'':trim($_POST['donate']);
                $appSecretKey=empty($_POST['appSecretKey'])?'':trim($_POST['appSecretKey']);
                $appID=empty($_POST['appID'])?'':trim($_POST['appID']);

                file_put_contents(dirname(__FILE__).'/wm_card.com.php','<?php die; ?>'.serialize(array(
                'chance'=>$chance,
                'deminingStar'=>$deminingStar,
                'cdn'=>$cdn,
                'delDatabase'=>$delDatabase,
                'deminingCaptcha'=>$deminingCaptcha,
                'donate'=>$donate,
                'appSecretKey'=>$appSecretKey,
                'appID'=>$appID,
                )));
                echo '<div class="success_alert">设置成功</div>'; 
        }else if($_POST['settingType']=='postStar'){
                $emailAddr = strip_tags($_POST['giveEmail']);
                $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
                if(isset($emailAddr) && $emailAddr!=""){
                        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
                                //邮箱地址正确
                                $DB = MySql::getInstance();
                                $send_email = "\"".md5($emailAddr)."\"";
                                $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$send_email."");
                                $mgidinfo=$DB->fetch_array($mgid);
                                if (!$mgidinfo){
                                        echo '<div class="error_alert">无该用户</div>';
                                }else{
                                        $starCount = intval($_POST['star']);
                                        if(empty($starCount)){
                                                //输入的星星有误
                                                echo '<div class="error_alert">请输入1以上的星星数量</div>';
                                        }else{
                                                //开始赠送
                                                $query = "Update ".DB_PREFIX."wm_card set starCount=starCount+".$starCount." where email=".$send_email."";
                                                $result=$DB->query($query);
                                                echo '<div class="success_alert">成功给'.$emailAddr.'赠送了'.$starCount.'个星星</div>';
                                        }
                                }
                        }else{
                                echo '<div class="error_alert">邮箱地址有误</div>'; 
                        }
                }else{
                        echo '<div class="error_alert">邮箱地址有误</div>';
                }
        }
        

        //header("Location: {$_SERVER['REQUEST_URI']}");
}

?>