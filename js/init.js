//释放JQ
jQuery.noConflict();

//加载公共模块
H.load([
	{'macro':head_conf.CDNROOT+'plugin/macro.min.js'},
	{'custom':head_conf.CDNROOT+'widget/w-custom.min.js'},
	{'fixSidebar':head_conf.CDNROOT+'plugin/fixSidebar.min.js'},
	{'getRequest':head_conf.CDNROOT+'plugin/getRequest.js'},
	{'dialog':head_conf.CDNROOT+'mod/dialog.min.js'},
	{'custombg':head_conf.CDNROOT+'mod/custombg.min.js'},
	{'sfilter':head_conf.CDNROOT+'mod/sfilter.min.js'},
	{'widget':head_conf.CDNROOT+'mod/widget.min.js'},
	{'underscore':head_conf.CDNROOT+'lib/underscore.min.js'},
	{'swiper':head_conf.CDNROOT+'plugin/swiper2.min.js'},
	{'clipboard':head_conf.CDNROOT+'plugin/clipboard.js'},
	{'copycode':head_conf.CDNROOT+'widget/copycode.js'}
]);

//开关
H.fadeshow = function(tg,ele){
	var $ = jQuery,
		t
	$(tg).add(ele).hover(function(){
		t && clearTimeout(t)
		$(ele).fadeIn()
	},function(){
		t = setTimeout(function(){
			$(ele).fadeOut()
		},400)
	})
}

//route助手
H.route = function(helpID,joinID){
	var $routeHelp = jQuery('#w-route-help'),
		$routeJoin = jQuery('#w-route-join')
	$routeHelp.attr('href','http://www.jx3pve.com/misc.php?mod=faq&action=faq&id='+helpID)
}

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