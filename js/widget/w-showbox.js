jQuery(function($){
    
    var
    $imgorigin = $(".u-imgorigin"),
    $showbox = $("#c-showbox"),
    $imgbox = $("#c-showbox-content"),
    $close = $("#c-showbox-close")

    $imgorigin.each(function(){
        var src = $(this).find('img').attr('src')
        var isEmpty = !src || src.indexOf('nophoto')!=-1
        if(isEmpty){
            $(this).addClass('isEmpty')
        }else{
            $(this).on('click',function(){
                showMask()
                var src= $(this).find('img').attr('src')
                $imgbox.append('<img class="c-showbox-img" id="c-showbox-img"/>')
                var $img = $("#c-showbox-img")
                $img.attr('src',src)
                $showbox.fadeIn()

                //在display:block后正常获得图片大小后再进行位移
                var 
                offset_x = - $showbox.outerWidth()/2,
                offset_y = - $showbox.outerHeight()/2
                $showbox.css({
                    'margin-left': offset_x,
                    'margin-top': offset_y
                })
                $showbox.addClass('isShow')

                //图片大小不受控问题
                var w = $showbox.width()
                var h = $showbox.height()
                $img.width(w)
                $img.height(h)

            })
        }
    })

    $close.add($showbox).on('click',function(){
        hideMask()
        $('#c-showbox-img').remove()
        $showbox.fadeOut()
    })

})