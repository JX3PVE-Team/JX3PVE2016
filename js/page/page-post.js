jQuery(function($){
	
	//全屏编辑状态
	$("#e_fullswitcher").on('click',function(){
		$("body").toggleClass('e-fullscreen-edit');
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


})

