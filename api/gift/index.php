<?php

require_once '../../source/class/class_core.php';
require_once '../../source/function/function_core.php';

$discuz = C::app();
$discuz->init();

$do = isset($_GET['do']) ? trim($_GET['do']) : '';
if (!$do || !in_array($do, array("list", "buy", "history"))) {
    json_output(2, "参数错误");
}

if ($do == "list") { 
    $gifts = C::t('gift')->fetch_all_gift(); 
	$data = array();
	foreach ((array)$gifts as $gift) {
        $cost = json_decode($gift['cost'], true); 
		$temp = array();
		$temp['gift_id'] = (int)$gift['gift_id'];
		$temp['cost'] = array('水晶' => $cost[8], '人气' => $cost[5]);
		$temp['name'] = $gift['name'];
		$temp['url'] = $gift['url'];
		$temp['image'] = $gift['image'];
		$temp['num'] = (int)$gift['num'];
		$temp['sponsors'] = $gift['sponsors'];
		$temp['sponsors_url'] = $gift['sponsors_url'];
		$data[] = $temp;
	}
  json_output(0, "操作成功", $data);
    
} elseif ($do == "buy") {
    if(empty($_G['uid'])) {
        json_output(1, "请先登录");
    }
    
    $uid = intval($_G['uid']);
    $gift_id = isset($_GET['gift_id']) ? intval($_GET['gift_id']) : 0;
    if ($gift_id <= 0) {
        json_output(2, "参数错误");
    }

    $gift = C::t('gift')->fetch_gift_by_id($gift_id);
    if (!$gift) {
        json_output(3, "礼品不存在");
    }

    if ($gift['num'] < 1) {
        json_output(4, "礼品库存不足");
    }

    $cost = json_decode($gift['cost'], true); 

    $membercount = C::t('common_member_count'.$tableext)->fetch($uid);
    if ($membercount['extcredits8'] < $cost[8] || $membercount['extcredits5'] < $cost[5]) {
        json_output(5, "积分不足");
    }


	$addcredit = array('extcredits5' => -$cost[5], 'extcredits8' => -$cost[8]);
    C::t('common_member_count')->increase($uid, $addcredit);
	C::t('gift_member')->insert_gift($uid, $gift);
    C::t('gift')->decrease($gift_id);
	json_output(0, "操作成功");
} elseif ($do == "history") {
    if(empty($_G['uid'])) {
        json_output(1, "请先登录");
    }
    
    $uid = intval($_G['uid']);
    $gifts = C::t('gift_member')->fetch_gifts_by_uid($uid);
	$data = array();
	foreach ((array)$gifts as $gift) {
        $cost = json_decode($gift['cost'], true); 
		$temp = array();
		$temp['gift_id'] = (int)$gift['gift_id'];
		$temp['cost'] = array('水晶' => $cost[8], '人气' => $cost[5]);
		$temp['name'] = $gift['gift_name'];
		$temp['status'] = (int)$gift['status'];
		$temp['date'] = date("Y-m-d H:i:s", $gift['addtime']);
		$data[] = $temp;
	}
	json_output(0, "操作成功", $data);

}

function json_output($code, $msg, $data = array()) {
    $output = array();
    $output['msg'] = $msg;
    $output['code'] = $code;
    $output['data'] = $data;
    echo json_encode($output);
    exit();
}
