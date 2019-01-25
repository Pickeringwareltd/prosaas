$(function(){

	mapboxgl.accessToken = 'pk.eyJ1IjoiamFja3BpY2tlcmluZyIsImEiOiJjanFxZzExamwwYjJ6NDJuMmV4bHFxY2ZoIn0.JF0uWDZRviXZ6kkM_9jCfQ';

	loopMaps();

});

function loopMaps(){
	$('.new_map').each(function() {

		var name = $(this).attr('data-name');
		var long = $(this).attr('data-long');
		var lat = $(this).attr('data-lat');

		loadMap(name, long, lat);

	});	
}

function loadMap(this_map, long, lat){
	var map = new mapboxgl.Map({
	    container: this_map,
	    style: 'mapbox://styles/mapbox/streets-v9',
	    center: [long, lat],
	    zoom: 12
	});

	map.on('load', function () {
	    map.loadImage('http://localhost:8000/images/location_pin.png', function(error, image) {
	        if (error) throw error;
	        map.addImage('cat', image);
	        map.addLayer({
	            "id": "points",
	            "type": "symbol",
	            "source": {
	                "type": "geojson",
	                "data": {
	                    "type": "FeatureCollection",
	                    "features": [{
	                        "type": "Feature",
	                        "geometry": {
	                            "type": "Point",
	                            "coordinates": [long, lat]
	                        }
	                    }]
	                }
	            },
	            "layout": {
	                "icon-image": "cat",
	                "icon-size": 0.35
	            }
	        });
	    });

	});

}

