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
            <table class="table-texto" border=1 cellspacing=0 cellpadding=0 bordercolor="#000000" width="100%">
                <tr>
                    <td class="td-texto-titulo">
                        <b>Número: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Fecha: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Tipo: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Concepto: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Monto Bs: </b>
                    </td>
                    <td class="td-texto-titulo">
                        <b>Monto SUS: </b>
                    </td>
                </tr>
                    @foreach ($comprobantes_encabezados as $item)
                <tr>
                        <td class="td-texto">
                            {{$item->numero}}
                        </td>
                        <td class="td-texto">
                            {{$item->fecha}}
                        </td>
                        <td class="td-texto">
                            {{$item->tipos->sigla}}
                        </td>
                        <td class="td-texto">
                            {{$item->concepto}}
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
                    <td class="td-texto" colspan="4">
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