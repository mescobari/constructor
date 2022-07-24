<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>FICHA PROYECTO</title>    
    </head>
    <body style="border:  1px solid #000;">
        <div id="header">
            @include('front-end.reportes.includes.cabecera')
        </div>
        <div id="footer">
            @include('front-end.reportes.includes.pie')
        </div>
        <div id="contenido">
            <table class="table-texto">
                <tr>
                    <td class="td-texto-titulo">
                        <b>Código SISIN: </b>
                    </td>
                    <td class="td-texto">
                        {{$codigo_proyecto}}
                    </td>
                </tr>
                <tr>
                    <td class="td-texto-titulo">
                        <b>Nombre del Proyecto: </b>
                    </td>
                    <td class="td-texto">
                        {{$nombre_proyecto}}
                    </td>
                </tr>
                <tr>
                    <td class="td-texto-titulo">
                        <b>Entidad Ejecutora: </b>
                    </td>
                    <td class="td-texto">
                        {{$entidad_ejecutora}}
                    </td>
                </tr>
                <tr>
                    <td class="td-texto-titulo">
                        <b>Etapa de: </b>
                    </td>
                    <td class="td-texto">
                        Ejecución
                    </td>
                </tr>
            </table>
            <table class="table-texto">
                <tr>
                    <td style="width: 25%">
                        <b>Duración del Proyecto: </b>
                    </td>
                    <td style="width: 13%">
                        <b>Inicio</b>
                    </td>
                    <td style="width: 13%">
                        <b>Termino</b>
                    </td>
                    <td style="width: 49%">
                        CLASIFICADOR SECTORIAL
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%">
                        
                    </td>
                    <td style="width: 13%">
                        {{$duracion_proyecto_inicio}}
                    </td>
                    <td style="width: 13%">
                        {{$duracion_proyecto_fin}}
                    </td>
                    <td style="width: 49%; color:#ff0000">
                        {{$clasificador_sectorial_codigo . '  ' . $clasificador_sectorial_descripcion}}
                    </td>
                </tr>
            </table>
            <table class="table-texto" style="margin-top: 15px;">
                <tr>
                    <td style="width: 100%">
                        <b>I. DESCRIPCIÓN DEL PROYECTO</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%">
                        {!!$descripcion_proyecto!!}
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%">
                        <b>&nbsp;&nbsp;PROPOSITO</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%">
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>{!!$proposito->desc_corta!!}</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; padding-left: 25px;">
                        {!!$proposito->descripcion!!}
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%">
                        <b>&nbsp;&nbsp;COMPONENTES</b>
                    </td>
                </tr>
                @foreach ($componentes as $componente)                    
                    <tr>
                        <td style="width: 100%">
                            &nbsp;&nbsp;&nbsp;&nbsp;<b>{!!$componente->desc_corta!!}</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%; padding-left: 25px;">
                            {!!$componente->descripcion!!}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td style="width: 100%">
                        <b>II. LOCALIZACIÓN GEOGRÁFICA</b>
                    </td>
                </tr>
            </table>
            <table  border=1 cellspacing=0 cellpadding=0 bordercolor="#000000" width="100%">
                <tr>
                    <td>
                        Nro.
                    </td>
                    <td>
                        Departamento:
                    </td>
                    <td>
                        Provincia:
                    </td>
                    <td>
                        Municipio:
                    </td>
                </tr>
                @php
                    $cont = 0;                    
                @endphp
                @foreach ($localizacion_geografica as $localizacion)                    
                    <tr>
                        <td>
                            {{$cont++;}}
                        </td>
                        <td>
                            {{$localizacion['nombre1']}}
                        </td>
                        <td>
                            {{$localizacion['nombre2']}}
                        </td>
                        <td>
                            {{$localizacion['nombre3']}}
                        </td>
                    </tr>
                @endforeach                
            </table>
            <table class="table-texto" style="margin-top: 15px;">                
                <tr>
                    <td style="width: 100%">
                        <b>III. ESTRUCTURA DE FINANCIAMIENTO</b>
                    </td>
                </tr>
            </table>
            <table class="table-texto"  border=1 cellspacing=0 cellpadding=0 bordercolor="#000000">
                <tr>                    
                    @foreach ($estructura_financiamiento['titulos'] as $titulo)
                        <td>{{$titulo}}</td>
                    @endforeach
                </tr>
                @foreach ($estructura_financiamiento['matriz'] as $matriz)
                    <tr>
                        <td>
                            {{$matriz['componente']}}
                        </td>
                        <td>
                            {{$matriz['partida']}}
                        </td>
                        @php
                            $cont = 0;
                        @endphp
                        @foreach ($estructura_financiamiento['titulos'] as $key=>$titulo)
                            @php
                                $cont++;
                            @endphp
                            @if ($cont > 2)
                                @if ($cont == count($estructura_financiamiento['titulos']))
                                    <td>
                                        {{$matriz['tot']}}
                                    </td>
                                @else
                                    @foreach ($matriz as $key2=>$item)   
                                        @if ($key == $key2)
                                            <td>      
                                                {{$matriz[$key2]}}
                                            </td>
                                        @endif       
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endforeach                
                <tr>    
                    @php
                        $cont = 0;
                    @endphp                
                    @foreach ($estructura_financiamiento['total'] as $titulo)
                        @if ($cont > 0)
                            @if ($cont == 1)
                                <td colspan="2"><center>{{$titulo}}</center></td>
                            @else
                                <td>{{$titulo}}</td>
                            @endif                            
                        @endif
                        @php
                            $cont++;
                        @endphp
                    @endforeach
                </tr>
            </table>
            {{-- <div class="page-break"></div> --}}
            <table class="table-texto" style="margin-top: 15px;">                
                <tr>
                    <td style="width: 100%" colspan="2">
                        <b>IV. DOCUMENTACIÓN DE RESPALDO</b>
                    </td>                    
                </tr>   
            </table>
            @foreach ($documentacion_respaldo as $doc_res)    
                <table class="table-texto">    
                    <tr>
                        <td style="width: 30%" colspan="1">
                            <b>{!!$doc_res['descripcion']!!}</b>
                        </td> 
                        <td style="width: 70%;" colspan="2">
                            <p style="white-space: nowrap; overflow: hidden; white-space: initial;">{{$doc_res['link']}}</p>
                        </td>                    
                    </tr>
                </table>
            @endforeach  
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
        .page-break{ 
            page-break-after: always;
        }
        .borde-arriba{
            /* border-top:  3px solid #000; */
        }
        .table-texto{
            width: 100%;
            margin:0px;
        }
        .td-texto-titulo{
            margin:0px;
            padding: 0px;
            width: 25%;
        }
        .td-texto{
            margin:0px;
            padding: 0px;
            width: 75%;
        }
    </style>
</html>