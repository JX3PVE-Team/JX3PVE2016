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

DROP TABLE IF EXISTS cdb_cloudid;
CREATE TABLE cdb_cloudid (
  `nid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL,
  `currentid` mediumint(8) unsigned NOT NULL,
  `newid` mediumint(8) unsigned NOT NULL,
  `status` mediumint(8) NOT NULL DEFAULT 0,
  PRIMARY KEY (`nid`)
) TYPE=MyISAM;

EOF;

runquery($sql);

$finish = TRUE;

?>
