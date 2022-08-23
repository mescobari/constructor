<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">REGISTRO DE REQUERIMIENTO DE OBRA</h3>
                <div class="card-tools">
                    <!--  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#doc_legales" @click="ModalCrear();">
                          Adicionar Planilla
                      </button>-->
                </div>
            </div>
            <br>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: center;">
                            <h5> {{ jsonData.proyectos.nombre }}</h5>
                        </div>
                    </div>
                </div>

                <hr>
                <div>
                    <!-- Tabs navs -->
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                               href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                               aria-selected="true"><h6> Requerimiento en Obra</h6></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false"><h6>Relacion con el Contrato Principal</h6></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                               href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                               aria-selected="false"><h6>Otros Gastos</h6></a>
                        </li>
                    </ul>
                </div>
                <!-- Tabs navs -->


                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <!-- ////////////  INICIO contenedor de tabs -->
                    <!-- REQxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                         aria-labelledby="custom-tabs-three-home-tab">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" @input="descripcionRecursoGetbyType">
                                            <label for="nombre">Tipo de Requerimiento:</label>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio1"
                                                       value="1" v-model="jsonData.tipo_requerimiento_id"/>
                                                <label for="customRadio1"
                                                       class="custom-control-label font-weight-normal">Mano de
                                                    obra</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio2"
                                                       value="2" v-model="jsonData.tipo_requerimiento_id"/>
                                                <label for="customRadio2"
                                                       class="custom-control-label font-weight-normal">Material</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio3"
                                                       value="3" v-model="jsonData.tipo_requerimiento_id"/>
                                                <label for="customRadio3"
                                                       class="custom-control-label font-weight-normal">Equipo</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio4"
                                                       value="4" v-model="jsonData.tipo_requerimiento_id"/>
                                                <label for="customRadio4"
                                                       class="custom-control-label font-weight-normal">Fondos en
                                                    Avance</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio5"
                                                       value="5" v-model="jsonData.tipo_requerimiento_id"/>
                                                <label for="customRadio5"
                                                       class="custom-control-label font-weight-normal">Llave en
                                                    Mano</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Correlativo Requerimiento:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre"
                                                   v-model="jsonData.correlativo_requerimiento" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_aprobacion">Fecha de Requerimiento:</label>
                                            <!-- <input type="date" class="form-control" name="fecha_aprobacion" v-model="jsonData.fecha_aprobacion"> -->
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
                                                :value="jsonData.fecha_requerimiento"
                                                v-model="jsonData.fecha_requerimiento"
                                            >
                                            </datepicker>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">NURI Correspondencia:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.nuri_requerimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
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
                                        <input type="file" class="form-control" id="documento_res_aprobacion"
                                               @change="cargar_file" style="display:none">
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">descripcion_requerimiento:</label>
                                    <vue-editor
                                        v-model="jsonData.descripcion_requerimiento"
                                        :editor-toolbar="configToolBarEditText"
                                    ></vue-editor>
                                    <!-- <input type="text" class="form-control" name="descripcion" placeholder="Ingresar descripcion" v-model="jsonData.descripcion"> -->
                                </div>
                            </div>

                        </div>


                        <!-- hasta aqui el row span> -->
                        <h4 class="text-danger font-weight-bold">AGREGAR RECURSO SOLICITADOS</h4>

                        <hr>

                        <!-- ============================== Formulario Lineal -------------------------------->

                        <div class="row bg-warning">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="codigo_recurso">Codigo:</label>
                                    <input type="text" class="form-control" name="codigo_recurso" placeholder="Codigo"
                                           v-model="jsonData.codigo_recurso" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- Recursos  Spinner-->
                                    <label for="document_type">Descripcion Recurso:</label>
                                    <v-select label="descripcion_recurso" :options="combo_requerimiento_recursos"
                                              v-model="jsonData.descripcion_recurso"
                                              placeholder="Selecione una opción"
                                              @input="retrieveFromCurrentDescripcionRecurso">
                                        <span slot="no-options">No hay data para cargar</span>
                                    </v-select>
                                </div>

                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Unidad</label>
                                    <input type="text" class="form-control" name="unidad_id" placeholder="Unidad"
                                           v-model="jsonData.simbolo" disabled>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Cantidad</label>
                                    <input type="text" class="form-control" name="cantidad" placeholder="Cantidad"
                                           v-model="jsonData.cantidad_recurso">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Horas Requeridas</label>
                                            <input type="text" class="form-control" name="horas"
                                                   placeholder="Horas Requeridas" v-model="jsonData.horas_recurso">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Dias Requeridos</label>
                                            <input type="text" class="form-control" name="dias"
                                                   placeholder="Dias Requeridos" v-model="jsonData.dias_recurso">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Plazo Ejecucion</label>
                                            <input type="text" class="form-control" name="plazo"
                                                   placeholder="dias de ejecucion"
                                                   v-model="jsonData.tiempo_total_recurso">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Precio referencial</label>
                                            <input type="text" class="form-control" name="referencial"
                                                   placeholder="precio referencial"
                                                   v-model="jsonData.precio_referencia_recurso">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" @click="guardar();"
                                                class="btn btn-success">
                                            Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- ======================/ termina form Formulario Lineal -->
                        <hr>

                        <!--  row para la tabla mostrar detalles del modelo y acciones //////////-->
                        <div class="row">

                            <div class="table-responsive">
                                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="configTablas"
                                                      :classes="configTablas.classes">
                                    <template slot="global-search-clear-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </template>
                                    <template slot="paginataion-previous-button">
                                        <span class="text-primary"><i class="fas fa-angle-double-left"></i></span>
                                        Anterior
                                    </template>
                                    <template slot="paginataion-next-button">
                                        Siguiente <span class="text-primary"><i
                                        class="fas fa-angle-double-right"></i></span>
                                    </template>
                                    <template slot="pagination-info" slot-scope="props">
                                        Mostrando: {{ props.currentPageRowsLength }} de: {{ props.filteredRowsLength }}
                                        |
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
                                                    @click="aprobarSolicitud(props.row)"><i
                                                class="fa fa-thumbs-o-down"></i></button>
                                        </div>
                                        <div v-else>
                                            <button class="btn btn-outline btn-primary dim" type="button"><i
                                                class="fa fa-thumbs-o-up"></i></button>
                                        </div>
                                    </template>
                                    <template slot="filePath" slot-scope="props">
                                        <a :href="props.row.filePathFull" target="_blank"
                                           title="Ver el archivo digital">
                                            <span
                                                class="badge badge-primary">Ver: {{
                                                    props.row.cofinanciador_documento.titulo
                                                }}</span>
                                        </a>
                                    </template>
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-warning ml-1"
                                                    @click="editar(props.row);"><span><i
                                                class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1"
                                                    @click="eliminar(props.row.id);"><span><i
                                                class="fa fa-trash-alt"></i></span></button>
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>

                        <!-- ////////////  FIN row de la tabla mostrar detalles del modelo y acciones -->

                    </div>    <!-- ////////////  FIN del primer tab -->

                    <!-- RELACIONxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                         aria-labelledby="custom-tabs-three-profile-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center class="text-danger font-weight-bold">
                                            <h3 v-if="jsonData.tipo_requerimiento_id === '1'">Mano de Obra</h3>
                                            <h3 v-else-if="jsonData.tipo_requerimiento_id === '2'">Material</h3>
                                            <h3 v-else-if="jsonData.tipo_requerimiento_id === '3'">Equipo</h3>
                                            <h3 v-else-if="jsonData.tipo_requerimiento_id === '4'">Fondos en Avance</h3>
                                            <h3 v-else> Contrato LLave en Mano</h3>
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Correlativo Requerimiento:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre"
                                                   v-model="jsonData.correlativo_requerimiento" disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha_aprobacion">Fecha de Requerimiento:</label>
                                            <!-- <input type="date" class="form-control" name="fecha_aprobacion" v-model="jsonData.fecha_aprobacion"> -->
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.fecha_requerimiento"
                                                   disabled>


                                        </div>
                                    </div>

                                </div>
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">NURI Correspondencia:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.nuri_requerimiento"
                                                   disabled>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="descripcion">Trabajpos a ser encarados, con este requerimiento:</label>
                                    <vue-editor
                                        v-model="jsonData.trabajos_encarados"
                                        :editor-toolbar="configToolBarEditText"
                                    ></vue-editor>
                                    <!-- <input type="text" class="form-control" name="descripcion" placeholder="Ingresar descripcion" v-model="jsonData.descripcion"> -->
                                </div>
                            </div>

                        </div>


                        <!-- hasta aqui el row span> -->
                        <h4 class="text-danger font-weight-bold">RELACION CON ITEMS CONTRATO PRINCIPAL</h4>
                        <hr>

                        <!-- INICIO fORMULARIO EN FILA relacion items contrato principal-->

                        <div class="row bg-success">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Codigo:</label>
                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo"
                                           v-model="jsonData.item_codigo" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- Recursos  Spinner-->
                                    <label for="document_type">Item Relacionado:</label>
                                    <v-select label="descripcion_recurso" :options="combo_requerimiento_recursos"
                                              v-model="jsonData.item_descripcion"

                                              placeholder="Selecione una opción">
                                        <span slot="no-options">No hay data para cargar</span>
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Unidad</label>
                                    <input type="text" class="form-control" name="unidad" placeholder="Unidad"
                                           v-model="jsonData.item_simbolo" disabled>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Vigente</label>
                                    <input type="text" class="form-control" name="cantidad" placeholder="Cantidad"
                                           v-model="jsonData.item_vigente">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Avance</label>
                                            <input type="text" class="form-control" name="horas"
                                                   placeholder="Horas Requeridas" v-model="jsonData.item_avance">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Saldo</label>
                                            <input type="text" class="form-control" name="dias"
                                                   placeholder="Dias Requeridos" v-model="jsonData.item_saldo">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Avance Estimado</label>
                                            <input type="text" class="form-control" name="plazo"
                                                   placeholder="dias de ejecucion" v-model="jsonData.item_estimado">
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" @click="guardar();" class="btn btn-danger">Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- ///FIN  fORMULARIO EN FILA relacion items -->


                        <!-- tabla de relacion de items-->
                        <div class="row">

                            <div class="table-responsive">
                                <vue-bootstrap4-table :rows="rows1" :columns="columns1" :config="configTablas"
                                                      :classes="configTablas.classes">
                                    <template slot="global-search-clear-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </template>
                                    <template slot="paginataion-previous-button">
                                        <span class="text-primary"><i class="fas fa-angle-double-left"></i></span>
                                        Anterior
                                    </template>
                                    <template slot="paginataion-next-button">
                                        Siguiente <span class="text-primary"><i
                                        class="fas fa-angle-double-right"></i></span>
                                    </template>
                                    <template slot="pagination-info" slot-scope="props">
                                        Mostrando: {{ props.currentPageRowsLength }} de: {{ props.filteredRowsLength }}
                                        |
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
                                                    @click="aprobarSolicitud(props.row)"><i
                                                class="fa fa-thumbs-o-down"></i></button>
                                        </div>
                                        <div v-else>
                                            <button class="btn btn-outline btn-primary dim" type="button"><i
                                                class="fa fa-thumbs-o-up"></i></button>
                                        </div>
                                    </template>
                                    <template slot="filePath" slot-scope="props">
                                        <a :href="props.row.filePathFull" target="_blank"
                                           title="Ver el archivo digital">
                                            <span
                                                class="badge badge-primary">Ver: {{
                                                    props.row.cofinanciador_documento.titulo
                                                }}</span>
                                        </a>
                                    </template>
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-warning ml-1"
                                                    @click="editar(props.row1);"><span><i
                                                class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1"
                                                    @click="eliminar(props.row1.id);"><span><i
                                                class="fa fa-trash-alt"></i></span></button>
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>


                        <!-- tabla de relacion de items-->


                    </div> <!-- ////////////  FIN del segundo tab -->


                    <!-- Otrosxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                         aria-labelledby="custom-tabs-three-messages-tab">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center class="text-danger font-weight-bold">
                                            <h3 v-if="jsonData.tipo_requerimiento_id === '1'">Mano de Obra</h3>
                                            <h3 v-else-if="jsonData.tipo_requerimiento_id === '2'">Material</h3>
                                            <h3 v-else-if="jsonData.tipo_requerimiento_id === '3'">Equipo</h3>
                                            <h3 v-else-if="jsonData.tipo_requerimiento_id === '4'">Fondos en Avance</h3>
                                            <h3 v-else> Contrato LLave en Mano</h3>
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Correlativo Requerimiento:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre"
                                                   v-model="jsonData.correlativo_requerimiento" disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fecha_aprobacion">Fecha de Requerimiento:</label>
                                            <!-- <input type="date" class="form-control" name="fecha_aprobacion" v-model="jsonData.fecha_aprobacion"> -->
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.fecha_requerimiento"
                                                   disabled>


                                        </div>
                                    </div>

                                </div>
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">NURI Correspondencia:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.nuri_requerimiento"
                                                   disabled>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="descripcion">Gastos generales u otros gastos, con este
                                        requerimiento:</label>
                                    <vue-editor
                                        v-model="jsonData.gastos_generales"
                                        :editor-toolbar="configToolBarEditText"
                                    ></vue-editor>
                                    <!-- <input type="text" class="form-control" name="descripcion" placeholder="Ingresar descripcion" v-model="jsonData.descripcion"> -->
                                </div>
                            </div>

                        </div>


                        <!-- hasta aqui el row span> -->
                        <h4 class="text-danger font-weight-bold">GASTOS GENERALES</h4>
                        <hr>

                        <!-- INICIO fORMULARIO EN FILA relacion otros gastos-->

                        <div class="row bg-success">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Codigo:</label>
                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo"
                                           v-model="jsonData.codigo_otros" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- Recursos  Spinner-->
                                    <label for="document_type">Gastos Generales:</label>
                                    <v-select label="descripcion_recurso" :options="combo_requerimiento_recursos"
                                              v-model="jsonData.descripcion_otros"
                                              placeholder="Selecione una opción">
                                        <span slot="no-options">No hay data para cargar</span>
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Unidad</label>
                                    <input type="text" class="form-control" name="unidad" placeholder="Unidad"
                                           v-model="jsonData.simbolo_otros" disabled>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Cantidad</label>
                                    <input type="text" class="form-control" name="cantidad" placeholder="Cantidad"
                                           v-model="jsonData.cantidad_otros">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Monto</label>
                                            <input type="text" class="form-control" name="horas"
                                                   placeholder="Horas Requeridas" v-model="jsonData.monto_otros">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="nombre">Detallar</label>
                                            <input type="text" class="form-control" name="dias"
                                                   placeholder="Dias Requeridos" v-model="jsonData.explicar_otros">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" @input="listarRequerimientoItem" @click="guardar();"
                                                class="btn btn-danger">Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- ///FIN  fORMULARIO EN FILA otros gastos -->

                        <!-- tabla de relacion con otros gastos-->
                        <div class="row">
                            <div class="table-responsive">
                                <vue-bootstrap4-table :rows="rows2" :columns="columns2" :config="configTablas"
                                                      :classes="configTablas.classes">
                                    <template slot="global-search-clear-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </template>
                                    <template slot="paginataion-previous-button">
                                        <span class="text-primary"><i class="fas fa-angle-double-left"></i></span>
                                        Anterior
                                    </template>
                                    <template slot="paginataion-next-button">
                                        Siguiente <span class="text-primary"><i
                                        class="fas fa-angle-double-right"></i></span>
                                    </template>
                                    <template slot="pagination-info" slot-scope="props">
                                        Mostrando: {{ props.currentPageRowsLength }} de: {{ props.filteredRowsLength }}
                                        |
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
                                                    @click="aprobarSolicitud(props.row)"><i
                                                class="fa fa-thumbs-o-down"></i></button>
                                        </div>
                                        <div v-else>
                                            <button class="btn btn-outline btn-primary dim" type="button"><i
                                                class="fa fa-thumbs-o-up"></i></button>
                                        </div>
                                    </template>
                                    <template slot="filePath" slot-scope="props">
                                        <a :href="props.row.filePathFull" target="_blank"
                                           title="Ver el archivo digital">
                                            <span
                                                class="badge badge-primary">Ver: {{
                                                    props.row.cofinanciador_documento.titulo
                                                }}</span>
                                        </a>
                                    </template>
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-warning ml-1"
                                                    @click="editar(props.rows2);"><span><i class="fa fa-user-edit"></i></span>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger ml-1"
                                                    @click="eliminar(props.row2.id);"><span><i
                                                class="fa fa-trash-alt"></i></span></button>
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>


                        <!-- tabla de relacion con otros gastos-->


                    </div>

                    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                </div>
                <!-- ////////////  FIN contenedor de tabs<div class="tab-content" id="custom-tabs-three-tabContent"> -->

            </div> <!-- ////////////  FIN card-body -->

            <!-- En el footer pondremos el tab veamos como funciona y to se mueve en el body -->
            <div class="card-footer">


            </div>
            <!-- ///// fin  footer  -->
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">
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
import {VueEditor} from "vue2-editor";

