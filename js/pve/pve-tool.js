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
	$(".c-post-tab").children('li:first').children('a:first').text('发布教程')

	//列表页
    if(isMobile){
        //侧边栏展开与关闭
        $("#i-header-sidebar-tg").on('click',function(){
            $(".i-header").toggleClass('showSidebar')
            $(".default-sidebar").slideToggle()
            toggleMask();
        })
        $("#u-mask").on('click',function(){
            $(".default-sidebar").slideUp()
            $(".i-header").removeClass('showSidebar')
        })
        $(".default-sidebar-title").on('click',function(){
            $(this).next('.default-sidebar-content').fadeIn()
        })
        $(".default-sidebar-content").on('click',function(){
            $(this).fadeOut()
        })

        //搜索禁止冒泡
        $(".default-sidebar-search form").on('click',function(e){
            e.stopPropagation()
        })
    }

})