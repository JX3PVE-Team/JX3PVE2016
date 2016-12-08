jQuery(function($){

	var $mask = $("#u-mask")

	if(isMobile){
		//需要弹出遮罩层的（局部双层菜单无需弹出浮层）
		$(".u-mask-tg").on('click',function(e){
			//避免自身dom插入时冒泡关闭
			e.stopPropagation()
			$mask.fadeIn()
		})
	}

	//副楼panel扩展菜单
	$(".c-fli-header .u-more").on('click',function(){
		$mask.fadeIn()
		$(this).parent('.u-panel').parent('.c-fli-header').siblings('.c-fli-footer').children('.c-fli-panel').removeClass('folder').addClass('active')
	})
	$(".c-fli-panel .u-cancel").on('click',function(){
		$mask.fadeOut()
		$(this).parent('.c-fli-panel-right').parent('.c-fli-panel').addClass('folder').removeClass('active')
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
        $("#w-tgpost").on('click',function(){
        	$showall.fadeOut();
        })

    //主贴管理
    if(isMobile){
    	//主贴管理
		$("#u-adminbar-tg").on('click',function(){
			$("#modmenu").fadeIn()
		})
		$("#w-adminbar-close").on('click',function(){
			$("#modmenu").fadeOut()
		})
    }else{
    	$("#u-adminbar-tg").on('click',function(){
			alert('主贴管理工具条在顶部 —— PC端');
		})
    }

    //道具层
    $(".c-fli-footer .u-magic").on('click',function(){
    	$(this).parent('.c-fli-panel-right').parent('.c-fli-panel').next('.c-fli-magic').slideToggle()
    })
    $(".c-fli-magic .u-magic-close").on('click',function(){
    	$(this).parent('li').parent('.c-fli-magic').slideUp()
    })

    //PC 分享
	$("#c-forum-title-share").on('click',function(){
		$(this).toggleClass('on');
	})


})

