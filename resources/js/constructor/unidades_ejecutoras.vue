<template>
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">Unidades Ejecutoras</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                    Crear Unidad Ejecutora
                </button>
            </div>
        </div>
        <br>
        <div class="card-body"> 
            <div class="table-responsive">
                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config" @on-download="mostrar" :classes="classes">
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
                    <template slot="aprobacion" slot-scope="props">
                    <div v-if="props.row.soli_estado=='R'">
                        <button class="btn btn-outline btn-danger dim" type="button" @click="aprobarSolicitud(props.row)"><i class="fa fa-thumbs-o-down"></i></button>
                    </div>
                    <div v-else>
                        <button class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-thumbs-o-up"></i></button>
                    </div>
                    </template>
                    <template slot="descripcion"  slot-scope="props">
                        <div class="btn-group"  v-html="props.row.descripcion" style="width: 100px;
                                                                                        white-space: nowrap;
                                                                                        overflow: hidden;
                                                                                        text-overflow: Ellipsis" :title="props.row.descripcion">
                        </div>
                    </template>
                    <template slot="acciones" slot-scope="props">
                        <div class="btn-group">
                            <a :href="props.row.filePathFull" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-outline-success"><span><i class="far fa-file-pdf"></i> </span></button></a>
                            <button type="button" class="btn btn-outline-warning ml-1" data-toggle="modal" data-target="#intervencion" @click="ModalModificar(props.row);"><span><i class="fa fa-user-edit"></i></span></button>
                            <button type="button" class="btn btn-outline-danger ml-1" @click="preguntarModalAlertaConfirmacion(props.row.id);"><span><i class="fa fa-trash-alt"></i></span></button>                
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
                                        <label for="institucion">Institución:</label>
                                        <v-select label="nombre" :options="instituciones" v-model="jsonData.institucion" placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="col-md-8">   
                                                            
                                <div class="col-md-12">          
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar Nombre" v-model="jsonData.nombre">
                                    </div>
                                </div>
                            </div>           
                        </div> 
                         <div class="row">  
                             <div class="col-md-4"></div>
                                <div class="col-md-4">          
                                    <div class="form-group">
                                        <label for="fecha_aprobacion">Fecha Inicial:</label>
                                        <!-- <input type="date" class="form-control" name="fecha_aprobacion" id="fecha_aprobacion" v-model="jsonData.fecha_aprobacion"> -->
                                        <datepicker             
                                            :language="configFechas.es"
                                            :placeholder="configFechas.placeholder"

                                            v-model="jsonData.fecha_inicial"

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
                                        >
                                        </datepicker>
                                    </div>
                                </div>
                                <div class="col-md-4">          
                                    <div class="form-group">
                                        <label for="fecha_inicial_programada">Fecha Final:</label>
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

                                            v-model="jsonData.fecha_final"
                                                                                   >
                                        </datepicker>
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
        <alert-confirmacion :mensajesAlerta="mandarMensajesAlerta" @escucharAlerta="respuestaModalAlertaConfirmacion" ref="abrirAlerta"></alert-confirmacion>       
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
    props:['url','csrf','ast','operations','user'],
    data(){
        return{
            configFile:{
                cerrar:false,
                contenidoDefault:" DOCUMENTOS",              
            },
            mandarMensajesAlerta:{},
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
                DatePickerFormat: 'dd/MMMM/yyyy',
                disablesFullDate: {
                    to: new Date(1987, 5, 25), //ojo los meses menos uno //fecha desde
                    from: new Date(1987, 5, 25), //fecha hasta
                },
                fecha:'2021-05-05',
                placeholder:"Selecione Fecha",
                placeholderDisbled:"Fecha Bloqueada",
                format:"dd-MM-yyyy",
                IconoBotonBorrar:"fa fa-times-circle fa-1x text-danger",
                IconoBotonAbrir: "fa fa-calendar-alt fa-1x text-success",
                typeable:false,//bloquear edicion por teclado
                disabledDates:{},
            },
            optionsSelect:[{label:'Favor de Seleccionar su opción', code:"fer"}],            
            guardar_bottom: false,
            modificar_bottom: false,
            intervenciones: [],
            tituloIntervencionModal: '',
            instituciones: [],            
            tipo_intervenciones: [],   
            sectoriales: [],
            id_eliminacion:null,
            jsonData:{
                id: 0,
                institucion: null,
                nombre: '',               
                fecha_inicial: '',
                fecha_final: null,
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
                label: "Fecha Inicial",
                name: "fecha_inicial",
                filter: {
                    type: "simple",
                    placeholder: "fecha_inicial"
                },
                sort: true,
            },
            {
                label: "Fecha Final",
                name: "fecha_final",
                filter: {
                    type: "simple",
                    placeholder: "fecha_final"
                },
                sort: true,
            },
            {
                label: "Estado",
                name: "estado",
                filter: {
                    type: "simple",
                    placeholder: "Estado"
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
        async calcular_moneda(tipo_local){//tipo_cambio_bs_sus        
            var respuesta = await axios.get('tipo_cambio_bs_sus');
            console.log(respuesta.data);
            if(respuesta.data == ""){
                alert("No se tiene registrado el tipo de cambio para hoy");
            }else{
                if(tipo_local == 'BS'){//como guarda en bs cargamos al de dolar
                    var valor = "";
                    console.log("aqui");
                    var valor = this.jsonData.monto_aprobado_bs / respuesta.data.valor_compra;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_aprobado_dolares = valor;
                }else{//como guarda en dolar cargamos al de bs
                    var valor = "";
                    var valor = this.jsonData.monto_aprobado_dolares * respuesta.data.valor_venta;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_aprobado_bs = valor;
                    
                }
            }
        }, 
        calcula_dias(){            
            var fecha_ini = moment(this.jsonData.fecha_aprobacion);
            var fecha_fin = moment(this.jsonData.fecha_inicial_programada);
            console.log(fecha_fin.diff(fecha_ini, 'days'), ' dias de diferencia');
            this.jsonData.duracion_dias = fecha_fin.diff(fecha_ini, 'days');
        },
        preguntarModalAlertaConfirmacion(id){
            this.mandarMensajesAlerta={
                titulo:"Mensajes del Sistema",//titulo del mensaje
                contenidoCabecera:"Este es un mensaje de advertencia",//contenido del mensaje
                contenidoCuerpo:"La acción es irreversible",//contenido del mensaje
                contenidoPie:"¿Esta seguro de eliminar el registro?",//contenido del mensaje
                tipo:"ferdy-background-Primary-blak",//color danger warnin etc para header de modal
                tituloBotonUno:"SI", //texto de primer boton el de true
                tituloBotonDos:"NO", //texto segundo boton del de false
                respuesta:false,
            };
            this.id_eliminacion = id;
            this.$refs.abrirAlerta.abrirAlerta();
        },
        respuestaModalAlertaConfirmacion(datos){
            // console.log(datos.respuesta);
            if(datos.respuesta==true){
                this.eliminar(this.id_eliminacion);
            }
        },
        seleccionoDespuesdeCargarFecha(){
            console.log("entro");
            console.log(this.jsonData.descripcion);
            console.log("selecciono una fecha" + this.jsonData.fecha);//v-on:closed="seleccionoDespuesdeCargarFecha"
        },
        seleccionoAntesdeCargarFecha(){
            console.log("selecciono una fecha" + this.jsonData.fecha);//v-on:selected
        },
        async listar(){
            var respuesta = await axios.get('listar_unidades_ejecutoras');
           
            console.log(respuesta.data);            
            this.intervenciones = respuesta.data;
            this.rows = respuesta.data;
        },
        async institucionesActivas(){
             console.log('institucionesActivas');
            var respuesta = await axios.get('institucions_intervencion');
            // console.log(respuesta.data);
            this.instituciones = respuesta.data;
            // this.jsonData.institucion = respuesta.data;
        },
        async guardar(){
           alert('guardar estamos aqui');

            let datos_jsonData = new FormData();
            for(let key in this.jsonData){
                datos_jsonData.append(key, this.jsonData[key]);
            }

             console.log(this.jsonData);
             console.log(datos_jsonData);
             
            var fecha_aprobacion = new Date(this.jsonData.fecha_aprobacion);
            datos_jsonData.append('fecha_aprobacion_dat', fecha_aprobacion.getFullYear() + "-" + (fecha_aprobacion.getMonth() + 1) + "-" + fecha_aprobacion.getDate());
            var fecha_inicial_programada = new Date(this.jsonData.fecha_inicial_programada);
            datos_jsonData.append('fecha_inicial_programada_dat', fecha_inicial_programada.getFullYear() + "-" + (fecha_inicial_programada.getMonth() + 1) + "-" + fecha_inicial_programada.getDate());
            datos_jsonData.append('institucion_id', this.jsonData.institucion.id);
            datos_jsonData.append('sectorial_id', this.jsonData.sectorial.id);
            datos_jsonData.append('tipo_intervencion_id', this.jsonData.tipo_intervencion.id);
            var respuesta = await axios.post('intervenciones', datos_jsonData);
            console.log(respuesta.data);
            document.getElementById("cerrarModal").click();
            this.listar();
        },
        async modificar(){
            // console.log(this.jsonData);
            let datos_jsonData = new FormData();
            for(let key in this.jsonData){
                datos_jsonData.append(key, this.jsonData[key]);
            }
            var fecha_aprobacion = new Date(this.jsonData.fecha_aprobacion);
            datos_jsonData.append('fecha_aprobacion_dat', fecha_aprobacion.getFullYear() + "-" + (fecha_aprobacion.getMonth() + 1) + "-" + fecha_aprobacion.getDate());
            var fecha_inicial_programada = new Date(this.jsonData.fecha_inicial_programada);
            datos_jsonData.append('fecha_inicial_programada_dat', fecha_inicial_programada.getFullYear() + "-" + (fecha_inicial_programada.getMonth() + 1) + "-" + fecha_inicial_programada.getDate());
            datos_jsonData.append('institucion_id', this.jsonData.institucion.id);
            datos_jsonData.append('sectorial_id', this.jsonData.sectorial.id);
            datos_jsonData.append('tipo_intervencion_id', this.jsonData.tipo_intervencion.id);
            var respuesta = await axios.post('intervenciones_mod', datos_jsonData);
            console.log(respuesta.data);
            document.getElementById("cerrarModal").click();
            this.listar();
        },
        async eliminar(id){  
            this.id_eliminacion = null;          
            var respuesta = await axios.delete('intervenciones/' + id);
            this.listar();
        },
        
        
        
        ModalCrear(){
            this.modificar_bottom=false;
            this.guardar_bottom=true;
            this.tituloIntervencionModal = "Formulario de Creación de Unidades Ejecutoras";
        },
        ModalModificar(data={}){            
            this.modificar_bottom=true;
            this.guardar_bottom=false;
            this.tituloIntervencionModal = "Formulario de Modificaciones de  Unidades Ejecutoras";
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
        },
        /////////////////*****************funciones de configuraciones********************* */

        borrar_file(){            
            var nombre_file = "<i class='fas fa-download fa-1x'></i><br><span> " + this.configFile.contenidoDefault + "</span>";
            $('#documento_res_aprobacion').val("");
            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-primary'], '#contenido_documento_res_aprobacion',[nombre_file]);
        },
        reiniciar_file(id, clase_borrar, clase_adicionar, id_contenido, contenido_cargar){
            // console.log("entro");
            console.log(contenido_cargar);
            // console.log("salio");
            if(id != null){
                $(id_contenido).empty();
                if(contenido_cargar != null){
                    contenido_cargar.forEach(element => {
                        // console.log(element);
                        $(id_contenido).append(element);
                    });
                }
                if(clase_borrar != null){
                    for(let key in clase_borrar){
                        $(id).removeClass(clase_borrar[key]);
                    }
                }
                if(clase_adicionar != null){
                    for(let key in clase_adicionar){
                        $(id).addClass(clase_adicionar[key]);
                    }
                }
            }
        },
        cargar_file(event){
            var nombre_file = "";
            this.jsonData.files = event.target.files[0];
            for(let key in event.target.files){//cargamos datos
                var boucle = event.target.files[key];
                if(boucle.name!=null && boucle.name!='undefined' && boucle.name!="item"){
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
            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-success'], '#contenido_documento_res_aprobacion',[nombre_file]);
        },
    },
    created() {
        this.listar();
        this.institucionesActivas();
        //this.intervencionesTipoActivas();
        //this.sectorialesActivos();
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