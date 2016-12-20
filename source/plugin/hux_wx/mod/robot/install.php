<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE IF EXISTS `pre_hux_wx_robot`;
CREATE TABLE IF NOT EXISTS `pre_hux_wx_robot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appcmd` varchar(100) NOT NULL,
  `cmdback` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

UPDATE `pre_hux_wx_config` SET state='1' WHERE appid='robot';

EOF;

runquery($sql);

$finish = TRUE;
?>