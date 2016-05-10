jQuery(function($){
	if(!isMobile){

		var isBlank = $("#atarget").hasClass('atarget_1')
		function eachItemTarget(){
			if(isBlank){
				$(".e-sort-item").each(function(){
					$(this).attr('target','_blank')
				})
			}else{
				$(".e-sort-item").each(function(){
					$(this).attr('target','_self')
				})
			}
		}
		eachItemTarget()

		$("#atarget").on('click',function(){
			if(isBlank){
				isBlank = false
				eachItemTarget()
			}else{
				isBlank = true
				eachItemTarget()
			}
		})

		
	}
})