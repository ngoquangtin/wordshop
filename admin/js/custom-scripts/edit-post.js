$(document).ready(function(){

	//Use AJAX To Update Permalink
		$('form#update-slug').submit(function(){

			var post_id = $(this).data('id');
			var slug = $(this).find('input[name="slug"]').val();
			var $img = $(this).find('.loading-img');
			$img.css('display','inline');

			$.ajax({
				type:'get',
				data: 'post_id='+post_id+'&slug='+slug,
				url: 'processors/update-slug.php',
				success:function(r){
					$img.css('display','none');
					alert(r);
					var permalink = $('form#update-slug span.help-block').text();
					$('.p-view-post-link a').attr('href', permalink);
				}
			})

			return false;
		});

	//Use AJAX To Update Categories
		$('form#update-categories').submit(function(){
			var ids = [];

			$(this).find('input:checked').each(function(){
				ids.push($(this).val());
			})

			if(ids.length==0){
				alert('Please choose at least 1 category.');
			} else {
				var data = [];
				var $img = $(this).find('.loading-img');
				$img.css('display','inline');

				data.push($(this).data('id'));
				data.push(ids);

				$.ajax({
					type:'post',
					data: {data:data},
					url:'processors/update-categories.php',
					success:function(r){
						$img.css('display','none');
						alert(r)
					}
				});
			}

			return false;
		});

	//Use AJAX To Delete Post
		$('form#delete-post').submit(function(){
			_confirm = confirm('Are you sure want to delete this post?');
			if(_confirm==false){
				return false;
			}
		});

	//Input Typing Permalink
		$('form#update-slug input[name="slug"]').keyup(function(){
			var _text = $(this).val();
			$(this).next().find('strong').text(_text);
		})

});