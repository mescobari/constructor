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
                        <b>LOCALIZACIÓN GEOGRÁFICA</b>
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