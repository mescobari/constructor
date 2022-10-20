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
               

                <div class="row">
                    <div class="col-md-12">
                        <center>
                             <h3>  {{ proyecto }}</h3>
                        </center>
                    </div>
                </div>

                 <hr>


            <div class="card card-primary shadow">
              <div class="card-header">
                <h3 class="card-title">Avance Finaciero</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="row">
                    <div class="col-lg-12 col-6">
                        <div class="small-box bg-danger">
                            Aqui pondremos el grafico
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

<hr>

        <div class="card card-success shadow">
              <div class="card-header">
                <h3 class="card-title">Avance Fisico</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    
                    <div class="col-lg-12 col-6">
                        <div class="small-box bg-danger">
                        
                       Aqui el avance fisico
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
    props : ['contrato_id', 'proyecto'],
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