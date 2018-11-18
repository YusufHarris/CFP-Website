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
/******/ 	return __webpack_require__(__webpack_require__.s = 595);
/******/ })
/************************************************************************/
/******/ ({

/***/ 595:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(596);


/***/ }),

/***/ 596:
/***/ (function(module, exports) {

/*
 * Scrolls to the anchors on the page
 */
$(".scroll").click(function (event) {
    event.preventDefault();
    //calculate destination place
    var dest = 0;
    if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
        dest = $(document).height() - $(window).height();
    } else {
        dest = $(this.hash).offset().top - 40;
    }
    //go to destination
    $('html,body').animate({ scrollTop: dest }, 1000, 'swing');
});

/*
 * Inserts the leaflet map into the Contact section
 */
var map = L.map('office-map').setView([-5.046, 39.716], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([-5.046, 39.716]).addTo(map).bindPopup('CFP\'s<br> Rural Innovation Campus').openPopup();

/*
 * Changes the background color of the navigation bar when the user scrolls
 */
$(document).ready(function () {
    var scroll_start = 0;
    var startchange = $('#cfp-title');
    var offset = startchange.offset();
    if (startchange.length) {
        $(document).scroll(function () {
            scroll_start = $(this).scrollTop();
            if (scroll_start > offset.top) {
                $('.nav-welcome-bg').css('background', 'linear-gradient(to top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 60%)');
                $('.nav-welcome-bg').css('background-color', '#28a745');
                $('.nav-welcome-bg').css('transition', 'background-color 200ms linear');
            } else {
                $('.nav-welcome-bg').css('background-color', 'transparent');
                $('.nav-welcome-bg').css('background', 'linear-gradient(to top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.5) 30%)');
                $('.nav-welcome-bg').css('transition', 'background-color 200ms linear');
            }
        });
    }
});

/***/ })

/******/ });