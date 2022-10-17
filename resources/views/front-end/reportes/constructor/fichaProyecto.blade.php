<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>DOCUMENTOS</title>    
    </head>
    <body style="border:  1px solid #000; ">
        <div id="header">
            @include('front-end.reportes.includes.cabecera')
        </div>
        <div id="footer">
            @include('front-end.reportes.includes.pie')
        </div>
        
        <div class="contenido">

       
                        
                            <h4>CONTRATO PRINCIPAL</h4>
                            <table class="styled-table" >
                                <thead>
                                    <tr>
                                        <th  width="20%"><b>Item</b></th>  
                                        <th><b>Descripcion</b></th>
                                    </tr>
                                </thead> 

                                <tbody>
                                    <tr><td>Tipo de Documento:</td><td>{{$docs_modificatorios[0]['tipo_doc_nombre']}}</td></tr>
                                    <tr><td>codigo</td><td>{{$docs_modificatorios[0]['codigo']}}</td></tr>
                                    <tr><td>nombre</td><td>{{$docs_modificatorios[0]['nombre']}}</td></tr>
                                    <tr><td>objeto</td><td>{{strip_tags($docs_modificatorios[0]['objeto'])}}</td></tr>
                                    <tr><td>contratante</td><td>{{$docs_modificatorios[0]['contratante']}} - ({{$docs_modificatorios[0]['contratante_sigla']}})</td></tr>
                                    <tr><td>contratado</td><td>{{$docs_modificatorios[0]['contratado']}} - ({{$docs_modificatorios[0]['contratado_sigla']}})</td></tr>                     
                                    <tr><td>fecha_firma</td><td>{{ date("d-m-Y",strtotime($docs_modificatorios[0]['fecha_firma']))}}</td></tr>
                                    <tr><td>modifica</td><td>{{$docs_modificatorios[0]['que_modifica']}}</td></tr>
                                    <tr><td>monto_bs</td><td> Bs. {{number_format($docs_modificatorios[0]['monto_bs'],2,",",".")}}</td></tr>
                                    <tr><td>duracion_dias</td><td>{{number_format($docs_modificatorios[0]['duracion_dias'],0,",",".")}}</td></tr>
                                    <tr><td>fecha_orden_proceder</td><td>{{date("d-m-Y",strtotime($docs_modificatorios[0]['fecha_orden_proceder']))}}</td></tr>
                                    <tr><td>Anticipo</td><td>Bs. {{number_format($docs_modificatorios[0]['anticipo'],2,",",".")}}</td></tr>
                                </tbody>
                            </table>
                        
                    
                  
                         <h4>PLAZOS Y VIGENCIA </h4>
                            <table class="styled-table" >
                            <thead>
                                    <tr>
                                        <th  width="30%"><b>codigo - Descripcion</b></th>  
                                        <th><b>Monto Bs.</b></th>
                                        <th><b>Monto Vigente Bs.</b></th>
                                        <th><b>Plazo (Dias)</b></th>
                                        <th><b>Plazo Vigente (Dias)</b></th>
                                        <th><b>Fecha Conclusion*</b></th>
                                    </tr>
                                </thead> 

                                <tbody>


                        @for ($i = 0; $i < count($docs_modificatorios); $i++)
                        
                        
                                    <tr>
                                    <td>{{$docs_modificatorios[$i]['tipo_doc_nombre']}}-
                                        {{$docs_modificatorios[$i]['codigo']}}
                                        
                                    </td>

                                    <td align="right"> {{number_format($docs_modificatorios[$i]['monto_bs'],2,",",".")}}</td>
                                    <td align="right">{{number_format($docs_modificatorios[$i]['monto_vigente'],2,",",".")}}</td>
                                    <td align="center">{{number_format($docs_modificatorios[$i]['duracion_dias'],0,",",".")}}</td>
                                    <td align="center">{{number_format($docs_modificatorios[$i]['plazo_vigente'],0,",",".")}}</td>
                                    <td align="center">{{$docs_modificatorios[$i]['fecha_estimada']}}</td>
                                    
                                    <tr>
                                    @endfor
                                </tbody>
                            </table>

                        <span>* Fecha estimada de conclusión</span>
                    
                  
          <div class='page-break'></div>
          <h4>II.- Avance financiero </h4>


                <table class="styled-table" >
                            <thead>
                                    <tr>
                                        <th rowspan="2"><b>Fecha</b></th>  
                                        <th rowspan="2"><b>Movimiento</b></th>
                                        <th colspan="3"><b>Contrato</b></th>
                                        <th colspan="2"><b>Avance</b></th>
                                        <th colspan="2"><b>Anticipo</b></th>
                                        <th colspan="2"><b>retencion</b></th>
                                    </tr>
                                    <tr>
                                        
                                        <th ><b>Vigente</b></th>    
                                        <th ><b>Movimiento</b></th>
                                        <th ><b>Saldo</b></th>
                                        <th ><b>Periodo%</b></th>
                                        <th ><b>Acumulado%</b></th>
                                        <th ><b>Movimiento</b></th>
                                        <th ><b>Saldo</b></th>
                                        <th ><b>Movimiento</b></th>
                                        <th ><b>Saldo</b></th>
                                    </tr>

                                </thead> 

                                <tbody>


                        @for ($i = 0; $i < count($avFinan); $i++)
                        
                            @if ($avFinan[$i]['total_planilla']!=0)

                           
                            @php   $letra = "#FF0000"; @endphp

                                    <tr>
                                    <td>{{$avFinan[$i]['f_fecha']}}</td>
                                    <td>{{$avFinan[$i]['numero_planilla']}} - {{$avFinan[$i]['tipo']}}</td>

                                    <td align="right" bgcolor="#f3f3f3"> {{$avFinan[$i]['f_vigente']}}</td>
                                    <td align="right" bgcolor="#f3f3f3"> {{$avFinan[$i]['f_total_planilla']}}</td>
                                    <td align="right" bgcolor="#f3f3f3">{{$avFinan[$i]['f_s_contrato']}}</td>
                                    <td align="right" bgcolor="#f3f3f3">{{$avFinan[$i]['avance']}}%</td>
                                    <td align="right" bgcolor="#f3f3f3">{{$avFinan[$i]['avAcumulado']}}%</td>

                                    <td align="right"> {{$avFinan[$i]['f_anticipo_planilla']}}</td>
                                    <td align="right">{{$avFinan[$i]['f_s_anticipo']}}</td>

                                    <td align="right" bgcolor="#f3f3f3"> {{$avFinan[$i]['f_retencion_planilla']}}</td>
                                    <td align="right" bgcolor="#f3f3f3">{{$avFinan[$i]['f_s_retencion']}}</td>
                                    
                                    <tr>
                            @endif            

                         @endfor
                                </tbody>
                
                   </table>





          <div class='page-break'></div>
          <h4>III.- Avance Fisico </h4>






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