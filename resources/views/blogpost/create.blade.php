@extends('layouts.master')
@section('content')

<div class="card shadow">
    <div class="card-body">
        <h1 class="card-title">Create new post</h1>
        <div class="card-text">
            @include('blogpost.partials.create_post')
        </div>
    </div>
</div>
@endsection