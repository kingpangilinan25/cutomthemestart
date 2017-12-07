/*function fcf_sent() {
	var $ = jQuery;
	$('.free_consult_frm_mid').append('<span class="success_msg" >Thank You for your trust in us, we will contact you within 24 hours</span>');
	var $msg_div = $('.free_consult_frm_mid .success_msg');	
	$msg_div.show(function() {
		$('.wpcf7-response-output').remove();
	}).delay(5000).fadeOut(1500,null,function() {
		$msg_div.remove();
	});
}*/
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function cf_redirect(url) {
	window.location(url);
}
function rawurlencode (str) {
    str = (str+'').toString();        
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A');
}

jQuery(document).ready(function($) {
	/* var $ = jQuery; */
	console.log('js loaded by King Pangilinan');

    
    $('.dropdown-toggle', '#nav').click(function() {
		var anchor_link = $(this);
		var href = $(anchor_link).attr('href');
		$is_open_dp = $(anchor_link).parent().hasClass('open');
		if($is_open_dp)
			window.location.assign(href);
	});
	
	if($('#menu-main_nav').length) {
		set_nav_bs_funct();
	} else {
		console.log('no #menu-main_nav found');
	}
	
	function set_nav_bs_funct() {
		$('#menu-main_nav li').hover(function() {
			if( $('.sub-menu', $(this)).length >= 1 ) {
				var $anchor_link_li = $(this);
				$anchor_link = $anchor_link_li.children('a');
				$anchor_link_li.addClass('open');
				$anchor_link.attr("aria-expanded","true");
				//console.log($anchor_link);
				$('> .sub-menu', $(this)).css({'display':'block'});
			}
		},function() {
			if( $('.sub-menu', $(this)).length >= 1 ) {
				var $anchor_link_li = $(this);
				$anchor_link_li.removeClass('open');
				$anchor_link.attr("aria-expanded","false");
				$('> .sub-menu', $(this)).css({'display':'none'});
			}
		});
	}
	
	$(window).load(function() {
		if($('.masonry-wrap').length >= 1) {
			var $container = $('.masonry-wrap').masonry({
			  // options
			  itemSelector: '.masonry-item-wrap',
				percentPosition: true
			});
			//reload masonry when finish lazy loading
			$container.find("img").on( 'load', function( event ) {
				$container.masonry('reload');
			});
		} else {
			console.log("masonry not working bec. its missing");
		}
	});
	
	/* enable smooth scrolling <a href="#theId" data-smoothscroll="yes"> */
	$("a[href^='#'][data-smoothscroll='yes']").click(function (e){
		var $elem_id = $(this).attr("href");
		if($($elem_id).length >= 1) {
			e.preventDefault();
			
			//console.log($elem_id);
			
			$('html, body').animate({
				scrollTop: $($elem_id).offset().top
			}, 800);
		}
	});
	

    
    var semeSizerElems = [ '.rpc-item figure', '.rpc-item h4', '.border-cont-inner', '.testi-context p']; 
	if($(semeSizerElems).length >= 1) {
		//$('.rpc-item figure, .rpc-item h4');
		var sseImg = '.rpc-item figure'; //fixed bj lazy elems with img inside
		$(window).on("load resize",function(){
			$(semeSizerElems).each(function(i, l) {
				//console.log( "Index #" + i + ": " + l );
				$(l).samesizr({
					mobile:767
				});
			});
		});
		//fixed bj lazy
		$(sseImg).find("img").on( 'load', function( event ) {
			$(sseImg).samesizr({
				mobile:767
			});
		});
		//ver-mid after eq-height
		$(semeSizerElems).each(function(i, l) {
			$(l).wrapInner('<div class="dtable-cell" />').wrapInner('<div class="dtable" />');
		});
	}
	
    
    if($('.lazy[data-lazy-type="iframe"], iframe[src*="youtube.com"], object, embed').length) {
	   $('.lazy[data-lazy-type="iframe"], iframe[src*="youtube.com"], object, embed').wrap('<div class="video_wrap" />');
    }
	
	/*
    $(".lazy[data-lazy-type='iframe']").lazyload({
        load : function(elements_left, settings) {
            //console.log(this, elements_left, settings);
            //$(document).trigger("something");
            console.log("yess");
        }
    });
	*/


/*
	

    if($('.ver-mid').length) {
        $('.ver-mid').wrap('<div class="dtable" />').wrap('<div class="dtable-cell" />');
    }


$( ".hero_area" ).mousemove(function( event ) {
  $('.nivo-prevNav,.nivo-nextNav').css({'opacity':1});
});

$( ".hero_area" ).mouseout(function() {
  $('.nivo-prevNav,.nivo-nextNav').css({'opacity':0});
});

	var $def_text = 'Keyword Search...';
	$('.s').val($def_text).css({'color': '#bababa'});
	$('.s').focus(function() {
		if($(this).val() == $def_text) {
			$(this).val('').css({'color': '#333'});
		}
	});
	$('.s').blur(function() {
		if($(this).val().length < 1) {
			$(this).val($def_text).css({'color': '#bababa'});
		}
	});


	$('#main-nav > li').hover(function() {
	if( $('.sub-menu', $(this)).length >= 1 ) {
	  	$('.sub-menu', $(this)).css({'display':'block'});
	}
	},function() {
	  	$('.sub-menu', $(this)).css({'display':'none'});
	});
	
    $(".jCaruselH").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
		visible: 4,
		auto: 3000,
		speed: 800
    });
  
	var cur_location = window.location;
	$('img:not(.wp-socializer img)').each(function() {
  	var $cur_img = $(this);
	  if($cur_img.width() >= 80 && $cur_img.height() >= 80) {
  	  $cur_img.wrap('<div class="image_wrapper_pin"></div>');
  	  var $img_url = $cur_img.attr('src');
  	  $cur_img.parent().append('<div class="pinBtn"><a href="//www.pinterest.com/pin/create/button/?url='+ cur_location +'&media='+ $img_url +'&description=Epidemic-Marketing%20Design%20Sample" data-pin-do="buttonPin" data-pin-config="none"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></div>');
	  }	  
  	$cur_img.parent().hover(function() {
  	  $('.pinBtn', $(this)).show();  
  	},function() {
  	  $('.pinBtn', $(this)).hide();	  
  	});
  	
	});
  	
	$('.pinBtn a').click(function() {
		window.open(this.href,
		'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=600');return false;
	});
	*/
});

  WebFontConfig = {
    google: { families: [ 'Alfa+Slab+One|Open+Sans:400,400i,600,700,800' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 