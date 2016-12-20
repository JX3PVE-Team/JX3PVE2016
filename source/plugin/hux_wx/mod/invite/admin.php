<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/invite/lang/lang.'.currentlang().'.php';
echo '<tr class="header"><th>'.$invitelang['uid'].'</th><th></th></tr>';
echo '<tr><td><input name="uid" type="text" value="'.$appconfig['uid'].'" size="40" /></td><td></td></tr>';
echo '<tr class="header"><th>'.$invitelang['yxtime'].'</th><th></th></tr>';
echo '<tr><td><input name="yxtime" type="text" value="'.$appconfig['yxtime'].'" size="40" /></td><td></td></tr>';
echo '<tr class="header"><th>'.$invitelang['gettime'].'</th><th></th></tr>';
echo '<tr><td><input name="gettime" type="text" value="'.$appconfig['gettime'].'" size="40" /></td><td></td></tr>';
?>