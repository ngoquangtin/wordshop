$(document).ready(function(){
	dropdown_category_menu();
	dropdown_list_items_store_in_category_menu();
	active_tab_sidebar_navigation();
	view_more_posts_sidebar_navigation();
	tooltip_link_sidebar_navigation();
	
	post_scroller_sidebar();
});

function post_scroller_sidebar(){
	$div = $('.ul-post-newbie').find('div');
	
	setInterval(function (){
	
		$div.find('li:eq(0)').slideUp(1000, function(){
			var $li = $(this);
			var url = $li.find('>a').attr('href');
			var img_src = $li.find('img').attr('src');
			var img_alt = $li.find('img').attr('alt');
			var title = $li.find('h4 a').text();
			var author_url = $li.find('p a').attr('href');
			var author = $li.find('p a').text();
			
			$li.remove();
			$div.append('<li><a href="'+url+'"><img src="'+img_src+'" alt="'+img_alt+'" /></a><h4><a href="'+url+'">'+title+'</a></h4><p>Post by <a href="'+author_url+'">'+author+'</a> 07/09/2013</p></li>');

		});
		
	}, 4500);
}

function dropdown_category_menu(){
	var time = 300;
	$('#ul-category-menu li').hover(
		function(){$(this).find('>ul').slideDown(time)},
		function(){$(this).find('>ul').slideUp(time)}
	);
}

function dropdown_list_items_store_in_category_menu(){
	$('.div-store-in-menu').hover(
		function(){$('.ul-list-items-store').fadeIn(200);},
		function(){$('.ul-list-items-store').fadeOut(200);}
	);
}

function active_tab_sidebar_navigation(){
	var div_count = $('.ul-tab-buttons li').length;
	var a_tab_button_class = 'a-tab-button';
	var a_active_tab_button_class = 'a-active-tab-button';

	for( i=0; i<=div_count;i++ ){	
		var tab = $('.ul-tab-buttons li:eq('+i+') a').data('tab');
		var $a = $('.ul-tab-buttons li:eq('+i+') a');
		var $divs = $('.div-lists-group:eq('+i+')');
		
		$a.text(tab).addClass(a_tab_button_class);
		$divs.attr('id', tab);
		
		if( i==0 ){$a.addClass(a_active_tab_button_class);}
		if( i!=0 ){$divs.fadeOut(0);}
	}

	$('.'+a_tab_button_class).click(function(){
		$('.'+a_active_tab_button_class).removeClass(a_active_tab_button_class);
		$(this).addClass(a_active_tab_button_class);
		
		$('.div-lists-group').hide(0);
		var id = $(this).data('tab');
		// alert(id);
		$('#'+id).fadeIn(300);
		return false;
	});
	

}

function view_more_posts_sidebar_navigation(){
	$('#li-view-more-posts a').click(function(){
		var $a = $(this);
		var $ul = $a.parent().parent();
		var $div = $ul.parent();
		var time = 300;
		var $li = $ul.find('li[id!="li-view-more-posts"]');
		
		$a.text('Loading ...');
		$ul.slideUp(time);
		//$li.css('opacity', '0.5');
		//$li.animate({opacity: 0.5}, 300, 'easing', function(){});
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: 'processors/view-more-posts-tab-sidebar.php',
			success: function( li_output_return ){
				var i=0;
				$.each(li_output_return, function (key, post){
					//alert( item['url'] );
					var $a_current = $ul.find('li:eq('+i+') a');
					var $span_current = $ul.find('li:eq('+i+') .span-tooltips-group');
					
					$a_current.text(post['title']).attr('href', post['url']);
					$span_current.text(post['excerpt']);
					i++;
				});
	
				$a.text('Click me to view other posts');
				$ul.slideDown(time);
				//$li.css('opacity', '1');
			},
			error: function(){}
		});
		
		return false;
	});
}

function tooltip_link_sidebar_navigation(){

	$(".div-lists-group li:not(#li-view-more-posts)").mousemove(
		function(event) {
			var x = event.pageX;
			var y = event.pageY;
			//alert(x + ' '+y);
			var $span = $(this).find('span');
			var height = $span.height();
			//alert($span.height());
			$span.css({'top': (y-10-height)+'px','left': (x+10)+'px'});
			$span.fadeIn(300);
			
		}
	);
	
	$(".div-lists-group li").mouseleave(
		function(){
			//$('.span-tooltips-group').css('display', 'none');
			$('.span-tooltips-group').fadeOut(300);
		}
	);
}









