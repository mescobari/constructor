<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">Responsables del Proyecto</h3>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                        Crear Ubicación
                    </button> -->
                </div>
            </div>
            <br>
            <div class="card-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: center;">
                            <h3> {{ jsonData.nombreInstitucion }} ({{ this.jsonData.institucion_id }})</h3>
                        </div>
                    </div>
                </div>

                <hr>
               
              
                    <div class="row">

                        <div class="col-md-2">          
                            <div class="form-group">
                                <label for="codsisin">Fecha de Asignacion</label>
                                <datepicker             
                                    :language="configFechas.es"
                                    :placeholder="configFechas.placeholder"
                                    :calendar-class="configFechas.nombreClaseParaModal"
                                    :input-class="configFechas.nombreClaseParaInput"
                                    :monday-first="true"
                                    :clear-button="true"
                                    :clear-button-icon="configFechas.IconoBotonBorrar"
                                    :calendar-button="true"                                            
                                    :calendar-button-icon="configFechas.IconoBotonAbrir"
                                    calendar-button-icon-content=""
                                    :format="configFechas.DatePickerFormat"
                                    :full-month-name="true"                                    
                                    :bootstrap-styling="true"
                                    :disabled-dates="configFechas.disabledDates"
                                    :typeable="configFechas.typeable"

                                    v-model="jsonData.fecha_inicial"
                                >
                                </datepicker>
                            </div>
                        </div>

                        <div class="col-md-3">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Funcionario:</label>
                                <v-select label="nombresAP" :options="funcionarios" v-model="jsonData.funcionario" placeholder="Selecione un funcionario">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-3">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Unidad Ejecutora:</label>
                                <v-select label="nombre" :options="unidad_ejecutoras" v-model="jsonData.ue" placeholder="Selecione Unidad Ejecutora">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-4">          
                            <div class="form-group">
                                <label for="codsisin">Seleccione Contrato:</label>
                                <v-select label="nombre" :options="contratos" v-model="jsonData.cp" placeholder="Selecione Contrato">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>


                       

                    </div>
                     <div class="row" v-show="editar">
                        <div class="col-md-5">          
                            <div class="form-group">
                                <label for="codsisin">Fecha de Baja (final):{{editar}}</label>
                                <datepicker             
                                    :language="configFechas.es"
                                    :placeholder="configFechas.placeholder"
                                    :calendar-class="configFechas.nombreClaseParaModal"
                                    :input-class="configFechas.nombreClaseParaInput"
                                    :monday-first="true"
                                    :clear-button="true"
                                    :clear-button-icon="configFechas.IconoBotonBorrar"
                                    :calendar-button="true"                                            
                                    :calendar-button-icon="configFechas.IconoBotonAbrir"
                                    calendar-button-icon-content=""
                                    :format="configFechas.DatePickerFormat"
                                    :full-month-name="true"                                    
                                    :bootstrap-styling="true"
                                    :disabled-dates="configFechas.disabledDates"
                                    :typeable="configFechas.typeable"

                                    v-model="jsonData.fecha_final"
                                >
                                </datepicker>
                            </div>
                        </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="codsisin">Motivo:</label>                                
                                    <vue-editor 
                                        v-model="jsonData.motivo"
                                        :editor-toolbar="configToolBarEditText"
                                    ></vue-editor>
                                </div>
                            </div>
                     </div>

                     <div class="row">
                        <div class="col-md-10"></div> 
                        <div class="col-md-2">          
                            <div class="form-group">
                                <label for="" class="text-white"> Boton Buscar</label>
                                <!-- <button type="button" class="form-control btn btn-success btn-md"  @click="guardar();">Grabar</button>-->
                                <button type="button" class="form-control btn btn-success btn-md" @click="guardar();" v-if="btnguardar"><i class="fas fa-list"></i> Grabar Responsable</button>
                            </div>
                        </div>
                    </div> 
                
                <hr>
                <!-- tabla -->
                <div class="table-responsive">
                    <label for=""><span>Historico de responsables del Proyecto</span></label>
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
                        <div v-if="props.row.fecha_final == ''">
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
                                
                                <button type="button" class="btn btn-outline-success ml-1"
                                    @click="downloadDocument(props.row)"><span><i
                                class="far fa-file-pdf"></i> </span></button>
                                <button type="button" class="btn btn-outline-warning ml-1" data-toggle="modal"
                                    data-target="#contrato" @click="bajaResponsable(props.row);"><span><i
                                class="fa fa-user-edit"></i></span></button>
                            <button type="button" class="btn btn-outline-danger ml-1"
                                    @click="deleteResponsable(props.row);"><span><i
                                class="fa fa-trash-alt"></i></span></button>
                           
                           
                           
                           
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="buscarResponsables();">Seleccionar Proyecto</button>
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
            funcionarios:[],
            unidad_ejecutoras:[],
            contratos:[],
            btnguardar:true,
            editar:false,
            jsonData:{
                nombreBuscar:"",
                nombreInstitucion:null,
                proyectos:[],                
                codsisin:"",
                nombre:"",
                funcionario:null,  
                ue:null,
                cp:null,             
                fecha_inicial:'',
                fecha_final:'',
                motivo:null,
            },
            rows: [],
            columns: [
                { label: "Funcionario",    name: "persona",
                   filter: { type: "simple", placeholder: "funcionario", },
                   sort: true, 
                },

                { label: "Contrato",       name: "contrato",    filter: { type: "simple", placeholder: "Apellidos" },            sort: true, },
                { label: "Uni. Ejecutora",       name: "uni_eje",          
                  filter: { type: "simple", placeholder: "Unidad Ejecutora" },       
                  sort: true, 
                },
                { label: "Fecha inicial",       name: "fecha_inicial",     filter: { type: "simple", placeholder: "Fecha inicial" },  sort: true, },
                { label: "Fecha Final",       name: "fecha_final",        filter: { type: "simple", placeholder: "Fecha Final" },     sort: true, },
                { label: "Observaciones",       name: "motivo",        filter: { type: "simple", placeholder: "Observaciones" },     sort: true, },
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
            //en el caso EBC se debe verificar 
            var respuesta = await axios.get('proyectos_de_institucion');
            
            if(respuesta.data.cantidad > 1){
                this.jsonData.nombreInstitucion = respuesta.data.institucion.nombre;
                this.jsonData.institucion_id = respuesta.data.institucion.id;
                this.proyectos = respuesta.data.proyectos;
                // no es necesario mostrar el modal, solo mostramos un titulo la institucion
                //$("#ubicacion_modal_seleccion_proyecto").modal("show");
            }else{
                if(respuesta.data.cantidad == 1){
                    this.jsonData.proyectos = respuesta.data.proyectos[0];
                }else{
                    alert("usted no tiene proyectos");
                }
            } 
            this.buscarResponsables();             
        },

        async listar_funcionarios(){
            var respuesta = await axios.get('funcionarios_de_institucion');
            this.funcionarios = respuesta.data;
           
        },

        async listar_UE(){
            var respuesta = await axios.get('listar_ue');
            const principales = respuesta.data.map((item) =>{
                item.nombre=item.nombre.substr(15);
                return item;
            });          
            this.unidad_ejecutoras = principales;           
        },

        async listar_CP(){
            var respuesta = await axios.get('documents');
            const principales = respuesta.data.filter((item) => item.document_types_id === 1)
            console.log('Documentos Principales', principales);
            this.contratos = principales;
            
        },

         async guardar(){
              if ( this.jsonData.funcionario.id != null ){
                    var institucion_id = this.jsonData.institucion_id ;
                    var funcionario_id = this.jsonData.funcionario.id;
                    var unidad_ejecutora_id = this.jsonData.ue.id;                    
                    var contrato_id = this.jsonData.cp.id;

                    var fecha = this.jsonData.fecha_inicial;                  
                    var fecha_inicial =  fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();
                
                   

                    var fecha = this.jsonData.fecha_final;
                    
                    if ( fecha === '' ){
                        var fecha_final = '';
                    } else {
                        var fecha_final =  fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();
                    }

                    var motivo = this.jsonData.motivo;
                    
                    var datos_jsonData = {
                            "institucion_id": institucion_id,
                            "funcionario_id": funcionario_id,
                            "unidad_ejecutora_id": unidad_ejecutora_id,
                            "documents_id": contrato_id,
                            "fecha_inicial": fecha_inicial,
                            "fecha_final": fecha_final,
                            "motivo": motivo
                            
                            }
                   var respuesta = await axios.post('responsables', datos_jsonData);

                 } else {
                    // damos de baja 

                    console.log('estamos aqui listos para dar de baja');
                 }  

                 console.log(respuesta.data);
                 this.buscarResponsables();
        },

        async deleteResponsable(responsable) {
            //se debe poner una funcion de alerta y confirmacion del borrado
            console.log('delte responsabele  '+responsable.id);
            const respuesta = await axios.delete('responsables/' + responsable.id);
            
            await this.buscarResponsables();
        },
        
        async bajaResponsable(responsable) {
            //se debe poner una funcion de alerta y confirmacion del borrado
            console.log('dar de baja responsabele  '+responsable.id);
           
            if ( this.editar == true) {
                    this.editar = false;
                    
                }else {
                    this.editar = true;
                }

           // const respuesta = await axios.put('responsables/' + responsable.id);
            
            //await this.buscarResponsables();
        },

     
        async buscarResponsables(){
            var data = {
                'institucion_id':this.jsonData.institucion_id,
            }

            var respuesta = await axios.post("buscar_responsables", data);
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
        this.listar_funcionarios();
        this.listar_UE();
        this.listar_CP();
       

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