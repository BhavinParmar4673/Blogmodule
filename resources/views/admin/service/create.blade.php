@extends('admin.layouts.master')
@section('title', 'Testimonial')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-7">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-6">
                                <h1>Add New Service</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.service.create') }}">New
                                            Service</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-sm-12 col-md-7">
                    <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data"
                        id="service-form">
                        @csrf
                        <x-card>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Service Title<span
                                                class="text-danger">*</span></label>
                                        <input type="text" data-rule-remote="{{ route('admin.service.exists') }}"
                                            data-msg-remote="Title already in use" name="title" id="title"
                                            value="{{ old('title') }}" required class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="javascript:void(0)" id="slugurl"
                                            data-url="{{ route('admin.checkslug') }}"></a>
                                        <label class="form-label fs-6 fw-bolder mb-3">Slug <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="slug" required id="slug"
                                            class="form-control form-control-solid" value="{{ old('slug') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Description <span
                                                class="text-danger">*</span></label>
                                        <textarea name="description" id="description" rows="3" required class="form-control form-control-solid"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <input type="file" name="file" id="image" accept="image/*">
                                        </div>
                                        <img src="https://via.placeholder.com/120x80.png" alt="preview image"
                                            style="width:120px;">
                                    </div>
                                </div>
                            </div>
                        </x-card>
                        <div class="form-group d-flex justify-content-end">
                            <x-button href="{{ route('admin.service.index') }}" class="btn btn-danger m-2 mx-2"
                                variant="link">
                                Cancel
                            </x-button>
                            <x-button type="submit" class="btn btn-primary m-2">Save</x-button>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    @push('script')
        <script src="{{ asset('js/service.js') }}"></script>
    @endpush
@endsection
