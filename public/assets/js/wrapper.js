const resultAlert = $('#result-alert')

$(document).on('click', '.btn-delete', function(){
    let btnDelete = confirm("Are you sure you want to delete?");
    let urlDelete = $(this).attr('data-link')
    if (btnDelete){
        $(this).parents('tr').remove()
        ajaxHandler(urlDelete, 'DELETE')
        .then(data => {
            if(data.status){
                toast(data.msg, "success")
            }
            else
                toast(data.msg, "error")
        })
        .catch(error => alert('Error:', error));
    }else
        return false;
})

function ajaxHandler(url, method ="GET" , data = {}){
    return $.ajax({
        url: url,
        method: method,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
}

function toast(msg, status){
    return $.toast({
        heading: 'Thông báo',
        text: msg,
        position: 'top-right',
        loaderBg: status == 'success' ? '#ff6849': '#ff6849',
        icon: status,
        hideAfter: 3500,
        stack: 6
    });
}
