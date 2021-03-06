var dburl = $("#index").data("url");
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
            data: "title"
        },
        {
            data: "created_at"
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
$("#testimonial-form").validate({
    errorPlacement: function(error, e) {
        //error display below div
        e.parents(".form-group").append(error);
    },
    rules: {
        title: "required",
        fullname: "required",
        email: {
            required: true,
            email: true
        },
        url: {
            required: true,
            url: true
        },
        designation: "required"
    },
    messages: {
        fullname: "Please Enter Client Full Name",
        email: {
            required: "Plese Enter Client Email Adress",
            email: "Please enter a valid email address."
        },
        url: {
            required: "Plese Enter Client Url Adress",
            url: "Please enter a valid URL"
        },
        designation: "Please Enter Client Designation"
    }
});

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

$("[name='visible']").bootstrapSwitch();

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
