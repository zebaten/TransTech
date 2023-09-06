<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/generales.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/sweetalert2.bundle.css') }}">
    <script src="{{ asset('js/sweetalert2.bundle.js') }}"></script>
    <script src="{{ asset('js/modal-loading.js') }}"></script>
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    @yield('titulo')
</head>

<body>

    <style>
        /* Sidebar */
        #sidebar-wrapper {
            z-index: 1;
            position: absolute;
            width: 0;
            height: 100%;
            overflow-y: hidden;
            background: #020101;
            opacity: 0.9;
            transition: all .5s;
            display: flex;
            align-items: center;
        }

        /* Main Content */
        #page-content-wrapper {
            width: 100%;
            position: absolute;
            padding: 15px;
            transition: all .5s;
            overflow: auto;


        }

        #menu-toggle {
            transition: all .3s;
            font-size: 2em;
            position:fixed;
        }

        /* Change the width of the sidebar to display it*/
        #wrapper.menuDisplayed #sidebar-wrapper {
            width: 250px;
        }

        #wrapper.menuDisplayed #page-content-wrapper {
            padding-left: 250px;
            
        }

        /* Sidebar styling */
        .sidebar-nav {
            padding: 0;
            list-style: none;
            transition: all .5s;
            width: 100%;
            text-align: center;
        }

        .sidebar-nav li {
            line-height: 40px;
            width: 100%;
            transition: all .3s;
            padding: 10px;
        }

        .sidebar-nav li a {
            display: block;
            text-decoration: none;
            color: #ddd;
        }

        .sidebar-nav li:hover {
            background: #283262;
        }

        .container {
            width: 100%;
        }

        #wrapper ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #6d7fcc;
        }

        html,
        body {
            color: black;
            font-family: 'Opens Sans', helvetica;
            height: 100%;
            width: 100%;
            margin: 0px;

        }

        .portada {
            background: url("http://146.83.198.35:1077/transtech/public/storage/backgroundtt.png") no-repeat fixed center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 100%;
            width: 100%;
        }

        .modal {
            color: black;
        }

    </style>
   
    <div id="wrapper">
            <!-- Sidebar -->
        <div class="active" id="sidebar-wrapper">
            <ul class="sidebar-nav">
                @if (Auth::check())
                @if(Auth::user()->rol_cod != 1)
                <li><a href="{{ asset('perfil') }}">Mi Perfil</a></li>
                <li><a href="{{ asset('misViajes') }}">Mis Viajes</a></li>
                @else
                <li><a href="{{ asset('usuarios') }}">Usuarios</a></li>
                <li><a href="{{ asset('camiones') }}">Camiones</a></li>
                <li><a href="{{ asset('licitaciones') }}">Licitaciones</a></li>
                <li><a href="{{ asset('viaje') }}">Viajes</a></li>
                @endif
                
                
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Salir</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <li><a href="{{ route('login') }}">Ingresar</a></li>     
                @endif
            </ul>
        </div>
    
        <!-- Page Content -->
        <div class="portada" id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#" class="btn" id="menu-toggle">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg></a>

                        @yield('contenido')

                    </div>
                </div>
            </div>
        </div>
    </div>


        <script>
            $(document).ready(function() {
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("menuDisplayed");
                });
            });
        </script>
</body>

</html>
