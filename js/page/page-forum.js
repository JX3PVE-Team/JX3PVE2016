H.ready(['jquery'],function(){
	jQuery(function($){

		var $mask = $("#u-mask")

		//手机端
		if($("html").hasClass('ua-responsive') && $("html").hasClass('mobile')){

			//处理需要触发遮罩的原始弹层

				//需要弹出遮罩层的（局部双层菜单无需弹出浮层）
				$(".u-mask-tg").on('click',function(e){
					//避免自身dom插入时冒泡关闭
					e.stopPropagation()
					$mask.fadeIn()
				})

				//通用ajax元素冒泡捕捉关闭遮罩层（特殊需要处理的添加局部组织冒泡）
				/*$("#append_parent").on('click',function(){
					$mask.fadeOut()
				})*/

			//单页panel弹层菜单特殊处理
				var $panel = $("#i-header-panel"),
					$panel_tg = $("#i-header-panel-tg"),
					$panel_close = $("#i-header-panel-cancel")
				$panel_tg.on('click',function(e){
					$mask.fadeIn()
					$panel.removeClass('folder').addClass('active')
				})
				$panel_close.on('click',function(e){
					$mask.fadeOut()
					$panel.addClass('folder').removeClass('active')
				})
				//局部阻止冒泡关闭遮罩层
				$panel.on('click',function(e){
					e.stopPropagation()
				})
		}
		
		//PC分享
		$("#c-forum-title-share").on('click',function(){
			$(this).toggleClass('on');
		})

		//PC跳转楼层
		$("#c-forum-title-goto").on('click',function(){
			$(this).toggleClass('on');
		})
		$("#c-forum-title-goto #fj").on('click',function(e){
			e.stopPropagation()
		})


	})
})

