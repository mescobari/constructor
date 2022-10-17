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

            <table class="styled-table1" border="1">
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

       

        
        
        <div class="contenido">

            <table class="styled-table" >
                <thead>
                    <tr align="center">
                        <th colspan="13"><b>Items de la Planilla</b></th>  
                        
                    </tr>
                    <tr align="center">
                        <th colspan='3'><b>Descripcion Item</b></th> 
                        <th colspan='3'><b>Planilla Vigente</b></th>
                        <th colspan='3'><b>Planilla Acumulado</b></th>
                        <th colspan='3'><b>Por Ejecutar</b></th> 
                        <th ><b>%</b></th>                   
                    </tr>
                    <tr align="center">
                        <th><b>Codigo</b></th>  
                        <th><b>Descripcion</b></th>
                        <th><b>Unidad</b></th>   
                        <th><b>Cantidad</b></th>  
                        <th><b>Prec. Unitario</b></th> 
                        <th><b>prec. Total</b></th>
                        <th><b>Cantidad</b></th>  
                        <th><b>Prec. Unitario</b></th> 
                        <th><b>prec. Total</b></th>
                        <th><b>Cantidad</b></th>  
                        <th><b>Prec. Unitario</b></th> 
                        <th><b>prec. Total</b></th>
                        <th><b>Porcentaje</b></th>
                    </tr>

                </thead> 
                <tbody>
                     @for ($i = 0; $i <  count($planilla); $i++)
                               
                        @if ($planilla[$i]['tipo']=='G')
                            <tr style=" background-color: #ff78cb; font-weight: bold;">
                        @else
                            <tr>
                        @endif
                            <td>{{$planilla[$i]['item_codigo']}}({{$planilla[$i]['tipo']}})</td>  
                            <td width="50%">{{$planilla[$i]['item_descripcion']}}</td>
                            <td align="center">{{$planilla[$i]['simbolo']}}</td>   
                            <td align="right">{{$planilla[$i]['vig_cant']}}</td>  
                            <td align="right">{{$planilla[$i]['vig_pu']}}</td> 
                            <td align="right" width="15%">{{$planilla[$i]['vig_pt']}}</td>
                            <td align="right">{{$planilla[$i]['acum_cant']}}</td>  
                            <td align="right">{{$planilla[$i]['acum_pu']}}</td> 
                            <td align="right" width="15%">{{$planilla[$i]['acum_pt']}}</td>
                            <td align="right">{{$planilla[$i]['diff_cant']}}</td>  
                            <td align="right">{{$planilla[$i]['diff_pu']}}</td> 
                            <td align="right" width="15%">{{$planilla[$i]['diff_pt']}}</td>
                            <td align="right">{{$planilla[$i]['porcentaje']}}%</td> 
                            
                        </tr>
                               
                    @endfor
                
                </tbody>

            </table>  
        </div>
        <div class="contenido">
            <table class="styled-table" >
            <thead>
                    <tr align="center">
                        <th colspan="7"><b>PLANILLAS DE AVANCE DE OBRAS EMITIDAS</b></th>  
                        
                    </tr>
                    
                    <tr align="center">
                        <th><b>Nombre</b></th>  
                        <th><b>Fecha</b></th>
                        <th><b>#Planilla</b></th>   
                        <th><b>Nuri</b></th>  
                        <th><b>Monto Bs.</b></th> 
                        <th><b>Devol. Anticipo</b></th>
                        <th><b>Retenc 7%</b></th>  
                    </tr>

                </thead> 
                <tbody>
                @for ($i = 0; $i <  count($certificados); $i++)
                               
                              
                        <tr>
                    
                        <td width="40%">{{$certificados[$i]['nombre']}} - {{$certificados[$i]['referencia']}}</td>  
                        <td >{{$certificados[$i]['fecha_planilla']}}</td>
                        <td align="center">{{$certificados[$i]['numero_planilla']}}</td>   
                        <td>{{$certificados[$i]['nuri_planilla']}}</td>  
                        <td align="right">{{$certificados[$i]['total_planilla']}}</td> 
                        <td align="right">{{$certificados[$i]['anticipo_planilla']}}</td>  
                        <td align="right">{{$certificados[$i]['retencion_planilla']}}</td> 
                                                
                    </tr>
                            
                @endfor



                </tbody>
            </table>  
        </div>
       
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
            font-size: 1em; 
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