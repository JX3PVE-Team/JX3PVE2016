jQuery(function($){

    //分类信息字段筛选扩展
    $filter = $("#w-filter .w-filter-font .item .label")
    $filter.each(function(){
        var $label = $(this),
            $value = $(this).next('.value')
        $label.on('click',function(){
            $label.toggleClass('on');
            $value.slideToggle()
        })
    })

})