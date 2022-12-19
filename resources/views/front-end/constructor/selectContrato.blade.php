@extends("back-end.layouts.app")
@section("titulo")
Menú
@endsection

@section("styles")
<link href="{{asset("assets/lte/js/jquery-nestable/jquery.nestable.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section("scriptsPlugins")
<script src="{{asset("assets/lte/js/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
@endsection

@section("scripts")
<script src="{{asset("assets/ferdy/pages/scripts/admin/avan/index.js")}}" type="text/javascript"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('back-end.includes.mensaje')                
        <div class="card">
            <div class="card-header {{$sistemas_ferchos_color_cabeceras_formulario}}">
                <h3 class="card-title">Seleccionar Contrato</h3>
                
            </div>

           

            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="form-group">
                                <label>Seleccione Contrato</label>

                                <select id="contrato" name="contrato" onchange="ShowSelected();" class="form-control select2bs4" style="width: 100%;">
                                    <option selected="selected">Seleccionar</option>
                                    
                                    @foreach ($contratos as $contrato)
                                        @if ($contrato->padre ==0)
                                            <option value="{{$contrato->id}}">{{$contrato->nombre}}</option>
                                        @endif
                                    @endforeach

                                </select>
                                <span id="botonAqui"></span>
                            </div>
                        </div>
                        <div class="col-2" ></div>
                    </div>
                </div>
              
               
            </div>
        </div>
    </div>
</div>

@endsection


<script type="text/javascript">
    function ShowSelected()
    {
        /* Para obtener el valor */
        var cod = document.getElementById("contrato").value;
        console.log(cod);
        
        const est = document.getElementById("botonAqui");
        
        //let btnEst =  ' <ol class="dd-list" > \@@foreach ($menus as $key => $item)  \@@if ($item["id_padre"] != 0) \@@break \@@endif  \@@if ($item["contrato_id"] == '+ cod 
        //+') \@@include("back-end.admin.avan.avan-item",["item" => $item])   \@@endif \@@endforeach </ol>';

        let btnEst = '<div class="p-4 mx-auto" style="width: 400px;"><a class="btn btn-danger btn-lg" href="select_estructura/'+cod+'" role="button">Ver Estructura</a></div>'
         
        est.innerHTML = btnEst;

       
    }
</script>
