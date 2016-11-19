<?php
/**
 * 		Copyright£ºSmartCome
 * 		  WebSite£ºwww.SmartCome.com
 *             QQ: 2811931192
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_smart_notreply {
	function discuzcode($value){
		global $_G;
		$smart = $_G['cache']['plugin']['smart_notreply'];
		$allow=unserialize($smart['user']);
		if(!in_array($_G[groupid],$allow))return;
		if($value[caller]=="discuzcode"){
		$_G['discuzcodemessage']=str_replace('[hide]','<div class="showhide"><h4>'.$smart['message'].'</h4>',$_G['discuzcodemessage']);
		$_G['discuzcodemessage']=str_replace('[/hide]','</div>',$_G['discuzcodemessage']);
		}
		}
	}
?>