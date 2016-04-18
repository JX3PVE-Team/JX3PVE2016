H.ready(['jquery'], function(){
    jQuery(function($){
        var 
        	$tg = $("#w-tgpost"),
        	$ct = $(".c-fli"),
        	$icon = $("#w-tgpost-icon"),
        	$tips = $("#w-tgpost-text"),
            isFolderDefault = $(".tgpost-folder").length;

            $tg.on('click',function(){
                $ct.fadeToggle('slow');
                $icon.hasClass('on') ? $tips.text('展开') : $tips.text('折叠');
                $icon.toggleClass('on');
            })

            if(isFolderDefault){
                $ct.hide();
            }else{
                $icon.addClass('on');
                $tips.text('折叠');
            }

    })
})
