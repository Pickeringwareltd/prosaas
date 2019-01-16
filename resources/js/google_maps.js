$(function(){

	mapboxgl.accessToken = 'pk.eyJ1IjoiamFja3BpY2tlcmluZyIsImEiOiJjanFxZzExamwwYjJ6NDJuMmV4bHFxY2ZoIn0.JF0uWDZRviXZ6kkM_9jCfQ';

	var map = new mapboxgl.Map({
	    container: 'map',
	    style: 'mapbox://styles/mapbox/streets-v9',
	    center: [-1.231620332527882, 54.578762427082125],
	    zoom: 12
	});

	var map2 = new mapboxgl.Map({
	    container: 'map2',
	    style: 'mapbox://styles/mapbox/streets-v9',
	    center: [-1.2331601181724352, 54.57203411840513],
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
	                            "coordinates": [-1.231620332527882, 54.578762427082125]
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

	map2.on('load', function () {
	    map2.loadImage('http://localhost:8000/images/location_pin.png', function(error, image) {
	        if (error) throw error;
	        map2.addImage('cat', image);
	        map2.addLayer({
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
	                            "coordinates": [-1.2331601181724352, 54.57203411840513]
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


});

