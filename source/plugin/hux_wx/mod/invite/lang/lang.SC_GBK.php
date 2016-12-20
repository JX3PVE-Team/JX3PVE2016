<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$invitelang = array
(
	'appcmdtxt' => "获取注册邀请码",
	'admincmd' => 0,
	'appver' => '1.0.0',
	'configs' => array('uid'=>1,'yxtime'=>1,'gettime'=>60),
	'yxtime' => '有效天数',
	'uid' => '邀请人UID',
	'invite' => "邀请码：{invitecode}\n有效期：{invitetime}",
	'gettime' => '获取间隔秒数',
	'gettimemsg' => '每次获取邀请码的时间间隔为{gettime}秒',
);

?>