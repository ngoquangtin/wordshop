$(document).ready(function(){
	
	$('.a-delete-item').click(function(){
		var $a_this = $(this);
		var type = $a_this.data('type');
		
		var ask = confirm("Are you sure want to delete this "+type+" ?");
		if( ask==true ){
			var table = $a_this.data('table');
			var id = $a_this.data('id');
			$.ajax({
				type: 'get',
				data: 'table='+table+'&type='+type+'&id='+id,
				url: 'processors/delete-item-ajax.php',
				success: function(r){
					if(r=='success'){
						alert("You have delete this "+type+" successfully.");
						var time = 300;
						$a_this.parent().parent().parent().slideUp(time);
					} else {
						alert('Some error occur. Sorry for this.');
					}
				},
				error: function(){
					alert('Some error occur. Sorry for this.');
				}
			});
			
			
		}
		
		return false;
	});
	
	
	
});

