<?php
/**
 *	[云端ID(cloudid.{modulename})] (C)2014-2099 Powered by Ricky.
 *	Version: 1.0
 *	Date: 2014-4-15 13:12
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$pg=$_G['cache']['plugin']['cloudid'];
//登录状态
if(!$_G['uid']) {
	showmessage('not_loggedin', NULL, array(), array('login' => 1));
}

//提交
if($_GET['pluginop'] == 'submit' && submitcheck('cloudid')) {

	$currentid = addslashes(strip_tags($_GET['currentid']));
	$newid = addslashes(strip_tags($_GET['newid']));
	$time = C::t('#cloudid#cloudid')->count_by_uid($_G['uid']);
	//积分检查
	$credits = DB::fetch(DB::query("SELECT * FROM ".DB::table('common_member_count'). " WHERE uid = $_G[uid]")); 
	if($credits['extcredits'.$pg['credit']]<=$pg['minimum']) {
		showmessage('cloudid:crediterror');
	}else if($time >= $pg['times']){//本月提交次数超过上限
		showmessage('cloudid:morethanmaxtime');	
	}else if($currentid==""||$newid==""){
		showmessage('cloudid:notnull');	
	}else{
		DB::query("INSERT INTO ".DB::table('cloudid')." (nid, uid, currentid, newid, status) VALUES (NULL, '$_G[uid]','$currentid','$newid', '0')");
        notification_add(1, 'system', 'cloudid:newsubmission',array('username'=>$_G[username]),1);
	}
	dsetcookie('mrn', '');
	dsetcookie('mrd', '');
	showmessage('cloudid:submit_succeed', 'home.php?mod=spacecp&ac=plugin&id=cloudid:cloudid');
}

$_G['basescript'] = 'home';


?>