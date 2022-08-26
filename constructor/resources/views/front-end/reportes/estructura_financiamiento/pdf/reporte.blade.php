<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REPORTE ESTRUCTURA FINANCIAMIENTO</title>    
</head>
<body>
    <center><h3>ESTRUCTURA DE FINANCIAMIENTO EN ({{$moneda}})</h3></center>
    <br>
    <center><h4>PROYECTO: {{$nombre_proyecto}}</h4></center>
    <br>
    <center><h4>FECHA DE REGISTRO: {{$fecha_registro}}</h4></center>
    <br>
    <div class="bordes-radio-bajo">
        <div class="texto_formulario">            
            <?php echo($glosa);?>
        </div>
    </div>
    <div class="container">
        <h3 class="titulo-table-border">Detalle:</h3>
        <table class="table-border">
            <?php $cont = 0;?>
            @foreach ($componentes['componentes'] as $componente)      
                @if ($cont == 0)                
                    <tr>
                        <td></td>
                        <td style="font-weight: bold">Partida</td>
                        @for ($i = 0; $i < $componentes['cant_cofinanciadores_max']; $i++)
                            <td style="font-weight: bold">Cofinanciador <?php $cont++; echo($cont);?></td>
                        @endfor
                        <td style="font-weight: bold">Total</td>
                    </tr>
                    <?php $cont_partidas = 0;?>
                    @foreach ($componente['partidas'] as $partida)     
                    <tr>  
                        @if ($cont_partidas==0)
                            <td rowspan="<?php echo($componente['cant_partidas']);?>"><?php echo($componente['nombre']);?></td>
                        @endif                     
                        <?php $cont_partidas++;?>
                        <td>
                            <?php echo($partida['nombre']);?>
                        </td>
                        <?php $cont_cofinanciador = 0;?>
                        @foreach ($partida['cofinanciadores'] as $cofinanciador)    
                            <?php $cont_cofinanciador++;?>                                    
                            <td>
                                <?php echo ($cofinanciador['nombre']);?>
                            </td>
                        @endforeach  
                        @if ($componentes['cant_cofinanciadores_max']>$cont_cofinanciador)
                            @for ($j = 0; $j < ($componentes['cant_cofinanciadores_max']-$cont_cofinanciador); $j++)
                                <td></td>
                            @endfor
                        @endif  
                        <td>Total</td>
                    </tr>
                    @endforeach
                @else
                    <?php $cont_partidas = 0;?>
                    @foreach ($componente['partidas'] as $partida)     
                    <tr>  
                        @if ($cont_partidas==0)
                            <td rowspan="<?php echo($componente['cant_partidas']);?>"><?php echo($componente['nombre']);?></td>
                        @endif                     
                        <?php $cont_partidas++;?>
                        <td>
                            <?php echo($partida['nombre']);?>
                        </td>
                        <?php $cont_cofinanciador = 0;?>
                        @foreach ($partida['cofinanciadores'] as $cofinanciador)    
                            <?php $cont_cofinanciador++;?>                                    
                            <td>
                                <?php echo ($cofinanciador['nombre']);?>
                            </td>
                        @endforeach  
                        @if ($componentes['cant_cofinanciadores_max']>$cont_cofinanciador)
                            @for ($j = 0; $j < ($componentes['cant_cofinanciadores_max']-$cont_cofinanciador); $j++)
                                <td></td>
                            @endfor
                        @endif  
                        <td>Total</td>
                    </tr>
                    @endforeach
                @endif
            @endforeach
        </table>
    </div>
    
    <div class="container2">
        <div class="row">            
            <h3>Lista de Documentos Asociados:</h3>
            <table class="table-border2">
                @foreach ($doc_asociados as $item)
                    <tr>
                        <td>
                            <?php echo($item);?>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
<style>
    .bordes-radio-bajo{
        border-radius: 10px;
        border: 1px solid #000022;
        width: 100%;       
    }
    .texto_formulario{
        margin:10px;
    }
    @page {
        margin: 60px 60px 60px 100px !important;/*top, rigth, bootom, left*/
    }
    body { margin: 0px; }
    .container{
        margin-top: 30px;
        width: 100%;
        /* text-align:center; */
        border: 1px solid #000022;
        border-radius: 50px;
    }
    .container2{
        margin-top: 30px;
        width: 100%;
        border: 1px solid #000022;
        border-radius: 15px;
    }
    .row{
        margin: 30px;
    }
    .titulo-table-border{
        margin-left: 30px;
    }
    .table-border{
        width: 90%;
        border: 1px solid #000022;
        margin-left: 30px;
        margin-right: 30px;
        margin-bottom: 30px;

    }
    .table-border tr{
        border: 1px solid #000022;
    }
    .table-border tr td{
        border: 1px solid #000022;
        font-size: 0.7em;
    }
    .table-border2 tr td{
        color: blue;
        font-size: 0.7em;
    }
</style>
</html>