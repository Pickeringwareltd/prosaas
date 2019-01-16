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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/sidebar.js":
/***/ (function(module, exports) {

$(document).ready(function () {

				$('#sidebarCollapse').on('click', function () {
								$('#sidebar').toggleClass('active');
				});

				$('#new_tag_icon').on('click', function () {
								var tag_name = $('#new_tag_input').val();

								sendNewTag(tag_name);
				});

				$('#modal_new_tag_icon').on('click', function () {
								var tag_name = $('#modal_new_tag_input').val();

								sendNewTag(tag_name);
				});
});

function sendNewTag(tag_name) {
				if (tag_name != '') {
								$.ajaxSetup({
												headers: {
																'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
												}
								});

								$.ajax({

												type: 'post',

												url: '/tags/create',

												data: {
																'tag': tag_name
												},

												success: function success(data) {

																var tag_string = '<span class="tag add-tags added-tag is-medium is-info" data-name="' + tag_name + '">' + tag_name + '<button class="delete is-small" style="display:none;"></button></span>';
																$('#modal_tag_list').append(tag_string);

																tag_string = '<span class="tag search-tag is-medium is-info" data-name="' + tag_name + '">' + tag_name + '<button class="delete is-small" style="display:none;"></button></span>';
																$('#tag_list').append(tag_string);
																$('#new_tag_input').val('');
												},

												error: function error(err) {

																showErrorMessage('Error adding tag');

																console.log('err = ' + JSON.stringify(err));
												}

								});
				}
}

function showErrorMessage(err) {

				$('#error_message').html(err);
				$('#error_box').toggleClass('d-none', 1000);
				setTimeout(function () {
								$('#error_box').toggleClass('d-none', 1000);
				}, 3000);
}

/***/ }),

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/js/sidebar.js");


/***/ })

/******/ });