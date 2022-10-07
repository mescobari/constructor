<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Planilla Individual</title>    
    </head>
    <body style="border:  1px solid #000; ">
        <div id="header">
            @include('front-end.reportes.includes.cabecera')
        </div>
        <div id="footer">
            @include('front-end.reportes.includes.pie')
        </div>
        
        <div class="contenido">

            <!-- contrato principal -->
            <h4>CONTRATO PRINCIPAL</h4>
            <table class="styled-table1" >
                    <thead>
                        <tr>
                            <th  width="20%"><b>Item</b></th>  
                            <th><b>Descripcion</b></th>
                        </tr>
                    </thead> 

                    <tbody>
                        <tr><td>Contrato Principal:</td><td>{{$principal_codigo}}</td></tr>   
                        <tr><td>Descripcion:</td><td>{{$principal_nombre}}</td></tr>
                        <tr><td>Fecha de Firma:</td><td>{{$principal_firma}}</td></tr>
                        <tr><td>Monto Aprobado:</td><td>{{$principal_monto}}</td></tr>
                       
                       
                    </tbody>
                </table>

            
        </div>

         <!-- docuento de la planilla que puede coincider con el contrato principal -->
         @if(($padre!=0) && ($nombre_reporte != "PLANILLA DE AVANCE"))
         <div class="contenido">

                <h4>{{$nombre_reporte}}</h4>
                    <table class="styled-table1" >
                            <thead>
                                <tr>
                                    <th  width="20%"><b>Item</b></th>  
                                    <th><b>Descripcion</b></th>
                                </tr>
                            </thead> 

                            <tbody>
                                <tr><td>Codigo Documento:</td><td>{{$documento_codigo}}</td></tr>   
                                <tr><td>Descripcion:</td><td>{{$documento_nombre}}<br> {{$referencia}}</td></tr>
                                <tr><td>Fecha de Firma:</td><td>{{$documento_firma}}</td></tr>
                                <tr><td>Monto Aprobado:</td><td>{{$documento_monto}}</td></tr>
                                <tr><td>NURI Correspondencia:</td><td>{{$nuri_planilla}}</td></tr>
                                <tr><td>Monto Vigente:</td><td>{{$total_total}}</td></tr>
                            
                            </tbody>
                        </table>


            </div>
        </div>
        @endif

        <!-- Informacion de la planilla eNCABEZADO-->

        <div class="contenido">
            @if ($nombre_reporte == "PLANILLA DE AVANCE")
                
            <h4>CERTIFICADO DE AVANCE DE OBRA ({{$numero_planilla}})</h4>
                    <table class="styled-table1" >
                            <thead>
                                <tr>
                                    <th  width="20%"><b>Item</b></th>  
                                    <th><b>Descripcion</b></th>
                                </tr>
                            </thead> 

                            <tbody>
                                <tr><td>Codigo Documento:</td><td>{{$numero_planilla}}</td></tr>   
                                <tr><td>Descripcion:</td><td>{{$referencia}}<br> {{$referencia}}</td></tr>
                                <tr><td>Fecha Planilla:</td><td>{{$fecha_planilla}}</td></tr>
                                <tr><td>NURI Correspondencia:</td><td>{{$nuri_planilla}}</td></tr>

                                <tr><td>Monto Planilla:</td><td>{{$total_planilla}}</td></tr>
                                <tr><td>Descuento Anticipo:</td><td>{{$anticipo_planilla}}</td></tr>
                                <tr><td>Retencion (7%) :</td><td>{{$retencion_planilla}}</td></tr>

                                <tr><td>Total detalle Bs. :</td><td>{{$total_total}}</td></tr>
                            </tbody>
                        </table>


            @endif

            

                

            </div>
        </div>


            <!-- Informacion de la planilla DETALLADO-->
        <div class="contenido">
        <h4>DETALLE DE LA PLANILLA</h4>
                @php 
                    
                    $keys = array_keys($planilla); 
                    $salida=[];
                    $filas = count($planilla);
                   
                   
                    switch ($nombre_reporte) {
                        case "PLANILLA INICIAL":
                            $inicial=25;
                            break;
                        case "PLANILLA MODIFICATORIA":
                            $inicial=15;
                            break;
                        case "PLANILLA DE AVANCE":
                            $inicial=15;
                            break;
                    }


                    $filas_pagina=40;
                    $tablas=  intdiv(($filas-$inicial), $filas_pagina)+2;
                    $t[0]=0;
                    $a_item = array("item_codigo", "item_descripcion", "simbolo","cantidad", "precio_unitario", "precio_total","tipo");
                @endphp
                @for ($j = 0; $j < $tablas; $j++)
                    @php   $t[$j+1]=$inicial+$j*$filas_pagina; @endphp
                
                @endfor
                @php   $t[$tablas]=$filas; @endphp
        </div>   
            
        @for ($j = 0; $j < $tablas; $j++)
       
            <div class="contenido">

                <table class="styled-table" >
                    <thead>
                        <tr align="center">
                            <th colspan="6"><b>Items de la Planilla</b></th>  
                            
                        </tr>
                        <tr align="center">
                            <th><b>Codigo</b></th>  
                            <th><b>Descripcion</b></th>
                            <th><b>Unidad</b></th>   
                            <th><b>Cantidad</b></th>  
                            <th><b>Prec. Unitario</b></th> 
                            <th><b>prec. Total</b></th>
                        </tr>
                    </thead> 
                    <tbody>
                            @for ($i =  $t[$j]; $i <  $t[$j+1]; $i++)
                                @foreach($planilla[$keys[$i]] as $key => $value) 
                                    @if (in_array($key,  $a_item))
                                    @php   $salida[$key]=$value; @endphp
                                    @endif
                                @endforeach
                                @if ($salida['tipo']=='G')
                                    <tr style=" background-color: #ff78cb; font-weight: bold;">
                                @else
                                    <tr>
                                @endif
                                    <td>{{$salida['item_codigo']}}({{$salida['tipo']}})</td>  
                                    <td width="50%">{{$salida['item_descripcion']}}</td>
                                    <td align="center">{{$salida['simbolo']}}</td>   
                                    <td align="right">{{$salida['cantidad']}}</td>  
                                    <td align="right">{{$salida['precio_unitario']}}</td> 
                                    <td align="right" width="15%">{{$salida['precio_total']}}</td>

                                    
                                </tr>
                               
                            @endfor
                            </tbody>
                        </table>       
                    
                    
            </div> 
            <div class='page-break'></div>
        @endfor

       
    </body>
    <style>
        .contenido{            
            top: 100px;
            left: 20px;
            margin-right: 40px;
            margin-bottom: 10px;
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
            border: 1px solid black;
            border-collapse: collapse;
        }
        .td-texto-titulo{
            margin:0px;
            padding: 0px;
            width: 25%;
        }
        .td-texto{
            margin:0px;
            padding: 0px;
            
        }

