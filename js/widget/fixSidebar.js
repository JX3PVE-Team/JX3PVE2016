/*
* fixSidebar v0.5
* fix the sidebar when window scroll
* https://github.com/iRuxu
* update 2016.5.13
------------------------------------------------------*/
//args:
//selector: #target 
//top + bottom: margin to window for fix header or footer
//triggerScroll : while scroll distance bigger than this and trigger the fix state

jQuery(function($){

	//定义
	function fixSidebar(selector, top, bottom, triggerScroll) {

		var $ = jQuery

		//移动端不触发
		if(isMobile) return 

		//无参数时返回空
		if (selector == undefined) return

		//传入元素不正确时
		if ($(selector).length == 0) return

		//参数定义检测
		if (top == undefined) top = 0
		if (bottom == undefined) bottom = 0
		if (triggerScroll == undefined) triggerScroll = 20

		//定义获取水平坐标函数
		function getLeft(selector) {
			var offset = selector.offsetLeft;
			if (selector.offsetParent != null) offset += getLeft(selector.offsetParent);
			return offset;
		}

		//设置恢复定位
		function ActionPS() {
			$(selector).css('position', 'static').removeClass('fixSidebar')
		}

		//获取相关尺寸与滚动发生距离
		$(window).scroll(function() {

			//获取尺寸
			var scroll = $(window).scrollTop(), 	//滚动数值
				screen_H = $(window).height(), 		//屏幕高度
				body_H = $("body").height(),		//页面高度
				bar_H = $(selector).height(), 		//侧边栏高度
				ct_H = $("body").height() - top - bottom; 	//内容区可视区间高度
				bar_X = getLeft($(selector)[0]), 	//侧边栏的水平位置
				bar_Y = 0; 							//初始化侧边栏距顶

			//如果内容区过短，即侧边栏与body长度约相等时，则暂时不执行fix
			if(ct_H - bar_H < 100){
				return
			}
			
			//当内容区还可以被拖动时
			if ( ct_H - scroll > screen_H) {
				//设置侧边栏距顶为fix头的高度
				bar_Y = top
				//当滚动值
				if (scroll > triggerScroll) {
					$(selector).css({
						'position': 'fixed',
						'left': bar_X,
						'top': bar_Y,
						'bottom': ''
					}).addClass('fixSidebar')
				} else {
					ActionPS()
				}
			} else {
				//设置侧边栏距底为底部通栏的高度
				bar_Y = bottom
				if (scroll > bar_H - ct_H && scroll > triggerScroll) {
					$(selector).css({
						'position': 'fixed',
						'left': bar_X,
						'bottom': bar_Y,
						'top': ''
					}).addClass('fixSidebar')
				} else {
					ActionPS()
				}
			}
		});
	}

	window.fixSidebar = fixSidebar

	//触发事件
	window.onload = function() {
		jQuery(window).trigger('scroll');
	}
	jQuery(window).resize(function() {
		jQuery(window).trigger('scroll');
	})
		
	window.fixSidebar = new fixSidebar('.default-sidebar', 46, 260 , 173);

})