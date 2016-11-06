jQuery(function($){
	var user_email_status = $.trim($('#user-email-status').text()).indexOf('已验证') != -1;
	if(user_email_status){
		$('.user-os-profile .u-mail').addClass('validate');
		$('#user-email-status a').css('color','green');
	}else{
		$('.user-os-profile .u-mail').addClass('novalidate');
		$('#user-email-status a').css('color','#FF7D00');
		$('#user-email-status').wrap('<a href="http://www.jx3pve.com/home.php?mod=spacecp&ac=profile&op=password"></a>');
	}


	$("#user-os-setting-more").on('click',function(){
		$("#user-os-qclink").slideUp()
		$("#user-os-content").slideDown()
	})

	$("#user-os-content-back").on('click',function(){
		$("#user-os-content").slideUp()
		$("#user-os-qclink").slideDown()
	})


});  
