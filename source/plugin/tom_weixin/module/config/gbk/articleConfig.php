<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "article",
    'module_desc'      => "������ʾҳ",
	'power_id'         => '0',
	'module_ver'       => '1.0',
    'is_menu'          => '2',
);

$moduleLang = array();

$moduleSettingExt = array(
    array(
        'type'   => 'textarea',
        'title'  => '������',
        'name'   => 'adscontent',
        'value'  => "����д������",
        'desc'   => '����������ӹ�����',
        'rows'   => 20,
        'cols'   => 80,
    ),
);

?>