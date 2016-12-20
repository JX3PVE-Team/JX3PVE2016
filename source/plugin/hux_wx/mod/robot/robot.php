<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/robot/lang/lang.'.currentlang().'.php';
$robot_check = C::t('#hux_wx#hux_wx_config')->fetch_by_appid('robot');
$appconfig = unserialize($robot_check['configs']);
if ($robot_check) {
	$robot_cmd = C::t('#hux_wx#hux_wx_robot')->fetch_by_appcmd($keyword);
	if ($robot_cmd) {
		if ($robot_cmd['type'] == 0) {
			$string = $robot_cmd['cmdback'];
			echo WeChatServer::getXml4Txt($string);
		} elseif ($robot_cmd['type'] == 1) {
			$cmdback = $robot_cmd['cmdback'];
			$cmdback = unserialize($robot_cmd['cmdback']);
			$string[] = array('title' => $cmdback['title'],'desc' => $cmdback['description'],'pic' => $cmdback['picurl'],'url' => $cmdback['url']);
			echo WeChatServer::getXml4RichMsgByArray($string);
		} elseif ($robot_cmd['type'] == 2) {
			$cmdback = $robot_cmd['cmdback'];
			$cmdback = unserialize($robot_cmd['cmdback']);
			if ($cmdback['musicfrom'] == '1') {
				$keyword = diconv($keyword,CHARSET,'utf-8');
				$bdurl = 'http://tingapi.ting.baidu.com/v1/restserver/ting?from=webapp_music&method=baidu.ting.search.catalogSug&format=json&callback=&query='.urlencode($keyword).'&_=1413017198449';
				$bdr = file_get_contents($bdurl);
				$bdr = json_decode($bdr,true);
				$url = 'http://ting.baidu.com/data/music/links?songIds='.$bdr['song'][0]['songid'];
				$r = file_get_contents($url);
				$r = json_decode($r,true);
				if ($r['data']) {
					$string = array(
						'title' => $r['data']['songList'][0]['songName'],
						'description' => $r['data']['songList'][0]['albumName'],
						'url' => $r['data']['songList'][0]['songLink'],
						'durl' => ''
					);
				}
			} else {
				$string = $cmdback;
			}
			//echo WeChatServer::getXml4MusicByUrl($r['music']['musicurl'], '123456789', $r['music']['title'], $r['music']['description'], $r['music']['hqmusicurl']);
			echo makeMusic($openid,$data['to'],$string);
		} elseif ($robot_cmd['type'] == 3) {
			include DISCUZ_ROOT.'./source/plugin/hux_wx/mod/'.$robot_cmd['cmdback'].'/index.php';
		}
	} else {
		if ($appconfig['simsimi']) {
			$keyword = diconv($keyword,CHARSET,'utf-8');
			echo WeChatServer::getXml4Txt(diconv(xiaoi($openid,$keyword,$appconfig['ak'],$appconfig['sk']),'utf-8'));
		}
	}
}

function xiaoi($openid, $content, $ak, $sk) {
    //定义app
    $app_key=$ak;
    $app_secret=$sk;

    //签名算法
    $realm = "xiaoi.com";
    $method = "POST";
    $uri = "/robot/ask.do";
    $nonce = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    for ($i = 0; $i < 40; $i++) {
        $nonce .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    $HA1 = sha1($app_key.":".$realm.":".$app_secret);
    $HA2 = sha1($method.":".$uri);
    $sign = sha1($HA1.":".$nonce.":".$HA2);

    //接口调用
    $url = "http://nlp.xiaoi.com/robot/ask.do";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth:    app_key="'.$app_key.'", nonce="'.$nonce.'", signature="'.$sign.'"'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "question=".urlencode($content)."&userId=".$openid."&platform=custom&type=0");
    $output = curl_exec($ch);
    if ($output === FALSE){
        return "cURL Error: ". curl_error($ch);
    }
    return trim($output);
}

function makeMusic($fromUsername,$toUsername,$newsData=array(),$FuncFlag=0) {
	$newTplHeader = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[music]]></MsgType>
		<Music>";
	$newTplItem = "<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<MusicUrl><![CDATA[%s]]></MusicUrl>
		<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>";
	$newTplFoot = "</Music>
		<FuncFlag>0</FuncFlag>
		</xml>";
	$Content = sprintf($newTplItem,$newsData['title'],$newsData['description'],$newsData['url'],$newsData['durl']);
	$header = sprintf($newTplHeader,$fromUsername,$toUsername,TIMESTAMP);
	$footer = sprintf($newTplFoot,$FuncFlag);
	return $header . $Content . $footer;
}
?>