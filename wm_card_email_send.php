<?php
require_once('../../../init.php');
function wm_card_sendmail_do($mailserver, $port, $mailuser, $mailpass, $mailto, $subject,  $content, $fromname)
{
	$mail = new KL_SENDMAIL_PHPMailer();
	$mail->CharSet = "UTF-8";
	$mail->Encoding = "base64";
	$mail->Port = $port;

	if(KL_MAIL_SENDTYPE == 1)
	{
		$mail->IsSMTP();
	}else{
		$mail->IsMail();
	}
	$mail->Host = $mailserver;
	$mail->SMTPAuth = true;
	$mail->Username = $mailuser;
	$mail->Password = $mailpass;

	$mail->From = $mailuser;
	$mail->FromName = $fromname;

	$mail->AddAddress($mailto);
	$mail->WordWrap = 500;
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $content;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	if($mail->Host == 'smtp.gmail.com' || $mail->Host == 'smtp.zoho.com' || $mail->Host == 'smtp.qq.com' || $mail->Host == 'smtp.exmail.qq.com') $mail->SMTPSecure = "ssl";
	if(!$mail->Send())
	{
		echo $mail->ErrorInfo;
		return false;
	}else{
		return true;
	}
}
function wm_card_code_mail(){
    $DB = Database::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
                //有该用户
                $timeStamp = time();
                $verifyCodeStamp = intval ($mgidinfo['verifyCodeStamp']);
                $timeStampYMD = date("Ymd", $timeStamp);
				$verifyCodeStampYMD =  date("Ymd", $verifyCodeStamp);
                $canEmailFlag = false;
                $verifyCodeCount = intval ($mgidinfo['verifyCodeCount']);
                if($timeStampYMD == $verifyCodeStampYMD){
                    if($verifyCodeCount<15){
                        $canEmailFlag = true;
                        $timeSpeed = $timeStamp - $verifyCodeStamp;//计算有没有发送过快
                        if($timeSpeed<=60){
                            $canEmailFlag = false;
                        }
                    }
                }else{
                    $verifyCodeCount = 0;
                    $canEmailFlag = true;
                }

                if($canEmailFlag){
                    include(EMLOG_ROOT.'/content/plugins/kl_sendmail/kl_sendmail_config.php');
                    $blogname = Option::get('blogname');
                    $subject = "您在抽卡系统中的动态密码";
                    $randomPass = mt_rand(12001301, 99999999);
                    $content = "<p>尊敬的大佬，您好</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您在".$blogname."的抽卡系统中的动态密码为：&lt;".$randomPass."&gt;，30分钟内有效可多次使用。</p><p>祝您抽卡愉快!</p>";

                    $query = "Update ".DB_PREFIX."wm_card set verifyCode=".$randomPass." , verifyCodeStamp=".$timeStamp." , verifyCodeCount=".$verifyCodeCount."+1 where email=".$emailAddrMd5."";
                    $result=$DB->query($query);
                    if(wm_card_sendmail_do(KL_MAIL_SMTP, KL_MAIL_PORT, KL_MAIL_SENDEMAIL, KL_MAIL_PASSWORD, $emailAddr, $subject, $content, $blogname)){
                        echo json_encode(array('code'=>"1"));
                    }else{
                        echo json_encode(array('code'=>"0"));
                    };
                }else{
                    echo json_encode(array('code'=>"4"));//超过邮箱发送限制
                }

            }else{
                echo json_encode(array('code'=>"3"));//不存在该用户
            }
        }else{
            echo json_encode(array('code'=>"2"));//邮箱地址有误
        }
    }else{
        echo json_encode(array('code'=>"2"));//邮箱地址有误
    }
}
wm_card_code_mail();
?>