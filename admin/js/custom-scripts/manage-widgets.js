function sort_tables(){
	$('#pages-menu-widget .list-group, #categories-menu-widget .list-group').sortable();
	
	$('#pages-menu-widget button, #categories-menu-widget button').click(function(){
		var order = new Array();
		var menu = $(this).data('menu');
		var $this_menu_a = $(this).parent().prev().find('a.list-group-item');
		var $img = $(this).next();
		$img.css('display','inline');
		order.push(menu);
		$this_menu_a.each(function(){
			order.push($(this).data('id'));
		});
		
		$.ajax({
			method: 'post',
			url: 'processors/sort-menus.php',
			data: {order:order},
			success: function(r){
				$img.css('display','none');
				alert(r);
			}
		});
	});
}

$(document).ready(function(){
	//Sort Tables
		sort_tables();
});