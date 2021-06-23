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
                            <li class="breadcrumb-item active"><a href="#">Images</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                    <div class="row">
                        @foreach ($projectimage as $image)
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top img-fluid" src="{{$image->image_src}}"
                                        alt="Card image cap">
                                    <form action="{{route('admin.imagedestroy',$image->id)}}" method="POST">
                                        <div class="card-body">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </section>
    </div>


    @push('script')
        <script src="{{ asset('js/project.js') }}"></script>
    @endpush
@endsection
