<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">Ubicación Proyecto</h3>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                        Crear Ubicación
                    </button> -->
                </div>
            </div>
            <br>
            <div class="card-body"> 
                <div class="row">
                    <div class="col-md-4">          
                        <div class="form-group">
                            <label for="codsisin">Codsisin:</label>
                            <input type="text" class="form-control" v-model="jsonData.proyectos.codsisin" readonly>
                        </div>
                    </div>
                    <div class="col-md-8">          
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" v-model="jsonData.proyectos.nombre" readonly>
                        </div>
                    </div>
                </div>
                <div class="container p-3 border rounded">
                    <div class="row">
                        <div class="col-md-5">          
                            <div class="form-group">
                                <label for="codsisin">Nombre a Buscar:</label>
                                <input type="text" class="form-control" v-model="jsonData.nombreBuscar">
                            </div>
                        </div>
                        <div class="col-md-5">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Departamento:</label>
                                <v-select label="nombre" :options="departamentos" v-model="jsonData.departamento" placeholder="Selecione un departamento">
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
                <hr>
                <!-- tabla -->
                <div class="table-responsive">
                    <label for=""><span>Area de intervencion del Proyecto</span></label>
                    <vue-bootstrap4-table :rows="rows" :columns="columns" :config="configTablas" :classes="configTablas.classes">
                        <template slot="global-search-clear-icon">
                            <i class="fas fa-times-circle"></i>
                        </template>
                        <template slot = "paginataion-previous-button">
                            <span class="text-primary"><i class="fas fa-angle-double-left"></i></span> Anterior
                        </template>
                        <template slot = "paginataion-next-button">
                            Siguiente <span class="text-primary"><i class="fas fa-angle-double-right"></i></span>
                        </template>
                        <template slot = "pagination-info" slot-scope = "props">
                            Mostrando: {{props.currentPageRowsLength}} de: {{props.filteredRowsLength}} |
                            de un total de: {{props.originalRowsLength}} Registros Obtenidos
                        </template>
                        <template slot = "selected-rows-info" slot-scope = "props">
                            Número total de filas seleccionadas: {{props.selectedItemsCount}}
                        </template>

                        <template slot="simple-filter-clear-icon">
                            <i class="fas fa-times-circle"></i>
                        </template>
                        <template slot = "sort-asc-icon">
                            <span class="text-primary"><i class = "fas fa-arrow-up"> </i></span>
                        </template>
                        <template slot = "sort-desc-icon">
                            <span class="text-danger"><i class = "fas fa-arrow-down"> </i></span>
                        </template>
                        <template slot = "no-sort-icon">
                            <i class = "fas fa-sort"> </i>
                        </template>
                        <template slot="aprobacion" slot-scope="props">
                        <div v-if="props.row.soli_estado=='R'">
                            <button class="btn btn-outline btn-danger dim" type="button" @click="aprobarSolicitud(props.row)"><i class="fa fa-thumbs-o-down"></i></button>
                        </div>
                        <div v-else>
                            <button class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-thumbs-o-up"></i></button>
                        </div>
                        </template>
                        <template slot="descripcion"  slot-scope="props">
                            <div class="btn-group"  v-html="props.row.descripcion">
                            </div>
                        </template>
                        <template slot="acciones" slot-scope="props">
                            <div class="btn-group">
                                <!-- <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#intervencion" @click="ModalModificar(props.row);"><span><i class="fa fa-user-edit"></i></span></button> -->
                                <button type="button" class="btn btn-outline-danger ml-1" @click="eliminarUbicacion(props.row.id);"><span><i class="fa fa-trash-alt"></i></span></button>                
                            </div>
                        </template>
                    </vue-bootstrap4-table>
                </div>
            </div>        
        </div>
        <!-- modal seleccion de proyecto -->
        <div class="modal fade" id="ubicacion_modal_seleccion_proyecto" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="ubicacion_modal_seleccion_proyectoTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="ubicacion_modal_seleccion_proyectoTitle">{{jsonData.nombreInstitucion}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">   
                        <div class="row">
                            <div class="col-md-12">   
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="tipo_intervencion">Proyecto:</label>
                                        <v-select label="nombre" :options="proyectos" v-model="jsonData.proyectos" placeholder="Selecione un proyecto">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>    
                            </div>                             
                        </div>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="buscarUbicaciones();">Seleccionar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal asignacion de ubicaciones -->
        <div class="modal fade" id="ubicacion_modal_seleccion_ubicaciones" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="ubicacion_modal_seleccion_ubicacionesTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="ubicacion_modal_seleccion_ubicacionesTitle">Registros que coinciden con la busqueda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">   
                        <div class="row"> 
                            <div class="col-md-12">          
                                <div style="width:100%;">
                                    <center><img :src="'../img/sistema-front-end/loading.gif'" alt=""  class="img-avatar" id="cargando"></center>
                                </div>   
                                
                                <div class="table-responsive">     
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Departamento</th>
                                                <th scope="col">Provincia</th>
                                                <th scope="col">Municipio</th>
                                                <th scope="col">Comunidad</th>
                                                <th scope="col">Localidad</th>
                                                <th scope="col">Seleccione</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <span style="display:none;">{{cont=1}}</span>
                                            <tr v-for="ubicacion in ubicaciones" :key="ubicacion.id">
                                                <td>{{cont++}}</td>
                                                <td>{{ubicacion.nombre1}}</td>
                                                <td>{{ubicacion.nombre2}}</td>
                                                <td>{{ubicacion.nombre3}}</td>
                                                <td>{{ubicacion.nombre4}}</td>
                                                <td>{{ubicacion.nombre5}}</td>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" name="ubicacionSelect[]" id="ubicacionSelect" style="width:30px; height:30px;"  :value="ubicacion.id" v-if="ubicacion.estado_check==1" checked>
                                                    <input type="checkbox" class="form-check-input" name="ubicacionSelect[]" id="ubicacionSelect" style="width:30px; height:30px;"  :value="ubicacion.id" v-if="ubicacion.estado_check==0">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                              
                        </div>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" @click="seleccionarProyecto();">Seleccionar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>

        </div>
        <configuraciones :configuracion="datosEnviarConfiguracion" @enviaConfiguracionHijoAPadre="funcionRespuestaConfig" ref="RecuperaConfig"></configuraciones>
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
export default {
    data(){
        return{
            proyectos:[],
            departamentos:[],
            ubicaciones:[],
            jsonData:{
                nombreBuscar:"",
                nombreInstitucion:null,
                proyectos:[],
                codsisin:"",
                nombre:"",
                departamento:null,
                ubicaciones:[],
            },
            rows: [],
            columns: [
                { label: "#",               name: "id",                   filter: { type: "simple", placeholder: "#", },                sort: true, uniqueId: true, },
                { label: "Departamento",    name: "nombre1",            filter: { type: "simple", placeholder: "Nombre", },              sort: true, },
                { label: "Provincia",       name: "nombre2",    filter: { type: "simple", placeholder: "Sector" },            sort: true, },
                { label: "Municipio",       name: "nombre3",          filter: { type: "simple", placeholder: "Descripción" },       sort: true, },
                { label: "Comunidad",       name: "nombre4",     filter: { type: "simple", placeholder: "Fecha Aprobación" },  sort: true, },
                { label: "Localidad",       name: "nombre5",        filter: { type: "simple", placeholder: "Duración Días" },     sort: true, },
                { label: "Acciones",        name: "acciones",              sort: false, },
            ],

            datosEnviarConfiguracion:{},        
            configFechas:{},
            configTablas:{},
            configToolBarEditText:{},
        }
    },    
    methods: {        
        async verificar_un_solo_proyecto(){
            var respuesta = await axios.get('proyectos_de_institucion');
            if(respuesta.data.cantidad > 1){
                this.jsonData.nombreInstitucion = respuesta.data.institucion.nombre;
                this.proyectos = respuesta.data.proyectos;
                $("#ubicacion_modal_seleccion_proyecto").modal("show");
            }else{
                if(respuesta.data.cantidad == 1){
                    this.jsonData.proyectos = respuesta.data.proyectos[0];
                }else{
                    alert("usted no tiene proyectos");
                }
            }              
        },
        async listar_departamentos(){
            var respuesta = await axios.get('departamentos');
            this.departamentos = respuesta.data;
        },
        async buscar(){
            $("#ubicacion_modal_seleccion_ubicaciones").modal("show");
            $("#cargando").css("display", "block");
            if(this.jsonData.nombreBuscar+"" != ""){
                var data={
                    'nombreBuscar':this.jsonData.nombreBuscar,
                    'departamento':this.jsonData.departamento,
                    'proyecto':this.jsonData.proyectos,
                }
                console.log(data);
                var respuesta = await axios.post("ubicacionesBuscadas", data);
                console.log(respuesta.data);
                this.ubicaciones = respuesta.data.respuesta;
                this.rows = respuesta.data.usbicacionesSeleccionadas;
                $("#cargando").css("display", "none");
            }else{
                alert("favor de llenar algo en el nombre a buscar");
            }
            $("#cargando").css("display", "none");
        },
        async seleccionarProyecto(){//y guarda ubicacion
            var checks = $('#ubicacion_modal_seleccion_ubicaciones').find('input:checked').toArray().map(item => item.value);
            var data = {
                'localizaciones_id':checks,
                'intervencion':this.jsonData.proyectos,
            }
            console.log(data);
            var respuesta = await axios.post("GuardarUbicaciones", data);
            console.log(respuesta.data);

            this.buscarUbicaciones();
            /*
            checks.forEach(chec => {
                console.log(chec);
            });
            console.log(checks);*/
        },
        async eliminarUbicacion(id){
            var data = {
                'localizaciones_id':id,
                'intervenciones_id':this.jsonData.proyectos.id,
            }
            var respuesta = await axios.post('eliminar_ubicacion', data);
            console.log(respuesta.data);
            this.buscarUbicaciones();
        },
        async buscarUbicaciones(){
            var data = {
                'proyecto':this.jsonData.proyectos,
            }
            var respuesta = await axios.post("BuscaUbicacionesRegistradas", data);
            console.log(respuesta.data);
            this.ubicaciones = respuesta.data.respuesta;
            this.rows = respuesta.data;
        },

        /*********** funciones de configuracion**************/
        funcionRespuestaConfig(configuracion){//funcion recibe la solicitud hecha
            this.configFechas = configuracion.configFechas;
            this.configTablas = configuracion.configTablas;
            this.configToolBarEditText = configuracion.configToolBarEditText;
        },
        funcionRecuperaConfig(){//funcion solicita la configuracion
            this.$refs.RecuperaConfig.RecuperaConfig();//esta es la funcion de mandar configuracion desde hijo
        }
        /*************************fin funciones de configuracion********************** */
    },
    mounted() {
        this.funcionRecuperaConfig();
    },
    created(){
        this.verificar_un_solo_proyecto();
        this.listar_departamentos();
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