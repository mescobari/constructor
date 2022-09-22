<template slot-scope="props">
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">Creacion de Contratos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#contrato"
                        @click="ModalCrear();">
                    Crear Requerimiento Mano Obra
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
                        <div class="row bg-warning">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="codigo_recurso">Codigo:</label>
                                    <input type="text" class="form-control" name="codigo_recurso" placeholder="Codigo"
                                           v-model="jsonEdUpSave.modal_codigo">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- Recursos  Spinner-->
                                    <label for="document_type">Descripcion Recurso:</label>
                                    <input type="text" class="form-control" name="codigo_recurso"
                                           placeholder="Descripcion del Recurso"
                                           v-model="jsonEdUpSave.modal_descripcion">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Unidad</label>
                                    <v-select label="simbolo" :options="combo_unidades"
                                              v-model="jsonEdUpSave.modal_unidad"
                                              placeholder="Selecione una opción">
                                        <span slot="no-options">No hay data para cargar</span>
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Precio referencial</label>
                                            <input type="text" class="form-control" name="referencial"
                                                   placeholder="Precio Referencial"
                                                   v-model="jsonEdUpSave.modal_precio_referencial">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Unidad de Contrato</label>
                                            <v-select label="nombre" :options="combo_unidades_contratos"
                                                      v-model="jsonEdUpSave.modal_unidad_contrato"
                                                      placeholder="Selecione una opción">
                                                <span slot="no-options">No hay data para cargar</span>
                                            </v-select>
                                        </div>
                                    </div>
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
                                            :format="configFechas.format"
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
        <!--        <configuraciones :configuracionCofinanciador="datosEnviarConfiguracion"-->
        <!--                         @enviaConfiguracionHijoAPadre="funcionRespuestaConfig" ref="RecuperaConfig"></configuraciones>-->
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
                // [{font: []}],
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
                DatePickerFormat: 'd-MM-yyyy',
                // DatePickerFormat: 'mm/dd/yyyy',
                disablesFullDate: {
                    to: new Date(1987, 5, 25), //ojo los meses menos uno //fecha desde
                    from: new Date(1987, 5, 25), //fecha hasta
                },
                // fecha: '2021-05-05',
                placeholder: "Selecione Fecha",
                placeholderDisbled: "Fecha Bloqueada",
                // format: 'mm/dd/yyyy',
                format: "dd/MM/yyyy",
                IconoBotonBorrar: "fa fa-times-circle fa-1x text-danger",
                IconoBotonAbrir: "fa fa-calendar-alt fa-1x text-success",
                typeable: false,//bloquear edicion por teclado
                disabledDates: {},
            },
            datosEnviarConfiguracion: {},

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

            combo_unidades_contratos: [],
            combo_unidades: [],
            cla_institucional: [],
            id_eliminacion: null,
            type_name: [],
            sectoriales: [],
            tipo_intervenciones: [],
            intervenciones: [],
            jsonData: {
                id: 0,
                //required to MODAL CREATE UPDATE
                modal_codigo: '',
                modal_descripcion: '',
                modal_unidad: '',
                modal_cantidad: '',
                modal_horas_requeridas: '',
                modal_dias_requeridos: '',
                modal_plazo: '',
                modal_precio_referencial: '',
                modal_unidad_contrato: '',

                //required to object
                tipo_requerimiento_id: '',
                codigo_recurso: '',
                descripcion_recurso: '',
                unidad_id: '',
                precio_referencial: '',
                unidad_contrato: '',
                //maybe
                cantidad: '',
                horas_requeridas: '',
                dias_requeridos: '',
                plazo: '',
            },
            jsonEdUpSave: {
                id: 0,
                modal_codigo: '',
                modal_descripcion: '',
                modal_unidad: '',
                modal_precio_referencial: '',
                modal_unidad_contrato: '',
                modal_tipo_requerimiento: '',
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
                    label: "Codigo",
                    name: "codigo_recurso",
                    filter: {
                        type: "simple",
                        placeholder: "Nombre",
                    },
                    sort: true,
                },
                {
                    label: "Descripcion Recurso",
                    name: "descripcion_recurso",
                    filter: {
                        type: "simple",
                        placeholder: "Tipo de Documento",
                    },
                    sort: true,
                },
                {
                    label: "Unidad",
                    name: "unidad_id",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Fecha",
                    },
                },
                {
                    label: "Precio Referencial.",
                    name: "precio_referencial",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Monto",
                    },
                },
                {
                    label: "Tipo de Unidad Contrato",
                    name: "unidad_contrato",
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
            await this.listar();
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
            let getContrata = (await axios.get('cla_institucional')).data;
            console.log('PADRE', this.jsonData.padre);
            let contratante = '';
            let contratado = '';
            for (let i in getContrata) {
                if (getContrata[i].id === this.jsonData.padre.contratante_id) {
                    contratante = getContrata[i];
                }
                i = getContrata.length;
            }
            for (let i in getContrata) {
                if (getContrata[i].id === this.jsonData.padre.contratado_id) {
                    contratado = getContrata[i];
                }
                i = getContrata.length;
            }

            console.log("CONTRATANTE", this.jsonData.contratante_id);
            console.log("CONTRATADO", this.jsonData.contratado_id);
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
        async listar() {
            const getAllItemRecurso = (await axios.get('requerimiento_mano_obra')).data;
            const getUnidades = (await axios.get('get_unidades')).data;
            let filteredItems = [];

            for (let position in getAllItemRecurso) {
                if (getAllItemRecurso[position].tipo_requerimiento_id === 1) {
                    filteredItems.push(getAllItemRecurso[position]);
                }
            }
            filteredItems.map(item => {
                item.unidad_id = getUnidades[item.unidad_id - 1].simbolo
            });
            this.rows = filteredItems;

            console.log('LISTAR TODO', getAllItemRecurso);
            console.log('LISTAR FILTRO', this.rows);
        },

        async editarModal(data = {}) {
            this.limpiar_formulario();
            const getUnidades = (await axios.get('get_unidades')).data;
            this.jsonEdUpSave.id = data.id;
            this.jsonEdUpSave.modal_tipo_requerimiento = data.tipo_requerimiento_id;
            this.jsonEdUpSave.modal_codigo = data.codigo_recurso;
            this.jsonEdUpSave.modal_descripcion = data.descripcion_recurso;

            this.jsonEdUpSave.modal_unidad = getUnidades.find(unidad => unidad.simbolo === data.unidad_id);
            this.jsonEdUpSave.modal_precio_referencial = data.precio_referencial;
            this.jsonEdUpSave.modal_unidad_contrato = data.unidad_contrato;

            this.modificar_bottom = true;
            this.guardar_bottom = false;
            console.log("EDITAR", data);
        },
        async deleteItem(id) {
            const respuesta = await axios.delete('requerimiento_mano_obra/' + id);
            console.log("DELETED", respuesta.data);
            await this.listar();
        },
        async comboUnidadesContratos() {
            this.combo_unidades = (await axios.get('get_unidades')).data;
            this.combo_unidades_contratos = [
                {id: 1, nombre: 'día'},
                {id: 2, nombre: 'u'},
            ];

            console.log('UNIDADES CONTRATO', this.combo_unidades_contratos);
            console.log('UNIDADES', this.combo_unidades);
        },
        areAlltheFieldsFilled() {
            return this.jsonEdUpSave.modal_codigo !== '' &&
                this.jsonEdUpSave.modal_descripcion !== '' &&
                this.jsonEdUpSave.modal_unidad !== '' &&
                this.jsonEdUpSave.modal_precio_referencial !== '' &&
                this.jsonEdUpSave.modal_unidad_contrato !== '';
        },
        saveItemRecurso() {
            this.jsonEdUpSave.modal_tipo_requerimiento = 1;
            this.jsonEdUpSave.modal_unidad = this.jsonEdUpSave.modal_unidad.id;
            this.jsonEdUpSave.modal_unidad_contrato = this.jsonEdUpSave.modal_unidad_contrato.nombre;
            console.log('JSONEDUPSAVE', this.jsonEdUpSave);

            let jsonEdUpSave = new FormData();
            for (let key in this.jsonEdUpSave) {
                jsonEdUpSave.append(key, this.jsonEdUpSave[key]);
            }
            return jsonEdUpSave
            // let savedRecurso = axios.post('requerimiento_mano_obra', jsonEdUpSave)
            // console.log('Save', savedRecurso);
        },
        async guardar() {
            if (this.areAlltheFieldsFilled()) {
                const jsonObject = this.saveItemRecurso();
                let savedRecurso = axios.post('requerimiento_mano_obra', jsonObject)
                console.log('Save', savedRecurso);
                document.getElementById("cerrarModal").click();
                await this.listar();
            } else {
                alert('Debe llenar todos campos');
            }
        },
        async modificar() {
            if (this.areAlltheFieldsFilled()) {
                // this.jsonEdUpSave.modal_tipo_requerimiento = 1;
                // this.jsonEdUpSave.modal_unidad = this.jsonEdUpSave.modal_unidad.id;
                // this.jsonEdUpSave.modal_unidad_contrato = this.jsonEdUpSave.modal_unidad_contrato.nombre;
                console.log('MODIFICAR', this.jsonEdUpSave);

                // const jsonObject = this.saveItemRecurso();
                let jsonModified = new FormData();
                jsonModified.append('id', this.jsonEdUpSave.id);
                jsonModified.append('modal_tipo_requerimiento', this.jsonEdUpSave.modal_tipo_requerimiento);
                jsonModified.append('modal_codigo', this.jsonEdUpSave.modal_codigo);
                jsonModified.append('modal_descripcion', this.jsonEdUpSave.modal_descripcion);
                jsonModified.append('modal_unidad', this.jsonEdUpSave.modal_unidad.id);
                jsonModified.append('modal_precio_referencial', this.jsonEdUpSave.modal_precio_referencial);
                jsonModified.append('modal_unidad_contrato', this.jsonEdUpSave.modal_unidad_contrato.nombre);
                const modifyRecurso = axios.post('update_req_mano_obra/' + this.jsonEdUpSave.id, jsonModified);
                await this.listar();
                console.log('Modified', modifyRecurso);
                document.getElementById("cerrarModal").click();
            }
            else {
                alert('Debe llenar todos campos');
            }
            // this.limpiar_formulario();
        },
        //Modal Showing the Object get From Database, and getting the name from every id to show in the modal
        ModalCrear() {
            this.modificar_bottom = false;
            this.guardar_bottom = true;
            this.limpiar_formulario();
            this.tituloIntervencionModal = "Formulario de Creación de Mano de Obra";
        },
        limpiar_formulario() {
            this.jsonEdUpSave.modal_codigo = '';
            this.jsonEdUpSave.modal_descripcion = '';
            this.jsonEdUpSave.modal_unidad = '';
            this.jsonEdUpSave.modal_precio_referencial = '';
            this.jsonEdUpSave.modal_unidad_contrato = '';
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
        /*********** funciones de configuracion**************/
        // funcionRespuestaConfig(configuracion) {//funcion recibe la solicitud hecha
        //     this.configFechas = configuracion.configFechas;
        //     this.configTablas = configuracion.configTablas;
        //     this.actions = configuracion.configTablasAction;
        //     this.classes = configuracion.configTablasClases;
        //     this.configToolBarEditText = configuracion.configToolBarEditText;
        // },
        // funcionRecuperaConfig() {//funcion solicita la configuracion
        //     this.$refs.RecuperaConfig.RecuperaConfig();//esta es la funcion de mandar configuracion desde hijo
        // },
        /*************************fin funciones de configuracion********************** */
    },
    created() {
        this.listar();
        this.comboUnidadesContratos();
    },
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
