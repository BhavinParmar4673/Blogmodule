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
                        <h1>{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Contact</a></li>
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
                        <h3 class="card-title">Slider Table</h3>
                    </div>
                    <div class="card-body">
                        {{-- Table --}}
                        <div class="table-responsive">
                            <table id="ContactTable" class="table table-bordered table-striped w-100"
                                data-url="{{ route('admin.contact.list') }}">
                                <thead>
                                    <tr>
                                        <th data-orderable="true">Name</th>
                                        <th style="width:20%" data-orderable="true">Email</th>
                                        <th style="width:20%" data-orderable="false">Message</th>
                                        <th style="width:25%" data-orderable="false" class="text-center">Action</th>
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

    <div id="load-modal"></div>

    @push('script')
        <script src="{{ asset('js/contact.js') }}"></script>
    @endpush

@endsection
