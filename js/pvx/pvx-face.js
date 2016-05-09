jQuery(function($){
	//列表页遍历
	$(".m-face-list-item").each(function(){
		//角标验证
		var isDST = parseInt($(this).find('.digest').text()) > 0,
			isHOT = parseInt($(this).find('.downs').text()) > 5000,
			isCMD = parseInt($(this).find('.cmds').text()) > 50,
			$mark = $(this).find('.mark')
		if(isDST) $mark.addClass('mark-1')
		if(isHOT) $mark.addClass('mark-2')
		if(isCMD) $mark.addClass('mark-3')
	})
})