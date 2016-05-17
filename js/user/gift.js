jQuery(function($){
	//tab切换
	$(".baseinfo a").on('click',function(){
		$(".baseinfo a").removeClass('on')
		$(this).addClass('on')
		var index = $(this).index()
		$(".m-gift-block").hide().eq(index).show()
	})

	//判断积分是否足够
	var rq = parseInt($("#u-credit-rq").val()),
		sj = parseInt($("#u-credit-sj").val())

	$(".u-credit-rq").each(function(){
		var need = parseInt($(this).text())
		if(rq < need){
			$(this).addClass('isfalse')
		}else{
			$(this).addClass('istrue')
		}
	})
	$(".u-credit-sj").each(function(){
		var need = parseInt($(this).text())
		if(sj < need){
			$(this).addClass('isfalse')
		}else{
			$(this).addClass('istrue')
		}
	})

	//判断库存
	$(".u-gift-num").each(function(){
		var count = parseInt($(this).text())
		if(!count){
			$(this).parent('.u-num').addClass('isnull').next('.u-go').addClass('isnull')
		}
	})
	$(".u-go").each(function(){
		if($(this).hasClass('isnull')){
			$(this).on('click',function(e){
				e.preventDefault()
				return
			})
		}
	})
	



});