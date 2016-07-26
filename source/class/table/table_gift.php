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

class table_gift extends discuz_table_archive
{
	public function __construct() {
		$this->_table = 'forum_gift';
		$this->_pk    = 'gift_id';
		parent::__construct();
	}

    public function delete($gift_id) {
        DB::query('UPDATE %t SET status = -1  WHERE gift_id=%s', array($this->_table, $gift_id));
    }

    public function fetch_all_gift() {
        return DB::fetch_all('SELECT * FROM %t where status != -1 order by gift_id asc ', array($this->_table));
    }
	
	public function fetch_gift_by_id($gift_id) {
	 return DB::fetch_first('SELECT * FROM %t WHERE gift_id=%s', array($this->_table, $gift_id));
	}
	
	public function increment($gift_id) {
		DB::query('UPDATE %t SET num=num+1 WHERE gift_id=%s', array($this->_table, $gift_id));
	}

	public function decrease($gift_id) {
		DB::query('UPDATE %t SET num=num-1 WHERE gift_id=%s', array($this->_table, $gift_id));
	}

    public function add($gift) {
        //var_dump($gift);
        //var_dump("INSERT INTO %t (name, image, url, cost, num, addtime, sponsors, sponsors_url) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s )"); die();
        DB::query("INSERT INTO %t (name, image, url, cost, num, addtime, sponsors, sponsors_url) VALUES (%s, %s, %s, %s, %s, %s, %s, %s )",
                array($this->_table, $gift['name'], $gift['image'], $gift['url'], $gift['cost'], $gift['num'],  $gift['addtime'],$gift['sponsors'], $gift['sponsors_url']));
        return DB::insert_id();
    }

    public function update($gift_id, $gift) {
    	DB::update($this->_table, $gift, array('gift_id' => intval($gift_id)));
    }
}

?>