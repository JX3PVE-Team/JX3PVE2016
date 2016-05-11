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

	//团队成员
	e-role


	//交易列表
	

	//交易详情
		H.time('.e-dateline')


})