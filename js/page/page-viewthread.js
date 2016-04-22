jQuery(function($){

	var $mask = $("#u-mask")

	//手机 弹层处理
	if($("html").hasClass('ua-responsive') && $("body").hasClass('screen-s')){

		//需要弹出遮罩层的（局部双层菜单无需弹出浮层）
		$(".u-mask-tg").on('click',function(e){
			//避免自身dom插入时冒泡关闭
			e.stopPropagation()
			$mask.fadeIn()
		})

		//主楼panel弹层菜单特殊处理
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

		//副楼panel扩展菜单
		$(".c-fli-header .u-more").on('click',function(){
			$mask.fadeIn()
			$(this).parent('.u-panel').parent('.c-fli-header').siblings('.c-fli-footer').children('.c-fli-panel').removeClass('folder').addClass('active')
		})
		$(".c-fli-panel .u-cancel").on('click',function(){
			$mask.fadeOut()
			$(this).parent('.c-fli-panel-right').parent('.c-fli-panel').addClass('folder').removeClass('active')
		})

		//主贴管理
		$("#u-adminbar-tg").on('click',function(){
			$("#modmenu").fadeIn()
		})
		$("#w-adminbar-close").on('click',function(){
			$("#modmenu").fadeOut()
		})
	}else{
		//主贴管理
		$("#u-adminbar-tg").on('click',function(){
			alert('主贴管理工具条在顶部 —— PC端');
		})
	}
	
	//PC 分享
	$("#c-forum-title-share").on('click',function(){
		$(this).toggleClass('on');
	})

	//PC 跳转楼层
	$("#c-forum-title-goto").on('click',function(){
		$(this).toggleClass('on');
	})
	$("#c-forum-title-goto #fj").on('click',function(e){
		e.stopPropagation()
	})

	//公共 楼层回复开关
	var cmt_status = false;
	$(".c-fli-cmt-title").on('click',function(){
		$(this).toggleClass('on').next('.c-fli-cmt-content').slideToggle()
		$(this).siblings('.c-fli-cmt-btn').toggle()
		if(!cmt_status){
			cmt_status = true;
			$(this).text('展开回复')
		}else{
			cmt_status = false;
			$(this).text('收起回复')
		}
	})

	//显示隐藏贴
	var $showall = $("#w-tgpost-showall"),
		$ct = $(".c-fli")
        $showall.on('click',function(){
            $ct.fadeIn('slow');
            $(this).fadeOut();
            TGPOST_STATUS = false;
        })


})

