<?php 
define('APPTYPEID', 4);
define('CURSCRIPT', 'sitemap');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->cachelist = $cachelist;$discuz->init();
$navtitle='ÍøÕ¾µØÍ¼'; //ÍøÕ¾±êÌâ
$metakeywords='ÍøÕ¾µØÍ¼'; //ÍøÕ¾¹Ø¼ü´Ê
$metadescription='ÍøÕ¾µØÍ¼'; //ÍøÕ¾ÃèÊö
include template('common/header');echo '
<style type="text/css">
a:link {color: #333; text-decoration: none;}
a:visited {text-decoration: none; color: #666;}
a:hover {text-decoration: none; color: #c6c6c6;}
a:active {text-decoration: none; color: #c6c6c6;}
.newtid{width:99.7%;float:left; margin-top:10px; border: 1px dotted #c6c6c6; margin-bottom:10px; }
.newtid li{padding-left:2%;font-size: 12px;width:48%; float:left;line-height: 25px;}
.newtid li a{color: #333;}
.newtit strong a{position: absolute;bottom: 98765px;}
.newtid h2{font-size: 16px;line-height: 45px;}
</style>   

<ul class="newtid">';
$site_num  = DB::result(DB::query("SELECT COUNT(`tid`) FROM ".DB::table('forum_thread')." as a inner join ".DB::table('forum_forum')." as b on a.fid=b.fid where a.displayorder=0 ORDER BY a.tid DESC"));
$site_num = $site_num ? $site_num :0;
$site_listnum = 100;
$site_page = intval($_G['gp_page']) ? intval($_G['gp_page']) :1;
$site_max = $site_page > 0 ? $site_listnum * ($site_page-1) : 0;
$site_max2 =   $site_max2 + 100;
$querys = DB::query("SELECT a.tid,a.subject,a.fid,b.name FROM ".DB::table('forum_thread')." as a inner join ".DB::table('forum_forum')." as b on a.fid=b.fid where a.displayorder=0 ORDER BY a.tid DESC LIMIT ".$site_max.",".$site_max2);
$multipage = multi($site_num, $site_listnum,$site_page, "sitemap.php");
$i=1;while($threadfid = DB::fetch($querys)){echo '<li>'.$i.'¡¢<em>[<a href="forum.php?mod=forumdisplay&fid='.$threadfid['fid'].'">'.$threadfid['name'].'</a>]</em> <a href="forum.php?mod=viewthread&tid='.$threadfid['tid'].'" target="_blank">'.$threadfid['subject'].'</a></li>';$i++;} 
echo $multipage; 
echo '</ul>';

echo '&nbsp';

include template('common/footer');
?>