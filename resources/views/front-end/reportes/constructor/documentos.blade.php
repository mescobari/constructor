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
                     <tr><td>objeto</td><td>{{$docs_modificatorios[0]['objeto']}}</td></tr>
                     <tr><td>contratante</td><td>{{$docs_modificatorios[0]['contratante']}} - ({{$docs_modificatorios[0]['contratante_sigla']}})</td></tr>
                     <tr><td>contratado</td><td>{{$docs_modificatorios[0]['contratado']}} - ({{$docs_modificatorios[0]['contratado_sigla']}})</td></tr>                     
                     <tr><td>fecha_firma</td><td>{{$docs_modificatorios[0]['codigo']}}</td></tr>
                     <tr><td>modifica</td><td>{{$docs_modificatorios[0]['que_modifica']}}</td></tr>
                     <tr><td>monto_bs</td><td> {{$docs_modificatorios[0]['monto_bs']}}</td></tr>
                     <tr><td>duracion_dias</td><td>{{$docs_modificatorios[0]['duracion_dias']}}</td></tr>
                </tbody>
            </table>

            <h4>DOCUMENTOS QUE MODIFICAN EL CONTRATO </h4>
           @for ($i = 1; $i < count($docs_modificatorios); $i++)
           <table class="styled-table" >
                <thead>
                    <tr>
                        <th  width="20%"><b>Item</b></th>  
                        <th><b>Descripcion</b></th>
                    </tr>
                </thead> 

                <tbody>
                     <tr><td>Tipo de Documento:</td><td>{{$docs_modificatorios[$i]['tipo_doc_nombre']}}</td></tr>
                     <tr><td>codigo</td><td>{{$docs_modificatorios[$i]['codigo']}}</td></tr>
                     <tr><td>nombre</td><td>{{$docs_modificatorios[$i]['nombre']}}</td></tr>
                     <tr><td>objeto</td><td>{{$docs_modificatorios[$i]['objeto']}}</td></tr>
                     <tr><td>contratante</td><td>{{$docs_modificatorios[$i]['contratante']}} - ({{$docs_modificatorios[$i]['contratante_sigla']}})</td></tr>
                     <tr><td>contratado</td><td>{{$docs_modificatorios[$i]['contratado']}} - ({{$docs_modificatorios[$i]['contratado_sigla']}})</td></tr>                     
                     <tr><td>fecha_firma</td><td>{{$docs_modificatorios[$i]['codigo']}}</td></tr>
                     <tr><td>modifica</td><td>{{$docs_modificatorios[$i]['que_modifica']}}</td></tr>
                     <tr><td>monto_bs</td><td> {{$docs_modificatorios[$i]['monto_bs']}}</td></tr>
                     <tr><td>duracion_dias</td><td>{{$docs_modificatorios[$i]['duracion_dias']}}</td></tr>
                </tbody>
            </table>
          


           @endfor
           <div class='page-break'></div>
           <h4>DOCUMENTOS: PLANILLAS DE AVANCE </h4>

           @for ($i = 0; $i < count($avance); $i++)
           <table class="styled-table" >
                <thead>
                    <tr>
                        <th  width="20%"><b>Item</b></th>  
                        <th><b>Descripcion</b></th>
                    </tr>
                </thead> 

                <tbody>
                    
                     <tr><td>codigo</td><td>{{$avance[$i]['codigo']}}</td></tr>
                     <tr><td>nombre</td><td>{{$avance[$i]['nombre']}}</td></tr>
                     <tr><td>objeto</td><td>{{$avance[$i]['objeto']}}</td></tr>
                     <tr><td>fecha_firma</td><td>{{$avance[$i]['fecha_firma']}}</td></tr>
                     <tr><td>total_planilla</td><td>{{$avance[$i]['total_planilla']}}</td></tr>
                     <tr><td>anticipo_planilla</td><td> {{$avance[$i]['anticipo_planilla']}}</td></tr>
                     <tr><td>retencion_planilla</td><td>{{$avance[$i]['retencion_planilla']}}</td></tr>
                </tbody>
            </table>
          


           @endfor



        </div>

      

        <div class="contenido">

        <h4>DOCUMENTOS: SUB CONTRATOS</h4>


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