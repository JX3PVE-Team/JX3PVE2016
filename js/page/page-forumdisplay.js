jQuery(function($){

    //PC版筛选  分类信息字段筛选扩展
    var  $filter_label = $("#w-filter .w-filter-font .item .label")
    var  $filter_value = $("#w-filter .w-filter-font .item .value")
    $filter_label.each(function(){
        $(this).on('click',function(){
            var $label = $(this)
            var $value = $(this).next('.value')

            //避免同时展开
            $filter_label.not($label).removeClass('on')
            $filter_value.not($value).hide()

            $label.toggleClass('on');
            $value.slideToggle()
        })
    })
    

    var $mask = $("#u-mask")
    var $html = $("html")

    //mobile版排序·新
    var $order_tg = $("#w-mode-order-tg")
    var $order_list = $("#w-mode-order-list")
    var $order_cancel = $("#w-mode-order-cancel")
    $order_tg.on('click',function(){
        toggleMask();
        $order_list.removeClass('folder').addClass('active')
    })
    $order_cancel.on('click',function(){
        toggleMask();
        $order_list.addClass('folder').removeClass('active')
    })
    $mask.on('click',function(e){
        $order_list.addClass('folder').removeClass('active')
    })
    var curorder = $order_list.find('.on').text()
    $order_tg.find('span').text(curorder)

    //mobile版分类·新
    var $category_tg = $(".w-mode-category-tg")
    var $catetg = $("#i-header-category")
    var $cateclose = $(".w-mode-category-close")
    var $category_list = $(".w-mode-category-list")

    var curcategory = $category_list.find('.on').text()
    curcategory ? curcategory = curcategory : curcategory = '全部'
    $category_tg.find('span').text(curcategory)
    
    $catetg.add($category_tg).add($cateclose).on('click',function(){
        $catetg.toggleClass('on')
        $html.toggleClass('isfixed')
        $category_list.fadeToggle()
    })

})

//点赞
function recommendupdate(n,tid) {
    /*ajaxid_0.7870330682809448_menu_content
    var zanid = '#c-flist-item-zan-' + tid;
    var num = 1;
    jQuery(function($){
        var cur = parseInt($(zanid).text())
        var ajaxid = $(zanid).parent('.c-flist-item-zan').attr('id')
        var iscmd = 
        console.log(cur)
        console.log(ajaxid)
    });*/
    /*var objv = n > 0 ? $('recommendv_add') : $('recommendv_subtract');
    objv.style.display = '';
    objv.innerHTML = parseInt(objv.innerHTML) + 1;
    setTimeout(function () {
        $('recommentc').innerHTML = parseInt($('recommentc').innerHTML) + n;
        $('recommentv').style.display = 'none';
    }, 1000);*/
}


