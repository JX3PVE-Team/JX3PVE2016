jQuery(function($){

	/*var mySwiper = new Swiper('.swiper-container',{
		direction: 'horizontal',
    	loop: true,
    	effect: 'fade',
    	pagination: '.swiper-pagination',
    	paginationClickable: true,
    	autoplay: 5000,
    	autoplayDisableOnInteraction : false
	}); */

	var $tb = $(".m-index-title .u-title"),
		$box = $(".m-index-list")
		$tb.on('click',function(){
			var index = $(this).index()
			$tb.removeClass('on')
			$(this).addClass('on')
			$box.hide().eq(index).show()
		})



})
