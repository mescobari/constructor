<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">CONSULTA REQUERIMIENTOS EN OBRA</h3>
                <div class="card-tools">

                </div>
            </div>
            <br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <h3> {{ jsonData.proyectos.nombre }}</h3>
                        </center>
                    </div>
                </div>


                <!--  row para la tabla mostrar detalles del modelo y acciones //////////-->
                <div class="row">

                    <div class="table-responsive">
                        <vue-bootstrap4-table :rows="rows" :columns="columns" :config="configTablas"
                                              :classes="configTablas.classes">
                            <template slot="global-search-clear-icon">
                                <i class="fas fa-times-circle"></i>
                            </template>
                            <template slot="paginataion-previous-button">
                                <span class="text-primary"><i class="fas fa-angle-double-left"></i></span> Anterior
                            </template>
                            <template slot="paginataion-next-button">
                                Siguiente <span class="text-primary"><i class="fas fa-angle-double-right"></i></span>
                            </template>
                            <template slot="pagination-info" slot-scope="props">
                                Mostrando: {{ props.currentPageRowsLength }} de: {{ props.filteredRowsLength }} |
                                de un total de: {{ props.originalRowsLength }} Registros Obtenidos
                            </template>
                            <template slot="selected-rows-info" slot-scope="props">
                                Número total de filas seleccionadas: {{ props.selectedItemsCount }}
                            </template>

                            <template slot="simple-filter-clear-icon">
                                <i class="fas fa-times-circle"></i>
                            </template>
                            <template slot="sort-asc-icon">
                                <span class="text-primary"><i class="fas fa-arrow-up"> </i></span>
                            </template>
                            <template slot="sort-desc-icon">
                                <span class="text-danger"><i class="fas fa-arrow-down"> </i></span>
                            </template>
                            <template slot="no-sort-icon">
                                <i class="fas fa-sort"> </i>
                            </template>
                            <template slot="aprobacion" slot-scope="props">
                                <div v-if="props.row.soli_estado=='R'">
                                    <button class="btn btn-outline btn-danger dim" type="button"
                                            @click="aprobarSolicitud(props.row)"><i class="fa fa-thumbs-o-down"></i>
                                    </button>
                                </div>
                                <div v-else>
                                    <button class="btn btn-outline btn-primary dim" type="button"><i
                                        class="fa fa-thumbs-o-up"></i></button>
                                </div>
                            </template>
                            <template slot="filePath" slot-scope="props">
                                <a :href="props.row.filePathFull" target="_blank" title="Ver el archivo digital">
                                    <span
                                        class="badge badge-primary">Ver: {{ props.row.cofinanciador_documento.titulo }}</span>
                                </a>
                            </template>
                            <template slot="acciones" slot-scope="props">
                                <div class="btn-group">
                                    <a :href="'ver_requerimientos/'+props.row.id" target="_blank"
                                       rel="noopener noreferrer">
                                        <button type="button" class="btn btn-file ml-1"><span><i
                                            class="far fa-file-pdf"></i></span></button>
                                    </a>
                                    <a :href="'ver_requerimientos/'+props.row.id" target="_blank"
                                       rel="noopener noreferrer">
                                        <button type="button" class="btn btn-outline-success ml-1"><span><i
                                            class="far fa-file-pdf"></i></span></button>
                                    </a>
                                    <!--                                    <button type="button" class="btn btn-outline-warning ml-1" @click="editar(props.row);"><span><i class="fa fa-user-edit"></i></span></button>-->
                                    <button type="button" class="btn btn-outline-danger ml-1"
                                            @click="eliminar(props.row.id);"><span><i
                                        class="fa fa-trash-alt"></i></span></button>
                                </div>
                            </template>
                        </vue-bootstrap4-table>
                    </div>
                </div>

                <!-- ////////////  FIN row de la tabla mostrar detalles del modelo y acciones -->

            </div>

        </div>

        <!--  modal para la seleccion de contratos //////////-->
        <div class="modal fade" id="seleccion_proyecto_doc_legales" tabindex="-1" role="dialog"
             style="overflow-y: scroll;" aria-labelledby="seleccion_proyecto_doc_legalesTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="seleccion_proyecto_doc_legalesTitle">Seleccione el Contrato
                            Principal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tipo_intervencion">Contrato Principal:</label>
                                        <v-select label="nombre" :options="proyectos" v-model="jsonData.proyectos"
                                                  placeholder="Selecione un proyecto">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="showTableRequerimiento();">
                            Seleccionar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ///////////  FIN modal para la seleccion de contratos //////////-->
        <configuraciones :configuracionCofinanciador="datosEnviarConfiguracion"
                         @enviaConfiguracionHijoAPadre="funcionRespuestaConfig" ref="RecuperaConfig"></configuraciones>
    </div>
</template>

<script>
import Vue from "vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import VueBootstrap4Table from 'vue-bootstrap4-table';
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import {VueEditor} from "vue2-editor";

Vue.component("v-select", vSelect);
import moment from 'moment';

