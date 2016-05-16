jQuery(function($){

	
	//下载地址为空的处理
	$(".down_url").each(function(){
		var url = $.trim($(this).next('.down_url_data').html())
		if(url.length < 2){
			$(this).hide()
		}else if(url.indexOf('回复可见') != -1){
			url = 'hide'
			$(this).on('click',function(e){
				e.preventDefault()
				loadDialog('download')
			})
		}else{
			$(this).attr('href',url)
		}
	})

	//重写发布的地址
	$("#newspecial,#newspecialtmp").attr('href','forum.php?mod=post&action=newthread&sortid=8&fid=79')

})