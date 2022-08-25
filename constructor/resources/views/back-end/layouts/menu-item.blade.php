
@isset($dato)
<ul style="padding-left: 0.8rem; list-style:none;">
    {{-- {{$dato}} --}}
@endisset
@if ($item["submenu"] == [])
    <li class="nav-item">
        <a href="{{route(trim($item["link_url"]))}}" class="nav-link <?php if(Route::currentRouteName()==trim($item["link_url"])) {echo 'active';} ?>">
            <i class="nav-icon {{$item["icon_logo_color"]}} {{$item["icon_logo"]}}"></i> 
            <p>
                {{$item["nombre"]}}
            </p>
        </a>
    </li>

@else
    <li class="nav-item has-treeview">
        <a href="javascript:;" class="nav-link">
          <i class="nav-icon {{$item["icon_logo_color"]}} {{$item["icon_logo"]}}"></i>
          <p>
            {{$item["nombre"]}}
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach ($item["submenu"] as $submenu)
            @isset($dato)
                @include("back-end.layouts.menu-item", [ "item" => $submenu, "dato" => $dato + 1])
            @else
                @include("back-end.layouts.menu-item", [ "item" => $submenu, "dato" => 1 ])
            @endisset                
            @endforeach
        </ul>
    </li>
@endif
@isset($dato)
</ul>
@endisset