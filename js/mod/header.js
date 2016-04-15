H.ready(['jquery'], function(){
    jQuery(function($){

        //扩展菜单展开
    	var $login_default = $("#c-header-user-login-default"),
    		$login_extend = $("#c-header-user-login-extend"),
            $tg = $("#c-header-user-tg")

        //平板竖屏下用户菜单事件兼容
        if($("html").hasClass('mobile')){
            $tg.on('click',function(e){
                e.preventDefault()
                $login_default.toggleClass('on')
                $login_extend.toggle()
            })
        }else{
            $login_default.add($login_extend).hover(function(){
                $login_default.addClass('on')
                $login_extend.show()
            },function(){
                $login_default.removeClass('on')
                $login_extend.hide()
            })
        }

        //消息通知总数
        var $count = $("#c-header-msgcount")
        var count = 0;
        $("#c-header-msgdetails span").each(function(){
            count = count + parseInt($(this).text());
        });
        $count.text(count);

    })
})
