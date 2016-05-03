jQuery(function($){
	$(".m-sitemap-block h2").on('click',function(){
		$(".m-sitemap-block ul").not($(this).next('ul')).slideUp()
		$(this).next('ul').slideToggle()
	})

})
