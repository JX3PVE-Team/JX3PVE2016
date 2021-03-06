<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$moduleConfig = array(
    'module_cmd'       => "fd",
    'module_desc'      => "微信发帖",
	'power_id'         => '1',
	'module_ver'       => '1.1',
);

$moduleLang = array(
    'no_fid' => '管理员，没有设置微信可以发帖的板块',
    'select_fid' => '请输入发帖版块ID:',
    'select_err_fid' => '请输入正确的版块ID:',
    'select_type' => "请输入内容类型:\n1:纯文本类型\n2:纯图片类型\n3:图文类型",
    'select_err_type' => "请输入正确的内容类型:\n1:纯文本类型\n2:纯图片类型\n3:图文类型",
    'intitle'=>'请输入帖子标题：',
    'intitle_err'=>'请输入正确的帖子标题：',
    'inimage'=>'请发送图片：',
    'inimage_err'=>'请发送图片',
    'incontent'=>'请输入帖子内容：',
    'book_err'=>'可能因为网络问题或者服务器繁忙，导致你的发帖链接返回失败，请直接打开你的发帖板块，查看是否发帖成功',
);

$moduleSettingExt = array(
    array(
        'type'   => 'input',
        'title'  => '允许微信发帖版块',
        'name'   => 'fid',
        'value'  => '0,0',
        'desc'   => '允许微信发帖的版块ID，多版块用 “英文逗号” 隔开',
    ),
    array(
        'type'   => 'input',
        'title'  => '帖子标题前缀',
        'name'   => 'tag',
        'value'  => '[微信]',
        'desc'   => '微信发帖的帖子标题前缀（留空则不设前缀），如：[微信]标题标题标题标题标题标题',
    ),
);

?>