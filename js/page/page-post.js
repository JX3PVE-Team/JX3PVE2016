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
	if($body.hasClass('screen-s')){
		$editorEXtg.text('展开')
		$editorEX.toggleClass('folder')
	}

	//手机版模拟顶部按钮提交表单
	$("#i-header-postbtn").on('click',function(){
		$("#postform").submit();
	})


})

