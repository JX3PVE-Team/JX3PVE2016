jQuery(function($){

	//副本年代归类
	var $fbnamelist = $("#select_fbname ul li")
	$fbnamelist.eq(0).addClass('u-fbtime-all')
	$fbnamelist.slice(1,7).addClass('u-fbtime-95')
	$fbnamelist.slice(7,14).addClass('u-fbtime-90')
	$fbnamelist.slice(14,21).addClass('u-fbtime-80')
	$fbnamelist.slice(21).addClass('u-fbtime-70')

	//BOSS归属归类
	var $fbbosslist = $("#select_fbboss ul li")
	$fbbosslist.slice(0,5).addClass('u-fbname-gfd')
	$fbbosslist.slice(5,8).addClass('u-fbname-syt')
	$fbbosslist.slice(8,13).addClass('u-fbname-xlty')
	$fbbosslist.slice(13,16).addClass('u-fbname-hyby')
	$fbbosslist.slice(16,21).addClass('u-fbname-ddt')
	$fbbosslist.slice(21).addClass('u-fbname-qld')

	//选择年代 筛选 副本
	$("#select_fbtime input").on('click',function(){
		var time = $(this).val()
		switch(time){
			case '4' :  //4 = 95年代
				$fbnamelist.not('.u-fbtime-all').fadeOut().filter('.u-fbtime-95').fadeIn();
				break;
			case '1' :  //1 = 90年代
				$fbnamelist.not('.u-fbtime-all').fadeOut().filter('.u-fbtime-90').fadeIn();
				break;
			case '2' :  //2 = 80年代
				$fbnamelist.not('.u-fbtime-all').fadeOut().filter('.u-fbtime-80').fadeIn();
				break;
			case '3' :  //3 = 70年代
				$fbnamelist.not('.u-fbtime-all').fadeOut().filter('.u-fbtime-70').fadeIn();
				break;
		}
	})

	//选择副本 筛选 BOSS
	$("#select_fbname input").on('click',function(){
		var group = $(this).val()
		switch(group){
			case '22' :  //双曜亭
				$fbbosslist.fadeOut().filter('.u-fbname-syt').fadeIn();
				break;
			case '23' :  //观风殿
				$fbbosslist.fadeOut().filter('.u-fbname-gfd').fadeIn();
				break;
			case '21' :  //花月别院
				$fbbosslist.fadeOut().filter('.u-fbname-hyby').fadeIn();
				break;
			case '20' :  //仙侣庭园
				$fbbosslist.fadeOut().filter('.u-fbname-xlty').fadeIn();
				break;
			case '24' :  //锻刀厅
				$fbbosslist.fadeOut().filter('.u-fbname-ddt').fadeIn();
				break;
			case '25' :  //千雷殿
				$fbbosslist.fadeOut().filter('.u-fbname-qld').fadeIn();
				break;
		}
	})

	if(isMobile){
		$(".w-mode-category-list").prepend($(".m-fam-search"))
		$(".w-mode-category-list").prepend($(".m-fam-boss"))
	}

})