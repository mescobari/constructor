<template>
<div>
    <div class="modal fade" id="AlertaConfirmacion" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="AlertaConfirmacionTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div :class="'modal-header ' + mensajesAlerta.tipo">
                    <h5 class="modal-title" id="AlertaConfirmacionTitle">{{mensajesAlerta.titulo}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">   
                        <div class="container"> 
                    <div class="row">                           
                            <div class="col-md-12">                    
                                <center><h2><b>{{mensajesAlerta.contenidoCabecera}}</b></h2></center>
                                <br>
                                <h4>{{mensajesAlerta.contenidoCuerpo}}</h4>
                                <br>
                                <h3>{{mensajesAlerta.contenidoPie}}</h3>
                            </div>
                        </div>
                    </div>           
                </div>
                <div class="modal-footer">
                    <button type="button"  @click="confirmado();"  class="btn btn-success" data-dismiss="modal">{{mensajesAlerta.tituloBotonUno}}</button>
                    <button type="submit"  @click="rechazado();" class="btn btn-danger" data-dismiss="modal">{{mensajesAlerta.tituloBotonDos}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            //
        }
    },  
    props:{
        mensajesAlerta:null ,
    },
    methods: {
        abrirAlerta(){
            $("#AlertaConfirmacion").modal("show");
        },
        confirmado(){
            this.mensajesAlerta.respuesta = true;
            this.$emit('escucharAlerta', this.mensajesAlerta);
        },
        rechazado(){
            this.mensajesAlerta.respuesta = false;
            this.$emit('escucharAlerta', this.mensajesAlerta);
        }
    }
}
</script>

<style>

</style>