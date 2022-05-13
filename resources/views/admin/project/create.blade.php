@extends('admin.layouts.master')
@section('title', 'Create Project')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-7">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-6">
                                <h1>Add New Project</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.create') }}">New
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
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data"
                        id="form-data">
                        @csrf
                        <x-card>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Project Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" data-rule-remote="{{ route('admin.projects.exists') }}"
                                            data-msg-remote="Title already in use" name="title" id="title"
                                            value="{{ old('title') }}" required class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Project Client <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="client" id="client" value="{{ old('client') }}" required
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Project URL <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="url" id="url" value="{{ old('url') }}" required
                                            URL="true" class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="category">Select Category</label>
                                        <select name="cat_id" required data-control="select2"
                                            data-placeholder="Select a Category..." id="category"
                                            class="form-select form-select-solid form-select-lg fw-bold">
                                            <option value="">Select a Category...</option>
                                            @foreach ($category as $key => $list)
                                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="multipleselect">Tag</label>
                                        <select class="multiple-tag" data-url="{{ route('admin.blogtag') }}"
                                            name="tags[]" id="multipleselect" data-placeholder="select Tag"
                                            data-dropdown-css-class="select2-purple" multiple="multiple">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Brief</label> <span
                                            class="text-danger">*</span></label>
                                        <textarea name="brief" id="brief" rows="3" required
                                            class="form-control form-control-solid">{{ old('brief') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form-label fs-6 fw-bolder mb-3">Description </label>
                                        <textarea class="form-control" name="description" id="description" rows="6">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <label for="form-label fs-6 fw-bolder mb-3">Project Image</label><br>
                                            <input type="file" name="file" id="image" accept="image/*">
                                        </div>
                                        <img src="https://via.placeholder.com/120x80.png" alt="preview image"
                                            style="width:120px;">
                                    </div>
                                </div>

                                <div class="col-md-12 my-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Multiple Image</label>
                                        <div class="input-images"></div>
                                    </div>
                                </div>
                            </div>
                        </x-card>
                        <div class="form-group d-flex justify-content-end">
                            <x-button href="{{ route('admin.projects.index') }}" class="btn btn-danger m-2 mx-2"
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
        <script type="text/javascript">
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        </script>
        <script src="{{ asset('js/project.js') }}"></script>
    @endpush
@endsection
