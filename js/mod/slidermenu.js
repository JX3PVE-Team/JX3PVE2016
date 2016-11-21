jQuery(function($){

	$(".i-header-slidermenutg").on('click',function(){
		$(".i-header-slidermenu").slideToggle();
		toggleMask();

		$(".i-header").toggleClass('.i-header-fix');
	})

	$("#u-mask").on('click',function(){
		$(".i-header-slidermenu").slideToggle();
		toggleMask();
	})

});  

