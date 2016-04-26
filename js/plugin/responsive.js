jQuery(function($){
            
    var timer = null;
    var $window = $(window).resize(function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            $window.trigger('onResizeEx');
        }, window.RESIZEINTERVAL || 200)
    })

    var w = $(window)
    var resetLayout = function() {
        var width = ~~w.width(),
            $body = $('body');
        $body.removeClass('screen-s screen-m screen-l')
        var screenSize = {
            'screen-s': [0, 768],
            "screen-m": [768, 1024],
            "screen-l": [1024]
        };
        var bodyClazz = ""
        for(var clazz in screenSize){
            
            var min = screenSize[clazz][0];
            var max = screenSize[clazz][1];
            if(width >= min && width < max){
                bodyClazz = clazz;
                break;
            }
            if(screenSize[clazz].length == 1){
                bodyClazz = clazz;
                break;
            }
        }

        $body.addClass(bodyClazz);

        //判断是否满足条件
        window.isMobile = $("html").hasClass('ua-responsive') && $body.hasClass('screen-s');
        
    };
    resetLayout()
    w.bind('onResizeEx', resetLayout);

})
