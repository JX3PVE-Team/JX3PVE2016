<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/getpm/lang/lang.'.currentlang().'.php';
if ($binded) {
	$md5hash = md5($binded['uid'].TIMESTAMP.mt_rand(1000,9999).$_G['authkey']);
	C::t('#hux_wx#hux_wx')->update($openid,array('cjpass'=>$md5hash));
	$md5hash = md5($md5hash.$binded['uid'].$openid);
	$string[] = array(
		'title' => $getpmlang['appcmdtxt'],
		'desc' => '',
		'pic' => $_G['siteurl'].'source/plugin/hux_wx/mod/getpm/images/pm.jpg',
		'url' => $_G['siteurl'],
	);
	loaducenter();
	$pmdata = uc_pm_list($binded['uid'],1,9);
	if ($pmdata['data']) {
		foreach ($pmdata['data'] as $v) {
			$string[] = array(
				'title' => '['.$v['msgfromid'].']['.$v['msgfrom'].']'.$v['message'].'('.dgmdate($v['dateline']).')',
				'desc' => '',
				'pic' => $_G['setting']['ucenterurl'].'/avatar.php?uid='.$v['msgfromid'].'&size=big',
				'url' => $_G['siteurl'].'plugin.php?id=hux_wx:hux_wx&mod=getpm&ac=view&touid='.$v['msgfromid'].'&openid='.$openid.'&md5hash='.$md5hash.'&mobile=2',
			);	
		}
		echo WeChatServer::getXml4RichMsgByArray($string);
	} else {
		$string = $getpmlang['nopm'];
		echo WeChatServer::getXml4Txt($string);
	}
} else {
	$string = lang('plugin/hux_wx','tobind');
	echo WeChatServer::getXml4Txt($string);
}
?>