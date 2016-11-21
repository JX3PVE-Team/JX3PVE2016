jQuery(function($){

	$(".i-header-slidermenutg").on('click',function(){
		$(".i-header-slidermenu").slideToggle();
		toggleMask();

		$(this).parent('.i-header').css('z-index','40');
	})

	$("#u-mask").on('click',function(){
		$(".i-header-slidermenu").slideToggle();
	})

});  

