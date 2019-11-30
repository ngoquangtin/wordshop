function sidebar_arrow_carrot_fix_type_1(){
	$('li.active a span.menu-arrow').removeClass('arrow_carrot-right').addClass('arrow_carrot-down');

	$('ul.sidebar-menu li.sub-menu > a').click(function(){
		
		$(this).parent().addClass('clicked');
		
		$('li.sub-menu:not(.clicked)').each(function(){	
			$(this).find('span.menu-arrow').removeClass('arrow_carrot-down').addClass('arrow_carrot-right');
			$(this).find('ul.sub').slideUp(200);
		});
		
		$('li.clicked').each(function(){
			
			var $ul = $(this).find('ul.sub');
			var $span = $(this).find('span.menu-arrow');
			$span.removeClass('arrow_carrot-right');
			$span.removeClass('arrow_carrot-down');
			
			if( $ul.is(":visible") ){
				$span.addClass('arrow_carrot-right');
				$ul.slideUp(200);
			} else {
				$span.addClass('arrow_carrot-down');
				$ul.slideDown(200);
			}
		});
		
		$(this).parent().removeClass('clicked');
	});
}

function sidebar_arrow_carrot_fix_type_2(){
	$('li.active a span.menu-arrow').removeClass('arrow_carrot-right').addClass('arrow_carrot-down');
	$('li.sub-menu.active > a').css('cursor', 'default');
	
	$('ul.sidebar-menu li.sub-menu:not(.active) > a').click(function(){
		
		$(this).parent().addClass('clicked');
		
		$('li.sub-menu:not(.active):not(.clicked)').each(function(){
			$(this).find('span.menu-arrow').removeClass('arrow_carrot-down').addClass('arrow_carrot-right');
			$(this).find('ul.sub').slideUp(200);
		});
		
		$('li.clicked').each(function(){
			var $ul = $(this).find('ul.sub');
			var $span = $(this).find('span.menu-arrow');
			
			$span.removeClass('arrow_carrot-right');
			$span.removeClass('arrow_carrot-down');
			
			if( $ul.is(":visible") ){
				$span.addClass('arrow_carrot-right');
				$ul.slideUp(200);
			} else {
				$span.addClass('arrow_carrot-down');
				$ul.slideDown(200);
			}
		});
		
		$(this).parent().removeClass('clicked');
	});
}

function sidebar_arrow_carrot_fix_type_3(){
	$('li.active a span.menu-arrow').removeClass('arrow_carrot-right').addClass('arrow_carrot-down');
	
	$('ul.sidebar-menu li.sub-menu > a').click(function(){
		var $li = $(this).parent();
		var $ul = $li.find('ul.sub');
		var $span = $li.find('span.menu-arrow');
		
		$span.removeClass('arrow_carrot-right').removeClass('arrow_carrot-down');
		
		if( $ul.is(":visible") ){
			$span.addClass('arrow_carrot-right');
			$ul.slideUp(200);
		} else {
			$span.addClass('arrow_carrot-down');
			$ul.slideDown(200);
		}
	});
}

function sidebar_arrow_carrot_fix_type_4(){
	$('li.active a span.menu-arrow').removeClass('arrow_carrot-right').addClass('arrow_carrot-down');
	$('li.sub-menu.active > a').css('cursor', 'default');
	
	$('ul.sidebar-menu li.sub-menu:not(.active) > a').click(function(){
		var $li = $(this).parent();
		var $ul = $li.find('ul.sub');
		var $span = $li.find('span.menu-arrow');
		
		$span.removeClass('arrow_carrot-right').removeClass('arrow_carrot-down');
		
		if( $ul.is(":visible") ){
			$span.addClass('arrow_carrot-right');
			$ul.slideUp(200);
		} else {
			$span.addClass('arrow_carrot-down');
			$ul.slideDown(200);
		}
	});
}

function manage_messages(){
	//If User Click Delete Message, AJAX to Delete It
		$('.delete-message').click(function(){
			//alert('asd');
			var $a=$(this);
			var id = $a.data('id');
			var time=300;
			
			$a.parent().remove();
			
			$.ajax({
				type:'get',
				data:'id='+id,
				url:'processors/delete-messages.php'
			});
			
			return false;
		});

	//If User Click Delete All Messages
		$('.delete-all-messages').click(function(){
		//Remove All Messages List
			$('.delete-message').parent().remove();
			$(this).remove();
			
		//Change Text
			$('p.blue').text('You have 0 new messages');
		
		//Collect All Messages Id in the list on ids
			var ids = new Array();
			$('a.delete-message').each(function(){
				ids.push($(this).data('id'));
			});
			
			alert(ids.length);
		//AJAX to Delete Them All
			$.ajax({
				method: 'post',
				url: 'processors/delete-messages.php',
				data: {ids:ids},
				success: function(r){
					alert(r);
				}
			});
			return false;
		});
		
	//If User Click On View Message, Update DB Seen To 1
		$('a.message-item').click(function(){
			var id=$(this).data('id');
			$(this).removeAttr('style');
		//AJAX To Update Seen
			$.ajax({
				type:'get',
				data:'id='+id,
				url:'processors/update-messages.php'
			});
		});
}

$(document).ready(function(){
	
	//Sidebar Part
		sidebar_arrow_carrot_fix_type_2();

	//Messages Part
		manage_messages();

	//User Login Dropdown
		$('.li-user-login-dropdown>a').click(function(){
			//alert('asd');
			$(this).next().slideToggle(200);
		});	
});