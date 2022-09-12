<template slot-scope="props">
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">Creacion de Contratos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#contrato"
                        @click="ModalCrear();">
                    Añadir Contrato
                </button>
            </div>
        </div>
        <br>
        <!--------------------------------------------Tabla de Contratos----------------------------------------------->
        <div class="card-body">
            <div class="table-responsive">
                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" @on-download="mostrar"
                                      :classes="classes">
                    <template slot="simple-filter-clear-icon">
                        <i class="fas fa-times-circle"></i>
                    </template>
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
                        <div v-if="props.row.soli_estado === 'R'">
                            <button class="btn btn-outline btn-danger dim" type="button"
                                    @click="aprobarSolicitud(props.row)"><i class="fa fa-thumbs-o-down"></i></button>
                        </div>
                        <div v-else>
                            <button class="btn btn-outline btn-primary dim" type="button"><i
                                class="fa fa-thumbs-o-up"></i></button>
                        </div>
                    </template>
                    <template slot="descripcion" slot-scope="props">
                        <div class="btn-group" v-html="props.row.descripcion" style="width: 100px;
                                                                                        white-space: nowrap;
                                                                                        overflow: hidden;
                                                                                        text-overflow: Ellipsis"
                             :title="props.row.descripcion">
                        </div>
                    </template>
                    <template slot="acciones" slot-scope="props">
                        <div class="btn-group">


                            <button type="button" class="btn btn-outline-primary ml-1"
                                    data-toggle="modal"
                                    data-target="#orden"
                                    v-if="props.row.document_types_id === 1 || props.row.document_types_id === 2"
                                    @click="openModalOrden(props.row)">
                                <span><i class="fas fa-upload"></i> </span></button>
                            <button type="button" class="btn btn-outline-success ml-1"
                                    v-if="props.row.path_contrato!==''"
                                    @click="downloadDocument(props.row)"><span><i
                                class="far fa-file-pdf"></i> </span></button>
                            <!--                            </a>-->
                            <button type="button" class="btn btn-outline-warning ml-1" data-toggle="modal"
                                    data-target="#contrato" @click="editarModal(props.row);"><span><i
                                class="fa fa-user-edit"></i></span></button>
                            <button type="button" class="btn btn-outline-danger ml-1"
                                    @click="preguntarModalAlertaConfirmacionEliminar(props.row);"><span><i
                                class="fa fa-trash-alt"></i></span></button>
                        </div>
                    </template>
                </vue-bootstrap4-table>
            </div>
        </div>
        <!------------------------------------------------------Fin Tabla Contrato--------------------------------------------------------->

        <!------------------------------------------------------Modal Crear Contrato------------------------------------------------------->
        <div class="modal fade" id="contrato" tabindex="-1" role="dialog" style="overflow-y: scroll;"
             aria-labelledby="intervencionTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <!--modal header, close button-->
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="intervencionTitle">{{ tituloIntervencionModal }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!--                                        Doc Type Spinner-->
                                        <label for="document_type">Tipo de Documento:</label>
                                        <v-select label="nombre" :options="combo_tipos_documentos"
                                                  v-model="jsonData.document_types_id"
                                                  @input="cambioTipoDocumento()"
                                                  v-bind:disabled="disabledForEdit"
                                                  placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Codigo de Documento:</label>
                                        <input type="text" class="form-control" name="duracion_dias" id="duracion_dias"
                                               v-model="jsonData.codigo"
                                               placeholder="Introduzca el codigo del documento">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Contratante:</label>
                                        <v-select label="nombre" :options="cla_institucional"
                                                  v-model="jsonData.contratante_id"
                                                  placeholder="Selecione una opción"
                                                  v-bind:disabled="disableSub || disabledForEdit">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha-firma">Fecha de Firma:</label>
                                        <datepicker :language="configFechas.es" :placeholder="configFechas.placeholder"
                                                    :calendar-class="configFechas.nombreClaseParaModal"
                                                    :input-class="configFechas.nombreClaseParaInput"
                                                    :monday-first="true"
                                                    :clear-button="true"
                                                    :clear-button-icon="configFechas.IconoBotonBorrar"
                                                    :calendar-button="true"
                                                    :calendar-button-icon="configFechas.IconoBotonAbrir"
                                                    calendar-button-icon-content=""
                                                    :format="configFechas.DatePickerFormat"
                                                    :full-month-name="true" :bootstrap-styling="true"
                                                    :disabled-dates="configFechas.disabledDates"
                                                    :typeable="configFechas.typeable"
                                                    v-model="jsonData.fecha_firma">
                                        </datepicker>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tipo_intervencion">Documento Padre:</label>
                                            <v-select label="nombre" :options="combo_padres"
                                                      v-model="jsonData.padre"
                                                      placeholder="Seleccione una opción"
                                                      @input="selectContratanteContratado"
                                                      v-bind:disabled="disablePadre || disabledForEdit">
                                                <span slot="no-options">No hay data para cargar</span>
                                            </v-select>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-md-6">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <label for="unidades_ejecutoras">Unidad Ejecutora:</label>-->
                                    <!--                                            <v-select label="nombre" :options="unidades_ejecutoras"-->
                                    <!--                                                      v-model="jsonData.unidad_ejecutora_id"-->
                                    <!--                                                      placeholder="Selecione una opción">-->
                                    <!--                                                <span slot="no-options">No hay data para cargar</span>-->
                                    <!--                                            </v-select>-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de Documento:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                               placeholder="Ingresar Nombre del Documento" v-model="jsonData.nombre">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="institucion_contratado">Contratado:</label>
                                        <v-select label="nombre" :options="cla_institucional"
                                                  v-model="jsonData.contratado_id"
                                                  placeholder="Selecione una opción"
                                                  v-bind:disabled="disableSub2 || disabledForEdit">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="checkboxes">Que Modifica:</label>
                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-md-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                                       value="1" v-model="jsonData.modifica">
                                                <label class="custom-control-label" for="customCheck1">Plazo</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-md-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                       value="2" v-model="jsonData.modifica">
                                                <label class="custom-control-label" for="customCheck2">Monto</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-md-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3"
                                                       value="3" v-model="jsonData.modifica">
                                                <label class="custom-control-label" for="customCheck3">Otro</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="dias_duracion">Duracion de Dias:</label>
                                        <input type="number" class="form-control" name="codsisin" id="dias"
                                               placeholder="Ingresar Dias" v-model="jsonData.duracion_dias">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="monto_bs">Monto Aprobado en Bolivianos:</label>
                                        <input type="number" class="form-control" name="codsisin" id="monto_bs"
                                               placeholder="Ingresar Monto" v-model="jsonData.monto_bs">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="descripcion">Objeto:</label>
                                        <vue-editor v-model="jsonData.objeto" :editor-toolbar="configToolBarEditText">
                                        </vue-editor>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="descripcion">Documento de Respaldo:</label>
                                    <label for="documento_res_aprobacion" id="label_documento_res_aprobacion"
                                           class="bg-primary"
                                           style="font-size: 14px; font-weight: 600; color: #fff; display: inline-block; transition: all .5s; cursor: pointer; padding: 10px 15px !important; width: 100%; text-align: center; border-radius: 7px;">
                                        <span id="contenido_documento_res_aprobacion"><i
                                            class="fas fa-download fa-1x"></i><br> <span> {{
                                                configFile.contenidoDefault
                                            }}</span></span>
                                        <button type="button" class="close" id="closeDoc" v-if="configFile.cerrar"
                                                @click="borrar_file();"><span>&times;</span></button>
                                    </label>
                                    <input type="file" multiple class="form-control" id="documento_res_aprobacion"
                                           @change="cargar_file" style="display:none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="cerrarModal" data-dismiss="modal">Cancelar
                        </button>
                        <button type="submit" @click="guardar();" class="btn btn-success" id="guardarModal"
                                v-if="guardar_bottom === true">
                            <slot>
                                Guardar
                            </slot>
                        </button>
                        <button type="submit" @click="modificar();" class="btn btn-success" id="modificarModal"
                                v-if="modificar_bottom === true">Modificar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------------Fin Modal Crear Contrato---------------------------------------->

        <!----------------------------------------MODAL ORDEN PROCEDER---------------------------------------->
        <div class="modal fade" id="orden" tabindex="-1" role="dialog" style="overflow-y: scroll;"
             aria-labelledby="intervencionTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <!--modal header, close button-->
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="intervencionTitle">{{ tituloIntervencionModal }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fecha-firma">Fecha de Orden:</label>
                                <datepicker :language="configFechas.es" :placeholder="configFechas.placeholder"
                                            :calendar-class="configFechas.nombreClaseParaModal"
                                            :input-class="configFechas.nombreClaseParaInput"
                                            :monday-first="true"
                                            :clear-button="true"
                                            :clear-button-icon="configFechas.IconoBotonBorrar"
                                            :calendar-button="true"
                                            :calendar-button-icon="configFechas.IconoBotonAbrir"
                                            calendar-button-icon-content=""
                                            :format="configFechas.DatePickerFormat"
                                            :full-month-name="true" :bootstrap-styling="true"
                                            :disabled-dates="configFechas.disabledDates"
                                            :typeable="configFechas.typeable"
                                            v-model="jsonData.fecha_orden_proceder">
                                </datepicker>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripcion de la Orden:</label>
                                <vue-editor v-model="jsonData.desc_orden_proceder"
                                            :editor-toolbar="configToolBarEditText">
                                </vue-editor>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="descripcion">Orden de Proceder:</label>
                            <label for="documento_res_aprobacion" id="label_documento_res_aprobacion"
                                   class="bg-primary"
                                   style="font-size: 14px; font-weight: 600; color: #fff; display: inline-block; transition: all .5s; cursor: pointer; padding: 10px 15px !important; width: 100%; text-align: center; border-radius: 7px;">
                                        <span id="contenido_documento_res_aprobacion"><i
                                            class="fas fa-download fa-1x"></i><br> <span> {{
                                                configFile.contenidoDefault
                                            }}</span></span>
                                <button type="button" class="close" id="closeOr" v-if="configFile.cerrar"
                                        @click="borrar_file();"><span>&times;</span></button>
                            </label>
                            <input type="file" multiple class="form-control" id="documento_res_aprobacion"
                                   @change="cargar_file" style="display:none">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="closeModal" data-dismiss="modal">Cancelar
                        </button>
                        <button type="submit" @click="saveOrdenProceder();" class="btn btn-success"
                                id="guardarModal">
                            <slot>
                                Guardar Orden
                            </slot>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <alert-confirmacion :mensajesAlerta="mandarMensajesAlerta" @escucharAlerta="respuestaModalAlertaConfirmacion"
                            ref="abrirAlerta"></alert-confirmacion>
    </div>
</template>

<script>

import Vue from "vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import VueBootstrap4Table from 'vue-bootstrap4-table';
import Datepicker from 'vuejs-datepicker';
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import {en, es} from 'vuejs-datepicker/dist/locale'
import {VueEditor} from "vue2-editor";

Vue.component("v-select", vSelect);
// Vue.component('vueDropzone', vue2Dropzone);

export default {
    props: ['url', 'csrf', 'ast', 'operations', 'user'],
    data() {
        return {
            dropzoneOptions: {
                url: 'https://httpbin.org/post',
                thumbnailWidth: 150,
                maxFilesize: 1,
                headers: {"My-Awesome-Header": "header value"},
                paralleleUploads: 1,
            },
            configFile: {
                cerrar: false,
                contenidoDefault: "DOCUMENTOS",
                defaultProceder: "Orden Proceder"
            },
            mandarMensajesAlerta: {},
            configToolBarEditText: [
                [{font: []}],
                [{header: [false, 1, 2, 3, 4, 5, 6]}],//mismo que tamaño pequeño, mediano y grande pero esta tiene seis niveles
                // [{ size: ["small", "large", "huge"] }],    //misma que tamaño 1-6 pero esta solo seria pequeño, mediano y grande
                ["bold", "italic", "underline", "strike"], // toggled buttons
                [
                    {align: ""},
                    {align: "center"},
                    {align: "right"},
                    {align: "justify"}
                ],
                ["blockquote", "code-block"],
                [{list: "ordered"}, {list: "bullet"}, {list: "check"}],
                [{indent: "-1"}, {indent: "+1"}], // outdent/indent
                [{color: []}, {background: []}], // dropdown with defaults from theme
                ["link"],
                // ["link", "image", "video"],//comentamos por que no quiero que se cargue imagenes ni video
                ["clean"] // remove formatting button
            ],
            configFechas: {
                nombreClaseParaModal: "clase-modal-datepicker",
                nombreClaseParaInput: "clase-input-datepicker",
                en: en,
                es: es,
                DatePickerFormat: 'dd/MM/yyyy',
                disablesFullDate: {
                    to: new Date(1987, 5, 25), //ojo los meses menos uno //fecha desde
                    from: new Date(1987, 5, 25), //fecha hasta
                },
                fecha: '2021-05-05',
                placeholder: "Selecione Fecha",
                placeholderDisbled: "Fecha Bloqueada",
                format: "dd-MM-yyyy",
                IconoBotonBorrar: "fa fa-times-circle fa-1x text-danger",
                IconoBotonAbrir: "fa fa-calendar-alt fa-1x text-success",
                typeable: false,//bloquear edicion por teclado
                disabledDates: {},
            },
            computed: {
                //format thousand separator to input in real time (v-model)
                verify_document_types_id() {
                    return this.jsonData.document_types_id.id === 1;
                },
            },
            optionsSelect: [{label: 'Favor de Seleccionar su opción', code: "fer"}],
            guardar_bottom: false,
            modificar_bottom: false,
            disablePadre: false,
            disableSub: false,
            disableSub2: false,
            disabledForEdit: false,
            combo_padres: [],
            uploadProgress: '',
            fileAdded: '',
            sendingFiles: '',
            success: '',
            tituloIntervencionModal: '',
            unidades_ejecutoras: [],
            combo_tipos_documentos: [],
            cla_institucional: [],
            id_eliminacion: null,
            type_name: [],
            sectoriales: [],
            tipo_intervenciones: [],
            intervenciones: [],
            jsonData: {
                //required to CRUD
                id: 0,
                document_types_id: null,
                unidad_ejecutora_id: null,
                padre: null,
                nombre: null,
                codigo: null,
                contratante_id: null,
                contratado_id: null,
                fecha_firma: null,
                duracion_dias: null,
                monto_bs: null,
                objeto: null,
                modifica: [],
                files: null,
                path_contrato: null,

                //required to Orden Proceder
                document_id: null,
                fecha_orden_proceder: null,
                desc_orden_proceder: null,
                path_orden_proceder: null,

            },
            rows: [],
            columns: [
                {
                    label: "#",
                    name: "id",
                    filter: {
                        type: "simple",
                        placeholder: "#",
                    },
                    sort: true,
                    uniqueId: true,
                },
                {
                    label: "Nombre",
                    name: "nombre",
                    filter: {
                        type: "simple",
                        placeholder: "Nombre",
                    },
                    sort: true,
                },
                {
                    label: "Tipo de Documento",
                    name: "tipo_documento",
                    filter: {
                        type: "simple",
                        placeholder: "Tipo de Documento",
                    },
                    sort: true,
                },
                {
                    label: "Fecha de Firma",
                    name: "fecha_firma",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Fecha",
                    },
                },
                {
                    label: "Monto Bs.",
                    name: "monto_bs",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Monto",
                    },
                },
                {
                    label: "Duracion Dias",
                    name: "duracion_dias",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Dias",
                    },
                },
                {
                    label: "Orden Proceder",
                    name: "fecha_orden_proceder",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Dias",
                    },
                },
                {
                    label: "Acciones",
                    name: "acciones",
                    sort: false,
                },
            ],
            actions: [//botones ejem el de descarga
                {
                    btn_text: "Download",
                    event_name: "on-download",
                    class: "btn btn-primary my-custom-class",
                    event_payload: {
                        msg: "my custom msg"
                    }
                }
            ],
            classes: {//clases para la tabla
                tableWrapper: "outer-table-div-class wrapper-class-two",
                table: {
                    "table-striped my-class": true,
                    "table-striped my-class-two": function (rows) {
                        return true
                    }
                },
                row: {
                    "my-row my-row2": true,
                    "function-class": function (row) {
                        return row.id == 1
                    }
                },
                cell: {
                    "my-cell my-cell2": true,
                    "text-danger": function (row, column, cellValue) {
                        return column.name == "salary" && row.salary > 2500
                    }
                }
            },
            config: {
                card_mode: false,
                checkbox_rows: false,
                rows_selectable: false,
                global_search: {
                    placeholder: "Buscar...",
                    visibility: true,
                    case_sensitive: true,
                    showClearButton: true,
                },
                show_refresh_button: false,
                show_reset_button: false,

                pagination: true, // default true
                pagination_info: true, // default true
                num_of_visibile_pagination_buttons: 7, // default 5
                per_page: 10, // default 10
                per_page_options: [5, 10, 20, 30, -1],
            },
        }
    },

    watch: {

        props: function (val, oldVal) {
            console.log("paso algpo");
            // for (var i = 0; i < this.cases.length; i++) {
            //     if (this.cases[i].status == val) {
            //         this.activeCases.Push(this.cases[i]);
            //         alert("Fired! " + val);
            //     }
            // }
        },
        numberFormatter(value) {
            if (!value) return ''
            value = value.toString()
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        numberFormatterInput() {
            if (this.number) return ''
            this.number = this.number.toString()
            return this.number.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
    },
    methods: {
        openModalOrden(data = {}) {
            this.jsonData.document_id = data.id;
            this.tituloIntervencionModal = data.nombre;
            console.log(data);
        },
        async saveOrdenProceder2() {
            const document_id = this.jsonData.document_id;
            const fecha = new Date(this.jsonData.fecha_orden_proceder);
            const fecha_orden_proceder = fecha;
            const desc_orden_proceder = this.jsonData.desc_orden_proceder;
            const files = this.jsonData.files;

            const jsonData = {
                'document_id': document_id,
                'fecha_orden_proceder': fecha_orden_proceder,
                'desc_orden_proceder': desc_orden_proceder,
                'files': files
            }

            const uploadFile = await axios.post('upload_orden_file', jsonData)
            console.log(uploadFile.data);
            document.getElementById("cerrarModal").click();
        },
        async saveOrdenProceder() {
            let jsonData = new FormData();
            jsonData.append('document_id', this.jsonData.document_id);
            const fecha = new Date(this.jsonData.fecha_orden_proceder);
            jsonData.append('fecha_orden_proceder', fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate());
            jsonData.append('desc_orden_proceder', this.jsonData.desc_orden_proceder);
            jsonData.append('files', this.jsonData.files);
            const uploadFile = await axios.post('upload_orden_file', jsonData)
            console.log('SAVE ORDEN', uploadFile.data);

            document.getElementById("closeModal").click();
            document.getElementById("closeOr").click();
            this.cleanProceder();
        },

        cleanProceder() {
            this.jsonData.document_id = '';
            this.jsonData.fecha_orden_proceder = '';
            this.jsonData.desc_orden_proceder = '';
            this.jsonData.files = '';

        },
        //modify the value of the input in real time from v-select document_types_id and padre
        async cambioTipoDocumento() {
            let padresObjeto = await this.padreGetAll()
            let subPadres = []
            const defaultValue = Object.assign({},
                {
                    id: 271,
                    nombre: 'Empresa Estratégica Boliviana de Construcción y Conservación de Infraestructura Civil'
                });
            switch (this.jsonData.document_types_id.id) {
                case 1:
                    this.disablePadre = true;
                    this.jsonData.padre = Object.assign({}, {id: 0, nombre: 'Ninguno'});
                    this.jsonData.contratado_id = defaultValue
                    this.jsonData.contratante_id = '';
                    this.disableSub = false;
                    this.disableSub2 = true;
                    break;
                case 2:
                    for (let i = 0; i < padresObjeto.length; i++) {
                        if (padresObjeto[i].padre === 0) {
                            subPadres.push(padresObjeto[i]);
                        }
                        this.combo_padres = subPadres;
                        this.disablePadre = false;
                        this.disableSub = true;
                        this.disableSub2 = false;
                        this.jsonData.contratante_id = defaultValue
                        this.jsonData.contratado_id = '';
                    }
                    break;
                default:
                    console.log("DEFAULT", this.jsonData.document_types_id.id);
                    this.combo_padres = padresObjeto;
                    this.disablePadre = false;
                    this.disableSub = true;
                    this.disableSub2 = true;
                    if (this.jsonData.padre != null || this.jsonData.padre != '') {
                        this.jsonData.contratado_id = '';
                        this.jsonData.contratante_id = '';
                    }
            }
        },
        async selectContratanteContratado() {
            let contratanteContratado = (await axios.get('cla_institucional')).data;
            console.log('PADRE', this.jsonData.padre);
            let contratante = [];
            let contratado = [];
            contratante = Object.assign(contratanteContratado.filter(contratante => contratante.id == this.jsonData.padre.contratante_id));
            contratado = Object.assign(contratanteContratado.filter(contratado => contratado.id == this.jsonData.padre.contratado_id));

            console.log("CONTRATANTE", contratante);
            console.log("CONTRATADO", contratado);
            if (this.disablePadre === false &&
                this.jsonData.document_types_id.id !== 1 &&
                this.jsonData.document_types_id.id !== 2) {
                this.jsonData.contratante_id = contratante;
                this.jsonData.contratado_id = contratado;
            }
        },
        preguntarModalAlertaConfirmacionEliminar(document) {
            this.mandarMensajesAlerta = {
                titulo: "Mensajes del Sistema",//titulo del mensaje
                contenidoCabecera: "Este es un mensaje de advertencia",//contenido del mensaje
                contenidoCuerpo: "La acción es irreversible",//contenido del mensaje
                contenidoPie: "¿Esta seguro de eliminar el registro?",//contenido del mensaje
                tipo: "ferdy-background-Primary-blak",//color danger warnin etc para header de modal
                tituloBotonUno: "SI", //texto de primer boton el de true
                tituloBotonDos: "NO", //texto segundo boton del de false
                respuesta: false,
            };
            this.id_eliminacion = document.id;
            this.$refs.abrirAlerta.abrirAlerta(this.id_eliminacion);
        },
        respuestaModalAlertaConfirmacion(datos) {
            // console.log(datos.respuesta);
            if (datos.respuesta === true) {
                console.log('eliminando', datos.respuesta);
                this.deleteItem(this.id_eliminacion);
            }
        },
        async filterList(documentsResult) {
            const getOrdenesProceder = (await axios.get('get_ordenes_proceder')).data;
            const fechaEmpty = {
                fecha_orden_proceder: '',
                desc_orden_proceder: '',
                files: ''
            }
            console.log("ORDENES PROCEDER", getOrdenesProceder);
            let arrayList = [];
            for (let i in documentsResult) {
                if (documentsResult[i].document_types_id === 1 || documentsResult[i].document_types_id === 2) {
                    for (let j in getOrdenesProceder) {
                        if (documentsResult[i].id === getOrdenesProceder[j].document_id) {
                            arrayList.push({
                                ...getOrdenesProceder[j],
                                ...documentsResult[i]
                            });
                        }
                    }
                } else {
                    arrayList.push({
                        ...documentsResult[i],
                        ...fechaEmpty
                    });
                }
            }
            return arrayList;
        },
        async listar() {
            const respuesta = await axios.get('documents');
            const getDocumentTypes = (await axios.get('documentos_legaleses')).data;


            const documentsResult = respuesta.data.map(documento => {
                documento.fecha_firma = documento.fecha_firma.split('-').reverse().join('-');
                documento.tipo_documento = getDocumentTypes[documento.document_types_id - 1].nombre;
                //documento.tipo_documento = contratos.find(contrato => contrato.id === documento.document_types_id).nombre
                return documento;
            });
            this.rows = await this.filterList(documentsResult);
        },
        areAlltheFieldsFilled() {
            return this.jsonData.document_types_id !== '' &&
                this.jsonData.padre !== '' &&
                this.jsonData.contratante_id.id !== '' &&
                this.jsonData.contratado_id.id !== '' &&
                this.jsonData.duracion_dias !== '' &&
                this.jsonData.fecha_firma !== '' &&
                this.jsonData.codigo !== '' &&
                this.jsonData.nombre !== '' &&
                this.jsonData.monto_bs !== '' &&
                this.jsonData.objeto !== '' &&
                this.jsonData.modifica !== '' &&
                this.jsonData.files !== '';
        },
        async contratoSave() {
            console.log('contratoSave2', this.jsonData);
            let document_types_id = this.jsonData.document_types_id.id;
            let padre = this.jsonData.padre.id;
            let unidad_ejecutora_id = 1/*this.jsonData.unidad_ejecutora_id.id*/;
            let contratante_id = this.jsonData.contratante_id.id;
            let contratado_id = this.jsonData.contratado_id.id;
            let duracion_dias = this.jsonData.duracion_dias;
            let fecha = new Date(this.jsonData.fecha_firma);
            let fecha_firma = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();
            let codigo = this.jsonData.codigo;
            let nombre = this.jsonData.nombre;
            let monto_bs = this.jsonData.monto_bs;
            let objeto = this.jsonData.objeto;
            let modifica = this.jsonData.modifica.toString();
            let files = this.jsonData.files;

            const dataJson = {
                'document_types_id': document_types_id,
                'padre': padre,
                'unidad_ejecutora_id': unidad_ejecutora_id,
                'contratante_id': contratante_id,
                'contratado_id': contratado_id,
                'duracion_dias': duracion_dias,
                'fecha_firma': fecha_firma,
                'codigo': codigo,
                'nombre': nombre,
                'monto_bs': monto_bs,
                'objeto': objeto,
                'modifica': modifica,
                'files': files
            }
            let saved = await axios.post('documents', dataJson)
            console.log('SAVED', saved.data);
        },
        async contratoSave2() {
            let datosJsonData = new FormData();
            datosJsonData.append('document_types_id', this.jsonData.document_types_id.id);
            datosJsonData.append('padre', this.jsonData.padre.id);
            datosJsonData.append('unidad_ejecutora_id', 1/*this.jsonData.unidad_ejecutora_id.id*/);
            datosJsonData.append('contratante_id', this.jsonData.contratante_id.id);
            datosJsonData.append('contratado_id', this.jsonData.contratado_id.id);
            datosJsonData.append('duracion_dias', this.jsonData.duracion_dias);
            const fecha = new Date(this.jsonData.fecha_firma);
            datosJsonData.append('fecha_firma', fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate());
            datosJsonData.append('codigo', this.jsonData.codigo);
            datosJsonData.append('nombre', this.jsonData.nombre);
            datosJsonData.append('monto_bs', this.jsonData.monto_bs);
            datosJsonData.append('objeto', this.jsonData.objeto);
            datosJsonData.append('modifica', this.jsonData.modifica.toString());
            datosJsonData.append('files', this.jsonData.files);
            let saved = await axios.post('documents', datosJsonData)
            console.log('SAVED', saved.data);
        },
        async guardar() {
            if (this.areAlltheFieldsFilled()) {
                await this.contratoSave2();
                // await this.contratoSave()
                document.getElementById("cerrarModal").click();
                await this.listar();
            } else {
                alert('Debe llenar todos campos');
            }
        },
        async modificar() {

            let datos_jsonData = new FormData();
            datos_jsonData.append('document_types_id', this.jsonData.document_types_id.id);
            datos_jsonData.append('unidad_ejecutora_id', this.jsonData.unidad_ejecutora_id.id);
            if (this.jsonData.document_types_id.id === 1) {
                datos_jsonData.append('padre', '0');
            } else {
                datos_jsonData.append('padre', this.jsonData.padre.id);
            }
            datos_jsonData.append('nombre', this.jsonData.nombre);
            datos_jsonData.append('codigo', this.jsonData.codigo);
            datos_jsonData.append('contratante_id', this.jsonData.contratante_id.id);
            datos_jsonData.append('contratado_id', this.jsonData.contratado_id.id);
            datos_jsonData.append('duracion_dias', this.jsonData.duracion_dias);
            let fecha_firma = new Date(this.jsonData.fecha_firma);
            datos_jsonData.append('fecha_firma', (fecha_firma.getFullYear() + "-" + (fecha_firma.getMonth() + 1) + "-" + fecha_firma.getDate()));
            datos_jsonData.append('monto_bs', this.jsonData.monto_bs);
            datos_jsonData.append('objeto', this.jsonData.objeto);
            datos_jsonData.append('modifica', this.jsonData.modifica);
            datos_jsonData.append('files', this.jsonData.files);
            datos_jsonData.append('id', this.jsonData.id);
            console.log('APPEND', datos_jsonData);
            const respuesta = await axios.post(`update_contrato/` + this.jsonData.id, datos_jsonData);
            // const respuesta = await axios.put(`documents/` + this.jsonData.id, datos_jsonData);
            console.log('MODIFIED', respuesta.data);
            document.getElementById("cerrarModal").click();
            document.getElementById("closeDoc").click();
            await this.listar();
            // this.limpiar_formulario();
        },
        limpiar_formulario() {
            this.jsonData.id = null;
            this.jsonData.document_types_id = null;
            this.jsonData.codigo = '';
            this.jsonData.nombre = '';
            this.jsonData.unidad_ejecutora_id = null;
            this.jsonData.contratado_id = null;
            this.jsonData.contratante_id = null;
            this.jsonData.fecha_firma = '';
            this.jsonData.duracion_dias = null;
            this.jsonData.monto_bs = null;
            this.jsonData.modifica = [];
            this.jsonData.padre = null;
            this.jsonData.files = '';
            this.jsonData.path_contrato = '';
            this.jsonData.objeto = '';
        },
        async editarModal(data = {}) {
            const response_documents = await axios.get(`documents`);
            const response_doc_types = await axios.get('documentos_legaleses');
            const response_unidad_ejecutora = await axios.get('get_unidades_ejecutoras');
            const response_institucion_contratante_contratadora = await axios.get('cla_institucional');

            this.disabledForEdit = true;
            this.modificar_bottom = true;
            this.guardar_bottom = false;
            this.tituloIntervencionModal = "Formulario de Modificaciones de Contratos";
            this.jsonData.id = data.id;
            this.jsonData.codigo = data.codigo;
            this.jsonData.nombre = data.nombre;
            this.jsonData.modifica = data.modifica.split(',');
            console.log("MODIFICA", this.jsonData.modifica);
            this.jsonData.duracion_dias = data.duracion_dias;
            this.jsonData.monto_bs = data.monto_bs;
            this.jsonData.objeto = data.objeto;
            this.jsonData.fecha_firma = new Date(data.fecha_firma)
            this.jsonData.files = data.files;
            this.jsonData.path_contrato = data.path_contrato;
            //set data to v-select contratante_id
            for (let i = 0; i < response_institucion_contratante_contratadora.data.length; i++) {
                if (data.contratante_id === response_institucion_contratante_contratadora.data[i].id) {
                    this.jsonData.contratante_id = response_institucion_contratante_contratadora.data[i];
                    i = response_institucion_contratante_contratadora.data.length;
                }
            }
            //set data to v-select contratado_id
            for (let i = 0; i < response_institucion_contratante_contratadora.data.length; i++) {
                if (data.contratado_id === response_institucion_contratante_contratadora.data[i].id) {
                    this.jsonData.contratado_id = response_institucion_contratante_contratadora.data[i];
                    i = response_institucion_contratante_contratadora.data.length;
                }
            }
            //set data to v-select unidad_ejecutora_id
            for (let i = 0; i < response_unidad_ejecutora.data.length; i++) {
                if (data.unidad_ejecutora_id === response_unidad_ejecutora.data[i].id) {
                    this.jsonData.unidad_ejecutora_id = response_unidad_ejecutora.data[i];
                    i = response_unidad_ejecutora.data.length;
                }
            }
            //set data to v-select document_types_id
            for (let i = 0; i < response_doc_types.data.length; i++) {
                if (data.document_types_id === response_doc_types.data[i].id) {
                    this.jsonData.document_types_id = response_doc_types.data[i];
                    i = response_doc_types.data.length;
                }
            }
            //set this data to padre Contrato Principal
            const padreIdName = [
                {
                    id: 0,
                    nombre: 'Ninguno'
                }
            ];
            //set data to v-select padre
            for (let i = 0; i < response_documents.data.length; i++) {
                if (data.padre === response_documents.data[i].id) {
                    this.disablePadre = false;
                    this.jsonData.padre = response_documents.data[i];
                    i = response_documents.data.length;
                } else {
                    this.disablePadre = true;
                    this.jsonData.padre = padreIdName[0];
                }
            }
        },
        async downloadDocument(data = {}) {
            const response = await axios.get(`download_document/${data.id}`, {responseType: 'blob'});
            const blob = new Blob([response.data], {type: 'octet-stream'});
            const href = URL.createObjectURL(blob);
            const a = Object.assign(document.createElement('a'), {
                href,
                style: 'display: none',
                download: data.path_contrato
            });
            document.body.appendChild(a);
            a.click();
            URL.revokeObjectURL(href);
            a.remove()
        },
        //Modal Showing the Object get From Database, and getting the name from every id to show in the modal
        async padreGetAll() {
            let response = await axios.get('documents');
            let padresArray = [];
            let position = 0
            //fill array of padres with contrato principal (1) and sub contrato (2)
            for (let i = 0; i < response.data.length; i++) {
                if (response.data[i].document_types_id === 1 ||
                    response.data[i].document_types_id === 2) {
                    padresArray[position] = response.data[i];
                    position++;
                }
            }
            return padresArray;
            // await this.filterPadre(padresArray);
            // this.combo_padres = padresArray
        },
        async deleteItem(doc) {
            const respuesta = await axios.delete('documents/' + doc);
            // this.id_eliminacion = null;
            console.log(respuesta.data);
            await this.listar();
        },
        async tipoDocumentoGetAll() {
            let respuesta = await axios.get('documentos_legaleses');
            this.combo_tipos_documentos = respuesta.data;
        },
        async intervencionesTipoActivas() {
            var respuesta = await axios.get('intervencions_tipo');
            // console.log("intervencion");
            // console.log(respuesta.data);
            this.tipo_intervenciones = respuesta.data;
            this.optionsSelect = respuesta.data;
        },
        async institucionesGetAll() {
            const respuesta = await axios.get('cla_instituciones');
            // console.log(respuesta.data);
            this.cla_institucional = respuesta.data;
            // this.jsonData.institucion = respuesta.data;
        },
        async unidadesEjecutorasGetAll() {
            const respuesta = await axios.get('get_unidades_ejecutoras');
            this.unidades_ejecutoras = respuesta.data;
            console.log(respuesta.data);
        },
        //get data from?
        async sectorialesActivos() {
            var respuesta = await axios.get('sectorials');
            // console.log(respuesta.data);
            this.sectoriales = respuesta.data;
        },
        ModalCrear() {
            this.modificar_bottom = false;
            this.guardar_bottom = true;
            this.disabledForEdit = false;
            this.disablePadre = false;
            this.limpiar_formulario();
            this.tituloIntervencionModal = "Formulario de Creación de Contratos";
        },
        mostrar() {
            console.log(this.jsonData.nombre);
            console.log(this.jsonData.document_types_id.id);
        },
        onDownload(payload) {
            console.log(payload);
        },
        ordenar_tabla(total) {
            for (i = 1; i <= total; i++) {
                this.contador[i] = i;
            }
            console.log("cnotador   ");
        },
        handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
            // An example of using FormData
            // NOTE: Your key could be different such as:
            // formData.append('file', file)

            var formData = new FormData();
            formData.append("image", file);

            axios({
                url: "https://fakeapi.yoursite.com/images",
                method: "POST",
                data: formData
            })
                .then(result => {
                    const url = result.data.url; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch(err => {
                    console.log(err);
                });
        },
        borrar_file() {
            var nombre_file = "<i class='fas fa-download fa-1x'></i><br><span> " + this.configFile.contenidoDefault + "</span>";
            $('#documento_res_aprobacion').val("");
            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-primary'], '#contenido_documento_res_aprobacion', [nombre_file]);
        },
        /////////////////*****************funciones de configuraciones********************* */

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
            } else {
                console.log("no se encontro el id");
            }
        },
        cargar_file(event) {
            let nombre_file = "";
            this.jsonData.files = event.target.files[0];
            for (let key in event.target.files) {//cargamos datos
                let boucle = event.target.files[key];
                if (boucle.name != null && boucle.name !== 'undefined' && boucle.name !== "item") {
                    // console.log(boucle.name);
                    nombre_file = boucle.name;
                }
                // for(let key2 in boucle){
                //     console.log(key2);
                //     console.log(boucle[key2]);
                // }
            }
            this.configFile.cerrar = true;
            nombre_file = '<i class="fas fa-cloud-upload-alt"></i><br><span> ' + nombre_file + '</span>';
            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-success'], '#contenido_documento_res_aprobacion', [nombre_file]);
        },
        async calcular_moneda(tipo_local) {//tipo_cambio_bs_sus
            var respuesta = await axios.get('tipo_cambio_bs_sus');
            console.log(respuesta.data);
            if (respuesta.data == "") {
                alert("No se tiene registrado el tipo de cambio para hoy");
            } else {
                if (tipo_local == 'BS') {//como guarda en bs cargamos al de dolar
                    var valor = "";
                    console.log("aqui");
                    var valor = this.jsonData.monto_aprobado_bs / respuesta.data.valor_compra;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_aprobado_dolares = valor;
                } else {//como guarda en dolar cargamos al de bs
                    var valor = "";
                    var valor = this.jsonData.monto_aprobado_dolares * respuesta.data.valor_venta;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_aprobado_bs = valor;

                }
            }
        },
    },
    created() {
        this.listar();
        this.unidadesEjecutorasGetAll();
        this.tipoDocumentoGetAll();
        this.intervencionesTipoActivas();
        this.sectorialesActivos();
        this.institucionesGetAll();
        this.padreGetAll();
    }
    ,
    components: {
        VueBootstrap4Table,
        Datepicker,
        VueEditor,
        vue2Dropzone
    }
}
;

</script>
<style>
</style>
