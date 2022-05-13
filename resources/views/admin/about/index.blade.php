@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>About US</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.about-us.index') }}">About Us</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ route('admin.about-us.create') }}" class="btn btn-primary float-right">Add New
                            Project</a>
                        <a href="javascript:void(0)" id="index" data-url="{{ route('admin.about-us.list') }}"></a>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success message" id="message">
                                {{ session('message') }}
                            </div>
                        @endif
                        {{-- Table --}}
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Heading</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </section>
    </div>


    @push('script')
        <script src="{{ asset('js/about.js') }}"></script>
    @endpush
@endsection
