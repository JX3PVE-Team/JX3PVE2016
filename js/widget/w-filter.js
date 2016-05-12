jQuery(function($){

	//test
	/*if($("#e-fwq").length){
		$("#e-fwq").parent('.value').show()
	}*/

	var $fwq = $("#e-fwq")
	if($fwq.length){

		var daqu = '<span class="e-fwq-filter">
		<span><a href="javascript:void(0)">电信一区</a></span>
		<span><a href="javascript:void(0)">电信二区</a></span>
		<span><a href="javascript:void(0)">电信三区</a></span>
		<span><a href="javascript:void(0)">电信四区</a></span>
		<span><a href="javascript:void(0)">电信五区</a></span>
		<span><a href="javascript:void(0)">电信六区</a></span>
		<span><a href="javascript:void(0)">电信七区</a></span>
		<span><a href="javascript:void(0)">电信八区</a></span>
		<span><a href="javascript:void(0)">网通一二区</a></span>
		<span><a href="javascript:void(0)">网通三区</a></span>
		<span><a href="javascript:void(0)">海外服</a></span>
		</span>';

	    $fwq.children('li').hide()
	    $fwq.prepend(daqu)
	    $fwq.find('span').on('click',function(e){
	        e.stopPropagation()
	        $fwq.find('span').removeClass('on')
	        $(this).addClass('on')
	        var which = $(this).text()
	        var which = '#e-fwq li:contains("' + which + '")'
	        $fwq.children('hr').show()
	        $fwq.children('li').hide()
	        $(which).show()
	    })



	}
	
})
