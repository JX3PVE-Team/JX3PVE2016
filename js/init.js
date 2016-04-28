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

	var $html = jQuery('html')
	var $body = jQuery('body')
	var $mask = jQuery('#u-mask')

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

})