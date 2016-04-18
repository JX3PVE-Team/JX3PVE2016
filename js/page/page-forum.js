H.ready(['jquery'],function(){
	jQuery(function($){

		//分享
		$("#c-forum-title-share").on('click',function(){
			$(this).toggleClass('on');
		})

		//跳转楼层
		$("#c-forum-title-goto").on('click',function(){
			$(this).toggleClass('on');
		})
		$("#c-forum-title-goto #fj").on('click',function(e){
			e.stopPropagation()
		})


	})
})

