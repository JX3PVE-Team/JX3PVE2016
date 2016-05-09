jQuery(function($){

    //帖子页
    if($(".viewpage-container").length){
    	//非必填字段为空隐藏
        	$('.m-macro-roleinfo').each(function(i,item){
        		if($(this).children('.content').length!=0){
        			var block_l_temp = $(this).children('.content').text(),
        				block_l = $.trim(block_l_temp)
        			if(!block_l){
        				$(this).hide();
        			}
        		}
        	})
        //基本信息块初始化
            //心法
            var role = $(".c-fli-title .u-type").text().replace('[','').replace(']','')
            $("#u-macro-role").text(role)

            //资料片
            var zlp = $("#u-macro-zlp").html().split('&nbsp;')
            var _zlp = []
            $(zlp).each(function(i,ele){
                ele = '<b>' + ele + '</b>'
                _zlp.push(ele)
            })
            _zlp.pop()
            _zlp = _zlp.join('')
            $("#u-macro-zlp").html(_zlp)

            //独家首发
            var isDJ = $("#u-macro-justjx3pve").text().indexOf('是') != -1
            if(isDJ) $(".u-macro-justjx3pve").addClass('true')
            //console.log(isDJ)

            //点赞破万
            var isDZ = parseInt($("#u-macro-zan").text()) >= 1000
            if(isDZ) $(".u-macro-zan").addClass('true')
            //console.log(isDZ)

            //几年老宏
            var posttime = parseInt($("#u-macro-posttime").text()) * 1000
            //console.log('发布时间' + posttime)
            var timestamp = new Date().getTime()
            //console.log('当前时间' + timestamp)
            var oneYear = Date.parse('1971/1/1')
            var twoYear = Date.parse('1972/1/1')
            var isOneYear =  (timestamp - posttime) >= oneYear
            var isTwoYear = (timestamp - posttime) >= twoYear
            //console.log(isOneYear)
            //console.log(isTwoYear)

            if(isOneYear){
                $(".u-macro-posttime").addClass('true')
                if(isTwoYear){
                    $("#u-macro-posttime-ex").addClass('u-macro-posttime-2')
                    $("#u-macro-posttime-ex").text('两年老字号')
                }else{
                    $("#u-macro-posttime-ex").addClass('u-macro-posttime-1')
                }
            }
    }

    //发布页
    if(isMobile){
        $("#c-post-tips-tg").on('click',function(){
            $("#c-post-tips-content").hide()
            $(".default-sidebar").show()
            $(".default-sidebar-title").hide()
            $(".default-sidebar-content.m-macro-systax").fadeIn()
        })
        $(".m-macro-systax").on('click',function(){
            $(this).fadeOut();
        })
    }

})
