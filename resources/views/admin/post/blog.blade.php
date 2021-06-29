@extends('admin.layouts.master')
@section('title', 'Post Display')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Display Blog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.posts.show',$post->id) }}">Blog</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                      <h5 class="m-0">{{ $post->title }} <span class="float-right text-muted">Created_at : {{ $post->created_at->toDateString() }}</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">{{ $post->description }}</h6>
                                <p class="card-text">{{ strip_tags($post->content) }}</p>
                            </div>
                            <div class="">
                                <img src="{{ $post->image_src }}" class="bd-placeholder-img" width="150" height="150" role="img"
                                aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            </div>
                        </div>
                    </div>
                  </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




@endsection
