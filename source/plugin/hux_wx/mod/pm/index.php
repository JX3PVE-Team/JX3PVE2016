<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$ccmsg = "\n".str_replace('{cc}',$wxsetting['cc'],lang('plugin/hux_wx','ccmsg'));
if ($binded) {
	$user_cm = C::t('#hux_wx#hux_common_member')->fetch_by_uid($binded['uid'],'groupid');
	if (in_array($user_cm['groupid'],$postgp)) {
		$string = lang('plugin/hux_wx','noop');
	} else {
		C::t('#hux_wx#hux_wx_action')->insert(array('openid'=>$openid,'action'=>'0','type'=>$keyword,'dateline'=>TIMESTAMP));
		$string = lang('plugin/hux_wx','touid').$ccmsg;
	}
} else {
	$string = lang('plugin/hux_wx','tobind');
}

echo WeChatServer::getXml4Txt($string);
?>