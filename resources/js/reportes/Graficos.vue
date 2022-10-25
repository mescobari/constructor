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
                             <h3>  {{ proyecto  }}</h3>
                        </center>
                    </div>
                </div>

                 <hr>


            <div class="card card-primary shadow">
              <div class="card-header">
                <h3 class="card-title">Avance Financiero</h3>

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
                        <div class="small-box">
                            <Bar
                                :chart-options="chartOptions"
                                :chart-data="chartData"
                                :chart-id="chartId"
                                :dataset-id-key="datasetIdKey"
                                :plugins="plugins"
                                :css-classes="cssClasses"
                                :styles="styles"
                                :width="width"
                                :height="height"
                            />
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
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


export default {
   // props :  ['contrato_id', 'proyecto'],
   

    name: 'BarChart',
    components: { Bar },
    props: {
        
       
        contrato_id: {
        type: String,
        default: '24'
        },
        proyecto: {
        type: String,
        default: ''
        },

        chartId: {
        type: String,
        default: 'bar-chart'
        },
        datasetIdKey: {
        type: String,
        default: 'label'
        },
        width: {
        type: Number,
        default: 400
        },
        height: {
        type: Number,
        default: 400
        },
        cssClasses: {
        default: '',
        type: String
        },
        styles: {
        type: Object,
        default: () => {}
        },
        plugins: {
        type: Object,
        default: () => {}
        }
    },
    data() {
        return {
            chartData: {
                labels: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio' ],
                datasets: [ { data: [40, 20, 12,20,30, 40] } ]
            },
            chartOptions: {
                responsive: true
            }, 
        }
    },
    methods:{        
        async avance_finaciero(contrato_id){
           
            console.log('======estoy avance_finaciero=========');
            var respuesta = await axios.get('../gra_financiero/'+contrato_id);
           
            console.log(respuesta.data);
            //const principales=respuesta.data.filter((item)=> item.document_types_id===1 )
            //this.proyectos = principales;


        }
    },
    created() {
        console.log('====================== creando ' +this.contrato_id);
        this.avance_finaciero(this.contrato_id);
    },
    mounted() {
        console.log('aqui estamos montando ' +this.proyecto);
    },
    

    
}
</script>

<style>

</style>