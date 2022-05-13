@extends('admin.layouts.master')
@section('title', 'Edit About Us')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-7">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-6">
                                <h1>Edit About US</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                    {{-- <li class="breadcrumb-item"><a
                                            href="{{ route('admin.about-us.edit', ['about_u' => $about->id]) }}">Edit
                                            About Us</a></li> --}}
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
                    <form action="{{ route('admin.about-us.update', ['about_u' => $about->id]) }}" method="POST"
                        id="form-data">
                        @csrf
                        @method('put')
                        <x-card>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Heading <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="heading" id="heading" value="{{ $about->heading ?? '' }}"
                                            required class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Video URl <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="file" id="file" value="{{ $about->file ?? '' }}" required
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form-label fs-6 fw-bolder mb-3">Content </label>
                                        <textarea class="form-control" name="content" id="content" rows="6">{{ $about->content ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </x-card>
                        <div class="form-group d-flex justify-content-end">
                            <x-button href="{{ route('admin.about-us.index') }}" class="btn btn-danger m-2 mx-2"
                                variant="link">
                                Cancel
                            </x-button>
                            <x-button type="submit" class="btn btn-primary m-2">Update</x-button>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    @push('script')
        <script type="text/javascript">
            CKEDITOR.replace('content', {
                filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
        <script src="{{ asset('js/about.js') }}"></script>
    @endpush
@endsection
