<template>
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">Creacion de Contratos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion"
                        @click="ModalCrear();">
                    Añadir Contrato
                </button>
            </div>
        </div>
        <br>
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
                        <div v-if="props.row.soli_estado=='R'">
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
                            <a :href="props.row.filePathFull" target="_blank" rel="noopener noreferrer">
                                <button type="button" class="btn btn-outline-success"><span><i
                                    class="far fa-file-pdf"></i> </span></button>
                            </a>
                            <button type="button" class="btn btn-outline-warning ml-1" data-toggle="modal"
                                    data-target="#intervencion" @click="ModalModificar(props.row);"><span><i
                                class="fa fa-user-edit"></i></span></button>
                            <button type="button" class="btn btn-outline-danger ml-1"
                                    @click="preguntarModalAlertaConfirmacion(props.row.id);"><span><i
                                class="fa fa-trash-alt"></i></span></button>
                        </div>
                    </template>
                </vue-bootstrap4-table>
            </div>
        </div>
        <div class="modal fade" id="intervencion" tabindex="-1" role="dialog" style="overflow-y: scroll;"
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
                                                  placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Codigo de Documento:</label>
                                        <input type="text" class="form-control" name="duracion_dias"
                                               id="duracion_dias" v-model="jsonData.codigo"
                                               placeholder="Introduzca el codigo del documento">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Contratante:</label>
                                        <v-select label="nombre" :options="cla_institucional"
                                                  v-model="jsonData.contratante_id"
                                                  placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha-firma">Fecha de Firma:</label>
                                        <!-- <input type="date" class="form-control" name="fecha_inicial_programada" id="fecha_inicial_programada" v-model="jsonData.fecha_inicial_programada"> -->
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
                                            v-model="jsonData.fecha_firma"
                                        >
                                        </datepicker>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo_intervencion">Documento Padre:</label>
                                            <v-select label="nombre" :options="tipo_intervenciones"
                                                      v-model="jsonData.padre"
                                                      placeholder="Selecione una opción">
                                                <span slot="no-options">No hay data para cargar</span>
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unidades_ejecutoras">Unidad Ejecutora:</label>
                                            <v-select label="nombre" :options="unidades_ejecutoras"
                                                      v-model="jsonData.unidad_ejecutora"
                                                      placeholder="Selecione una opción">
                                                <span slot="no-options">No hay data para cargar</span>
                                            </v-select>
                                        </div>
                                    </div>
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
                                                  placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="checkboxes">Que Modifica:</label>
                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-md-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                                       value="1" v-model="jsonData.modifica">
                                                <label class="custom-control-label" for="customCheck1"
                                                >Plazo</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-md-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                       value="2" v-model="jsonData.modifica">
                                                <label class="custom-control-label" for="customCheck2"
                                                >Monto</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-md-4">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3"
                                                       value="3" v-model="jsonData.modifica">
                                                <label class="custom-control-label" for="customCheck3"
                                                >Otro</label>
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
                                        <vue-editor
                                            v-model="jsonData.objeto"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
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
                                        <button type="button" class="close" v-if="configFile.cerrar"
                                                @click="borrar_file();"><span>&times;</span></button>
                                    </label>
                                    <input type="file" class="form-control" id="doc_upload_contrato"
                                           @change="cargar_file" style="display:none">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="cerrarModal" data-dismiss="modal">Cancelar
                        </button>
                        <button type="submit" @click="guardar();" class="btn btn-success" id="guardarModal"
                                v-if="guardar_bottom==true">
                            Guardar
                        </button>
                        <button type="submit" @click="modificar();" class="btn btn-success"
                                v-if="modificar_bottom==true">Modificar
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
import {en, es} from 'vuejs-datepicker/dist/locale'
import {VueEditor} from "vue2-editor";

Vue.component("v-select", vSelect);
import moment from 'moment';
import documents from "./documents";

