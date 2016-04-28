jQuery(function($){
	//移动端
	$("#i-header-sidebar-tg").on('click',function(){
		$(".m-faq-sidebar").slideToggle()
		toggleMask();
	})
	$("#u-mask").on('click',function(){
		$(".m-faq-sidebar").slideUp()
		hideMask();
	})

})