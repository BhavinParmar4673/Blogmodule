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
            data: "status"
        },
        {
            data: "image"
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

var slugurl = $("#checkslug").data("url");
$("body").on("change", "#title", function() {
    $.get(
        slugurl,
        {
            title: $(this).val()
        },
        function(data) {
            $("#slug").text("Slug : " + "" + data.slug);
        }
    );
});

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
                table.draw();
                toastr.error(data.success);
                // location.reload();
            },
            error: function(data) {
                toastr.error(data);
            }
        });
    }
});

var slugurl = $("#slugurl").data("url");
$("body").on("change", "#title", function() {
    $.get(
        slugurl,
        {
            title: $(this).val()
        },
        function(data) {
            $("#slug").val(data.slug);
        }
    );
});
