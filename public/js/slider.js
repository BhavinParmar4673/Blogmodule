
var dburl = $('#index').data('url');
var table = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    ajax: dburl,
    columns: [{
        data: 'id'
    },
    {
        data: 'heading'
    },
    {
        data: 'image',
        orderable: false,
        searchable: false
    },
    {
        data: 'status',
    },
    {
        data: 'operations',
        orderable: false,
        searchable: false
    }
    ]
});

$('body').on('click', '.delete', function () {
    var url = $(this).data("url");
    if (confirm("Delete Record?") == true) {
        $.ajax({
            type: "DELETE",
            url: url,
            success: function (data) {
                table.draw();
                toastr.error(data.success)
            },
            error: function (data) {
                console.log('Error:', data);
                toastr.error(data)
            }
        });
    }
});



//  client-side validation
$('#slider-from').validate({
    rules: {
        heading: "required",
        description:"required",
        link: {
            required: true,
            url: true
        },
        linkname:"required",
    },
    messages: {
        heading: "Please Enter Heading",
        description:"Please Enter Description",
        link: {
            required: "Plese Enter Link Url Adress",
            url: "Please enter a valid Link URL"
        },
        linkname:"Please Enter Link name",

    }
});

var element = $(".message");
setTimeout(function() {
   element.hide();
  }, 5000);

