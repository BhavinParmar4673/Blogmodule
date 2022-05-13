@extends('admin.layouts.master')
@section('title', 'Edit Project')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-7">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-6">
                                <h1>Edit Project</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.projects.edit', $project->id) }}">Edit
                                            Project</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-sm-12 col-md-7">
                    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST"
                        enctype="multipart/form-data" id="form-data">
                        @csrf
                        @method('PATCH')
                        <x-card>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Project Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            data-rule-remote="{{ route('admin.projects.exists', ['id' => $project->id]) }}"
                                            data-msg-remote="Title already in use" name="title" id="title"
                                            value="{{ $project->title ?? '' }}" required
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Project Client <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="client" id="client" value="{{ $project->client ?? '' }}"
                                            required class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Project URL <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="url" id="url" value="{{ $project->website ?? '' }}"
                                            required URL="true" class="form-control form-control-solid">
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
                                                <option value="{{ $list->id }}"
                                                    {{ $list->id == $project->category_id ? 'selected' : '' }}>
                                                    {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="multipleselect">Tag</label>
                                        <select class="multiple-tag" data-url="{{ route('admin.blogtag') }}"
                                            name="tags[]" id="multipleselect" data-placeholder="select Tag"
                                            data-dropdown-css-class="select2-primary" multiple="multiple">
                                            @foreach ($project->tags as $tag)
                                                <option value={{ $tag->id }} selected>{{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Brief</label> <span
                                            class="text-danger">*</span></label>
                                        <textarea name="brief" id="brief" rows="3" required
                                            class="form-control form-control-solid">{{ $project->brief ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form-label fs-6 fw-bolder mb-3">Description </label>
                                        <textarea class="form-control" name="description_view" id="description"
                                            rows="6">{{ $project->view_more ?? '' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <label for="form-label fs-6 fw-bolder mb-3">Project Image</label><br>
                                            <input type="file" name="project_file" id="image" accept="image/*">
                                        </div>
                                        <img src="{{ $project->image }}" alt="preview image" style="width:120px;">
                                    </div>
                                </div>

                                <div class="col-md-12 my-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Multiple Image</label>
                                        <div class="input_images"></div>
                                    </div>
                                </div>
                            </div>
                        </x-card>
                        <div class="form-group d-flex justify-content-end">
                            <x-button href="{{ route('admin.service.index') }}" class="btn btn-danger m-2 mx-2"
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
        <script>
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{ route('admin.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
            @if (isset($project) && $project->photo)
                var myVariable = @json($project->photo->toArray());
                let preloaded = [];
                $.each(myVariable, function(key, value) {
                    preloaded.push({
                        id: value.id,
                        src: value.original_url
                    });
                });
            @endif
            $('.input_images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 5
            });
        </script>
        <script src="{{ asset('js/project.js') }}"></script>
    @endpush
@endsection
