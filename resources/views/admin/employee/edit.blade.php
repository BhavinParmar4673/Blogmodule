@extends('admin.layouts.master')
@section('title', 'Testimonial')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-7">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-6">
                                <h1>Edit Employee</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.employee.edit', $employee->id) }}">Edit
                                            Testimonial</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-sm-12 col-md-7">
                    <form action="{{ route('admin.employee.update', $employee->id) }}" method="POST"
                        enctype="multipart/form-data" id="service-form">
                        @csrf
                        @method('PATCH')
                        <x-card>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            data-rule-remote="{{ route('admin.employee.exists', ['id' => $employee->id]) }}"
                                            data-msg-remote="Name already in use" name="title" id="title"
                                            value="{{ $employee->name ?? '' }}" required
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Designation<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="designation" id="designation"
                                            value="{{ $employee->designation ?? '' }}" required
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Qualification</label>
                                        <input type="text" name="qualification" id="qualification"
                                            value="{{ $employee->qualification ?? '' }}"
                                            class="form-control form-control-solid">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label fs-6 fw-bolder mb-3">Description</label>
                                        <textarea name="description" id="description" rows="3"
                                            class="form-control form-control-solid">{{ $employee->description ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="d-flex flex-column">
                                        <div class="form-group">
                                            <label for="form-label fs-6 fw-bolder mb-3">Employee Profile</label><br>
                                            <input type="file" name="file" id="image" accept="image/*">
                                        </div>
                                        <img src="{{ $employee->profile ?? '' }}" alt="preview image"
                                            style="width:120px;">
                                    </div>
                                </div>
                            </div>
                        </x-card>
                        <div class="form-group d-flex justify-content-end">
                            <x-button href="{{ route('admin.employee.index') }}" class="btn btn-danger m-2 mx-2"
                                variant="link">
                                Cancel
                            </x-button>
                            <x-button type="submit" class="btn btn-primary m-2">Update</x-button>
                        </div>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    @push('script')
        <script src="{{ asset('js/employee.js') }}"></script>
    @endpush
@endsection
