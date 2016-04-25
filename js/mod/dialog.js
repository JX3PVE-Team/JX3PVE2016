jQuery(function($){

	//操作对话框
	//---------------------------------

	//1.显示
	function showDialog(){
		$('#u-mask,#w-dialog').show()
	}

	function loadDialog(type,ele){
		//显示对话框
		$('#u-mask,#w-dialog').show()
		$(".w-dialog-content").hide()
		//字符串
		if(type == 'string'){
			$("#w-dialog-content-default").show().html(ele)
		//选择器追加
		}else if(type == 'selector'){
			var append_ele = $(ele)
			$('#w-dialog-content-other').show().append(append_ele);
		//下载
		}else if(type == 'download'){
			$("#w-dialog-content-vip").show()
		}
	}

	window.loadDialog = loadDialog;

	//2.隐藏
	function hideDialog(){
		$('#u-mask,#w-dialog').hide()
	}

	$('#w-dialog-close').on('click', function() {
		hideDialog()
	})
	
})
