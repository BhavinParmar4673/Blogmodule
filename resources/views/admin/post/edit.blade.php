@extends('admin.layouts.master')
@section('title', 'Post Edit')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a></li>
                            <a href="javascript:void(0)" id="category" data-url="{{route('admin.blogcategory')}}"></a>
                            <a href="javascript:void(0)" id="tag" data-url="{{route('admin.blogtag')}}"></a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" name="editform"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-9">
                            @if (session('message'))
                                    <div class="alert alert-success message">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="card">
                                <div class="card-header">
                                    <h4>Post</h4>
                                    {{-- <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#detail"
                                                data-toggle="tab">Post</a></li>
                                    </ul> --}}
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="detail">
                                            <div class="form-group">
                                                <label for="Title">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ $post->title }}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <a href="javascript:void(0)" id="slugurl" data-url="{{route('admin.checkslug')}}"></a>
                                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="slug" id="slug"
                                                value="{{ $post->slug }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description" id="description"
                                                    rows="4">{{ $post->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="Content">Content</label>
                                                <textarea class="ckeditor form-control" name="content" id="Content"
                                                    rows="4">{{ $post->content }}</textarea>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-md-3">
                            <!-- Profile Image -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Publish</h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="btn-set d-flex">
                                        <button type="submit" name="submit" value="save" class="btn btn-info">
                                            <i class="fa fa-save"></i> Save
                                        </button>
                                        &nbsp;
                                        <button type="submit" name="submit" value="apply" class="btn btn-success">
                                            <i class="fa fa-check-circle"></i> Save &amp; Edit
                                        </button>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Status <span class="text-danger">*</span></h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                        <div class="form-group">
                                            <select class="form-control status" name="status" style="width: 100%;">
                                                <option value="1" {{$post->status == 'Published' ? 'selected' : ''}}>Published</option>
                                                <option value="0" {{$post->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                            </select>
                                        </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Categories <span class="text-danger">*</span>
                                    </h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group select2-primary">
                                        <select class="multiple-category" name="categorys[]" id="multiplecategory"
                                        data-placeholder="Write some category"  data-dropdown-css-class="select2-primary" multiple="multiple">
                                        @foreach ($post->categorys as $category)
                                            <option value={{ $category->id }} selected>{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Image <span class="text-danger">*</span></h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <input type="file" name="file" id="image" class="required" accept="image/*">
                                        </div>
                                        <div>
                                            <img src="{{ $post->image_src }}" alt="preview image" style="width:120px;">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Tags <span class="text-danger">*</span></h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="select2-purple form-group">
                                        <select class="multiple-tag" name="tags[]" id="multipleselect" multiple="multiple"
                                        data-placeholder="Write some tags" data-dropdown-css-class="select2-purple">
                                            @foreach ($post->tags as $tag)
                                                <option value={{ $tag->id }} selected>{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </form>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>


    @push('script')
        <script src="{{ asset('js/post.js') }}"></script>
    @endpush
@endsection
