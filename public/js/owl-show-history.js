$(document).ready(function() {

	var $items = $('.history-item');
	var count = ($items.length > 4) ? 4 : $items.length;

	$("#history").owlCarousel({
      items : count, //4 items above 1000px browser width
      itemsDesktop : [1000,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  	});

});