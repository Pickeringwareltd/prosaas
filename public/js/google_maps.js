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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/google_maps.js":
/***/ (function(module, exports) {

$(function () {

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
		map2.loadImage('http://localhost:8000/images/location_pin.png', function (error, image) {
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

/***/ }),

/***/ 17:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/js/google_maps.js");


/***/ })

/******/ });