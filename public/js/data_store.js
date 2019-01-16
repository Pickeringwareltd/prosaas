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
/******/ 	return __webpack_require__(__webpack_require__.s = 12);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/data_store.js":
/***/ (function(module, exports) {

var copy_arr = [];

$(function () {

	var $container = $('#items_grid');
	// initialize
	$container.masonry({
		itemSelector: '.grid-item',
		gutter: 20
	});
});

function showCopiedAnimation(text, copied) {
	text.fadeOut(250, function () {
		copied.fadeIn(250, function () {
			setTimeout(function () {
				copied.fadeOut(250, function () {
					text.fadeIn(250, function () {
						// Animation complete.
					});
				});
			}, 1000);
		});
	});
}

function copyToClipboard(element) {
	var $temp = $("<textarea>");
	var brRegex = /<br\s*[\/]?>/gi;
	$("body").append($temp);
	$temp.val(element.replace(brRegex, "\r\n")).select();
	document.execCommand("copy");
	$temp.remove();
}

$('#copy_btn').on('click', function () {

	var copy_string = '';

	for (var i = 0; i < copy_arr.length; i++) {
		copy_string = copy_string + '<br>' + copy_arr[i];
	}

	copyToClipboard(copy_string);

	showCopiedAnimation($('#copy_btn'), $('#copied_btn'));
});

$('#group_btn').on('click', function () {
	$('.select_group').toggleClass('d-none');
});

$('#select_modal > .modal-background').on('click', function () {
	$('#select_modal').toggleClass('is-active');
});

$(document.body).on('click', '.checkbox__input', function () {

	if ($(this).prop('checked')) {
		// add value to array
		// show copy button

		var value = $(this).attr('data-value');
		var name = $(this).attr('data-name');
		var id = $(this).attr('id');

		copy_arr.push(name + ': ' + value);

		$('#copy_area').show();
	} else {
		// slice the value from array
		// if array length is 0, hide copy button
		var value = $(this).attr('data-value');
		var name = $(this).attr('data-name');

		var copy_val = name + ': ' + value;

		var index = copy_arr.indexOf(copy_val);
		if (index > -1) {
			copy_arr.splice(index, 1);
		}

		if (copy_arr.length == 0) {
			$('#copy_area').hide();
		}
	}
});

/***/ }),

/***/ 12:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/js/data_store.js");


/***/ })

/******/ });