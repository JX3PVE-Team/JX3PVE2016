H.ready(['jquery'],function(){
	jQuery(function($){

		var $mask = $("#u-mask")

		//判断是否出现了弹层
		/*$("body").on('click',function(){
			if($(".fwinmask").length){
				$("html").addClass('e-maskactive')
			}
		})*/

		/*$(".u-mask-tg").on('click',function(){
			$mask.fadeIn()
		})
		$("#u-mask").on('click',function(){
			$mask.fadeOut()
		})*/

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

		//手机弹层菜单
		var $panel = $("#i-header-panel"),
			$panel_tg = $("#i-header-panel-tg")
		$panel_tg.on('click',function(){
			$mask.fadeIn()
			$panel.removeClass('folder').addClass('active')
		})
		$panel.on('click',function(){
			$mask.fadeOut()
			$panel.addClass('folder').removeClass('active')
		})


	})
})

