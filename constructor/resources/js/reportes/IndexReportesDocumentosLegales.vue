<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">REPORTE DOCUMENTOS LEGALES - VIGENCIA</h3>
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
                                <v-select label="nombre" id="nombre" name="nombre" :options="proyectos" v-model="proyecto" @input="cargarDocumentos()">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-2">          
                            <div class="form-group">
                                <label for=""> Fecha Real Inicio</label>
                                <label for="">{{fecha_real_inicio}}</label>
                            </div>
                        </div>
                        <div class="col-md-10">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Documeto:</label>
                                <v-select label="documento" id="nombre2" name="nombre2" :options="documentos" v-model="documento">
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
                            <h4>Imprimir Vigencia</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-envelope"></i>
                        </div>
                        <a :href="'documentos_legales_vigencia/'+documento.id" target="_blank" class="small-box-footer" v-if="documento.id">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                            <h4>Reporte 1</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-flag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>44</h3> -->
                            <h4>Reporte 2</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-copy"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <br><br>
                            <!-- <h3>65</h3> -->
                            <h4>Reporte 3</h4>
                        </div>
                        <div class="icon">
                            <i class="far fa-star"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ir a reporte <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
    import Vue from "vue";
    import vSelect from "vue-select";
    import "vue-select/dist/vue-select.css";
    import VueBootstrap4Table from 'vue-bootstrap4-table';
    import Datepicker from 'vuejs-datepicker';
    import {en, es} from 'vuejs-datepicker/dist/locale'
    import { VueEditor } from "vue2-editor";
    Vue.component("v-select", vSelect);
    import moment from 'moment';
export default {
    data(){
        return{            
            proyectos:[],
            proyecto:{},
            documentos:[],
            documento:{},
            fecha_real_inicio:"",
        }
    },
    methods:{
        async cargarDocumentos(){                        
            if(this.proyecto.fecha_inicial_real != 'undefined' && this.proyecto.fecha_inicial_real != null && this.proyecto.fecha_inicial_real != undefined ){
                var date = moment(new Date(this.proyecto.fecha_inicial_real));
                this.fecha_real_inicio = date.format('DD-MM-YYYY');
            }else{
                this.fecha_real_inicio = "";
            }
            var respuesta = await axios.get('documentos_de_proyecto_reporte/' + this.proyecto.id);
            this.documentos = respuesta.data;            
        },
        async busca_proyectos(){
            var respuesta = await axios.get('proyectos_de_institucion_reporte');
            console.log(respuesta.data);
            this.proyectos = respuesta.data;
        }
    },
    created(){
        this.busca_proyectos();
    },
    components: {
        VueBootstrap4Table,
        Datepicker,
        VueEditor,
    }
}
</script>

<style>

</style>