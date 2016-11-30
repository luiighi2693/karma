jQuery(document).ready(function() {

	
	/*----------[20] => FOR MOBILE BROWSER----------*/
	$("span#menu-btn").click(function() {
		if(jQuery(this).hasClass('active')) {
			$("body .sidebar-scroll").animate({
				left: "-260px"
			}, 100);
			jQuery(this).removeClass('active');
			$("#home_content, .home_banner, #banner, #content, #footer").animate({
				left: "0px"
			}, 100);
		} else {
			$("body .sidebar-scroll").animate({
				left: "0"
			}, 100);
			jQuery(this).addClass('active');
			
			$("#home_content, .home_banner, #banner, #content, #footer").animate({
				left: "260px"
			}, 100);
		}
		$('.close_smart_app_banner').trigger('click');
	});
	$("#home_content, #banner, .home_banner, #footer, #content").click(function() {
		if($("span#menu-btn").hasClass("active")) $("span#menu-btn").trigger("click");
	});
	$('#navmenu ul li a').click(function(e) {
		if(jQuery(this).closest("li").find("ul").length > 0) {
			e.preventDefault();
			if(jQuery(this).closest("li").find("ul").is(":visible") == false) {
				$('#navmenu ul li ul').hide();
				jQuery(this).addClass("active_nav");
				jQuery(this).parent('li').children('ul').slideDown();
				
			} else {
				jQuery(this).removeClass("active_nav");
				jQuery(this).parent('li').children('ul').slideUp();
			}
		}
	});
	
	$(".core_value_ul li").hover(function() {
		$(".tab_content ul").hide();
		$(".tab_content ul").eq(jQuery(this).index()).show();
	});
	
	$('.cont_ngt_svn').hover(function() {
		$('.cont_ngt_svn').removeClass('active');
	});
	$('.do-not-show-popup').change(function() {
		$.cookie('donotshowpopup', true, { expires: 30 });
	});
	$('.ind_corpo_app .ind_corpo_app_close').click(function() {
		$('.ind_corpo_app').animate({
		bottom : -500
	}, 500);
	});
	/*smart app banner*/
	$('.close_smart_app_banner').click(function() {
		$('.top_ios_banner').remove();
		$('body').removeClass('smart_app_banner');
	});
	/*----------[21] => ppc landingpage----------*/
		var pathname = window.location;
		pathname = pathname.toString();
		if(pathname.indexOf("#") > 0) {
			pathname = pathname.split("#");
			pathname = pathname.reverse();
			pathname = pathname[0];
			var ele_val = $("#"+pathname+"").offset();
			$('html, body').animate({scrollTop: ele_val.top-120}, 800);
		}
		$(".menu a").click(function() {
			if($(this).closest('div.menu').hasClass('tablet') == true) {
				if($(document).width() < 761) {
					$(this).closest('ul').slideUp();
				}
			}
			var ele = $(this).attr("href");
			ele = $(ele).offset();
			$('html, body').animate({scrollTop: ele.top-120}, 800);
			return false;
		});
		
		/*----------uno slider----------*/
		//window.unoSlider = $('#sliderId').unoSlider();
		
		/*----------ppc_mobliement----------*/
		//$('nav#menu').mmenu();
		
});

$(window).load(function() {
	$('.ind_corpo_app').animate({
		bottom : 0
	}, 1000);
});


/*----------[22] => Paralax scrolling----------*/
$(document).ready(function(){
    // Cache the Window object
    $window = $(window);
                
   $('section[data-type="background"]').each(function(){
     var $bgobj = jQuery(this); // assigning the object
                    
      $(window).scroll(function() {
                    
        // Scroll the background at var speed
        // the yPos is a negative value because we're scrolling it UP!                                
        var yPos = -($window.scrollTop() / $bgobj.data('speed'));
        
        // Put together our final background position
        var coords = '50% '+ yPos + 'px';

        // Move the background
        $bgobj.css({ backgroundPosition: coords });
        
}); // window scroll Ends

 });    

});
