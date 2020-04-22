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
                    <p>Pujar una imatge</p>
                    
                    @if (session('estat'))
                        <div class="missatge_exit">
                            <p>Imatge pujada correctament</p>
                        </div>
                    @endif
                <form action="{{route('user.upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Imatge') }}</label>
                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"  required>

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcio" class="col-md-4 col-form-label text-md-right">{{ __('Descripció') }}</label>
                        <div class="col-md-6">
                            <input id="descripcio" type="textarea" class="form-control @error('descripcio') is-invalid @enderror" name="descripcio"  required>
                            @error('descripcio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Pujar">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection