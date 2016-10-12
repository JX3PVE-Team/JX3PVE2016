<?php


require_once '../../source/class/class_core.php';
$discuz = C::app();
$discuz->init();

$username = addslashes($_POST["username"]);
$password = addslashes($_POST['password']);

if (!$username || !$password) {
    echo "[用户名密码不能为空, 0]";
    die();
}

$user = C::t('common_member')->fetch_by_username($username);
if (!$user) {
    echo "[用户不存在, 0]";
    die();
}

$user = C::t('common_member')->get_uc_user_by_username($username);
if (!$user) {
    echo "[用户不存在, 0]";
    die();
}

if($user['password'] != md5(md5($password).$user['salt'])) {
    echo "[密码错误, 0]";
    die();
}


echo "[登陆成功,".$user['uid']."]";
die();
