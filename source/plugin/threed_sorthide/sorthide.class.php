<?php
/**
 *	[分类信息回复可见(threed_sorthide.{modulename})] (C)2014-2099 Powered by 3Dcader.
 *	Version: 投名状版
 *	Date: 2014-11-11 00:29
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_threed_sorthide {

	//TODO - Insert your code here

}
class plugin_threed_sorthide_forum extends plugin_threed_sorthide{
	 function viewthread_posttop_output(){		
	 //echo '程序运行了';		
	 global $_G,$postlist,$threadsortshow;
	 //print_r($threadsortshow);
		$reply_info = $_G['cache']['plugin']['threed_sorthide']['reply_info'];
		//echo $reply_info;
		$reply_powergroups = unserialize($_G['cache']['plugin']['threed_sorthide']["reply_powergroups"]);
		$reply_authorid=DB::result_first("SELECT authorid FROM ".DB::table('forum_thread')." WHERE tid=".$_G['tid']);
		$postcount=DB::result_first('SELECT count(1) FROM '.DB::table('forum_post').' WHERE tid='.$_G[tid].' and authorid = '.$_G['uid']);
		//echo $reply_authorid;
		$tmpmessage=$threadsortshow['typetemplate'];
		//echo $tmpmessage;
		$reply_message=array();
		$reply_arr=explode("[hide]",$tmpmessage);
		if(count($reply_arr)>1){
						$n=0;
						foreach($reply_arr as $key => $reply_arrstr){
							if($n){
								$tmp_arr=explode("[/hide]",$reply_arrstr);
								//echo $tmp_arr[0];
								array_push($reply_message,$tmp_arr[0]);	
								//print_r($reply_message);
							}
							$n++;
						}			
	                }
					//echo $postcount;
			if(in_array($_G['groupid'], $reply_powergroups)||$reply_authorid==$_G['uid']||$postcount!=0){
						$tmpmessage = str_replace("[hide]","",$tmpmessage);
						$tmpmessage = str_replace("[/hide]","",$tmpmessage);
			}else{
						//$pd_tips=str_replace("{postcount_set}",$postcount_set+1,$it618_postdisplay['pd_tips']);			
						$replace='<a href="forum.php?mod=post&amp;action=reply&amp;fid='.$_G['fid'].'&amp;tid='.$_G['tid'].'">'.$reply_info.'</a>';
						foreach($reply_message as $key => $reply_arrstr){
						$tmpmessage = str_replace("[hide]".$reply_arrstr."[/hide]",$replace,$tmpmessage);
					}
			}
			$threadsortshow[typetemplate]=$tmpmessage;
	}
}

?>