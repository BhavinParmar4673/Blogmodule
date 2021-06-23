@extends('admin.layouts.master')
@section('title', 'slide Update')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Slide</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.sliders.edit',$slider->id) }}">Edit</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.sliders.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
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
                                    <h4>Slide</h4>
                                    {{-- <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity"
                                                data-toggle="tab">Slide</a></li>
                                    </ul> --}}
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="form-group">
                                                <label for="Heading">Heading</label>
                                                <input type="text" class="form-control" name="heading" id="heading"
                                                 value="{{ $slider->heading }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control"
                                                    name="description" id="description"
                                                    rows="4">{{  $slider->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="link">Link</label>
                                                <input type="text" class="form-control" name="link" id="link"
                                                    value="{{ $slider->link  }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="linkname">Link name</label>
                                                <input type="text" class="form-control" name="linkname" id="linkname"
                                                    value="{{ $slider->linkname  }}">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="Image">Image</label>
                                                    <input type="file" name="file" id="image">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <img
                                                        src="{{$slider->image_src }}"
                                                        alt="preview image" style="width:120px;">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="status" type="checkbox" id="gridCheck" {{ $slider->status == 1 ? 'checked':''}}>
                                                        <label class="form-check-label" for="gridCheck">
                                                            Status
                                                        </label>
                                                      </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success">Edit Slide</button>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
        <script src="{{ asset('js/slider.js') }}"></script>
    @endpush
@endsection