export default {
    data() {
        return {
            modificar_bottom: false,
            guardar_bottom: false,

            tituloDocLegalesModal: '',

            combo_tipos_documentos: [],
            combo_instituciones: [],
            combo_cofinanciadores: [],
            combo_documentos_legales: [],
            combo_objetivos: [],

            proyectos: [],
            jsonData: {
                //REQUERIMIENTOS
                id: "",
                document_id: '',
                tipo_requerimiento_id: '',
                correlativo_requerimiento: '',
                fecha_requerimiento: '' ,
                nuri_requerimiento: '',
                descripcion_requerimiento: '',
                trabajos_encarados: '',
                gastos_generales: '',
                path_requerimientos: '',
                //FIN REQUERIMIENTOS
                proyectos: '',
                tipos_documento: '',
                institucion: '',
                cofinanciador: '',
                titulo: '',
                doc_legal: '',
                objetivo: '',
                tipo_planilla_id: 3,
                contrato_id: '',
                numero_planilla: 1,
                nuri_planilla: '',
                fecha_planilla: '',
                fecha1: '',
                total_planilla: '',
                anticipo_planilla: '',
                retencion_planilla: '',
                referencia: '',
                funcionario: '',
                files: null,
            },
            rows: [],
            columns: [
                { label: "Tipo Requerimiento", name: "tipo_requerimiento_id", filter: {type: "simple", placeholder: "Tipo Requerimiento",}, sort: true,},
                { label: "Fecha", name: "fecha_requerimiento", filter: {type: "simple", placeholder: "Fecha",}, sort: true,},
                { label: "Nuri", name: "nuri_requerimiento", filter: {type: "simple", placeholder: "Nuri"}, sort: true,},
                { label: "Descripcion Requerimiento", name: "descripcion_requerimiento", filter: {type: "simple", placeholder: "Descripcion Requerimiento"},},
                { label: "Acciones", name: "acciones", sort: false,},
            ],

            configFile: {
                cerrar: false,
                contenidoDefault: " CARGAR PLANILLLA",
            },
            datosEnviarConfiguracion: {},
            configFechas: {},
            configTablas: {},
            actions: [],
            classes: {},
            configToolBarEditText: [],
        }
    },
    methods: {

        async showTableRequerimiento(){
            const getRequerimientos = (await axios.get('get_requerimientos')).data;
            this.rows = getRequerimientos.filter((item) => item.document_id === this.jsonData.proyectos.id)
            console .log('REQUERIMIENTOS', this.rows);
        },
        async eliminar() {

        },
        async selectPrimaryContract() {
            var respuesta = await axios.get('documents');
            const principales = respuesta.data.filter((item) => item.document_types_id === 1)
            this.proyectos = principales;
            $("#seleccion_proyecto_doc_legales").modal("show");

        },
        async tipos_documentos() {
            var respuesta = await axios.post('buscar_documentos_legaleses_tipos_doc');
            this.combo_tipos_documentos = respuesta.data;
        },
        async instituciones() {
            var respuesta = await axios.post('buscar_documentos_legaleses_instituciones');
            this.combo_instituciones = respuesta.data;
        },
        async organismos_financiadores() {
            var respuesta = await axios.post('buscar_documentos_legaleses_org_finan');
            this.combo_cofinanciadores = respuesta.data;
        },
        async doc_legales() {
            var data = {'intervencion': this.jsonData.proyectos,}
            var respuesta = await axios.post('buscar_documentos_legaleses_combo', data);
            this.combo_documentos_legales = respuesta.data;
        },
        async objetivos() {
            var data = {'intervencion': this.jsonData.proyectos,}
            var respuesta = await axios.post('buscar_documentos_legaleses_objetivos', data);
            this.combo_objetivos = respuesta.data;
        },
        ModalCrear() {
            this.modificar_bottom = false;
            this.guardar_bottom = true;
            this.tituloDocLegalesModal = "Formulario de Creación de Planillas";
        },

        /**********************archivos para file******************* */
        cargar_file(event) {
            var nombre_file = "";
            this.jsonData.files = event.target.files[0];
            for (let key in event.target.files) {//cargamos datos
                var boucle = event.target.files[key];
                if (boucle.name != null && boucle.name != 'undefined' && boucle.name != "item") {
                    // console.log(boucle.name);
                    nombre_file = boucle.name;
                }
            }
            this.configFile.cerrar = true;
            nombre_file = '<i class="fas fa-cloud-upload-alt"></i><br><span> ' + nombre_file + '</span>';
            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-success'], '#contenido_documento_res_aprobacion', [nombre_file]);
        },
        borrar_file() {
            var nombre_file = "<i class='fas fa-download fa-1x'></i><br><span> " + this.configFile.contenidoDefault + "</span>";
            $('#documento_res_aprobacion').val("");
            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-primary'], '#contenido_documento_res_aprobacion', [nombre_file]);
        },
        reiniciar_file(id, clase_borrar, clase_adicionar, id_contenido, contenido_cargar) {
            // console.log("entro");
            console.log(contenido_cargar);
            // console.log("salio");
            if (id != null) {
                $(id_contenido).empty();
                if (contenido_cargar != null) {
                    contenido_cargar.forEach(element => {
                        // console.log(element);
                        $(id_contenido).append(element);
                    });
                }
                if (clase_borrar != null) {
                    for (let key in clase_borrar) {
                        $(id).removeClass(clase_borrar[key]);
                    }
                }
                if (clase_adicionar != null) {
                    for (let key in clase_adicionar) {
                        $(id).addClass(clase_adicionar[key]);
                    }
                }
            }
        },
        /*********** funciones de configuracion**************/
        funcionRespuestaConfig(configuracion) {//funcion recibe la solicitud hecha
            this.configFechas = configuracion.configFechas;
            this.configTablas = configuracion.configTablas;
            this.actions = configuracion.configTablasAction;
            this.classes = configuracion.configTablasClases;
            this.configToolBarEditText = configuracion.configToolBarEditText;
        },
        funcionRecuperaConfig() {//funcion solicita la configuracion
            this.$refs.RecuperaConfig.RecuperaConfig();//esta es la funcion de mandar configuracion desde hijo
        }
        /*************************fin funciones de configuracion********************** */
    },
    mounted() {
        // this.instituciones_activas();
        // this.organismosFinanciadores();
        // this.tipoDocumento();
        this.funcionRecuperaConfig();
        this.selectPrimaryContract();


    },
    created() {

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
