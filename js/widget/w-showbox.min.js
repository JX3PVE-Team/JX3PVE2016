jQuery(function($){
    
    var
    $imgorigin = $(".u-imgorigin"),
    $showbox = $("#c-showbox"),
    $close = $("#c-showbox-close")

    var padding = 28

    $imgorigin.each(function(){
        var src = $(this).find('img').attr('src')
        var isEmpty = !src || src.indexOf('nophoto')!=-1
        if(isEmpty){
            $(this).addClass('isEmpty')
        }else{
            $(this).on('click',function(){
                showMask()
                $(this).find('img').clone().attr('id','c-showbox-img').attr('class','c-showbox-img').appendTo($showbox)
                $showbox.fadeIn()

                var 
                offset_x = - $showbox.outerWidth()/2,
                offset_y = - $showbox.outerHeight()/2

                $showbox.css({
                    'margin-left': offset_x,
                    'margin-top': offset_y
                })

            })
        }
    })

    $close.on('click',function(){
        hideMask()
        $showbox.fadeOut()
        $('#c-showbox-img').remove()
    })

    if(isMobile){
        $showbox.on('click',function(){
            hideMask()
            $(this).fadeOut()
            $('#c-showbox-img').remove()
        })
    }

})