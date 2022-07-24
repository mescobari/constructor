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
                    <td style="width: 100%" colspan="2">
                        <b>DOCUMENTACIÓN DE RESPALDO</b>
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