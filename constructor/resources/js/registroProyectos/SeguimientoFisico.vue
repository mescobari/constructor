<template>
    <div class="card">
        <div class="card-header ferdy-background-Primary-blak">
            <h3 class="card-title">{{institucion_auth.nombre}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                    Adicionar Informe
                </button>
            </div>
        </div>
        <br>
        <div class="card-body"> 
            <h3>LISTA DE INFORMES DE AVANCE FÍSICO</h3>
            <!-- <label for="">Estructura de Financiamiento</label> -->
            <div class="row">
                <div class="col-md-3">          
                    <div class="form-group">
                        <label for="codsisin">Codsisin:</label>
                        <input type="text" class="form-control" v-model="jsonData.proyectos.codsisin" readonly>
                    </div>
                </div>
                <div class="col-md-6">          
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" v-model="jsonData.proyectos.nombre" readonly>
                    </div>
                </div>
                <div class="col-md-3">          
                    <label for="codsisin">Gestión:</label>
                    <v-select label="gestion" :options="gestiones" v-model="jsonData.gestion_activa" placeholder="Selecione un Cofinanciador"  @input="cargarListas()">
                        <span slot="no-options">No hay datos para cargar</span>
                    </v-select>     <br>  
                    <a :href="'../Reportes/seguimiento_comprobante/' + jsonData.proyectos.id + '/' + jsonData.gestion_activa.gestion" target="_blank" rel="">            
                        <button class="btn btn-danger btn-block"><span><i class="fas fa-print"></i> Imprimir Lista de Informes</span></button>
                    </a>
                </div>
            </div>
            <div class="modal fade" id="seguimiento_fisico_modal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="seguimiento_fisico_modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header ferdy-background-Primary-blak">
                            <h5 class="modal-title" id="seguimiento_fisico_modalTitle">{{jsonData.nombreInstitucion}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">          
                                    <div class="form-group">
                                        <label for="codsisin">Codsisin:</label>
                                        <input type="text" class="form-control" v-model="jsonData.proyectos.codsisin" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">          
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" v-model="jsonData.proyectos.nombre" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">          
                                    <label for="codsisin">Tipo Movimiento:</label>
                                    <v-select label="nombre" :options="comboTipoMovimiento" v-model="jsonData.tipo_movimiento" placeholder="Selecione un Cofinanciador">
                                        <span slot="no-options">No hay datos para cargar</span>
                                    </v-select>
                                </div>
                            </div>
                            <div class="container-fluid p-3 border rounded">
                                <div class="row">
                                    <div class="col-md-4">          
                                        <div class="form-group">
                                            <label for="codsisin">Tipo de informe:</label>
                                            <v-select label="nombre" :options="tipo_documento" v-model="jsonData.tipo_informe" placeholder="Selecione un Cofinanciador">
                                                <span slot="no-options">No hay datos para cargar</span>
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">          
                                        <div class="form-group">
                                            <label for="codsisin">Gestión:</label>
                                            <v-select label="gestion" :options="gestiones" v-model="jsonData.gestion_activa" placeholder="Selecione un Cofinanciador"  @input="cargarListas()" disabled>
                                                <span slot="no-options">No hay datos para cargar</span>
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">          
                                        <div class="form-group">
                                            <label for="codsisin">Documento de Respaldo:</label>                   
                                            <label for="documento_res_aprobacion" id="label_documento_res_aprobacion" class="bg-primary" 
                                            style="font-size: 14px; font-weight: 600; color: #fff; display: inline-block; transition: all .5s; cursor: pointer; padding: 10px 15px !important; width: 100%; text-align: center; border-radius: 7px;">
                                                <span id="contenido_documento_res_aprobacion"><i class="fas fa-download fa-1x"></i><br> <span> {{configFile.contenidoDefault}}</span></span>
                                                <button type="button" class="close" v-if="configFile.cerrar" @click="borrar_file();"> <span>&times;</span> </button>
                                            </label>
                                            <input type="file" class="form-control" id="documento_res_aprobacion" @change="cargar_file" style="display:none">
                                        </div>
                                    </div>
                                    <div class="col-md-9">                                                    
                                        <div class="form-group">
                                            <label for="codsisin">Informe:</label>                   
                                            <vue-editor 
                                                v-model="jsonData.glosa"
                                                :editor-toolbar="configToolBarEditText"
                                            ></vue-editor>
                                        </div>
                                    </div>
                                    <div class="col-md-3"><br><br>
                                        <div class="row">
                                            <div class="col-md-12 p-2">                                   
                                                <button class="btn btn-success btn-block" v-if="btnguardarInfome" @click="guardar_informe()"><span><i class="fas fa-save"></i> Guardar</span></button>
                                                <button class="btn btn-warning btn-block" v-if="btnmodificarInforme" @click="modificar_comprobante_encabezado()"><span><i class="fas fa-user-edit"></i> Modificar</span></button>
                                            </div>
                                            <div class="col-md-12 p-2" v-if="btnimprimirInforme">
                                                <a :href="'reporte/' + jsonData.comprobante_encabezado_id" target="_blank" rel="">
                                                    <button class="btn btn-danger btn-block"><span><i class="fas fa-print"></i> Imprimir Informe</span></button>
                                                </a>                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- tabla -->            
                            <div class="table-responsive">
                                <div class="row">
                                    <label for="">Registre Avance de Indicadores</label>
                                </div>
                                <vue-bootstrap4-table :rows="rowsSeguimientoFisico" :columns="columnsSeguimientoFisico" :config="configTablas" :classes="configTablas.classes">
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
                   
                                    <template slot="comentario" slot-scope="props">
                                        <div class="form-group">        
                                            <input type="text" class="form-control" v-model="props.row.comentario" v-if="props.row.informe_seguimiento_id == null">     
                                            <input type="text" class="form-control" v-model="props.row.glosa" v-else>           
                                        </div>
                                    </template>
                                    <template slot="valor_observado" slot-scope="props">
                                        <div class="form-group">        
                                            <input type="number" class="form-control" v-model="props.row.valor_observado" v-if="props.row.informe_seguimiento_id == null"> 
                                            <input type="number" class="form-control" v-model="props.row.valor_medido" v-else>           
                                        </div>
                                    </template>                                    
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-success" @click="guardarAvanceIndicador(props.row);" v-if="props.row.informe_seguimiento_id == null"><span><i class="fa fa-save"></i></span></button>
                                            <button type="button" class="btn btn-outline-warning ml-1" @click="modificarAvanceIndicador(props.row);" v-if="props.row.informe_seguimiento_id != null"><span><i class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1" @click="eliminarAvanceIndicador(props.row.id);" v-if="props.row.informe_seguimiento_id != null"><span><i class="fa fa-trash-alt"></i></span></button>
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                        </div>
                    </div>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="cargarElementosDeIntervencion();">Seleccionar</button>
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

                <template slot="partidas" slot-scope="props">
                    <span :title="props.row.partidas.nombre">{{props.row.partidas.codigo}}</span>
                </template>                    
                <template slot="acciones" slot-scope="props">
                    <div class="btn-group">
                        <a :href="'../Reportes/seguimiento_comprobante_individual/' + props.row.id" target="_blank" rel="">
                        <button type="button" class="btn btn-outline-success" @click="imprimir(props.row);"><span><i class="far fa-file-pdf"></i></span></button>
                        </a>
                        <button type="button" class="btn btn-outline-warning ml-1" @click="editar(props.row);"><span><i class="fa fa-user-edit"></i></span></button>
                        <button type="button" class="btn btn-outline-danger ml-1" @click="eliminar(props.row);"><span><i class="fa fa-trash-alt"></i></span></button>                
                    </div>
                </template>
            </vue-bootstrap4-table>
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
    props:['institucion_auth'],
    data(){
        return{
            btnguardar:false,
            btnadicionar:false,
            btnmodificar:false,
            btnguardarInfome:false,
            btnmodificarInforme:true,
            btnimprimirInforme:true,
            btnimprimircomprobante:true,

            configFile:{
                cerrar:false,
                contenidoDefault:" DOCUMENTO/RES APROBACIÓN",              
            },
            comboComponentes:[],
            comboPartidas:[],
            comboCofinanciadores:[],
            comboTipoMovimiento:[
                {
                    id:2,
                    nombre:'Ejecución',
                    sigla:'EJ',
                    created_at:null,
                    updated_at:null,
                }
            ],
            tipo_documento:[],
            gestiones:[],
            proyectos:[],
            jsonData:{
                gestion_activa:{},
                comprobante_encabezado_id:null,
                proyectos:{},
                fecha:'',
                gestion:[],
                concepto:'',
                comprobante_detalle_id:null,
                componente:{},
                partida:{},
                cofinanciador:{},
                monto_bs:'',
                monto_sus:'',
                glosa:'',
                pathDocumento:'',
                tipo_movimiento:{
                    id:2,
                    nombre:'Ejecución',
                    sigla:'EJ',
                    created_at:null,
                    updated_at:null,
                },
                tipo_informe:{},
                id_informe_fisico:null,
            },
            rowsSeguimientoFisico:[],
            columnsSeguimientoFisico:[
                { label: "Componente",      name: "componentes.desc_corta",     filter: { type: "simple", placeholder: "Componente", },         sort: true, },
                { label: "Actividad",         name: "partidas",        filter: { type: "simple", placeholder: "Partida" },            sort: true, },
                { label: "Resultado",   name: "cofinanciadores.institucion.nombre",  filter: { type: "simple", placeholder: "Cofinanciador" },       sort: true, },
                { label: "Indicador",     name: "concepto",        filter: { type: "simple", placeholder: "Monto en Bs" },  sort: true, },
                { label: "Comentario",    name: "comentario",       filter: { type: "simple", placeholder: "Monto en $us" },     sort: true, },                
                { label: "Valor Observado",    name: "valor_observado",       filter: { type: "simple", placeholder: "Monto en $us" },     sort: true, },                
                { label: "Acciones",        name: "acciones",       sort: false, },
            ],            

            rows:[],
            columns:[
                { label: "Numero",      name: "id",     filter: { type: "simple", placeholder: "Componente", },         sort: true, },
                { label: "Fecha",       name: "fecha",        filter: { type: "simple", placeholder: "Partida" },            sort: true, },
                { label: "Tipo",        name: "tipos.sigla",  filter: { type: "simple", placeholder: "Cofinanciador" },       sort: true, },
                { label: "Referencia",    name: "concepto",  filter: { type: "simple", placeholder: "Cofinanciador" },       sort: true, },
                { label: "Elaborado por", name: "monto_bs",        filter: { type: "simple", placeholder: "Monto en Bs" },  sort: true, },
                { label: "% Avance acumulado",name: "monto_Sus",       filter: { type: "simple", placeholder: "Monto en $us" },     sort: true, },                
                { label: "Acciones",    name: "acciones",       sort: false, },
            ],  

            datosEnviarConfiguracion:{}, 
            configFechas:{},
            configTablas:{},
            actions:[],
            classes:{},
            configToolBarEditText:[],
        }
    },
    methods:{
        async guardarAvanceIndicador(valores){
            var datos = {"id_informe_fisico": this.jsonData.id_informe_fisico, "extras": valores, 'move_indicator_type_id': this.jsonData.tipo_movimiento.id};            
            if(this.jsonData.id_informe_fisico == null){
                alert("Favor de registrar o seleccionar un informe físico");
            }else{                
                var respuesta = await axios.post('storeIndicadorSeguimientoEJ', datos);
                console.log(respuesta.data);
                this.cargarIndicadores();
            }
        },
        async modificarAvanceIndicador(valores){
            var datos = {"id_informe_fisico": this.jsonData.id_informe_fisico, "extras": valores, 'move_indicator_type_id': this.jsonData.tipo_movimiento.id};            
            var respuesta = await axios.post('updateIndicadorSeguimientoEJ', datos);
            console.log(respuesta.data);
            this.cargarIndicadores();
        },
        async eliminarAvanceIndicador(id){
            var respuesta = await axios.get('deleteIndicadorSeguimientoEJ/' + id);
            console.log(respuesta.data);
            this.cargarIndicadores();
        },
        async guardar_informe(){
            // console.log(this.jsonData);return;
            let datos_jsonData = new FormData();
            for(let key in this.jsonData){                
                datos_jsonData.append(key, this.jsonData[key]);
            }
            datos_jsonData.append('id_intervencion', this.jsonData.proyectos.id);
            datos_jsonData.append('move_indicator_type_id', this.jsonData.tipo_movimiento.id);
            datos_jsonData.append('document_type_id', this.jsonData.tipo_informe.id);
            
            // var fecha = new Date(this.jsonData.fecha);
            // datos_jsonData.append('fecha_text', fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());            
            var respuesta = await axios.post('seguimiento_fisicos', datos_jsonData);
            console.log(respuesta.data);
            this.jsonData.id_informe_fisico = respuesta.data.id;
            this.cargarListas();
        },
        async eliminar(valor){ 
            var respuesta = await axios.get('eliminar_desde_encabezado/' + valor.id);
            console.log(respuesta.data);
            this.cargarListas();
        },
        async editar(valor){  
            this.btnguardarInfome = false;
            this.btnadicionar = false;
            this.btnmodificar = false;
            this.btnmodificarInforme = true;
            this.btnimprimirInforme = false;
            this.btnimprimircomprobante = false;
            this.jsonData.id_informe_fisico = null;     
            console.log(valor);     
            this.jsonData.id_informe_fisico = valor.id;
            this.jsonData.tipo_movimiento = valor.tipo_movimiento;
            this.jsonData.tipo_informe = valor.tipo_documento;
            // this.jsonData.gestion_activa = valor.
            this.jsonData.glosa = valor.descripcion;
            // var respuesta = await axios.get('editar_seguimiento_fisico/' + valor.id);
            // console.log(respuesta.data);
            this.cargarIndicadores();
            $("#seguimiento_fisico_modal").modal("show");
        },
        ModalCrear(){    
            if(this.jsonData.gestion_activa.gestion != 'undefined' && this.jsonData.gestion_activa.gestion != null && this.jsonData.gestion_activa.gestion != undefined){
                this.btnguardarInfome = true;
                this.btnadicionar = false;
                this.btnmodificar = false;
                this.btnmodificarInforme = false;
                this.btnimprimirInforme = false;
                this.btnimprimircomprobante = false;
                this.cargarIndicadores();
                $("#seguimiento_fisico_modal").modal("show");
            }else{
                alert("Favor de seleccionar una gestión");
            }
        },
        async cargarIndicadores(){
            this.jsonData.gestion = this.jsonData.gestion_activa.gestion; 
            // console.log(this.jsonData);return;
            var respuesta = await axios.post('indicadores_seguimiento_fisico', this.jsonData);
            console.log(respuesta.data);
            this.rowsSeguimientoFisico = respuesta.data;
        },
        async cargarListas(){         
            this.jsonData.gestion = this.jsonData.gestion_activa.gestion;   
            // console.log(this.jsonData.gestion);
            // return;
            var respuesta = await axios.get('seguimiento_fisicos/' + this.jsonData.gestion);//de objetivos
            this.rows = respuesta.data;
            console.log(respuesta.data);
        },
        async gestiones_activa_poa(){
            var respuesta = await axios.post('gestiones_poa', this.jsonData);//de objetivos
            this.gestiones = respuesta.data;
        },
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
                    this.jsonData.monto_sus = valor;
                }else{//como guarda en dolar cargamos al de bs
                    var valor = "";
                    var valor = this.jsonData.monto_sus * respuesta.data.valor_venta;
                    valor = valor.toFixed(2);
                    this.jsonData.monto_bs = valor;
                    
                }
            }
        },
        async guardarEstructuraFinanciera(){     
            if( this.jsonData.comprobante_encabezado_id != 'undefined' && this.jsonData.comprobante_encabezado_id != null && this.jsonData.comprobante_encabezado_id != undefined ){
                // console.log("si");
                //guardar detalles osea las tablas
                var respuesta = await axios.post('comprobante_detalle_store', this.jsonData);
                // console.log(respuesta.data);
                this.listar_detalle();
                this.limpiarComprobanteDetalle();
                this.cargarListas()
                
                this.btnguardar = false;
                this.btnadicionar = true;
                this.btnmodificar = false;
                this.btnmodificarInforme = true;
                this.btnimprimirInforme = true;
                this.btnimprimircomprobante = true;
            }else{
                let datos_jsonData = new FormData();
                for(let key in this.jsonData){                
                    datos_jsonData.append(key, this.jsonData[key]);
                }
                datos_jsonData.append('id_intervencion', this.jsonData.proyectos.id);
                datos_jsonData.append('id_cofinanciador', this.jsonData.cofinanciador.id);
                datos_jsonData.append('id_componente', this.jsonData.componente.id);
                datos_jsonData.append('id_partida', this.jsonData.partida.id);   
                datos_jsonData.append('id_tipo_movimiento', this.jsonData.tipo_movimiento.id);
                
                var fecha = new Date(this.jsonData.fecha);
                datos_jsonData.append('fecha_text', fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());            
                var respuesta = await axios.post('comprobante_encabezado_store', datos_jsonData);
                // console.log(respuesta.data);
                if( respuesta.data.id != 'undefined' && respuesta.data.id != null && respuesta.data.id != undefined ){
                    this.jsonData.comprobante_encabezado_id = respuesta.data.id;
                    // console.log("si");
                    //guardar detalles osea las tablas
                    var respuesta = await axios.post('comprobante_detalle_store', this.jsonData);
                    this.listar_detalle();
                    this.limpiarComprobanteDetalle();
                    this.btnguardar = false;
                    this.btnadicionar = true;
                    this.btnmodificar = false;
                this.btnmodificarInforme = true;
                this.btnimprimirInforme = true;
                this.btnimprimircomprobante = true;
                }
            }
        },
        async modificar_comprobante_encabezado(){
            if( this.jsonData.comprobante_encabezado_id != 'undefined' && this.jsonData.comprobante_encabezado_id != null && this.jsonData.comprobante_encabezado_id != undefined ){
                let datos_jsonData = new FormData();
                for(let key in this.jsonData){                
                    datos_jsonData.append(key, this.jsonData[key]);
                }
                datos_jsonData.append('id_intervencion', this.jsonData.proyectos.id);
                datos_jsonData.append('id_cofinanciador', this.jsonData.cofinanciador.id);
                datos_jsonData.append('id_componente', this.jsonData.componente.id);
                datos_jsonData.append('id_partida', this.jsonData.partida.id);   
                datos_jsonData.append('id_tipo_movimiento', this.jsonData.tipo_movimiento.id);
                datos_jsonData.append('comprobante_encabezado_id', this.jsonData.comprobante_encabezado_id);
                
                var fecha = new Date(this.jsonData.fecha);
                datos_jsonData.append('fecha_text', fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate());            
                var respuesta = await axios.post('comprobante_encabezado_update', datos_jsonData);
                alert("cabecera modificada correctamente");
                this.cargarListas();
            }
        },
        async editarComprobanteDetalle(comprobante_detalle){            
            this.jsonData.comprobante_detalle_id = comprobante_detalle.id;
            this.jsonData.componente = comprobante_detalle.componentes;
            this.jsonData.partida = comprobante_detalle.partidas;
            this.jsonData.cofinanciador = comprobante_detalle.cofinanciadores;
            this.jsonData.monto_bs = comprobante_detalle.monto_bs;
            this.jsonData.monto_sus = comprobante_detalle.monto_Sus;

            // console.log(comprobante_detalle);
            this.btnguardar = false;
            this.btnadicionar = false;
            this.btnmodificar = true;
                this.btnmodificarInforme = true;
                this.btnimprimirInforme = true;
                this.btnimprimircomprobante = true;
        },
        async modificarComprobanteDetalle(){            
            var respuesta = await axios.post('comprobante_detalle_update', this.jsonData);
            // console.log(respuesta.data);
            this.listar_detalle();
            this.limpiarComprobanteDetalle();
            this.btnguardar = false;
            this.btnadicionar = true;
            this.btnmodificar = false;
                this.btnmodificarInforme = true;
                this.btnimprimirInforme = true;
                this.btnimprimircomprobante = true;
            this.cargarListas();
        },
        async eliminarComprobanteDetalle(id){
            var respuesta = await axios.delete('estructura_financiamientos/' + id);
            console.log(respuesta.data);
            this.listar_detalle();
            this.limpiarComprobanteDetalle();
            this.btnguardar = false;
            this.btnadicionar = true;
            this.btnmodificar = false;
                this.btnmodificarInforme = true;
                this.btnimprimirInforme = true;
                this.btnimprimircomprobante = true;
            this.cargarListas();
        },
        limpiarComprobanteDetalle(){            
            this.jsonData.componente = {};
            this.jsonData.partida = {};
            this.jsonData.cofinanciador = {};
            this.jsonData.monto_bs = "";
            this.jsonData.monto_sus = "";
        },
        async verificar_un_solo_proyecto(){
            var respuesta = await axios.get('proyectos_de_institucion');
            if(respuesta.data.cantidad > 1){
                this.jsonData.nombreInstitucion = respuesta.data.institucion.nombre;
                this.proyectos = respuesta.data.proyectos;
                $("#ubicacion_modal_seleccion_proyecto").modal("show");
            }else{
                if(respuesta.data.cantidad == 1){
                    this.jsonData.proyectos = respuesta.data.proyectos[0];
                    this.cargarElementosDeIntervencion();
                }else{
                    alert("usted no tiene proyectos");
                }
            }              
        },
        async verifica_encabezado(){
            var respuesta = await axios.get('estructura_financiamientos/' + this.jsonData.proyectos.id);
            // console.log(respuesta.data);
            if(respuesta.data.id != 'undefined' && respuesta.data.id != null && respuesta.data.id != undefined){                
                this.jsonData.comprobante_encabezado_id = respuesta.data.id;
                this.jsonData.fecha = respuesta.data.fecha;
                this.jsonData.gestion = respuesta.data.gestion;
                this.jsonData.concepto = respuesta.data.concepto;
                this.jsonData.glosa = respuesta.data.glosa;
                this.jsonData.pathDocumento = respuesta.data.pathDocumento;
                if(!(this.jsonData.pathDocumento=="")){
                    this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-success'], '#contenido_documento_res_aprobacion',[this.jsonData.pathDocumento]);
                }                
                this.listar_detalle();
                
                this.btnguardar = false;
                this.btnadicionar = true;
                this.btnmodificar = false;
                this.btnmodificarInforme = true;
                this.btnimprimirInforme = true;
                this.btnimprimircomprobante = true;
            }else{                
                this.btnguardar = true;
                this.btnadicionar = false;
                this.btnmodificar = false;
                this.btnmodificarInforme = false;
                this.btnimprimirInforme = false;
                this.btnimprimircomprobante = false;
            }
        },
        async listar_detalle(){
            var respuesta = await axios.get('ver_compobante_detalle/' + this.jsonData.comprobante_encabezado_id);
            this.rows = respuesta.data;
            console.log(this.rows);
        },
        cargarElementosDeIntervencion(){
            if(this.proyectos != []){
                // this.tipos_movimientos();
                this.componentes();
                this.partidas();
                this.cofinanciadores();
                // this.verifica_encabezado();         
                this.gestiones_activa_poa();
            }else{
                alert("Aun no selecciono ninguna intervención o proyecto");
            }
        },
        async tipoDocumento(){
            var respuesta = await axios.get('TiposDocumentos');
            // console.log(respuesta.data);
            this.tipo_documento = respuesta.data;
        },
        async tipos_movimientos(){
            var respuesta = await axios.get('tipos_movimientos');
            this.comboTipoMovimiento = respuesta.data;
        },
        async componentes(){
            var respuesta = await axios.get('componenteEF/' + this.jsonData.proyectos.id);
            this.comboComponentes = respuesta.data;
            // console.log(respuesta.data);
        },
        async partidas(){
            var respuesta = await axios.get('partida');
            this.comboPartidas = respuesta.data; 
            // console.log(this.comboPartidas);
        },
        async cofinanciadores(){
            var respuesta = await axios.get('cofinanciadorEF/' + this.jsonData.proyectos.id);
            this.comboCofinanciadores = respuesta.data; 
            // console.log(this.comboCofinanciadores);
        },
        /*********** funciones de configuracion**************/
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
            // console.log(contenido_cargar);
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
        this.funcionRecuperaConfig();
    },
    created(){       
        this.tipoDocumento(); 
        this.verificar_un_solo_proyecto();
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