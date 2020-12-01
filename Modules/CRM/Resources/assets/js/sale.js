var EOfficeCRMSale = function () {

    const selectProduct = "#select-product";
    const addProduct = '#add-product';
    const tBodyProduct = '#tbody-product';
    const listGroup = '.list-group';
    const btnPayment = '.btn-save-payment';
    const modalPayment = '#sale-modal-payment';
    const formPayment = '.form-payment';
    const containerSaleId = '#container-sale-id';
    const paymentTable = '#crm-sale-payment-table';
    const modalDelete = '#sale-modal-delete-item';
    const btnDelete = '.btn-delete-item';
    const deliveryTable = '#crm-sale-delivery-table';
    const btnDelivery = '.btn-save-delivery';
    const formDelivery = '.form-delivery';
    const modalDelivery = '#sale-modal-delivery';
    const productRemove = '.product-remove';

    const feedbackTable = '#crm-sale-feedback-table';
    const btnFeedback = '.btn-save-feedback';
    const formFeedback = '.form-feedback';
    const modalFeedback = '#sale-modal-feedback'

    let paymentDatatable = null;
    let deliveryDatatable = null;
    let feedbackDatatable = null;

    const addProductElement = function() {
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
                $('#select-product').prop('selectedIndex',-1);
            }
        });
    }

    const onChangeQuantity = function () {
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

            $(this).closest('.item-product').find('.product-load').trigger( "click" );
        });
    };

    const onChangeItemAmount = function () {
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

            $(this).closest('.item-product').find('.product-load').trigger( "click" );
        });
    };

    const loadProductData = function() {
        $(document).on("click", ".product-load", function() {
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
                "data-total-money-real": totalReal,
            });
            parent.find('.product-total-min').html(totalMoneyMin);
            parent.find('.product-total-max').html(totalMoneyMax);
            parent.find('.product-total-real').attr('data-real', totalReal).html(totalReal);

            var totalRealAll = 0;
            $(".item-product").each(function($index, $el) {
                var el = $($el);
                if ( !el.hasClass('hidden') ) {
                    var elParent = el.closest('.item-product');
                    totalRealAll += parseInt(elParent.find('.product-total-real').attr('data-real'));
                }
            });
            $(listGroup).find('.total-money').data('total-money', totalRealAll).html(totalRealAll);
            $(listGroup).find('.final-money').html(totalRealAll);
        });
    }

    const callAjax = function (
        url,
        method,
        params = [],
        callbackSuccess = null
    ) {
        $.ajax({
            url: url,
            type: method,
            data: params,
            beforeSend: function beforeSend() {
                $.blockUI({ css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    } });
            },
            success: function success(response) {
                $.unblockUI();
                if (callbackSuccess) {
                    callbackSuccess(response)
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

    const saveDetail = function() {
        $('.btn-save-detail').off().on('click', function () {
            loadDataBeforeSubmit();

            var data = [];
            $( ".item-product" ).each(function() {
                if ( !$(this).hasClass('hidden') ) {
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
                        sale_id, product_id, money_min, money_max, money_real, quantity, total_money_min, total_money_max, total_money_real
                    });
                }
            });

            if (data.length > 0) {
                // call ajax
                var url = $(this).data('route');
                let param = {
                    data,
                    total_money: $(listGroup).find('.total-money').html(),
                    money_up: $(listGroup).find('.money-up').val(),
                    money_down: $(listGroup).find('.money-down').val(),
                    discount: $(listGroup).find('.discount').val(),
                    vat: $(listGroup).find('.vat').val(),
                    final_money: $(listGroup).find('.final-money').html(),
                    sale_id: $('#crm-sale-detail').data('sale-id')
                }
                callAjax(url, 'POST', param);
                return;
            }
            alert('Bạn chưa chọn sản phẩm')
        });
    };

    const ajaxSuccessPayment = function ($response) {
        toast('Thêm mới thành công', 'success');
        paymentDatatable.ajax.reload();
        $(modalPayment).modal('hide');
    };

    const changeMoney = function () {
        $('.money-up').off().on('change', function () {
            var up = parseInt($(this).val());
            var down = parseInt($('.money-down').val());
            var discount = parseInt($('.discount').val());
            var vat = parseInt($('.vat').val());
            var real = $(listGroup).find('.total-money').data('total-money');

            if (discount != 0) {
                real = real - real * discount / 100
            }

            if (vat != 0) {
                real = real - real * vat / 100
            }
            var final = parseInt(real) + parseInt(up) - parseInt(down);
            $(listGroup).find('.final-money').html(final);
        });

        $('.money-down').off().on('change', function () {
            var up = parseInt($('.money-up').val());
            var down = parseInt($(this).val());
            var discount = parseInt($('.discount').val());
            var vat = parseInt($('.vat').val());
            var real = $(listGroup).find('.total-money').data('total-money');
            if (discount != 0) {
                real = real - real * discount / 100
            }

            if (vat != 0) {
                real = real - real * vat / 100
            }
            var final = parseInt(real) + parseInt(up) - parseInt(down);
            $(listGroup).find('.final-money').html(final);
        });

        $('.discount').off().on('change', function () {
            var up = parseInt($('.money-up').val());
            var down = parseInt($('.money-down').val());
            var vat = parseInt($('.vat').val());
            var discount = parseInt($(this).val());
            var real = $(listGroup).find('.total-money').data('total-money');
            if (discount != 0) {
                real = real - real * discount / 100
            }

            if (vat != 0) {
                real = real - real * vat / 100
            }
            var final = parseInt(real) + parseInt(up) - parseInt(down);

            $(listGroup).find('.final-money').html(final);
        });

        $('.vat').off().on('change', function () {
            var up = parseInt($('.money-up').val());
            var down = parseInt($('.money-down').val());
            var vat = parseInt($(this).val());
            var discount = parseInt($('.discount').val());
            var real = $(listGroup).find('.total-money').data('total-money');
            if (discount != 0) {
                real = real - real * discount / 100
            }

            if (vat != 0) {
                real = real - real * vat / 100
            }
            var final = parseInt(real) + parseInt(up) - parseInt(down);

            $(listGroup).find('.final-money').html(final);
        });
    }

    const loadDataBeforeSubmit = function () {
        var up = parseInt($('.money-up').val());
        var down = parseInt($('.money-down').val());
        var vat = parseInt($('.vat').val());
        var discount = parseInt($('.discount').val());
        var real = $(listGroup).find('.total-money').data('total-money');
        if (discount != 0) {
            real = real - real * discount / 100
        }

        if (vat != 0) {
            real = real - real * vat / 100
        }
        var final = parseInt(real) + parseInt(up) - parseInt(down);

        $(listGroup).find('.final-money').html(final);
    };

    const storePayment = function () {
        $(btnPayment).off().on('click', function () {

            const form = $(this).closest(modalPayment).find(formPayment);
            const sale_id = $(containerSaleId).data('sale-id');
            const money = form.find('input[name="money"]').val();
            const payment_type_id = form.find('select[name="payment_type_id"]').children("option:selected").val();
            const note = form.find('input[name="note"]').val();
            const description = form.find('textarea[name="description"]').val();
            const date = form.find('input[name="date"]').val();
            const status_id = form.find('select[name="status_id"]').children("option:selected").val();
            const customer_id = $(containerSaleId).data('customer_id');

            // validate money
            const moneyPaid = parseInt(form.find('input[name="money"]').attr('data-paid'));
            const totalAmount = parseInt(form.find('input[name="money"]').attr('data-amount'));
            const amount = totalAmount - moneyPaid;
            const afterPayment = amount - parseInt(money);
            if ( afterPayment < 0 ) {
                alert('Số tiền cần thu còn lại là ' + amount);
                return;
            }
            form.find('input[name="money"]').attr('data-paid', parseInt(money) + moneyPaid);

            if (!date) {
                alert('Vui lòng nhập ngày');
                return;
            }

            if (!money) {
                alert('Vui lòng nhập giá tiền');
                return;
            }

            const param = {
                sale_id, money, payment_type_id, note, status_id, customer_id, description, date
            };

            const url = $(this).data('route');
            callAjax(url, 'POST', param, ajaxSuccessPayment);

        });
    };

    const initDatatablePayment = function () {
        paymentDatatable = $(paymentTable).DataTable({
            processing: true,
            serverSide: true,
            ajax: $(paymentTable).data('datatable'),
            columns: [
                { data: 'id', name: 'id' },
                { data: 'payment_type_id', name: 'payment_type_id' },
                { data: 'status_id', name: 'status_id' },
                { data: 'money', name: 'money' },
                { data: 'date', name: 'date' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action' }
            ]
        });
        setTimeout(function () {
            $(paymentTable).removeAttr('style');
        }, 300);
    };

    const openModalDelete = function () {
        $(document).on("click", '.btn-remove', function () {
            $(modalDelete).find('form').attr('action', $(this).data('href'));
            $(modalDelete).modal('show');
        })
    };

    const deleteItem = function () {
        $(btnDelete).off().on('click', function () {
            const form = $(this).closest('form');
            const url = form.attr('action');
            callAjax(url, 'DELETE', {}, ajaxSuccessDeletePayment);
        });
    };

    const ajaxSuccessDeletePayment = function ($response) {
        toast('Xoá thành công', 'success');
        paymentDatatable.ajax.reload();
        deliveryDatatable.ajax.reload();
        feedbackDatatable.ajax.reload();
        $(modalDelete).modal('hide');
    };

    const storeDelivery = function () {
        $(btnDelivery).off().on('click', function () {
            const form = $(this).closest(modalDelivery).find(formDelivery);
            const sale_id = $(containerSaleId).data('sale-id');
            const address = form.find('input[name="address"]').val();
            let products = [];
            form.find('input[name="product"]:checked').each(function(i, el) {
                const parent = $(el).closest('.list-group-item');
                var quantity = parent.find('input[type="number"]').val();
                products.push({
                   product_id: $(el).data('value'),
                   quantity
                });


                var max = parseInt(parent.find('input[type="number"]').attr('max'));
                parent.find('input[type="number"]').attr('max', max - parseInt(quantity));
            });

            const note = form.find('input[name="note"]').val();
            const date = form.find('input[name="date"]').val();
            const status_id = form.find('select[name="status_id"]').children("option:selected").val();
            const customer_id = $(containerSaleId).data('customer_id');

            const param = {
                sale_id, address, products, note, status_id, customer_id, date
            };

            if(address === '') {
                alert('Vui lòng nhập địa chỉ');
                return;
            }

            if (products.length > 0) {
                const url = $(this).data('route');
                callAjax(url, 'POST', param, ajaxSuccessDelivery);
            }else{
                alert('Vui lòng chọn sản phẩm');
                return;
            }   
        });
    };

    const initDatatableDelivery = function () {
        deliveryDatatable = $(deliveryTable).DataTable({
            processing: true,
            serverSide: true,
            ajax: $(deliveryTable).data('datatable'),
            columns: [
                { data: 'id', name: 'id' },
                { data: 'products', name: 'products' },
                { data: 'status_id', name: 'status_id' },
                { data: 'address', name: 'address' },
                { data: 'date', name: 'date' },
                { data: 'note', name: 'note' },
                { data: 'action', name: 'action' }
            ]
        });
        setTimeout(function () {
            $(deliveryTable).removeAttr('style');
        }, 300);
    };

    const ajaxSuccessDelivery = function ($response) {
        toast('Thêm mới thành công', 'success');
        deliveryDatatable.ajax.reload();
        $(modalDelivery).modal('hide');
    };

    // Feedback
    const storeFeedback = function () {
        $(btnFeedback).off().on('click', function () {
            const form = $(this).closest(modalFeedback).find(formFeedback);
            const sale_id = $(containerSaleId).data('sale-id');
            const content = form.find('textarea[name="content"]').val();
            const date = form.find('input[name="date"]').val();
            const customer_id = $(containerSaleId).data('customer_id');

            const param = {
                sale_id, content, customer_id, date
            };

            const url = $(this).data('route');
            callAjax(url, 'POST', param, ajaxSuccessFeedback)

        });
    };

    const initDatatableFeedback = function () {
        feedbackDatatable = $(feedbackTable).DataTable({
            processing: true,
            serverSide: true,
            ajax: $(feedbackTable).data('datatable'),
            columns: [
                { data: 'id', name: 'id' },
                { data: 'date', name: 'date' },
                { data: 'content', name: 'content' },
                { data: 'action', name: 'action' }
            ]
        });
        setTimeout(function () {
            $(feedbackTable).removeAttr('style');
        }, 300);
    };

    const ajaxSuccessFeedback = function ($response) {
        toast('Thêm mới thành công', 'success');
        feedbackDatatable.ajax.reload();
        $(modalFeedback).modal('hide');
    };

    const onProductRemove = function() {
        $(document).on("click", productRemove, function() {
            const parent = $(this).closest('.item-product');
            const amount = parseInt(parent.find('.product-total-real').attr('data-real'));
            const currentTotalAmount = parseInt($(listGroup).find('.total-money').data('total-money'));
            const totalAmount = currentTotalAmount - amount;
            $(listGroup).find('.total-money').data('total-money', totalAmount).html(totalAmount);
            $('.money-down').trigger( "change" );
            const productId = parent.attr('data-product-id');
            $('#option' + productId).show();
            $('#select-product').prop('selectedIndex',-1);
            parent.remove();
        });
    }

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

jQuery(document).ready(function() {
    //init functions Table
    EOfficeCRMSale.init();
});

