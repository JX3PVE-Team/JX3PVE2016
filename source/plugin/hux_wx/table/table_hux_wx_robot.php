<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_hux_wx_robot extends discuz_table
{

	public function __construct() {

		$this->_table = 'hux_wx_robot';
		$this->_pk    = 'id';

		parent::__construct();
	}

	public function fetch_by_appcmd($appcmd,$field='*') {
		return DB::fetch_first("SELECT $field FROM %t WHERE appcmd=%s", array($this->_table, $appcmd));
	}
	
	public function fetch_by_id($id,$field='*') {
		return DB::fetch_first("SELECT $field FROM %t WHERE id=%d", array($this->_table, $id));
	}
	
	public function fetch_all_by_search($condition,$orders='',$type=0,$start=0,$limit=0) {
		if ($type == 1) {
			$result = DB::fetch_all("SELECT * FROM %t WHERE 1%i $orders LIMIT $start,$limit",array($this->_table,$condition));
		} else {
			$n = DB::query("SELECT * FROM ".DB::table($this->_table)." WHERE 1$condition $orders");
			$result = DB::num_rows($n);
		}
		return $result;
	}
	
	public function delete_by_array($id) {
		return DB::query("DELETE FROM %t WHERE id IN(".dimplode($id).")", array($this->_table));
	}

}

?>