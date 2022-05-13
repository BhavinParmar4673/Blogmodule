@extends('admin.layouts.master')
@section('title', 'setting')
@section('css')
    <style type="text/css">
        .page-header .page-header-title i {
            float: left;
            width: 40px;
            height: 40px;
            border-radius: 5px;
            margin-right: 15px;
            vertical-align: middle;
            font-size: 22px;
            color: #fff;
            display: inline-flex;
            -webkit-justify-content: center;
            -moz-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
            -ms-flex-pack: center;
            -webkit-align-items: center;
            -moz-align-items: center;
            -ms-align-items: center;
            align-items: center;
            -webkit-box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
            -moz-box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
            box-shadow: 0 2px 12px -3px rgba(0, 0, 0, 0.5);
        }

        .settings li {
            font-size: 18px;
            font-weight: 400;
        }

        .settings li i {
            padding-right: 15px;
        }

    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">

                    @include('admin.settings.sidebar', [
                        'heading' => 'Setting',
                        'description' => 'Here you can define all the information about tour site ',
                    ])

                    <div class="col-sm-12 col-md-8 mb-5">
                        <form action="{{ route('admin.settings.store') }}" id="settingsForm" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <x-card>
                                <div class="row ">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="store_name">Store name <span
                                                    class="text-danger">*</span> </label>
                                            <input required id="store_name"
                                                value="{{ $setting->response->store_name ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="store_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="email">Email <span
                                                    class="text-danger">*</span></label>
                                            <input required id="email" class="form-control form-control-solid"
                                                value="{{ $setting->response->email ?? '' }}" type="text" name="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="contact">Contact Us <span
                                                    class="text-danger">*</span></label>
                                            <input required id="contact" value="{{ $setting->response->contact ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="contact">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="country">Country <span
                                                    class="text-danger">*</span></label>
                                            <input required id="country" value="{{ $setting->response->country ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="country">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="state">State <span
                                                    class="text-danger">*</span></label>
                                            <input required id="state" value="{{ $setting->response->state ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="state">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="city">City <span
                                                    class="text-danger">*</span></label>
                                            <input required id="city" value="{{ $setting->response->city ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="city">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="postal_code">Postal code
                                                <span class="text-danger">*</span></label>
                                            <input required id="postal_code"
                                                value="{{ $setting->response->postal_code ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="postal_code">
                                        </div>
                                    </div>



                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="address">Address</label>
                                            <textarea class="form-control form-control-solid" name="address" id="address"
                                                rows="4">{{ $setting->response->address ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="copyrights">Copyright <span
                                                    class="text-danger">*</span></label>
                                            <input required id="copyrights"
                                                value="{{ $setting->response->copyrights ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="copyrights">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="d-flex flex-column">
                                            <div class="form-group">
                                                <label>Logo</label>
                                                <input type="file" name="logo" id="logo" accept="image/*"
                                                    style="display:none;">
                                            </div>
                                            <label for="logo"> <img
                                                    src="{{ $setting->logo ?? 'https://via.placeholder.com/120x80.png' }}"
                                                    alt="preview image" style="width:120px;"></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" style="border-left:1px solid black;">
                                        <div class="d-flex flex-column">
                                            <div class="form-group">
                                                <label>Favicon</label>
                                                <input type="file" name="favicon" id="favicon" accept="image/*"
                                                    style="display:none;">
                                            </div>
                                            <label for="favicon"> <img
                                                    src="{{ $setting->favicon ?? 'https://via.placeholder.com/120x80.png' }}"
                                                    alt="preview image" style="width:120px"></label>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <h5 class="pl-2 mb-3">Website Content</h5>
                                    <br />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="content">Content <span
                                                    class="text-danger">*</span></label>
                                            <input required value="{{ $setting->response->content ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="content">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="content">Lead Description
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-solid" name="lead_description" required
                                                rows="3">{{ $setting->response->lead_description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <h5 class="pl-2 mb-3">SEO</h5>
                                    <br />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="title">Meta Title <span
                                                    class="text-danger">*</span></label>
                                            <input required id="title" value="{{ $setting->response->title ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="title">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="keyword">Meta Keyword <span
                                                    class="text-danger">*</span></label>
                                            <input required id="keyword" value="{{ $setting->response->keyword ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="keyword">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="description">Meta Description
                                                <span class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-solid" name="description" id="description" required
                                                rows="3">{{ $setting->response->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <div class="row">
                                    <h5 class="pl-2 mb-3">Section Title and Tagline</h5>
                                    <br />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="title">Service Title <span
                                                    class="text-danger">*</span></label>
                                            <input required value="{{ $setting->response->service_title ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="service_title">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3" for="title">Plan Title <span
                                                    class="text-danger">*</span></label>
                                            <input required value="{{ $setting->response->plan_title ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="plan_title">
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <div class="row">
                                    <h5 class="pl-2 mb-3">API AUTH KEY</h5>
                                    <br />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3"
                                                for="description">NOCAPTCHA_SECRET
                                                <span class="text-danger">*</span></label>
                                            <input required value="{{ $setting->response->captcha_secret ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="captcha_secret">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label fs-6 fw-bolder mb-3"
                                                for="description">NOCAPTCHA_SITEKEY <span
                                                    class="text-danger">*</span></label>
                                            <input required value="{{ $setting->response->captcha_sitekey ?? '' }}"
                                                class="form-control form-control-solid" type="text" name="captcha_sitekey">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <h5 class="pl-2 mb-3">Social Link</h5>
                                    <br />
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
                                            <input class="form-control" type="text" name="facebook"
                                                value="{{ $setting->response->facebook ?? '' }}"
                                                placeholder="Recipient's text" aria-label="Recipient's ">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                            <input class="form-control"
                                                value="{{ $setting->response->instagram ?? '' }}" type="text"
                                                name="instagram" placeholder="Recipient's text" aria-label="Recipient's ">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                            <input class="form-control" type="text" name="whatsapp"
                                                value="{{ $setting->response->whatsapp ?? '' }}"
                                                placeholder="Recipient's text" aria-label="Recipient's ">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                                            <input class="form-control" type="text" name="linkedin"
                                                value="{{ $setting->response->linkedin ?? '' }}"
                                                placeholder="Recipient's text" aria-label="Recipient's ">
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
                        error.appendTo(element.parent()).addClass('text-danger');
                    }
                });
            });
        </script>
    @endpush

@endsection
