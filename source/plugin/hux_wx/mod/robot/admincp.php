<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/lang/lang.'.currentlang().'.php';
$robot_cmd = C::t('#hux_wx#hux_wx_robot')->fetch_by_id($_GET['cmdid']);
echo '<a class="addtr" href='.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&actype=0&ac=add>'.$robotlang['text'].'</a>&nbsp;&nbsp;<a class="addtr" href='.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&actype=1&ac=add>'.$robotlang['pic'].'</a>&nbsp;&nbsp;<a class="addtr" href='.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&actype=2&ac=add>'.$robotlang['music'].'</a>&nbsp;&nbsp;<a class="addtr" href='.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&actype=3&ac=add>'.$robotlang['bind'].'</a> | <a href='.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'>'.$robotlang['cmdadmin'].'</a>';
if ($_GET['actype'] == '0') {
	if (submitcheck('submit')) {
		$robot_cmd_check = C::t('#hux_wx#hux_wx_robot')->fetch_by_appcmd($_GET['appcmd']);
		if ($_GET['ac'] == 'add') {
			if ($robot_cmd_check) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->insert(array('appcmd'=>$_GET['appcmd'],'cmdback'=>$_GET['cmdback']));
			}
		} else {
			if ($robot_cmd_check && $robot_cmd['appcmd'] != $_GET['appcmd']) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->update($_GET['cmdid'],array('appcmd'=>$_GET['appcmd'],'cmdback'=>$_GET['cmdback']));
			}
		}
		cpmsg($Plang['opsus'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'succeed');
	} else {
		if ($_GET['ac'] == 'add') {
			$cmdid = '';
		} else {
			$cmdid = '&cmdid='.$_GET['cmdid'];
		}
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&ac='.$_GET['ac'].'&actype=0'.$cmdid.'&');
		showtableheader();
		echo '<tr class="header"><th>'.$robotlang['cmdname'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="appcmd" type="text" value="'.$robot_cmd['appcmd'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['textbody'].'</th><th></th></tr>';
		echo '<tr><td width="300"><textarea name="cmdback" cols="30" rows="20">'.$robot_cmd['cmdback'].'</textarea></td><td></td></tr>';
		showsubmit('submit', 'submit');
		showtablefooter();
		showformfooter();
	}
} elseif ($_GET['actype'] == '1') {
	if (submitcheck('submit')) {
		$robot_cmd_check = C::t('#hux_wx#hux_wx_robot')->fetch_by_appcmd($_GET['appcmd']);
		$cmdback = array();
		$cmdback['title'] = $_GET['pictitle'];
		$cmdback['description'] = $_GET['pictxt'];
		$cmdback['picurl'] = $_GET['picurl'];
		$cmdback['url'] = $_GET['pictourl'];
		$cmdback = serialize($cmdback);
		if ($_GET['ac'] == 'add') {
			if ($robot_cmd_check) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->insert(array('appcmd'=>$_GET['appcmd'],'cmdback'=>$cmdback,'type'=>1));
			}
		} else {
			if ($robot_cmd_check && $robot_cmd['appcmd'] != $_GET['appcmd']) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->update($_GET['cmdid'],array('appcmd'=>$_GET['appcmd'],'cmdback'=>$cmdback));
			}
		}
		cpmsg($Plang['opsus'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'succeed');
	} else {
		if ($_GET['ac'] == 'add') {
			$cmdid = '';
		} else {
			$cmdid = '&cmdid='.$_GET['cmdid'];
		}
		$cmdback = unserialize($robot_cmd['cmdback']);
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&ac='.$_GET['ac'].'&actype=1'.$cmdid.'&');
		showtableheader();
		echo '<tr class="header"><th>'.$robotlang['cmdname'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="appcmd" type="text" value="'.$robot_cmd['appcmd'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['pictitle'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="pictitle" type="text" value="'.$cmdback['title'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['pictxt'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="pictxt" type="text" value="'.$cmdback['description'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['picurl'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="picurl" type="text" value="'.$cmdback['picurl'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['pictourl'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="pictourl" type="text" value="'.$cmdback['url'].'" size="40" /></td><td></td></tr>';
		showsubmit('submit', 'submit');
		showtablefooter();
		showformfooter();
	}
} elseif ($_GET['actype'] == '2') {
	if (submitcheck('submit')) {
		$robot_cmd_check = C::t('#hux_wx#hux_wx_robot')->fetch_by_appcmd($_GET['appcmd']);
		$cmdback = array();
		$cmdback['musicfrom'] = $_GET['musicfrom'];
		$cmdback['title'] = $_GET['musicname'];
		$cmdback['description'] = $_GET['musictxt'];
		$cmdback['url'] = $_GET['musicurl'];
		if ($_GET['musicdurl'] == '') {
			$cmdback['durl'] = $_GET['musicurl'];
		} else {
			$cmdback['durl'] = $_GET['musicdurl'];
		}
		$cmdback = serialize($cmdback);
		if ($_GET['ac'] == 'add') {
			if ($robot_cmd_check) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->insert(array('appcmd'=>$_GET['appcmd'],'cmdback'=>$cmdback,'type'=>2));
			}
		} else {
			if ($robot_cmd_check && $robot_cmd['appcmd'] != $_GET['appcmd']) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->update($_GET['cmdid'],array('appcmd'=>$_GET['appcmd'],'cmdback'=>$cmdback));
			}
		}
		cpmsg($Plang['opsus'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'succeed');
	} else {
		if ($_GET['ac'] == 'add') {
			$cmdid = '';
		} else {
			$cmdid = '&cmdid='.$_GET['cmdid'];
		}
		$cmdback = unserialize($robot_cmd['cmdback']);
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&ac='.$_GET['ac'].'&actype=2'.$cmdid.'&');
		showtableheader();
		echo '<tr class="header"><th>'.$robotlang['cmdname'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="appcmd" type="text" value="'.$robot_cmd['appcmd'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['musicfrom'].'</th><th></th></tr>';
		echo '<tr><td><select name="musicfrom" style="width:220px;">';
		$selecteda = $cmdback['musicfrom'] == '0' ? 'selected' : '';
		echo '<option value="0" '.$selecteda.'>'.$robotlang['demusic'].'</option>';
		$selectedb = $cmdback['musicfrom'] == '1' ? 'selected' : '';
		echo '<option value="1" '.$selectedb.'>'.$robotlang['netmusic'].'</option>';
		echo '</select></td><td>'.$robotlang['musicfrommsg'].'</td></tr>';
		echo '<tr class="header"><th>'.$robotlang['musicname'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="musicname" type="text" value="'.$cmdback['title'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['musictxt'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="musictxt" type="text" value="'.$cmdback['description'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['musicurl'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="musicurl" type="text" value="'.$cmdback['url'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['musicdurl'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="musicdurl" type="text" value="'.$cmdback['durl'].'" size="40" /></td><td>'.$robotlang['musicmp3hqmsg'].'</td></tr>';
		showsubmit('submit', 'submit');
		showtablefooter();
		showformfooter();
	}
} elseif ($_GET['actype'] == '3') {
	if (submitcheck('submit')) {
		$robot_cmd_check = C::t('#hux_wx#hux_wx_robot')->fetch_by_appcmd($_GET['appcmd']);
		if ($_GET['ac'] == 'add') {
			if ($robot_cmd_check) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->insert(array('appcmd'=>$_GET['appcmd'],'cmdback'=>$_GET['cmdback'],'type'=>3));
			}
		} else {
			if ($robot_cmd_check && $robot_cmd['appcmd'] != $_GET['appcmd']) {
				cpmsg($robotlang['same'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'error');
			} else {
				C::t('#hux_wx#hux_wx_robot')->update($_GET['cmdid'],array('appcmd'=>$_GET['appcmd'],'cmdback'=>$_GET['cmdback']));
			}
		}
		cpmsg($Plang['opsus'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'succeed');
	} else {
		$sqlapp = C::t('#hux_wx#hux_wx_config')->fetch_all('*','ORDER BY paixu ASC');
		if ($_GET['ac'] == 'add') {
			$cmdid = '';
		} else {
			$cmdid = '&cmdid='.$_GET['cmdid'];
		}
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&ac='.$_GET['ac'].'&actype=3'.$cmdid.'&');
		showtableheader();
		echo '<tr class="header"><th>'.$robotlang['cmdname'].'</th><th></th></tr>';
		echo '<tr><td width="300"><input name="appcmd" type="text" value="'.$robot_cmd['appcmd'].'" size="40" /></td><td></td></tr>';
		echo '<tr class="header"><th>'.$robotlang['bindcmd'].'</th><th></th></tr>';
		//echo '<tr><td width="300"><input name="cmdback" type="text" value="'.$robot_cmd['cmdback'].'" size="40" /></td><td></td></tr>';
		echo '<tr><td><select name="cmdback" style="width:220px;">';
		foreach ($sqlapp as $v) {
			$selected = $robot_cmd['cmdback'] == $v['appid'] ? 'selected' : '';
			echo '<option value="'.$v['appid'].'" '.$selected.'>'.$v['appcmdtxt'].'</option>';
		}
		echo '</select></td><td></td></tr>';
		showsubmit('submit', 'submit');
		showtablefooter();
		showformfooter();
	}
} else {
	if (submitcheck('submit')) {
		if(is_array($_POST['delete'])) {
			C::t('#hux_wx#hux_wx_robot')->delete_by_array($_POST['delete']);
		}
		cpmsg($Plang['opsus'], 'action=plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'], 'succeed');
	} else {
		$perpage = 20;
		$fnum = C::t('#hux_wx#hux_wx_robot')->fetch_all_by_search();
		$page = max(1, intval($_GET['page']));
		$start = ($page-1)*$perpage;	
		$fquery = C::t('#hux_wx#hux_wx_robot')->fetch_all_by_search('',"ORDER BY id DESC",1,$start,$perpage);
		showformheader('plugins&operation=config&do='.$pluginid.'&identifier=hux_wx&pmod=admincp&op=modadmin&appid='.$_GET['appid'].'&');
		showtableheader();
		echo "<tr class='header'><th>".$robotlang['select']."</th><th>".$robotlang['cmdname']."</th><th>".$robotlang['backtype']."</th><th>".$Plang['op']."</th></tr>";
		foreach ($fquery as $fresult){
			if ($fresult['type'] == 1) {
				$fresult['typename'] = $robotlang['pictype'];
			} elseif ($fresult['type'] == 2) {
				$fresult['typename'] = $robotlang['musictype'];
			} elseif ($fresult['type'] == 3) {
				$fresult['typename'] = $robotlang['bindtype'];
			} else {
				$fresult['typename'] = $robotlang['texttype'];
			}
			echo "<tr><td><input class='checkbox' type='checkbox' name='delete[]' value='".$fresult['id']."'></td><td>".$fresult['appcmd']."</td><td>[".$fresult['typename']."]</td><td><a href=".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=hux_wx&pmod=admincp&op=modadmin&appid=".$_GET['appid']."&actype=".$fresult['type']."&cmdid=".$fresult['id']."&ac=edit>".$robotlang['edit']."</a></td></tr>";
		}
		$multi = multi($fnum, $perpage, $page, ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=hux_wx&pmod=admincp&op=modadmin&appid=".$_GET['appid']);	
		showsubmit('submit', 'submit', 'del', '', $multi, false);
		showtablefooter();
		showformfooter();
	}
}
?>