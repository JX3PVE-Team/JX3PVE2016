jQuery(function($){

	var $w = $(window),
		$score_t = $("#m-raid-rate-trigger"),
		$score = $("#raid-usergroup")
		/*$score_btn = $("#ak_rate")*/

	//滚动至评分
		$score_t.on('click',function(e){
			e.preventDefault()
			var score_pos = $score.offset().top
			$w.scrollTop(score_pos - 50)
		})
		/*$score_t.one('click',function(e){
			setTimeout(function(){
				$score_btn.addClass('focusthis')
			},300)
		})*/

})
