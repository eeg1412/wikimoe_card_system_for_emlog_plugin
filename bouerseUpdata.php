<?php
// $bourseListJson = json_decode(file_get_contents('bouerse.json'),true);
// $bourseList = $bourseListJson['data'];
// for($i=0; $i<count($bourseList); $i++){
// 	$bourseList[$i]['bankrupted'] = 0;
// }
// $bourseListJson['data'] = $bourseList;
// file_put_contents('bouerse.json', json_encode($bourseListJson),LOCK_EX);

// $bourseListOutData = json_decode(file_get_contents('bouerse.json'),true);
// $initBouerseData_ = json_decode(file_get_contents('initBouerList.json'),true);
// $bourseListOutDataCount = count($bourseListOutData['data']);
// if(count($initBouerseData_['data'])>$bourseListOutDataCount){
// 	$addBouerseLength = count($initBouerseData_['data']) - $bourseListOutDataCount;
// 	for($k=0;$k<$addBouerseLength;$k++){
// 		$addBouerseData = $initBouerseData_['data'][$bourseListOutDataCount+$k];
// 		array_push($bourseListOutData['data'],$addBouerseData);
// 		file_put_contents('bouerse.json', json_encode($bourseListOutData),LOCK_EX);
// 	}
// }

// echo '更新完毕';
?>