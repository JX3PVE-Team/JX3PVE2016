jQuery(function($){

    var isIE = function(verArr){
        var b = document.createElement('b');
        if(!verArr){
            b.innerHTML = '<!--[if IE]><i></i><![endif]-->';
            return b.getElementsByTagName('i').length === 1
        }
        for(var i = 0, len = verArr; i < len; i++){
            b.innerHTML = '<!--[if IE ' + verArr[i] + ']><i></i><![endif]-->'
            if(b.getElementsByTagName('i').length === 1){
                return true
            }
        }
        return false
    };

    var initForIE = function(){
        $(".flash-copy").click(function(){
            var id = $(this).data("clipboardTarget");
            window.copycode(document.getElementById(id))
        })
    };

    var initForOther = function () {
        $(".flash-copy").each(function(){
            var z = new ZeroClipboard($(this));
            z.on("aftercopy", function(e) {
                if(e.errors && e.errors.length){
                    alert("复制失败!");
                }else{
                    alert("已复制到粘贴板!")
                }
            })
        })
    };

    if(isIE([6,7,8])){
        initForIE();
    }else{
        initForOther();
    }


});