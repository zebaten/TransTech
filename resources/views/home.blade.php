@extends('welcome')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-light p-5 rounded" style="opacity: 0.9">
           @if (Auth::check())
            <div class="text-center">
                <h1>Bienvenido</h1>
                <h2>al sistema de gestion de viajes Transtech</h2>
                <br></br>
                <h2><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg> {{ Auth::user()->usuarios_nombre }} </h2>
            </div>  
            @else
            <div class="text-center">
                <h1>Para ingresar al sistema Transtech debe iniciar sesión </h1>
                <a class="btn btn-primary" href="{{ route('login') }}">Ingresar Aqui</a>
            </div>
           @endif
        </div>
    </div>
</div>
@endsection
