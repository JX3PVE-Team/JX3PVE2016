H.ready(['jquery'], function(){
    jQuery(function($){
        var 
        	$tg = $("#w-tgpost"),
        	$ct = $(".c-fli"),
        	$icon = $("#w-tgpost-icon"),
        	$tips = $("#w-tgpost-text"),
            $showall = $("#w-tgpost-showall"),
            isFolderDefault = $(".tgpost-folder").length;

            $tg.on('click',function(){
                $ct.fadeToggle('slow');
                $icon.toggleClass('on');
            })

            $showall.on('click',function(){
                $ct.fadeIn('slow');
                $(this).fadeOut();
            })

            if(isFolderDefault){
                $ct.hide();
            }else{
                $icon.addClass('on');
            }

    })
})
