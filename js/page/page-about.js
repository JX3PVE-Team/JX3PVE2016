jQuery(function($){

	$(".m-about-join .go").on('click',function(){
		$(this).parent('.default').parent('li').toggleClass('on')
	})

	$(".m-about-join .details").each(function(){
		var text_ori = $(this).html()
		var text_movefirst = text_ori.replace('\n','')
		var text = text_movefirst.split('\n').join('<br/>')
		$(this).html(text);
	})

	//移动端
	$("#i-header-sidebar-tg").on('click',function(){
		$(".default-sidebar").slideToggle()
		toggleMask();
	})
	$("#u-mask").on('click',function(){
		$(".default-sidebar").slideUp()
	})

})
