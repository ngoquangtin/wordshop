$(document).ready(function(){

//Post A New Comment Without Reply To Anyone
	$('form#comment-form').submit(function(){
		var $this_form = $(this);
		var user_id = $(this).find('.user-id').val();
		var display_name = $(this).find('.display-name').val();
		var avatar_url = $(this).find('.avatar_url').val();
		var post_id = $(this).find('.post-id').val();
		var content = $(this).find('textarea').val();
		
	//Show Loading Img
		$this_form.find('.loading-img').css('display','block');
		
		$.ajax({
			type: 'get',
			dataType: 'json',
			data: 'user_id='+user_id+'&post_id='+post_id+'&content='+content,
			url: 'processors/post-comment.php',
			success: function(comment){
				$html='';
				$html = $html+'<div id="div-comment-'+comment['comment_id']+'" class="comments-depth-1-group radius_shadow" style="background:brown;">';
					$html = $html+'<div class="comment-content">';
					$html = $html+'<h3>'+display_name+' - ID '+comment['comment_id']+'</h3>';
					$html = $html+'<img width="100" height="100" src="'+avatar_url+'" alt="'+display_name+'" />';
					$html = $html+'<p>'+comment['content']+'</p>';
					$html = $html+'</div>';
				$html = $html+'</div>';
				$('.comment-form-section').after($html);
			//Hide Loading Img
				$this_form.find('.loading-img').css('display','none');
			}
		});
		
		return false;
	});

//Show Reply Comment Form
	$('button.show-reply-form').click(function(){
		var $form = $(this).next();
		var time = 300;
	//If This Form is Visible Mean User Click To Slide Up This Form
		if($form.is(":visible")){
			$form.slideUp(time);
		} else {//If User Click On Another Form, Slide Up All Reply Forms and Slide Down This Form Again
			$('.reply-form').slideUp(time);
			$form.slideDown(time);
		}
	});

//Post A New Comment Reply To Another Comment
	$('form.reply-form').submit(function(){
		var $this_form = $(this);
		var author_user_id = $(this).find('.author_user_id').val();
		var user_id = $(this).find('.user_id').val();
		var display_name = $(this).find('.display_name').val();
		var avatar_url = $(this).find('.avatar_url').val();
		var post_id = $(this).find('.post_id').val();
		var content = $(this).find('textarea').val();
		var comment_replied_id = $(this).find('.comment_replied_id').val();
		
	//Show Loading Img
		$this_form.find('.loading-img').css('display','block');
		
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: 'processors/post-comment.php',
			data: 'author_user_id='+author_user_id+'&user_id='+user_id+'&post_id='+post_id+'&content='+content+'&comment_replied_id='+comment_replied_id,
			success: function(comment){
				$html = '';
				$html = $html + '<div id="div-comment-'+comment['comment_id']+'" class="comments-depth-2-group" style="background:brown;">';
					$html = $html + '<div class="comment-content">';
						$html = $html + '<h3>'+display_name+' - ID '+comment['comment_id']+'</h3>';
						$html = $html + '<img width="100" height="100" src="'+avatar_url+'" alt="'+display_name+'" />';
						$html = $html + '<p>'+comment['content']+'</p>';
					$html = $html + '</div>';
				$html = $html + '</div>';
				
				$this_form.parent().find('.comment-content:eq(0)').after($html);
			
			//Hide Loading Img
				$this_form.find('.loading-img').css('display','none');
			}
		});
		return false;
	});

//Delete Comment
	$('.delete-comment').click(function(){
		var _confirm=confirm('Are you sure ?');
		if(_confirm==true){
			var $a = $(this);
			var $item = $a.parent().parent();
			var comment_id = $(this).data('id');
			var depth = $(this).data('depth');
			
		//CSS Effect
			$item.animate({opacity: 0.3}, 400);
			$.ajax({
				type:'get',
				url: 'processors/delete-comment.php',
				data:'comment_id='+comment_id+'&depth='+depth,
				success:function(r){
					if(r=='y'){
						$item.slideUp(300,function(){
							$(this).remove();
						});
					}
				}
			});
		}
		return false;
	});

});




