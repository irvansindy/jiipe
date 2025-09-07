$(document).ready(function() {
	$('.submit-add-cart').submit(function() {
		var data = $(this).serialize();
		$.ajax({
			url: url_add_cart_action,
			data: data+'&ajax=ajax',
			dataType: 'html',
			type: 'post',
			success: function(msg){
				$.fancybox({
					content		: msg,
	                fitToView   : false,
	                width       : 'autoSize',
	                height      : 'autoSize',
	                autoSize    : false,
	                closeClick  : false,
	                openEffect  : 'none',
	                closeEffect : 'none'
				});
				$( ".cart-shop-label" ).load( baseurl+" #cart-shop-label" );
			},
			error: function(msg){
				alert('sending data error, cek your connection');
				console.log(msg);
			}
		});
		return false;
	});
	$('.cart-edit-item').live('click', function() {
		var qty = prompt("Edit qty","1");
		var id = $(this).attr('data-id');
		if (qty > 0) {
			$.ajax({
				url: url_add_cart_action,
				data: 'id='+id+'&qty='+qty+'&ajax=ajax',
				dataType: 'html',
				type: 'post',
				success: function(msg){
					$( ".cart-shop-label" ).load( baseurl+" #cart-shop-label" );
				},
				error: function(msg){
					alert('sending data error, cek your connection');
					console.log(msg);
				}
			});
		};
		return false;
	})
	$('.cart-delete-item').live('click', function() {
		var qty = 0;
		var id = $(this).attr('data-id');
		$.ajax({
			url: url_add_cart_action,
			data: 'id='+id+'&qty='+qty+'&ajax=ajax',
			dataType: 'html',
			type: 'post',
			success: function(msg){
				$( ".cart-shop-label" ).load( baseurl+" #cart-shop-label" );
			},
			error: function(msg){
				alert('sending data error, cek your connection');
				console.log(msg);
			}
		});
		return false;
	})
	$('.btn-add-compare').live('click', function() {
		$.ajax({
			url: $(this).attr('href'),
			dataType: 'html',
			type: 'get',
			success: function(msg){
				$( ".compare-container" ).load( baseurl+" #compare-flying" );
			},
			error: function(msg){
				alert('sending data error, cek your connection');
				console.log(msg);
			}
		});
		return false;
	})
    $('.product-label-button a').live('click',function() {
        if ($(this).parent().parent().find('.content-text').is( ":hidden" )) {
            $(this).parent().parent().find('.content-text').slideDown();
            $(this).find('i').attr('class', 'glyphicon glyphicon-minus');
        }else{
            $(this).parent().parent().find('.content-text').slideUp();
            $(this).find('i').attr('class', 'glyphicon glyphicon-plus');
        };
        return false;
    })

    $('.menu-select select').change(function(){
    	var tjuan_link = $(this).val();
    	window.location.href=tjuan_link;
    	// return false;
    });

});

// event pada saat link di klik
$('.page-scroll').on('click', function(e){

	//ambil isi href
	var tujuan=$(this).attr('href');
	//tangkap elemen ybs
	var elementujuan = $(tujuan);

	//pindahkan scroll
	$('html,body').animate({
		scrollTop: elementujuan.offset().top - 50
	}, 1225,'Swing');

	e.preventDefault();
	
})



$(document).ready(function(){

	var swidth = $(window).width();
	var sLogo_head = $('header.header .navbar a.navbar-brand img').attr('data-src-res');
	var sLogo_head2 = $('header.header .navbar a.navbar-brand img').attr('data-src-res2');
	if (swidth > 1025){
		var lastScrollTop = 100;
		$(window).scroll(function(event){
		   var st = $(this).scrollTop();
		   if (st > lastScrollTop){
		       $('body').addClass('morph');
		       $('header.header .navbar a.navbar-brand img').attr('src', sLogo_head).css('max-width', '125px');
		   } else {
		      $('body').removeClass('morph');
		      $('header.header .navbar a.navbar-brand img').attr('src', sLogo_head2).css('max-width', 'inherit');
		   }
		   console.log(st);
		});
	}

});