var table = $("#user").DataTable({
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/user/list",
        "dataType": "json",
        "type": "POST",
        data: function (data) {
            data._token = token;
        }
    },
    columnDefs: [{
        "targets": [0],
        "orderable": false
    }]
});



function createUser(e) {
    addLoader(e);
    $.ajax({
        url: base_url + "/user/create",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Add Roles");
            $("#commonModalContent").html($response);
            removeLoader(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);

        }
    });
}
