jQuery(function($){

	//性别
	$(".m-ow-item").not('.m-ow-item-th').children('.u-sex').each(function(){
		var status = $(this).children('em').text();
		var $icon = $(this).children('i');
		switch(status){
			case 'boy':
				$icon.addClass('u-sex-boy');
				break;
			case 'girl':
				$icon.addClass('u-sex-girl');
				break;
			case 'gay':
				$icon.addClass('u-sex-gay');
				break;
			case 'shemale':
				$icon.addClass('u-sex-shemale');
				break;
		}
	})

	//英雄
	var owlist = {
		"士兵：76":"u-hero-76",
		"死神":"u-hero-reaper",
		"法老之鹰":"u-hero-pharah",
		"源氏":"u-hero-genji",
		"猎空":"u-hero-tracer",
		"麦克雷":"u-hero-mccree",
		"半藏":"u-hero-hanzo",
		"堡垒":"u-hero-bastion",
		"托比昂":"u-hero-torbjorn",
		"狂鼠":"u-hero-junkrat",
		"美":"u-hero-mei",
		"黑百合":"u-hero-widowmaker",
		"D.VA":"u-hero-dva",
		"查莉娅":"u-hero-zarya",
		"温斯顿":"u-hero-winston",
		"莱因哈特":"u-hero-reinhardt",
		"路霸":"u-hero-roadhog",
		"卢西奥":"u-hero-lucio",
		"天使":"u-hero-mercy",
		"安娜":"u-hero-ana",
		"禅雅塔":"u-hero-zenyatta",
		"秩序之光":"u-hero-symmetra"
	}
	
	$(".m-ow-item").not('.m-ow-item-th').children('.u-hero').each(function(){
		var herolist = []
		//获取单个英雄数组
		var hero = $(this).children('em').html().split('&nbsp;')
		//去掉最后一个空值
		hero.pop()
		//组成html图标数组
		$(hero).each(function(i,ele){
			ele = '<i class="' + owlist[hero[i]] +'">' + '</i>';
			herolist.push(ele)
		})
		//生成html字符串
		herolist.join('')
		$(this).children('.u-hero-icon').append(herolist)
	})

	//游戏状态
	$(".m-ow-item").not('.m-ow-item-th').children('.u-status').each(function(){
		var status = $(this).text()
		if (status=='最近在玩'){
			$(this).addClass('u-status-on')
		}else{
			$(this).addClass('u-status-off')
		}
	})

})