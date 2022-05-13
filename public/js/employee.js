var table = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    stateSave: true,
    lengthMenu: [10, 25, 50],
    responsive: true,
    ajax: {
        url: $("#example1").data("url"),
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
            data: "designation"
        },
        {
            data: "qualification"
        },
        {
            data: "status",
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

//  client-side validation
$("#service-form").validate();

var element = $(".message");
setTimeout(function() {
    element.hide();
}, 5000);

//delete a category
$("body").on("click", ".delete", function() {
    var url = $(this).data("url");
    if (confirm("Delete Record?") == true) {
        $.ajax({
            type: "DELETE",
            url: url,
            success: function(data) {
                toastr.error(data.success);
                table.draw();
            },
            error: function(data) {
                toastr.error(data);
            }
        });
    }
});
