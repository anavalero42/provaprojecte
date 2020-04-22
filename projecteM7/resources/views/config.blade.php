@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Configuració del compte</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Edita el teu perfil</p>
                    @if (session('estat'))
                        <div class="missatge_exit">
                            <p>Usuari editat correctament</p>
                        </div>
                    @endif
                <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                        <div class="col-md-6">
                            <input id="surname" type="surname" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ Auth::user()->surname }}" required autocomplete="surname" autofocus>

                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>

                        <div class="col-md-6">
                            <input id="nick" type="nick" class="form-control @error('nick') is-invalid @enderror" name="nick" value="{{ Auth::user()->nick }}" required autocomplete="nick" autofocus>

                            @error('nick')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                        <div class="col-md-6">
                            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"  required>

                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Imatge avatar-->
                            @if (Auth::user()->image)
                                <img src="{{ route('user.avatar',['filename'=>Auth::user()->image])}}" class="imageconfig">
                            @endif

                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Editar">
                        </div>
                    </div>
                </form>
                    {{-- <p>{{ Auth::user()->nick }}</p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection