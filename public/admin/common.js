var spiner = `<svg class="animate-spin mx-auto" height=15 width=15  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg>`;
var submitBtnText = "";

function showDiv(e) {
    var divID = $(e).data("target");
    $("#" + divID).toggle("slow");
}

function hideDiv(e) {
    var divID = $(e).data("dismiss");
    $("#" + divID).toggle();
    table.ajax.reload();
    // $(".modal").css("display",'block');
}

$("#commonModal").on("click", function (event) {
    if (event.target.id == "closecommonModal") {
        showDiv(this);
    }
});

function appendError(message) {
    var id = "_" + Math.random().toString(36).substr(2, 9);

    var html =
        '<div class="d-flex w-100 mx-auto bg-white  position-relative" style="overflow:hidden;border-radius: 0.5rem;z-index: 9999;"  role="alert" id="' +
        id +
        '">' +
        '<div class="d-flex align-items-center justify-content-center bg-danger" style=" width: 3rem;">' +
        '<svg xmlns="http://www.w3.org/2000/svg" style="height:24px;width:24px;" class="text-white" fill="none" viewBox="0 0 24 24"' +
        'stroke="currentColor">' +
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"' +
        'd="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />' +
        "</svg>" +
        "</div>" +
        '<div class="px-4 py-2 d-flex align-items-center" style="margin:0 -12px" >' +
        '<div class="mx-3 ">' +
        '<span class="font-semibold text-danger dark:text-danger">' +
        message +
        "</span>" +
        "</div>" +
        '<span class="top-0 bottom-0 right-0 px-4 py-2 col-span-1" onclick="showDiv(this)" data-target="' +
        id +
        '">' +
        '<svg class="text-danger" style="height:24px;width:24px;fill: currentColor;" role="button"' +
        'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">' +
        "<title>Close</title>" +
        '<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />' +
        "</svg>" +
        "</span>" +
        "</div>" +
        "</div>";
    $("#alerts").append(html);
    setTimeout(function () {
        $("#" + id).toggle("fast");
        $("#" + id).remove();
    }, 3000);
}

function appendSuccess(message) {
    var id = "_" + Math.random().toString(36).substr(2, 9);
    var html =
        '<div class="d-flex w-100 mx-auto bg-white  position-relative" style="overflow:hidden;border-radius: 0.5rem;z-index: 9999;"  role="alert" id="' +
        id +
        '">' +
        '<div class="d-flex align-items-center justify-content-center bg-success" style="width:3rem">' +
        '<svg xmlns="http://www.w3.org/2000/svg" style="height:24px;width:24px;" class="text-white" fill="none" viewBox="0 0 24 24"' +
        'stroke="currentColor">' +
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"' +
        'd="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />' +
        "</svg>" +
        "</div>" +
        '<div class="px-4 py-2 d-flex align-items-center" style="margin:0 -12px" >' +
        '<div class="mx-3 ">' +
        '<span class="font-semibold text-success dark:text-success">' +

        message +
        "</span>" +
        "</div>" +
        '<span class="top-0 bottom-0 right-0 px-4 py-2 col-span-1" onclick="showDiv(this)"' +
        'data-target="' +
        id +
        '">' +
        '<svg class="text-success" style="height:24px;width:24px;fill: currentColor;" role="button"' +
        'xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">' +
        "<title>Close</title>" +
        '<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />' +
        "</svg>" +
        "</span>" +
        "</div>";

    $("#alerts").append(html);
    setTimeout(function () {
        $("#" + id).toggle("fast");
        $("#" + id).remove();
    }, 3000);
}
function addLoader(e) {
    var button = $(e);
    submitBtnText = button.text();
    button.html(spiner).attr("disabled", "disabled");
}

function removeLoader(e) {
    var button = $(e);
    button.text(submitBtnText).attr("disabled", false);
}

function deleteModal(e) {
    addLoader(e);
    $.ajax({
        url: base_url + "/common/get_delete_modal",
        type: "post",
        data: {
            _token: token,
            url: $(e).data("url"),
            type: $(e).data("method"),
        },
        success: function ($response) {

            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Delete this record");
            $("#commonModalContent").html($response.data);
            showDiv(e);
            removeLoader(e);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);
        },
    });
}

function deleteReocrd(e) {
    addLoader(e);
    $.ajax({
        url: $(e).data("url"),
        type: $(e).data("method"),
        data: {
            _token: token,
        },
        success: function ($response) {
            appendSuccess($response.message);
            table.ajax.reload();
            removeLoader(e);
            showDiv(e);
            $("#modal").hide();
        },
        error: function ($response) {
            removeLoader(e);
            appendError($response.responseJSON.message);
        },
    });
}

$(".check-all").click(function () {
    $(".check-item").prop("checked", $(this).prop("checked"));
});

function MuldeleteModal(e) {
    addLoader(e);
    var val = [];
    $(":checkbox:checked").each(function (i) {
        if ($(this).val() != "on") {
            val[i] = $(this).val();
        }
    });
    val = val.filter((item) => item);
    if (val.length < 1) {
        appendError("Please first select record you want to Delete.");
        removeLoader(e);
    } else {
        $.ajax({
            url: base_url + "/common/get_mul_delete_modal",
            type: "post",
            data: {
                _token: token,
                url: $(e).data("url"),
                type: $(e).data("method"),
            },
            success: function ($response) {
                $('.modal').removeClass('fade');
                $(".modal").css("display", 'block');
                $("#commonModalHeader").html("Delete this record");
                $("#commonModalContent").html($response.data);
                showDiv(e);
                removeLoader(e);

            },
            error: function ($response) {
                appendError($response.responseJSON.message);
            },
        });
    }
}


function deleteMul(e) {
    addLoader(e);

    var val = [];
    $(":checkbox:checked").each(function (i) {
        if ($(this).val() != "on") {
            val[i] = $(this).val();
        }
    });
    val = val.filter((item) => item);
    if (val.length < 1) {
        appendError("Please select record you want to Delete.");
        removeLoader(e);
    } else {
        $.ajax({
            url: $(e).data("url"),
            type: $(e).data("method"),
            data: {
                ids: val,
                _token: token,
            },
            success: function ($response) {
                appendSuccess($response.message);
                table.ajax.reload();
                removeLoader(e);
                showDiv(e);
                $(".check-all").prop("checked", false);
                $("#modal").hide();

            },
            error: function ($response) {
                removeLoader(e);
                appendError($response.responseJSON.message);
            },
        });
    }
}

