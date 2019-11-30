$(document).ready(function(){
	single_related_post_slide();
	content_post_pagination();
});

function single_related_post_slide(){
	var $float = $('div.related_post a.float_right');
	var $ul = $('div.related_post ul');
	$float.text('Show');
	$ul.slideUp(0);
	
	$float.click(function(){
		var _text = $(this).text();
		
		if( _text == 'Show' ){
			$float.text('Hide');
			$ul.slideDown(300);
		} else {
			$float.text('Show');
			$ul.slideUp(300);
		}
		return false;
	});
}

function content_post_pagination(){
	$('ul#content-pagination li a').click(function(){
		var page = $(this).data('page');

		$('.content-page').hide(0);
		$('#content-page-'+page).fadeIn(300);

		$('.current-content-page').css('display','none').prev().css('display','block');
		$(this).parent().css('display','none').next().css('display','block');
		return false;
	})
}