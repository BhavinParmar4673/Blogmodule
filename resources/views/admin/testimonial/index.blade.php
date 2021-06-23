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
            <h1>Module Testimonial</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.testimonials.index')}}">Testimonials</a></li>
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
              <h3 class="card-title">All Testimonials</h3>
              <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary float-right">Add New Testimonial</a>
              <a href="javascript:void(0)" id="index" data-url="{{ route('admin.datatable') }}"></a>
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
                              <th>CREATED_AT</th>
                              <th>Visibility</th>
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
        <script src="{{ asset('js/testimonial.js') }}"></script>
    @endpush

@endsection
