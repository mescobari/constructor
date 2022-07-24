@if ($item["submenu"] == [])
<li class="dd-item dd3-item" data-id="{{$item["id"]}}">
    <div class="dd-handle dd3-handle" style="height: 40px; "></div>
    <div class="dd3-content {{$item["link_url"] == "javascript:;" ? "font-weight-bold" : ""}}" style="height: 40px;">
        <a href="{{route("editar_menu", ['id' => $item["id"]])}}"> 
            <span class="bg-primary" style="font-size: 1.5em; border-radius: 4px 4px 4px 4px;padding: 0.1em;">{{$item["nombre"]}}</span> 
            <span style="font-size: 1.5em;"> | Url: </span><span class="badge badge-success" style="font-size: 1.5em; border-radius: 4px 4px 4px 4px;">{{$item["link_url"]}}</span>  
            <span style="font-size: 1.5em;"> | Icono: </span><span class="badge badge-info"><i  style="font-size: 20px;" class="{{isset($item["icon_logo"]) ? $item["icon_logo"] : ""}}"></i></span>  
            <span style="font-size: 1.5em;"> | Estado: </span><span class="badge badge-warning" style="font-size: 1.5em; border-radius: 4px 4px 4px 4px;">{{isset($item["estado"]) ? $item["estado"] : ""}}</span>
        </a>
        <a href="{{route('eliminar_menu', ['id' => $item["id"]])}}" class="eliminar-menu tooltipsC" title="Eliminar este menú"><i class="text-danger fa fa-trash-o"></i></a>
    </div>
</li>
@else
<li class="dd-item dd3-item" data-id="{{$item["id"]}}">
    <div class="dd-handle dd3-handle" style="height: 40px; "></div>
    <div class="dd3-content {{$item["link_url"] == "javascript:;" ? "font-weight-bold" : ""}}" style="height: 40px;">
        <a href="{{route("editar_menu", ['id' => $item["id"]])}}">
            <span class="bg-primary" style="font-size: 1.5em; border-radius: 4px 4px 4px 4px;padding: 0.1em;">{{$item["nombre"]}}</span> 
            <span style="font-size: 1.5em;"> | Url: </span><span class="badge badge-success" style="font-size: 1.5em; border-radius: 4px 4px 4px 4px;">{{$item["link_url"]}}</span>  
            <span style="font-size: 1.5em;"> | Icono: </span><span class="badge badge-info"><i  style="font-size: 20px;" class="{{isset($item["icon_logo"]) ? $item["icon_logo"] : ""}}"></i></span>  
            <span style="font-size: 1.5em;"> | Estado: </span><span class="badge badge-warning" style="font-size: 1.5em; border-radius: 4px 4px 4px 4px;">{{isset($item["estado"]) ? $item["estado"] : ""}}</span>
        </a>
        <a href="{{route('eliminar_menu', ['id' => $item["id"]])}}" class="eliminar-menu tooltipsC" title="Eliminar este menú"><i class="text-danger fa fa-trash-o"></i></a>
    </div>
    <ol class="dd-list">
        @foreach ($item["submenu"] as $submenu)
        @include("back-end.admin.menu.menu-item",[ "item" => $submenu ])
        @endforeach
    </ol>
</li>
@endif
