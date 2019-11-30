//header.php
$(document).ready(function(){
	//alert('asdsad');
	
	$('#input-email').change(function(){
		var $this = $(this);
		var field = $this.attr('name');
		var $div = $this.parent();
		var $span = '<span class="'+field+'"></span>';
		var email = $this.val();
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		$span.remove();
		$div.after($span);
		
		
		if( !regex.test(email) ){
			$span.text('Email is not valid.');
		} else {
			$span.text('Checking availability ...');
			$.ajax({
				type: 'get',
				data: 'email=' + email,
				url: 'processors/signup.php',
				success: function(r){
					if( r=='YES' ){
						$span.text('Email is available.');
					} else if( r =='NO' ){
						$span.text('Email is already existed.');
					}
				},
				error: function(){
					$span.text('Please try it later.');
				}
			});
		}
			
	});
	
});










