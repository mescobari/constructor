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
                        <div class="small-box bg-danger">
                            Aqui pondremos el grafico
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
import {Chart} from 'Chart.js';
export default {
    props :  ['contrato_id', 'proyecto'],
    name: 'BarChart',
  components: { Bar },
  props: {
   
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
        labels: [ 'January', 'February', 'March' ],
        datasets: [ { data: [40, 20, 12] } ]
      },
      chartOptions: {
        responsive: true
      }
    }
  }
}
</script>

<style>

</style>