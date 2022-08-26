{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('img/sistema-front-end/logo.png')}}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('back-end.layouts.menu')
            </ul>
        </nav>
    </div>

</aside> --}}

<aside class="main-sidebar {{$color_tema_asider}} elevation-4" >
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('img/sistema-front-end/logo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{$sistemas_ferchos}}</span>
    </a>
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/sistema-front-end/logo.png')}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    &nbsp;&nbsp;
                    @isset(auth()->user()->userName)
                        {{auth()->user()->userName}}                   
                    @else
                        Invitado con Restricciones de Accesos      
                    @endisset
                    
                </a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">            
            @foreach ($menusComposer as $key => $item)
                @if ($item["id_padre"] != 0)
                    @break
                @endif
                @include("back-end.layouts.menu-item", ["item" => $item])
            @endforeach
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
