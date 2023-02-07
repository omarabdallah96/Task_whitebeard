@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }}
@endsection
@section('content')




<div class="header">
    <h2>Ads </h2>
</div>

<div class="row">
    <div class="leftcolumn">
        @forelse($news as $new)
        <div class="card  grid-item">
            <h4>{{$new->title}}</h4>
            <h6> <img src="https://img.icons8.com/material-outlined/15/e74c3c/clock--v1.png" /> {{\Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</h6>
            <div class="fakeimg">
                @forelse($new->images as $image)
                <img class="responsive-image post_image" src="{{$image->name}}" />
                @empty
                @endforelse
            </div>
            <br>
            <p>{{ Str::of($new->content)->words(3, ' ...') }} <button id="new_{{$new->id}}" class="read-more read-more-button">Read More</button></p>

            <button id="{{$new->id}}" class="like-btn">
                <img src="https://img.icons8.com/material-outlined/24/null/filled-like.png" />
            </button>
        </div>
        @empty

        @endforelse

        <div>

        </div>

        {{$news->links()}}

    </div>

    <div class="rightcolumn">
        <div class="popular">
            <div class="card">
                <h4>Recent News</h4>
                @if($last_news)
                <div class="card">
                    <h6 class="header-popular">
                        <span>{{$last_news->title}} <br> <img src="https://img.icons8.com/material-outlined/15/e74c3c/clock--v1.png" /> {{\Carbon\Carbon::parse($last_news->created_at)->diffForHumans() }}</span>

                        <span>{{$last_news->views}} <img src="https://img.icons8.com/windows/32/e74c3c/fire-alt.png" /> </span>
                    </h6>

                    @if($last_news->images->count() )
                    <img class="responsive-avatar" src="{{$last_news->images[0]->name}}" />
                    @else
                    @endif
                </div>
                @else
                @endif
                <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
            </div>
            <div class="card">
                <h3>Popular News</h3>

                @forelse($Populars as $popular)

                <div>
                    <div class="card read-more" id="new_{{$popular->id}}">
                        <h6 class="header-popular">
                            <span>{{$popular->title}} <br> <img src="https://img.icons8.com/material-outlined/15/e74c3c/clock--v1.png" /> {{\Carbon\Carbon::parse($popular->created_at)->diffForHumans() }}</span>

                            <span>{{$popular->views}} <img src="https://img.icons8.com/windows/32/e74c3c/fire-alt.png" /> </span>
                        </h6>

                        @if($popular->images )
                        <img class="responsive-avatar" src="{{$popular->images[0]->name}}" />
                        @else
                        @endif
                    </div>
                </div><br>

                @empty
                <div class="card">
                    <h6 class="header-popular">
                        No Popular news
                    </h6>

                </div>
                @endforelse
            </div>
        </div>
        <div class="card">
            <h3>Follow US</h3>
            <p><img src="https://img.icons8.com/ios-glyphs/24/1877f2/facebook-new.png" />
                <img src="https://img.icons8.com/ios-glyphs/24/1d9bf0/twitter.png" />
                <img src="https://img.icons8.com/ios-glyphs/24/3f729b/instagram-new.png" />
                <img src="https://img.icons8.com/color/30/null/youtube-play.png" />

            </p>
        </div>
    </div>
</div>





@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(".read-more").click(function() {
            console.log(this.id)
            id = this.id.replace('new_', '')
            window.location.replace('/news/' + id);
        });
    });
</script>
@endsection
