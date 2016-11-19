<?php
/**
 *	[云端ID(cloudid.{modulename})] (C)2014-2099 Powered by Ricky.
 *	Version: 1.0
 *	Date: 2014-4-15 13:12
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$sql = <<<EOF

DROP TABLE cdb_cloudid;

EOF;

runquery($sql);
$finish = TRUE;
