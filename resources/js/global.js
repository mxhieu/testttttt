(function($) {
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle ajax error
        $(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {

            if (xhr.status === 505) {
                return window.location.href = "/";
            }
        });

        // handle finish ajax calls
        $(document).ajaxStop(function(){
            $('.tooltips').tooltip();
        });

    });
}) (jQuery)
