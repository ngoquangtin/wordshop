$(document).ready(function(){
	
	$('form').ajaxForm({
		complete: function(r){
			//alert(r);
		}
	});

	$('.a-set').click(function(){
		$('body').css('background', '#333');
		//$('div:not(p)')
		
		$('div.popup').css('opacity', '1');
		$('div.popup').css('background', '#fff');
		$('div.popup').fadeIn(300);
		
		return false;
	});	
	
	$('.a-close').click(function(){
		$('body').css('background', '#fff');

		$('div.popup').fadeOut(300);
		return false;
	});
	
	$('img').click(function(){
		$('div.uploaded img').remove();
		$('.hidden').val();
		if($(this).hasClass('select')){
			$(this).removeClass('select');
		} else {
			var name = $(this).data('name');
			var url = $(this).attr('src');
			$('.select').removeClass('select');
			$(this).addClass('select');
			$('div.uploaded').prepend('<img src="'+url+'" />');
			$('.hidden[name="name"]').val(name);
			$('.hidden[name="url"]').val(url);
		}

	});







	
});








