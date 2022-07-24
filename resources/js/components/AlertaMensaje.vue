<template>
    <div>    
        <div class="modal fade" id="AlertaMensaje" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="AlertaMensajeTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content-fer modal-content">
                    <div :class="'modal-header-fer modal-header ' + mensajesAlerta.tipo">
                        <h5 class="modal-title" id="AlertaMensajeTitle">{{mensajesAlerta.titulo}}</h5>
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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <center><button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button></center>
                                </div>
                            </div>
                        </div>
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
            $("#AlertaMensaje").modal("show");
        },
    }
}
</script>

<style>

</style>