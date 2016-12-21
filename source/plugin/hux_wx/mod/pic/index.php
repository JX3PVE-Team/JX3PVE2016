<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/pic/lang/lang.'.currentlang().'.php';
$string[] = array(
	'title' => $piclang['appcmdtxt'],
	'desc' => $piclang['picmsg'],
	'pic' => $_G['siteurl'].'source/plugin/hux_wx/mod/pic/images/pic.jpg',
	'url' => $_G['siteurl'].'plugin.php?id=hux_wx:hux_wx&mod=pic&ac=show&mobile=2',
);

echo WeChatServer::getXml4RichMsgByArray($string);
?>