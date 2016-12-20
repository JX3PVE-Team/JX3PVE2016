<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$ccmsg = "\n".str_replace('{cc}',$wxsetting['cc'],lang('plugin/hux_wx','ccmsg'));
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/pm/lang/lang.'.currentlang().'.php';
if ($huxaction['action'] == '0') {
	loaducenter();
	$user = uc_get_user($keyword,1);
	if ($user == 0) {
		C::t('#hux_wx#hux_wx_action')->delete($openid);
		$string = lang('plugin/hux_wx','nouid');
	} else {
		if ($keyword == $binded['uid']) {
			C::t('#hux_wx#hux_wx_action')->delete($openid);
			$string = $pmlang['notme'];
		} else {
			C::t('#hux_wx#hux_wx_action')->update($openid,array('action'=>$keyword,'dateline'=>TIMESTAMP));
			$string = str_replace('{username}',$user[1],$pmlang['inputbody']).$ccmsg;
		}
	}
} else {
	sendpm($huxaction['action'], $pmlang['title'], $keyword.'[color=Gray]('.$pmlang['title'].')[/color]', $binded['uid']);
	C::t('#hux_wx#hux_wx_action')->delete($openid);
	$string = $pmlang['pmsus'];
}

echo WeChatServer::getXml4Txt($string);
?>