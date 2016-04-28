jQuery(function($){
	$("#u-feedback-showtip").on('click',function(){
		$("#u-feedback-showtipct").fadeIn()
		$("html").addClass('isfixed')
	})
	$("#u-feedback-showtipct").on('click',function(){
		$(this).fadeOut()
		$("html").removeClass('isfixed')
	})

})
