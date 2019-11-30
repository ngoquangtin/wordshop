$(document).ready(function(){

	$('form#update-post input,form#update-post select,form#update-post textarea').change(function(){
		if( ($(this).val() != $(this).data('saved')) || ($(this).text() != $(this).data('saved')) ){
			$(this).addClass('update-fields');

			var disabled = $('#update-post button[type="submit"]').attr('disabled');
			if( disabled =='disabled' ){
				$('#update-post button[type="submit"]').removeAttr('disabled');
			}
		} else {
			if( $(this).hasClass('update-fields') ){
				$(this).removeClass('update-fields');
			}

			if(!$('.update-fields').length){
				$('#update-post button[type="submit"]').attr('disabled','disabled');
			}
		}
	});

	$('form#update-post').submit(function(){
		var fields = [];

		$('.update-fields').each(function(){
			fields.push( $(this).attr('name') );
		});


		$.ajax({
			type:'post',
			data:{fields:fields},
			url:'processors/update-post.php',
			success:function(r){
				alert(r);
			}
		});

		return false;
	});

});