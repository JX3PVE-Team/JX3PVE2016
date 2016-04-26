jQuery(function($){
    $(".flash-copy").each(function(){
        var z = new ZeroClipboard($(this));
        z.on("aftercopy", function(e) {
            if(e.errors && e.errors.length){
                alert("复制失败!");
                //console.log(e.errors);
            }else{
                alert("已复制到粘贴板!")
            }
        })
    })
});