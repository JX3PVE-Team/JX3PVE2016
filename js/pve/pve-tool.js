jQuery(function($){

	
	//下载地址为空的处理
	$(".down_url").each(function(){
		var url = $.trim($(this).next('.down_url_data').html())
		if(url.length < 2){
			$(this).hide()
		}else if(url.indexOf('回复可见') != -1){
			$(this).on('click',function(e){
				e.preventDefault()
				loadDialog('download')
			})
		}else{
			if(url.indexOf('jx3pve.com') == -1){
				$(this).attr('href',url).attr('target','_blank')
			}else{
				$(this).attr('href',url)
			}
		}
	})

	//非必填字段为空隐藏
	$('.m-tool-info').each(function(i,item){
		if($(this).children('.content').length!=0){
			var block_l_temp = $(this).children('.content').text(),
				block_l = $.trim(block_l_temp)
			if(!block_l){
				$(this).hide();
			}
		}
	})

	//重写发布的地址
	$("#newspecial,#newspecialtmp").attr('href','forum.php?mod=post&action=newthread&sortid=5&fid=321')

})