<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SEGUIMIENTO COMPROBANTE</title>    
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
                        <b>Proyecto: </b>
                    </td>
                    <td class="td-texto">
                        {{$nombre_proyecto}}
                    </td>
                    <td class="td-texto-titulo">
                        <b>Municipio: </b>
                    </td>
                    <td class="td-texto">
                        @php
                            $cont = 0;
                        @endphp
                        @foreach ($municipio as $item)                            
                            @php
                                $cont++;
                            @endphp
                            @if ($cont > 1)
                                {{", "}}
                            @endif
                            {{$item}}
                        @endforeach
                    </td>
                </tr>
            </table> 
            <table class="table-texto">
                <tr>
                    <td class="td-texto-titulo">
                        <b>Número: </b>
                    </td>
                    <td class="td-texto">
                        {{$comprobantes_encabezados->id}}
                    </td>
                    <td class="td-texto-titulo">
                        <b>Fecha: </b>
                    </td>
                    <td class="td-texto">
                        {{$comprobantes_encabezados->fecha}}
                    </td>
                    <td class="td-texto-titulo">
                        <b>Tipo: </b>
                    </td>
                    <td class="td-texto">
                        {{$comprobantes_encabezados->tipos->nombre}}
                    </td>
                </tr>
                <tr>
                    <td class="td-texto-titulo">
                        <b>Tipo: </b>
                    </td>
                    <td class="td-texto" colspan="5">
                        {!!$comprobantes_encabezados->concepto!!}
                    </td>
                </tr>
            </table> 
            <h3>DETALLE DE DOCUMENTOS</h3>            
            <table class="table-texto" border=1 cellspacing=0 cellpadding=0 bordercolor="#000000" width="100%">
                <tr>
                    <td class="td-texto-titulo">
                        <b>Componente: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Partida: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Cofinanciador: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Monto en Bs: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Monto en $us: </b>
                    </td>
                </tr>
                    @foreach ($comprobante_detalles as $item)
                <tr>
                        <td class="td-texto">
                            {{$item->componentes->desc_corta}}
                        </td>
                        <td class="td-texto">
                            {{$item->partidas->nombre}}
                        </td>
                        <td class="td-texto">
                            {{$item->cofinanciadores->institucion->sigla}}
                        </td>
                        <td class="td-texto">
                            {{$item->monto_bs}}
                        </td>
                        <td class="td-texto">
                            {{$item->monto_Sus}}
                        </td>
                </tr>
                    @endforeach
                <tr>
                    <td class="td-texto" colspan="3">
                        <center>Total</center>
                    </td>
                    <td class="td-texto">
                        {{$total_bs}}
                    </td>
                    <td class="td-texto">
                        {{$total_sus}}
                    </td>
                </tr>
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