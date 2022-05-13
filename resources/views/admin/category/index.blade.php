@extends('admin.layouts.master')
@section('title', 'Category')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Module Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.category.index') }}">Category</a>
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
                        <h3 class="card-title">Category Datatable</h3>
                        <a href="javascript:void(0)" class="btn btn-primary float-right" id="createcategory">Create
                            Category</a>
                        <a href="javascript:void(0)" id="index" data-url="{{ route('admin.allcategory') }}"></a>
                    </div>
                    <div class="card-body">
                        {{-- Table --}}
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Cat Id</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        {{-- table end --}}
                        {{-- Modal --}}
                        <div class="modal fade" id="modal-category">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelHeading">Create New Category</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {{-- form --}}
                                    <form action="{{ route('admin.category.store') }}" method="POST"
                                        enctype="multipart/form-data" name="form" id="form-data">
                                        <div class="modal-body">
                                            <span class="text-danger" id="error"></span>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Name</label>
                                                <input type="text" class="form-control" id="category" name="category"
                                                    data-rule-remote="{{ route('admin.category.exist') }}"
                                                    data-msg-remote="Category already exist"
                                                    placeholder="Enter Category Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="3"
                                                    placeholder="Enter A Description"></textarea>
                                            </div>
                                            <div class="mydiv d-flex">
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Category Image</label>
                                                    <input type="file" name="file" id="image" accept="image/*"
                                                        class="form-control-file required" id="image-edit">
                                                </div>
                                                <img src="https://via.placeholder.com/120x80.png" alt="preview image"
                                                    style="width:120px;">
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Add category</button>
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
                        <div class="modal fade" id="modal-category-edit">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelHeading">Edit Category</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                    </div>
                                    {{-- form --}}
                                    <form action="{{ route('admin.category.update', 'cat_id') }}" method="POST"
                                        enctype="multipart/form-data" name="form" id="form-data-edit">
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Name</label>
                                                <input type="text" class="form-control" id="category-edit" name="category"
                                                    placeholder="Enter Category Name"
                                                    data-rule-remote="{{ route('admin.category.exist') }}"
                                                    data-msg-remote="Category already exist">
                                            </div>
                                            <input type="hidden" name="cat_id" id="cat_id">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Description</label>
                                                <textarea class="form-control" name="description" id="description-edit" rows="3"
                                                    placeholder="Enter A Description"></textarea>
                                            </div>
                                            <div class="d-flex">
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Category Image</label>
                                                    <input type="file" name="file" accept="image/*"
                                                        class="form-control-file" id="image-edit">
                                                </div>
                                            </div>
                                        </div>
                                        @csrf
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit" class="btn btn-primary">Update Category</button>
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
        <script src="{{ asset('js/custom.js') }}"></script>
    @endpush
@endsection
