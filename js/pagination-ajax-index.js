$(document).ready(function(){

	//Set Some Vars
		var limit = Number($('.input-hidden-limit').val());
		var total_page = Number($('.input-hidden-total-page').val());

		$('#content').append('<ul id="paginate" class="radius_shadow"></ul>');
		var $ul = $('ul#paginate');

	//Create HTML
		create_the_first_menu($ul,total_page);

	//If User Click On Menu
		$ul.find('li a').click(function(){
			//Get Target Page
				target = get_target_page($(this));

			//Set data To Use AJAX
				data = 'target='+target+'&limit='+limit;
				url = 'pagination-index.php';
				page_style = 'index';
				get_datas_process(target,limit,total_page,data,$ul,url,page_style);

			return false;
		});
})