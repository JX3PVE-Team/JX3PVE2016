<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/pic/lang/lang.'.currentlang().'.php';
echo '<tr class="header"><th>'.$piclang['delday'].'</th><th></th></tr>';
echo '<tr><td><input name="delday" type="text" value="'.$appconfig['delday'].'" size="40" /></td><td></td></tr>';

?>