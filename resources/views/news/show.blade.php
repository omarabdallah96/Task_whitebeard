@extends('layouts.app')
@section('title')
{{$post->title}}
@endsection
@section('content')

<style>
    .post_image {
        max-height: 300px;
        max-width: 300px;
    }
</style>
<!-- Header image -->
<div class="header-image">
    @if($post->images->count())
    <img class="post_image" src="{{$post->images[0]->name}}">
    @else
    <img class="post_image" src="">

    @endif
</div>

<h3 class="post-share">
    Share On Social Media         <span> <img src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/24/null/external-view-content-creator-tanah-basah-glyph-tanah-basah-2.png" />  {{$post->views}}</span>

</h3>


<!-- Post content -->
<div>

    <div class="post-share">


        <button data-url="https://www.facebook.com/sharer/sharer.php?u=" title="Facebook" target="_blank">
            <img src="https://img.icons8.com/color/48/null/facebook-new.png" />

        </button>


        <button data-url="https://twitter.com/intent/tweet?url=" title="Twitter" target="_blank">
            <img src="https://img.icons8.com/color/48/null/twitter--v1.png" /> </button>


        <button data-url="https://t.me/share/url?url='" title="Telegram" target="_blank">
            <img src="https://img.icons8.com/color/48/null/telegram-app--v1.png" /> </button>



        <button data-url="https://www.linkedin.com/shareArticle?mini=true&url=" title="Linkedin" target="_blank">
            <img src="https://img.icons8.com/ios-glyphs/48/null/linkedin-circled--v1.png" /> </button>


    </div>

</div>

</div>
<!-- Post content -->
<div class="post-content">
    <h3>{{$post->title}}


    </h3>
    <p>{{$post->content}}</p>
</div>




@endsection


@section('script')
<script>
    const links = document.querySelectorAll('button');
    $('button').on('click', function() {
        console.log(this)


        var link = $(this).attr('data-url');

        var window_location_encoded = encodeURI(window.location);
        var share_link = link + window_location_encoded;
        window.open(share_link, '_blank');

        window.open(
            link,

            'width=600,height=500,location=no,menubar=no,toolbar=no'
        );
    })
</script>
@endsection
