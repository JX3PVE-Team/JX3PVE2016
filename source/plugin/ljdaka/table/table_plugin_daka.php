<?php
/**
 *      [Liangjian] (C)2001-2099 Liangjian Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_plugin_lj_exam.php liangjian $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include_once DISCUZ_ROOT.'./source/plugin/ljdaka/shiqu.inc.php';
class table_plugin_daka extends discuz_table
{
	public function __construct() {

		$this->_table = 'plugin_daka';
		$this->_pk    = 'id';
		parent::__construct();
	}
	public function fetch_by_tables(){
		return DB :: result_first("show tables like '" . DB :: table('plugin_daka') . "'");
	}
	public function fetch_by_uid($uid){
		$todaytimestamp = strtotime(gmdate('Y-m-d 00:00:00',TIMESTAMP+3600*8));
		return DB :: result_first('select count(*) from %t where uid=%d and timestamp>=%d',array($this->_table,$uid,$todaytimestamp));
	}
	public function fetch_by_uid_yesterday($uid){
		$todaytimestamp = strtotime(gmdate('Y-m-d 00:00:00',TIMESTAMP+3600*8));
		$yesterdaytimestamp  = $todaytimestamp-86400;
		return DB :: result_first('select alldays from %t where uid=%d and timestamp >=%d and timestamp <=%d',array($this->_table,$uid,$yesterdaytimestamp,$todaytimestamp));
	}
}


?>