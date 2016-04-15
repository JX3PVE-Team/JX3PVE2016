*iRuxu - 2016.4.12
//ClassName PRE
---------------------------------------------------
PRE				position		description
---------------------------------------------------
c-$component	->*				集成模块
f-$fid   		->body   		当前页面所属版块
i-$block		->*				mobile blocks



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
className		z-index			description
---------------------------------------------------
.c-header		20 				公共头部
.i-header		20 				移动头部
.i-footer		20 				移动底部
.c-alert		21 				紧急公告



//Page width css 
---------------------------------------------------------------------------------------------------
channel			stylesheet					template												
---------------------------------------------------------------------------------------------------
公共头部		css/common/header/*			template/default/commom/header.htm											
公共底部		css/common/footer/*			template/default/commom/footer.htm

站点搜索		-							-														
404错误			css/system/404.css 			wp-content/themes/yylmacro-v2/404.php				

站点地图		css/system/sitemap.css		template/yylmacro/portal/portal_topic_sitemap.htm 		
站点统计		css/system/stat.css 		template/yylmacro/home/misc_stat.htm 					
版权声明		css/system/system.css 		template/yylmacro/portal/portal_topic_copyright.htm 	
免责声明		css/system/system.css 		template/yylmacro/portal/portal_topic_disclaimer.htm 	
友情链接		css/system/system.css 		template/yylmacro/portal/portal_topic_links.htm 		
FAQ				css/system/faq.css 			template/default/common/faq.htm 			

推送头条		css/system/system.css 		template/yylmacro/portal/portalcp_pushnews.htm
推送头条通知	css/system/system.css 		template/yylmacro/portal/portalcp_article.htm
历史头条列表	css/portal/news.css 		template/yylmacro/portal/list_news.htm
历史头条单页	css/portal/news.css 		template/yylmacro/portal/views_news.htm
评论模块		css/portal/comment.css 		template/yylmacro/portal/portal_comment.htm