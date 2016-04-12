H.ready(['jquery'], function() {
	jQuery(function($) {

		//导航栏激活
		H.curpage('.u-bbs')

		//侧边栏
		H.fixSidebar('.pve-sidebar', 110, 105, 100)

	})
})