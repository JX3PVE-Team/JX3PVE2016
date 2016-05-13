jQuery(function($){

	//发布按钮
		$("#u-jh-pubbtn").on('click',function(){
			showMask()
			$("#m-jh-postbox").fadeIn()
		})
		if(isMobile){
			$(".i-header-menu .u-post").on('click',function(e){
				e.preventDefault()
				showMask()
				$("#m-jh-postbox").fadeIn()
			})
		}
		$("#u-jh-close").on('click',function(){
			hideMask()
			$("#m-jh-postbox").fadeOut()
		})

	//隐藏已过期的数据
		$(".m-raid-item").each(function(){
			var failtime = $(this).find('.e-failtime').text()
			if(failtime){
				var d = (new Date(failtime.replace(/-/g, "/"))).getTime(),
					n = (new Date()).getTime()
				if(d < n){
					$(this).hide()
				}
			}
		})

	//team 列表
		$(".m-team-item").each(function(){
			var isnoLogo = $(this).find('.logo').attr('src').length < 2 || $(this).find('.logo').attr('src').indexOf('nophoto')!=-1
			if(isnoLogo){
				$(this).find('.u-raidlogo').addClass('noraidbg');
				$(this).find('.logo').hide();
			}
		})

	//team 详情
		$(".m-team-info").each(function(){
			var isEmpty = $.trim($(this).text()).length < 5
			//console.log(isEmpty)
			if(isEmpty){
				$(this).hide()
				$(this).prev('.u-moreinfo').hide()
			}
		})

	//member 公共·门派图标
		var role = {
			'全职业制霸':'ty',
			'七秀':'qx',
			'万花':'wh',
			'五毒':'wd',
			'天策':'tc',
			'明教':'mj',
			'少林':'sl',
			'纯阳':'cy',
			'唐门':'tm',
			'藏剑':'cj',
			'丐帮':'gb',
			'苍云':'cyun',
			'长歌门':'cgm'
		}
		$(".e-role").each(function(){
			var list = $(this).html()
			var arr = list.split('&nbsp;')
			arr.pop()

			var new_arr = []
			$(arr).each(function(i,ele){
				ele = '<i class="e-role-' + role[ele] + '"></i>'
				new_arr.push(ele)
			})
			//console.log(arr)
			//console.log(new_arr)

			var rolelist = new_arr.join('')
			$(this).html(rolelist)
		})

	//member 列表页
		$(".m-member-item").each(function(){
			var url = $(this).find('.u-go').attr('href')
			$(this).find('.u-name a').attr('href',url)
		})

	//biz 交易列表
		var bizType= {
			'账号':'u-type-1',
			'代练':'u-type-2',
			'装备':'u-type-3',
			'其他':'u-type-4'
		}
		$(".m-biz-item").each(function(){
			var type = $(this).find('.biz-type').text()
			var typeClass = bizType[type]
			$(this).find('.biz-type').children('i').addClass(typeClass)
		})

	//biz 交易详情
		H.time('.e-dateline')

})