$(document).ready(function() {

	$('.history-title').css('display', 'block');

	var $items = $('.history-item');
	var count = ($items.length > 4) ? 4 : $items.length;
	var countDSmall = ($items.length > 3) ? 3 : $items.length;
	var countTablet = ($items.length > 2) ? 2 : $items.length;

	$("#history").owlCarousel({
      items : count, //4 items above 1000px browser width
      itemsDesktop : [1000, count], //4 items between 1000px and 901px
      itemsDesktopSmall : [900,countDSmall], // betweem 900px and 601px
      itemsTablet: [600,countTablet], //2 items between 600 and 0
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  	});

});