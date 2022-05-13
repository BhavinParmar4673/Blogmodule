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
            data: "category",
            orderable: false,
            searchable: false
        },
        {
            data: "author",
            orderable: false,
            searchable: false
        },
        {
            data: "created_at"
        },
        {
            data: "status"
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

$(".status").select2({
    theme: "bootstrap4"
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

var categoryurl = $("#category").data("url");
$(".multiple-category").select2({
    ajax: {
        dataType: "json",
        url: categoryurl,
        type: "get",
        delay: 250,
        data: function(params) {
            return {
                search: params.term // search term
            };
        },
        processResults: function(data, page) {
            return {
                results: data
            };
        }
    },
    width: "100%"
});

var tagurl = $("#tag").data("url");
$(".multiple-tag").select2({
    ajax: {
        dataType: "json",
        url: tagurl,
        type: "get",
        delay: 250,
        data: function(params) {
            return {
                search: params.term // search term
            };
        },
        processResults: function(data, page) {
            return {
                results: data
            };
        }
    },
    width: "100%"
});

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
                console.log("Error:", data);
                toastr.error(data);
            }
        });
    }
});

//  client-side validation
$("#post-from").validate({
    errorPlacement: function(error, e) {
        //error display below div
        e.parents(".form-group").append(error);
    },
    rules: {
        title: "required",
        description: "required",
        "tags[]": {
            required: true
        },
        "categorys[]": {
            required: true
        }
    },
    messages: {
        title: "Please Enter Post Title",
        description: "Please enter Post description",
        "tags[]": {
            required: "Tag must be required"
        },
        "categorys[]": {
            required: "category must be required"
        }
    }
});

var element = $(".message");
setTimeout(function() {
    element.hide();
}, 5000);
