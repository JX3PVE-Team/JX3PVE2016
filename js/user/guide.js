jQuery(function($){

	$("#user-guide-authortipstg").on('click',function(){
		$("#user-guide-authortips").slideToggle();
		toggleMask();
	})

	$("#u-mask").on('click',function(){
		$("#user-guide-authortips").slideToggle();
	})

});  