export default {
    props: ['url', 'csrf', 'ast', 'operations', 'user'],
    data() {
        return {
            configFile: {
                cerrar: false,
                contenidoDefault: " DOCUMENTOS",
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
            optionsSelect: [{label: 'Favor de Seleccionar su opción', code: "fer"}],
            guardar_bottom: false,
            modificar_bottom: false,
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
                unidad_ejecutora: null,
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
                path_contrato: null,
                files: null,
                //Showed in the table
                // _plazo: '',
                // _monto: '',
                // _otro: '',
                // tipo_documento: '',
                // inteventiontype: {id: 0, nombre: "Seleccione por favor...", created_at: null, updated_at: null},
                // tipo_intervencion: null,
                // codsisin: '',
                // sectorial: null,
                // fecha_aprobacion: '',
                // fecha_inicial_programada: null,
                // document_code: '',
                // fecha_inicial_real: '',
                // descripcion: '',
                // monto_aprobado_dolares: '',
                // fecha: '',
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
    methods: {
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
        calcula_dias() {
            var fecha_ini = moment(this.jsonData.fecha_aprobacion);
            var fecha_fin = moment(this.jsonData.fecha_inicial_programada);
            console.log(fecha_fin.diff(fecha_ini, 'days'), ' dias de diferencia');
            this.jsonData.duracion_dias = fecha_fin.diff(fecha_ini, 'days');
        },
        preguntarModalAlertaConfirmacion(id) {
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
            this.id_eliminacion = id;
            this.$refs.abrirAlerta.abrirAlerta();
        },
        respuestaModalAlertaConfirmacion(datos) {
            // console.log(datos.respuesta);
            if (datos.respuesta == true) {
                this.eliminar(this.id_eliminacion);
            }
        },
        seleccionoDespuesdeCargarFecha() {
            console.log("entro");
            console.log(this.jsonData.descripcion);
            console.log("selecciono una fecha" + this.jsonData.fecha);//v-on:closed="seleccionoDespuesdeCargarFecha"
        },
        seleccionoAntesdeCargarFecha() {
            console.log("selecciono una fecha" + this.jsonData.fecha);//v-on:selected
        },
        async listar() {
            const respuesta = await axios.get('documents');
            // console.log("listar");
            this.intervenciones = respuesta.data;
            const contratos =
                [
                    {
                        id: 1,
                        nombre: "Contrato Principal"
                    },
                    {
                        id: 2,
                        nombre: "Sub Contrato"
                    },
                    {
                        id: 5,
                        nombre: "Contrato Modificatorio"
                    }
                ];

            // console.log(respuesta.data);

            const contratosObjeto = {};

            contratos.forEach(contrato => {
                contratosObjeto[contrato.id] = contrato.nombre;
            });

            const documentos = respuesta.data.map(documento => {
                documento.tipo_documento = contratosObjeto[documento.document_types_id];
                //documento.tipo_documento = contratos.find(contrato => contrato.id === documento.document_types_id).nombre
                return documento;
            });

            console.log('documentos', documentos)

            this.rows = documentos;
        },
        async guardar() {
            console.log(this.jsonData);
            let datos_jsonData = new FormData();
            for (let key in this.jsonData) {
                datos_jsonData.append(key, this.jsonData[key]);
            }
            //pass document file

            datos_jsonData.append('document_types_id', this.jsonData.document_types_id.id);
            datos_jsonData.append('unidad_ejecutora_id', this.jsonData.unidad_ejecutora.id);
            datos_jsonData.append('padre', '0');
            datos_jsonData.append('nombre', this.jsonData.nombre);
            datos_jsonData.append('codigo', this.jsonData.codigo);
            datos_jsonData.append('contratante_id', this.jsonData.contratante_id.id);
            datos_jsonData.append('contratado_id', this.jsonData.contratado_id.id);
            datos_jsonData.append('duracion_dias', this.jsonData.duracion_dias);
            let fecha_firma = new Date(this.jsonData.fecha_firma);
            datos_jsonData.append('fecha_firma', (fecha_firma.getFullYear() + "-" + fecha_firma.getMonth() + "-" + fecha_firma.getDate()));
            datos_jsonData.append('monto_bs', this.jsonData.monto_bs);
            datos_jsonData.append('objeto', this.jsonData.objeto);
            datos_jsonData.append('modifica', this.jsonData.modifica);
            datos_jsonData.append('path_contrato', this.jsonData.path_contrato);
            let respuesta = await axios.post('documents', datos_jsonData);
            console.log("SAVE", respuesta.data);
            document.getElementById("cerrarModal").click();
            this.listar();
        },
        async modificar() {
            // console.log(this.jsonData);
            let datos_jsonData = new FormData();
            for (let key in this.jsonData) {
                datos_jsonData.append(key, this.jsonData[key]);
            }
            datos_jsonData.append('document_type_id', this.jsonData.document_types_id.id);
            datos_jsonData.append('unidad_ejecutora_id', this.jsonData.unidad_ejecutora.id);
            datos_jsonData.append('padre', '0');
            // datos_jsonData.append('documento_padre_id', this.jsonData.tipo_intervencion.id);
            datos_jsonData.append('nombre', this.jsonData.nombre);
            datos_jsonData.append('codigo', this.jsonData.codigo);
            datos_jsonData.append('contratante_id', this.jsonData.contratante_id.id);
            datos_jsonData.append('contratado_id', this.jsonData.contratado_id.id);
            datos_jsonData.append('duracion_dias', this.jsonData.duracion_dias);
            let fecha_firma = new Date(this.jsonData.fecha_firma);
            datos_jsonData.append('fecha_firma', '03/08/2022');
            datos_jsonData.append('monto_bs', this.jsonData.monto_bs);
            datos_jsonData.append('objeto', this.jsonData.objeto);
            datos_jsonData.append('modifica', this.jsonData.modifica);
            datos_jsonData.append('path_contrato', ' ');
            const respuesta = await axios.post('documents.update', datos_jsonData);
            console.log(respuesta.data);
            document.getElementById("cerrarModal").click();
            this.listar();
        },
        async eliminar(id) {
            const respuesta = await axios.delete('intervenciones/' + id);
            this.id_eliminacion = null;
            console.log(respuesta.data);
            this.listar();
        },
        //Change object to get
        async tipos_documentos() {
            let respuesta = await axios.post('buscar_documentos_legaleses_tipos_doc');
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
            this.tituloIntervencionModal = "Formulario de Creación de Intervenciones";
        },
        ModalModificar(data = {}) {
            this.modificar_bottom = true;
            this.guardar_bottom = false;
            this.tituloIntervencionModal = "Formulario de Modificaciones de Intervenciones";
            // this.jsonData.id = data.id;
            // // console.log(data.institucion);
            // this.jsonData.institucion = data.institucion;
            // this.jsonData.tipo_intervencion = data.tipo_intervencion;
            // this.jsonData.nombre = data.nombre;
            // this.jsonData.codsisin = data.codsisin;
            // this.jsonData.sectorial = data.sectorial;
            // this.jsonData.fecha_aprobacion = data.fecha_aprobacion;
            // this.jsonData.fecha_inicial_programada = data.fecha_inicial_programada;
            // this.jsonData.duracion_dias = data.duracion_dias;
            // this.jsonData.fecha_inicial_real = data.fecha_inicial_real;
            // this.jsonData.descripcion = data.descripcion;
            // this.jsonData.monto_aprobado_bs = data.monto_aprobado_bs;
            // this.jsonData.monto_aprobado_dolares = data.monto_aprobado_dolares;
            this.jsonData = data;
        },
        mostrar() {
            console.log(this.jsonData.inteventiontype);
            console.log(this.jsonData.inteventiontype.id);
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
        /////////////////*****************funciones de configuraciones********************* */

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
        cargar_file(event) {
            let nombre_file = `${this.jsonData.unidad_ejecutora.id}${this.jsonData.nombre}` ;
            this.jsonData.files = event.target.files[0];

            this.jsonData.path_contrato = 'C:\\Users\\Raikonif\\OneDrive\\Desktop\\newMediaPhpVue\\docs-constructor\\' + nombre_file;
            nombre_file = '<i class="fas fa-cloud-upload-alt"></i><br><span> ' + nombre_file + '</span>';
            this.jsonData.files = event.target.files[0];
            for(let key in event.target.files) {//cargamos datos
                var boucle = event.target.files[key];
                if (boucle.name != null && boucle.name != 'undefined' && boucle.name != "item") {
                    // console.log(boucle.name);
                    nombre_file = boucle.name;
                }
            }
            this.configFile.cerrar = true;
            // this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-success'], '#contenido_documento_res_aprobacion', [nombre_file]);
        },
    },
    created() {
        this.listar();
        this.unidadesEjecutorasGetAll()
        this.tipos_documentos();
        this.intervencionesTipoActivas();
        this.sectorialesActivos();
        this.institucionesGetAll()
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
        }
    },
    components: {
        VueBootstrap4Table,
        Datepicker,
        VueEditor,
    }
};

</script>
<style>

</style>
