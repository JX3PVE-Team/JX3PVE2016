H.ready(['jquery'], function(){
    jQuery(function($){

    	var $gotop = $("#c-float-gotop"),
            $close = $("#c-float-close"),
            $fwin = $("#c-float-help")

    	//浮层·回到顶部
    	$gotop.on('click',function(){
    		$(window).scrollTop(0)
    	})

        //浮层·关闭
        $close.on('click',function(){
            $fwin.hide()
        })

        //紧急公告
        var warning = $.trim($('#c-alert-warning').text().length)
        if (warning > 0) {
            $('#c-alert-warning').show()
            $('html').addClass('alertHTML');
        }

    })
})
