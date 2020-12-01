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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dev.js":
/*!*****************************!*\
  !*** ./resources/js/dev.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./form.js */ "./resources/js/form.js");

__webpack_require__(/*! ./global.js */ "./resources/js/global.js");

/***/ }),

/***/ "./resources/js/form.js":
/*!******************************!*\
  !*** ./resources/js/form.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var EOfficeForm = function () {
  var select2 = ".select2";
  var userGroupName = 'user_group_id';

  var initSelect2 = function initSelect2() {
    if ($(select2).length > 0) {
      $(select2).select2();
    }
  };

  var _callAjax2 = function _callAjax(url, method) {
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    var callbackSuccess = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    var callbackError = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
    $.ajax({
      url: url,
      type: method,
      data: params,
      beforeSend: function beforeSend() {
        $('.custom-spinner-center').show();
      },
      success: function success(response) {
        $('.custom-spinner-center').hide();

        if (callbackSuccess) {
          eval(callbackSuccess)(response);
        }
      },
      error: function error(jqXHR, exception) {
        $('.custom-spinner-center').hide();

        if (callbackError) {
          eval(callbackError)(jqXHR);
        }
      }
    });
  };

  var getUserInGroup = function getUserInGroup() {
    $('select[name="user_group_id"]').on('change', function () {
      var id = $('select[name="user_group_id"] option:selected').val();

      _callAjax2('/config/hrm/employeegroup/user/' + id, 'GET', {}, getUserInGroupSuccess);
    });
  };

  var getUserInGroupSuccess = function getUserInGroupSuccess($response) {
    console.log($response);
    $('select[name="in_charge_id"]').find('option').remove();
    $.each($response, function (key, value) {
      $('select[name="in_charge_id"]').append($('<option>', {
        value: key,
        text: value
      }));
    });
  };

  return {
    init: function init() {
      initSelect2();
      getUserInGroup();
    },
    _callAjax: function _callAjax(url, method) {
      var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      var callbackSuccess = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
      var callbackError = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;

      _callAjax2(url, method, params, callbackSuccess, callbackError);
    }
  };
}();

jQuery(document).ready(function () {
  //init functions Table
  EOfficeForm.init();
});
module.exports = EOfficeForm;

/***/ }),

/***/ "./resources/js/global.js":
/*!********************************!*\
  !*** ./resources/js/global.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  $(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); // Handle ajax error

    $(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
      if (xhr.status === 505) {
        return window.location.href = "/";
      }
    }); // handle finish ajax calls

    $(document).ajaxStop(function () {
      $('.tooltips').tooltip();
    });
  });
})(jQuery);

/***/ }),

/***/ "./resources/sass/dev.scss":
/*!*********************************!*\
  !*** ./resources/sass/dev.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/dev.js ./resources/sass/dev.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/hcenter/Desktop/www/web/thaile/hai/E-Office/resources/js/dev.js */"./resources/js/dev.js");
module.exports = __webpack_require__(/*! /Users/hcenter/Desktop/www/web/thaile/hai/E-Office/resources/sass/dev.scss */"./resources/sass/dev.scss");


/***/ })

/******/ });