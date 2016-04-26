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