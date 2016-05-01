jQuery(function($){

	//侧边栏展开
	$(".user-sidebar-title").on('click',function(){
		$(this).toggleClass('on');
		$(this).next('.user-sidebar-list').slideToggle()
	})
	$(".user-sidebar-list li").each(function(){
		if($(this).hasClass('on')){
			$(this).parent('.user-sidebar-list').addClass('on')
			$(this).parent('.user-sidebar-list').prev('.user-sidebar-title').addClass('on')
		}
	})

	//自适应界面布局
		/*//当PC版，内容区少于侧边栏高度时，给内容包裹区设置最小高度等于侧边栏
		var $sidebar = $(".user-sidebar")
		var $content = $(".user-content")
		var $main = $(".user-main")
		var isDefaultSkin = $sidebar.length && $content.length;
		if(isDefaultSkin && isNotMobile){
			var sidebar_H = $sidebar.outerHeight()
			var content_H = $content.outerHeight()
			if(sidebar_H > content_H){
				$main.css('min-height',sidebar_H)
			}
		}
*/

})