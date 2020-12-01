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

/***/ "./Resources/assets/js/app.js":
/*!************************************!*\
  !*** ./Resources/assets/js/app.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./util.js */ "./Resources/assets/js/util.js");

__webpack_require__(/*! ./sale.js */ "./Resources/assets/js/sale.js");

/***/ }),

/***/ "./Resources/assets/js/sale.js":
/*!*************************************!*\
  !*** ./Resources/assets/js/sale.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var EOfficeCRMSale = function () {
  var selectProduct = "#select-product";
  var addProduct = '#add-product';
  var tBodyProduct = '#tbody-product';
  var listGroup = '.list-group';
  var btnPayment = '.btn-save-payment';
  var modalPayment = '#sale-modal-payment';
  var formPayment = '.form-payment';
  var containerSaleId = '#container-sale-id';
  var paymentTable = '#crm-sale-payment-table';
  var modalDelete = '#sale-modal-delete-item';
  var btnDelete = '.btn-delete-item';
  var deliveryTable = '#crm-sale-delivery-table';
  var btnDelivery = '.btn-save-delivery';
  var formDelivery = '.form-delivery';
  var modalDelivery = '#sale-modal-delivery';
  var productRemove = '.product-remove';
  var feedbackTable = '#crm-sale-feedback-table';
  var btnFeedback = '.btn-save-feedback';
  var formFeedback = '.form-feedback';
  var modalFeedback = '#sale-modal-feedback';
  var paymentDatatable = null;
  var deliveryDatatable = null;
  var feedbackDatatable = null;

  var addProductElement = function addProductElement() {
    $(addProduct).off().on('click', function () {
      var option = $(selectProduct).children("option:selected");

      if (option.length > 0) {
        var moneyMin = option.data('money-min');
        var moneyMax = option.data('money-max');
        var name = option.data('name');
        var product = option.val();
        var quantityMax = option.data('quantity-max');
        var quantityMin = option.data('quantity-min');
        var moneyUtil = option.data('money-unit');
        var quantityUtil = option.data('quantity-unit');
        var available = option.data('available');
        var itemProduct = $('.add-item-product').clone();
        itemProduct.removeClass('hidden').removeClass('add-item-product');
        itemProduct.find('.product-name').html(name);
        itemProduct.find('.product-min').html(moneyMin);
        itemProduct.find('.product-max').html(moneyMax);
        itemProduct.find('.product-total-min').html(moneyMin);
        itemProduct.find('.product-total-max').html(moneyMax);
        itemProduct.find('.product-real-unit').html(moneyUtil);
        itemProduct.find('.product-quantity-unit').html(quantityUtil);
        itemProduct.find('.product-real').find('input').attr({
          'max': moneyMax,
          'min': moneyMin
        }).val(moneyMax);
        itemProduct.find('.product-quantity').find('input').attr({
          'max': quantityMax,
          'min': quantityMin,
          'available': available
        });
        itemProduct.attr({
          'data-product-id': product,
          "data-money-min": moneyMin,
          "data-money-max": moneyMax,
          "data-quantity-max": quantityMax,
          "data-quantity-min": quantityMin
        });
        itemProduct.find('.product-quantity').find('input').attr({
          'max': quantityMax,
          'min': quantityMin,
          'available': available
        });
        $(tBodyProduct).append(itemProduct);
        option.hide();
        $('#select-product').prop('selectedIndex', -1);
      }
    });
  };

  var onChangeQuantity = function onChangeQuantity() {
    $(document).on('change', '.input-max[type="number"]', function () {
      var quantityMax = parseInt($(this).attr('max'));
      var quantityMin = parseInt($(this).attr('min'));
      var available = parseInt($(this).attr('available'));
      var quantity = parseInt($(this).val());

      if (quantity > quantityMax) {
        alert('Số lượng tối đa là ' + quantityMax);
        $(this).val(quantityMax);
      }

      if (quantity < quantityMin) {
        alert('Số lượng tối thiểu là ' + quantityMin);
        $(this).val(quantityMin);
      }

      if (quantity > available && quantityMax > available) {
        alert('Số lượng còn lại trong kho là ' + available);
        $(this).val(available);
      }

      $(this).closest('.item-product').find('.product-load').trigger("click");
    });
  };

  var onChangeItemAmount = function onChangeItemAmount() {
    $(document).on('change', '.amount-real[type="number"]', function () {
      var amountMax = parseInt($(this).attr('max'));
      var amountMin = parseInt($(this).attr('min'));
      var amount = parseInt($(this).val());

      if (amount > amountMax) {
        alert('Số tiền tối đa là ' + amountMax);
        $(this).val(amountMax);
      }

      if (amount < amountMin) {
        alert('Số tiền tối thiểu là ' + amountMin);
        $(this).val(amountMin);
      }

      $(this).closest('.item-product').find('.product-load').trigger("click");
    });
  };

  var loadProductData = function loadProductData() {
    $(document).on("click", ".product-load", function () {
      var parent = $(this).closest('.item-product');
      var real = parent.find('.product-real').find('input').val();
      var moneyMin = parent.attr('data-money-min');
      var moneyMax = parent.attr('data-money-max');
      var quantity = parent.find('.product-quantity').find('input').val();
      var totalReal = quantity * real;
      var totalMoneyMin = quantity * moneyMin;
      var totalMoneyMax = quantity * moneyMax;
      parent.attr({
        "data-money-real": real,
        "data-quantity": quantity,
        "data-total-money-min": totalMoneyMin,
        "data-total-money-max": totalMoneyMax,
        "data-total-money-real": totalReal
      });
      parent.find('.product-total-min').html(totalMoneyMin);
      parent.find('.product-total-max').html(totalMoneyMax);
      parent.find('.product-total-real').attr('data-real', totalReal).html(totalReal);
      var totalRealAll = 0;
      $(".item-product").each(function ($index, $el) {
        var el = $($el);

        if (!el.hasClass('hidden')) {
          var elParent = el.closest('.item-product');
          totalRealAll += parseInt(elParent.find('.product-total-real').attr('data-real'));
        }
      });
      $(listGroup).find('.total-money').data('total-money', totalRealAll).html(totalRealAll);
      $(listGroup).find('.final-money').html(totalRealAll);
    });
  };

  var callAjax = function callAjax(url, method) {
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
    var callbackSuccess = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    $.ajax({
      url: url,
      type: method,
      data: params,
      beforeSend: function beforeSend() {
        $.blockUI({
          css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
          }
        });
      },
      success: function success(response) {
        $.unblockUI();

        if (callbackSuccess) {
          callbackSuccess(response);
        } else {
          toast('Thêm mới thành công', 'success');
        }
      },
      error: function error(jqXHR, exception) {
        $.unblockUI();
        toast('Thất bại', 'error');
      }
    });
  };

  var saveDetail = function saveDetail() {
    $('.btn-save-detail').off().on('click', function () {
      loadDataBeforeSubmit();
      var data = [];
      $(".item-product").each(function () {
        if (!$(this).hasClass('hidden')) {
          var sale_id = $('#crm-sale-detail').data('sale-id');
          var product_id = $(this).data('product-id');
          var money_min = $(this).data('money-min');
          var money_max = $(this).data('money-max');
          var money_real = $(this).data('money-real');
          var quantity = $(this).data('quantity');
          var total_money_min = $(this).data('total-money-min');
          var total_money_max = $(this).data('total-money-max');
          var total_money_real = $(this).data('total-money-real');
          data.push({
            sale_id: sale_id,
            product_id: product_id,
            money_min: money_min,
            money_max: money_max,
            money_real: money_real,
            quantity: quantity,
            total_money_min: total_money_min,
            total_money_max: total_money_max,
            total_money_real: total_money_real
          });
        }
      });

      if (data.length > 0) {
        // call ajax
        var url = $(this).data('route');
        var param = {
          data: data,
          total_money: $(listGroup).find('.total-money').html(),
          money_up: $(listGroup).find('.money-up').val(),
          money_down: $(listGroup).find('.money-down').val(),
          discount: $(listGroup).find('.discount').val(),
          vat: $(listGroup).find('.vat').val(),
          final_money: $(listGroup).find('.final-money').html(),
          sale_id: $('#crm-sale-detail').data('sale-id')
        };
        callAjax(url, 'POST', param);
        return;
      }

      alert('Bạn chưa chọn sản phẩm');
    });
  };

  var ajaxSuccessPayment = function ajaxSuccessPayment($response) {
    toast('Thêm mới thành công', 'success');
    paymentDatatable.ajax.reload();
    $(modalPayment).modal('hide');
  };

  var changeMoney = function changeMoney() {
    $('.money-up').off().on('change', function () {
      var up = parseInt($(this).val());
      var down = parseInt($('.money-down').val());
      var discount = parseInt($('.discount').val());
      var vat = parseInt($('.vat').val());
      var real = $(listGroup).find('.total-money').data('total-money');

      if (discount != 0) {
        real = real - real * discount / 100;
      }

      if (vat != 0) {
        real = real - real * vat / 100;
      }

      var _final = parseInt(real) + parseInt(up) - parseInt(down);

      $(listGroup).find('.final-money').html(_final);
    });
    $('.money-down').off().on('change', function () {
      var up = parseInt($('.money-up').val());
      var down = parseInt($(this).val());
      var discount = parseInt($('.discount').val());
      var vat = parseInt($('.vat').val());
      var real = $(listGroup).find('.total-money').data('total-money');

      if (discount != 0) {
        real = real - real * discount / 100;
      }

      if (vat != 0) {
        real = real - real * vat / 100;
      }

      var _final2 = parseInt(real) + parseInt(up) - parseInt(down);

      $(listGroup).find('.final-money').html(_final2);
    });
    $('.discount').off().on('change', function () {
      var up = parseInt($('.money-up').val());
      var down = parseInt($('.money-down').val());
      var vat = parseInt($('.vat').val());
      var discount = parseInt($(this).val());
      var real = $(listGroup).find('.total-money').data('total-money');

      if (discount != 0) {
        real = real - real * discount / 100;
      }

      if (vat != 0) {
        real = real - real * vat / 100;
      }

      var _final3 = parseInt(real) + parseInt(up) - parseInt(down);

      $(listGroup).find('.final-money').html(_final3);
    });
    $('.vat').off().on('change', function () {
      var up = parseInt($('.money-up').val());
      var down = parseInt($('.money-down').val());
      var vat = parseInt($(this).val());
      var discount = parseInt($('.discount').val());
      var real = $(listGroup).find('.total-money').data('total-money');

      if (discount != 0) {
        real = real - real * discount / 100;
      }

      if (vat != 0) {
        real = real - real * vat / 100;
      }

      var _final4 = parseInt(real) + parseInt(up) - parseInt(down);

      $(listGroup).find('.final-money').html(_final4);
    });
  };

  var loadDataBeforeSubmit = function loadDataBeforeSubmit() {
    var up = parseInt($('.money-up').val());
    var down = parseInt($('.money-down').val());
    var vat = parseInt($('.vat').val());
    var discount = parseInt($('.discount').val());
    var real = $(listGroup).find('.total-money').data('total-money');

    if (discount != 0) {
      real = real - real * discount / 100;
    }

    if (vat != 0) {
      real = real - real * vat / 100;
    }

    var _final5 = parseInt(real) + parseInt(up) - parseInt(down);

    $(listGroup).find('.final-money').html(_final5);
  };

  var storePayment = function storePayment() {
    $(btnPayment).off().on('click', function () {
      var form = $(this).closest(modalPayment).find(formPayment);
      var sale_id = $(containerSaleId).data('sale-id');
      var money = form.find('input[name="money"]').val();
      var payment_type_id = form.find('select[name="payment_type_id"]').children("option:selected").val();
      var note = form.find('input[name="note"]').val();
      var description = form.find('textarea[name="description"]').val();
      var date = form.find('input[name="date"]').val();
      var status_id = form.find('select[name="status_id"]').children("option:selected").val();
      var customer_id = $(containerSaleId).data('customer_id'); // validate money

      var moneyMax = parseInt(form.find('input[name="money"]').attr('data-max'));
      var afterPayment = moneyMax - parseInt(money);

      if (afterPayment < 0) {
        alert('Số tiền cần thu còn lại là ' + moneyMax);
        return;
      }

      form.find('input[name="money"]').attr('data-max', afterPayment);

      if (!date) {
        alert('Vui lòng nhập ngày');
        return;
      }

      if (!money) {
        alert('Vui lòng nhập giá tiền');
        return;
      }

      var param = {
        sale_id: sale_id,
        money: money,
        payment_type_id: payment_type_id,
        note: note,
        status_id: status_id,
        customer_id: customer_id,
        description: description,
        date: date
      };
      var url = $(this).data('route');
      callAjax(url, 'POST', param, ajaxSuccessPayment);
    });
  };

  var initDatatablePayment = function initDatatablePayment() {
    paymentDatatable = $(paymentTable).DataTable({
      processing: true,
      serverSide: true,
      ajax: $(paymentTable).data('datatable'),
      columns: [{
        data: 'id',
        name: 'id'
      }, {
        data: 'payment_type_id',
        name: 'payment_type_id'
      }, {
        data: 'status_id',
        name: 'status_id'
      }, {
        data: 'money',
        name: 'money'
      }, {
        data: 'date',
        name: 'date'
      }, {
        data: 'description',
        name: 'description'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
    setTimeout(function () {
      $(paymentTable).removeAttr('style');
    }, 300);
  };

  var openModalDelete = function openModalDelete() {
    $(document).on("click", '.btn-remove', function () {
      $(modalDelete).find('form').attr('action', $(this).data('href'));
      $(modalDelete).modal('show');
    });
  };

  var deleteItem = function deleteItem() {
    $(btnDelete).off().on('click', function () {
      var form = $(this).closest('form');
      var url = form.attr('action');
      callAjax(url, 'DELETE', {}, ajaxSuccessDeletePayment);
    });
  };

  var ajaxSuccessDeletePayment = function ajaxSuccessDeletePayment($response) {
    toast('Xoá thành công', 'success');
    paymentDatatable.ajax.reload();
    deliveryDatatable.ajax.reload();
    feedbackDatatable.ajax.reload();
    $(modalDelete).modal('hide');
  };

  var storeDelivery = function storeDelivery() {
    $(btnDelivery).off().on('click', function () {
      var form = $(this).closest(modalDelivery).find(formDelivery);
      var sale_id = $(containerSaleId).data('sale-id');
      var address = form.find('input[name="address"]').val();
      var products = [];
      form.find('input[name="product"]:checked').each(function (i, el) {
        var parent = $(el).closest('.list-group-item');
        var quantity = parent.find('input[type="number"]').val();
        products.push({
          product_id: $(el).data('value'),
          quantity: quantity
        });
        var max = parseInt(parent.find('input[type="number"]').attr('max'));
        parent.find('input[type="number"]').attr('max', max - parseInt(quantity));
      });
      var note = form.find('input[name="note"]').val();
      var date = form.find('input[name="date"]').val();
      var status_id = form.find('select[name="status_id"]').children("option:selected").val();
      var customer_id = $(containerSaleId).data('customer_id');
      var param = {
        sale_id: sale_id,
        address: address,
        products: products,
        note: note,
        status_id: status_id,
        customer_id: customer_id,
        date: date
      };

      if (address === '') {
        alert('Vui lòng nhập địa chỉ');
        return;
      }

      if (products.length > 0) {
        var url = $(this).data('route');
        callAjax(url, 'POST', param, ajaxSuccessDelivery);
      } else {
        alert('Vui lòng chọn sản phẩm');
        return;
      }
    });
  };

  var initDatatableDelivery = function initDatatableDelivery() {
    deliveryDatatable = $(deliveryTable).DataTable({
      processing: true,
      serverSide: true,
      ajax: $(deliveryTable).data('datatable'),
      columns: [{
        data: 'id',
        name: 'id'
      }, {
        data: 'products',
        name: 'products'
      }, {
        data: 'status_id',
        name: 'status_id'
      }, {
        data: 'address',
        name: 'address'
      }, {
        data: 'date',
        name: 'date'
      }, {
        data: 'note',
        name: 'note'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
    setTimeout(function () {
      $(deliveryTable).removeAttr('style');
    }, 300);
  };

  var ajaxSuccessDelivery = function ajaxSuccessDelivery($response) {
    toast('Thêm mới thành công', 'success');
    deliveryDatatable.ajax.reload();
    $(modalDelivery).modal('hide');
  }; // Feedback


  var storeFeedback = function storeFeedback() {
    $(btnFeedback).off().on('click', function () {
      var form = $(this).closest(modalFeedback).find(formFeedback);
      var sale_id = $(containerSaleId).data('sale-id');
      var content = form.find('textarea[name="content"]').val();
      var date = form.find('input[name="date"]').val();
      var customer_id = $(containerSaleId).data('customer_id');
      var param = {
        sale_id: sale_id,
        content: content,
        customer_id: customer_id,
        date: date
      };
      var url = $(this).data('route');
      callAjax(url, 'POST', param, ajaxSuccessFeedback);
    });
  };

  var initDatatableFeedback = function initDatatableFeedback() {
    feedbackDatatable = $(feedbackTable).DataTable({
      processing: true,
      serverSide: true,
      ajax: $(feedbackTable).data('datatable'),
      columns: [{
        data: 'id',
        name: 'id'
      }, {
        data: 'date',
        name: 'date'
      }, {
        data: 'content',
        name: 'content'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
    setTimeout(function () {
      $(feedbackTable).removeAttr('style');
    }, 300);
  };

  var ajaxSuccessFeedback = function ajaxSuccessFeedback($response) {
    toast('Thêm mới thành công', 'success');
    feedbackDatatable.ajax.reload();
    $(modalFeedback).modal('hide');
  };

  var onProductRemove = function onProductRemove() {
    $(document).on("click", productRemove, function () {
      var parent = $(this).closest('.item-product');
      var amount = parseInt(parent.find('.product-total-real').attr('data-real'));
      var currentTotalAmount = parseInt($(listGroup).find('.total-money').data('total-money'));
      var totalAmount = currentTotalAmount - amount;
      $(listGroup).find('.total-money').data('total-money', totalAmount).html(totalAmount);
      $('.money-down').trigger("change");
      var productId = parent.attr('data-product-id');
      $('#option' + productId).show();
      $('#select-product').prop('selectedIndex', -1);
      parent.remove();
    });
  };

  return {
    init: function init() {
      addProductElement();
      loadProductData();
      saveDetail();
      changeMoney();
      storePayment();
      initDatatablePayment();
      openModalDelete();
      deleteItem();
      storeDelivery();
      initDatatableDelivery();
      storeFeedback();
      initDatatableFeedback();
      onChangeQuantity();
      onChangeItemAmount();
      onProductRemove();
    }
  };
}();

jQuery(document).ready(function () {
  //init functions Table
  EOfficeCRMSale.init();
});

/***/ }),

/***/ "./Resources/assets/js/util.js":
/*!*************************************!*\
  !*** ./Resources/assets/js/util.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var EOfficeCRMUtil = function () {
  var deleteItem = ".delete-item";
  var modalDeleteItem = "#modal-delete-item";
  /**
   * Open popup company table vs handle checkbox
   */

  var showModalDelete = function showModalDelete() {
    $(deleteItem).off('click').on('click', function () {
      $(modalDeleteItem).find('form').attr('action', $(this).data('href'));
      $(modalDeleteItem).modal('show');
    });
  };

  return {
    init: function init() {
      showModalDelete();
    }
  };
}();

jQuery(document).ready(function () {
  //init functions Table
  EOfficeCRMUtil.init();
});

/***/ }),

/***/ "./Resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./Resources/assets/sass/app.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************!*\
  !*** multi ./Resources/assets/js/app.js ./Resources/assets/sass/app.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/hcenter/Desktop/www/web/thaile/hai/E-Office/Modules/CRM/Resources/assets/js/app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! /Users/hcenter/Desktop/www/web/thaile/hai/E-Office/Modules/CRM/Resources/assets/sass/app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });