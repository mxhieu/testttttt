var EOfficeCRMUtil = function () {

    const deleteItem = ".delete-item"
    const modalDeleteItem = "#modal-delete-item"
    /**
     * Open popup company table vs handle checkbox
     */
    const showModalDelete = function() {
        $(deleteItem).off('click').on('click', function () {
            $(modalDeleteItem).find('form').attr('action', $(this).data('href'))
            $(modalDeleteItem).modal('show');
        });
    }

    return {
        init: function init() {
            showModalDelete();
        }
    };
}();

jQuery(document).ready(function() {
    //init functions Table
    EOfficeCRMUtil.init();
});

