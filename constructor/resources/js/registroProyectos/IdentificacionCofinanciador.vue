<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">COFINANCIADORES</h3>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                        Crear Cofinanciador
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
                <div class="container-fluid p-3 border rounded">
                    <label for="">Institución cofinanciadora:</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codsisin">Institución de cofinanciamiento:</label>
                                <v-select label="nombre" :options="instituciones" v-model="jsonData.instituciones" placeholder="Selecione una Institución">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codsisin">Organismo Financiador:</label>
                                <v-select label="nombre" :options="organismos" v-model="jsonData.organismos" placeholder="Selecione un Organismo Financiador">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codsisin">Tipo de Documento:</label>
                                <v-select label="nombre" :options="tipo_documento" v-model="jsonData.tipo_documento" placeholder="Selecione un Tipo de Documento">
                                    <span slot="no-options">No hay datos para cargar</span>
                                </v-select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codsisin">Nombre del Documento:</label>
                                <input type="text" class="form-control" v-model="jsonData.titulo" >
                            </div>
                        </div>
                        <div class="col-md-4">                            
                            <div class="form-group">
                                <label for="codsisin">Fecha de firma Convenio/Aprobación:</label>
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
                        <div class="col-md-4">                            
                            <div class="form-group">
                                <label for="codsisin">Fecha de Conclusión:</label>
                                <datepicker             
                                    :language="configFechas.es"
                                    :placeholder="configFechas.placeholder"

                                    v-model="jsonData.fecha_vencimiento"

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
                                    @closed="calcula_dias()"
                                >
                                </datepicker>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="codsisin">Objeto:</label>                                
                                <vue-editor 
                                    v-model="jsonData.objeto"
                                    :editor-toolbar="configToolBarEditText"
                                ></vue-editor>
                            </div>
                        </div>
                        <div class="col-md-4">                                                            
                            <div class="col-md-12">                            
                                <div class="form-group">
                                    <label for="codsisin">Monto Financiado en Bolivianos:</label>
                                    <input type="number" class="form-control" v-model="jsonData.monto_bs" @blur="calcular_moneda('BS')">
                                </div>
                            </div>                                                      
                            <div class="col-md-12">                            
                                <div class="form-group">
                                    <label for="codsisin">Monto Financiado en Dolares:</label>
                                    <input type="number" class="form-control" v-model="jsonData.monto_Sus" @blur="calcular_moneda('SUS')">
                                </div>
                            </div>
                            <div class="col-md-12">                            
                                <div class="form-group">
                                    <label for="codsisin">Vigencia en días:</label>
                                    <input type="number" class="form-control" v-model="jsonData.duracion_dias" >
                                </div>
                            </div>
                            <div class="col-md-12">                            
                                <div class="form-group">
                                    <label for="documento_res_aprobacion" id="label_documento_res_aprobacion" class="bg-primary" 
                                    style="font-size: 14px; font-weight: 600; color: #fff; display: inline-block; transition: all .5s; cursor: pointer; padding: 10px 15px !important; width: 100%; text-align: center; border-radius: 7px;">
                                        <span id="contenido_documento_res_aprobacion"><i class="fas fa-download fa-1x"></i><br> <span> {{configFile.contenidoDefault}}</span></span>
                                        <button type="button" class="close" v-if="configFile.cerrar" @click="borrar_file();"> <span>&times;</span> </button>
                                    </label>
                                    <input type="file" class="form-control" id="documento_res_aprobacion" @change="cargar_file" style="display:none">
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <div class="container">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" @click="guardar();" v-if="btnguardar"><i class="fas fa-list"></i> Grabar en lista</button>
                                    <button type="button" class="btn btn-warning" @click="modificar();" v-if="btnmodificar"><i class="fas fa-user-edit"></i> Modificar en lista</button>
                                    <button type="button" class="btn btn-danger" @click="limpiar_formulario();" v-if="btncancelar"><i class="fas fa-user-edit"></i> Cancelar Modificación</button>                                    
                                </div>        
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="table-responsive">
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
                <template slot="filePath" slot-scope="props">
                    <a :href="props.row.filePathFull" target="_blank" title="Ver el archivo digital">
                        <span class="badge badge-primary">Ver: {{props.row.cofinanciador_documento.titulo}}</span>
                    </a>                    
                </template>
                <template slot="acciones" slot-scope="props">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#intervencion" @click="editar(props.row);"><span><i class="fa fa-user-edit"></i></span></button>
                        <button type="button" class="btn btn-outline-danger ml-1" @click="eliminar(props.row.id);"><span><i class="fa fa-trash-alt"></i></span></button>                
                    </div>
                </template>
            </vue-bootstrap4-table>
        </div>
        <div class="modal fade" id="seleccion_proyecto_cofinanciamiento" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="seleccion_proyecto_cofinanciamientoTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="seleccion_proyecto_cofinanciamientoTitle">Seleccione el Nombre de Proyecto</h5>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="buscar_cofinanciadores();">Seleccionar</button>
                    </div>
                </div>
            </div>
        </div>
        <configuraciones :configuracionCofinanciador="datosEnviarConfiguracion" @enviaConfiguracionHijoAPadre="funcionRespuestaConfig" ref="RecuperaConfig"></configuraciones>        
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
            instituciones:[],
            organismos:[],
            tipo_documento:[],
            btnguardar:true,
            btnmodificar:false,
            btncancelar:false,
            configFile:{
                cerrar:false,
                contenidoDefault:" DOCUMENTO/RES APROBACIÓN",              
            },
            jsonData:{
                id:null,
                id_cofinanciador:null,
                proyectos:[],
                instituciones:[],
                organismos:[],
                tipo_documento:[],
                titulo:null,
                objeto:null,
                fecha_firma:'',
                fecha_vencimiento:'',
                duracion_dias:null,
                monto_bs:null,
                monto_Sus:null,
                padre:null,
                pathDocumento:null,
                files:null,
            },
            rows:[],
            columns:[
                { label: "#",                       name: "id",         filter: { type: "simple", placeholder: "#", },                sort: true, uniqueId: true, },
                { label: "Institución",             name: "institucion.nombre",    filter: { type: "simple", placeholder: "Institución", },           sort: true, },
                { label: "Nombre del Documento",    name: "cofinanciador_documento.titulo",    filter: { type: "simple", placeholder: "Nombre de documento" },            sort: true, },
                { label: "Fecha Firma",             name: "cofinanciador_documento.fecha_firma",    filter: { type: "simple", placeholder: "Fecha firma" },       sort: true, },
                { label: "Duracion en Días",        name: "cofinanciador_documento.duracion_dias",    filter: { type: "simple", placeholder: "Duración en días" },  sort: true, },
                { label: "Monto Cofinanciado Bs",   name: "cofinanciador_documento.monto_bs",    filter: { type: "simple", placeholder: "Monto Bs" },     sort: true, },
                { label: "Monto Cofinanciado $us",  name: "cofinanciador_documento.monto_Sus",    filter: { type: "simple", placeholder: "Monto $us" },     sort: true, },
                { label: "Documento digital",       name: "filePath",    filter: { type: "simple", placeholder: "Archivos" },     sort: true, },
                { label: "Acciones",                name: "acciones",   sort: false, },
            ],
            
            datosEnviarConfiguracion:{},        
            configFechas:{},
            configTablas:{},
            actions:[],
            classes:{},
            configToolBarEditText:[],
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
                    var valor = this.jsonData.monto_bs / respuesta.data.valor_compra;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_Sus = valor;
                }else{//como guarda en dolar cargamos al de bs
                    var valor = "";
                    var valor = this.jsonData.monto_Sus * respuesta.data.valor_venta;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_bs = valor;
                    
                }
            }
        }, 
        async listar(){
            
        },
        async guardar(){
            // console.log("guarda cofinanciadores");
            let datos_jsonData = new FormData();
            for(let key in this.jsonData){                
                datos_jsonData.append(key, this.jsonData[key]);
            }
            console.log(this.jsonData.tipo_documento.id);
            if(this.jsonData.tipo_documento.id != 'undefined' && this.jsonData.tipo_documento.id != null && this.jsonData.tipo_documento.id != undefined ){
                datos_jsonData.append('id_intitucion', this.jsonData.instituciones.id);
                datos_jsonData.append('id_organismo', this.jsonData.organismos.id);
                datos_jsonData.append('id_proyecto', this.jsonData.proyectos.id);
                datos_jsonData.append('id_tipo_documento', this.jsonData.tipo_documento.id);
                // datos_jsonData.append('fecha_firma_1', JSON.stringify(this.jsonData.fecha_firma));
                var fecha_firma = new Date(this.jsonData.fecha_firma);
                var fecha_vencimiento = new Date(this.jsonData.fecha_vencimiento);
                var dia1 = fecha_firma.getDate() + "";
                var dia2 = fecha_vencimiento.getDate() + "";
                if(dia1.length == 1){ dia1 = "0" + fecha_firma.getDate(); }else{ dia1 = "" + fecha_firma.getDate(); }
                if(dia2.length == 1){ dia2 = "0" + fecha_vencimiento.getDate(); }else{ dia2 = "" + fecha_vencimiento.getDate(); }

                datos_jsonData.append('id_fecha_firma', fecha_firma.getFullYear() + "-" + (fecha_firma.getMonth() + 1) + "-" + dia1);
                datos_jsonData.append('id_fecha_vencimiento', fecha_vencimiento.getFullYear() + "-" + (fecha_vencimiento.getMonth() + 1) + "-" + dia2);
               
               console.log(datos_jsonData);
                var respuesta = await axios.post('cofinanciadores', datos_jsonData);
                console.log(respuesta.data);
                this.buscar_cofinanciadores();
                this.limpiar_formulario();
            }else{
                alert("Favor de seleccionar el tipo de documento");
            }            
        },
        editar(fila){
            // console.log(fila);
            // console.log(this.jsonData);
            this.jsonData.id = fila.id;
            // this.jsonData.proyectos = var;//ya esta por default el proyecto
            this.jsonData.id_cofinanciador = fila.cofinanciador_documento.id;
            this.jsonData.instituciones = fila.institucion;
            this.jsonData.organismos = fila.organismo;
            this.jsonData.tipo_documento = fila.cofinanciador_documento.tipo_documento;
            this.jsonData.titulo = fila.cofinanciador_documento.titulo;
            this.jsonData.objeto = fila.cofinanciador_documento.objeto;
            this.jsonData.fecha_firma = fila.cofinanciador_documento.fecha_firma;
            this.jsonData.fecha_vencimiento = fila.cofinanciador_documento.fecha_vencimiento;
            this.jsonData.duracion_dias = fila.cofinanciador_documento.duracion_dias;
            this.jsonData.monto_bs = fila.cofinanciador_documento.monto_bs;
            this.jsonData.monto_Sus = fila.cofinanciador_documento.monto_Sus;
            this.jsonData.padre = fila.cofinanciador_documento.padre;
            this.jsonData.pathDocumento = fila.cofinanciador_documento.pathDocumento;
            // this.jsonData.files = fila.cofinanciador_documento.;//solo se carga al cargar documentos
            
            this.configFile.contenidoDefault = fila.cofinanciador_documento.pathDocumento;
            this.btnmodificar = true;
            this.btncancelar = true;
            this.btnguardar = false;
        },
        async modificar(){    
            let datos_jsonData = new FormData();
            for(let key in this.jsonData){                
                datos_jsonData.append(key, this.jsonData[key]);
            }
            datos_jsonData.append('id_intitucion', this.jsonData.instituciones.id);
            datos_jsonData.append('id_organismo', this.jsonData.organismos.id);
            datos_jsonData.append('id_proyecto', this.jsonData.proyectos.id);
            datos_jsonData.append('id_tipo_documento', this.jsonData.tipo_documento.id);
            var fecha_firma = new Date(this.jsonData.fecha_firma);
            var fecha_vencimiento = new Date(this.jsonData.fecha_vencimiento);
            datos_jsonData.append('id_fecha_firma', fecha_firma.getFullYear() + "-" + (fecha_firma.getMonth() + 1) + "-" + fecha_firma.getDate());
            datos_jsonData.append('id_fecha_vencimiento', fecha_vencimiento.getFullYear() + "-" + (fecha_vencimiento.getMonth() + 1) + "-" + fecha_vencimiento.getDate());
            console.log(datos_jsonData);
            var respuesta = await axios.post('cofinanciadores_mod', datos_jsonData);
            console.log(respuesta.data);
            this.buscar_cofinanciadores();
            this.limpiar_formulario();
        },
        async eliminar(id){  
            console.log(id);
            var respuesta = await axios.delete('cofinanciadores/' + id);
            console.log(respuesta.data);
            this.buscar_cofinanciadores();
            // this.listar();
        },
        limpiar_formulario(){
            this.jsonData.id=null;
            this.jsonData.id_cofinanciador=null;
            this.jsonData.instituciones=[];
            this.jsonData.organismos=[];
            this.jsonData.tipo_documento=[];
            this.jsonData.titulo=null;
            this.jsonData.objeto=null;
            this.jsonData.fecha_firma='';
            this.jsonData.fecha_vencimiento='';
            this.jsonData.duracion_dias=null;
            this.jsonData.monto_bs=null;
            this.jsonData.monto_Sus=null;
            this.jsonData.padre=null;
            this.jsonData.pathDocumento=null;
            this.jsonData.files=null;

            this.btnmodificar = false;
            this.btncancelar = false;
            this.btnguardar = true;
            this.configFile.contenidoDefault = " DOCUMENTO/RES APROBACIÓN";
            this.borrar_file();
        },
        currentDateTime() {
            moment.locale('es');
            // return moment().format('MMMM Do YYYY, h:mm:ss a'); //formato //noviembre lu 2021, 10:13:40 am
            // return moment().format('MMMM ddd YYYY, h:mm:ss a');//noviembre lun. 2021, 10:14:08 am
            return moment().format('MMMM D YYYY, h:mm:ss a');//noviembre 8 2021, 10:14:46 am
        },   
        async seleccionar_proyecto(){
            // console.log("entro");
            // this.jsonData.nombreInstitucion = respuesta.data.institucion.nombre;
            var respuesta = await axios.get('proyectos');
            // console.log(respuesta.data);
            this.proyectos = respuesta.data;
            $("#seleccion_proyecto_cofinanciamiento").modal("show");            
            // console.log("salio");
        },
        async instituciones_activas(){
            var respuesta = await axios.get('institucions_sin_padres');
            // console.log(respuesta.data);
            this.instituciones = respuesta.data;
        },
        async organismosFinanciadores(){
            var respuesta = await axios.get('organismos');
            // console.log(respuesta.data);
            this.organismos = respuesta.data;
        },
        async tipoDocumento(){
            var respuesta = await axios.get('TiposDocumentos');
            // console.log(respuesta.data);
            this.tipo_documento = respuesta.data;
        },
        calcula_dias(){            
            var fecha_ini = moment(this.jsonData.fecha_firma);
            var fecha_fin = moment(this.jsonData.fecha_vencimiento);
            // console.log(fecha_fin.diff(fecha_ini, 'days'), ' dias de diferencia');
            this.jsonData.duracion_dias = fecha_fin.diff(fecha_ini, 'days');
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
        async buscar_cofinanciadores(){
            var data = {
                'intervencion':this.jsonData.proyectos,
            }
            console.log(data);
            var respuesta = await axios.post('buscar_cofinanciadores', data);
            // console.log("cofinanciadores");
            console.log(respuesta.data);
            this.rows = respuesta.data;
        },
        /*********** funciones de configuracion**************/
        funcionRespuestaConfig(configuracion){//funcion recibe la solicitud hecha
            this.configFechas = configuracion.configFechas;
            this.configTablas = configuracion.configTablas;
            this.actions = configuracion.configTablasAction;
            this.classes = configuracion.configTablasClases;
            this.configToolBarEditText = configuracion.configToolBarEditText;
        },
        funcionRecuperaConfig(){//funcion solicita la configuracion
            this.$refs.RecuperaConfig.RecuperaConfig();//esta es la funcion de mandar configuracion desde hijo
        }
        /*************************fin funciones de configuracion********************** */
    },
    mounted() {
        this.instituciones_activas();
        this.organismosFinanciadores();
        this.tipoDocumento();
        this.funcionRecuperaConfig();
        this.seleccionar_proyecto();
    },
    created(){

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