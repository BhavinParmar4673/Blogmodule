<x-theme-app-layout :title="$title">

    @include('theme.partial.about')

    @include('theme.partial.service')

    @include('theme.partial.portfolio')

    @include('theme.partial.contact')

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    </x-slot>
    <x-slot name="javascript">
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery(document).ready(function($) {
                $("#contact-form").on('submit', function(e) {
                    e.preventDefault();
                    const form = $('#contact-form');
                    var formData = new FormData(this);
                    var form_action = form.data("url");
                    $.ajax({
                            type: "POST",
                            url: form_action,
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                        }).always(function(respons) {})
                        .done(function(respons) {
                            form.trigger("reset");
                            $('#success').show();
                            $('#success').html(respons.success);
                            setTimeout(function() {
                                $('#success').hide();
                            }, 5000);
                        })
                        .fail(function(respons) {
                            console.log(respons);
                            // var err = respons.responseJSON.error;
                            // $('#error').show();
                            // $('#error').html(err);
                            // setTimeout(function() {
                            //     $('#error').hide();
                            // }, 5000);
                        });
                });
                $("#contact-form").validate({
                    errorClass: 'text-danger',
                    rules: {}
                });
            });
        </script>
    </x-slot>
</x-theme-app-layout>