Vue.component("v-select", vSelect);

export default {
    watch: {
        behaviorReq() {
            if (this.memorySelected === this.jsonData.tipo_requerimiento_id) {
                this.requerimientoFirstFill = true;
            } else {
                this.memorySelected = this.jsonData.tipo_requerimiento_id
                this.requerimientoFirstFill = false;
            }
        }
    },
    methods: {
        async filterList(arrayItems) {
            const responseRecursos = (await axios.get('requerimientos')).data;

            let arrayItemsFiltered = [];
            for (let i = 0; i < arrayItems.length; i++) {
                if (arrayItems[i].requerimiento_id === this.jsonData.requerimiento_id) {
                    for (let j = 0; j < responseRecursos.length; j++) {
                        if (responseRecursos[j].id === arrayItems[i].requerimiento_recurso_id) {
                            arrayItemsFiltered.push({
                                ...arrayItems[i],
                                ...responseRecursos[j],
                                // ...responseRecursos[j].codigo_recurso,
                                // ...responseRecursos[j].descripcion_recurso
                            })
                            j = responseRecursos.length;
                        }

                    }
                }
            }
            console.log('LIST CURRENT', arrayItemsFiltered);
            return arrayItemsFiltered
        },

        async listarRequerimientoItem() {
            const response = await axios.get('get_requerimiento_items');
            const items = response.data.filter(item => item.requerimiento_id === this.jsonData.requerimiento_id);
            console.log('ITEM RECURSOS', response.data);
            this.rows = await this.filterList(response.data);
            // this.rows = items
        },
        async retrieveFromCurrentDescripcionRecurso() {

            const descripcion_recurso = await this.descripcionRecursoGetAll();
            for (let i = 0; i < descripcion_recurso.length; i++) {
                if (descripcion_recurso[i].id == this.jsonData.descripcion_recurso.id) {
                    this.jsonData.codigo_recurso = descripcion_recurso[i].codigo_recurso;
                    break;
                }
            }
            const responseUnidades = await axios.get('get_unidades');
            for (let i = 0; i < responseUnidades.data.length; i++) {
                if (responseUnidades.data[i].id == this.jsonData.descripcion_recurso.unidad_id) {
                    this.jsonData.simbolo = responseUnidades.data[i].simbolo;
                    break;
                }
            }
        },
        async descripcionRecursoGetAll() {
            let response = await axios.get('requerimientos')
            return response.data
        },
        async descripcionRecursoGetbyType() {
            let response = await axios.get('requerimientos')
            let reqArraybyId = []

            for (let i = 0; i < response.data.length; i++) {
                if (response.data[i].tipo_requerimiento_id == this.jsonData.tipo_requerimiento_id) {
                    reqArraybyId.push(response.data[i]);
                }
            }
            this.combo_requerimiento_recursos = reqArraybyId;
        },
        async tipoDocumentoGetAll() {
            let respuesta = await axios.get('documentos_legaleses');
            // this.combo_requerimiento_recursos = respuesta.data;
            console.log('DOCUMENTOS TIPO', respuesta.data);
        },
        async requerimientoFirstSave() {
            this.jsonData.document_id = this.jsonData.proyectos.id
            console.log('DOCUMENT ID', this.jsonData.document_id);
            let datos_jsonData = new FormData();
            datos_jsonData.append('document_id', this.jsonData.document_id);
            datos_jsonData.append('tipo_requerimiento_id', this.jsonData.tipo_requerimiento_id);
            datos_jsonData.append('correlativo_requerimiento', this.jsonData.correlativo_requerimiento);
            datos_jsonData.append('fecha_requerimiento', this.jsonData.fecha_requerimiento);
            datos_jsonData.append('nuri_requerimiento', this.jsonData.nuri_requerimiento);
            datos_jsonData.append('descripcion_requerimiento', this.jsonData.descripcion_requerimiento)
            datos_jsonData.append('trabajos_encarados', this.jsonData.trabajos_encarados);
            datos_jsonData.append('gastos_generales', this.jsonData.gastos_generales);
            datos_jsonData.append('files', this.jsonData.files);
            let response = await axios.post('create_requerimiento', datos_jsonData);
            console.log('CREATE REQ', response.data);
        },
        async reqItemSave() {
            const response_req = await axios.get('get_requerimientos');
            this.jsonData.requerimiento_id = response_req.data[response_req.data.length - 1].id;
            this.jsonData.requerimiento_recurso_id = this.jsonData.descripcion_recurso.id;

            let datos_jsonData = new FormData();
            datos_jsonData.append('requerimiento_id', this.jsonData.requerimiento_id);
            datos_jsonData.append('requerimiento_recurso_id', this.jsonData.requerimiento_recurso_id);
            datos_jsonData.append('cantidad_recurso', this.jsonData.cantidad_recurso);
            datos_jsonData.append('horas_recurso', this.jsonData.horas_recurso);
            datos_jsonData.append('dias_recurso', this.jsonData.dias_recurso);
            datos_jsonData.append('tiempo_total_recurso', this.jsonData.tiempo_total_recurso);
            datos_jsonData.append('precio_referencia_recurso', this.jsonData.precio_referencia_recurso);
            const response = await axios.post('requerimientos', datos_jsonData);
            console.log("SAVE ITEM REQ", response.data);
        },
        async guardar() {
            //requerimientoFirstFill
            console.log('MEMORYSELECTED', this.memorySelected);
            console.log('TIPO REQ', this.jsonData.tipo_requerimiento_id)
            console.log('=================================================')
            if (this.memorySelected === this.jsonData.tipo_requerimiento_id) {
                console.log('MEMORYSELECTED', this.memorySelected + ' ' + this.jsonData.tipo_requerimiento_id);
                await this.reqItemSave();
                console.log('TRUE WAY')
                console.log('=================================================')
            } else {
                this.memorySelected = this.jsonData.tipo_requerimiento_id;
                console.log('MEMORYSELECTED', this.memorySelected + ' ' + this.jsonData.tipo_requerimiento_id);
                await this.requerimientoFirstSave()
                await this.reqItemSave();
                console.log('FALSE WAY')
                console.log('=================================================')
            }
            await this.listarRequerimientoItem();
            // this.limpiar_formulario();
        },
        editar(data = {}) {
            console.log('XXXXXXXXXXXXXXXXX');
            console.log(data);
            $('#modifica1').removeAttr('checked');
            $('#modifica2').removeAttr('checked');
            $('#modifica3').removeAttr('checked');
            if (data.modifica !== 'undefined' && data.modifica != null) {
                var dato = "";
                for (var i = 0; i < data.modifica.length; i++) {
                    if (data.modifica[i] !== ',') {
                        dato = dato + data.modifica[i];
                    } else {
                        this.cargar_checks(dato);
                        dato = "";
                    }
                }
                this.cargar_checks(dato);
            }
            console.log('===============');
            console.log(data);//return;

            this.jsonData.id = data.id;
            // this.jsonData.proyectos={};
            this.jsonData.tipos_documento = data.tipo_documento;
            this.jsonData.institucion = data.institucion.institucion;
            this.jsonData.cofinanciador = data.institucion.organismo;
            this.jsonData.titulo = data.titulo;
            this.jsonData.doc_legal = data.padre;
            this.jsonData.objetivo = data.objetivo;
            this.jsonData.fecha_firma = data.fecha_firma;
            this.jsonData.fecha_inicio = data.fecha_inicio;
            this.jsonData.fecha_vencimiento = data.fecha_vencimiento;
            this.jsonData.funcionario = data.firma;
            this.jsonData.objeto = data.objeto;
            this.jsonData.monto_bs = data.monto_bs;
            this.jsonData.monto_Sus = data.monto_Sus;
            this.jsonData.duracion_dias = data.duracion_dias;

            this.modificar_bottom = true;
            this.guardar_bottom = false;
            this.tituloDocLegalesModal = "Formulario de Modificaciones de Planillas";
            // this.jsonData = data;
            $('#doc_legales').modal('show');
        },
        async modificar() {
            var modifica = "";
            if ($('#modifica1').prop('checked')) {
                modifica = "1";
            }
            if ($('#modifica2').prop('checked')) {
                if (modifica != "") {
                    modifica = modifica + ",";
                }
                modifica = modifica + "2";
            }
            if ($('#modifica3').prop('checked')) {
                if (modifica != "") {
                    modifica = modifica + ",";
                }
                modifica = modifica + "3";
            }
            var id_padre = 0;
            if (this.jsonData.doc_legal != 'undefined' && this.jsonData.doc_legal != null && this.jsonData.doc_legal != undefined) {
                if (this.jsonData.doc_legal.id != 'undefined' && this.jsonData.doc_legal.id != null && this.jsonData.doc_legal.id != undefined) {
                    id_padre = this.jsonData.doc_legal.id;
                }
            }
            let datos_jsonData = new FormData();
            for (let key in this.jsonData) {
                datos_jsonData.append(key, this.jsonData[key]);
            }
            datos_jsonData.append('id_doc_legal', this.jsonData.id);
            datos_jsonData.append('id_proyecto', this.jsonData.proyectos.id);
            datos_jsonData.append('id_intitucion', this.jsonData.institucion.id);
            datos_jsonData.append('id_tipo_documento', this.jsonData.tipos_documento.id);
            datos_jsonData.append('id_organismo', this.jsonData.cofinanciador.id);//organismo financiador
            datos_jsonData.append('id_objetivo', this.jsonData.objetivo.id);
            datos_jsonData.append('id_padre', id_padre);
            datos_jsonData.append('modifica', modifica);
            // datos_jsonData.append('fecha_firma_1', JSON.stringify(this.jsonData.fecha_firma));
            var fecha_firma = new Date(this.jsonData.fecha_firma);
            var fecha_inicio = new Date(this.jsonData.fecha_inicio);
            var fecha_vencimiento = new Date(this.jsonData.fecha_vencimiento);
            var dia1 = fecha_firma.getDate() + "";
            var dia1 = fecha_inicio.getDate() + "";
            var dia2 = fecha_vencimiento.getDate() + "";
            if (dia1.length == 1) {
                dia1 = "0" + fecha_firma.getDate();
            } else {
                dia1 = "" + fecha_firma.getDate();
            }
            if (dia1.length == 1) {
                dia1 = "0" + fecha_inicio.getDate();
            } else {
                dia1 = "" + fecha_inicio.getDate();
            }
            if (dia2.length == 1) {
                dia2 = "0" + fecha_vencimiento.getDate();
            } else {
                dia2 = "" + fecha_vencimiento.getDate();
            }

            datos_jsonData.append('id_fecha_firma', fecha_firma.getFullYear() + "-" + (fecha_firma.getMonth() + 1) + "-" + dia1);
            datos_jsonData.append('id_fecha_inicio', fecha_inicio.getFullYear() + "-" + (fecha_inicio.getMonth() + 1) + "-" + dia1);
            datos_jsonData.append('id_fecha_vencimiento', fecha_vencimiento.getFullYear() + "-" + (fecha_vencimiento.getMonth() + 1) + "-" + dia2);

            var respuesta = await axios.post('documentos_legaleses_mod', datos_jsonData);
            console.log(respuesta.data);
            this.buscar_doc_legales();
            this.limpiar_formulario();
            document.getElementById("cerrarModal").click();
        },
        async eliminar() {

        },
        async seleccionar_cont_primario() {
            const respuesta = await axios.get('documents');
            const principales = respuesta.data.filter((item) => item.document_types_id === 1)
            console.log('Documentos Principales', principales);
            this.proyectos = principales;
            $("#seleccion_proyecto_doc_legales").modal("show");

        },

        async ver_planilla() {
            const vp = this.jsonData.proyectos.id;
            console.log('vplan--> ' + vp);
            var respuesta = await axios.get('planillas/' + vp);
            console.log('voviendo del backend');
            console.log(respuesta.data);

            const planillas = respuesta.data.map(planilla => {
                if (planilla.tipo_planilla_id === 1) {
                    planilla.tipo = 'Inicial (#' + planilla.numero_planilla + ')';
                } else if (planilla.tipo_planilla_id === 2) {
                    planilla.tipo = 'Modificacion (#' + planilla.numero_planilla + ')';
                } else {
                    planilla.tipo = 'Avance (#' + planilla.numero_planilla + ')';
                }

                planilla.fecha_planilla = planilla.fecha_planilla.split('-').reverse().join('-');

                //documento.tipo_documento = contratosObjeto[documento.document_types_id];
                //documento.tipo_documento = contratos.find(contrato => contrato.id === documento.document_types_id).nombre
                return planilla;
            });

            this.rows = planillas;
        },


        async buscar_doc_legales() {
            var data = {
                'intervencion': this.jsonData.proyectos,
            }
            console.log(data);
            var respuesta = await axios.post('buscar_documentos_legaleses', data);
            // console.log("cofinanciadores");
            console.log(respuesta.data);
            this.rows = respuesta.data;
            this.tipos_documentos();
            this.instituciones();
            this.organismos_financiadores();
            this.doc_legales();
            this.objetivos();
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
        limpiar_formulario() {
            $('#modifica1').removeAttr('checked');
            $('#modifica2').removeAttr('checked');
            $('#modifica3').removeAttr('checked');

            this.jsonData.id = "";

            this.jsonData.tipos_documento = {};
            this.jsonData.institucion = {};
            this.jsonData.cofinanciador = {};
            this.jsonData.titulo = '';
            this.jsonData.doc_legal = {};
            this.jsonData.objetivo = {};
            this.jsonData.fecha_firma = '';
            this.jsonData.fecha_inicio = '';
            this.jsonData.fecha_vencimiento = '';
            this.jsonData.funcionario = '';
            this.jsonData.objeto = '';
            this.jsonData.monto_bs = '';
            this.jsonData.monto_Sus = '';
            this.jsonData.duracion_dias = '';
            this.jsonData.objeto = '';

            this.btnmodificar = false;
            this.btncancelar = false;
            this.btnguardar = true;
            this.configFile.contenidoDefault = " CARGAR INFORME TECNICO/JUSTIFICACION";
            this.borrar_file();
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
    data() {
        return {
            modificar_bottom: false,
            guardar_bottom: false,
            clickedAdd: false,
            tituloDocLegalesModal: '',
            requerimientoFirstFill: true,
            combo_requerimiento_recursos: [],
            combo_items_planilla: [],
            memorySelected: '',
            proyectos: [],
            jsonData: {
                id: "",
                correlativo_requerimiento: '/2022',
                fecha_requerimiento: '2022/01/01',
                nuri_requerimiento: '/2022',
                requerimiento_id: '',
                tipo_requerimiento_id: 5,
                itemsWithRecursos: [],
                position: 0,
                codigo_recurso: '',
                proyectos: '',
                tipos_documento: {},
                institucion: {},
                cofinanciador: {},
                titulo: '',
                doc_legal: {},
                objetivo: {},
                document_id: '',
                descripcion_requerimiento: '<p>prueba <b>planolla inicial si</b> carga file</p>',
                requerimiento_recurso_id: '',
                descripcion_recurso: '',
                unidad_id: '',
                simbolo: '',
                cantidad_recurso: '',
                horas_recurso: '',
                dias_recurso: '',
                tiempo_total_recurso: '',
                precio_referencia_recurso: '',
                trabajos_encarados: 'trabajos a ser encarados explicacion de ello',
                files: null,
                item_codigo: 'zzzz',
                item_descripcion: '',
                item_simbolo: 'abc',
                item_vigente: '1',
                item_avance: '2',
                item_saldo: '3',
                item_estimado: '4',
                gastos_generales: 'se explica en que gatsos generales se trabajara',
                codigo_otros: 'yyyyyyy',
                descripcion_otros: '',
                simbolo_otros: 'abcde',
                cantidad_otros: '10',
                monto_otros: '20',
                explicar_otros: '30',

            },
            rows: [],
            columns: [
                {
                    label: "Codigo",
                    name: "codigo_recurso",
                    filter: {type: "simple", placeholder: "Codigo",}, sort: true,
                },
                {
                    label: "Descripcion Recurso:",
                    name: "descripcion_recurso",
                    filter: {type: "simple", placeholder: "descripcion_recurso",},
                    sort: true,
                },
                {
                    label: "Unidad",
                    name: "unidad_id",
                    filter: {type: "simple", placeholder: "Simbolo"},
                    sort: true,
                },
                {
                    label: "Cantidad",
                    name: "cantidad_recurso",
                    filter: {type: "simple", placeholder: "Cantidad"},
                },
                {
                    label: "Horas Requeridas",
                    name: "horas_recurso",
                    filter: {type: "simple", placeholder: "Horas Requeridas"},
                },
                {
                    label: "Dias Requeridos",
                    name: "dias_recurso",
                    filter: {type: "simple", placeholder: "Dias Requeridos"},
                },
                {
                    label: "Plazo Ejecucion",
                    name: "tiempo_total_recurso",
                    filter: {type: "simple", placeholder: "Plazo Ejecucion"},
                    sort: true,
                },
                {
                    label: "Precio referencial",
                    name: "precio_referencia_recurso",
                    filter: {type: "simple", placeholder: "Precio referencial"},
                    sort: true,
                },

                {
                    label: "Acciones",
                    name: "acciones",
                    sort: false,
                },
            ],

            rows1: [],
            columns1: [
                {
                    label: "Codigo",
                    name: "item_codigo",
                    filter: {type: "simple", placeholder: "Codigo",}, sort: true,
                },
                {
                    label: "Item Relacionado:",
                    name: "item_descripcion",
                    filter: {type: "simple", placeholder: "Item Relacionado",},
                    sort: true,
                },
                {
                    label: "Unidad",
                    name: "item_simbolo",
                    filter: {type: "simple", placeholder: "Unidad"},
                    sort: true,
                },
                {
                    label: "Cantidad Vigente",
                    name: "item_vigente",
                    filter: {type: "simple", placeholder: "Cantidad Vigente"},
                },
                {
                    label: "Avance",
                    name: "item_avance",
                    filter: {type: "simple", placeholder: "Avance"},
                },
                {
                    label: "Por Ejecutar",
                    name: "item_saldo",
                    filter: {type: "simple", placeholder: "Por Ejecutar"},
                },
                {
                    label: "Avance Estimado",
                    name: "item_estimado",
                    filter: {type: "simple", placeholder: "Avance Estimado"},
                },


                {
                    label: "Acciones",
                    name: "acciones",
                    sort: false,
                },


            ],

            rows2: [],
            columns2: [
                {
                    label: "Codigo",
                    name: "codigo_otros",
                    filter: {type: "simple", placeholder: "Codigo",}, sort: true,
                },
                {
                    label: "Gastos Generales:",
                    name: "descripcion_otros",
                    filter: {type: "simple", placeholder: "Gastos Generales",},
                    sort: true,
                },
                {
                    label: "Unidad",
                    name: "simbolo_otros",
                    filter: {type: "simple", placeholder: "Unidad"},
                    sort: true,
                },
                {
                    label: "Cantidad",
                    name: "cantidad_otros",
                    filter: {type: "simple", placeholder: "Cantidad"},
                },
                {
                    label: "Monto",
                    name: "monto_otros",
                    filter: {type: "simple", placeholder: "Monto"},
                },
                {
                    label: "Uso",
                    name: "explicar_otros",
                    filter: {type: "simple", placeholder: "Uso"},
                },
                {
                    label: "Acciones",
                    name: "acciones",
                    sort: false,
                },


            ],

            configFile: {
                cerrar: false,
                contenidoDefault: " CARGAR INFORME TECNICO/JUSTIFICACION",
            },
            datosEnviarConfiguracion: {},
            configFechas: {},
            configTablas: {},
            actions: [],
            classes: {},
            configToolBarEditText: [],
        }
    },
    mounted() {
        this.funcionRecuperaConfig();
        this.seleccionar_cont_primario();
    },
    created() {
        this.descripcionRecursoGetAll();
        this.descripcionRecursoGetbyType();
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
