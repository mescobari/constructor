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

            <table class="table-texto" border="1">
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
                <tr>
                                        
                    <td class="td-texto" width="70%">
                    <b> {{$principal_codigo}}</b> <br>{{$principal_nombre}}
                    </td>
                    <td class="td-texto" width="10%" align="center">
                        {{$principal_firma}}
                    </td>
                    <td class="td-texto" align="right">
                        {{$principal_monto}}
                    </td>

                </tr>
               
                
            </table>



        </div>

         <!-- docuento de la planilla que puede coincider con el contrato principal -->
         @if($padre!=0)
         <div class="contenido">
            <table class="table-texto" border="1">
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
                
                    
                </table>



            </div>
        </div>
        @endif

        <!-- Informacion de la planilla eNCABEZADO-->

        <div class="contenido">
            @if ($nombre_reporte != "PLANILLA DE AVANCE")
                <table class="table-texto" border="1">
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
                        
                    </table>
            @else
                <table class="table-texto" border="1">
            
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

                        
                    </table>
            @endif

            

                

            </div>
        </div>

        <!-- Informacion de la planilla DETALLADO-->
        <div class="contenido">
        
            <table class="table-texto" border="1">
            <tr align="center">
                <td colspan="6"><b>Items de la Planilla</b></td>  
                
            <tr>
            <tr align="center">
                <td><b>Codigo</b></td>  
                <td><b>Descripcion</b></td>
                <td><b>Unidad</b></td>   
                <td><b>Cantidad</b></td>  
                <td><b>Prec. Unitario</b></td> 
                <td><b>prec. Total</b></td>
            <tr>

          
            @foreach($planilla as $key => $item)
           
                <tr>
                    <td>{{$item['item_codigo']}}</td>  
                    <td>{{$item['item_descripcion']}}</td>
                    <td align="center">{{$item['simbolo']}}</td>   
                    <td align="right">{{$item['cantidad']}}</td>  
                    <td align="right">{{$item['precio_unitario']}}</td> 
                    <td align="right">{{$item['precio_total']}}</td>


                <tr>
               
                <div clas='page-break'></div>
                

             @endforeach
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
            border: none;
            margin: 0;
            padding: 0;
            
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
    </style>
</html>