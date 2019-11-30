$(document).ready(function(){
	
	$('.a-delete-item').click(function(){
		var _confirm = confirm("Are you sure want to delete this category ?");
		if( _confirm == true ){
			var $a = $(this);
			var id = $(this).data('id');

			$.ajax({
				type:'get',
				data: 'id='+id,
				url: 'processors/delete-category.php',
				success: function(r){
					if(r=='y'){
						$a.parent().parent().parent().slideUp(300, function(){
							$(this).remove();
						})
					} else {
						alert('Some Problem Occurs');
					}
				}
			});
		}

		return false;
	});
	
	
	
});

