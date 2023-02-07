@extends('layouts.app')
@section('title')
News List
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('News List') }}</div>


                <div class="card-body">
                    <a class="add-new" href="{{route('news.create')}}">
                        Add news
                    </a>
                    <table>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @forelse($news as $new)
                            <tr>
                                <th>{{$new->title}}</th>
                                <th>{{\Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</th>
                                <th><img src="https://img.icons8.com/ios/24/null/delete--v1.png" />
                                    <img src="https://img.icons8.com/ios/16/null/edit.png" />
                                    <img src="https://img.icons8.com/material-sharp/16/null/visible.png" />
                                </th>

                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    {{$news->links()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
