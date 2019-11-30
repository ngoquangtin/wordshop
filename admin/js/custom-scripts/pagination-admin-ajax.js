function create_the_first_menu(total_page,current_style){
//Create UL DOM & Save It on A Var
	$('.text-center').append('<ul class="pagination"></ul>');
	var $ul = $('ul.pagination');

//Create First Page & Previous Page Links
	$ul.append('<li class="li-first-page"><a href="#">First Page</a></li>');
	$ul.append('<li class="li-prev-page"><a href="#">«</a></li>');

//Create Two Page 1 Links, One is the Link & one is The Current Page
	$ul.append('<li class="li-page-1"><a href="#">1</a></li>');
	$ul.append('<li class="current-page">1</li>');
	$('.current-page').attr('style',current_style);

//Use For Loop To Create The Other Links Page (Page 2 - Last Page)
	for(i=2;i<=total_page;i++){
		$ul.append('<li class="li-page-'+i+'"><a href="#">'+i+'</a></li>');
		$ul.append('<li>'+i+'</li>');
	}
	
//Create Next Page & Last Page Links
	$ul.append('<li class="li-next-page"><a href="#">»</a></li>');
	$ul.append('<li class="li-last-page"><a href="#">Last Page</a></li>');
	
//Hide All of The LINKS then Show The Current Page
	$ul.find('li').css('display','none');
	$('li.current-page').css('display','inline');
	
//If Total_page>1, Show The Next Page Link
	if(total_page>1){
		$('.li-next-page').css('display','inline');
	}

//If Total_page>5, Show The Last Page Link
	if(total_page>5){
		$('.li-last-page').css('display','inline');
	}
	
//Show Other LINKS (not CURRENT) FROM PAGE 2-5, We Want to Show Maximum is 5 Number Links
	for(i=2;i<=5;i++){
		$ul.find('.li-page-'+i).css('display','inline');
	}
}

function handling_the_menu(total_page,current_style){
	
	var limit = Number($('input.limit').val());
	var id_field = $('input.id_field').val();
	var table = $('input.table').val();
	
	$('ul.pagination li a').click(function(){
		$ul = $('ul.pagination');
	//Set Some Vars
		var target=0;
		var li_current_page = Number($('li.current-page').text());
		var $a_clicked = $(this);
		var li_class_clicked = $a_clicked.parent().attr('class');
		
	//Target Is The Page User Want To Show, Identify Target Based On The Clicked Link.
		if(li_class_clicked=='li-next-page'){
			target=li_current_page+1;
		} else if(li_class_clicked=='li-last-page'){
			target=total_page;
		} else if(li_class_clicked=='li-first-page'){
			target=1;
		} else if(li_class_clicked=='li-prev-page'){
			target=li_current_page-1;
		} else {
			target=Number($a_clicked.parent().text());
		}
		//alert(typeof target); alert(target);
		
	//Add Opacity Effect To Increase UI
		$('tr:not(:first-child)').animate({opacity: 0.3}, 400);
	//Add Loading Img
		$('.loading-img').css('display','block');
	
	//Use AJAX To Get Data
		$.ajax({
			type: 'get',
			dataType: 'json',
			data: 'target='+target+'&limit='+limit+'&id_field='+id_field+'&table='+table,
			url: 'processors/pagination-admin.php',
			success: function(items){
				/* Items Hide CSS*/
				$('tr:not(:first-child)').css('display', 'none');
				
				/**
				  * Change Table Content Part
				  */
				$.each(items, function(key,item){
					$tr = $('tr:eq('+(key+1)+')');
					
				/* Table Show CSS*/
					$tr.css('display', 'table-row');
					
				// Change Content Based On Taxonomy
					if(id_field=='post_id'){
						$tr.find('td:eq(0)').text(item['title']);
						$tr.find('td:eq(1)').text(item['content']);
						$tr.find('td:eq(2) img').attr({
							'src':item['thumbnail_url'],
							'alt':item['title']
						});
						$tr.find('td:eq(3) a.btn-primary').attr('href','edit_post.php?post_id='+item['post_id']);
						$tr.find('td:eq(3) a.btn-danger').attr('data-id',item['post_id']);
					} else if(id_field=='page_id'){
						$tr.find('td:eq(0)').text(item['title']);
						$tr.find('td:eq(1)').text(item['excerpt']);
						$tr.find('td:eq(2)').text(item['date']);
						$tr.find('td:eq(3) a.btn-primary').attr('href','edit_page.php?page_id='+item['page_id']);
						$tr.find('td:eq(3) a.btn-danger').attr('data-id',item['page_id']);
					} else if(id_field=='category_id'){
						$tr.find('td:eq(0)').text(item['category_name']);
						$tr.find('td:eq(1)').text(item['total_post']);
						$tr.find('td:eq(2) a.btn-primary').attr('href','edit_category.php?category_id='+item['category_id']);
						$tr.find('td:eq(2) a.btn-danger').attr('data-id',item['category_id']);
					} else if(id_field=='user_id'){
						$tr.find('td:eq(0)').text(item['account']);
						$tr.find('td:eq(1)').text(item['display_name']);
						$tr.find('td:eq(2)').text(item['email']);
						$tr.find('td:eq(3)').text(item['role']);
						$tr.find('td:eq(4)').text(item['registration_time']);
						$tr.find('td:eq(5) a.btn-primary').attr('href','edit_user.php?user_id='+item['user_id']);
						$tr.find('td:eq(5) a.btn-danger').attr('data-id',item['user_id']);
					}
				});
				
				
				/**
				  * Change Navigation Part
				  */
					$ul.find('li').css('display','none');
					
					//Show Current Page and Change Current Page Class
					$('.current-page').removeClass('current-page');
					$ul.find('.li-page-'+target).next().attr('style',current_style).addClass('current-page');
					
					//Show Other Links Based On Target Page
					
					//Show First Page Link
					if(target>3 && total_page>5){$('.li-first-page').css('display','inline');}
					
					//Show Prev Page Link
					if(target>1){$('.li-prev-page').css('display','inline');}
					
					//Show List Num Page In Between
					if(target>=3 && target<=total_page-2){for(i=target-2;i<=target+2;i++){if(i!=target){$('.li-page-'+i).css('display','inline');}}}
					
					if(target<=2){for(i=1;i<=5;i++){if(i!=target){$('.li-page-'+i).css('display','inline');}}}
					
					if(target>=total_page-1){for(i=total_page-4;i<=total_page;i++){if(i!=target){$('.li-page-'+i).css('display','inline');}}}
					
					//Show Last Page Link
					if(target<(total_page-2) && total_page>5){$('.li-last-page').css('display','inline');}
					
					//Show Next Page Link
					if(target<total_page){$('.li-next-page').css('display','inline');}
					
					$('tr').animate({opacity: 1}, 200);
					$('.loading-img').css('display','none');
				},
			error: function(){}
		});
		return false;
	});
	
}

$(document).ready(function(){

	var total_page = Number($('input.total-page').val());
	var current_style = $('input.current-page-style').val();

//Part 1 - Create The First Menu When The Page Is Load	
	create_the_first_menu(total_page,current_style);

//Part 2 - Handling The Menu When User Click On A Link
	handling_the_menu(total_page,current_style);
});
