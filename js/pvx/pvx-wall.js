jQuery(function($){

	//判断所在页面
	var isPost = $(".postpage-container").length
	var isList = $(".listpage-container").length
	var isView = $(".viewpage-container").length

	if(isPost){

		//监听客户端选择
		var checkUA = function(target){
			//获取所点的所在的序列
			var i = $(target).parent('label').parent('.u-checkbox-item').index()
			//获取当前的状态
			var status = $(target).prop('checked')
			//选择该项，则展开对应子选项
			if(status){
				$(".m-wall-uploadsize").children('.c-post-custom-listitem').eq(i).show()
				$(".m-wall-uploadmode-local ul").eq(i).show()
			}else{
			//取消该项，则隐藏对应子选项
				$(".m-wall-uploadsize").children('.c-post-custom-listitem').eq(i).hide()
				$(".m-wall-uploadmode-local ul").eq(i).hide()
			}
		};
		$("#m-wall-ua input").each(function(){
			checkUA(this)
		})
		$("#m-wall-ua input").on('change',function(){
			checkUA(this)
		})

		//监听上传模式
		var checkMODE = function(target){
			//获取当前的状态
			var status = $(target).prop('checked')
			//选择该项，则展开对应子选项
			if(status){
				//获取所点的所在的序列
				var i = $(target).parent('label').parent('.u-radio-item').index()
				if(i==0){
					$(".m-wall-uploadmode-local").show()
					$(".m-wall-uploadmode-sina").hide()
				}else{
					$(".m-wall-uploadmode-sina").show()
					$(".m-wall-uploadmode-local").hide()
				}
			}
		}
		$("#m-wall-mode input").each(function(){
			checkMODE(this)
		})
		$("#m-wall-mode input").on('change',function(){
			checkMODE(this)
		})


	}

})