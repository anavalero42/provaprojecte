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
                    @if (session('estat'))
                    <div class="missatge_exit">
                        <p>Comentari publicat correctament</p>
                    </div>
                    @endif
                    @foreach ($images as $image)
                        @if ($image->id == $image_id)
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
                                <div class="btn-coment">Comentaris ({{count($image->comments)}})</div>
                            </div>
                            <br/>
                            <h2>Comentaris</h2>
                            @foreach ($image->comments as $comment)
                                <p style="color:grey;">{{'@'.$comment->user->nick}} | {{\FormatTime::LongTimeFilter($comment->created_at)}}</p>
                                <p>{{$comment->content}}
                                @if ($comment->user->id == Auth::user()->id)
                                    <a href="{{ action('CommentController@delete',[$image->id,$comment->id]) }}" class="btn-comentdelete">Borrar</a></p>
                                @endif
                            @endforeach
                            <br/>
                            <form action="{{ action('CommentController@insert',[$image->id]) }}" method="POST">
                                @csrf
                                <div>
                                    <input id="descripcio" type="textarea"  placeholder="escriu aqui el teu comentari" class="form-control @error('descripcio') is-invalid @enderror" name="descripcio"  required>
                                    @error('descripcio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <br/>
                                <input type="submit" class="btn btn-primary" value="Publicar">
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection