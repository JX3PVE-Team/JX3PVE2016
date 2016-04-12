H.ready(['jquery'], function(){
    jQuery(function($){

    	var $value = $(".s-filter-list").find('.item .value'),
    		$extend = $(".s-filter-list").find('.item .value .extend')

    	//点击展开选择
    	$value.on('click',function(){
            $value.not($(this)).removeClass('active')
    		$(this).toggleClass('active')
    	})
    	//点击任意选择后收起
    	$extend.on('click',function(e){
    		$(this).hide()
			e.stopPropagation()
    	})
    	//获取current key加入到default key
    	$value.each(function(){
    		//获取激活的key
    		var current_key = $(this).find('.extend .a a').text()

    		//当有激活项时
    		if(current_key){
    			//当item为服务器筛选时，字符串做截取
    			if($(this).find('.extend').hasClass('u-fwq-1')){
                    if(current_key == '不限'){
                        current_key == '不限'
                    }else{
                        current_key = $.trim(current_key.split('|')[1])
                        current_key = $.trim(current_key.split('/')[0])
                    }
    			}
    			//将当前值赋值给默认值
    			default_key = current_key
    		//如果没有激活项时
    		}else{
    			//将'不限'作为默认值
    			default_key = '不限'
    		}
    		
    		//插入求值
    		var $default_key = $(this).find('.default em')
    		$default_key.text(default_key)
    	});

        //服务器筛选重排
        var $fwq = $("#u-fwq-filter")
        var daqu = '<span><a href="javascript:void(0)">电信一区</a></span><span><a href="javascript:void(0)">电信二区</a></span><span><a href="javascript:void(0)">电信三区</a></span><span><a href="javascript:void(0)">电信四区</a></span><span><a href="javascript:void(0)">电信五区</a></span><span><a href="javascript:void(0)">电信六区</a></span><span><a href="javascript:void(0)">电信七区</a></span><span><a href="javascript:void(0)">电信八区</a></span><span><a href="javascript:void(0)">网通一二区</a></span><span><a href="javascript:void(0)">网通三区</a></span><hr/>';
        $fwq.children('li').hide()
        $fwq.prepend(daqu)
        $fwq.find('span').on('click',function(e){
            e.stopPropagation()
            var which = $(this).text()
            var which = '#u-fwq-filter li:contains("' + which + '")'
            $fwq.children('hr').show()
            $fwq.children('li').hide()
            $(which).show()
        })

		
    })
})