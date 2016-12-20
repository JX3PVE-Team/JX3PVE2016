<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$_G['wechat']['setting'] = unserialize($_G['setting']['mobilewechat']);
if(!$_G['wechat']['setting']['wechat_appId'] || !$_G['wechat']['setting']['wechat_appsecret']) {
	cpmsg(lang('plugin/wechat', 'wsq_menu_at_error'), 'action=plugins&operation=config&identifier=wechat&pmod=wechat_setting', 'error');
}
dheader('location:admin.php?action=plugins&operation=config&do=15&identifier=wechat&pmod=menu_setting');
?>