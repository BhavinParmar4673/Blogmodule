@extends('admin.layouts.master')
@section('title', 'Post')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Module Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">Post</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post Table</h3>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary float-right">Add New Blog</a>
                <a href="javascript:void(0)" id="index" data-url="{{ route('admin.allpost') }}"></a>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success message" id="message">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- Table --}}
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TITLE</th>
                                <th>CATEGORIES</th>
                                <th>AUTHOR</th>
                                <th>CREATED_AT</th>
                                <th>STATUS</th>
                                <th>IMAGE</th>
                                <th>OPERATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                {{-- table end --}}
            </div>
          </div>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





    @push('script')
        <script src="{{ asset('js/post.js') }}"></script>
    @endpush

@endsection
