<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/unbind/lang/lang.'.currentlang().'.php';
$unbind_qd = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('qd');
if ($unbind_qd) {
	$appconfig_qd = unserialize($unbind_qd['configs']);
	updatemembercount($binded['uid'] , array($paymoney => -$appconfig_qd['qdmoney']));
}
$unbind_bd = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('bind');
if ($unbind_bd) {
	$appconfig_bd = unserialize($unbind_bd['configs']);
	if ($appconfig_bd['verify'] && $appconfig_bd['verify'] != '0') {
		$vid = C::t('common_member_verify')->count_by_uid($binded['uid']);
		if ($vid > 0) {
			C::t('common_member_verify')->update($binded['uid'],array($appconfig_bd['verify']=>0));
		}
	}
}
C::t('#hux_wx#hux_wx')->delete($openid);
C::t('#hux_wx#hux_wx_action')->delete($openid);
$string = $unbindlang['unbind'];
echo WeChatServer::getXml4Txt($string);
?>