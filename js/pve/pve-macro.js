H.ready(['macro'],function(){
  	jQuery(function($){

    		//辅助工具
    		var $toolbox = $('#macro_tools'),
    			toollink = Boolean($toolbox.attr('href'))
    		if(!toollink){
    			$toolbox.attr('href','http://www.jx3pve.com/jx3/tools/keypress/')
    		}


    		//非必填字段为空隐藏
    		$('.role-info').each(function(i,item){
    			if($(this).children('.content').length!=0){
    				var block_l_temp = $(this).children('.content').text(),
    					block_l = $.trim(block_l_temp)
    				if(!block_l){
    					$(this).hide();
    				}
    			}
    		})

      	//侧边栏
  		  //fixSidebar('.pve-sidebar',96,240,223)
      	
      	//帮助
      	H.route(53)

  	})
})