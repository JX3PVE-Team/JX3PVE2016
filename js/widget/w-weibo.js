jQuery(function($){

	//非移动端才加载
	if(!isMobile){
		H.load([{'weibo':'http://tjs.sjs.sinajs.cn/open/api/js/wb.js'}]);
	}

	//w_weibo:新浪微博
	//当未填写微博UID时，隐藏关注按钮
	var 
	$wb_win = $("#w-weibo-win"),
	$wb = $("#w-weibo")
	if($wb.length){
		if(!$wb.text()) $wb_win.remove()
	}

})
