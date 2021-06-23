
var dburl = $('#index').data('url');
var table = $("#example2").DataTable({
    processing: true,
    serverSide: true,
    ajax: dburl,
    columns: [{
        data: 'id'
    },
    {
        data: 'title'
    },
    {
        data: 'description'
    },
    {
        data: 'image',
        orderable: false,
        searchable: false
    },
    {
        data: 'tag',
        orderable: false,
        searchable: false
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
        cache: false,       //Set cache = false for all jquery ajax requests by default true
        contentType: false, // use for  multipart/form-data jquery not add content type header
        processData: false, //  jQuery will try to convert your FormData into a string, which will fail.
        success: function (data) {
            form.trigger("reset");
            modal.modal('hide');
            $('.multiple-tag').val('').trigger('change');
            table.draw();
            toastr.success(data.success)
        },
        error: function (data) {
            console.log(data);
            //server-side validation
            var arr = data.responseJSON.errors;
            $.each(arr, function (index, value) {
                toastr.error(value+ '<br>')
            });
        }
    });
};
 
//modal close or hover reset formdata
$('#modal-project').on('hide.bs.modal', function (e) {
    $('#form-data').trigger("reset");
    $('.multiple-tag').val('').trigger('change');
    $('.uploaded-image').remove(); 
    $('#error').text('');
});



//add category 
$('body').on('click', '#createproject', function () {
    $('#project_id').val('');
    $('#modal-project').modal('show');
});

$('body').on('submit', '#form-data', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var form_action = $("#form-data").attr("action");
    var form = $('#form-data');
    var modal = $('#modal-project');
    sendMyAjax(form_action, formData, form, modal);
});

//update category
$('body').on('click', '.edit', function () {
    var url = $(this).data('url');
    $.get(url, function (data) {
        $('#modal-project-edit').modal('show');
        $('#project_id').val(data[0].id);
        $('#title-edit').val(data[0].title);
        $('#description-edit').val(data[0].description);
        //display selected tag
        var options = '';
        $.each(data[1], function (key, value) {
            options += '<option value="' + value.id + '" selected>' + value.name + '</option>';
            $('#project-tag').html(options);
        });
        //display uploaded image
            let preloaded = [];
            $.each(data[2], function (key, value) {
                    preloaded.push({id:value.id,src:value.image});
            });
            $('#input-images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 10
                });
    });
    $('#modal-project-edit').on('hide.bs.modal', function (e) {
        $('.image-uploader').hide();         
    });
});

$('body').on('submit', '#form-data-edit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var form_action = $("#form-data-edit").attr("action");
    var form = $('#form-data-edit');
    var modal = $('#modal-project-edit');
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


$('.input-images').imageUploader();
 

//select2 using ajax remotedata
var tagurl = $('#tag').data('url');
$('.multiple-tag').select2({
    placeholder: 'Select Tag',
    ajax: {
        dataType: 'json',
        url: tagurl,
        type:'get',
        delay: 250,
        data: function (params) {
            return {
                search: params.term // search term
            }
        },
        processResults: function (data, page) {
            return {
                results: data
            };
        },
    }, width: '100%'
});


//  client-side validation
$('#form-data').validate({
    errorPlacement: function (error, e) {           //error display below div
        e.parents('.form-group').append(error);
    },
    rules: {
        title: "required",
        description: "required",
        'tags[]': {
            required: true,
        },
        'images[]': {
            required: true,
        } 
    },
    messages: {
        title: "Please Enter Project Title",
        description: "Please enter Project Description",
        'tags[]': {
            required: "Tag must be required",
        },
        'images[]': {
            required: "Image must required",
        } 
    }
});