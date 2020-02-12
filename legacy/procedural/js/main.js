 $(document).ready( function() {
 	if ($(window).width() < 1366) {
 		$('.container-fluid').addClass('container');
 		$('.container').removeClass('container-fluid');
 	}
 });


 /* Listing Filter */
 jQuery(document).ready(function($) {
 	$('.list-head .filter-Btn').click(function() {
 		$('html,body').addClass('FreezeBody');
 		$('section.pageContent.ListingPage .Filter-column').addClass('ShowFilter');
 	});
 	$('section.pageContent.ListingPage .Filter-column .FilterColumn-Title > .item > .closeFilter,section.pageContent.ListingPage .listing-filter .filter-control > .filter-now').click(function() {
 		$('html,body').removeClass('FreezeBody');
 		$('section.pageContent.ListingPage .Filter-column').removeClass('ShowFilter');
 	});

 });


 /* Nav */
 jQuery(document).ready(function($) {
 	var width = $(window).width();
 	if (width < 991) {
 		$('nav.NavMenu li h3').click(function() {

 			if($(this).hasClass('Active')){
 				$('.nav-dropdown').slideUp();
 				$(this).removeClass('Active');
 				return false;
 			}
 			$('nav.NavMenu li h3').removeClass('Active');
 			$(this).addClass('Active');

 			$('.nav-dropdown').slideUp();
 			$(this).next('.nav-dropdown').slideDown();

 		});
 	}

 	$('.mobileHamburger').click(function() {
 		$('nav.NavMenu, .CloseNav').addClass('Show');
 		$('.overlay').addClass('show');

 	});
 	$('.CloseNav, .overlay').click(function() {
 		$('nav.NavMenu, .CloseNav').removeClass('Show');
 		$('.overlay').removeClass('show');
 	});
 });

 /* Account Nav */
 jQuery(document).ready(function($) {
 	var width = $(window).width();
 	if (width < 991) {
 		$('section.pageContent .accountPanel .panel-head').click(function() {

 			if($(this).hasClass('Active')){
 				$('section.pageContent .accountPanel .panel-content').slideUp();
 				$(this).removeClass('Active');
 				return false;
 			}
 			$('section.pageContent .accountPanel .panel-head').removeClass('Active');
 			$(this).addClass('Active');

 			$('section.pageContent .accountPanel .panel-content').slideUp();
 			$(this).next('section.pageContent .accountPanel .panel-content').slideDown();

 		});
 	}
 });


 /* Footer Accordion */
 $(document).on('ready', function () {
 	var width = $(window).width();
 	if (width < 575) {
 		$('footer .AccordionFooter').on('click', function (event) {

 			if($(this).hasClass('Show')){
 				$(this).removeClass('Show');
 				$('footer .Ac-Content').slideUp();
 				return false;
 			}

 			$('footer .AccordionFooter').removeClass('Show');
 			$(this).addClass('Show')

 			$('footer .Ac-Content').slideUp();
 			$(this).next('ul.Ac-Content').slideDown();
 		});
 	}
 });

 jQuery(document).ready(function($) {
  $('#seo-text-show').click(function() {
    $('#seo-white').toggleClass("areaOpened");
    $('#seo-text-show').toggleClass("Oppa");
  });
});

 jQuery(document).ready(function($) {
  $('#mobileSelectBtn').click(function() {
    $('#mobileSelectBtn').toggleClass('open');
    
    $('.FormElements').slideToggle(500);
  });
});

 /*Review Page */
 jQuery(document).ready(function($) {
 	$('#toSendReview').click(function() {
 		$([document.documentElement, document.body]).animate({
 			scrollTop: $(".RateArea").offset().top
 		}, 1000);
 	});
 });

 /*Stick Head */
 $(window).scroll(function () {
 	var scroll = $(window).scrollTop();
 	if (scroll >= 30) {
 		$("header").addClass("Sticklendin");
 	} else {
    $("header.Stikclendin").fadeOut(100);
    $("header").removeClass("Sticklendin");
  }
});

 

 $(document).ready(function(){

 	/* 1. Visualizing things on Hover - See next part for action on click */
 	$('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
    	if (e < onStar) {
    		$(this).addClass('hover');
    	}
    	else {
    		$(this).removeClass('hover');
    	}
    });
    
  }).on('mouseout', function(){
   $(this).parent().children('li.star').each(function(e){
    $(this).removeClass('hover');
  });
 });


  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
    	$(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
    	$(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
    	msg = "Bize<b> " + ratingValue + "</b> yıldız verdiniz. Teşekkürler !";
    }
    else {
    	msg = "Kendimizi geliştireceğiz..";
    }
    responseMessage(msg);
    
  });


});


 function responseMessage(msg) {
 	$('.success-box').fadeIn(200);  
 	$('.success-box div.text-message').html("<span>" + msg + "</span>");
 }


 /* Owl */
 jQuery(document).ready(function($) {
 	$('.owl-slider').owlCarousel({
 		loop:true,
 		autoplay:false,
 		autoplayTimeout:5000,
 		autoplayHoverPause:true,
 		dots:false,
 		margin:0,
 		nav:true,
 		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
 		responsive:{
 			0:{
 				items:1
 			},
 			600:{
 				items:1
 			},
 			1000:{
 				items:1
 			}
 		}
 	})

  $('.owl-carBrands').owlCarousel({
    loop:true,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    dots:false,
    margin:0,
    nav:false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive:{
      0:{
        items:2
      },
      600:{
        items:4
      },
      1000:{
        items:8
      }
    }
  })

  $('.owl-banner').owlCarousel({
    animateOut: 'fadeOutLeft',
    animateIn: 'fadeInRight',
    smartSpeed:300,
    loop:true,
    margin:0,
    nav:true,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    dots:true,
    autoplay:true,
    autoplayTimeout:8000,
    autoplayHoverPause:true,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:1
      },
      1000:{
        items:1
      }   
    }
  })
  $('.features-owl').owlCarousel({
    margin:0,
    nav:false,
    dots:false,
    responsive:{
      0:{
       items:1
     },
     768: {
       items:3,
     },
     1199:{
       items:5,
     },
     1366:{
       items:5,
     },
   }
 });

  $('.testimonial-owl').owlCarousel({
    margin:20,
    nav:true,
    loop:true,
    dots:false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:1
      },
      1000:{
        items:3
      }  
    }
  });


  /* Onerlen */
  $('.Onerlen-owl').owlCarousel({
    margin:20,
    nav:true,
    loop:true,
    dots:false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:2
      },
      1000:{
        items:4
      }   
    }
  });


  $('.HomeList-owl').owlCarousel({
    margin:20,
    nav:true,
    loop:true,
    dots:false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:1
      },
      1000:{
        items:3
      }   
    }
  });
});


 /* Select2 */
 $(document).ready(function() {
 	$('.plate-select2').select2();
 });



 /* ProductDetail Owl */
 $(document).ready(function() {
 	var sync1 = $("#sync1");
 	var sync2 = $("#sync2");
 	var slidesPerPage = 4;
 	var syncedSecondary = true;

 	sync1.owlCarousel({
 		items : 1,
 		slideSpeed : 2000,
 		nav: true,
 		autoplay: true,
 		dots: false,
 		loop: true,
 		responsiveRefreshRate : 200,
 		navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
 	}).on('changed.owl.carousel', syncPosition);

 	sync2
 	.on('initialized.owl.carousel', function () {
 		sync2.find(".owl-item").eq(0).addClass("current");
 	})
 	.owlCarousel({
 		items : slidesPerPage,
 		dots: false,
 		nav: false,
 		smartSpeed: 200,
 		slideSpeed : 500,
 		slideBy: slidesPerPage,
 		responsiveRefreshRate : 100,
 		margin: 10,
 		responsive : {
 			0 : {
 				items:3,
 			},
 			575 : {
 				items:4,
 			},
 			767 : {
 				items:6,
 			},
 			991 : {
 				items:4,
 			},
 			1100 : {
 				items:4,
 			}
 		}
 	}).on('changed.owl.carousel', syncPosition2);

 	function syncPosition(el) {
 		var count = el.item.count-1;
 		var current = Math.round(el.item.index - (el.item.count/2) - .5);

 		if(current < 0) {
 			current = count;
 		}
 		if(current > count) {
 			current = 0;
 		}

 		sync2
 		.find(".owl-item")
 		.removeClass("current")
 		.eq(current)
 		.addClass("current");
 		var onscreen = sync2.find('.owl-item.active').length - 1;
 		var start = sync2.find('.owl-item.active').first().index();
 		var end = sync2.find('.owl-item.active').last().index();

 		if (current > end) {
 			sync2.data('owl.carousel').to(current, 100, true);
 		}
 		if (current < start) {
 			sync2.data('owl.carousel').to(current - onscreen, 100, true);
 		}
 	}

 	function syncPosition2(el) {
 		if(syncedSecondary) {
 			var number = el.item.index;
 			sync1.data('owl.carousel').to(number, 100, true);
 		}
 	}

 	sync2.on("click", ".owl-item", function(e){
 		e.preventDefault();
 		var number = $(this).index();
 		sync1.data('owl.carousel').to(number, 300, true);
 	});
 });


 /* Mob Menu */
 jQuery(document).ready(function($) {
 	$('#hamburger-icon').click(function() {
 		$('.navbar-collapse').addClass('Show');
 		$('body, html').addClass('freezePage');
 	});
 	$('.Mob-Close').click(function() {
 		$('.navbar-collapse').removeClass('Show');
 		$('body, html').removeClass('freezePage');
 	});
 });





 /* File Upload */
 jQuery(document).ready(function($) {
 	$(document).ready(function() {
 		$('input[type=file]').change(function() {
				//console.log(this.files);
				var f = this.files;
				var el = $(this).parent();
				if (f.length > 1) {
					console.log(this.files, 1);
					el.text('Sorry, multiple files are not allowed');
					return;
				}
				// el.removeClass('focus');
				el.html(f[0].name + '<br>' +
					'<span class="sml">' +
					'type: ' + f[0].type + ', ' +
					Math.round(f[0].size / 1024) + ' KB</span>');
			});

 		$('input[type=file]').on('focus', function() {
 			$(this).parent().addClass('focus');
 		});

 		$('input[type=file]').on('blur', function() {
 			$(this).parent().removeClass('focus');
 		});

 	});
 });


 /* FAQ */
 jQuery(document).ready(function($) {
 	$('.faqItem').click(function() {
 		$('.faq_Answer').slideUp();
 		$('.faqItem').removeClass('Active');
 		$(this).addClass('Active');

 		if ($(this).hasClass('Active')){
 			$('.faq_Answer',this).slideDown();
 		}
 	});
 });




 jQuery(document).ready(function($) {
 	$('.Layout-4').click(function() {
 		$('.Layout-item').removeClass("Active");
 		$(this).addClass("Active");
 		$('div').parents('#list-col').attr('class', 'col-6 col-lg-4 col-xl-3');
 		$('.list-item').addClass('Small');
 	});
 	$('.Layout-Box').click(function() {
 		$('.Layout-item').removeClass("Active");
 		$(this).addClass("Active");
 		$('div').parents('#list-col').attr('class', 'col-12');
 		$('.list-item').removeClass('Small');
 	});
 });


 jQuery(document).ready(function($) {
 	$('#LangSelect').click(function() {
 		$('.LanguageSelectArea').slideToggle(300);
 	});
 	$('#LangSelectm').click(function() {
 		$('.LanguageSelectArea.m').slideToggle(300);
 	});
 });










 jQuery(document).ready(function($) {
 	$(document).on('keyup', '.jquery_filter', function() {
 		console.log($('.jquery_filter').val());
 		var debug = false;
 		var $wrapper = $($(this).attr('data-search-items-wrapper-id'));
 		var $search_item_div = $wrapper.find($(this).attr('data-search-item-class'));
 		if ($.trim($(this).val()) == "") {
 			$search_item_div.removeClass('hidden');
 			$wrapper.find('.not_found_div').remove();
 		} else {
 			var search_tokens = $.trim($(this).val()).split(' ');
 			if (debug) {
 				console.log("Search Tokens : " + search_tokens);
 			}
 			var search_classes = $(this).attr('data-search-classes').split(',');
 			var matching_count = 0;
 			$search_item_div.each(function() {
 				var cur_div = $(this);
 				var div_str = "";
 				$.each(search_classes, function(index, value) {
 					if (debug) {
 						console.log("Search Class = " + value);
 						console.log("Search Class Value = " + cur_div.find(value).text());
 					}
 					div_str += " " + cur_div.find(value).text();
 				});
 				if (debug) {
 					console.log("Div Str : " + div_str);
 				}
 				$.each(search_tokens, function(index, value) {
 					if (value) {
 						var re = new RegExp(value, "i");
 						if (re.test(div_str)) {
 							cur_div.removeClass('hidden');
 							matching_count += 1;
 						} else {
 							cur_div.addClass('hidden');
 						}
 					}
 				});
 				if (debug) {
 					console.log("Matching Count : " + matching_count);
 				}
 				if (matching_count == 0) {
 					if ($wrapper.find('.not_found_div').length > 0) {
 						$wrapper.find('.not_found_div').removeClass("hidden");
 					} else {
 						$wrapper.append("<div class='not_found_div' style='color:#888; text-align:center; font-size:13px;'> Bulunamadi. </div>");
 					}
 				} else {
 					$wrapper.find('.not_found_div').addClass("hidden");
 				}
 			});
 		}
 	});
 });


 /* Max Character */
 jQuery(document).ready(function($) {
 	$(".max-75").text(function(index, currentText) {
 		return currentText.substr(0, 75) + "..";
 	});
 });




 /* quantity */
 function increaseValue() {
 	var value = parseInt(document.getElementById('number').value, 10);
 	value = isNaN(value) ? 0 : value;
 	value++;
 	document.getElementById('number').value = value;
 }

 function decreaseValue() {
 	var value = parseInt(document.getElementById('number').value, 10);
 	value = isNaN(value) ? 0 : value;
 	value < 1 ? value = 1 : '';
 	value--;
 	document.getElementById('number').value = value;
 }



 /* Product Tabs */
 jQuery(document).ready(function($) {
 	$("section.pageContent.product_Detail .product-tabs .tab_content").hide();
 	$("section.pageContent.product_Detail .product-tabs .tab_content:first").show();
 	$("section.pageContent.product_Detail .product-tabs ul.tabs li").click(function() {
 		$("section.pageContent.product_Detail .product-tabs .tab_content").hide();
 		var activeTab = $(this).attr("rel");
 		$("#"+activeTab).fadeIn();
 		$("section.pageContent.product_Detail .product-tabs ul.tabs li").removeClass("active");
 		$(this).addClass("active");
 	});
 });
