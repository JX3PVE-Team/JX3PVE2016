<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/push/lang/lang.'.currentlang().'.php';
$ccmsg = "\n".str_replace('{cc}',$wxsetting['cc'],lang('plugin/hux_wx','ccmsg'));
if ($huxaction['action'] == '0') {
	$user = C::t('#hux_wx#hux_uc_members')->fetch_by_uid($keyword,'uid');
	if (!$user) {
		C::t('#hux_wx#hux_wx_action')->delete($openid);
		$string = lang('plugin/hux_wx','nouid');
	} else {
		C::t('#hux_wx#hux_wx_action')->update($openid,array('action'=>$keyword,'dateline'=>TIMESTAMP));
		$string = $pushlang['inputbody'].$ccmsg;
	}
} else {
	notification_add($huxaction['action'],'system',$keyword,0,1);
	C::t('#hux_wx#hux_wx_action')->delete($openid);
	$string = $pushlang['pushsus'];
}

echo WeChatServer::getXml4Txt($string);
?>