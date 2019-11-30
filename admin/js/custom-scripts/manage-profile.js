function set_avatar_settings_ready(){
	//Automatic Add ID Attribute To Divs list Based On Li Tab data
		for(i=0;i<=1;i++){
			id = $('#tabs-menu li:eq('+i+')').data('tab');
			var $this_div = $('.set-avatar-box div:eq('+i+')');
			$this_div.attr('id',id);
			if(i==1){
				$this_div.css('display','none');
			}
		}
		$('.set-avatar-box-wrap').hide(0);
}

function set_avatar_navigation(){
	var time = 200;
	/*1. Open Box */ $('img#open-avatar-box').click(function(){$('.set-avatar-box-wrap').fadeIn(time);return false;});
	/*2. Close Box */ $('.a-close-box').click(function(){$('.set-avatar-box-wrap').fadeOut(time);return false;});
	/*3. Change Tab*/
	$('#tabs-menu li').click(function(){
		var $li_this = $(this);
		$('.li-tab-active').removeClass('li-tab-active');
		$li_this.addClass('li-tab-active');
		
		var tab = $li_this.data('tab');
		$('.set-avatar-tabs').fadeOut(0);
		$('#'+tab).fadeIn(time);
	});
}

function set_avatar_select_img(){
	//Add img-selected class When Click On a Img
	$('.set-avatar-tabs:eq(1) img').click(function(){
		$('.img-selected').removeClass('img-selected');
		$(this).addClass('img-selected');
	});
}

function upload_img(){
	$('button[name="button-upload-image"]').click(function(){$(this).prev().click();}); //Open Window When Click Upload Button
	$('input[name="upload-featured-image"]').change(function(){
		//If Input Change Means User Open Upload File Window
		//Check its value
		var fakepath = $(this).val();
		if(fakepath!=''){
		//If has value means user select a image to upload
			
		//Open Tab Attachment
			$('#upload-featured-image').hide(0);
			$('#featured-image-attachment').show(0);
			$('.li-tab-active').removeClass('li-tab-active').next().addClass('li-tab-active');
		//Show Loading Img
			$('img.loading').css('display','block');
			
		//Use AJAX To Upload Image
			$('form#upload-image').ajaxForm({
				complete: function(r){
					if(r.responseText!='No'){//If Upload Success				
					//Add New Image To Attachment Library
						abs_url = r.responseText;
						$('#featured-image-attachment').prepend('<img width="100" height="100" src="'+abs_url+'" />');
					//Hide Loading Img
						$('img.loading').css('display','none');
					}
				}
			}).submit();
		}
	});
}

function update_img(){
	$('button[name="button-select-image"]').click(function(){
		//Set Some Vars
			abs_path = $('.img-selected').attr('src');
			user_id = $(this).data('id');
		
		//Show The Loading Image
			var $loading = $('.loading-img');
			$loading.css('display','block');
			
		//When User Click On Select Button, Update User Avatar
			$.ajax({
				type: 'get',
				data: 'abs_path='+abs_path+'&user_id='+user_id,
				url: 'processors/update-avatar.php',
				success: function(r){
					if(r=='y'){
						$('.img-avatar').attr('src',abs_path);
						$loading.css('display','none');
						$('.set-avatar-box-wrap').fadeOut(300);
					}
				}
			});
	});
}

function display_name_typing(){
	var fn = $('#input-first-name').val();
	var ln = $('#input-last-name').val();
	var $selected_option = $('option[selected="selected"]');
	var dn = $selected_option.val();
	
	if( fn+' '+ln == dn ){
		var order = 'asc'; //first + last
	} else {
		var order = 'desc'; //last + first
	}
	
	$('#input-first-name, #input-last-name').addClass('input-name-group');
	$('.input-name-group').keyup(function(){
		if( $(this).attr('name') == 'first_name' ){
			fn = $(this).val();
			ln = $('#input-last-name').val();
		} else {
			fn = $('#input-first-name').val();
			ln = $(this).val();
		}

		var asc = fn +' '+ ln;
		var desc = ln +' '+ fn;
		
		if( order == 'asc' ){
			$('option').val(desc).text(desc);
			$selected_option.val(asc).text(asc);
			$('span.username').text(asc);
			$('title').text(asc+ ' - Profile');
		} else {
			$('option').val(asc).text(asc);
			$selected_option.val(desc).text(desc);
			$('span.username').text(desc);
			$('title').text(desc+ ' - Profile');
		}
		
	});
}

function bio_typing(){
	$('#textarea-user-bio').keyup(function(){
		_text = $(this).val();
		$('#p-user-bio').text(_text);	
	});
}

function change_password_profile(){
	//If User Click Change Password Button
		$('button#show-hide-input-password').click(function(){
			//Show Input Field, Show-Hide & Cancel Button
				$('#password-field,#show-hide-password,#cancel-change-password').css('display','block');
			//Hide This Button
				$(this).css('display','none');
		});
	
	//If User Click Cancel Change Password Button
		$('button#cancel-change-password').click(function(){
			//Hide Input Field, Show-Hide & Cancel Button
				$('#password-field,#show-hide-password,#cancel-change-password').css('display','none');
			//Empty The Value Of Password Field
				$('#password-field').val('');
			//Show Change Password Button
				$('button#show-hide-input-password').css('display','block');
		});
	
	
	$('button#show-hide-password').click(function(){
		if($(this).text()=='Show'){
			_text = 'Hide'; type='text';
		} else {
			_text = 'Show'; type='password';
		}
		
		$(this).text(_text).prev().attr('type',type);
	});
}

$(document).ready(function(){
	//Typing Part
		display_name_typing();
		bio_typing();

	//Set Avatar Part
		set_avatar_settings_ready();
		set_avatar_navigation();
		set_avatar_select_img();
		upload_img();
		update_img();

	//Change Password Part
		change_password_profile();
});