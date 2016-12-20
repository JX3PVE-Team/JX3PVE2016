<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/bind/lang/lang.'.currentlang().'.php';
$ccmsg = "\n".str_replace('{cc}',$wxsetting['cc'],lang('plugin/hux_wx','ccmsg'));
loaducenter();
if ($huxaction['action'] == '0') {
	C::t('#hux_wx#hux_wx_action')->update($openid,array('action'=>$keyword,'dateline'=>TIMESTAMP));
	$string = $bindlang['yzmode'].$ccmsg;
} else {
	$bindac = explode('|||',$huxaction['action']);
	if ($bindac[1]) {
		if ($bindac[1] == '1') {
			$checkuser = uc_get_user($bindac[0]);
			if ($checkuser == '0') {
				$user = uc_user_login(intval($bindac[0]),$keyword,1);
				$binduid = intval($bindac[0]);
			} else {
				$user = uc_user_login($bindac[0],$keyword);
				$binduid = intval($checkuser[0]);
			}
			if ($user[0] == -1) {
				C::t('#hux_wx#hux_wx_action')->delete($openid);
				$string = lang('plugin/hux_wx','nouidusername');
			} else {
				if (!$binded) {
					if ($user[0] == -2) {
						C::t('#hux_wx#hux_wx_action')->delete($openid);
						$string = $bindlang['passerr'];
					} else {
						C::t('#hux_wx#hux_wx')->insert(array('openid'=>$openid,'uid'=>$binduid));
						if ($appconfig['verify'] && $appconfig['verify'] != '0') {
							$vid = C::t('common_member_verify')->count_by_uid($binduid);
							if ($vid > 0) {
								C::t('common_member_verify')->update($binduid,array($appconfig['verify']=>1));
							} else {
								C::t('common_member_verify')->insert(array('uid'=>$binduid,$appconfig['verify']=>1));
							}
						}
						C::t('#hux_wx#hux_wx_action')->delete($openid);
						$string = $bindlang['bindsus'];						
					}
				} else {
					C::t('#hux_wx#hux_wx_action')->delete($openid);
					$string = $bindlang['binderr'];
				}
			}										
		} elseif ($bindac[1] == '2') {
			if (!$binded) {
				if ($bindac[2] == $keyword) {
					C::t('#hux_wx#hux_wx')->insert(array('openid'=>$openid,'uid'=>$bindac[0]));
					if ($appconfig['verify'] && $appconfig['verify'] != '0') {
						$vid = C::t('common_member_verify')->count_by_uid($bindac[0]);
						if ($vid > 0) {
							C::t('common_member_verify')->update($bindac[0],array($appconfig['verify']=>1));
						} else {
							C::t('common_member_verify')->insert(array('uid'=>$bindac[0],$appconfig['verify']=>1));
						}
					}
					C::t('#hux_wx#hux_wx_action')->delete($openid);
					$string = $bindlang['bindsus'];
				} else {
					C::t('#hux_wx#hux_wx_action')->delete($openid);
					$string = $bindlang['yzerr'];
				}
			} else {
				C::t('#hux_wx#hux_wx_action')->delete($openid);
				$string = $bindlang['binderr'];
			} 
		}
	} else {
		if ($keyword != '1' && $keyword != '2') {
			$string = $bindlang['yzselect'].$ccmsg;
		} else {
			if ($keyword == '1') {
				C::t('#hux_wx#hux_wx_action')->update($openid,array('action'=>$huxaction['action'].'|||'.$keyword,'dateline'=>TIMESTAMP));
				$string = $bindlang['pass'].$ccmsg;
			} elseif ($keyword == '2') {
				$yzrand = mt_rand(100000,999999);
				$checkuser = uc_get_user($huxaction['action']);
				$checkuser_b = uc_get_user(intval($huxaction['action']),1);
				if ($checkuser == '0' && $checkuser_b == '0') {
					C::t('#hux_wx#hux_wx_action')->delete($openid);
					$string = lang('plugin/hux_wx','nouidusername');
				} else {
					if ($checkuser == '0') {
						$binduid = intval($checkuser_b[0]);
					} else {
						$binduid = intval($checkuser[0]);
					}
					notification_add($binduid,'system',$bindlang['yzshow'].$yzrand,0,1);
					C::t('#hux_wx#hux_wx_action')->update($openid,array('action'=>$binduid.'|||'.$keyword.'|||'.$yzrand,'dateline'=>TIMESTAMP));
					$string = $bindlang['yzmsg'].$ccmsg;
				}
			}
		}
	}
}
echo WeChatServer::getXml4Txt($string);
?>