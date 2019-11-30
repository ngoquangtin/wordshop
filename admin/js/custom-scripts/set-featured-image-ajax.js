//Set Featured Image Ajax
$(document).ready(function(){	
	
	featured_image_settings_ready();
	featured_image_navigation();
	featured_image_select_image();
	upload_featured_image_ajax();
	change_featured_image_ajax();
	update_featured_image_edit_post();
});

function featured_image_settings_ready(){
	//Automatic Add ID Attribute To Divs list Based On Li Tab data
	for(i=0;i<=1;i++){
		id = $('#ul-tab-set-featured-image').find('li:eq('+i+')').data('tab');
		var $this_div = $('.set-featured-image-box div:eq('+i+')');
		$this_div.attr('id',id);
		if(i==1){
			$this_div.css('display','none');
		}
	}
	$('.set-featured-image-box-wrap').hide(0);
}

function featured_image_navigation(){
	var time = 200;
	/*1. Open Box */ $('.a-open-box').click(function(){$('.set-featured-image-box-wrap').fadeIn(time);return false;});
	/*2. Close Box */ $('.a-close-box').click(function(){$('.set-featured-image-box-wrap').fadeOut(time);return false;});
	/*3. Change Tab*/
	$('#ul-tab-set-featured-image li').click(function(){
		var $li_this = $(this);
		$('.li-tab-active').removeClass('li-tab-active');
		$li_this.addClass('li-tab-active');
		
		var tab = $li_this.data('tab');
		$('.featured-img-tabs-group').fadeOut(0);
		$('#'+tab).fadeIn(time);
	});
}

function featured_image_select_image(){
	//Add img-selected class When Click On a Img
	$('#featured-image-attachment img').click(function(){
		$('.img-selected').removeClass('img-selected');
		$(this).addClass('img-selected');
	});
}

function change_featured_image_ajax(){

	//When User Click On Select Button, Check The Action
	$('button[name="button-select-image"]').click(function(){
		var action = $(this).data('action');

		abs_url = $('.img-selected').attr('src');
		if(action=='add-new-post'){ //If In the Add New Post Page
		// Update Post URL In The Hidden Input Field
			
			$('input[name="post-thumbnail-url"]').val(abs_url);
		}
		
		//Remove The Old Img On The Box If has
			$('#set-featured-img-widget .featured-img').remove();
		//Insert The Selected Img On the Box
			$('.remove-featured-img-button').before('<img class="featured-img" width="170" height="170" src="'+abs_url+'" />');
		//Hide The Featured Img Box
			$('.set-featured-image-box-wrap').hide(0);
		//Show The Remove Featured Img Link 
			$('.remove-featured-img-button').css('display','block');

	});
	
	//When User Click On Remove Featured Img Link, Check The Action
	$('.remove-featured-img-button').click(function(){
		var action = $(this).data('action');
		
		if(action=='add-new-post'){ //If In the Add New Post Page
		//Set Val is Empty In The Hidden Input
			$('input[name="post-thumbnail-url"]').val('');
		}
		//Remove The Selected Img On The Box
			$('#set-featured-img-widget .featured-img').remove();
		//Hide Remove Img Link Because Have No Img To Remove
			$(this).css('display','none');
		
		return false;
	});
	
}

function upload_featured_image_ajax(){
	$('button[name="button-upload-image"]').click(function(){$(this).prev().click();}); //Open Window When Click Upload Button
	$('input[name="upload-featured-image"]').change(function(){
		//If Input Change Means User Open Upload File Window
		//Check its value
		var fakepath = $(this).val();
		if(fakepath!=''){
			//If has value means user select a image to upload
			//Use AJAX To Upload Image
			$('form#upload-image').ajaxForm({
				complete: function(r){
					if(r.responseText!='No'){//If Upload Success
						//Open Tab Attachment
						$('#upload-featured-image').hide(0);
						$('#featured-image-attachment').show(0);
						$('.li-tab-active').removeClass('li-tab-active').next().addClass('li-tab-active');
					
						//Add New Image To Attachment Library
						abs_url = r.responseText;
						$('#featured-image-attachment').prepend('<img width="100" height="100" src="'+abs_url+'" />');
					}
				}
			}).submit();
		}
	});
}

function update_featured_image_edit_post(){
	//Only In Edit Post Page, When Click Update Img, Use AJAX to UPDATE
	$('button[name="update-featured-image"]').click(function(){
		var $img = $(this).next();
		$img.css('display','inline');
		post_id = $(this).data('id'); //Take POST_ID in the data-id Of This Button
		abs_path = $('#set-featured-img-widget .featured-img').attr('src'); // Take The Img URL To Update
		if(typeof(abs_path)=='undefined'){
			//If is undefined means update Image To NULL
			abs_path = 'null';
		}
		
		//Use AJAX To Update Img
		$.ajax({
			type: 'get',
			data: 'post_id='+post_id+'&abs_path='+abs_path,
			url: 'processors/update-featured-image.php',
			success: function(r){
				$img.css('display','none');
				if(r=='yes'){alert('Updated.');} else {alert('Error Occur.');}
			}
		});
	});
}



