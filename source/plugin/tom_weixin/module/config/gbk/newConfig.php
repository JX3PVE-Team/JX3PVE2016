<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "new",
    'module_desc'      => "��������",
	'power_id'         => '0',
	'module_ver'       => '1.4',
);

$moduleLang = array(
    'no_new_book' => 'û����������',
);

$moduleSettingExt = array(
    array(
        'type'   => 'input',
        'title'  => '���Ӱ��ID',
        'name'   => 'fid',
        'value'  => '0',
        'desc'   => '��д����������̳���ID�������á�Ӣ�ġ����Ÿ�����1,2,3 ��������ȫ����飩',
    ),
    array(
        'type'   => 'input',
        'title'  => '��ʾ��������',
        'name'   => 'num',
        'value'  => '10',
        'desc'   => '���������б���������������ܴ���10��',
    ),
    array(
        'type'   => 'radio',
        'title'  => 'ֻ��ʾͼƬ��',
        'name'   => 'is_image',
        'value'  => '0',
        'desc'   => '�Ƿ�ֻ��ʾ��ͼƬ���������ӣ���ͼʱʹ�����ͼƬ��[<a href="http://addon.discuz.com/?@tom_weixin.plugin.40833" target="_blank"><font color="#FF0000">��װ�����б����ͼƬ���</font></a>]',
        'item'   => array(
            '1' => "��",
            '0' => "��",
        ),
    ),
);

?>