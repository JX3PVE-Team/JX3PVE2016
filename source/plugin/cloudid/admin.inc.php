<?php
/**
 *	[ÔÆ¶ËID(cloudid.{modulename})] (C)2014-2099 Powered by Ricky.
 *	Version: 1.0
 *	Date: 2014-4-15 13:12
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

loadcache('pluginlanguage_script');
$Plang = $_G['cache']['pluginlanguage_script']['cloudid'];
//²µ»Ø
if($_GET['op'] == 'refuse') {
	C::t('#cloudid#cloudid')->refuse_by_nid($_GET['nid']);
    notification_add($_GET['uid'], 'system', 'cloudid:applyrefused',1);//Õ¾¶Ì
	ajaxshowheader();
	echo $Plang['refused'];
	ajaxshowfooter();
//Í¨¹ýÉóºË
}else if($_GET['op'] == 'pass') {
	C::t('#cloudid#cloudid')->pass_by_nid($_GET['nid']);
	notification_add($_GET['uid'], 'system', 'cloudid:applypass',1);
	ajaxshowheader();
	echo $Plang['passed'];
	ajaxshowfooter();
}
showtableheader();
echo '<tr class="header"><th>'.$Plang['applyuser'].'</th><th>'.$Plang['currentid'].'</th><th>'.$Plang['newid'].'</th><th></th></tr>';
$lists = DB::fetch_all("SELECT * FROM ".DB::table('cloudid')."");
$uids = array();
foreach($lists as $applyuser) {
	$uids[] = $applyuser['uid'];
}
$users = C::t('common_member')->fetch_all($uids);
$i = 0;
foreach($lists as $applyuser) {
	$applyuser['username'] = rawurlencode($users[$applyuser['uid']]['username']);
	$i++;
	if($applyuser['status']==0){
		echo '<tr><td>'.$applyuser['username'].'</td>'.
			'<td>'.$applyuser['currentid'].'</td>'.
			'<td>'.$applyuser['newid'].'</td>'.
			'<td>'.$myrepeat['reladata'].'</td>'.
			'<td>
			<a id="p'.$i.'" onclick="ajaxget(this.href, this.id, \'\');return false" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.
			'&identifier=cloudid&pmod=admin&uid='.$applyuser['uid'].'&nid='.$applyuser['nid'].'&op=pass">['.$Plang['pass'].']</a>
			<a id="r'.$i.'" onclick="ajaxget(this.href, this.id, \'\');return false" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.
			'&identifier=cloudid&pmod=admin&uid='.$applyuser['uid'].'&nid='.$applyuser['nid'].'&op=refuse">['.$Plang['refuse'].']</a></td></tr>';
	}
}
showtablefooter();

?>