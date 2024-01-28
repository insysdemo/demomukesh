var table = $("#example").DataTable({
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "searching": false,
     "paging": true,
     "info": true,
     "bLengthChange": true,
    "order": [0, 'desc'],
    "bDestroy": true,
    "ajax": {
        "url": base_url + "/role-has-permission/list",
        "dataType": "json",
        "type": "POST",
        data: function (data) {
            data._token = token;
        }
    },
    columnDefs: [{
        "targets": [0, 3],
        "orderable": false
    }]
});


function editrolehaspermission(e, id) {
    // addLoader(e);
    $.ajax({
        url: base_url + "/role-has-permission/" + id + "/edit",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display",'block');
            $("#commonModalHeader").html("Edit Access");
            $("#commonModalContent").html($response);
            showDiv(e);
            removeLoader(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);
            removeLoader(e);
        }
    });
}

