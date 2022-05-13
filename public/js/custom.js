var table = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    stateSave: true,
    lengthMenu: [10, 25, 50],
    responsive: true,
    ajax: {
        url: $("#index").data("url"),
        dataType: "json",
        type: "POST",
        data: function(d) {
            return $.extend({}, d, {});
        }
    },
    columns: [
        {
            data: "id"
        },
        {
            data: "name"
        },
        {
            data: "status",
            orderable: false,
            searchable: false
        },
        {
            data: "image",
            orderable: false,
            searchable: false
        },
        {
            data: "action",
            orderable: false,
            searchable: false
        }
    ]
});

//common function for add or update category
function sendMyAjax(URL_address, data, form, modal) {
    $.ajax({
        type: "POST",
        url: URL_address,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            form.trigger("reset");
            modal.modal("hide");
            table.draw();
            toastr.success(data.success);
        },
        error: function(data) {
            var arr = data.responseJSON.errors;
            $.each(arr, function(index, value) {
                toastr.error(value + "<br>");
            });
        }
    });
}

//modal close or hover reset formdata
$("#modal-category").on("hide.bs.modal", function(e) {
    $("#form-data").trigger("reset");
    $("#error").text("");
});

//add category
$("body").on("click", "#createcategory", function() {
    $("#cat_id").val("");
    $("#modal-category").modal("show");
    $("#modal-category").on("hide.bs.modal", function(e) {
        $(".mydiv img").attr(
            "src",
            "https://www.riobeauty.co.uk/images/product_image_not_found.gif"
        );
    });
});

$("body").on("submit", "#form-data", function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var form_action = $("#form-data").attr("action");
    var form = $("#form-data");
    var modal = $("#modal-category");
    sendMyAjax(form_action, formData, form, modal);
});

//update category
$("body").on("click", ".edit", function(e) {
    e.preventDefault();
    var url = $(this).data("url");
    $.get(url, function(data) {
        $("#modal-category-edit").modal("show");
        $("#cat_id").val(data[0].id);
        $("#category-edit").val(data[0].name);
        $("#description-edit").val(data[0].description);
        $('input[type="file"]')
            .closest("div")
            .after('<img src="' + data[1].image + '" width="120px"/>');
    });
    $("#modal-category-edit").on("hide.bs.modal", function(e) {
        $('input[type="file"]')
            .closest("div")
            .next()
            .remove();
    });
});

$("body").on("submit", "#form-data-edit", function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var form_action = $("#form-data-edit").attr("action");
    var form = $("#form-data-edit");
    var modal = $("#modal-category-edit");
    sendMyAjax(form_action, formData, form, modal);
});

//delete a category
$("body").on("click", ".delete", function() {
    var url = $(this).data("url");
    if (confirm("Delete Record?") == true) {
        $.ajax({
            type: "DELETE",
            url: url,
            success: function(data) {
                table.draw();
                toastr.error(data.success);
            },
            error: function(data) {
                toastr.error(data);
            }
        });
    }
});

//  client-side validation
$("#form-data").validate({
    rules: {
        category: "required",
        description: "required"
    }
});

$("#form-data-edit").validate({
    debug: false,
    ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
    rules: {
        tag: {
            category: true,
            remote: {
                url: $("#category-edit").data("rule-remote"),
                type: "get",
                data: {
                    cat_id: function(el) {
                        return $("#cat_id").val();
                    }
                }
            }
        }
    }
});
