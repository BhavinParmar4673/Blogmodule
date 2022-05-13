var table = $("#example2").DataTable({
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
            data: "heading"
        },
        {
            data: "action",
            orderable: false,
            searchable: false
        }
    ]
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
    debug: false,
    ignore:
        'input[type="file"],.select2-search__field,:hidden:not("textarea,.files,select,#images,.ck-editor__editable"),[contenteditable="true"]:not([name])',
    errorPlacement: function(error, e) {
        e.parents(".form-group ").append(error);
    },
    rules: {
        heading: "required"
    }
});

var element = $(".message");
setTimeout(function() {
    element.hide();
}, 5000);
