var table = $("#roles").DataTable({
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/role/list",
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

function createRole(e) {
    addLoader(e);
    $.ajax({
        url: base_url + "/role/create",
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


function editRole(e, id) {
    addLoader(e);
    $.ajax({
        url: base_url + "/role/" + id + "/edit",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Edit Role");
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

function visiblityPopup(e, role_id, status) {
    $.ajax({
        url: base_url + "/roles/" + role_id + "/" + status,
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Visible");
            $("#commonModalContent").html($response.data);
            showDiv(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);
        }
    });
}
