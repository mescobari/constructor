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
                               aria-selected="true" v-on:click="detectActiveTab('home')"><h6> Requerimiento en Obra</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                               href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                               aria-selected="false" v-if="clickedAdd" v-on:click="detectActiveTab('profile')"><h6>
                                Relacion con el Contrato Principal</h6></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                               href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                               aria-selected="false" v-if="clickedAdd" v-on:click="detectActiveTab('messages')"><h6>
                                Otros Gastos</h6></a>
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
                                                       value="1" v-model="jsonData.tipo_requerimiento_id"
                                                       v-bind:disabled="clickedAdd"/>
                                                <label for="customRadio1"
                                                       class="custom-control-label font-weight-normal">Mano de
                                                    obra</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio2"
                                                       value="2" v-model="jsonData.tipo_requerimiento_id"
                                                       v-bind:disabled="clickedAdd"/>
                                                <label for="customRadio2"
                                                       class="custom-control-label font-weight-normal">Material</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio3"
                                                       value="3" v-model="jsonData.tipo_requerimiento_id"
                                                       v-bind:disabled="clickedAdd"/>
                                                <label for="customRadio3"
                                                       class="custom-control-label font-weight-normal">Equipo</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio4"
                                                       value="4" v-model="jsonData.tipo_requerimiento_id"
                                                       v-bind:disabled="clickedAdd"/>
                                                <label for="customRadio4"
                                                       class="custom-control-label font-weight-normal">Fondos en
                                                    Avance</label>
                                                <div>
                                                    <input class="form-check-input" type="checkbox"
                                                           v-model="wasChecked"
                                                           id="flexCheckDefault"
                                                           v-bind:disabled="todos">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        TODO
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">NURI Correspondencia:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.nuri_requerimiento"
                                                   v-bind:disabled="clickedAdd">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_aprobacion">Fecha de Requerimiento:</label>
                                            <datepicker
                                                :language="configFechas.es"
                                                :placeholder="configFechas.placeholder"


                                                :calendar-class="configFechas.nombreClaseParaModal"
                                                :input-class="configFechas.nombreClaseParaInput"
                                                :monday-first="true"
                                                :clear-button="!clickedAdd"
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
                                                v-bind:disabled="clickedAdd"
                                            >
                                            </datepicker>
                                        </div>
                                    </div>
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
                                               @change="cargar_file" style="display:none" v-bind:disabled="clickedAdd">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion Requerimiento:</label>
                                    <vue-editor
                                        placeholder="Ingresar Descripcion en detalle del Requerimiento"
                                        v-model="jsonData.descripcion_requerimiento"
                                        :editor-toolbar="configToolBarEditText"
                                        v-bind:disabled="clickedAdd"
                                    ></vue-editor>
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
                                                    data-toggle="modal" data-target="#modal-editar-item"
                                                    @click="editar(props.row);"
                                            ><span><i
                                                class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1"
                                                    @click="preguntarModalAlertaConfirmacionEliminar(props.row.id);"><span><i
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
                                            <label for="fecha_aprobacion">Fecha de Requerimiento:</label>
                                            <!-- <input type="date" class="form-control" name="fecha_aprobacion" v-model="jsonData.fecha_aprobacion"> -->
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.fechaFormatted"
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
                                    <label for="descripcion">Trabajos a ser encarados, con este requerimiento:</label>
                                    <vue-editor
                                        v-model="jsonData.trabajos_encarados"
                                        :editor-toolbar="configToolBarEditText"
                                        placeholder="Explicacion de los trabajos a ser encarados"
                                    ></vue-editor>
                                </div>
                            </div>

                        </div>


                        <!-- hasta aqui el row span> -->
                        <h4 class="text-danger font-weight-bold">RELACION CON ITEMS CONTRATO PRINCIPAL</h4>
                        <hr>

                        <!-- INICIO fORMULARIO EN FILA relacion items contrato principal-->

                        <div class="row bg-warning">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="codigo">Codigo:</label>
                                    <input type="text" class="form-control" name="codigo" placeholder="Codigo"
                                           v-model="jsonData.item_codigo" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- Recursos  Spinner-->
                                    <label for="document_type">Item Relacionado:</label>
                                    <v-select label="item_descripcion" :options="combo_items_planilla"
                                              v-model="jsonData.item_descripcion"
                                              placeholder="Selecione una opción"
                                              @input="getNameForItemRelacion">
                                        <span slot="no-options">No hay data para cargar</span>
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Unidad:</label>
                                    <input type="text" class="form-control" name="unidad" placeholder="Unidad"
                                           v-model="jsonData.item_simbolo" disabled>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Vigente</label>
                                    <input type="text" class="form-control" name="cantidad"
                                           placeholder="Cantidad"
                                           disabled
                                           v-model="jsonData.item_vigente">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Avance</label>
                                            <input type="text" class="form-control" name="horas"
                                                   placeholder="Horas Requeridas"
                                                   disabled
                                                   v-model="jsonData.item_avance">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Saldo</label>
                                            <input type="text" class="form-control" name="dias"
                                                   placeholder="Dias Requeridos"
                                                   disabled
                                                   v-model="jsonData.item_saldo">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Avance Estimado</label>
                                            <input type="text" class="form-control" name="plazo"
                                                   placeholder="dias de ejecucion" v-model="jsonData.item_estimado">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Precio Unitario</label>
                                            <input type="text" class="form-control" name="plazo"
                                                   placeholder="dias de ejecucion"
                                                   v-model="jsonData.item_precio_unitario">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" @click="guardarItemRelacion();" class="btn btn-danger">
                                            Agregar
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
                                                    @click="editarItemRelacion(props.row);"
                                                    data-toggle="modal"
                                                    data-target="#modal-editar-relacion"><span><i
                                                class="fa fa-user-edit"></i></span>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger ml-1"
                                                    @click="preguntarModalAlertaConfirmacionEliminar(props.row.id);"><span><i
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
                                            <label for="fecha_aprobacion">Fecha de Requerimiento:</label>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="Ingresar Nombre" v-model="jsonData.fechaFormatted"
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
                                        placeholder="Explicar en que gastos generales se trabajará"
                                    ></vue-editor>
                                    <!-- <input type="text" class="form-control" name="descripcion" placeholder="Ingresar descripcion" v-model="jsonData.descripcion"> -->
                                </div>
                            </div>

                        </div>


                        <!-- hasta aqui el row span> -->
                        <h4 class="text-danger font-weight-bold">GASTOS GENERALES</h4>
                        <hr>

                        <!-- INICIO fORMULARIO EN FILA relacion otros gastos-->

                        <div class="row bg-warning">
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
                                    <label for="nombre">Gastos Generales:</label>
                                    <v-select label="descripcion_recurso" :options="combo_otros_gastos"
                                              v-model="jsonData.descripcion_otros"
                                              @input="filterNameForOtrosGastos"
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
                                                   placeholder="Monto Requerido" v-model="jsonData.monto_otros">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="nombre">Detallar</label>
                                            <input type="text" class="form-control" name="dias"
                                                   placeholder="Detalle" v-model="jsonData.explicar_otros">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" @click="guardarItemOtrosGastos();"
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
                                                    data-toggle="modal"
                                                    data-target="#modal-editar-otros"
                                                    @click="editarItemOtrosGastos(props.row);"><span><i
                                                class="fa fa-user-edit"></i></span>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger ml-1"
                                                    @click="preguntarModalAlertaConfirmacionEliminar(props.row.id);"><span><i
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
                                        <v-select label="nombre" :options="proyectos"
                                                  v-model="jsonData.proyectos"
                                                  @input="getAllItemRelacion"
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
        <!--================================ MODAL MODIFICAR ITEM REQUERIMIENTO =============================================-->
        <div class="modal fade" id="modal-editar-item" tabindex="-1" role="dialog"
             style="overflow-y: scroll;" aria-labelledby="modal-editar-itemTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="seleccion_proyecto_doc_legalesTitle">Modificar Requerimiento
                            Item</h5>
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
                                           v-model="jsonData.modal_codigo" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- Recursos  Spinner-->
                                    <label for="document_type">Descripcion Recurso:</label>
                                    <v-select label="descripcion_recurso" :options="combo_requerimiento_recursos"
                                              v-model="jsonData.modal_descripcion"
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
                                           v-model="jsonData.modal_unidad" disabled>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nombre">Cantidad</label>
                                    <input type="text" class="form-control" name="cantidad" placeholder="Cantidad"
                                           v-model="jsonData.modal_cantidad">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Horas Requeridas</label>
                                            <input type="text" class="form-control" name="horas"
                                                   placeholder="Horas Requeridas"
                                                   v-model="jsonData.modal_horas_requeridas">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Dias Requeridos</label>
                                            <input type="text" class="form-control" name="dias"
                                                   placeholder="Dias Requeridos"
                                                   v-model="jsonData.modal_dias_requeridos">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Plazo Ejecucion</label>
                                            <input type="text" class="form-control" name="plazo"
                                                   placeholder="dias de ejecucion"
                                                   v-model="jsonData.modal_plazo">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Precio referencial</label>
                                            <input type="text" class="form-control" name="referencial"
                                                   placeholder="precio referencial"
                                                   v-model="jsonData.modal_precio_referencia">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal" @click="modificar">
                            Modificar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--================================ FIN MODAL MODIFICAR ITEM REQUERIMIENTO =========================================-->
        <!--=================================== MODAL MODIFICAR ITEM RELACION ===============================================-->
        <div class="modal fade" id="modal-editar-relacion" tabindex="-1" role="dialog"
             style="overflow-y: scroll;" aria-labelledby="modal-editar-itemTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="seleccion_proyecto_doc_legalesTitle">Modificar Item Relacion con
                            Contrato Principal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row bg-warning">
                            <div class="row bg-warning">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="codigo">Codigo:</label>
                                        <input type="text" class="form-control" name="codigo" placeholder="Codigo"
                                               v-model="jsonData.modal2_codigo" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- Recursos  Spinner-->
                                        <label for="document_type">Item Relacionado:</label>
                                        <v-select label="item_descripcion" :options="combo_items_planilla"
                                                  v-model="jsonData.modal2_descripcion"
                                                  placeholder="Selecione una opción"
                                                  @input="getNameForItemRelacion">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nombre">Unidad:</label>
                                        <input type="text" class="form-control" name="unidad" placeholder="Unidad"
                                               v-model="jsonData.modal2_unidad" disabled>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nombre">Vigente</label>
                                        <input type="text" class="form-control" name="cantidad"
                                               placeholder="Cantidad"
                                               disabled
                                               v-model="jsonData.modal2_vigente">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombre">Avance</label>
                                                <input type="text" class="form-control" name="horas"
                                                       placeholder="Horas Requeridas"
                                                       disabled
                                                       v-model="jsonData.modal2_avance">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombre">Saldo</label>
                                                <input type="text" class="form-control" name="dias"
                                                       placeholder="Dias Requeridos"
                                                       disabled
                                                       v-model="jsonData.modal2_saldo">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombre">Avance Estimado</label>
                                                <input type="text" class="form-control" name="plazo"
                                                       placeholder="dias de ejecucion"
                                                       v-model="jsonData.modal2_estimado">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombre">Precio Unitario</label>
                                                <input type="text" class="form-control" name="plazo"
                                                       placeholder="dias de ejecucion"
                                                       v-model="jsonData.modal2_precio_unitario">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal"
                                @click="modificarItemRelacion">
                            Modificar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--=============================== FIN MODAL MODIFICAR ITEM RELACION ========================================-->
        <!--=================================== MODAL MODIFICAR ITEM OTROS ===============================================-->
        <div class="modal fade" id="modal-editar-otros" tabindex="-1" role="dialog"
             style="overflow-y: scroll;" aria-labelledby="modal-editar-itemTitle" aria-hidden="true">
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
                        <div class="row bg-warning">
                            <div class="row bg-warning">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nombre">Codigo:</label>
                                        <input type="text" class="form-control" name="codigo"
                                               placeholder="Codigo"
                                               v-model="jsonData.modal3_codigo"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- Recursos  Spinner-->
                                        <label for="nombre">Gastos Generales:</label>
                                        <v-select label="descripcion_recurso" :options="combo_otros_gastos"
                                                  v-model="jsonData.modal3_descripcion"
                                                  @input="filterNameForOtrosGastos"
                                                  placeholder="Selecione una opción">
                                            <span slot="no-options">No hay data para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nombre">Unidad</label>
                                        <input type="text" class="form-control" name="unidad" placeholder="Unidad"
                                               v-model="jsonData.modal3_unidad" disabled>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nombre">Cantidad</label>
                                        <input type="text" class="form-control" name="cantidad" placeholder="Cantidad"
                                               v-model="jsonData.modal3_cantidad">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombre">Monto</label>
                                                <input type="text" class="form-control" name="horas"
                                                       placeholder="Monto Requerido" v-model="jsonData.modal3_monto">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="nombre">Detallar</label>
                                                <input type="text" class="form-control" name="dias"
                                                       placeholder="Detalle" v-model="jsonData.modal3_detallar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-success" data-dismiss="modal"
                                @click="modificarItemOtrosGastos">
                            Modificar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--=============================== FIN MODAL MODIFICAR ITEM OTROS ========================================-->
        <alert-confirmacion :mensajesAlerta="mandarMensajesAlerta" @escucharAlerta="respuestaModalAlertaConfirmacion"
                            ref="abrirAlerta">
        </alert-confirmacion>

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
            const getUnidades = (await axios.get('get_unidades')).data;
            let arrayItemsFiltered = [];
            for (let i = 0; i < arrayItems.length; i++) {
                if (arrayItems[i].requerimiento_id === this.jsonData.requerimiento_id) {
                    for (let j = 0; j < responseRecursos.length; j++) {
                        if (responseRecursos[j].id === arrayItems[i].requerimiento_recurso_id) {
                            arrayItemsFiltered.push({
                                ...responseRecursos[j],
                                ...arrayItems[i], //here is the id object
                            })
                            j = responseRecursos.length;
                        }
                    }
                }
            }
            arrayItemsFiltered.map(item => {
                item.unidad_id = getUnidades[item.unidad_id - 1].simbolo
            });
            console.log('LIST CURRENT', arrayItemsFiltered);
            return arrayItemsFiltered
        },
        async listarRequerimientoItem() {
            const response = await axios.get('get_requerimiento_items');
            const items = response.data.filter(item => item.requerimiento_id === this.jsonData.requerimiento_id);
            console.log('ITEM RECURSOS', response.data);

            this.rows = await this.filterList(response.data);
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

            reqArraybyId = response.data.filter(item => item.tipo_requerimiento_id == this.jsonData.tipo_requerimiento_id)

            if (this.jsonData.tipo_requerimiento_id == 4) this.todos = false;
            else {
                this.todos = true;
                this.wasChecked = false;
            }

            if (this.wasChecked) reqArraybyId = response.data

            console.log('WAS CHECKED', this.wasChecked);
            console.log('tipo requerimiento', this.jsonData.tipo_requerimiento_id)
            this.combo_requerimiento_recursos = reqArraybyId;
            // }
            // for (let i = 0; i < response.data.length; i++) {
            //     if (response.data[i].tipo_requerimiento_id == this.jsonData.tipo_requerimiento_id && this.jsonData.tipo_requerimiento_id != 4) {
            //         reqArraybyId.push(response.data[i]);
            //     }
            // }

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
            datos_jsonData.append('correlativo_requerimiento', this.jsonData.nuri_requerimiento/*this.jsonData.correlativo_requerimiento*/);
            let fecha_requerimiento = new Date(this.jsonData.fecha_requerimiento);
            this.jsonData.fechaFormatted = (fecha_requerimiento.getDate() + "/" + (fecha_requerimiento.getMonth() + 1) + "/" + fecha_requerimiento.getFullYear());
            datos_jsonData.append('fecha_requerimiento', (fecha_requerimiento.getFullYear() + "-" + (fecha_requerimiento.getMonth() + 1) + "-" + fecha_requerimiento.getDate()));
            datos_jsonData.append('nuri_requerimiento', this.jsonData.nuri_requerimiento);
            datos_jsonData.append('descripcion_requerimiento', this.jsonData.descripcion_requerimiento)
            datos_jsonData.append('trabajos_encarados', 'Trabajos Encarados');
            datos_jsonData.append('gastos_generales', 'Gastos Generales');
            datos_jsonData.append('files', this.jsonData.files);
            this.clickedAdd = true;
            this.configFile.cerrar = false;
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
        areAlltheFieldsFilled() {
            return this.jsonData.descripcion_recurso.id != null &&
                this.jsonData.cantidad_recurso != null &&
                this.jsonData.horas_recurso != null &&
                this.jsonData.dias_recurso != null &&
                this.jsonData.tiempo_total_recurso != null &&
                this.jsonData.precio_referencia_recurso != null &&
                this.jsonData.nuri_requerimiento != null &&
                this.jsonData.descripcion_requerimiento !== '' &&
                this.jsonData.tipo_requerimiento_id != null &&
                this.jsonData.fecha_requerimiento != null &&
                this.jsonData.fecha_requerimiento !== "" &&
                this.jsonData.files != null;
        },
        //Guardar Requerimiento en Obra
        async guardar() {
            if (this.areAlltheFieldsFilled()) {
                console.log('=================================================')
                if (this.memorySelected === this.jsonData.tipo_requerimiento_id) {
                    console.log('MEMORYSELECTED', this.memorySelected);
                    await this.reqItemSave();
                    console.log('TRUE WAY')
                    console.log('=================================================')
                } else {
                    this.memorySelected = this.jsonData.tipo_requerimiento_id;
                    console.log('MEMORYSELECTED', this.memorySelected);
                    await this.requerimientoFirstSave()
                    await this.reqItemSave();
                    console.log('FALSE WAY')
                    console.log('=================================================')
                }
                await this.listarRequerimientoItem();
                await this.cleanFormReqItem();
            } else {
                alert('Por favor complete todos los campos');
            }
        },
        // Editar Requerimiento en Obra
        editar2(data = {}) {
            this.jsonData.id = data.id;
            this.jsonData.codigo_recurso = data.codigo_recurso;
            this.jsonData.descripcion_recurso = data.descripcion_recurso;
            this.jsonData.simbolo = data.unidad_id;
            //this object will be modified in the next step
            this.jsonData.requerimiento_recurso_id = data.requerimiento_recurso_id;
            this.jsonData.cantidad_recurso = data.cantidad_recurso;
            this.jsonData.horas_recurso = data.horas_recurso;
            this.jsonData.dias_recurso = data.dias_recurso;
            this.jsonData.tiempo_total_recurso = data.tiempo_total_recurso;
            this.jsonData.precio_referencia_recurso = data.precio_referencia_recurso;
            //Behavior Modal Components
            this.tituloDocLegalesModal = "Formulario de Modificar Item de Requerimiento";
            console.log('EDITAR REQ ITEM', data);
        },
        editar(data = {}) {
            this.jsonData.id = data.id;
            this.jsonData.modal_codigo = data.codigo_recurso;
            this.jsonData.modal_descripcion = data.descripcion_recurso;
            this.jsonData.modal_unidad = data.unidad_id;

            this.jsonData.modal_requerimiento_recurso_id = data.requerimiento_recurso_id;
            this.jsonData.modal_cantidad = data.cantidad_recurso;
            this.jsonData.modal_horas_requeridas = data.horas_recurso;
            this.jsonData.modal_dias_requeridos = data.dias_recurso;
            this.jsonData.modal_plazo = data.tiempo_total_recurso;
            this.jsonData.modal_precio_referencia = data.precio_referencia_recurso;

            this.tituloDocLegalesModal = "Formulario de Modificar Item de Requerimiento";
            console.log('EDITAR REQ ITEM', data);
        },
        async modificar() {

            let datos_jsonData = new FormData();
            datos_jsonData.append('requerimiento_recurso_id', this.jsonData.modal_requerimiento_recurso_id);
            datos_jsonData.append('cantidad_recurso', this.jsonData.modal_cantidad);
            datos_jsonData.append('horas_recurso', this.jsonData.modal_horas_requeridas);
            datos_jsonData.append('dias_recurso', this.jsonData.modal_dias_requeridos);
            datos_jsonData.append('tiempo_total_recurso', this.jsonData.modal_plazo);
            datos_jsonData.append('precio_referencia_recurso', this.jsonData.modal_precio_referencia);
            datos_jsonData.append('id', this.jsonData.id);
            const response = await axios.post('update_requerimiento_item/' + this.jsonData.id, datos_jsonData);
            console.log('UPDATE REQ ITEM', response.data);
            document.getElementById("cerrarModal").click();
            this.limpiar_formulario();
            await this.listarRequerimientoItem();
        },
        async eliminar(id) {
            const response = await axios.delete('delete_requerimiento_obra/' + id);
            console.log('DELETE ITEM OBRA', response.data);
            await this.listarRequerimientoItem();
        },
        async filterListItemRelacion(arrayRequerimientoRelacion) {
            const responsePlanillaItem = (await axios.get('get_planilla_item')).data;
            const getUnidades = (await axios.get('get_unidades')).data;
            let arrayItemsFiltered = [];
            for (let i = 0; i < arrayRequerimientoRelacion.length; i++) {
                if (arrayRequerimientoRelacion[i].requerimiento_id === this.jsonData.requerimiento_id) {
                    for (let j = 0; j < responsePlanillaItem.length; j++) {
                        if (responsePlanillaItem[j].id === arrayRequerimientoRelacion[i].planilla_item_id) {
                            arrayItemsFiltered.push({
                                ...responsePlanillaItem[j],
                                ...arrayRequerimientoRelacion[i],//here is the id object
                            })
                            j = responsePlanillaItem.length;
                        }
                    }
                }
            }
            arrayItemsFiltered.map(item => {
                item.unidad_id = getUnidades[item.unidad_id - 1].simbolo
            });
            console.log('LIST CURRENT', arrayItemsFiltered);
            return arrayItemsFiltered
        },
        async listarItemRelacion() {
            const responseReqRelacion = (await axios.get('get_requerimiento_relacion')).data;
            this.rows1 = await this.filterListItemRelacion(responseReqRelacion);
            // this.rows1 = responseReqRelacion;
            console.log('LIST REQ REL', responseReqRelacion);
        },

        areAlltheFieldsFilledRelacion() {
            return this.jsonData.trabajos_encarados !== '' &&
                this.jsonData.item_codigo !== '' &&
                this.jsonData.item_descripcion !== '' &&
                this.jsonData.item_simbolo !== '' &&
                this.jsonData.item_vigente !== '' &&
                this.jsonData.item_avance !== '' &&
                this.jsonData.item_saldo !== '' &&
                this.jsonData.item_estimado !== '' &&
                this.jsonData.item_precio_unitario !== '';
        },
        async updateDescription() {
            console.log('REQ ID', this.jsonData.requerimiento_id);
            const getRequerimientos = (await axios.get('get_requerimientos')).data;
            this.jsonData.requerimiento_id = getRequerimientos[getRequerimientos.length - 1].id;
            const getCurrentRequerimiento = Object.assign(
                {},
                getRequerimientos.filter(item => item.id === this.jsonData.requerimiento_id)
            );
            const trabajos = this.jsonData.trabajos_encarados.toString();
            const gastos = this.jsonData.gastos_generales.toString();
            let jsonData = new FormData();
            jsonData.append('trabajos_encarados', trabajos);
            jsonData.append('gastos_generales', gastos);
            const updateReqTrabajoGasto = await axios.post('update_requerimiento_trabajos_gastos/' + getCurrentRequerimiento[0].id, jsonData );
            console.log('UPDATE REQ TRABAJO GASTO', updateReqTrabajoGasto.data);
        },
        async saveItemRelacion() {
            const response_req = await axios.get('get_requerimientos');
            this.jsonData.requerimiento_id = response_req.data[response_req.data.length - 1].id;
            let getValoresItem = await axios.get('get_valores_item/' + this.jsonData.item_descripcion.id);
            const arrayValoresItem = Object.assign(getValoresItem.data);
            let datos_jsonData = new FormData();
            datos_jsonData.append('requerimiento_id', this.jsonData.requerimiento_id);
            datos_jsonData.append('planilla_item_id', this.jsonData.item_descripcion.id);
            datos_jsonData.append('vigente', /*this.jsonData.item_vigente*/ arrayValoresItem[0].vigente);
            datos_jsonData.append('avance', /*this.jsonData.item_avance*/ arrayValoresItem[0].avance);
            datos_jsonData.append('estimado', this.jsonData.item_estimado);

            datos_jsonData.append('precio_unitario', this.jsonData.item_precio_unitario);
            const itemRelacion = await axios.post('create_requerimiento_relacion', datos_jsonData);
            console.log('SAVE ITEM RELACION', itemRelacion.data);
            await this.cleanFormItemRelacion()
            await this.listarItemRelacion();
        },
        async guardarItemRelacion() {
            console.log('PROYECTOS', this.jsonData.proyectos);

                if(this.areAlltheFieldsFilledRelacion()){
                    await this.saveItemRelacion();
                    await this.updateDescription();
                } else {
                    alert('Por favor complete todos los campos');
                }
        },
        async editarItemRelacion(data = {}) {
            let getValoresItem = (await axios.get('get_valores_item/' + data.planilla_item_id)).data;
            this.jsonData.id = data.id;
            this.jsonData.modal2_codigo = data.item_codigo;
            this.jsonData.modal2_descripcion = data.item_descripcion;
            this.jsonData.modal2_unidad = data.unidad_id;

            //this object will be modified in the next step Item Relacion
            this.jsonData.requerimiento_id = data.requerimiento_id;
            this.jsonData.planilla_item_id = data.planilla_item_id;
            this.jsonData.modal2_vigente = getValoresItem[0].fvigente;
            this.jsonData.modal2_avance = getValoresItem[0].favance;
            this.jsonData.modal2_saldo = getValoresItem[0].fsaldo;
            this.jsonData.modal2_estimado = data.estimado;
            this.jsonData.modal2_precio_unitario = data.precio_unitario;

            console.log('GET VALORES ITEM', getValoresItem);
            console.log('EDITAR ITEM RELACION', data);
        },
        async modificarItemRelacion() {
            let getValoresItem = (await axios.get('get_valores_item/' + this.jsonData.planilla_item_id)).data;
            console.log('GET VALORES ITEM', getValoresItem);
            const arrayValoresItem = Object.assign(getValoresItem);
            this.jsonData.modal2_vigente = arrayValoresItem[0].vigente;
            this.jsonData.modal2_avance = arrayValoresItem[0].avance;
            let datos_jsonData = new FormData();
            datos_jsonData.append('requerimiento_id', this.jsonData.requerimiento_id);
            datos_jsonData.append('planilla_item_id', this.jsonData.planilla_item_id);
            datos_jsonData.append('vigente', this.jsonData.modal2_vigente);
            datos_jsonData.append('avance', this.jsonData.modal2_avance);
            datos_jsonData.append('estimado', this.jsonData.modal2_estimado);
            datos_jsonData.append('precio_unitario', this.jsonData.modal2_precio_unitario);
            const response = await axios.post('update_requerimiento_relacion/' + this.jsonData.id, datos_jsonData);
            console.log('UPDATE ITEM RELACION', response.data);
            document.getElementById("cerrarModal").click();
            await this.listarItemRelacion();
        },
        async eliminarItemRelacion(id) {
            const response = await axios.delete('delete_requerimiento_relacion/' + id);
            console.log('DELETE ITEM RELACION', response.data);
            await this.listarItemRelacion();
        },
        async filterGetItemsFromContrato(planillas) {
            console.log('Proyecto', this.jsonData.proyectos);

            let arrayPlanillasCurrentProyecto = [];
            for(let i in planillas){
                if (planillas[i].contrato_id === this.jsonData.proyectos.id){
                    arrayPlanillasCurrentProyecto.push(planillas[i]);
                }
                else {
                    console.log('No hay item planillas Relacionadas para este proyecto');
                    alert('No hay item planillas Relacionadas para este proyecto');
                    break
                }
            }
            return arrayPlanillasCurrentProyecto;
        },
        async getAllItemRelacion() {
            const responseItemPlanilla = await axios.get('get_planilla_item');
            console.log("ITEMS PLANILLA", responseItemPlanilla.data);
            this.combo_items_planilla = await this.filterGetItemsFromContrato(responseItemPlanilla.data);
            console.log('GET ALL ITEM RELACION', this.combo_items_planilla);
        },
        async getNameForItemRelacion() {
            const responseUnidad = (await axios.get('get_unidades')).data;
            for (let i = 0; i < responseUnidad.length; i++) {
                if (this.jsonData.item_descripcion.unidad_id == responseUnidad[i].id) {
                    this.jsonData.item_simbolo = responseUnidad[i].simbolo;
                    this.jsonData.item_codigo = this.jsonData.item_descripcion.item_codigo;
                    break;
                }
            }
            //get Vigente, Avance, Estimado, Saldo
            let getValoresItem = (await axios.get('get_valores_item/' + this.jsonData.item_descripcion.id)).data;
            console.log('GET VALORES ITEM', getValoresItem);
            this.jsonData.item_vigente = getValoresItem[0].fvigente;
            this.jsonData.item_avance = getValoresItem[0].favance;
            this.jsonData.item_saldo = getValoresItem[0].fsaldo;
        },
        async filterListOtrosGastos(arrayReqOtrosGastos) {
            const responseReqRecursos = (await axios.get('requerimientos')).data;
            const getUnidades = (await axios.get('get_unidades')).data;

            let arrayItemsFiltered = [];
            for (let i = 0; i < arrayReqOtrosGastos.length; i++) {
                if (arrayReqOtrosGastos[i].requerimiento_id === this.jsonData.requerimiento_id) {
                    for (let j = 0; j < responseReqRecursos.length; j++) {
                        if (responseReqRecursos[j].id === arrayReqOtrosGastos[i].requerimiento_recurso_id) {
                            arrayItemsFiltered.push({
                                ...responseReqRecursos[j],
                                ...arrayReqOtrosGastos[i], //here is the id object
                            });
                            j = responseReqRecursos.length;
                        }
                    }
                }
            }
            arrayItemsFiltered.map(item => {
                item.unidad_id = getUnidades[item.unidad_id - 1].simbolo
            });
            console.log('LIST CURRENT', arrayItemsFiltered);
            return arrayItemsFiltered
        },
        async listarItemOtrosGastos() {
            const responseReqOtrosGastos = (await axios.get('get_requerimiento_otros_gastos')).data;
            this.rows2 = await this.filterListOtrosGastos(responseReqOtrosGastos);
            // this.rows2 = responseReqOtrosGastos;
            console.log('LIST REQ OTROS GASTOS', this.rows2);
        },
        areAlltheFieldsFilledOtros(){
            return this.jsonData.descripcion_otros != '' &&
                this.jsonData.cantidad_otros != '' &&
                this.jsonData.monto_otros != '' &&
                this.jsonData.explicar_otros != '' &&
                this.jsonData.gastos_generales != '';
        },
        async saveItemOtros() {
            const response_req = (await axios.get('get_requerimientos')).data;
            this.jsonData.requerimiento_id = response_req[response_req.length - 1].id;
            console.log('REQ ID', this.jsonData.requerimiento_id);
            let datos_jsonData = new FormData();
            datos_jsonData.append('requerimiento_id', this.jsonData.requerimiento_id);
            datos_jsonData.append('requerimiento_recurso_id', this.jsonData.descripcion_otros.id);
            datos_jsonData.append('cantidad_otros', this.jsonData.cantidad_otros);
            datos_jsonData.append('monto_otros', this.jsonData.monto_otros);
            datos_jsonData.append('explicar_otros', this.jsonData.explicar_otros);
            const itemOtrosGastos = await axios.post('create_requerimiento_otros_gastos', datos_jsonData);
            console.log('SAVE ITEM OTROS GASTOS', itemOtrosGastos.data);
            await this.listarItemOtrosGastos();
            await this.cleanFormOtrosGastos();
        },
        async guardarItemOtrosGastos() {
            if (this.areAlltheFieldsFilledOtros()){
                await this.saveItemOtros();
                await this.updateDescription();
            }else{
                alert('Por favor complete todos los campos');
            }

        },
        async editarItemOtrosGastos(data = {}) {
            this.jsonData.id = data.id;
            this.jsonData.modal3_codigo = data.codigo_recurso;
            this.jsonData.modal3_descripcion = data.descripcion_recurso;
            this.jsonData.modal3_unidad = data.unidad_id;
            //Item Oros Gastos
            this.jsonData.requerimiento_id = data.requerimiento_id;
            this.jsonData.requerimiento_recurso_id = data.requerimiento_recurso_id;
            this.jsonData.modal3_cantidad = data.cantidad_otros;
            this.jsonData.modal3_monto = data.monto_otros;
            this.jsonData.modal3_detallar = data.explicar_otros;

            console.log('EDIT ITEM OTROS GASTOS', data);
        },
        async modificarItemOtrosGastos() {
            let datos_jsonData = new FormData();
            datos_jsonData.append('requerimiento_id', this.jsonData.requerimiento_id);
            datos_jsonData.append('requerimiento_recurso_id', this.jsonData.requerimiento_recurso_id);
            datos_jsonData.append('cantidad_otros', this.jsonData.modal3_cantidad);
            datos_jsonData.append('monto_otros', this.jsonData.modal3_monto);
            datos_jsonData.append('explicar_otros', this.jsonData.modal3_detallar);
            const response = await axios.post('update_requerimiento_otros_gastos/' + this.jsonData.id, datos_jsonData);
            console.log('UPDATE ITEM OTROS GASTOS', response.data);
            document.getElementById("cerrarModal").click();
            await this.listarItemOtrosGastos();
        },
        async eliminarItemOtrosGastos(id) {
            const response = await axios.delete('delete_requerimiento_otros_gastos/' + id);
            console.log('DELETE ITEM OTROS GASTOS', response.data);
            await this.listarItemOtrosGastos();
        },
        async filterNameForOtrosGastos() {
            const getUnidades = (await axios.get('get_unidades')).data;
            const currentUnidad = getUnidades.filter(unidad => unidad.id == this.jsonData.descripcion_otros.unidad_id);
            this.jsonData.codigo_otros = this.jsonData.descripcion_otros.codigo_recurso;
            console.log('CURRENT UNIDAD', currentUnidad);
            this.jsonData.simbolo_otros = currentUnidad[0].simbolo;
        },
        async getAllItemOtrosGastos() {
            const responseOtrosGastos = (await axios.get('requerimientos')).data;
            this.combo_otros_gastos = responseOtrosGastos.filter(item => item.tipo_requerimiento_id === 4);
            console.log('REQUERIMIENTO OTROS', this.combo_otros_gastos);
        },
        async cleanFormReqItem() {
            this.jsonData.requerimiento_recurso_id = '';
            this.jsonData.cantidad_recurso = '';
            this.jsonData.horas_recurso = '';
            this.jsonData.dias_recurso = '';
            this.jsonData.tiempo_total_recurso = '';
            this.jsonData.precio_referencia_recurso = '';

            this.jsonData.descripcion_recurso = '';
            this.jsonData.simbolo = '';
            this.jsonData.codigo_recurso = '';
        },
        async cleanFormItemRelacion() {
            this.jsonData.item_codigo = '';
            this.jsonData.item_descripcion = '';
            this.jsonData.item_simbolo = '';

            this.jsonData.item_vigente = '';
            this.jsonData.item_avance = '';
            this.jsonData.item_saldo = '';
            this.jsonData.item_estimado = '';
            this.jsonData.item_precio_unitario = '';
        },
        async cleanFormOtrosGastos() {
            this.jsonData.codigo_otros = '';
            this.jsonData.descripcion_otros = '';
            this.jsonData.simbolo_otros = '';

            this.jsonData.cantidad_otros = '';
            this.jsonData.monto_otros = '';
            this.jsonData.explicar_otros = '';
        },

        async seleccionar_cont_primario() {
            const respuesta = await axios.get('documents');
            const principales = respuesta.data.filter((item) => item.document_types_id === 1)
            console.log('Documentos Principales', principales);
            this.proyectos = principales;
            $("#seleccion_proyecto_doc_legales").modal("show");

        },
        preguntarModalAlertaConfirmacionEliminar(id) {
            this.mandarMensajesAlerta = {
                titulo: "Mensajes del Sistema",//titulo del mensaje
                contenidoCabecera: "Este es un mensaje de advertencia",//contenido del mensaje
                contenidoCuerpo: "La acción es irreversible",//contenido del mensaje
                contenidoPie: "¿Esta seguro de eliminar el registro?",//contenido del mensaje
                tipo: "ferdy-background-Primary-blak",//color danger warnin etc para header de modal
                tituloBotonUno: "SI", //texto de primer boton el de true
                tituloBotonDos: "NO", //texto segundo bocton del de false
                respuesta: false,
            };
            this.id_eliminacion = id;
            this.$refs.abrirAlerta.abrirAlerta(this.id_eliminacion);
        },
        detectActiveTab(currentTab) {
            this.tabSelected = currentTab;
        },
        respuestaModalAlertaConfirmacion(datos) {
            // console.log(datos.respuesta);
            console.log('eliminando', datos.respuesta);
            if (datos.respuesta === true) {
                if (this.tabSelected === "home") {
                    this.eliminar(this.id_eliminacion);

                } else if (this.tabSelected === "profile") {
                    this.eliminarItemRelacion(this.id_eliminacion);

                } else if (this.tabSelected === "messages") {
                    this.eliminarItemOtrosGastos(this.id_eliminacion);
                }
                console.log('ID DOC', this.tabSelected);
                // this.eliminar(this.id_eliminacion);
            }
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
            combo_otros_gastos: [],
            memorySelected: '',
            tabSelected: 'home',
            proyectos: [],
            todos: false,
            wasChecked: false,
            mandarMensajesAlerta: {},
            id_eliminacion: null,
            jsonData: {
                //REQUERIMIENTO OBRA
                id: "",
                correlativo_requerimiento: null,
                nuri_requerimiento: '',
                requerimiento_id: '',
                tipo_requerimiento_id: 4,
                codigo_recurso: '',
                proyectos: '',
                tipos_documento: {},
                institucion: {},
                cofinanciador: {},
                titulo: '',
                doc_legal: {},
                objetivo: {},
                document_id: '',
                descripcion_requerimiento: '',
                requerimiento_recurso_id: '',
                descripcion_recurso: '',
                unidad_id: '',
                simbolo: '',
                cantidad_recurso: '',
                horas_recurso: '',
                dias_recurso: '',
                tiempo_total_recurso: '',
                precio_referencia_recurso: '',
                trabajos_encarados: '',
                files: null,
                //RELACION CON EL CONTRATO PRINCIPAL
                item_codigo: '',
                item_descripcion: '',
                item_simbolo: '',
                item_vigente: '',
                item_avance: '',
                item_saldo: '',
                item_estimado: '',
                item_precio_unitario: '',
                planilla_item_id: '',
                avance: '',
                estimado: '',
                vigente: '',
                precio_unitario: '',
                ///FIN RELACION
                codigo_otros: '',
                descripcion_otros: '',
                gastos_generales: '',
                simbolo_otros: '',
                cantidad_otros: '',
                monto_otros: '',
                explicar_otros: '',
                fecha_requerimiento: '',
                fechaFormatted: '',

                //MODALES MODIFICAR
                //1
                modal_codigo: '',
                modal_descripcion: '',
                modal_unidad: '',

                modal_requerimiento_recurso_id: '',
                modal_cantidad: '',
                modal_horas_requeridas: '',
                modal_dias_requeridos: '',
                modal_plazo: '',
                modal_precio_referencia: '',
                //2
                modal2_codigo: '',
                modal2_descripcion: '',
                modal2_unidad: '',

                modal2_vigente: '',
                modal2_avance: '',
                modal2_saldo: '',
                modal2_estimado: '',
                modal2_precio_unitario: '',
                //3
                modal3_codigo: '',
                modal3_descripcion: '',
                modal3_unidad: '',

                modal3_requerimiento_recurso_id: '',
                modal3_cantidad: '',
                modal3_monto: '',
                modal3_detallar: '',


                // FIN MODALES MODIFICAR
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
                    name: "unidad_id",
                    filter: {type: "simple", placeholder: "Unidad"},
                    sort: true,
                },
                {
                    label: "Cantidad Vigente",
                    name: "vigente",
                    filter: {type: "simple", placeholder: "Cantidad Vigente"},
                },
                {
                    label: "Avance",
                    name: "avance",
                    filter: {type: "simple", placeholder: "Avance"},
                },
                {
                    label: "Por Ejecutar",
                    name: "precio_unitario",
                    filter: {type: "simple", placeholder: "Por Ejecutar"},
                },
                {
                    label: "Avance Estimado",
                    name: "estimado",
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
                    name: "codigo_recurso",
                    filter: {type: "simple", placeholder: "Codigo",}, sort: true,
                },
                {
                    label: "Gastos Generales:",
                    name: "descripcion_recurso",
                    filter: {type: "simple", placeholder: "Gastos Generales",},
                    sort: true,
                },
                {
                    label: "Unidad",
                    name: "unidad_id",
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
        //Requerimiento
        this.descripcionRecursoGetAll();
        this.descripcionRecursoGetbyType();
        //Item Relacionado
        // this.getAllItemRelacion();
        this.getNameForItemRelacion();
        // this.listarItemRelacion();
        //Otros Gastos
        this.getAllItemOtrosGastos();
        // this.listarItemOtrosGastos();

        //tabs
        console.log("CLICKED ADD", this.clickedAdd);
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
