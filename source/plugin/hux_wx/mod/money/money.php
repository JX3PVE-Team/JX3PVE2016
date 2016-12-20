<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$ccmsg = "\n".str_replace('{cc}',$wxsetting['cc'],lang('plugin/hux_wx','ccmsg'));
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/money/lang/lang.'.currentlang().'.php';

if ($huxaction['action'] == '0') {
	$user = C::t('#hux_wx#hux_uc_members')->fetch_by_uid($keyword,'uid');
	if (!$user) {
		C::t('#hux_wx#hux_wx_action')->delete($openid);
		$string = lang('plugin/hux_wx','nouid');
	} else {
		C::t('#hux_wx#hux_wx_action')->update($openid,array('action'=>$keyword,'dateline'=>TIMESTAMP));
		$string = $moneylang['inputmoney'].$ccmsg;
	}
} else {
	$money = intval($keyword);
	updatemembercount($huxaction['action'] , array($paymoney => $money));
	C::t('#hux_wx#hux_wx_action')->delete($openid);
	$string = $moneylang['moneysus'];
}

echo WeChatServer::getXml4Txt($string);
?>