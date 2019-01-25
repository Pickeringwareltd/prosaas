/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/search_locations.js":
/***/ (function(module, exports) {

$(function () {
    $.ajaxSetup({ headers: { 'csrftoken': '{{ csrf_token() }}' } });
    mapboxgl.accessToken = 'pk.eyJ1IjoiamFja3BpY2tlcmluZyIsImEiOiJjanFxZzExamwwYjJ6NDJuMmV4bHFxY2ZoIn0.JF0uWDZRviXZ6kkM_9jCfQ';

    loopMaps();
});

var copy_arr = [];
var tags = [];

$('#search').on('keyup', function () {

    searchResults();
});

$(document.body).on('click', '.search-tag', function () {

    if (!$(this).hasClass('active')) {
        $(this).removeClass('is-info');
        $(this).addClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.show();
        tags.push($(this).attr('data-name'));
    } else {
        $(this).addClass('is-info');
        $(this).removeClass('is-success');
        $(this).toggleClass('active');
        var delete_btn = $(this).find('.delete');
        delete_btn.hide();

        var index = tags.indexOf($(this).attr('data-name'));
        if (index > -1) {
            tags.splice(index, 1);
        }
    }

    searchResults();
});

function searchResults() {
    var value = tags;
    var search_field = $('#search').val();

    $.ajax({

        type: 'get',

        url: '/search/locations',

        data: {
            'tags': value,
            'search_field': search_field
        },

        success: function success(data) {

            dealWithResults(data);
        },

        error: function error(err) {

            console.log('err = ' + JSON.stringify(err));
        }

    });
}

function dealWithResults(data) {

    var search_empty = false;

    if ($('#search').val() == '' && tags.length == 0) {
        search_empty = true;
    }

    if (data != '') {
        $('#all_results').hide();

        $('#search_results').html(data);

        // Destory search results in order to re-build
        $('#items_grid').masonry('destroy');
        $('#items_grid').removeData('masonry');

        // Re-init masonry again. =
        $('#items_grid').masonry({
            itemSelector: '.grid-item',
            gutter: 20
        });

        var length = copy_arr.length;

        for (var i = 0; i < length; i++) {
            var item_arr = copy_arr[i].split(':');
            var item_id = item_arr[0];

            $('#' + item_id).prop('checked', true);
        }

        if (length > 0) {
            $('#group_btn').trigger("click");
        }

        loopMaps();
    } else if (data == '' && search_empty) {
        $('#search_results').html('');
        $('#all_results').show();
    } else {
        $('#search_results').html('');
        $('#all_results').hide();
    }
}

function loopMaps() {
    $('.new_map').each(function () {

        var name = $(this).attr('data-name');
        var long = $(this).attr('data-long');
        var lat = $(this).attr('data-lat');

        loadMap(name, long, lat);
    });
}

function loadMap(this_map, long, lat) {
    var map = new mapboxgl.Map({
        container: this_map,
        style: 'mapbox://styles/mapbox/streets-v9',
        center: [long, lat],
        zoom: 12
    });

    map.on('load', function () {
        map.loadImage('http://localhost:8000/images/location_pin.png', function (error, image) {
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

/***/ }),

/***/ 25:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/js/search_locations.js");


/***/ })

/******/ });