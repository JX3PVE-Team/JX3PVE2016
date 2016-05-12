jQuery(function($){
    
    var
    $imgorigin = $(".u-imgorigin"),
    $showbox = $("#c-showbox"),
    $close = $("#c-showbox-close")

    var padding = 28

    function createImgDOM(){
        $showbox.append('<img class="c-showbox-img" id="c-showbox-img" src="" />')
    }

    $imgorigin.each(function(){
        var img = $(this).find('img')
        var src = $(this).find('img').attr('src')
        var isEmpty = !src || src.indexOf('nophoto')!=-1
        if(isEmpty){
            $(this).addClass('isEmpty')
        }else{
            $(this).on('click',function(){
                showMask()
                createImgDOM()
                $("#c-showbox-img").attr('src',src)
                
                var 
                    offset_x = - ($showbox.width() + padding*2 )/2,
                    offset_y = - ($showbox.height() + padding*2 )/2

                $showbox.fadeIn().addClass('c-showbox-show').css({
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