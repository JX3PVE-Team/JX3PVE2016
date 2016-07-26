<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_common_member.php 31849 2012-10-17 04:39:16Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class table_gift_member extends discuz_table_archive
{
	public function __construct() {
		$this->_table = 'forum_gift_member';
		$this->_pk    = 'id';
		parent::__construct();
	}

    public function fetch_all_gift() {
        return DB::fetch_all('SELECT g.*, m.username FROM %t as g left join pre_ucenter_members m on g.uid = m.uid order by gift_id asc ', array($this->_table));
    }
    
    public function fetch_gifts_by_uid($uid) {
        return DB::fetch_all('SELECT * FROM %t where uid = %s ', array($this->_table, $uid));
    }
	
	public function fetch_by_giftid_and_uid($gift_id, $uid) {
        return DB::fetch_first('SELECT * FROM %t WHERE gift_id=%s and uid = %d ', array($this->_table, $gift_id, $uid));
    }

    public function fetch_by_id($id) {
        return DB::fetch_first('SELECT * FROM %t WHERE id = %d ', array($this->_table, $id));
    }


    public function update_status($id, $status) {
        DB::query('UPDATE %t SET status = %d WHERE id = %d', array($this->_table, $status, $id));
    }
	
	public function insert_gift($uid, $gift) {
		$data = array();
		$data['gift_id'] = $gift['gift_id'];
		$data['gift_name'] = $gift['name'];
		$data['cost'] = $gift['cost'];
		$data['addtime'] = time();
		$data['uid'] = $uid; 
	    return DB::insert($this->_table, $data, true);
	}
}
