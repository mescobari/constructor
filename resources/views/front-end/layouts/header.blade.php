@php
use Carbon\Carbon;
@endphp

<nav class="navbar navbar-expand navbar-white navbar-light border-bottom">
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link" href="inicio">
                <i class="fas fa-home"></i>&nbsp;&nbsp; 
                Inicio                    
            </a>
        </li>
        @endauth
        <li class="nav-item dropdown">
            
            @isset(auth()->user()->userName)
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>&nbsp;&nbsp; 
                        {{auth()->user()->userName}} - {{auth()->user()->email}}       
                </a>                         
            @else
                <a class="nav-link" href="{{route('login')}}">
                    <i class="far fa-user"></i>&nbsp;&nbsp; 
                    Invitado con Restricciones de Accesos 
                </a>                                  
            @endisset
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @guest
                    <a href="{{route('login')}}" class="dropdown-item">
                        <i class="fas fa-lock mr-2"></i> Autenticarse / Ingresar como Usuario 
                    </a>
                @endguest
                @auth
                    <a href="{{route('usuario')}}" class="nav-link">
                        <i class="fas fa-users mr-2"></i> Modificar 
                    </a>
                    
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <a href="#" onclick="this.closest('form').submit()" class="nav-link">
                            <i class="fas fa-users mr-2"></i> Salir
                        </a>
                    </form>
                @endauth
            </div>
        </li>
        @guest
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user-lock"></i>&nbsp;&nbsp; 
                    Regitrarse                    
                </a>
            </li>
        @endguest
    </ul>
</nav>
