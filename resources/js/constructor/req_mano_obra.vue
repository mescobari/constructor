<template slot-scope="props">
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">Creacion de Mano Obra</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#contrato"
                        @click="ModalCrear();">
                    Crear Requerimiento de Mano Obra
                </button>
            </div>
        </div>
        <br>
        <!--------------------------------------------Tabla de Contratos----------------------------------------------->
        <div class="card-body">
            <div class="table-responsive">
                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" :classes="classes">
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
        <!----------------------------------------Fin Modal Crear---------------------------------------->

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
import {VueEditor} from "vue2-editor";

Vue.component("v-select", vSelect);
// Vue.component('vueDropzone', vue2Dropzone);

export default {
    props: ['url', 'csrf', 'ast', 'operations', 'user'],
    data() {
        return {
            mandarMensajesAlerta: {},
            datosEnviarConfiguracion: {},

            optionsSelect: [{label: 'Favor de Seleccionar su opción', code: "fer"}],
            guardar_bottom: false,
            modificar_bottom: false,
            success: '',
            tituloIntervencionModal: '',
            listUnidadesHarcoded: [{id: 1, nombre: 'día'}, {id: 2, nombre: 'u'},],
            combo_unidades_contratos: [],
            combo_unidades: [],
            id_eliminacion: null,
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
                        placeholder: "ID",
                    },
                    sort: true,
                    uniqueId: true,
                },
                {
                    label: "Codigo",
                    name: "codigo_recurso",
                    filter: {
                        type: "simple",
                        placeholder: "Codigo",
                    },
                    sort: true,
                },
                {
                    label: "Descripcion Recurso",
                    name: "descripcion_recurso",
                    filter: {
                        type: "simple",
                        placeholder: "Recurso",
                    },
                    sort: true,
                },
                {
                    label: "Unidad",
                    name: "unidad_id",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Unidad",
                    },
                },
                {
                    label: "Precio Referencial.",
                    name: "precio_referencial",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Precio",
                    },
                },
                {
                    label: "Tipo de Unidad Contrato",
                    name: "unidad_contrato",
                    sort: false,
                    filter: {
                        type: "simple",
                        placeholder: "Tipo",
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

    watch: {},
    methods: {
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
            const getAllItemRecurso = (await axios.get('requerimiento_recurso')).data;
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
            this.jsonEdUpSave.modal_unidad_contrato = this.listUnidadesHarcoded.find(unidad_contrato =>
                unidad_contrato.nombre === data.unidad_contrato);

            this.tituloIntervencionModal = "Formulario de Modificacion de Mano de Obra";
            this.modificar_bottom = true;
            this.guardar_bottom = false;
            console.log("EDITAR", data);
        },
        async deleteItem(id) {
            const respuesta = await axios.delete('requerimiento_recurso/' + id);
            console.log("DELETED", respuesta.data);
            await this.listar();
        },
        async comboUnidadesContratos() {
            this.combo_unidades = (await axios.get('get_unidades')).data;
            this.combo_unidades_contratos = this.listUnidadesHarcoded;

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
        },
        async guardar() {
            if (this.areAlltheFieldsFilled()) {
                const jsonObject = this.saveItemRecurso();
                let savedRecurso = axios.post('requerimiento_recurso', jsonObject)
                console.log('Save', savedRecurso);
                document.getElementById("cerrarModal").click();
                await this.listar();
            } else {
                alert('Debe llenar todos campos');
            }
        },
        async modificar() {
            if (this.areAlltheFieldsFilled()) {
                console.log('MODIFICAR', this.jsonEdUpSave);
                const jsonObject = this.saveItemRecurso();
                const modifyRecurso = axios.post('update_req_recurso/' + this.jsonEdUpSave.id, jsonObject);
                await this.listar();
                console.log('Modified', modifyRecurso);
                document.getElementById("cerrarModal").click();
            } else {
                alert('Debe llenar todos campos');
            }
        },
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