/* xxxxxxxxxxxxEncabezadoxxxxxxxxxxxxxxxxx */

        .styled-table1 { 
            width: 100%;
            border-collapse: collapse; 
            margin: 10px 0; 
            font-size: 0.8em; 
            font-family: sans-serif; 
            min-width: 450px; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); 
        }

        .styled-table1 thead tr { 
            background-color: #980081; 
            color: #ffffff; 
            text-align: middle; 
        }

        .styled-table1 th, .styled-table1 td { 
            padding: 2px 8px; 
        }

        .styled-table1 tbody tr { 
            border-bottom: 1px solid #dddddd; 
        } 
        .styled-table1 tbody tr:nth-of-type(even) { 
            background-color: #f3f3f3; 
        } 
        .styled-table1 tbody tr:last-of-type { 
            border-bottom: 1px solid #009879; 
        }


/* xxxxxxxxxxxxdetallexxxxxxxxxxxxxxxxx */

        .styled-table { 
            width: 100%;
            border-collapse: collapse; 
            margin: 10px 0; 
            font-size: 0.6em; 
            font-family: sans-serif; 
            min-width: 450px; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); 
        }

        .styled-table thead tr { 
            background-color: #980081; 
            color: #ffffff; 
            text-align: middle; 
        }

        .styled-table th, .styled-table td { 
            padding: 2px 8px; 
        }

        .styled-table tbody tr { 
            border-bottom: 1px solid #dddddd; 
        } 
        .styled-table tbody tr:nth-of-type(even) { 
            background-color: #f3f3f3; 
        } 
        .styled-table tbody tr:last-of-type { 
            border-bottom: 1px solid #009879; 
        }


    </style>
</html>