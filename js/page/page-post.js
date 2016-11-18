jQuery(function($){

	var $body = $("body")

	$("#w-custom-zoom").on('click',function(){
		alert('按住【ctrl】，滚动鼠标【滚轮】即可缩放界面');
	})
	
	//全屏编辑状态
	$("#e_fullswitcher").on('click',function(){
		$body.toggleClass('e-fullscreen-edit');
	})

	//编辑器底部扩展
	var $editorEX = $("#c-editor-extend"),
		$editorEXtg = $("#c-editor-extend-tg"),
		$editorMore = $("#c-editor-extend-more")
	$editorEXtg.on('click', function() {
		$editorEX.hasClass('folder') ? $editorEXtg.text('折叠') : $editorEXtg.text('展开')
		$editorEX.toggleClass('folder')
	})
	$editorMore.on('click',function(){
		$editorEX.addClass('showall')
		$(this).hide()
	})

	//手机端默认折叠扩展
	if($body.hasClass('screen-s')){
		$editorEXtg.text('展开')
		$editorEX.toggleClass('folder')
	}

	//展开草稿
	$("#draftlist").on('click',function(){
		$("#draftlist_menu").slideToggle()
	})

	//手机版模拟顶部按钮提交表单 - 已关闭
	$("#i-header-postbtn").on('click',function(){
		$("#postform").submit();
	})

	//当发布提示为空时隐藏该整区
	if($("#c-post-tips-content").html().length < 2){
		$(".c-post-tips").hide()
	}

	//特殊版警告时（内容较多，带黄色tg）
	$("#c-post-tips-moretg").on('click',function(){
		$("#c-post-tips-content").fadeToggle()
		$(this).toggleClass('open');
	})

	//手机版发布提示
	if(isMobile){
		$("#c-post-tips-tg").on('click',function(){
			$("#c-post-tips-content").fadeIn()
			$("html").addClass('isfixed')
		})
		$("#c-post-tips-content").on('click',function(){
			$(this).fadeOut()
			$("html").removeClass('isfixed')
		})
	}


})

