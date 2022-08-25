<template>
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">Intervenciones</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                    Crear Intervención
                </button>
            </div>
        </div>
        <br>
        <div class="card-body"> 
            <div class="table-responsive">
                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" :actions="actions" @on-download="mostrar" :classes="classes"> 
                    <template slot="simple-filter-clear-icon">
                        <i class="fas fa-times-circle"></i>
                    </template>
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

                    <template slot = "sort-asc-icon">
                        <span class="text-primary"><i class = "fas fa-arrow-up"> </i></span>
                    </template>
                    <template slot = "sort-desc-icon">
                        <span class="text-danger"><i class = "fas fa-arrow-down"> </i></span>
                    </template>
                    <template slot = "no-sort-icon">
                        <i class = "fas fa-sort"> </i>
                    </template>

                    <template slot = "id2" slot-scope = "props">
                        <i>
                            {{props.cell_value}}
                        </i>
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
                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#intervencion" @click="ModalModificar(props.row);"><span><i class="fa fa-user-edit"></i></span></button>
                            <button type="button" class="btn btn-outline-danger ml-1" @click="eliminar(props.row.id);"><span><i class="fa fa-trash-alt"></i></span></button>                
                        </div>
                    </template>
                </vue-bootstrap4-table>
            </div>
        </div>
        <div class="modal fade" id="intervencion" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="intervencionTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="intervencionTitle">{{tituloIntervencionModal}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">   
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="institucion_id">Institución:</label>
                                        <v-select label="nombre" :options="instituciones" v-model="jsonData.institucion_id" placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="descripcion">Descripción:</label>
                                        <vue-editor 
                                            v-model="jsonData.descripcion"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                        <!-- <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingresar descripcion" v-model="jsonData.descripcion"> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">   
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="inteventiontype_id">Tipo de Intervención:</label>
                                        <v-select label="nombre" :options="tipo_intervenciones" v-model="jsonData.inteventiontype_id" placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>                             
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar Nombre" v-model="jsonData.nombre">
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="codsisin">Codsisin:</label>
                                        <input type="text" class="form-control" name="codsisin" id="codsisin" placeholder="Ingresar codsisin" v-model="jsonData.codsisin">
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="sectorial_id">Sectorial:</label>
                                        <v-select label="denominacion" :options="sectoriales" v-model="jsonData.sectorial_id" placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="fecha_aprobacion">Fecha Aprobación:</label>
                                        <!-- <input type="date" class="form-control" name="fecha_aprobacion" id="fecha_aprobacion" v-model="jsonData.fecha_aprobacion"> -->


                                        <datepicker             
                                            :language="configFechas.es"
                                            :placeholder="configFechas.placeholder"

                                            v-model="jsonData.fecha_aprobacion"

                                            :calendar-class="configFechas.nombreClaseParaModal"
                                            :input-class="configFechas.nombreClaseParaInput"
                                            :monday-first="true"
                                            :clear-button="true"
                                            :clear-button-icon="configFechas.IconoBotonBorrar"
                                            :calendar-button="true"
                                            
                                            :calendar-button-icon="configFechas.IconoBotonAbrir"
                                            calendar-button-icon-content=""
                                            :format="configFechas.format"
                                            :full-month-name="true"
                                            
                                            :bootstrap-styling="true"
                                            :disabled-dates="configFechas.disabledDates"
                                            :typeable="configFechas.typeable"
                                        >
                                        </datepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="fecha_inicial_programada">Fecha Inicial Programada:</label>
                                        <input type="date" class="form-control" name="fecha_inicial_programada" id="fecha_inicial_programada" v-model="jsonData.fecha_inicial_programada">
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="duracion_dias">Duración de Días:</label>
                                        <input type="number" class="form-control" name="duracion_dias" id="duracion_dias" v-model="jsonData.duracion_dias">
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="fecha_inicial_real">Fecha Inicial Real:</label>
                                        <input type="date" class="form-control" name="fecha_inicial_real" id="fecha_inicial_real" v-model="jsonData.fecha_inicial_real" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="monto_aprobado_bs">Monto Aprobado en Bolivianos:</label>
                                        <input type="number" class="form-control" name="monto_aprobado_bs" id="monto_aprobado_bs" v-model="jsonData.monto_aprobado_bs">
                                    </div>
                                </div>
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="monto_aprobado_dolares">Monto Aprobado en Dolares:</label>
                                        <input type="number" class="form-control" name="monto_aprobado_dolares" id="monto_aprobado_dolares" v-model="jsonData.monto_aprobado_dolares">
                                    </div>
                                </div>
                            </div>                             
                        </div>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="cerrarModal" data-dismiss="modal">Cancelar</button>
                        <button type="submit" @click="guardar();" class="btn btn-success" v-if="guardar_bottom==true">Guardar</button>
                        <button type="submit" @click="modificar();" class="btn btn-success" v-if="modificar_bottom==true">Modificar</button>
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
export default {
    props:['url','csrf','ast','operations','user'],
    data(){
        return{
            configToolBarEditText: [
                [{ font: [] }],
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],//mismo que tamaño pequeño, mediano y grande pero esta tiene seis niveles
                // [{ size: ["small", "large", "huge"] }],    //misma que tamaño 1-6 pero esta solo seria pequeño, mediano y grande
                ["bold", "italic", "underline", "strike"], // toggled buttons
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                ["link"],
                // ["link", "image", "video"],//comentamos por que no quiero que se cargue imagenes ni video
                ["clean"] // remove formatting button
            ],
            configFechas:{
                nombreClaseParaModal:"clase-modal-datepicker",
                nombreClaseParaInput:"clase-input-datepicker",
                en: en,
                es: es,
                DatePickerFormat: 'dd/MM/yyyy',
                // disabledDates: {//bloquear fechas anterior a hoy
                //         to: new Date(Date.now() - 8640000)
                //     },
                fecha:'2021-05-05',
                placeholder:"Selecione Fecha",
                format:"dd-MM-yyyy",
                IconoBotonBorrar:"fa fa-times-circle fa-1x text-danger",
                IconoBotonAbrir: "fa fa-calendar-alt fa-1x text-success",
                typeable:false,//bloquear edicion por teclado
                disabledDates:{},
                // min:'2021-05-20',
                // disabledDates: {
                //     to: new Date(2021, 9, 19), //ojo los meses menos uno //fecha desde
                //     from: new Date(2021, 9, 30), //fecha hasta
                //     // days: [6, 0], //dias de las semanas  a bloquear
                //     // daysOfMonth: [29, 30, 31], //dias de los meses a bloquear
                //     // dates: [ 
                //     //     new Date(2021, 9, 16),
                //     //     new Date(2021, 9, 17),
                //     //     new Date(2021, 9, 18),
                //     // ],
                //     // ranges: [
                //     //     { 
                //     //         from: new Date(2021, 11, 25),
                //     //         to: new Date(2021, 11, 30)
                //     //     }, {
                //     //         from: new Date(2021, 1, 12),
                //     //         to: new Date(2021, 2, 25)
                //     //     }
                //     // ],
                //     // customPredictor: function(date) {
                //     //     if(date.getDate() % 7 == 0){
                //     //         return true
                //     //     }
                //     // }
                // }

            },
            optionsSelect:[{label:'Favor de Seleccionar su opción', code:"fer"}],            
            guardar_bottom: false,
            modificar_bottom: false,
            intervenciones: [],
            tituloIntervencionModal: '',
            instituciones: [],            
            tipo_intervenciones: [],   
            sectoriales: [],
            jsonData:{
                id: 0,
                institucion_id: null,
                inteventiontype:{id:0, nombre:"Seleccione por favor...", created_at:null, updated_at: null},
                inteventiontype_id: null,
                nombre: '',
                codsisin: '',
                sectorial_id: null,
                fecha_aprobacion: '',
                fecha_inicial_programada: '',
                duracion_dias: '',
                fecha_inicial_real: '',
                descripcion: '',
                monto_aprobado_bs: '',
                monto_aprobado_dolares: '',
                fecha:'',
            },            
            rows: [],
            columns: [
            {
                label: "#",
                name: "id",
                slot_name: "id2",
                filter: {
                    type: "simple",
                    placeholder: "#",
                },
                sort: true,
                initial_sort: true,
                // initial_sort_order: "desc",                
            },
            {
                label: "#",
                name: "id",
                filter: {
                    type: "simple",
                    placeholder: "#",
                },
                sort: false,
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
                label: "Sector",
                name: "sectorial_literal",
                filter: {
                    type: "simple",
                    placeholder: "Sector"
                },
                sort: true,
            },
            {
                label: "Descripción",
                name: "descripcion",
                filter: {
                    type: "simple",
                    placeholder: "Descripción"
                },
                sort: true,
            },
            {
                label: "Fecha Aprobación",
                name: "fecha_aprobacion",
                filter: {
                    type: "simple",
                    placeholder: "Fecha Aprobación"
                },
                sort: true,
            },
            {
                label: "Duración Días",
                name: "duracion_dias",
                filter: {
                    type: "simple",
                    placeholder: "Duración Días"
                },
                sort: true,
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
                table : {
                    "table-striped my-class" : true,
                    "table-striped my-class-two" : function(rows) {
                        return true
                    }
                },
                row : {
                    "my-row my-row2" : true,
                    "function-class" : function(row) {
                        return row.id == 1
                    }
                },
                cell : {
                    "my-cell my-cell2" : true,
                    "text-danger" : function(row,column,cellValue) {
                        return column.name == "salary" && row.salary > 2500
                    }
                }
            },
            config: {
                card_mode: false,
                checkbox_rows: false,
                rows_selectable: false,
                global_search:  {
                        placeholder:  "Buscar...",
                        visibility: true,
                        case_sensitive:  true,
                        showClearButton: true,
                },
                show_refresh_button:  false,
                show_reset_button:  false,
                
                pagination: true, // default true
                pagination_info: true, // default true
                num_of_visibile_pagination_buttons: 7, // default 5
                per_page: 10, // default 10
                per_page_options:  [5,  10,  20,  30, -1],
            },
        }
    },
    methods: {
        seleccionoDespuesdeCargarFecha(){
            console.log("entro");
            console.log(this.jsonData.descripcion);
            console.log("selecciono una fecha" + this.jsonData.fecha);//v-on:closed="seleccionoDespuesdeCargarFecha"
        },
        seleccionoAntesdeCargarFecha(){
            console.log("selecciono una fecha" + this.jsonData.fecha);//v-on:selected
        },
        async listar(){
            var respuesta = await axios.get('intervenciones');
            // console.log("listar");
            // console.log(respuesta.data);
            this.intervenciones = respuesta.data;
            this.rows = respuesta.data;
        },
        async guardar(){
            console.log(this.jsonData);
            var respuesta = await axios.post('intervenciones', this.jsonData);
            console.log(respuesta);
            document.getElementById("cerrarModal").click();
            this.listar();
        },
        async modificar(){
            var respuesta = await axios.put('intervenciones/' + this.jsonData.id, this.jsonData);
            // console.log(respuesta);
            document.getElementById("cerrarModal").click();
            this.listar();
        },
        async eliminar(id){
            var respuesta = await axios.delete('intervenciones/' + id);
            // console.log(respuesta);
            this.listar();
        },
        async institucionesActivas(){
            var respuesta = await axios.get('institucions');
            // console.log(respuesta.data);
            this.instituciones = respuesta.data;
        },
        async intervencionesTipoActivas(){
            var respuesta = await axios.get('intervencions_tipo');
            // console.log("intervencion");
            // console.log(respuesta.data);
            this.tipo_intervenciones = respuesta.data;
            this.optionsSelect = respuesta.data;
        },
        async sectorialesActivos(){
            var respuesta = await axios.get('sectorials');
            console.log(respuesta.data);
            this.sectoriales = respuesta.data;
        },
        ModalCrear(){
            this.modificar_bottom=false;
            this.guardar_bottom=true;
            this.tituloIntervencionModal = "Formulario de Creación de Intervenciones";
        },
        ModalModificar(data={}){
            this.modificar_bottom=true;
            this.guardar_bottom=false;
            this.tituloIntervencionModal = "Formulario de Modificaciones de Intervenciones";
            this.jsonData.id = data.id;
            this.jsonData.institucion_id = data.institucion_id;
            this.jsonData.inteventiontype_id = data.inteventiontype_id;
            this.jsonData.nombre = data.nombre;
            this.jsonData.codsisin = data.codsisin;
            this.jsonData.sectorial_id = data.sectorial_id;
            this.jsonData.fecha_aprobacion = data.fecha_aprobacion;
            this.jsonData.fecha_inicial_programada = data.fecha_inicial_programada;
            this.jsonData.duracion_dias = data.duracion_dias;
            this.jsonData.fecha_inicial_real = data.fecha_inicial_real;
            this.jsonData.descripcion = data.descripcion;
            this.jsonData.monto_aprobado_bs = data.monto_aprobado_bs;
            this.jsonData.monto_aprobado_dolares = data.monto_aprobado_dolares;
        },
        mostrar(){
            console.log(this.jsonData.inteventiontype);
            console.log(this.jsonData.inteventiontype.id);
        },
        onDownload(payload) {
            console.log(payload);
        },
        ordenar_tabla(total){
            for(i=1; i<=total; i++){
                this.contador[i]=i;
            }
            console.log("cnotador   ");
        },
        handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
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
        }
    },
    created() {
        this.listar();
        this.institucionesActivas();
        this.intervencionesTipoActivas();
        this.sectorialesActivos();
    },
    watch: {
        props: function(val, oldVal) {
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