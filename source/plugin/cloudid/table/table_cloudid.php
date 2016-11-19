<?php
/**
 *	[云端ID(cloudid.{modulename})] (C)2014-2099 Powered by Ricky.
 *	Version: 1.0
 *	Date: 2014-4-15 13:12
 */


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_cloudid extends discuz_table
{
	public function __construct() {

		$this->_table = 'cloudid';
		$this->_pk    = '';

		parent::__construct();
	}

	public function fetch_all_by_nid($nid) {
		return DB::fetch_all("SELECT * FROM %t WHERE nid=%d", array($this->_table, $nid));
	}
	
	public function count_by_uid($uid) {
		return DB::result_first("SELECT COUNT(*) FROM %t WHERE uid=%d ", array($this->_table, $uid));
	}
	
	public function pass_by_nid($nid) {
		DB::query("UPDATE %t SET status=1 WHERE nid=%d", array($this->_table,$nid));
	}
	
	public function refuse_by_nid($nid) {
		DB::query("UPDATE %t SET status=2 WHERE nid=%d", array($this->_table,$nid));
	}



}

?>
