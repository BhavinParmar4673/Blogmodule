@extends('admin.layouts.master')
@section('title', 'Tag')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Module Tag</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Tag</a></li>
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
                        <h3 class="card-title">Tag Datatable</h3>
                        <a href="javascript:void(0)" class="btn btn-primary float-right" id="createtag">Create Tag</a>
                        <a href="javascript:void(0)" id="index" data-url="{{ route('admin.alltag') }}"></a>
                    </div>
                    <div class="card-body">
                        {{-- Table --}}
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tag Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        {{-- table end --}}
                        {{-- Modal --}}
                        <div class="modal fade" id="modal-tag">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelHeading">Create New Tag</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {{-- form --}}
                                    <form action="{{ route('admin.tag.store') }}" method="POST" name="form"
                                        id="form-data">
                                        <div class="modal-body">
                                            <span class="text-danger" id="error"></span>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tag Name</label>
                                                <input type="text" class="form-control exist" name="tag"
                                                    placeholder="Enter Tag Name"
                                                    data-rule-remote="{{ route('admin.tag.exist') }}"
                                                    data-msg-remote="Tag already exist">
                                                <span class="text-danger" id="tag-error"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Icon</label>
                                                <input type="text" class="form-control" name="icon" placeholder="fa icon">
                                                <span class="text-danger" id="tag-error"></span>
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Add Tag</button>
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
                        {{-- Edit Modal --}}
                        <div class="modal fade" id="modal-tag-edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelHeading">Edit Tag</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                    </div>
                                    {{-- form --}}
                                    <form action="{{ route('admin.tag.update', 'tag_id') }}" method="POST" name="form"
                                        id="form-data-edit">
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tag name</label>
                                                <input type="text" class="form-control" required
                                                    data-rule-remote="{{ route('admin.tag.exist') }}"
                                                    data-msg-remote="Tag already exist" id="tag-edit" name="tag">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Icon</label>
                                                <input type="text" class="form-control" name="icon" id="icon"
                                                    placeholder="fa fa-trash">
                                                <span class="text-danger" id="tag-error"></span>
                                            </div>
                                            <input type="hidden" name="tag_id" id="tag_id">
                                        </div>
                                        @csrf
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-primary">Update Tag</button>
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
            </div>
            <!-- /.card -->

        </section>
    </div>

    @push('script')
        <script src="{{ asset('js/tag.js') }}"></script>
    @endpush
@endsection
