jQuery(function($){

	var $body = $("body")

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
	if($body.hasClass('ua-mobile')){
		$editorEXtg.text('展开')
		$editorEX.toggleClass('folder')
	}

	//手机版模拟顶部按钮提交表单 - 已关闭
	$("#i-header-postbtn").on('click',function(){
		$("#postform").submit();
	})

	//展开草稿
	$("#draftlist").on('click',function(){
		$("#draftlist_menu").slideToggle()
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
	$("#c-post-tips-tg").on('click',function(){
		$("#c-post-tips-content").fadeIn()
		$("html").addClass('isfixed')
	})
	$("#c-post-tips-content").on('click',function(){
		$("html").removeClass('isfixed')
		$(this).fadeOut()
	})


})

