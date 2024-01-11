(function($) {
    "use strict";
	
	/* ..............................................
	   Loader 
	   ................................................. */
	/*$(window).on('load', function() {
		$('.preloader').fadeOut();
		$('#preloader').delay(550).fadeOut('slow');
		$('body').delay(450).css({
			'overflow': 'visible'
		});
	});*/

	/* ..............................................
	   Fixed Menu
	   ................................................. */

	/*$(window).on('scroll', function() {
		if ($(window).scrollTop() > 50) {
			$('.main-header').addClass('fixed-menu');
		} else {
			$('.main-header').removeClass('fixed-menu');
		}
	});*/

	/* ..............................................
	   Carousel iniziale
	   ................................................. */

	$('#slides-shop').superslides({
		inherit_width_from: '.cover-slides',
		inherit_height_from: '.cover-slides',
		play: 5000,
		animation: 'fade',
	});

	$(".cover-slides ul li").append("<div class='overlay-background'></div>");

	/* ..............................................
	   Map Full
	   ................................................. */

	/*$(document).ready(function() {
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		$('#back-to-top').click(function() {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	}); */

	/* ..............................................
	   Categorie prodotti filter
	   ................................................. */

	var Container = $('.container');
	Container.imagesLoaded(function() {
		var portfolio = $('.special-menu');
		portfolio.on('click', 'button', function() {
			$(this).addClass('active').siblings().removeClass('active');
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({
				filter: filterValue
			});
		});
		var portafoglio = $('#inputProdotto');
		portafoglio.on('keyup', function() {
			var text = $(this).val();
			$grid.isotope({
				filter: function(){
					var name = $(this).attr('data-nome');
					var category = $(this).attr('data-categoria');
					var selected = $('.special-menu .active').attr('data-filter').replace(".", "");
					
					return name.includes(text.toLowerCase()) && (selected == "*" || selected == category);
				}
			});
		});
		// var bottone_ordinamento = $('#ordinaPrezzo');
		// bottone_ordinamento.on('click', function() {
		// 	console.log("ciao");
		// 	$grid.isotope({
		// 		sortBy : 'price'
		// 	});
		// });
		var tastoReset = $("#tastoReset");
		tastoReset.on('click',function(){
			$("#tuttiProdotti").addClass("active");
			$("#tastoCosmesi").removeClass("active");
			$("#tastoUsoAlimentare").removeClass("active");
			$("#inputProdotto").val("");
			var text = $("#inputProdotto").val();
			$grid.isotope({
			
				filter:function(){
					var name= $(this).attr('data-nome');
					return name.includes(text.toLowerCase());
				}
			})
		})

		var $grid = $('.special-list').isotope({
			itemSelector: '.special-grid',
			// getSortData: {
			// 	price: '.classe_prezzo parseFloat'
			// }
		});
		
	});

	/* ..............................................
	   BaguetteBox
	   ................................................. */

	/*baguetteBox.run('.tz-gallery', {
		animation: 'fadeIn',
		noScrollbars: true
	});*/

	/* ..............................................
	   Offer Box
	   ................................................. */

	/*$('.offer-box').inewsticker({
		speed: 3000,
		effect: 'fade',
		dir: 'ltr',
		font_size: 13,
		color: '#ffffff',
		font_family: 'Montserrat, sans-serif',
		delay_after: 1000
	});*/

	/* ..............................................
	   Tooltip
	   ................................................. */

	/*$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});*/

	/* ..............................................
	   Owl Carousel Instagram Feed
	   ................................................. */

	

	/* ..............................................
	   Featured Products
	   ................................................. */

	/*$('.featured-products-box').owlCarousel({
		loop: true,
		margin: 15,
		dots: false,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 3,
				nav: true
			},
			1000: {
				items: 4,
				nav: true,
				loop: true
			}
		}
	});*/

	/* ..............................................
	   Scroll
	   ................................................. */

	/*$(document).ready(function() {
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		$('#back-to-top').click(function() {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});*/


	/* ..............................................
	   Slider Range
	   ................................................. */

	/*$(function() {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 4000,
			values: [1000, 3000],
			slide: function(event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
			" - $" + $("#slider-range").slider("values", 1));
	});

*/

	
	
}(jQuery));