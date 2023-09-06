@extends('welcome')

@section('contenido')
<div class="container">
    <div class="row justify-content-center my-auto">
        <div class="col-md-8 py-3 rounded bg-light" style="opacity: 0.9">
            <div class="text-center">
                <h3>Login Transtech</h3>
            </div>
            
            <form method="POST" class="mt-5" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="rut" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                    <div class="col-md-6">
                        <input id="usuarios_correo" type="usuarios_correo" class="form-control @error('usuarios_correo') is-invalid @enderror" name="usuarios_correo" value="{{ old('usuarios_correo') }}" required autocomplete="usuarios_correo" autofocus>

                        @error('usuarios_correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ingresar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
