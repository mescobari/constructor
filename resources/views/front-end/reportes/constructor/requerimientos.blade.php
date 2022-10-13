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
                        <tr><td>monto_bs</td><td> {{number_format($docs_modificatorios[0]['monto_bs'],2,",",".")}}</td></tr>
                        <tr><td>duracion_dias</td><td>{{number_format($docs_modificatorios[0]['duracion_dias'],0,",",".")}}</td></tr>
                        <tr><td>fecha_orden_proceder</td><td>{{date("d-m-Y",strtotime($docs_modificatorios[0]['fecha_orden_proceder']))}}</td></tr>
                    </tbody>
            </table>


            @if ($tipo_requerimiento != 'Llave en Mano')

                <h4>I.- REQUERIMIENTO EN OBRA</h4>
            @else
                <h4>I.- SOLICITUD CONTRATO LLAVE EN MANO</h4>

            @endif
            <table class="styled-table" >
                    <thead>
                        <tr>
                            <th  width="25%"><b>Item</b></th>  
                            <th><b>Descripcion</b></th>
                        </tr>
                    </thead> 

                    <tbody>
                        <tr><td>Identificaciòn Requerimiento</td><td>{{$requerimiento->correlativo_requerimiento}}</td></tr>    
                        <tr><td>Tipo de Documento:</td><td>Requerimiento de: {{$tipo_requerimiento}}</td></tr>
                        <tr><td>fecha Requerimiento</td><td>{{date("d-m-Y",strtotime($requerimiento->fecha_requerimiento))}}</td></tr>
                        <tr><td>NURI</td><td>{{$requerimiento->nuri_requerimiento}}</td></tr>
                        <tr><td>Descripción</td><td>{{strip_tags($requerimiento->descripcion_requerimiento)}}</td></tr>
                   
                    </tbody>
            </table>

            @if ($tipo_requerimiento != 'Llave en Mano')   
                <h4>Detalle: Items Solicitados</h4>
                <table class="styled-table" >
                        <thead>
                            <tr>
                                <th ><b>Código</b></th>  
                                <th width="30%"><b>Descripcion</b></th>
                                <th ><b>Unidad</b></th>  
                                <th><b>Cantidad</b></th>

                                <th ><b>Horas Req.</b></th>  
                                <th><b>Dias Req.</b></th>
                                <th ><b>Plazo Ejecución</b></th>  
                                <th><b>Prec. Referencial</b></th>


                            </tr>
                        </thead> 

                        <tbody>
                        @for ($i = 0; $i < count($requerimientos); $i++)          
            
                            <tr>
                                <td>{{$requerimientos[$i]['codigo_recurso']}}</td>
                                <td>{{$requerimientos[$i]['descripcion_recurso']}}</td>
                                <td>{{$requerimientos[$i]['simbolo']}}</td>
                                <td align="center">{{$requerimientos[$i]['cantidad_recurso']}}</td>
                                <td align="center">{{$requerimientos[$i]['horas_recurso']}}</td>
                                <td align="center">{{$requerimientos[$i]['dias_recurso']}}</td>
                                <td align="center">{{$requerimientos[$i]['tiempo_total_recurso']}}</td>
                                <td align="right">{{$requerimientos[$i]['precio_ref']}}</td>

                                                            
                            <tr>

                        @endfor




                        </tbody>
                </table>

                <div class='page-break'></div>
                
                <h4>II.- TRABAJOS A SER ENCARADOS</h4>
           
            @endif


           

            <table class="styled-table" >
                    <thead>
                        <tr>
                            <th ><b>Descripcion</b></th>  

                            </tr>
                    </thead> 
                    <tbody>
                        
                        <tr><td>{{strip_tags($requerimiento->trabajos_encarados)}}</td></tr>
                   
                    </tbody>

            </table>
           


            @if ($tipo_requerimiento != 'Llave en Mano')

                <h4>Detalle: Relacion con itemes del contrato principal</h4>
            @else
                <h4>Detalle: Items a ser contratados</h4>

            @endif

            <table class="styled-table" >
                    <thead>
                        <tr>
                            <th ><b>Código</b></th>  
                            <th width="30%"><b>Descripcion</b></th>
                            <th ><b>Unidad</b></th>  
                            <th><b>Vigente</b></th>

                            <th ><b>Avance Acumulado</b></th>  
                            <th><b>Por Ejecutar</b></th>
                            <th ><b>Avance Req.</b></th>  
                            <th><b>Pre. Unit.</b></th>
                            <th><b>
                                @if ($tipo_requerimiento != 'Llave en Mano')
                                    Por Facturar
                                @else
                                    Precio Referencial
                                @endif
                                                        
                             </b></th>

                        </tr>
                    </thead> 

                    <tbody>
                    @for ($i = 0; $i < count($req_relacion); $i++)          
           
                        <tr>
                            <td>{{$req_relacion[$i]['item_codigo']}}</td>
                            <td>{{$req_relacion[$i]['item_descripcion']}}</td>
                            <td>{{$req_relacion[$i]['simbolo']}}</td>
                            <td align="right">{{$req_relacion[$i]['vigente']}}</td>
                            <td align="right">{{$req_relacion[$i]['avance']}}</td>
                            <td align="right">{{$req_relacion[$i]['saldo']}}</td>
                            <td align="right">{{$req_relacion[$i]['estimado']}}</td>
                            <td align="right">{{$req_relacion[$i]['precio_unitario']}}</td>
                            <td align="right">{{$req_relacion[$i]['monto']}}</td>

                                                        
                        <tr>

                    @endfor




                    </tbody>
            </table>

            @if ($tipo_requerimiento != 'Llave en Mano')   
                <h4>III.- GASTOS GENERALES</h4>
                <table class="styled-table" >
                        <thead>
                            <tr>
                                <th ><b>Descripcion</b></th>  

                                </tr>
                        </thead> 
                        <tbody>
                            
                            <tr><td>{{strip_tags($requerimiento->trabajos_encarados)}}</td></tr>
                    
                        </tbody>

                </table>
                <h4>Detalle: Gastos Generales -Otros Gastos </h4>
                <table class="styled-table" >
                        <thead>
                            <tr>
                                <th ><b>Código</b></th>  
                                <th width="20%"><b>Descripcion</b></th>
                                <th ><b>Unidad</b></th>  
                                <th><b>Cantidad</b></th>
                                <th><b>Prec. Unit.</b></th>
                                <th ><b>Prec. Total</b></th>  
                                <th width="20%"><b>Justificación</b></th>

                            </tr>
                        </thead> 

                        <tbody>
                        @for ($i = 0; $i < count($req_otros); $i++)          
            
                            <tr>
                                <td>{{$req_otros[$i]['codigo_recurso']}}</td>
                                <td>{{$req_otros[$i]['descripcion_recurso']}}</td>
                                <td align="center">{{$req_otros[$i]['simbolo']}}</td>
                                <td align="right">{{$req_otros[$i]['cantidad_otros']}}</td>
                                <td align="right">{{$req_otros[$i]['monto_otros']}}</td>
                                <td align="right">{{$req_otros[$i]['total_otros']}}</td>
                                <td>{{$req_otros[$i]['explicar_otros']}}</td>
                                                            
                            <tr>

                        @endfor




                        </tbody>
                </table>
            @endif   





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