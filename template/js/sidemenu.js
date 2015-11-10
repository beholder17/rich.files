$(document).ready(function(){
	check_active();
	function close_all()
	{
		$('.partner_item ul').slideUp(200);
	}
	
	function check_active()
	{
		$('li.partner_item ul li.active').parent().css('display','block');
		if ($('li').is('li.partner_item ul li.active')===true) {	
			$('ul#partners_list').css('display','block');
			$('.rich_world_products_list').css('display','none');
			//alert('sdf');
		}
	}
	
	$('.partner_item').click(function(){
		//$('.partner_item ul:not(this)').slideDown(200);
		
		if ($(this).children().next().css('display') == 'none'){
			$('.partner_item ul').slideUp(200);
			$(this).children().next().slideToggle( 200, function(){});
		} else $(this).children().next().slideUp(200);

		});
	$('#partners').click(function(){
		$(this).next().slideToggle( 200, function() {});
		});
	$('.rich_world_products_btn').click(function(){
		$(this).next().slideToggle( 200, function() {});
		});

	//$('.view-partners-menu a.active').parent().parent().parent().parent().css('display','block');
//alert('done');
     $('.navigation_trigger').click(function(){
		
		$(this).next().slideToggle( 100, function() {});
		//$(this).next().toggle('slide');
	
    
		
		});
		
		$('div.roll_trigger').click(function(){
		console.log(this);
		if ($(this).next().children().css('display') == 'none'){
			$(this).next().children('ul').slideUp( 200, function(){});
		} else {
			$(this).next().children('li').slideToggle( 200, function(){});
		}
		});
		
                                        }
                            ); 
          
		  
		  
			jQuery.expr[":"].contains = function( elem, i, match, array ) {
				return (elem.textContent || elem.innerText || jQuery.text( elem ) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;
			}			
			$('#quick_filter').bind('textchange', function (event, previousText) {
				search_string = $(this).attr('value');
				$count = $("div.side_menu li:contains('"+search_string+"')").length;
				if ($count==0){
					$("div.side_menu li").css('display','none');
					$('#nothing_found').html('Ничего не найдено');
					$('#quick_filter').focusout(function(){
						$('#quick_filter').val('');
						})
				} else {
				$("div.side_menu li").css('display','none');
				$("div.side_menu li:contains('"+search_string+"')").css('display','list-item');
				$('#nothing_found').html('');
				}
				/*$(this).focusout(function(){
					$(this).val('');
					$("div.side_menu li").css('display','list-item');
				});*/
			})
	