<template>
    <div>        
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">Repositorio de Documentos</h3>
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
                                <label for="nombre">Seleccione Contrato:</label>
                                <v-select label="nombre" :options="proyectos" v-model="proyecto" placeholder="Selecione un contrato"  
                                @input="leerRepo(proyecto.id)">
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

                    <ul v-if="proyecto.id">
                        <li v-for="item of repositorio">
                            <a :href=" item " target="_blank">{{ item.substring(46) }}</a>
                             
                        </li>
                    </ul>



                </div>
              </div>
              <!-- /.card-body -->
            </div>

<hr>

       

                





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
            repositorio:[],
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


        },

        async leerRepo(id) {
           console.log (this.proyecto.nombre);
            // leemos el directorio constuctor
            var respuesta = await axios.get('repositorio/'+id);
            console.log('============leerRepo: voviendo del backend');
            console.log(respuesta.data);
               
            

                

            this.repositorio =  respuesta.data;





         },

         
    },
    created(){
        this.busca_proyectos();
    },
}
</script>

<style>

</style>