//释放JQ
jQuery.noConflict();

//加载公共模块
H.load([
	{'macro':head_conf.CDNROOT+'plugin/macro.min.js'},
	{'copycode':head_conf.CDNROOT+'widget/copycode.min.js'},
	{'clipboard':head_conf.CDNROOT+'plugin/clipboard.js'},
	{'custom':head_conf.CDNROOT+'widget/w-custom.min.js'},
	{'getRequest':head_conf.CDNROOT+'plugin/getRequest.js'},
	{'dialog':head_conf.CDNROOT+'mod/dialog.min.js'},
	{'custombg':head_conf.CDNROOT+'mod/custombg.min.js'},
	{'sfilter':head_conf.CDNROOT+'mod/sfilter.min.js'},
	{'widget':head_conf.CDNROOT+'mod/widget.min.js'},
	{'underscore':head_conf.CDNROOT+'lib/underscore.min.js'},
	{'swiper':head_conf.CDNROOT+'plugin/swiper2.min.js'}
]);

//移动端全局变量&&函数，事件触发仅限于移动端且新版适配时
jQuery(function($){

	//常用对象缓存
	var $win = $(window)
	var $html = $('html')
	var $body = $('body')
	var $mask = $('#u-mask')
	var $box = $(".jx3pve-container")
	window.uid = $("#e-uid").text()

	//常量声明
	window.c_header_height = 45
	window.c_footer_height = 46

	//unix时间戳转换
    H.time = function(selector,dividing){
        var $ = jQuery
        if(dividing == undefined) dividing='-'
        $(selector).each(function(){
            unixtime = $.trim($(this).text()),
            _time = new Date(parseInt(unixtime) * 1000),
            time = _time.getFullYear() + '-' + (_time.getMonth()+1) + '-' + _time.getDate(),
            arr = time.split('-')

            for (var i = 0; i < 3; i++) {
                if (arr[i] < 10 ) arr[i] = '0' + arr[i]
            }

            time = arr.join(dividing)
            $(this).text(time)
        })
    }

	//开关遮罩层
	window.MASK_STATUS = false;
	window.showMask =function(){
		$mask.fadeIn()
		$html.addClass('isfixed')
		MASK_STATUS = true;
	}
	window.hideMask = function(){
		$mask.fadeOut()
		$html.removeClass('isfixed')
		MASK_STATUS = false;
	}
	window.toggleMask = function(){
		if(!MASK_STATUS){
			showMask()
		}else{
			hideMask()
		}
	}

	//自适应界面布局
		/*//当PC版，内容区少于侧边栏高度时，给内容包裹区设置最小高度等于侧边栏
		var $sidebar = $(".default-sidebar")
		var $content = $(".default-content")
		var $main = $(".default-main")
		var isDefaultSkin = $sidebar.length && $content.length;
		if(isDefaultSkin && isNotMobile){
			var sidebar_H = $sidebar.outerHeight()
			var content_H = $content.outerHeight()
			if(sidebar_H > content_H){
				$main.css('min-height',sidebar_H)
			}
		}*/
		//当内容区小于窗口高度时，设置内容包裹区高度最小高度让全部内容满屏
		var win_H = $win.height()
		var body_H = $body.innerHeight()
		var isNotFullscreen = body_H < win_H;
		var alertHeight = ( $("#c-alert-warning").html().length > 2 ) ? 30 : 0;
		if(isNotFullscreen && isNotMobile){
			var diff_win_body = win_H - body_H
			var box_minHeight = body_H - c_header_height - 237 - alertHeight + diff_win_body
			$box.css('min-height',box_minHeight)
		}

})