var EOfficeForm = function () {

    const select2 = ".select2";

    const userGroupName = 'user_group_id';

    const initSelect2 = function() {
        if ($(select2).length > 0) {
            $(select2).select2();
        }
    }

    const _callAjax = function (url, method, params = {}, callbackSuccess = null, callbackError = null) {
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

    const getUserInGroup = function () {
        $('select[name="user_group_id"]').on('change', function () {
            const id = $('select[name="user_group_id"] option:selected').val();
            _callAjax('/config/hrm/employeegroup/user/' + id, 'GET', {}, getUserInGroupSuccess);
        });
    };

    const getUserInGroupSuccess = function ($response) {
        $('select[name="in_charge_id"]').find('option').remove();
        $.each( $response, function( key, value ) {
            $('select[name="in_charge_id"]').append($('<option>', {
                value: key,
                text : value
            }));
        });
    }


    return {

        init: function init() {
            initSelect2();
            getUserInGroup();
        },

        _callAjax: function (
            url, method, params = {}, callbackSuccess = null, callbackError = null) {
            _callAjax(url, method, params, callbackSuccess, callbackError);
        }
    };
}();

jQuery(document).ready(function() {
    //init functions Table
    EOfficeForm.init();
});

module.exports = EOfficeForm;