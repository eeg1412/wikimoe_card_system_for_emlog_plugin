<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function plugin_setting_view(){
        $wmCard_set=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/wm_card.com.php'),'<?php die; ?>'));
        ?>
        <style>
        .card_setting label{
                padding-bottom:10px;
                display:block;
        }
        </style>
        <form class="card_setting" method="post">  
        <label>每日抽卡次数：<input type="text" autocomplete="off" name="chance" value="<?php echo $wmCard_set['chance']; ?>" /></label>
        <label>卡牌CDN(注意末尾斜杆)：<input type="text" name="cdn" placeholder="不填写则为本地" value="<?php echo $wmCard_set['cdn']; ?>" /></label>
        <label>关闭插件后删除表(1为删除 0为不删除)：<input type="number" name="delDatabase" autocomplete="off" placeholder="1为删除 0为不删除" value="<?php echo $wmCard_set['delDatabase']; ?>" /></label>
        <br />

        <input type="submit" value="提交" />

        </form>
        <?php
	
}

if(!empty($_POST)){

$chance=empty($_POST['chance'])?'':trim($_POST['chance']);
$cdn=empty($_POST['cdn'])?'':trim($_POST['cdn']);
$delDatabase=empty($_POST['delDatabase'])?0:trim($_POST['delDatabase']);

file_put_contents(dirname(__FILE__).'/wm_card.com.php','<?php die; ?>'.serialize(array(

'chance'=>$chance,
'cdn'=>$cdn,
'delDatabase'=>$delDatabase,

)));


}

?>