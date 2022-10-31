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
                labels: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio' ], //https://www.adictosaltrabajo.com/2022/07/01/como-anadir-graficos-en-tu-web-con-chart-js/
                datasets: [ { 
                    label: 'Avance finaciero',
                    backgroundColor: ['#FC2525', '#BA55D3', '#9932CC','#9400D3','#8A2BE2', '#8B008B'],
                    // [2.98, 0.491, 0.744, 0.084, 0.037, 0.079, 0.009, 0.017, 0.252, 2.177, 1.747, 1.487, 0.818, 3, 3.5, 2.5]
                    //data: [2.98, 0.491, 0.744, 0.084, 0.037, 0.079, 0.009, 0.017, 0.252, 2.177, 1.747, 1.487, 0.818, 3, 3.5, 2.5]
                    data:[],
                } ]
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
         
            //vamos a filtrar solo los de avance [ 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis' ]
            const avance=respuesta.data.filter((item)=> item.tipo =='Avance' )
            const fecha =[];
            const valores =[];

            avance.forEach((item) => {
                fecha.push(item.f_fecha);
                //valores.push(+item.avance.replace(/,/g, '.')); //convertir string en numero, cambiando , por .
                //valores.push(item.avance);
                valores.push(parseFloat(item.avance));
            });

            console.log(fecha);

            this.chartData.labels=fecha;
            this.chartData.datasets.data=valores;
           

            console.log( this.chartData.datasets.data);


            
            //this.proyectos = principales;


        }
    },
    /*created() {
        console.log('====================== creando ' +this.contrato_id);
        this.avance_finaciero(this.contrato_id);
    },*/
   async mounted() {
        
        console.log('aqsssui estamos montando ' +this.proyecto);
        //this.avance_finaciero(this.contrato_id);
        try{
        var respuesta = await axios.get('../gra_financiero/'+this.contrato_id);           
            console.log(respuesta.data);
         
            //vamos a filtrar solo los de avance [ 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis' ]
            const avance=respuesta.data.filter((item)=> item.tipo =='Avance' )
            const fecha =[];
            const valores =[];

            avance.forEach((item) => {
                fecha.push(item.f_fecha);
                valores.push(+item.avance.replace(/,/g, '.')); //convertir string en numero, cambiando , por .
                //valores.push(item.avance);
                //valores.push(item.avance);
            });

            console.log(valores);

            this.chartData.labels=fecha;
            this.chartData.datasets[0].data=valores;
        }catch(e){
            console.log("error",e);
        }



    },
    

    
}
</script>

<style>

</style>