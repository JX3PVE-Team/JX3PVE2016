<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/lang/lang.'.currentlang().'.php';
echo '<a href='.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'>'.$robotlang['cmdadmin'].'</a>';
echo '<tr class="header"><th>'.$robotlang['simsimi'].'</th><th></th></tr>';
$simsimicheckedc = $appconfig['simsimi'] == '1' ? 'checked' : '';
$simsimicheckedd = ($appconfig['simsimi'] == '0' || !$appconfig['simsimi']) ? 'checked' : '';
echo '<tr><td><input name="simsimi" type="radio" value="1" '.$simsimicheckedc.' />'.$robotlang['yes'].'&nbsp;<input name="simsimi" type="radio" value="0" '.$simsimicheckedd.' />'.$robotlang['no'].'</td><td></td></tr>';
echo '<tr class="header"><th>'.$robotlang['simsimiak'].'</th><th></th></tr>';
echo '<tr><td><input name="ak" type="text" value="'.$appconfig['ak'].'" size="40" /></td><td>'.$robotlang['simsimiurl'].'<a href="http://cloud.xiaoi.com/" target="_blank">http://cloud.xiaoi.com/</a></td></tr>';
echo '<tr class="header"><th>'.$robotlang['simsimisk'].'</th><th></th></tr>';
echo '<tr><td><input name="sk" type="text" value="'.$appconfig['sk'].'" size="40" /></td><td></td></tr>';
?>