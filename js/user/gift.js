jQuery(function($){
	var TemplateEngine = function(html, options) {
		var re = /<%([^%>]+)?%>/g, reExp = /(^( )?(if|for|else|switch|case|break|{|}))(.*)?/g, code = 'var r=[];\n', cursor = 0;
		var add = function(line, js) {
			js? (code += line.match(reExp) ? line + '\n' : 'r.push(' + line + ');\n') :
				(code += line != '' ? 'r.push("' + line.replace(/"/g, '\\"') + '");\n' : '');
			return add;
		};
		while(match = re.exec(html)) {
			add(html.slice(cursor, match.index))(match[1], true);
			cursor = match.index + match[0].length;
		}
		add(html.substr(cursor, html.length - cursor));
		code += 'return r.join("");';
		return new Function(code.replace(/[\r\t\n]/g, '')).apply(options);
	};

	var addExchangeListener = function(){
		$(".exchange").click(function(){
			var leftGiftNum = ~~$(this).parent().find('.u-gift-num').text();
			if(leftGiftNum < 1){return alert("礼品兑换数量不足,请选择其他礼品!")}
			var id = $(this).data('id');
			$.get("/api/gift/?do=buy&gift_id=" + id)
				.success(function(data){
					data = JSON.parse(data);
					if(data.code == 0){
						alert("兑换成功! 请查看兑换记录.");
						renderGiftExchangeLog();
						renderGiftList()
					}else{
						alert(data.msg)
					}
				})
				.fail(function(){alert("兑换失败! \n Error Code: lt-ajax-buy")})

		})
	};

	//渲染gift列表
	var renderGiftList = function(){
		$.get("/api/gift/?do=list", function(data){
			data = JSON.parse(data);
			if(data.code != 0){
				return alert(data.msg)
			}
			var temp = $("#giftListTempl").html();
			var giftList = data.data;
			var gitfListHtml = [];
			for(var i = 0, len = giftList.length; i < len; i++){
				gitfListHtml.push(TemplateEngine(temp, giftList[i]))
			}
			$("#m-gift-list").html(gitfListHtml.join(""));
			addExchangeListener();
		})
	};
	renderGiftList();
	//格式化渲染列表的数据
	var formatRecordData = function(data){
		var map = {
			'-1': 'isfalse',
			'0': 'ispending',
			'1': 'istrue'
		};
		var statusMap = {
			'-1': '驳回',
			'0': '待审核',
			'1': '成功'
		};
		var obj = {};
		var desc = [];
		for(var key in data.cost){
			desc.push(data.cost[key]+key)
		}

		obj.name = data.name;
		obj.date = data.date;
		obj.clazz = map[''+data.status];
		obj.status = statusMap[''+data.status];
		obj.desc = desc.join(",");
		return obj;
	}

	//渲染兑奖记录
	var renderGiftExchangeLog = function(){
		$.get("/api/gift/?do=history", function(data){
			data = JSON.parse(data);
			if(data.code != 0){
				return alert(data.msg)
			}
			var recordsLit = data.data;
			var gitfRecordHtml = [];
			var temp = $("#giftRecordsTempl").html();
			for(var i = 0, len = recordsLit.length; i < len; i++){
				gitfRecordHtml.push(TemplateEngine(temp, formatRecordData(recordsLit[i])))
			}
			$("#m-gift-record-tbody").html(gitfRecordHtml.join(""))
		})
	};
	renderGiftExchangeLog();

	//tab切换
	$(".baseinfo a").on('click',function(){
		$(".baseinfo a").removeClass('on');
		$(this).addClass('on');
		var index = $(this).index();
		$(".m-gift-block").hide().eq(index).show()
	});

	//判断积分是否足够
	var rq = parseInt($("#u-credit-rq").val()),
		sj = parseInt($("#u-credit-sj").val());

	$(".u-credit-rq").each(function(){
		var need = parseInt($(this).text());
		if(rq < need){
			$(this).addClass('isfalse')
		}else{
			$(this).addClass('istrue')
		}
	});
	$(".u-credit-sj").each(function(){
		var need = parseInt($(this).text());
		if(sj < need){
			$(this).addClass('isfalse')
		}else{
			$(this).addClass('istrue')
		}
	});

	//判断库存
	$(".u-gift-num").each(function(){
		var count = parseInt($(this).text());
		if(!count){
			$(this).parent('.u-num').addClass('isnull').next('.u-go').addClass('isnull')
		}
	});
	$(".u-go").each(function(){
		if($(this).hasClass('isnull')){
			$(this).on('click',function(e){
				e.preventDefault();
				return;
			})
		}
	})
});