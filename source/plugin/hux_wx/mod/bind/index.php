<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$ccmsg = "\n".str_replace('{cc}',$wxsetting['cc'],lang('plugin/hux_wx','ccmsg'));
C::t('#hux_wx#hux_wx_action')->insert(array('openid'=>$openid,'action'=>'0','type'=>$keyword,'dateline'=>TIMESTAMP));
$string = lang('plugin/hux_wx','uidusername').$ccmsg;
echo WeChatServer::getXml4Txt($string);
?>