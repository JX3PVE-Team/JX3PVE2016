jQuery(function($){

	var $mask = $('#u-mask')

	//下滑菜单
	var $slidermenu = $(".i-header-slidermenu"),
		$slidermenu_tg = $(".i-header-slidermenutg")
	$slidermenu_tg.on('click',function(){
		$slidermenu.slideToggle();
		$(".i-header").addClass('i-header-fix');
		toggleMask();
	})
	$mask.on('click',function(){
		$slidermenu.slideToggle();
	})


	//上滑菜单
	var $panel = $("#i-header-panel"),
		$panel_tg = $("#i-header-panel-tg"),
		$panel_close = $("#i-header-panel-cancel")
	$panel_tg.on('click',function(e){
		toggleMask();
		$panel.removeClass('folder').addClass('active')
	})
	$panel_close.on('click',function(e){
		toggleMask();
		$panel.addClass('folder').removeClass('active')
	})
	$mask.on('click',function(e){
		$panel.addClass('folder').removeClass('active')
	})

});  

