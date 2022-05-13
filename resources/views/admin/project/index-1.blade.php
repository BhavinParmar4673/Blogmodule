@extends('admin.layouts.master')
@section('title', 'Projects')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Module Project</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.projects.index') }}">Project</a>
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
                    <h3 class="card-title">All Project</h3>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary float-right">Add New
                        Testimonial</a>
                    <a href="javascript:void(0)" id="index" data-url="{{ route('admin.allproject') }}"></a>
                    <a href="javascript:void(0)" id="tag" data-url="{{ route('admin.blogtag') }}"></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th class="w-25">Description</th>
                                    <th class="w-25">Tag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    {{-- Modal --}}
                    <div class="modal fade" id="modal-project">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading">Create New project</h4>
                                    <button type="button" class="close close-model" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {{-- form --}}
                                <form action="{{ route('admin.projects.store') }}" method="POST"
                                    enctype="multipart/form-data" name="form" id="form-data">
                                    <div class="modal-body">
                                        <span class="text-danger" id="error"></span>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="3"
                                                placeholder="Enter A Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Project Image</label>
                                            <div class="input-images"></div>
                                        </div>
                                        <div class="form-group select2-primary">
                                            <label for="multipleselect">Tag</label>
                                            <select class="multiple-tag" name="tags[]" id="multipleselect"
                                                data-placeholder="Write some Tag"
                                                data-dropdown-css-class="select2-primary" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                    @csrf
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Add Project</button>
                                        <button type="button" class="btn btn-default close-model"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                {{-- /form --}}
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    {{-- Edit Modal --}}
                    <div class="modal fade" id="modal-project-edit">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modelHeading">Edit Project</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                </div>
                                {{-- form --}}
                                <form action="{{ route('admin.projects.update', 'project_id') }}" method="POST"
                                    enctype="multipart/form-data" name="form" id="form-data-edit">
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" id="title-edit" name="title"
                                                placeholder="Enter Category Name">
                                        </div>
                                        <input type="hidden" name="project_id" id="project_id">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" name="description" id="description-edit"
                                                rows="3" placeholder="Enter A Description"></textarea>
                                        </div>
                                        <div class="form-group" id="my-image">
                                            <label for="exampleFormControlFile1">Project Image</label>
                                            <div class="input-images-2" id="input-images"></div>
                                        </div>
                                        <div class="form-group select2-primary">
                                            <label for="multipleselect">Tag</label>
                                            <select class="multiple-tag" name="tags[]" id="project-tag"
                                                data-dropdown-css-class="select2-primary" multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                    @csrf
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-primary">Update Project</button>
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                {{-- /form --}}
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
</div>


@push('script')
<script src="{{ asset('js/project.js') }}"></script>
@endpush
@endsection