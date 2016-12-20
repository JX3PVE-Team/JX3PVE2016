<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class hux_wx_api {
	
	public static function text($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		$paymoney = 'extcredits'.$wxsetting['money'];
		$paymoneyname = $_G['setting']['extcredits'][$wxsetting['money']]['title'];
		$paymoneyunit = $_G['setting']['extcredits'][$wxsetting['money']]['unit'];
		list($data) = $param;
		self::_init();
		$openid = $data['from'];
		$keyword = diconv($data['content'], 'UTF-8');
		$huxaction = C::t('#hux_wx#hux_wx_action')->fetch_by_openid($openid);
		$binded = C::t('#hux_wx#hux_wx')->fetch_by_openid($openid);
		$gp = unserialize($wxsetting['gp']);
		$postgp = unserialize($wxsetting['postgp']);
		$applogin = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('login','appid');
		$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($keyword,'appid,configs');
		if ($keyword == $wxsetting['cc']) {
			C::t('#hux_wx#hux_wx_action')->delete($openid);
			echo WeChatServer::getXml4Txt(lang('plugin/hux_wx','cc'));
		} else {
			if ($huxaction) {
				$appconfigsql = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'configs');
				$appconfig = unserialize($appconfigsql['configs']);
				$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'appid');
				if ($applist) {
					include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$applist['appid'].'/'.$applist['appid'].'.php';
				}
			} elseif (substr($keyword,0,1) == '@' && !$wxsetting['at']) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/at/index.php';
			} elseif (substr($keyword,0,1) == '#' && $applogin) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/login/index.php';
			} else {
				if ($applist) {
					$appconfig = unserialize($applist['configs']);
					include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$applist['appid'].'/index.php';
				} else {
					include_once DISCUZ_ROOT . './source/plugin/wechat/response.class.php';
					WSQResponse::text($param);
					include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/robot.php';
				}
			}
		}
		if($wxsetting['mr']) {
			self::mr($param);
		}
	}
	
	public static function location($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		$paymoney = 'extcredits'.$wxsetting['money'];
		$paymoneyname = $_G['setting']['extcredits'][$wxsetting['money']]['title'];
		$paymoneyunit = $_G['setting']['extcredits'][$wxsetting['money']]['unit'];
		list($data) = $param;
		self::_init();
		$openid = $data['from'];
		$keyword = $data['Y'].','.$data['X'];
		$huxaction = C::t('#hux_wx#hux_wx_action')->fetch_by_openid($openid);
		$binded = C::t('#hux_wx#hux_wx')->fetch_by_openid($openid);
		$gp = unserialize($wxsetting['gp']);
		$postgp = unserialize($wxsetting['postgp']);
		$applogin = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('login','appid');
		$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($keyword,'appid,configs');
		$addr = diconv($data['I'], 'UTF-8');
		if ($huxaction) {
			$appconfigsql = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'configs');
			$appconfig = unserialize($appconfigsql['configs']);
			$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'appid');
			if ($applist) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$applist['appid'].'/'.$applist['appid'].'.php';
			}
		}
		if($wxsetting['mr']) {
			self::mr($param);
		}
	}
	
	public static function image($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		$paymoney = 'extcredits'.$wxsetting['money'];
		$paymoneyname = $_G['setting']['extcredits'][$wxsetting['money']]['title'];
		$paymoneyunit = $_G['setting']['extcredits'][$wxsetting['money']]['unit'];
		list($data) = $param;
		self::_init();
		$openid = $data['from'];
		$keyword = $data['url'].'||'.$data['id'];
		$huxaction = C::t('#hux_wx#hux_wx_action')->fetch_by_openid($openid);
		$binded = C::t('#hux_wx#hux_wx')->fetch_by_openid($openid);
		$gp = unserialize($wxsetting['gp']);
		$postgp = unserialize($wxsetting['postgp']);
		$applogin = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('login','appid');
		$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($keyword,'appid,configs');
		if ($huxaction) {
			$appconfigsql = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'configs');
			$appconfig = unserialize($appconfigsql['configs']);
			$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'appid');
			if ($applist) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$applist['appid'].'/'.$applist['appid'].'.php';
			}
		} else {
			include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/pic/uploadpic.php';
		}
		if($wxsetting['mr']) {
			self::mr($param);
		}
	}
	
	public static function mr($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		$paymoney = 'extcredits'.$wxsetting['money'];
		$paymoneyname = $_G['setting']['extcredits'][$wxsetting['money']]['title'];
		$paymoneyunit = $_G['setting']['extcredits'][$wxsetting['money']]['unit'];
		list($data) = $param;
		$openid = $data['from'];
		$keyword = $wxsetting['mr'];
		$binded = C::t('#hux_wx#hux_wx')->fetch_by_openid($openid);
		$gp = unserialize($wxsetting['gp']);
		$postgp = unserialize($wxsetting['postgp']);
		$param[0]['content'] = $keyword;
		$appmr = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($wxsetting['mr'],'appid');
		if ($keyword == $wxsetting['cc']) {
			C::t('#hux_wx#hux_wx_action')->delete($openid);
			echo WeChatServer::getXml4Txt(lang('plugin/hux_wx','cc'));
		} else {
			if ($appmr) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$appmr['appid'].'/index.php';
			} else {
				include_once DISCUZ_ROOT . './source/plugin/wechat/response.class.php';
				WSQResponse::text($param);
				include_once DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/robot.php';
			}
		}
		echo WeChatServer::getXml4Txt($wxsetting['mr']);
	}

	public static function click($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		$paymoney = 'extcredits'.$wxsetting['money'];
		$paymoneyname = $_G['setting']['extcredits'][$wxsetting['money']]['title'];
		$paymoneyunit = $_G['setting']['extcredits'][$wxsetting['money']]['unit'];
		list($data) = $param;
		self::_init();
		$openid = $data['from'];
		$keyword = diconv($data['key'], 'UTF-8');
		$huxaction = C::t('#hux_wx#hux_wx_action')->fetch_by_openid($openid);
		$binded = C::t('#hux_wx#hux_wx')->fetch_by_openid($openid);
		$gp = unserialize($wxsetting['gp']);
		$postgp = unserialize($wxsetting['postgp']);
		$applogin = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('login','appid');
		$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($keyword,'appid,configs');
		//echo WeChatServer::getXml4Txt(json_encode($data));
		if ($keyword == $wxsetting['cc']) {
			C::t('#hux_wx#hux_wx_action')->delete($openid);
			echo WeChatServer::getXml4Txt(lang('plugin/hux_wx','cc'));
		} else {
			if ($huxaction) {
				$appconfigsql = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'configs');
				$appconfig = unserialize($appconfigsql['configs']);
				$applist = C::t('#hux_wx#hux_wx_config')->fetch_by_appcmd($huxaction['type'],'appid');
				if ($applist) {
					include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$applist['appid'].'/'.$applist['appid'].'.php';
				}
			} elseif (substr($keyword,0,1) == '@' && !$wxsetting['at']) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/at/index.php';
			} elseif (substr($keyword,0,1) == '#' && $applogin) {
				include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/login/index.php';
			} else {
				if ($applist) {
					$appconfig = unserialize($applist['configs']);
					include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$applist['appid'].'/index.php';
				} else {
					include_once DISCUZ_ROOT . './source/plugin/wechat/response.class.php';
					WSQResponse::text($param);
					include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/robot.php';
				}
			}
		}
		if($wxsetting['mr']) {
			self::mr($param);
		}
	}

	public static function subscribe($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		list($data) = $param;
		self::_init();
		$openid = $data['from'];
		C::t('#hux_wx#hux_wx_action')->delete($openid);
		include_once DISCUZ_ROOT . './source/plugin/wechat/response.class.php';
		WSQResponse::subscribe($param);
	}
	
	public static function unsubscribe($param) {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		list($data) = $param;
		self::_init();
		$openid = $data['from'];
		C::t('#hux_wx#hux_wx_action')->delete($openid);
	}

	private static function _init() {
		global $_G;
		$wxsetting = $_G['cache']['plugin']['hux_wx'];
		C::t('#hux_wx#hux_wx_action')->delete_by_dateline($wxsetting['cmdtime']);
	}

}