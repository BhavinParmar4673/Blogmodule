@extends('admin.layouts.master')
@section('title', 'Testimonial')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Testimonial</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.create') }}">New
                                    Testimonial</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data"
                    id="testimonial-form">
                    @csrf
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-md-9">
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
                                    <h4>Testimonial</h4>
                                    {{-- <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Testimonial</a></li>
                                </ul> --}}
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="form-group">
                                                <label for="Title">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    value="{{ old('title') }}">
                                            </div>
                                            <a href="javascript:void(0)" id="checkslug"
                                                data-url="{{ route('admin.checkslug') }}"></a>
                                            <p class="slug h5" id="slug"></p>

                                            <div class="form-group">
                                                <label for="Content">Content</label>
                                                <textarea class="ckeditor form-control" placeholder="Enter Content" name="content" id="content"
                                                    rows="4">{{ old('content') }}</textarea>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    Add Client Deatail
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="fullname">Client Full Name</label>
                                            <input type="text" name="fullname" class="form-control"
                                                value="{{ old('fullname') }}" id="fullname">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Client Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" id="email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="url">Client Website Url</label>
                                            <input type="text" name="url" value="{{ old('url') }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="designation">Client Designation</label>
                                            <input type="designation" name="designation" value="{{ old('designation') }}"
                                                class="form-control" id="designation">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <div class="d-flex">
                                        <button type="submit" name="submit" value="save"
                                            class="btn btn-info text-white pt-2">
                                            <i class="fas fa-plus-circle"></i> Create Testimonial
                                        </button>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Visibility <span
                                            class="text-danger">*</span></h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="checkbox" name="visible" data-bootstrap-switch data-size="small"
                                            data-off-color="danger" data-on-color="success">
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title text-primary mb-0">Image <span class="text-danger">*</span>
                                    </h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <input type="file" name="file" id="image" class="required"
                                                accept="image/*">
                                        </div>
                                        <div>
                                            <img src="https://via.placeholder.com/120x80.png" alt="preview image"
                                                style="width:120px;">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @push('script')
        <script src="{{ asset('js/testimonial.js') }}"></script>
    @endpush

@endsection
