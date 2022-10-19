<template>
    <div>        
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">Tablero de Control</h3>
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
                        <div class="col-md-12">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Contrato: {{contrato_id}}</label>
                                <v-select label="nombre" :options="proyectos" v-model="proyecto" placeholder="Selecione un contrato">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                       
                    </div>
                </div>


<hr>

                <div class="row">
                    <div class="col-md-12">
                        <center>
                             <h3>  {{ proyecto.nombre }}</h3>
                        </center>
                    </div>
                </div>

                 <hr>


            <div class="card card-primary shadow">
              <div class="card-header">
                <h3 class="card-title">Contratos y Movimientos</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                        <div class="inner">
                            <br><br>
                            <h4>Lista de Documentos</h4>
                            
                        </div>
                        <div class="icon">
                            <i class="far fa-flag"></i>
                        </div>
                        <a :href="'ver_lista_docs/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                     <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <br><br>
                                <!-- <h3>65</h3> -->
                                <h4>Vigencia</h4>
                            </div>
                            <div class="icon">
                                <i class="far fa-star"></i>
                            </div>
                             <a :href="'ver_plazos/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">

                            <div class="inner">
                                <br><br>
                                <h4>Ficha Proyecto</h4>
                            </div>

                            <div class="icon">
                                <i class="far fa-star"></i>
                            </div>
                             <a :href="'ver_ficha/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">
                                Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        





                         </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

<hr>

        <div class="card card-success shadow">
              <div class="card-header">
                <h3 class="card-title">Seguimiento Fisico - Planillas</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                        <div class="inner">
                            <br><br>
                            <h4>Planilla Vigente</h4>
                           
                        </div>
                        <div class="icon">
                            <i class="far fa-envelope"></i>
                        </div>
                        <a :href="'ver_pla_vigente/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                            <h4>Ejecucion Fisica</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-flag"></i>
                        </div>
                        <a :href="'ver_pla_fisico/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <br>
                            <!-- <h3>44</h3> -->
                            <h4>Indicadores Ejecucion Fisica</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-copy"></i>
                        </div>
                        <a :href="'ver_gra_fisico/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <br>
                            <!-- <h3>65</h3> -->
                            <h4>Repositorio de Documentos</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-star"></i>
                        </div>
                        <a :href="'lista_respaldos/'+proyecto.id" target="_blank" class="small-box-footer" v-if="proyecto.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>


                





            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : ['contrato_id'],
    data(){
        return{            
            proyectos:[],
            proyecto:{},
        }
    },
    methods:{        
        async busca_proyectos(){
            //var respuesta = await axios.get('proyectos_de_institucion_reporte');
            //this.proyectos = respuesta.data;
            var respuesta = await axios.get('documents');
            console.log('===============');
            console.log(respuesta.data);
            const principales=respuesta.data.filter((item)=> item.document_types_id===1 )
            this.proyectos = principales;


        }
    },
    created(){
        this.busca_proyectos();
    },
}
</script>

<style>

</style>