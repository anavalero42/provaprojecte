@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($images as $image)
                        @if (Auth::user()->image)
                            <div style="display: inline;" >
                                <img src="{{ route('user.avatar',['filename'=>$image->user->image])}}" class="imageavatar" id="navbarDropdown">
                            </div>
                        @endif
                        <p style="display: inline;">{{ $image->user->name }} {{ $image->user->surname }} | {{ '@'.$image->user->nick }}</p>
                        <br/>
                        @if ($image->user->image)
                            <div style="margin-top:5px;">
                                <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" class="imatgeusuari">
                            </div>
                        @endif
                        <p style="margin-top:5px;">{{ '@'.$image->user->nick }} | {{\FormatTime::LongTimeFilter($image->created_at)}}</p>
                        <p>{{ $image->description }}</p>
                        <div class="like_coment">
                            <div style="display:inline;">
                            <!--Comprovem que l'usuari registrat ha fet like-->
                            <?php $user_like = false; ?>

                            @foreach ($image->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if($user_like)
                                <a href="{{ action('LikeController@delete',[$image->id]) }}"><img src="{{ asset('images/heart-r.png')}}" data-id="{{$image->id}}" class="btn-like"/></a>
                            @else
                                <a href="{{ action('LikeController@save',[$image->id]) }}"><img src="{{ asset('images/heart-g.png')}}" data-id="{{$image->id}}" class="btn-dislike"/></a>
                            @endif
                            </div>
                            <span class="number_likes">{{count($image->likes)}}</span>
                            <div class="btn-coment"><a href="{{ action('ImageController@detall',[$image->id]) }}" class="link_coment">Comentaris ({{count($image->comments)}})</a></div>
                        </div>
                        <br/>
                    @endforeach
                    <div class="clearfix">{{$images->links()}}</div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection