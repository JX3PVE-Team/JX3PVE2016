<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/invite/lang/lang.'.currentlang().'.php';
$buydatestart = TIMESTAMP - $appconfig['gettime'];
$buydateend = TIMESTAMP + 315360000;
$invitecount = C::t('common_invite')->count_by_search(0, 0, '', $buydatestart, $buydateend, $_G['clientip']);
if ($invitecount > 0) {
	$string = str_replace('{gettime}',$appconfig['gettime'],$invitelang['gettimemsg']);
} else {
	$invitecode = random(6);
	$inviteyouxiao = TIMESTAMP + $appconfig['yxtime'] * 86400;
	C::t('common_invite')->insert(array('uid'=>$appconfig['uid'],'code'=>$invitecode,'inviteip'=>$_G['clientip'],'dateline'=>TIMESTAMP,'endtime'=>$inviteyouxiao,'status'=>1));
	$string = str_replace(array('{invitecode}','{invitetime}'),array($invitecode,dgmdate($inviteyouxiao)),$invitelang['invite']);
}

echo WeChatServer::getXml4Txt($string);
?>