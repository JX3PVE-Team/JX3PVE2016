jQuery(function($){
    var 
        //开关
    	$tg = $("#w-tgpost"),
        //列表
    	$ct = $(".c-fli"),
        //图标
    	$icon = $("#w-tgpost-icon")

    //当根本不存在回复楼层时隐藏该组件
    if($ct.length < 2) $tg.hide()

    //默认设为关闭，折叠true，不折叠false
    window.TGPOST_STATUS = false;

    //假设检测到默认需要折叠
    var isFolderDefault = $(".tgpost-folder").length;
        if(isFolderDefault){
            //隐藏列表
            $ct.hide();
            //设置图标为+号，表示可以展开
            $icon.addClass('on');
            //重写变量
            TGPOST_STATUS = true;
        }

    //其它点击状态
     $tg.on('click',function(){
        //如果已经折叠
        if(TGPOST_STATUS){
            $ct.fadeIn('slow');
            $icon.removeClass('on');
            TGPOST_STATUS = false;
        //如果还没有折叠
        }else{
            $ct.fadeOut('slow');
            $icon.addClass('on');
            TGPOST_STATUS = true;
        }
    })


})
