<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PLANILLAS CONTRATO</title>    
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

            <table class="styled-table" border="1">
            <thead>
                 <tr  align="center">
                    <td class="td-texto-titulo" >
                        <b>Contrato Principal </b>
                    </td>
                    <td class="td-texto-titulo" >
                        <b>Fecha de Firma </b>
                    </td>
                    <td class="td-texto-titulo" >
                        <b>Monto Aprobado </b>
                    </td>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                                        
                    <td class="td-texto" width="70%">
                    <b> {{$principal_codigo}}</b> <br>{{$principal_nombre}}
                    </td>
                    <td class="td-texto" width="10%" align="center">
                        {{$principal_firma}}
                    </td>
                    <td class="td-texto" width="20%" align="right">
                        {{$principal_monto}}
                    </td>

                </tr>
               
            </tbody> 
            </table>



        </div>

         <!-- docuento de la planilla que puede coincider con el contrato principal -->
         @if($padre!=0)
         <div class="contenido">
            <table class="styled-table" >
            <thead>
                    <tr  align="center">
                        <td class="td-texto-titulo" >
                            <b>Dcouemnto Asociado a la Planilla </b>
                        </td>
                        <td class="td-texto-titulo" >
                            <b>Fecha de Firma </b>
                        </td>
                        <td class="td-texto-titulo" >
                            <b>Monto Aprobado </b>
                        </td>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                                            
                        <td class="td-texto" width="70%">
                        <b> {{$documento_codigo}}</b> <br>{{$documento_nombre}}
                        </td>
                        <td class="td-texto" width="10%" align="center">
                            {{$documento_firma}}
                        </td>
                        <td class="td-texto" align="right">
                            {{$documento_monto}}
                        </td>

                    </tr>
                    </tbody>
                    
                </table>



            </div>
        </div>
        @endif

        <!-- Informacion de la planilla eNCABEZADO-->

        <div class="contenido">
            @if ($nombre_reporte != "PLANILLA DE AVANCE")
                <table class="styled-table" >
                <thead>
                <tr  align="center"> 
                            <td colspan="4" class="td-texto-titulo" >
                                <b>INFORMACION DE LA PLANILLA </b>
                            </td>
                        </tr>
                        <tr  align="center">
                            <td class="td-texto-titulo" >
                                <b>Referencia </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>NURI Correspondencia </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>Fecha Panilla </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>Monto Panilla </b>
                            </td>
                            
                        </tr>
                        </thead>
                    <tbody>
                        <tr>
                                                
                            <td class="td-texto" width="50%">
                            {{$referencia}}
                            </td>
                            <td class="td-texto" width="20%" align="center">
                                {{$nuri_planilla}}
                            </td>
                            <td class="td-texto" align="center">
                                {{$fecha_planilla}}
                            </td>
                            <td class="td-texto" align="right">
                                {{$total_planilla}}
                            </td>
                        </tr>   
                        </tbody>
                    </table>
            @else
                <table class="styled-table" >
                <thead>
                        <tr  align="center"> 
                            <td colspan="3" class="td-texto-titulo" >
                                <b>INFORMACION DE LA PLANILLA </b>
                            </td>
                        </tr>
                        <tr  align="center">
                            <td class="td-texto-titulo" >
                                <b>Referencia </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>NURI Correspondencia </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>Fecha Panilla </b>
                            </td>                        
                        </tr>
                        </thead>
                    <tbody>
                        <tr>
                                                
                            <td class="td-texto" width="40%">
                            {{$referencia}}
                            </td>
                            <td class="td-texto" width="30%" align="center">
                                {{$nuri_planilla}}
                            </td>
                            <td class="td-texto" align="center">
                                {{$fecha_planilla}}
                            </td>
                            
                        </tr>
                        
                        <tr  align="center">
                            <td class="td-texto-titulo" >
                                <b>Monto Panilla </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>Descto. Anticipo (20%) </b>
                            </td>
                            <td class="td-texto-titulo" >
                                <b>Retencion (7%) </b>
                            </td>
                        </tr>
                    
                        <tr>
                            <td class="td-texto" align="right">
                                {{$total_planilla}}
                            </td>
                            <td class="td-texto" align="right">
                                {{$anticipo_planilla}}
                            </td>
                            <td class="td-texto" align="right">
                                {{$retencion_planilla}}
                            </td>
                        </tr>

                        </tbody>    
                    </table>
            @endif

            

                

            </div>
        </div>


            <!-- Informacion de la planilla DETALLADO-->
        <div class="contenido">
                @php 
                    
                    $keys = array_keys($planilla); 
                    $salida=[];
                    $filas = count($planilla);
                    $inicial=20;
                    $filas_pagina=35;
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
                                    <td>{{$salida['item_descripcion']}}</td>
                                    <td align="center">{{$salida['simbolo']}}</td>   
                                    <td align="right">{{$salida['cantidad']}}</td>  
                                    <td align="right">{{$salida['precio_unitario']}}</td> 
                                    <td align="right">{{$salida['precio_total']}}</td>

                                    
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


        .styled-table { 
            width: 100%;
            border-collapse: collapse; 
            margin: 10px 0; 
            font-size: 0.7em; 
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