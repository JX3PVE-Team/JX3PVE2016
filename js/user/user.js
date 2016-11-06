jQuery(function($){

	//侧边栏展开
	$(".user-sidebar-title").on('click',function(){
		//$(this).toggleClass('on');
		$(this).next('.user-sidebar-list').slideToggle()
	})
	$(".user-sidebar-list li").each(function(){
		if($(this).hasClass('on')){
			$(this).parent('.user-sidebar-list').addClass('on')
			$(this).parent('.user-sidebar-list').prev('.user-sidebar-title').addClass('on')
		}
	})


	//移动端
	$("#i-header-panel-tg").on('click',function(){
		$(".i-header").toggleClass('showSidebar')
		$("#user-extend-menu").slideToggle()
		toggleMask();
	})
	$("#u-mask").on('click',function(){
		$("#user-extend-menu").slideUp()
		hideMask();
	})

})