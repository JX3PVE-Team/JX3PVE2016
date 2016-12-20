<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_hux_wx_action extends discuz_table
{

	public function __construct() {

		$this->_table = 'hux_wx_action';
		$this->_pk    = 'openid';

		parent::__construct();
	}
	
	public function fetch_by_openid($openid,$field='*') {
		return DB::fetch_first("SELECT $field FROM %t WHERE openid=%s", array($this->_table, $openid));
	}
	
	public function delete_by_dateline($time) {
		$deldata = TIMESTAMP - $time;
		return DB::query("DELETE FROM %t WHERE dateline<%d", array($this->_table, $deldata));
	}

	public function check_by_field($field) {
		$query = DB::query("Describe %t $field", array($this->_table));
		return DB::fetch($query);
	}

}

?>