(function($) {


//var stylemap = [{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}];
var stylemap = [{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#171c26"},{"lightness":"28"},{"saturation":"-12"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"color":"#171c26"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#171c26"},{"lightness":"51"}]},{"featureType":"administrative.province","elementType":"labels","stylers":[{"color":"#960000"},{"lightness":"-30"},{"saturation":"-10"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#2e384d"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f4f3eb"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"saturation":"0"},{"color":"#2e384d"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#afc388"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c9c6b7"},{"lightness":"0"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"color":"#cfd6e2"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#cfd6e2"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#007398"},{"lightness":"40"},{"saturation":"-50"}]}];


function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 17,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false,
		styles: stylemap,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.LEFT_CENTER
		}
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);

	// mao offset
	map.panBy(0,-50);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}


function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
		icon: 'http://brasa.mx.s89419.gridserver.com/assets/pin.svg'
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() ) {
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		//show info window automatically
		//infowindow.open( map, marker );

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

	google.maps.event.addListener(map, 'drag', function() {
		infowindow.close();
	});

}


function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 15 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}


// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

		google.maps.event.addListenerOnce(map, 'tilesloaded', function(){
			$('.acf-map').animate({opacity: 1}, 400);
		});

	});



	/*$('#viewmap').click(function() {
		/*$('.acf-map').animate({
			height: 500
		}, 400, function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center);
		});*//*


		var timer;
		timer = setInterval(function(){
			var center = map.getCenter();
			google.maps.event.trigger(map, 'resize');
			map.setCenter(center);
			//google.maps.event.trigger(map.markers[0], 'click');
		}, 100);
		$('.overmap').fadeOut();
		$('.acf-map').animate({
			height: 600
		}, 700, 'easeInOutExpo', function() {
			timerMap = clearInterval(timer);
			google.maps.event.trigger(map.markers[0], 'click');
		});

	});*/



/*
	var timer;
	$('#viewmap').clickToggle(function() {
		
		timer = setInterval(function(){
			var center = map.getCenter();
			google.maps.event.trigger(map, 'resize');
			map.setCenter(center);
		}, 100);

		$('.overmap').fadeOut();

		$('.acf-map').animate({
			height: 600
		}, 700, 'easeInOutExpo', function() {
			timerMap = clearInterval(timer);
			//google.maps.event.trigger(map.markers[0], 'click');
		});

		$(this).text('Ocultar Mapa');

	}, function() {

		timer = setInterval(function(){
			var center = map.getCenter();
			google.maps.event.trigger(map, 'resize');
			map.setCenter(center);
		}, 100);

		$('.overmap').fadeIn();

		$('.acf-map').animate({
			height: 200
		}, 300, 'easeInOutExpo', function() {
			timerMap = clearInterval(timer);
		});

		$(this).text('Mostrar Mapa');
	});
*/




});

})(jQuery);