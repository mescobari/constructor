{{-- <div class="col-md-12" style="height: 500px; overflow: scroll;"> --}}
    <div class="col-md-12">
    {{-- <div class="row">
        <div class="col-md-10">
            
        </div>
        <div class="col-md-2">
            <input type="checkbox" onclick="checkAllff()" id="checkAll" style="width: 35px; height: 35px; cursor: pointer;" title="Seleccionar todos">        
        </div>                
    </div> --}}
    <div class="row">

        @isset($roles)   
            <div class="col-md-6">    
                <span style="font-size:1.5em">Roles</span>   
                <br>
                @php
                    $cont = 0;
                @endphp          
                @foreach ($roles as $rol) 
                    {{-- <div class="form-group row"> --}}
                        <span class="badge badge-success">{{$rol}}</span>  
                    {{-- </div> --}}
                    @php
                        $cont++;
                    @endphp
                @endforeach 
                @if ($cont == 0)
                    <span class="badge badge-danger">Este usuario no tiene Roles asignados</span>  
                @endif
            </div>
        @endisset
        @isset($permisos)  
            <div class="col-md-6">                      
                <span style="font-size:1.5em">Permisos</span>  
                <br>
                @php
                    $cont = 0;
                @endphp                  
                @foreach ($permisos as $permiso) 
                    {{-- <div class="form-group row"> --}}
                        <span class="badge badge-success">{{$permiso}}</span>  
                    {{-- </div> --}}
                    @php
                        $cont++;
                    @endphp
                @endforeach 
                @if ($cont == 0)
                    <span class="badge badge-danger">Este usuario no tiene Permisos asignados</span>  
                @endif
            </div>
        @endisset
    </div>
    <br>   
</div>