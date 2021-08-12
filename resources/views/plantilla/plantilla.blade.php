<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('img/icono.ico') }}">
    @yield('headers')

    <title>@yield('titulo','Plantilla')</title>

    <!-- Bootstrap CSS CDN -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->

     <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"> -->
     <!-- Styles compilados de Bootstrap-->
     <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom CSS guardados dentro la carpeta public/css -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <link href="{{ asset('css/plantilla_styles.css') }}" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="assets/themify-icons/themify-icons.css"> -->
    @yield('custom_css')

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="shadow">
            <div class="sidebar-header text-center">
                <h4>Simbiosiss</h4>
            </div>
            <hr>

            <ul class="list-unstyled components">
                <p class="user-dash"><span><img class="img-fluid" src="{{ url('/img/logo.png') }}"></span><a href="{{ route('admin') }}">Mi Empresa</a></p>
                
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span><i class="fas fa-home"></i></span> Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ route('admin') }}"><i class="far fa-dot-circle"></i> Home</a>
                        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fas fa-store-alt"></span> Comunidades</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li>
                            <a href="{{ route('admin.communities.index') }}"><i class="far fa-dot-circle"></i> Comunidades</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.communities.create') }}"><i class="far fa-dot-circle"></i> Nueva Comunidad</a>
                        </li>
                    </ul>
                </li>
             
          
        </nav>

        <!-- Page Content -->
        <div id="content">
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn bg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-secondary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                       <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                       
                        -->
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.userConfig') }}"><i class="fas fa-cogs"></i> Configuración Usuario</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf

                        <li class="nav-item">
                            <a class="nav-link" href="javascript:{}" onclick="document.getElementById('logout-form').submit();"><span class="fas fa-power-off"></span> Cerrar Sesión</a>
                        </li>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
        <div class="row">
            <div class="col-sm-12" style="background-color:white; padding:15px;">
                <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @yield('crudtitulo')
                            </ol>
                            
                </nav> 
            @yield('contenido')
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" style="background-color:white; padding:15px;">
             @yield('tabla')
            </div>
        </div>

        </div> <!-- end container -->

     
    </div> <!-- fin page content -->



    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <!-- Popper.JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> -->
    
    <!-- Bootstrap JS -->
    <!--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>  -->
    <!-- Bootstrap JS, jquery y popper compilado -->
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        $(document).ready(function () {
           
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

    @yield('js')



</body>

</html>