/**
 *Function: GET_DATAS_PROCESS
 *1.Show Loading Img
 *2.Post Items Waiting Effect
 *3.Set data To Use AJAX
 *4.AJAX To Get Posts
 *	4a.Display None Post Items
 *	4b.Change Each Posts Content
 *		4b-1.Display Block Each Post Item
 *		4b-2.Change Each Post Info
 *	4c.Change Navigation Menu
 *	4d.Post Items Success Effect
 *	4e.Show Loading Img
 */
function get_datas_process(target,limit,total_page,data,$ul,url,page_style){
	//1.Show Loading Img
		$('img.loading-img').css('display','block');

	//2.Post Items Waiting Effect
		$post_item = $('div.post_item:not(.separate)');
		$post_item.animate({opacity: 0.3}, 400);

	//3.AJAX To Get Posts
		$.ajax({
			type: 'get',
			dataType: 'json',
			data: data,
			url: 'processors/'+url,
			success: function(posts){
			
			//4a.Display None Post Items
				$post_item.css('display', 'none');

			//4b.Change Each Posts Content
				$.each(posts, function(key,post){
				
				//4b-1.Display Block Each Post Item
					$this_item = $post_item.eq(key);
					$this_item.css('display', 'block');
				
				//4b-2.Change Each Post Info
					if(page_style == 'index'){
						change_post_item_index_page($this_item,post);
					} else if(page_style == 'archive') {
						change_post_item_archive_page($this_item,post);
					}

				//4c.Change Navigation Menu
					change_navigation_menu($ul,target,total_page);
					
				//4d.Post Items Success Effect
					$post_item.animate({opacity: 1}, 200);
					
				//4e.Show Loading Img
					$('img.loading-img').css('display','none');
				});

			}
		});
}


function create_the_first_menu($ul,total_page){
	$ul.append('<li class="li-first-page"><a href="#">First Page</a></li>');
	$ul.append('<li class="li-prev-page"><a href="#">Prev</a></li>');
	
	$ul.append('<li class="li-page-1"><a href="#">1</a></li>');
	$ul.append('<li class="current-page">1</li>');
	
	for(i=2;i<=total_page;i++){
		$ul.append('<li class="li-page-'+i+'"><a href="#">'+i+'</a></li>');
		$ul.append('<li>'+i+'</li>');
	}
	
	$ul.append('<li class="li-next-page"><a href="#">Next</a></li>');
	$ul.append('<li class="li-last-page"><a href="#">Last Page</a></li>');
	
	$ul.find('li').css('display','none');
	$('li.current-page').css('display','inline');
	if(total_page>1){$('.li-next-page').css('display','inline');}
	if(total_page>5){$('.li-last-page').css('display','inline');}
	
	for(i=2;i<=5;i++){$ul.find('.li-page-'+i).css('display','inline');}
}

function get_target_page($a_clicked){
	var target=0;
	var li_current_page = Number($('li.current-page').text());
	var li_class_clicked = $a_clicked.parent().attr('class');
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
	return target;
	//alert(typeof target); alert(target);
}

function change_post_item_index_page($this_item,post){
	/* Change Title Part */
	$title = $this_item.find('div.title');
		$title.find('h1 a').text(post['title']).attr('href',post['permalink']);
		$title.find('li.publish a').text(post['display_name']).attr('href',post['author_link']);
		$title.find('li.cat').empty().text('Category: ').append(post['list_categories']);
		$title.find('li.comments a').text(post['comment_num']).attr('href',post['permalink']+'#comment-form');
		$title.find('li.post_time').text(post['day']);
	
	/* Change Content Part */
	$content = $this_item.find('div.content');
	
		$content.find('a.thumbnail').attr('href',post['permalink']).find('img').attr({
			'src':post['thumbnail_url'],
			'alt':post['title']
		});
		
		$content.find('p:not(.edit-post)').text(post['excerpt']);

		if(post['edit_post_link']!=''){//Means User Is_Logged_In(2)
		//Change Url
			$content.find('p.edit-post a').attr('href',post['edit_post_link']);
		}
}

function change_post_item_archive_page($this_item,post){

	//Change Post Content
	$this_item.find('a.thumbnail').attr('href',post['permalink']);
	$this_item.find('a.thumbnail img').attr({
		'src':post['thumbnail_url'],
		'alt':post['title']
	});
	$this_item.find('h1 a').text(post['title']).attr('href',post['permalink']);
	$this_item.find('p:not(.edit-post)').text(post['excerpt']);
	
	if(post['edit_post_link']!=''){//Means User Is_Logged_In(2)
	//Change Url
		$this_item.find('p.edit-post a').attr('href',post['edit_post_link']);
	}
	
	$this_item.find('a.view_more').attr('href',post['permalink']);
}

function change_navigation_menu($ul,target,total_page){
	$ul.find('li').css('display','none');
	
	//Show Current Page and Change Current Page Class
	$('.current-page').removeClass('current-page');
	$ul.find('.li-page-'+target).next().css('display','inline').addClass('current-page');
	
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
}