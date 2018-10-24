<?php
require_once('../../../init.php');
require_once('module.php');
function deminingInit(){
    //初始化埋藏的星星生成星星地图
    $rows = 10;//get rows 
    $cols = 10;//get cols 
    $num = 10;//get num 
    $data = array();//data initialization 
    for($i=0;$i<$rows;$i++){//all the rows 
        for($j=0;$j<$cols;$j++){//all the cols 
            $data["data".$i."_".$j] = 0;//set mine with null 
            $data["open".$i."_".$j] = 0;//set node with close 
        } 
    } 
    $i=0;//reset the index,and set the mines(Random setting) 
    while($i < $num){//number of mine 
        $r = mt_rand(0,$rows - 1);//row's index 
        $c = mt_rand(0,$cols - 1);//col's index 
        if($data["data".$r."_".$c] == 0){//if not a mine 
        $data["data".$r."_".$c] = 100;//set the node with a mine 
        $i++; 
        } 
    } 
    for($i=0;$i<$rows;$i++){//all the rows 
        for($j=0;$j<$cols;$j++){//all the cols 
            if($data["data".$i."_".$j] == 100)continue;
            //is not a mine , set number of adjacent mines  
            $cnt = 0; 
            if($i - 1 >= 0 && $j - 1 >= 0 && $data["data".($i - 1)."_".($j - 1)] == 100){
                $cnt++;//upper left
            } 
            if($i - 1 >= 0 && $data["data".($i - 1)."_".$j] == 100){
                $cnt++;//left
            } 
            if($i - 1 >= 0 && $j + 1 < $cols && $data["data".($i - 1)."_".($j + 1)] == 100){
                $cnt++;//lower left
            } 
            if($j - 1 >= 0 && $data["data".$i."_".($j - 1)] == 100){
                $cnt++;//upper 
            }
            if($j + 1 < $cols && $data["data".$i."_".($j + 1)] == 100){
                $cnt++;//lower 
            }
            if($i + 1 < $rows && $j - 1 >= 0 && $data["data".($i + 1)."_".($j - 1)] == 100){
                $cnt++;//upper right
            } 
            if($i + 1 < $rows && $data["data".($i + 1)."_".$j] == 100){
                $cnt++;//right
            } 
            if($i + 1 < $rows && $j + 1 < $cols && $data["data".($i + 1)."_".($j + 1)] == 100){
                $cnt++;//lower right
            } 
            $data["data".$i."_".$j] = $cnt;//set number 
        } 
    }
    $wmDeminingData = array('map'=>$data,'rows'=>$rows,'cols'=>$cols,'boomNum'=>$num,'boomedNum'=>0,'player'=>array());
    wmDeminingGameWrite($wmDeminingData);
    //echo json_encode($data); 
}
function wmDeminingGameWrite($data){
    file_put_contents(dirname(__FILE__).'/DeminingGame.com.php','<?php die; ?>'.serialize($data),LOCK_EX); 
}
function startWmDeminingGame(){
    if(!file_exists(dirname(__FILE__).'/DeminingGame.com.php')){//判断数据文件是否存在
        deminingInit();
        echo json_encode(wxportWmDeminingGameMap());
    }else{
        echo json_encode(wxportWmDeminingGameMap());
    }
}
function wxportWmDeminingGameMap(){
    $wmExportDeminingGameData=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/DeminingGame.com.php'),'<?php die; ?>'));//获取信息
    $wmExportMap = array();
    for($i=0; $i<$wmExportDeminingGameData['rows']; $i++){
        for($j=0; $j<$wmExportDeminingGameData['cols']; $j++){
            if($wmExportDeminingGameData['map']['open'.$i.'_'.$j]==1){
                $exportName = 'data'.$i.'_'.$j;
                $wmExportMap[$exportName] = $wmExportDeminingGameData['map']['data'.$i.'_'.$j];
            }
        }
    }
    $wmExportDeminingGameMap = array('map' => $wmExportMap ,'rows'=>$wmExportDeminingGameData['rows'],'cols'=>$wmExportDeminingGameData['cols'],'player'=>$wmExportDeminingGameData['player']);
    return $wmExportDeminingGameMap; 
}
function wmCheckDemNode($wmClickNode){
    $DB = MySql::getInstance();
    $emailAddr = strip_tags($_POST['email']);
    // $password = strip_tags($_POST['password']);
    $checkmail="/^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%=~^\{\}\/\+!#&\$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/";//定义正则表达式
    if(isset($emailAddr) && $emailAddr!=""){
        if(preg_match($checkmail,$emailAddr)){//用正则表达式函数进行判断  
            $emailAddrMd5 = "\"".md5($emailAddr)."\"";
            $mgid=$DB->query("SELECT * FROM ".DB_PREFIX."wm_card WHERE email=".$emailAddrMd5."");
            $mgidinfo=$DB->fetch_array($mgid);
            if ($mgidinfo) {
                //有该用户
                $timeStamp = time();//获取当前时间
                $deminingStamp = intval ($mgidinfo['deminingStamp']);//获取上次挖矿时间
                if($timeStamp-$deminingStamp>7200){
                    //已经冷却开始挖矿
                    //检查点击的节点
                    $wmNodeData = null;
                    $checkNodeText="/^[0-9_]{1,}$/";//定义正则表达式
                    if(preg_match($checkNodeText,$wmClickNode)){
                        //传入参数符合正则
                        $wmDeminingGameData=unserialize(ltrim(file_get_contents(dirname(__FILE__).'/DeminingGame.com.php'),'<?php die; ?>'));//获取信息
                        $wmDeminingGameDataMap = $wmDeminingGameData['map'];
                        $node = explode("_", $wmClickNode);//get the node of click 
                        $rows = $wmDeminingGameData['rows'];
                        $cols = $wmDeminingGameData['cols'];
                        $num = $wmDeminingGameData['boomNum'];
                        $players = $wmDeminingGameData['player'];
                        $boomedNum = $wmDeminingGameData['boomedNum'];//已经挖到了多少次星星
                        $wmopenedData = openNode($node[0],$node[1],$rows,$cols,$wmDeminingGameData,$wmDeminingGameDataMap);//校验节点是否存在并尝试打开节点
                        if($wmopenedData){
                            //节点正常
                            array_push($players,array('xy'=>$wmClickNode,'emailMD5'=>md5($emailAddr)));
                            $wmNodeDataStatu = 0;
                            $wmNodeLastBoom = 0;
                            $randomStar = 0;
                            $wmAttackData = $wmDeminingGameDataMap["data".$wmClickNode];
                            if($wmAttackData == 100){
                                $wmNodeDataStatu = 1;//中了！
                                $boomedNum = $boomedNum+1;
                                $randomStar = mt_rand(5,40);
                            }
                            if($boomedNum == $num){
                                deminingInit();
                                $wmNodeLastBoom = 1;
                                //所有星星被挖光
                            }else{
                                $wmNodeData = array('map'=>$wmopenedData,'rows'=>$rows,'cols'=>$cols,'boomNum'=>$num,'boomedNum'=>$boomedNum,'player'=>$players);
                                wmDeminingGameWrite($wmNodeData);
                            }
                            //写入动态JSON
                            $gameJsonData = array('mailMD5'=>md5($emailAddr),'getStar'=>$randomStar,'attackNum'=>$wmAttackData,'lastBoom'=>$wmNodeLastBoom,'massageType'=>'demining');
                            wmWriteJson($gameJsonData);
                            if($wmNodeLastBoom==1){
                                //如果是最后一片矿，则不更新时间戳也就是说可以连续挖。
                                $timeStamp = $deminingStamp;
                            }
                            //更新数据库
                            $query = "Update ".DB_PREFIX."wm_card set deminingStamp=".$timeStamp.", starCount=starCount+".$randomStar." where email=".$emailAddrMd5."";
                            $result=$DB->query($query);
                            //更新缓存数据
                            $clickNodeResault = wxportWmDeminingGameMap();
                            //定义Json发送内容
                            $clickNodeResault['timeStamp'] = $timeStamp;
                            $clickNodeResault['clickNum'] = $wmAttackData;
                            $clickNodeResault['code'] = 202;
                            $clickNodeResault['boom'] = $wmNodeDataStatu;
                            $clickNodeResault['lastBoom'] = $wmNodeLastBoom;
                            $clickNodeResault['getStar'] = $randomStar;
                            echo json_encode($clickNodeResault);
                        }else{
                            $NowNodeResault = wxportWmDeminingGameMap();
                            $NowNodeResault['code'] = 101;;//不是一个节点或者节点已经打开了
                            echo json_encode($NowNodeResault);
                        }
                    }else{
                        $wmNodeData = array('code'=>0);//字符串有误
                        echo json_encode($wmNodeData);
                    }
                    
                }else{
                    $wmNodeData = array('code'=>203,'deminingStamp'=>$deminingStamp);//还在冷却
                    echo json_encode($wmNodeData);
                }
            }else{
                $wmNodeData = array('code'=>3);//无该用户
                echo json_encode($wmNodeData);
            }
        }else{
            $wmNodeData = array('code'=>2);//邮箱有误
            echo json_encode($wmNodeData);
        }
    }else{
        $wmNodeData = array('code'=>2);//邮箱有误
        echo json_encode($wmNodeData);
    }
    
    //echo json_encode($wmNodeData); 
}
function openNode($i,$j,$rows,$cols,$wmDeminingGameData,$wmDeminingGameDataMap){//set nodes to open,if it is can open 
    $data = $wmDeminingGameDataMap;
    if($i < 0 || $i >= $rows || $j < 0 || $j >= $cols || $data["open".$i."_".$j]){
        //说明这不是一个节点或者节点已经打开了
        return false;
    }
    $data["open".$i."_".$j] = 1;//打开节点
    return $data;
  } 
if(isset($_POST['type'])=='open' && isset($_POST['email'])){
    if(strip_tags($_POST['type'])=='open'){
        $wmClickNode = $_POST['node'];
        wmCheckDemNode($wmClickNode);
    }else{
        startWmDeminingGame();
    }
}else{
    startWmDeminingGame();
}
?>