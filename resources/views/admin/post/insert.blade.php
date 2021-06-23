@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item">{{ Auth::guard('admin')->user()->name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title mb-2">Create Blog</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="post-from">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="Title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title"
                                    value="{{ old('title') }}">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('file') ? 'has-error' : '' }}">
                                <label for="Image">Image</label>
                                <input type="file" accept="image/*" class="form-control-file required" name="file"
                                    id="file">
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="Content">Content</label>
                            <textarea class="form-control" placeholder="Enter Content" name="content" id="Content"
                                rows="4">{{ old('content') }}</textarea>
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Category">Category</label>
                                <select class="form-control" id="Category" name="category">
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Project">Projects</label>
                                <select class="form-control" id="Category" name="project">
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->title }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                </form>
            </div>
        </section>
    </div>


    @push('script')
        <script src="{{ asset('js/post.js') }}"></script>
    @endpush


@endsection
