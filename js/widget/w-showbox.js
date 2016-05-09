jQuery(function($){
    
    //查看脸型原图 imgorigin
    var
    $html = $("html"),
    $imgorigin = $(".u-imgorigin"),
    $mask = $("#u-mask"),
    $showbox = $("#c-showbox"),
    $boxclose = $("#c-showbox-close"),
    $imgbox = $("#c-showbox-content")
    $imgorigin.on('click',function(){
        var img = $(this).find('img'),
            src = img.attr('src')
        if(src && src.indexOf('nophoto')==-1){
            $mask.fadeIn()
            $html.addClass('fixpage')
            $imgbox.append('<img id="c-showbox-img" src="'+ src + '"/>')
            var box_w = $showbox.outerWidth(),
                box_h = $showbox.outerHeight(),
                ct_w = $showbox.width(),
                ct_h = $showbox.height(),
                offset_x = -box_w/2,
                offset_y = -box_h/2
            $imgbox.height(ct_h).width(ct_w)
            $showbox.fadeIn().addClass('c-showbox-show').css({
                'margin-left': offset_x,
                'margin-top': offset_y
            })
        }
    })
    //脸型原图
    $boxclose.on('click',function(){
        $mask.fadeOut()
        $html.removeClass('fixpage')
        $showbox.fadeOut()
        $('#c-showbox-img').remove()
    })

    if(isMobile){
        $showbox.on('click',function(){
            $mask.fadeOut()
            $html.removeClass('fixpage')
            $(this).fadeOut()
            $('#c-showbox-img').remove()
        })
    }

})