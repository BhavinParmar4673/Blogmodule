@extends('admin.layouts.master')
@section('title', $title)
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Module Employees</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employee.index') }}">Testimonials</a>
                            </li>
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
                        <h3 class="card-title">All Employees</h3>
                        <a href="{{ route('admin.employee.create') }}" class="btn btn-primary float-right">Add New
                            Employee</a>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success message" id="message">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped w-100"
                                data-url="{{ route('admin.employee.list') }}">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Qaulification</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @push('script')
        <script src="{{ asset('js/employee.js') }}"></script>
    @endpush

@endsection
