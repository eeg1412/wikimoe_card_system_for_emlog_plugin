<?php
require_once('../../../init.php');
function searchWmRank(){
    $wmRankJsonData = null;
    if(file_exists('cardRank.json')){//判断json文件是否存在
        $wmRankJsonData = json_decode(file_get_contents('cardRank.json'),true);
        $updataTime = $wmRankJsonData['updataTime'];
        $NewtimeStamp = time();
        if($NewtimeStamp - $updataTime > 604800){
            //已经一周没更新了
            $wmRankJsonData = searchWmDataBaseByRank();
        }
    }else{
        $wmRankJsonData = searchWmDataBaseByRank();
    }
    echo json_encode($wmRankJsonData);
}
function searchWmDataBaseByRank(){
    $DB = MySql::getInstance();
    $mgidScore=$DB->query("
        SELECT *
        FROM `".DB_PREFIX."wm_card`
        ORDER BY `".DB_PREFIX."wm_card`.`score` DESC
        LIMIT 0 , 10
    ");
    $mgidCardLength=$DB->query("
        SELECT *
        FROM `".DB_PREFIX."wm_card`
        ORDER BY LENGTH(cardID) DESC
        LIMIT 0 , 10
    ");
    $mgidLevel=$DB->query("
        SELECT *
        FROM `".DB_PREFIX."wm_card`
        ORDER BY `".DB_PREFIX."wm_card`.`level` DESC
        LIMIT 0 , 10
    ");
    $wmRankScoreArr = array();
    $wmRankCardArr = array();
    $wmRankLevel = array();
    $timeStamp = time();
    while($result=$DB->fetch_array($mgidScore)){
        array_push($wmRankScoreArr,array('score'=>$result['score'],'email'=>$result['email']));
    }
    while($result=$DB->fetch_array($mgidCardLength)){
        array_push($wmRankCardArr,array('cardID'=>$result['cardID'],'email'=>$result['email']));
    }
    while($result=$DB->fetch_array($mgidLevel)){
        array_push($wmRankLevel,array('level'=>$result['level'],'email'=>$result['email']));
    }
    $wmRankJsonData = array('score'=>$wmRankScoreArr,'card'=>$wmRankCardArr,'level'=>$wmRankLevel,'updataTime'=>$timeStamp);
    file_put_contents('cardRank.json', json_encode($wmRankJsonData));
    return $wmRankJsonData;
};
searchWmRank();
?>
