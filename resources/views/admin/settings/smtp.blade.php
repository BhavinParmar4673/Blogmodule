@extends('admin.layouts.master')
@section('title', 'Smtp Setting')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    @include('admin.settings.sidebar', [
                        'heading' => 'SMTP Setting',
                        'description' => 'Here you can define all the
                                                                                                                        information about your smtp details',
                    ])
                    <div class="col-sm-12 col-md-8 ">
                        <form action="{{ route('admin.smtp.store') }}" id="settingsForm" method="post">
                            @csrf
                            <x-card>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3">Mail Host</label>
                                            <input type="text" name="mail_host" id="mail_host"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_host }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3">Mail Port</label>
                                            <input type="text" name="mail_port" id="mail_port"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_port }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3">Mail Username</label>
                                            <input type="text" name="mail_username" id="mail_username"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_username }}">
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" class="control-label">Mail
                                                Password</label>
                                            <input type="password" name="mail_password" id="mail_password"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_password }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" class="control-label">Mail
                                                Encryption</label>
                                            <select class="form-control form-control-solid" name="mail_encryption"
                                                id="mail_encryption">
                                                <option
                                                    {{ optional($setting->response)->mail_encryption == 'tls' ? 'selected' : '' }}>
                                                    tls
                                                </option>
                                                <option
                                                    {{ optional($setting->response)->mail_encryption == 'ssl' ? 'selected' : '' }}>
                                                    ssl
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" class="control-label">Mail From
                                                Name</label>
                                            <input type="text" name="mail_from_name" id="mail_from_name"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_from_name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" class="control-label">Mail From
                                                Email</label>
                                            <input type="text" name="mail_from_email" id="mail_from_email"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_from_email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" class="control-label">BCC</label>
                                            <input type="text" name="mail_bcc" id="mail_bcc"
                                                class="form-control form-control-solid"
                                                value="{{ optional($setting->response)->mail_bcc }}">
                                        </div>
                                    </div>
                                </div>
                            </x-card>
                            <div class="form-group d-flex justify-content-end">
                                <x-button href="{{ route('admin.home') }}" class="btn btn-danger my-4 mx-2"
                                    variant="link">
                                    Cancel
                                </x-button>
                                <x-button type="submit" class="btn btn-primary my-4">Save</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#settingsForm').validate({
                    debug: false,
                    ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                    errorPlacement: function(error, element) {
                        // $(element).addClass('is-invalid')
                        error.appendTo(element.parent()).addClass('text-danger');
                    }
                });
            });
        </script>
    @endpush
@endsection
