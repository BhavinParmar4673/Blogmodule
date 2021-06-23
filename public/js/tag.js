
var dburl = $('#index').data('url');
var table = $("#example1").DataTable({
    processing: true,
    serverSide: true,
    ajax: dburl,
    columns: [{
        data: 'id'
    },
    {
        data: 'name'
    },
    {
        data: 'action',
        orderable: false,
        searchable: false
    }
    ]
});

//common function for add or update category 
function sendMyAjax(URL_address, data, form, modal) {
    $.ajax({
        type: 'POST',
        url: URL_address,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            form.trigger("reset");
            modal.modal('hide');
            table.draw();
            toastr.success(data.success)
        },
        error: function (data) {
            console.log('Error:', data);
            var arr = data.responseJSON.errors;
            $.each(arr, function (index, value) {
                toastr.error(value+ '<br>')
            });
        }
    });
};

//modal close or hover reset formdata
$('#modal-tag').on('hide.bs.modal', function (e) {
    $('#form-data').trigger("reset");
    $('#error').text('');
});

//add category 
$('body').on('click', '#createtag', function () {
    $('#tag_id').val('');
    $('#modal-tag').modal('show');
});

$('body').on('submit', '#form-data', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var form_action = $("#form-data").attr("action");
    var form = $('#form-data');
    var modal = $('#modal-tag');
    sendMyAjax(form_action, formData, form, modal);
});

//update category
$('body').on('click', '.edit', function () {
    var url = $(this).data('url');
    $.get(url, function (data) {
        $('#modal-tag-edit').modal('show');
        $('#tag_id').val(data.id);
        $('#tag-edit').val(data.name);
    });
});

$('body').on('submit', '#form-data-edit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var form_action = $("#form-data-edit").attr("action");
    var form = $('#form-data-edit');
    var modal = $('#modal-tag-edit');
    sendMyAjax(form_action, formData, form, modal);
});

//delete a category  
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
                toastr.error(data)
            }
        });
    }
});

//  client-side validation
$('#form-data').validate({
    rules: {
        tag: "required",
    },
    messages: {
        tag: "Please Enter Tag name",
    }
});