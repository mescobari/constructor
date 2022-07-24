<template>
    <div>        
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">REPORTE PLANIFICACIÓN</h3>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                        Crear Cofinanciador
                    </button> -->
                </div>
            </div>
            <br>
            <div class="card-body">                 
                <div class="container p-3 border rounded mb-3">
                    <div class="row">
                        <div class="col-md-10">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Proyecto:</label>
                                <v-select label="nombre" :options="proyectos" v-model="proyecto" placeholder="Selecione un departamento">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-2">          
                            <div class="form-group">
                                <label for="" class="text-white"> Boton Buscar</label>
                                <button type="button" class="form-control btn btn-primary btn-md"  @click="buscar();">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>150</h3> -->
                            <!-- <h4>Ficha del Proyecto</h4> -->
                            <h4>Ficha del Proyecto</h4>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="far fa-envelope"></i>
                        </div>
                        <a :href="'ficha_proyecto/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                            <h4>Localización del Proyecto</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-flag"></i>
                        </div>
                        <a :href="'ficha_proyecto_localizacion/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>44</h3> -->
                            <h4>Estructura de Financiamiento</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-copy"></i>
                        </div>
                        <a :href="'ficha_proyecto_estructura_financiamiento/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>65</h3> -->
                            <h4>Repositorio de Documentos</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-star"></i>
                        </div>
                        <a :href="'ficha_proyecto_documentos/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>


 <!-- Desde aqui Mod MAx -->

<div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                        <div class="inner">
                            <br><br>
                            <h4>Matriz del Marco Logico</h4>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="far fa-flag"></i>
                        </div>
                        <a :href="'mml_proyecto/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                     <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>65</h3> -->
                            <h4>Repositorio de Documentos</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-star"></i>
                        </div>
                        <a :href="'ficha_proyecto_documentos/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                        </div>
                    </div>
                </div>

  <!-- / aqui termina Mod MAx -->


            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{            
            proyectos:[],
            proyecto:{},
        }
    },
    methods:{        
        async busca_proyectos(){
            var respuesta = await axios.get('proyectos_de_institucion_reporte');
            this.proyectos = respuesta.data;
        }
    },
    created(){
        this.busca_proyectos();
    },
}
</script>

<style>

</style>