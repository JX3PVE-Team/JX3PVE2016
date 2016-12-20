<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$Plang = $scriptlang['hux_wx'];
require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
$pluginid = 'hux_wx';
$data = array(
	'receiveMsg::text' => array(
		'plugin' => $pluginid,
		'include' => 'api.class.php',
		'class' => $pluginid.'_api',
		'method' => 'text'
	),
	'receiveMsg::location' => array(
		'plugin' => $pluginid,
		'include' => 'api.class.php',
		'class' => $pluginid.'_api',
		'method' => 'location'
	),
	'receiveMsg::image' => array(
		'plugin' => $pluginid,
		'include' => 'api.class.php',
		'class' => $pluginid.'_api',
		'method' => 'image'
	),
	'receiveEvent::subscribe' => array(
		'plugin' => $pluginid,
		'include' => 'api.class.php',
		'class' => $pluginid.'_api',
		'method' => 'subscribe'
	),
	'receiveEvent::unsubscribe' => array(
		'plugin' => $pluginid,
		'include' => 'api.class.php',
		'class' => $pluginid.'_api',
		'method' => 'unsubscribe'
	),
	'receiveEvent::click' => array(
		'plugin' => $pluginid,
		'include' => 'api.class.php',
		'class' => $pluginid.'_api',
		'method' => 'click'
	),
);
WeChatHook::updateResponse($data);
cpmsg($Plang['opsus'], 'action=plugins&operation=config&identifier=wechat&pmod=response_setting', 'succeed');

?>