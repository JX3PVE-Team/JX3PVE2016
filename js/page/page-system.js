jQuery(function($){

	//移动端
	$("#i-header-sidebar-tg").on('click',function(){
		$(".system-sidebar").slideToggle()
		$(".i-header").addClass('showSidebar')
		toggleMask();
	})
	$("#u-mask").on('click',function(){
		$(".system-sidebar").slideUp()
		$(".i-header").removeClass('showSidebar')
	})

})
