<table width="100%" class="borde1">
    <tr width="">
        <td width="60px" class="">
            <img src="{{$link_img}}" class="imagen_logo_cabecera">
        </td> 
        <td width="200px" class="">
            <center>
                <b class="titulo">{{$titulo_grande}}</b>
                <p class="titulo_institucion">{{$nombre_institucion}}</p>
                <b class="titulo">{{$nombre_reporte}}</b>
            </center>
        </td>       
        <td width="60px" class="">
            <div class="titulo_derecha">
                <b class="titulo_institucion_derecha2">{{$siglas}}</b>
                <p class="titulo_institucion_derecha">{{$documento_codigo}}</p>
                <p class="titulo_institucion_derecha">{{$fecha_hora_emision}}</p>
                <p class="titulo_institucion_derecha">
                    <script type="text/php">
                        $font = $fontMetrics->get_font("arial", "bold");
                        $pdf->page_text(525, 92, "Pág: {PAGE_NUM} / {PAGE_COUNT}", $font, 9, array(0,0,0));
                    </script> 
                </p>  
                <b class="titulo_institucion_derecha2">&nbsp;</b>             
            </div>
        </td>        
    </tr>
</table>
<div class="borde-arriba">
    
</div>
<style>
    .imagen_logo_cabecera{
        width: 60px;
        height: 60px;
    }
    .titulo{
        margin: 0%;
        padding: 0%;
    }
    .titulo_institucion{
        margin-top: 0px;
        color: #FF0000;
    }
    .titulo_institucion_derecha{
        font-size: 0.7em;
        margin-top: 0px;
        margin-bottom: 0px;
        color: #FF0000;
    }
    .titulo_institucion_derecha2{
        /* border: 1px solid #000; */
        font-size: 0.7em;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }
    .titulo_derecha{
        text-align: right;
    }
    #header { position: fixed;  left: 0px; top: 0px; right: 0px; height: 150px; }
    .borde1{
        border-bottom: 1px solid #000;
    }
</style>