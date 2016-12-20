<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/lang/lang.'.currentlang().'.php';
$robot_check = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('robot');
if ($robot_check) {
	$robot_cmd = C::t('#hux_wx#hux_wx_robot')->fetch_by_appcmd('robot');
	if ($robot_cmd) {
		include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/robot.php';
	}
}
?>