@extends('layouts.app')
@section('title')
Add Post
@endsection
@section('content')

<main>
    <hr>
    <h6>
        Create new Post
    </h6>
    <hr>

    @if($errors->any())
    <div class="alert alert-danger" role="alert">

        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </div>
    @endif
    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            <label>Name</label>
            <input type="text" name="title" placeholder="Enter news title">
            <label>Content</label>
            <textarea name="content" rows="4"></textarea>
        </div>
        <div>
            <label>Choose Image</label>
            <input type="file" name="images" multiple>
            <input type="submit">

        </div>
        <hr>
    </form>
    </div>
    </body>
</main>


@endsection
