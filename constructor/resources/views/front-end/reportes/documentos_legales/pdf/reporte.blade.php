<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REPORTE DOCUMENTOS LEGALES</title>    
</head>
<body>
    <div id="header">
        @include('front-end.reportes.includes.cabecera')
    </div>
    <div id="footer">
        @include('front-end.reportes.includes.pie')
    </div>
    <div id="contenido">        
        <div class="container2">
            <div class="row">            
                <table class="table-border2">
                    <tbody>
                        <tr>
                            <td><b>Proyecto:</b></td>
                            <td colspan="3">{{$nombre_proyecto}}</td>
                        </tr>
                        <tr>
                            <td><b>Departamento:</b></td>
                            <td>
                                @php
                                    $cont=0;
                                @endphp
                                @foreach ($departamento as $item)
                                    @if ($cont > 0)
                                        <br>
                                    @endif
                                    {{$item}}
                                    @php
                                        $cont++;
                                    @endphp
                                @endforeach
                            </td>
                            <td><b>Municipio:</b></td>
                            <td>                                
                                @php
                                    $cont=0;
                                @endphp
                                @foreach ($municipio as $item)
                                    @if ($cont > 0)
                                        <br>
                                    @endif
                                    {{$item}}
                                    @php
                                        $cont++;
                                    @endphp
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><b>Fecha Real de Inicio:</b></td>
                            <td>{{$fecha_real_inicio}}</td>
                            <td><b>Documento Inicio:</b></td>
                            <td>{{$documento_inicio}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <h3 class="titulo-table-border">Detalle de Documentos:</h3>
        <div class="container2">
            <div class="row">  
                <table class="table-border2"  border=1 cellspacing=0 cellpadding=0 bordercolor="#000000">
                    <tr>
                        <td><b>Titulo</b></td>
                        <td><b>Fecha de Inicio</b></td>
                        <td><b>Duración</b></td>
                        <td><b>Fecha de Fin</b></td>
                        <td><b>Monto</b></td>
                        <td><b>Monto Modificado</b></td>
                    </tr>
                    @foreach ($matriz_doc_legales as $item)                        
                        <tr>
                            <td>{{$item['nombre']}}</td>
                            <td>{{$item['fecha_inicio']}}</td>
                            <td>{{$item['duracion']}}</td>
                            <td>{{$item['fecha_fin']}}</td>
                            <td>{{$item['monto']}}</td>
                            <td>{{$item['monto_modificado']}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="container2">
            <div class="row">  
                <table class="table-border2" style="width: 100%">
                    <tbody>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td><b>Ultimo Plazo de Vigencia:</b></td>
                                        <td>{{$ultimo_plazo_vigencia}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Faltan: {{$dias_vencimiento}} día(s), para que venza el plazo.</b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><b>Responsable de proyecto:</b></td>
                                        <td>                   
                                            @php
                                                $cont=0;
                                            @endphp
                                            @foreach ($responsables_proyecto as $item)
                                                @if ($cont > 0)
                                                    <br>
                                                @endif
                                                {{$item['responsable_firma']}}
                                                @php
                                                    $cont++;
                                                @endphp
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Fecha de Emisión:</b></td>
                                        <td>{{$fecha_emision}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>                            
                                <table style="width: 100%">
                                    <tr>
                                        <td><b>Monto Comprometido APMT:</b></td>
                                        <td>{{$monto_comprometido}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <center><img src="data:image/svg+xml;base64,{{ base64_encode($QR) }}"></center>
                                        </td> 
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<style>
    #contenido{            
        top: 80px;
        left: 20px;
        margin-right: 40px;
        margin-bottom: 40px;
        position: relative;  
    }
    .bordes-radio-bajo{
        border-radius: 10px;
        border: 1px solid #000022;
        width: 100%;       
    }
    .texto_formulario{
        margin:10px;
    }
    .container{
        margin-top: 30px;
        width: 100%;
        /* text-align:center; */
        border: 1px solid #000022;
        border-radius: 50px;
    }
    .container2{
        margin-top: 30px;
        width: 100%;
        border: 1px solid #000022;
        border-radius: 15px;
    }
    .row{
        margin: 30px;
    }
    .titulo-table-border{
        margin-left: 30px;
    }
    .table-border{
        width: 90%;
        border: 1px solid #000022;
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 30px;

    }
    .table-border tr{
        border: 1px solid #000022;
    }
    .table-border tr td{
        border: 1px solid #000022;
        font-size: 0.7em;
    }
    .table-border2{
        width: 100%;
    }
    .table-border2 tr td{
        color: #000000;
        font-size: 0.7em;
    }
</style>
</html>