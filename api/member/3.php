<?php
require_once 'PHP_AES_CBC.php';
$encryptObj = new MagicCrypt();
$decryptString = $encryptObj->decrypt("mLktB+q88EQ1fUsVyTrxXg==");//Ω‚√‹
echo $decryptString."|";
