<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
            &nbsp; &nbsp; &nbsp;
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
           <h4 class=""><b>{{auth()->user()->institucion_user_auth()->nombre}}</b></h4>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('img/sistema-front-end/logo.png')}}"
                     class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ auth()->user()->userName }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{asset('img/sistema-front-end/logo.png')}}"
                         class="img-circle elevation-2"
                         alt="User Image">
                    <p>
                        {{ auth()->user()->userName }}
                        @isset(auth()->user()->created_at)
                            <small>Fecha de Registro {{ auth()->user()->created_at->format('M. Y') }}</small>
                        @endisset                        
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>