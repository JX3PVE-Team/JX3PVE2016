*iRuxu - 2016.4.21
//ClassName PRE
---------------------------------------------------
PRE				position		description
---------------------------------------------------
c-$component	->*				集成模块
w-$widget		->*				组件
u-$ui 			->*				元件
m-$module		->*				局部模块
e-$public		->*				特殊全局样式
i-$block		->*				移动端模块

f-$fid   		->body   		帖子所属版块		//列表页、帖子页、发布页存在
t-$tid  		->body			帖子唯一ID			//仅当帖子页存在
sort-$sort		->body			帖子所属分类信息ID	//列表页、帖子页、发布页存在
type-$type		->body			帖子所属主题分类ID 	//列表页、帖子页、发布页存在


//Special Class Name
---------------------------------------------------
className		position		description
---------------------------------------------------
alertHTML		->html 			有紧急公告
vipHTML			->html 			VIP会员
adminHTML		->html 			管理员
mobile/nomobile	->html 			headjs ua判断，真实的UA判断，JS用
ua-responsive	->html 			responsive ua判断，启用了移动适配头
ie-*/BRS-*		->html 			headjs hack
#path-page		->html 			headjs path+page 特殊处理（此条为id）
screen-l/m/s 	->body			responsive screen判断（l:pc m:平板竖屏 s:手机）


//Z-index 
---------------------------------------------------
className			z-index			description
---------------------------------------------------
.c-header			20 				公共头部
.i-header			20 				移动头部
.i-footer			20 				移动底部
.c-alert			21 				紧急公告
#u-mask				30 				遮罩层
.i-header-panel		40 				手机弹层菜单
.c-fli-panel		40 				楼层弹层菜单
.w-adminbar			100				主楼管理弹层（仅移动端）
.fwinmask			201 			dz默认弹层
.w-adminpop			350				副楼管理弹层



//Page width css 
---------------------------------------------------------------------------------------------------
channel			stylesheet					template												
---------------------------------------------------------------------------------------------------
公共头部		css/common/header/*			template/default/commom/header.htm
公共底部		css/common/footer/*			template/default/commom/footer.htm

举报			css/common/c-report			template/default/common/report.htm
评分			css/common/c-rate			template/default/forum/rate.htm

站点搜索		-							-														
404错误			css/system/404.css 			wp-content/themes/yylmacro-v2/404.php
打印模式		css/system/print.css 		template/default/forum/viewthread_printable.htm 
站点统计		css/system/stat.css 		template/default/home/misc_stat.htm
FAQ				css/system/faq.css 			template/default/common/faq.htm
反馈			css/system/feedback.css 	template/feedback/forum/*

推送头条		css/system/push.css 		template/default/portal/portalcp_pushnews.htm
推送头条通知	css/system/push.css 		template/default/portal/portalcp_article.htm
历史头条列表	css/portal/news.css 		template/default/portal/list_news.htm
历史头条单页	css/portal/news.css 		template/default/portal/views_news.htm
门户全部评论	css/portal/news.css 		template/default/portal/comment.htm
评论模块		css/portal/comment.css 		template/default/portal/portal_comment.htm

站点地图		css/system/sitemap.css		template/about/portal/portal_topic_sitemap.htm 		
关于我们		css/system/system.css 		template/about/portal/portal_topic_about.htm 	
版权声明		css/system/system.css 		template/about/portal/portal_topic_copyright.htm 	
免责声明		css/system/system.css 		template/about/portal/portal_topic_disclaimer.htm 	
合作联系		css/system/system.css 		template/about/portal/portal_topic_contact.htm 	
友情链接		css/system/system.css 		template/about/portal/portal_topic_links.htm
更新日志		css/system/system.css 		template/about/forum/*
管理团队		css/system/system.css 		template/about/forum/*
成员招募		css/system/system.css 		template/about/forum/*

副本专题		css/fb/*					template/fam/portal/*


//Global JS Var 
---------------------------------------------------
key					value			description
---------------------------------------------------
TGPOST_STATUS		boolean			默认设为关闭，折叠true，不折叠false