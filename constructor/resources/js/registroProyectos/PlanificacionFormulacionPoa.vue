<template>
    <div>
        <div class="card">
            <div class="card-header ferdy-background-Primary-blak">
                <h3 class="card-title">Formulación del POA</h3>
                <div class="card-tools">
                    <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#intervencion" @click="ModalCrear();">
                        Crear Cofinanciador
                    </button> -->
                </div>
            </div>
            <br>
            <div class="card-body"> 
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Proyecto: {{this.jsonData.proyectos.nombre}}</label>
                    </div>
                    <div class="col-md-5">                        
                        <!-- <div class="form-group">
                            <label for="institucion">Gestion activa:</label>
                            <v-select label="nombre" :options="combo_gestiones" v-model="jsonData.gestion_seleccionada" placeholder="Selecione una opción">
                                <span slot="no-options">No hay data para cargar</span>
                            </v-select>
                        </div> -->
                        <div class="table-responsive">
                            <button class="btn btn-danger" @click="agregar_gestion()" v-if="existe_nueva_gestion">generar POA {{gestion_nueva}}</button>                            
                            <table class="table table-striped">                                
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">POA-GESTIÓN</th>
                                        <th scope="col">ESTADO</th>
                                        <th scope="col">GESTIÓN DE TRABAJO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="poas_existente in jsonGestion.gestiones" :key="poas_existente.numero">
                                        <th>{{poas_existente.numero+1}}</th>
                                        <td>{{poas_existente.nombre}}</td>
                                        <td>                                            
                                            <label class="form-check-label" for="inlineCheckbox1">{{poas_existente.estado}}</label>
                                        </td>
                                        <td>     
                                            <center>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" class="form-check-input" value="1" v-model="poas_existente.check_activo" @change="procesar_cambio_estado(poas_existente.numero, 1)">
                                                    <label class="form-check-label text-danger" for="inlineCheckbox1" v-if="poas_existente.estado=='Cerrado'">Solo consulta</label>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5"> <br>
                        <!-- <button class="btn btn-success">Activar Gestión</button><br><br> -->
                        <label for="">Seleccione Componentes a Programar:</label>   
                        <div class="row">
                            <div class="col-md-12" id="componentes">
                                <div class="form-group" v-for="componente in componentes_segun_poa" :key="componente.id">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input objetivos_componentes_poa" name="objetivos_componentes_poa[]" type="checkbox" :value="componente.id">
                                        <label class="form-check-label" for=""> {{componente.desc_corta}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-2"><br><br><br><br>
                        <button class="btn btn-primary" @click="generar_poa()" v-if="gestion_trabajo.estado != 'Cerrado'">Adicionar componentes ({{gestion_trabajo.nombre}})</button>
                    </div>
                </div>
                    <!-- desde aqui poa tipo marco logico -->  
                
                <div class="row">
                    <h2 class="text-primary">POA {{gestion_trabajo.nombre}}</h2>
                    <div class="col-md-12">
                        <div v-for="arbol_de_objetivo in arbol_de_objetivos" :key="arbol_de_objetivo.id">
                            <poa-collapse  :ferd_variable_collapse="arbol_de_objetivo" @escuchaArbol="respuestaSubArbol" ref="llamarSubArbol"></poa-collapse> 
                        </div>                                                            
                    </div>
                </div>
            </div>
        </div>    
        <div class="modal fade" id="registro_objetivos_proyecto" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="registro_objetivos_proyectoTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <!-- poner nombre de tipo de objetivo y nombre de proyecto -->
                        <h5 class="modal-title" id="registro_objetivos_proyectoTitle">POA {{gestion_trabajo.nombre}}: {{objetivo_nombre}} &nbsp;&nbsp;&nbsp; Proyecto: {{jsonData.proyectos.nombre}}, Objetivo Padre: {{jsonData.objetivoPadre.desc_corta}}</h5>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrando_modal();">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- objetivos -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" @click="tipo_nueva_continuidad()" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{objetivo_nombre}} Nueva
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" @click="tipo_nueva_continuidad()" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        {{objetivo_nombre}} de Continuidad
                                    </label>
                                </div>
                            </div>    
                            <div class="col-md-8">                        
                                <div class="col-md-12" v-if="producto_ver">
                                    <div class="form-group">
                                        <label for="codsisin">Seleccione {{objetivo_nombre}} Origen:</label>
                                        <v-select label="desc_corta" :options="objetivos_nuevo_continuidad" v-model="jsonData.objetivo_nuevo_continuidad" placeholder="Selecione un Tipo de Ejecución">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" v-if="modal_ver_objetivos">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><b class="text-danger">{{objetivo_nombre}}</b></a>
                            </li>                            
                        </ul>    
                        <div class="container" v-if="modal_ver_objetivos">
                            <div class="row">
                                <div class="col-md-6" v-if="descripcion_corta_ver_modal">
                                    <div class="form-group">
                                        <label for="codsisin">Descripción Corta:</label>          
                                        <input type="text" class="form-control" v-model="jsonData.descripcion_corta_objetivo" >           
                                    </div>
                                </div>
                                <div class="col-md-3" v-if="fecha_inicio_ver_modal">                            
                                    <div class="form-group">
                                        <label for="codsisin">Fecha Inicio:</label>
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

                                            v-model="jsonData.fecha_inicio"
                                            :value="jsonData.fecha_heredada_inicio"
                                        >
                                        </datepicker>
                                    </div>
                                </div>
                                <div class="col-md-3" v-if="fecha_fin_ver_modal">                            
                                    <div class="form-group">
                                        <label for="codsisin">Fecha Fin:</label>
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

                                            v-model="jsonData.fecha_fin"
                                            :value="jsonData.fecha_heredada_fin"
                                        >
                                        </datepicker>
                                    </div>
                                </div>
                                <div class="col-md-4" v-if="producto_ver">
                                    <div class="form-group">
                                        <label for="codsisin">Tipo de Ejecución:</label>
                                        <v-select label="nombre" :options="tipos_ejecucion" v-model="jsonData.tipo_ejecucion" placeholder="Selecione un Tipo de Ejecución">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-4">          
                                    <div class="form-group">
                                        <label for="duracion_dias">Duración de Días:</label>
                                        <input type="number" class="form-control" v-model="jsonData.duracion_dias">
                                    </div>
                                </div>
                                <div class="col-md-4">          
                                    <div class="form-group">
                                        <label for="duracion_dias">Monto Bs:</label>
                                        <input type="number" class="form-control" v-model="jsonData.monto_bs">
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="resumen_narrativo_ver_modal">                                  
                                    <div class="form-group">
                                        <label for="codsisin">Resumen Narrativo:</label>                   
                                        <vue-editor 
                                            v-model="jsonData.resumen_narrativo_objetivo"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                    </div>
                                </div>   
                            </div>    
                        </div>
                        <!-- resultados -->
                        <ul class="nav nav-tabs" v-if="modal_ver_resultados">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><b class="text-danger">{{resultado_nombre}}</b></a>
                            </li>                            
                        </ul> 
                        <div class="container" v-if="modal_ver_resultados">
                            <div class="row">
                                <div class="col-md-6" v-if="descripcion_corta_ver_modal">
                                    <div class="form-group">
                                        <label for="codsisin">Descripción Corta:</label>          
                                        <input type="text" class="form-control" v-model="jsonData.descripcion_corta_resultado" >           
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="resumen_narrativo_ver_modal">                                  
                                    <div class="form-group">
                                        <label for="codsisin">Resumen Narrativo:</label>                   
                                        <vue-editor 
                                            v-model="jsonData.resumen_narrativo_resultado"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                    </div>
                                </div>   
                            </div>    
                        </div>   
                        <!-- titulos indicadores y planificacion -->
                        <div class="container-fluid" v-if="modal_ver_indicadores_planificacion">
                            <div class="row">
                                <div class="col-md-12" v-if="modal_ver_planificacion">
                                    <h3 class="text-danger">Planificación y Programación de Indicadores de Resultados</h3>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Proyecto:</label>                                   
                                </div>    
                                <div class="col-md-10">
                                    <div class="form-group">       
                                        <input type="text" class="form-control" v-model="jsonData.proyectos.nombre" disabled>           
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Objetivo:</label>                           
                                </div>    
                                <div class="col-md-10">
                                    <div class="form-group">       
                                        <input type="text" class="form-control" v-model="jsonData.objetivoIndicador.desc_corta" disabled>   
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Resultado:</label>  
                                </div>    
                                <div class="col-md-10">  
                                    <div class="form-group">         
                                        <input type="text" class="form-control" v-model="jsonData.resultadoIndicador.desc_corta" disabled>   
                                    </div>
                                </div>
                                <div class="col-md-2" v-if="modal_ver_planificacion">
                                    <label for="">Indicador:</label>
                                </div>
                                <div class="col-md-10" v-if="modal_ver_planificacion">
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="jsonData.Indicador.nombre" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="modal_ver_programacion">                                    
                                <div class="col-md-2">
                                    <label for="">Indicador:</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="jsonData.Indicador.nombre" disabled>
                                    </div>
                                </div>
                                <!-- campos cuatro columnas -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Planificación:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_planificacion" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Gestión:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_gestion" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Fecha Inicial:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_fecha_inicial" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Fecha Final:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_fecha_final" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Valor Inicial:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_valor_inicial" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">V. Final:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_valor_final" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Frecuencia:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_frecuencia" disabled>
                                    </div>
                                </div>                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin"># Registros:</label>
                                        <input type="text" class="form-control" v-model="jsonData.Programacion_title_registros" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- indicadores -->
                        <ul class="nav nav-tabs" v-if="modal_ver_indicadores">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><b class="text-danger">Indicador</b></a>
                            </li>                            
                        </ul>    
                        <div class="container" v-if="modal_ver_indicadores">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nombre:</label>          
                                        <input type="text" class="form-control" v-model="jsonData.Indicador_nombre" >           
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Unidad de Medida:</label>
                                        <v-select label="nombre" :options="unidadMedidaCombo" v-model="jsonData.Indicador_unidades_id" placeholder="Selecione una Unidad de Medida">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codsisin">Frecuencia de Medición:</label>
                                        <v-select label="nombre" :options="frecuenciaMedicionCombo" v-model="jsonData.Indicador_frecuencia" placeholder="Selecione una Frecuencia de Medición">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-6">                                  
                                    <div class="form-group">
                                        <label for="">Descripción:</label>                   
                                        <vue-editor 
                                            v-model="jsonData.Indicador_descripcion"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                    </div>
                                </div>   
                                <div class="col-md-6">                                  
                                    <div class="form-group">
                                        <label for="">Variables:</label>                   
                                        <vue-editor 
                                            v-model="jsonData.Indicador_variables"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                    </div>
                                </div>   
                                <div class="col-md-6">                                  
                                    <div class="form-group">
                                        <label for="">Forma de Cálculo:</label>                   
                                        <vue-editor 
                                            v-model="jsonData.Indicador_calculo"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                    </div>
                                </div>   
                                <div class="col-md-6">                                  
                                    <div class="form-group">
                                        <label for="">Medios de Verificación:</label>                   
                                        <vue-editor 
                                            v-model="jsonData.Indicador_medios_verificacion"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>
                                    </div>
                                </div>   
                            </div>
                        </div>     
                        <!-- planificaciones -->
                        <ul class="nav nav-tabs" v-if="modal_ver_planificacion">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><b class="text-danger">Planificación</b></a>
                            </li>                            
                        </ul>    
                        <div class="container" v-if="modal_ver_planificacion">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha Inicio:</label>          
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

                                            v-model="jsonData.Planificacion_fecha_inicial"
                                            :value="jsonData.Planificacion_fecha_inicial"
                                        >
                                        </datepicker>         
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha Fin:</label>          
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

                                            v-model="jsonData.Planificacion_fecha_final"
                                            :value="jsonData.Planificacion_fecha_final"
                                        >
                                        </datepicker>         
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Gestión:</label>          
                                        <input type="text" class="form-control" v-model="jsonData.Planificacion_gestion" >           
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Frecuencia de Medición:</label>          
                                        <v-select label="nombre" :options="frecuenciaMedicionCombo" v-model="jsonData.Planificacion_indicador_frecuencia_id" placeholder="Selecione una Frecuencia de Medición">
                                            <span slot="no-options">No hay datos para cargar</span>
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Valor Inicial (Línea Base):</label>          
                                        <input type="number" class="form-control" v-model="jsonData.Planificacion_valor_inicial" >           
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Valor Final (Meta):</label>          
                                        <input type="number" class="form-control" v-model="jsonData.Planificacion_valor_final" >           
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">cargar doc:</label>                     
                                        <label for="documento_res_aprobacion" id="label_documento_res_aprobacion" class="bg-primary" 
                                        style="font-size: 14px; font-weight: 600; color: #fff; display: inline-block; transition: all .5s; cursor: pointer; padding: 10px 15px !important; width: 100%; text-align: center; border-radius: 7px;">
                                            <span id="contenido_documento_res_aprobacion"><i class="fas fa-download fa-1x"></i><br> <span> {{configFile.contenidoDefault}}</span></span>
                                            <button type="button" class="close" v-if="configFile.cerrar" @click="borrar_file();"> <span>&times;</span> </button>
                                        </label>
                                        <input type="file" class="form-control" id="documento_res_aprobacion" @change="cargar_file" style="display:none">      
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descripción:</label>                  
                                        <vue-editor 
                                            v-model="jsonData.Planificacion_glosa"
                                            :editor-toolbar="configToolBarEditText"
                                        ></vue-editor>      
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <!-- programacion           -->                        
                        <ul class="nav nav-tabs" v-if="modal_ver_programacion">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><b class="text-danger">Programación</b></a>
                            </li>                            
                        </ul>    
                        <div class="container" v-if="modal_ver_programacion">
                            <div class="row">
                                <div class="table-responsive">
                                    <vue-bootstrap4-table :rows="rowsProgramaciones" :columns="columnsProgramaciones" :config="configTablas" :classes="classes">
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
                                                                                
                                        <template slot="fecha" slot-scope="props">
                                            <div class="form-group">        
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
                                                    v-model="props.row.fecha"
                                                    :value="props.row.fecha"
                                                >
                                                </datepicker>
                                            </div>
                                        </template>
                                        <template slot="concepto" slot-scope="props">
                                            <div class="form-group">        
                                                <input type="text" class="form-control" v-model="props.row.concepto" >           
                                            </div>
                                        </template>
                                        <template slot="valor_medido" slot-scope="props">
                                            <div class="form-group">        
                                                <input type="number" class="form-control" v-model="props.row.valor_medido" >           
                                            </div>
                                        </template>

                                        <template slot="acciones" slot-scope="props">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-warning ml-1" @click="EditarEstaProgramacion(props.row);" title="Editar Resultado"><span><i class="fa fa-user-edit"></i></span></button>
                                                <!-- <button type="button" class="btn btn-outline-danger ml-1" @click="eliminarResultado(props.row.id);"  title="Eliminar Resultado"><span><i class="fa fa-trash-alt"></i></span></button>                 -->
                                            </div>
                                        </template>
                                    </vue-bootstrap4-table>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success" @click="guardarResultados();" v-if="btnadicionar_modal"><i class="fas fa-list"></i> Adicionar Resultado</button>                        
                                </div>
                                <div class="col-md-4 text-right">                                
                                    <button type="button" class="btn btn-success" @click="guardarPlanificacion();" v-if="btnadicionarPlanificacion_modal"><i class="fas fa-list"></i> Adicionar Planificación</button>
                                    <button type="button" class="btn btn-warning" @click="modificarPlanificacion();" v-if="btnmodificarPlanificacion_modal"><i class="fas fa-list"></i> Modificar Planificación</button>
                                    <button type="button" class="btn btn-success" @click="guardarIndicador();" v-if="btnadicionarIndicador_modal"><i class="fas fa-list"></i> Adicionar Indicador</button>                                
                                    <button type="button" class="btn btn-warning" @click="modificarIndicador();" v-if="btnmodificarIndicador_modal">Modificar Indicador</button>
                                    <button type="button" class="btn btn-success" @click="guardarObjetivos();" v-if="btnguardar_modal">Guardar</button>
                                    <button type="button" class="btn btn-warning" @click="modificarObjetivos();" v-if="btnmodificar_modal">Modificar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModal" v-if="btncancelar" @click="cerrando_modal();">Cancelar</button>
                                </div>
                            </div>
                        </div>
                        <!-- tabla de resultados -->
                        <div  class="container" v-if="modal_ver_todos_resultados">
                            <div class="table-responsive">
                                <vue-bootstrap4-table :rows="rows" :columns="columns" :config="configTablas" :classes="classes">
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
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-success" @click="EditarIndicador(props.row);" title="Ver Indicadores"><span><i class="fas fa-info-circle"></i></span></button>
                                            <button type="button" class="btn btn-outline-warning ml-1" @click="EditarResultado(props.row);" title="Editar Resultado"><span><i class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1" @click="eliminarResultado(props.row.id);"  title="Eliminar Resultado"><span><i class="fa fa-trash-alt"></i></span></button>                
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>   
                        <!-- tabla de indicadores  -->
                        <div  class="container" v-if="modal_ver_indicadores">
                            <div class="table-responsive">
                                <vue-bootstrap4-table :rows="rowsIndicadores" :columns="columnsIndicadores" :config="configTablas" :classes="classes">
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
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-success" @click="EditarPlanificacion(props.row);" title="Ver Planificaciones"><span><i class="fab fa-product-hunt"></i></span></button>
                                            <button type="button" class="btn btn-outline-warning ml-1" @click="EditarEsteIndicador(props.row);" title="Editar Indicador"><span><i class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1" @click="eliminarIndicador(props.row.id);"  title="Eliminar Indicador"><span><i class="fa fa-trash-alt"></i></span></button>                
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>
                        <!-- tabla de planificacion  -->
                        <div  class="container" v-if="modal_ver_planificacion">
                            <div class="table-responsive">
                                <vue-bootstrap4-table :rows="rowsPlanificaciones" :columns="columnsPlanificaciones" :config="configTablas" :classes="classes">
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
                                    <template slot="acciones" slot-scope="props">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary" title="Ver Documento"><span><i class="fa fa-file-alt"></i></span></button>
                                            <button type="button" class="btn btn-outline-success ml-1" @click="EditarProgramacion(props.row);" title="Programar"><span><i class="fas fa-tasks"></i></span></button>
                                            <button type="button" class="btn btn-outline-warning ml-1" @click="EditarEstaPlanificacion(props.row);" title="Editar Planificación"><span><i class="fa fa-user-edit"></i></span></button>
                                            <button type="button" class="btn btn-outline-danger ml-1" @click="eliminarPlanificacion(props.row.id);"  title="Eliminar Planificación"><span><i class="fa fa-trash-alt"></i></span></button>                
                                        </div>
                                    </template>
                                </vue-bootstrap4-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <configuraciones :configuracionCofinanciador="datosEnviarConfiguracion" @enviaConfiguracionHijoAPadre="funcionRespuestaConfig" ref="RecuperaConfig"></configuraciones>        
        
        <!-- modal pregunta inicio -->
        <div class="modal fade" id="marco_logico_modal_seleccion_proyecto" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="marco_logico_modal_seleccion_proyectoTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header ferdy-background-Primary-blak">
                        <h5 class="modal-title" id="marco_logico_modal_seleccion_proyectoTitle">{{institucion_auth.nombre}}</h5>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="buscarSeleccion();">Seleccionar</button>
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
    import moment from 'moment';
export default {
    props:['institucion_auth'],
    data(){
        return{
            existe_nueva_gestion:true,
            gestion_trabajo:{},
            gestion_nueva:'',
            arbol_de_objetivos:[],
            componentes_segun_poa:[
                // {"id":1, "desc_corta":"componente 1"},
                // {"id":2, "desc_corta":"componente 2"},
                // {"id":3, "desc_corta":"componente 3"},
            ],
            combo_estados_gestiones:[
                {"id":1, "nombre":"2021"},
                {"id":2, "nombre":"2022"},
                {"id":3, "nombre":"2023"},
            ],
            jsonData:{
                componente:{},
                gestion_seleccionada:{"id":1, "nombre":"2021"},
            },

            modal_ver_objetivos:true,
            modal_ver_resultados:true,
            modal_ver_todos_resultados:false,
            modal_ver_indicadores:true,
            modal_ver_indicadores_planificacion:true,
            modal_ver_planificacion:true,
            modal_ver_programacion:false,

            objetivo_nombre:'',
            resultado_nombre:'',
            mandarMensajesAlerta:'',
            btnadicionar:true,
            btnguardar:true,
            btnactualizar:false,
            btncancelar:true,
            
            abrir_modal_registro:false,
            btnmodificar_modal:false,
            btnguardar_modal:false,
            btnadicionar_modal:false,
            btnadicionarIndicador_modal:false,
            btnmodificarIndicador_modal:false,
            btnadicionarPlanificacion_modal:false,
            btnmodificarPlanificacion_modal:false,
            proyectos:[],
            
            objetivosCombo:[],
            componentesCombo:[],
            productosCombo:[],
            actividadesCombo:[],
            unidadMedidaCombo:[],
            frecuenciaMedicionCombo:[],

            tipos_ejecucion:[{id:1, nombre:"Ejecución Propia", valor:true},{id:2, nombre:"Ejecución por terceros", valor:false}],
            objetivo_disabled:false,
            arbol_de_objetivos:[],
            objetivos_nuevo_continuidad:[],
            jsonData:{
                estado_nuevo_continuidad:0,
                objetivo_nuevo_continuidad:{},
                objetivoPadre:{},
                gestion:'',
                id_objetivo_update:null,
                id_resultado_update:null,
                proyectos:{},
                objetivosProceso:[],
                nombreInstitucion:'',
                objetivo:{},
                tipo_ejecucion:{id:1, nombre:"Ejecución Propia", valor:true},
                componente:'',
                producto:{},
                actividad:{},
                descripcion_corta:'',
                descripcion_corta_objetivo:'',
                descripcion_corta_resultado:'',
                fecha_inicio:'25/05/1987',
                fecha_fin:'',
                resumen_narrativo:'',
                resumen_narrativo_objetivo:'',
                resumen_narrativo_resultado:'',
                fecha_heredada_inicio:null,
                fecha_heredada_fin:null,
                duracion_dias:0,
                monto_bs:0,

                unidadMedida:{},
                frecuenciaMedicion:{},
                resultadoIndicador:{},
                objetivoIndicador:{},

                Indicador:{},

                Indicador_id:null,
                Indicador_nombre:'',
                Indicador_descripcion:'',
                Indicador_frecuencia:{},
                Indicador_variables:'',
                Indicador_calculo:'',
                Indicador_unidades_id:{},
                Indicador_medios_verificacion:'',

                Planificacion:{},

                Planificacion_id:null,
                Planificacion_indicadores_resultados_id:{},
                Planificacion_gestion:'',
                Planificacion_fecha_inicial:'',
                Planificacion_fecha_final:'',
                Planificacion_indicador_frecuencia_id:{},
                Planificacion_valor_inicial:'',
                Planificacion_valor_final:'',
                Planificacion_glosa:'',
                Planificacion_pathDocumento:'',
                files:null,

                Programacion:{},

                Programacion_cantidad_rows:0,
                Programacion_rows:[],
                Programacion_title_planificacion:'',
                Programacion_title_gestion:'',
                Programacion_title_fecha_inicial:'',
                Programacion_title_fecha_final:'',
                Programacion_title_valor_inicial:'',
                Programacion_title_valor_final:'',
                Programacion_title_frecuencia:'',
                Programacion_title_registros:'',
                Programacion_fecha:'',
                Programacion_comentario:'',
                Programacion_valor_programado:'',
            },
            jsonGestion:{
                gestiones:[],
            },
            rows: [],
            columns: [
                { label: "#",               name: "id",                 filter: { type: "simple", placeholder: "#", },                sort: true, uniqueId: true, },
                { label: "Descripción Corta",name: "desc_corta",         filter: { type: "simple", placeholder: "Descripción Corta", },              sort: true, },
                { label: "Resumen Narrativo",name: "descripcion",        filter: { type: "simple", placeholder: "Resumen Narrativo" },            sort: true, },
                { label: "Acciones",        name: "acciones",           sort: false, },
            ],
            rowsIndicadores: [],
            columnsIndicadores: [
                { label: "#",               name: "id",                 filter: { type: "simple", placeholder: "#", },                sort: true, uniqueId: true, },
                { label: "Nombre",          name: "nombre",         filter: { type: "simple", placeholder: "Nombre", },              sort: true, },
                { label: "Descripción",     name: "descripcion",        filter: { type: "simple", placeholder: "Descripción" },         sort: true, },
                { label: "Unidad",          name: "unidades.nombre",        filter: { type: "simple", placeholder: "Unidad" },            sort: true, },
                { label: "Frecuencia",      name: "frecuencias.nombre",        filter: { type: "simple", placeholder: "Frecuencia" },            sort: true, },
                { label: "Acciones",        name: "acciones",           sort: false, },
            ],
            rowsPlanificaciones: [],
            columnsPlanificaciones: [                
                { label: "Planificación",   name: "desc_corta",         filter: { type: "simple", placeholder: "Planificación", },              sort: true, },
                { label: "Gestión",         name: "gestion",        filter: { type: "simple", placeholder: "Gestión" },         sort: true, },
                { label: "Descripción",     name: "glosa",        filter: { type: "simple", placeholder: "Descripción" },            sort: true, },
                { label: "V. Inicial",      name: "valor_inicial",        filter: { type: "simple", placeholder: "V. Inicial" },            sort: true, },
                { label: "V. Final",        name: "valor_final",        filter: { type: "simple", placeholder: "V. Final" },            sort: true, },
                { label: "V. Ejecutado",    name: "descripcion",        filter: { type: "simple", placeholder: "V. Ejecutado" },            sort: true, },
                { label: "Acciones",        name: "acciones",           sort: false, },
            ],
            rowsProgramaciones: [],
            columnsProgramaciones: [                
                { label: "Fecha",           name: "fecha",         filter: { type: "simple", placeholder: "Fecha", },              sort: true, },
                { label: "Comentario",      name: "concepto",        filter: { type: "simple", placeholder: "Comentario" },         sort: true, },
                { label: "Valor Programado",name: "valor_medido",        filter: { type: "simple", placeholder: "Valor Programado" },            sort: true, },
                { label: "Acciones",        name: "acciones",           sort: false, },
            ],
            datosEnviarConfiguracion:{},        
            configFechas:{},
            configTablas:{},
            actions:[],
            classes:{},
            configToolBarEditText:[],
            configFile:{
                cerrar:false,
                contenidoDefault:" DOCUMENTOS",              
            },

            //ver ventana principal
            objetivo_ver:true,
            componente_ver:true,
            producto_ver:true,
            actividad_ver:true,
            descripcion_corta_ver:true,
            fecha_inicio_ver:true,
            fecha_fin_ver:true,
            resumen_narrativo_ver:true,
            //ver modal
            objetivo_ver_modal:true,
            componente_ver_modal:true,
            producto_ver_modal:true,
            actividad_ver_modal:true,
            descripcion_corta_ver_modal:true,
            fecha_inicio_ver_modal:true,
            fecha_fin_ver_modal:true,
            resumen_narrativo_ver_modal:true,
        }
    },
    methods: {
        tipo_nueva_continuidad(){
            // console.log($('input[name="exampleRadios"]:checked').val());
            if($('input[name="exampleRadios"]:checked').val() == "option1"){//nueva 
                this.ObjetivoNueva();
            }else{
                if($('input[name="exampleRadios"]:checked').val() == "option2"){// de continuidad
                    this.ObjetivoContinuidad();
                }
            }
        },
        async ObjetivoNueva(){
            // console.log(this.jsonData.objetivoPadre.id);
            var datos = {"tipo":"nuevo", "id":this.jsonData.objetivoPadre.id};
            var respuesta = await axios.post('objetivos_nuevos_continuidad', datos);
            // console.log(respuesta.data);
            this.objetivos_nuevo_continuidad = respuesta.data;
            this.jsonData.objetivo_nuevo_continuidad = {};
            this.jsonData.estado_nuevo_continuidad = 0;
        },
        async ObjetivoContinuidad(){
            // console.log(this.jsonData.objetivo);return;
            var gestion_anterior = this.gestion_trabajo.nombre;
            gestion_anterior = parseInt(gestion_anterior);
            gestion_anterior--;
            console.log(gestion_anterior);
            var datos = {"tipo":"continuidad", "id":"sin id por que es de continuidad de otra gestion", "gestion":gestion_anterior, "tipo_objetivo":this.jsonData.objetivo.id};
            var respuesta = await axios.post('objetivos_nuevos_continuidad', datos);
            this.objetivos_nuevo_continuidad = respuesta.data;
            this.jsonData.objetivo_nuevo_continuidad = {};
            this.jsonData.estado_nuevo_continuidad = 1;
        },
        async generar_poa(){            
            var checks = $('#componentes').find('input:checked').toArray().map(item => item.value);
            $('.objetivos_componentes_poa').removeAttr('checked', 'checked');
            console.log(checks);            
            var gestion = this.buscar_gestion_activa();
            if(gestion == {}){
                alert('No existe gestion activa');
                return;                
            }
            if(gestion.estado == 'Cerrado'){
                checks = [];
            }
            var respuesta = await axios.post('generar_poa', {'ids':checks, 'gestion':gestion});
            console.log(respuesta.data);
            console.log(gestion);
            this.buscar_arbol_marco_logico();
        },
        agregar_gestion(){
            var aux = this.jsonGestion.gestiones;
            this.jsonGestion.gestiones = [];
            console.log(aux);
            console.log(this.jsonGestion.gestiones);
            var cont = 0;
            this.jsonGestion.gestiones.push({'numero':cont, 'nombre':this.gestion_nueva, 'estado':'Activo', 'check_activo':true, 'check_cerrado':false, 'check_revision':false});
            cont++;
            aux.forEach(element => {
                if(element.estado == 'Activo'){
                    element.estado = 'Revisión';
                }else{
                    if(element.estado == 'Revisión'){
                        element.estado = 'Cerrado';
                    }
                }
                var vector = {
                    'numero':cont,                    
                    'nombre':element.nombre,                    
                    'estado':element.estado,                    
                    'check_activo':false,                    
                    'check_cerrado':element.check_cerrado,                    
                    'check_revision':element.check_revision,
                };
                this.jsonGestion.gestiones.push(vector);
                cont++;
            });
            this.existe_nueva_gestion = false;
            this.buscar_arbol_marco_logico();
        },
        async gestiones_poa(){
            var respuesta = await axios.post('gestiones_poa', this.jsonData);//de objetivos
            console.log(respuesta.data);
            var gestiones = respuesta.data;
            var cont = 0;
            var gestion = 0;
            gestiones.forEach(element => {
                // console.log(element.gestion);
                if(element.gestion!='null' && element.gestion!=null){
                    // console.log("distinti de null");
                    if(cont > 0){
                        if(cont == 1){
                            this.jsonGestion.gestiones.push({'numero':cont, 'nombre':element.gestion, 'estado':'Revisión', 'check_activo':false, 'check_cerrado':false, 'check_revision':true});
                        }else{
                            this.jsonGestion.gestiones.push({'numero':cont, 'nombre':element.gestion, 'estado':'Cerrado', 'check_activo':false, 'check_cerrado':true, 'check_revision':false});
                        }                        
                    }else{
                        if(cont == 0){
                            gestion = parseInt(element.gestion);
                            gestion++;
                            this.jsonGestion.gestiones.push({'numero':cont, 'nombre':element.gestion, 'estado':'Activo', 'check_activo':true, 'check_cerrado':false, 'check_revision':false});                            
                            // cont++;
                            // this.jsonGestion.gestiones.push({'numero':cont, 'nombre':element.gestion, 'id':1, 'check_activo':false, 'check_cerrado':false, 'check_revision':true});
                        }
                    }
                    cont++;
                }
            });
            this.gestion_nueva = gestion;
            if(cont == 0){
                var respuesta = await axios.post('gestiones_poa_de_intervencion', this.jsonData);//de intervencion mas antigua
                // console.log(respuesta.data);
                var fecha = moment(respuesta.data.fecha_inicial_programada);
                fecha = fecha.format('YYYY');
                this.jsonGestion.gestiones.push({'numero':cont, 'nombre':fecha, 'id':1, 'check_activo':true, 'check_cerrado':false, 'check_revision':false});
                // console.log(this.jsonGestion.gestiones);
                // console.log(this.poas_existentes);
            }
            var gestion = this.buscar_gestion_activa();
            console.log(gestion);
            if(gestion == {}){
                alert('No existe gestion activa');
                return;
            }else{
                this.buscar_arbol_marco_logico();
            }
        },
        procesar_cambio_estado(numero, estado){
            this.jsonGestion.gestiones.forEach(element => {
                element.check_activo = false;
                element.check_cerrado = false;
                element.check_revision = false;
                if(element.numero == numero){
                    if(estado==1){
                        element.check_activo = true;
                        // this.un_activo(numero);
                    }else{
                        if(estado==2){
                            element.check_cerrado = true;
                        }else{
                            if(estado==3){
                                element.check_revision = true;
                            }
                        }                        
                    }
                }
            });
            // console.log(numero);
            // console.log(this.jsonGestion.gestiones);
            this.buscar_arbol_marco_logico();
        },
        un_activo(numero){
            this.jsonGestion.gestiones.forEach(element => {
                if(element.numero != numero){                    
                    if(element.check_activo == true){
                        element.check_activo = false;
                        element.check_cerrado = true;
                        element.check_revision = false;
                    }
                }
            });  
            var en_revision = false;          
            this.jsonGestion.gestiones.forEach(element => {
                if(en_revision == true){
                    element.check_activo = false;
                    element.check_cerrado = false;
                    element.check_revision = true;

                    en_revision = false;
                }
                if(element.numero == numero){                    
                    var en_revision = true;
                }
            });
        },
        buscar_gestion_activa(){            
            var gestion = {};
            this.jsonGestion.gestiones.forEach(element => {               
                if(element.check_activo == true){
                    gestion = element;
                }
            }); 
            this.gestion_trabajo = gestion;
            return gestion;
        },
        async buscar_objetivos_para_poa(id_intervencion){
            var respuesta = await axios.get('objetivos_poa/' + id_intervencion);
            this.componentes_segun_poa = respuesta.data;
            // console.log(this.componentes_segun_poa);
        },
        async eliminarResultado(id){
            // console.log(id);   
            var respuesta = await axios.get('eliminar_resultado/' + id);         
            // console.log(respuesta.data);   
            this.buscar_arbol_marco_logico();
            var respuesta2 = await axios.get('resultado/' + this.jsonData.id_objetivo_update);
            this.rows = respuesta2.data;
            this.limpiar_form();
        },
        async guardarResultados(){            
            var respuesta = await axios.post('guardar_resultado', this.jsonData);
            // console.log(respuesta.data);
            // document.getElementById("cerrarModal").click();
            // this.abrir_modal_registro = false;
            this.buscar_arbol_marco_logico();
            var respuesta2 = await axios.get('resultado/' + this.jsonData.id_objetivo_update);
            this.rows = respuesta2.data;
            this.limpiar_form();
        },
        async EditarResultado(datos){
            // console.log(datos);
            this.jsonData.descripcion_corta_resultado = datos.desc_corta;
            this.jsonData.resumen_narrativo_resultado = datos.descripcion;
            this.jsonData.id_resultado_update = datos.id;
                                          
            this.btnguardar_modal = false;
            this.btnmodificar_modal = true;
            this.btnadicionar_modal = false;
            this.btnadicionarIndicador_modal = false;
            this.btnmodificarIndicador_modal = false;
            this.btnadicionarPlanificacion_modal = false;
            this.btnmodificarPlanificacion_modal = false;
        },
        async modificarObjetivos(){
            console.log("mod");
            if(this.modal_ver_objetivos == true){//modificando objetivos
                var respuesta = await axios.post('modificar_objetivo', this.jsonData);console.log("1");
                this.buscar_arbol_marco_logico();
            }
            if(this.modal_ver_resultados == true){//modificando resultados
                var respuesta = await axios.post('modificar_resultado', this.jsonData);console.log("2");
                this.buscar_arbol_marco_logico();
            }
            console.log("salio");
            var respuesta = await axios.get('resultado/' + this.jsonData.id_objetivo_update);
            this.rows = respuesta.data;
            this.limpiar_form();
        },  
        async guardarObjetivos(){  
            var aux_date = this.jsonData.fecha_inicio;
            this.jsonData.fecha_inicio = aux_date.getFullYear() + "-" + (aux_date.getMonth() + 1) + "-" + aux_date.getDate();
            var aux_date = this.jsonData.fecha_fin;
            this.jsonData.fecha_fin = aux_date.getFullYear() + "-" + (aux_date.getMonth() + 1) + "-" + aux_date.getDate();
            // this.jsonData.proyectos['id'] = this.jsonData.objetivo['id'];
            // console.log(this.arbol_de_objetivos);
            this.arbol_de_objetivos.forEach(element => {               
                if(this.jsonData.objetivo['padre'] == element.id){
                    this.jsonData.proyectos['id'] = element.intervenciones_id;
                }
            });
            this.jsonData.gestion = this.gestion_trabajo.nombre;
            // console.log(this.jsonData);return;
            var respuesta = await axios.post('guardar_objetivos', this.jsonData);
            console.log(respuesta);
            document.getElementById("cerrarModal").click();
            this.abrir_modal_registro = false;
            this.buscar_arbol_marco_logico();
            this.limpiar_form();
        },
        cerrando_modal(){
            this.abrir_modal_registro = false;
            this.jsonData.objetivo = {};
        },
        cambia_clase(clase){
            $('.' + clase).each(function(){
                if( $(this).hasClass('text-success') ){
                    $("." + clase).removeClass("text-success");
                    $("." + clase).removeClass("fa-plus");
                    $("." + clase).addClass("text-danger");
                    $("." + clase).addClass("fa-minus");
                }else{
                    if( $(this).hasClass('text-danger') ){     
                        $("." + clase).removeClass("text-danger");
                        $("." + clase).removeClass("fa-minus");                   
                        $("." + clase).addClass("text-success");
                        $("." + clase).addClass("fa-plus");
                    }
                }
            });
        }, 
        async unidad_medida(){            
            var respuesta = await axios.get('unidad_medida');
            this.unidadMedidaCombo = respuesta.data;  
        }, 
        async frecuencia_medicion(){//indicador_frecuencia            
            var respuesta = await axios.get('frecuencia_medicion');
            this.frecuenciaMedicionCombo = respuesta.data;
        }, 
        async tipos_objetivos(){
            var respuesta = await axios.get('tipos_objetivos');
            this.objetivosCombo = respuesta.data;
        },
        async actividad(){
            var respuesta = await axios.get('actividad_marco_logico/' + this.jsonData.proyectos.id);
            this.actividadesCombo = respuesta.data;            
        },
        async componente(){
            var respuesta = await axios.get('componente_marco_logico/' + this.jsonData.proyectos.id);
            this.componentesCombo = respuesta.data;            
        },
        async objetivos(){   //la intervencion o proceso puede tener varios objetivos asique recuperamos para ver cuales        
            var respuesta = await axios.get('objetivos_proceso/' + this.jsonData.proyectos.id);
            this.jsonData.objetivosProceso = respuesta.data;
            var objetivosDeEstaIntervencion = respuesta.data;
            var cont = 0;
            objetivosDeEstaIntervencion.forEach(element => {
                // console.log(element);
                cont++;
            });
            if(cont > 0){
                if(cont == 1){ //hora de registrar proposito  
                    var id_padre = 0;

                    objetivosDeEstaIntervencion.forEach(element => {
                        if(element.objetivetype_id == 1){
                            id_padre = element.id;

                            var date = moment(element.fecha_inicial_programada, 'YYYY-MM-DD');
                            this.jsonData.fecha_heredada_inicio= new Date(date);
                            this.jsonData.fecha_inicio =  new Date(date);
                            date = moment(element.fecha_final_programada, 'YYYY-MM-DD');
                            this.jsonData.fecha_heredada_fin= new Date(date);
                            this.jsonData.fecha_fin =  new Date(date);
                        }
                    });                  
                    this.jsonData.objetivo = this.objetivosCombo[1];                    
                    this.jsonData.objetivo.padre = id_padre;
                    // console.log(this.jsonData.objetivo);
                    this.objetivo_nombre = this.jsonData.objetivo.objetivo;
                    this.resultado_nombre = this.jsonData.objetivo.resultado;
                    this.objetivo_disabled=true;
                    this.btnguardar_modal = true;
                    this.btnmodificar_modal = false,
                    $('#registro_objetivos_proyecto').modal({backdrop: 'static', keyboard: false});                    
                    this.modal_ver_objetivos = true;
                    this.modal_ver_resultados = true;
                    this.modal_ver_todos_resultados = false;
                    this.modal_ver_indicadores = false;
                    this.modal_ver_indicadores_planificacion = false;
                    this.modal_ver_planificacion = false;
                    this.modal_ver_programacion = false;
                }else{
                    var validado = 0;
                    var nuevo_combo = [];
                    objetivosDeEstaIntervencion.forEach(element => {
                        if(element.objetivetype_id == 1){
                            validado++;
                        }else{
                            if(element.objetivetype_id == 2){
                                validado++;
                            }
                        }
                    });
                    if(validado == 2){
                        this.objetivosCombo.forEach(element => {
                            if(element.id != 1 && element.id != 2){
                                nuevo_combo.push(element);
                            }
                        });
                    }                    
                    this.objetivosCombo = nuevo_combo;
                }
                this.componente();
                this.actividad();
            }else{ // hora de registrar fin
                this.jsonData.objetivo = this.objetivosCombo[0];
                this.objetivo_nombre = this.jsonData.objetivo.objetivo;
                this.resultado_nombre = this.jsonData.objetivo.resultado;
                
                this.objetivo_disabled=true;//bloquerar el combo de objetivos para que cree el fin por defecto como primer objetivo
                this.btnguardar_modal = true;
                this.btnmodificar_modal = false;
                
                var date = moment(this.jsonData.proyectos.fecha_aprobacion, 'YYYY-MM-DD');
                this.jsonData.fecha_heredada_inicio= new Date(date);
                this.jsonData.fecha_inicio =  new Date(date);
                date = moment(this.jsonData.proyectos.fecha_inicial_programada, 'YYYY-MM-DD');
                this.jsonData.fecha_heredada_fin= new Date(date);
                this.jsonData.fecha_fin =  new Date(date);

                var fecha_ini = moment(this.jsonData.fecha_inicio);
                var fecha_fin = moment(this.jsonData.fecha_fin);

                this.jsonData.duracion_dias = fecha_fin.diff(fecha_ini, 'days');
                this.jsonData.monto_bs = this.jsonData.proyectos.monto_aprobado_bs;

                $('#registro_objetivos_proyecto').modal({backdrop: 'static', keyboard: false});//abrimos por default la modal para registrar fin          
                this.modal_ver_objetivos = true;
                this.modal_ver_resultados = true;
                this.modal_ver_todos_resultados = false;
                this.modal_ver_indicadores = false;
                this.modal_ver_indicadores_planificacion = false;
                this.modal_ver_planificacion = false;
                this.modal_ver_programacion = false;
            }
        },
        edit_objetivos(){
            if(this.abrir_modal_registro == false){       
                // console.log("1");         
                if(this.jsonData.objetivo.id != null && this.jsonData.objetivo.id != 'undefined'){  
                    var entrar = true;  
                    if(this.jsonData.objetivo.id == 4){//actividad
                        if(this.jsonData.componente.id != null && this.jsonData.componente.id != 'undefined'){             
                            entrar = true;
                        }else{
                            entrar = false;
                        }
                    }else{
                        if(this.jsonData.objetivo.id == 5){//tarea
                            if(this.jsonData.actividad.id != null && this.jsonData.actividad.id != 'undefined'){             
                                entrar = true;
                            }else{
                                entrar = false;
                            }
                        }
                    }//si no entro es componente y no necesitamos declarar nada por que no se cuega
                    if(entrar == true){
                        this.objetivo_nombre = this.jsonData.objetivo.objetivo;
                        this.resultado_nombre = this.jsonData.objetivo.resultado;
                        this.btnguardar_modal = true;
                        this.btnmodificar_modal = false;
                        $('#registro_objetivos_proyecto').modal({backdrop: 'static', keyboard: false});          
                        this.modal_ver_objetivos = true;
                        this.modal_ver_resultados = true;
                        this.modal_ver_todos_resultados = false;
                        this.abrir_modal_registro = true;
                        this.modal_ver_indicadores = false;
                        this.modal_ver_indicadores_planificacion = false;
                        this.modal_ver_planificacion = false;
                        this.modal_ver_programacion = false;
                    }else{
                        if(this.jsonData.objetivo.id == 4){
                            this.cerrando_modal();
                            alert("Favor de escoger un componente");
                        }
                        if(this.jsonData.objetivo.id == 5){
                            this.cerrando_modal();
                            alert("Favor de escoger una actividad");
                        }
                    }             
                }
            }
        },
        async productos(){
            if(this.jsonData.componente.id != null && this.jsonData.componente.id != 'undefined'){                
                var respuesta = await axios.get('producto_marco_logico/' + this.jsonData.componente.id);
                // console.log(respuesta);
                this.productosCombo = respuesta.data;
            }
        },
        async verificar_un_solo_proyecto(){
            var respuesta = await axios.get('proyectos_de_institucion');
            if(respuesta.data.cantidad > 1){
                this.jsonData.nombreInstitucion = respuesta.data.institucion.nombre;
                this.proyectos = respuesta.data.proyectos;
                // console.log(this.proyectos);
                $("#marco_logico_modal_seleccion_proyecto").modal("show");
                // this.buscar_arbol_marco_logico();
            }else{
                if(respuesta.data.cantidad == 1){
                    this.jsonData.proyectos = respuesta.data.proyectos[0];
                    this.proyectos = respuesta.data.proyectos;
                    // console.log(this.jsonData.proyectos);
                    // this.objetivos();
                    // this.buscar_arbol_marco_logico();
                    buscarSeleccion();
                }else{
                    this.configAlertaMensaje("Mensajes del Sistema", "Este es un mensaje de advertencia", "usted no tiene proyectos registrados", "¡¡¡ Gracias por su atención !!!");
                    this.$refs.abrirAlertaMensaje.abrirAlerta();
                    // alert("usted no tiene proyectos");
                }                
            }    
        },
        configAlertaMensaje(titulo, contenidoCabecera, contenidoCuerpo, contenidoPie){
            this.mandarMensajesAlerta={
                titulo:titulo,//titulo del mensaje
                contenidoCabecera:contenidoCabecera,//contenido del mensaje
                contenidoCuerpo:contenidoCuerpo,//contenido del mensaje
                contenidoPie:contenidoPie,//contenido del mensaje
                tipo:"ferdy-background-Primary-blak",//color danger warnin etc para header de modal
            };
        },
        buscarSeleccion(){
            console.log(this.jsonData.proyectos);
            this.buscar_objetivos_para_poa(this.jsonData.proyectos.id);
            this.gestiones_poa();
            // this.objetivos();
            // this.buscar_arbol_marco_logico();
        },
        async buscar_arbol_marco_logico(){    
            // $('[name="objetivos_componentes_poa[]"]').click(function() {      
                var ids = $('[name="objetivos_componentes_poa[]"]:checked').map(function(){
                    return this.value;
                }).get();
                // console.log(ids);
            // });
            // return;
            var gestion = this.buscar_gestion_activa();            
            var respuesta = await axios.post('buscar_arbol_marco_logico_poa', {'gestion':gestion, 'id_intervencion':this.jsonData.proyectos.id});
            console.log(respuesta.data);
            this.arbol_de_objetivos = respuesta.data;
        },
        limpiar_form(){
            this.jsonData.descripcion_corta_objetivo = "";  
            this.jsonData.descripcion_corta_resultado = "";  
            this.jsonData.fecha_inicio = "";  
            this.jsonData.fecha_fin = "";  
            this.jsonData.resumen_narrativo_objetivo = "";  
            this.jsonData.resumen_narrativo_resultado = "";  
            this.jsonData.duracion_dias = "";  
            this.jsonData.monto_bs = "";  
            this.jsonData.resumen_narrativo = "";  
            this.jsonData.resumen_narrativo = "";  
            this.jsonData.resumen_narrativo = "";  
            this.jsonData.resumen_narrativo = "";  
            this.jsonData.resumen_narrativo = "";  
        },
        respuestaModalAlertaMensaje(datos){
            //respues de alerta
        },
        respuestaSubArbol(datos_del_arbol){
            this.limpiar_form();
            // console.log(datos_del_arbol);
            datos_del_arbol.forEach(element => {  
                if(element.estado == "agregaHijo"){
                    this.objetivo_nombre = element.tipo_objetivo_hijo.objetivo;
                    this.resultado_nombre = element.tipo_objetivo_hijo.resultado;            
                    this.btnguardar_modal = true;
                    this.btnmodificar_modal = false;
                    this.btnadicionar_modal = false;
                    this.btnadicionarIndicador_modal = false;
                    this.btnmodificarIndicador_modal = false;
                    this.btnadicionarPlanificacion_modal = false;
                    this.btnmodificarPlanificacion_modal = false;
                    this.jsonData.objetivo = element.tipo_objetivo_hijo;
                    this.abrir_modal_registro = true;
                    this.jsonData.objetivo.padre = element.objetivo_padre.id;

                    this.jsonData.objetivoPadre = element.objetivo_padre;

                    var date = moment(element.objetivo_padre.fecha_inicial_programada, 'YYYY-MM-DD');
                    this.jsonData.fecha_heredada_inicio= new Date(date);
                    this.jsonData.fecha_inicio =  new Date(date);
                    date = moment(element.objetivo_padre.fecha_final_programada, 'YYYY-MM-DD');
                    this.jsonData.fecha_heredada_fin= new Date(date);
                    this.jsonData.fecha_fin =  new Date(date);
                    
                    var fecha_ini = moment(this.jsonData.fecha_inicio);
                    var fecha_fin = moment(this.jsonData.fecha_fin);
                    // console.log(fecha_fin.diff(fecha_ini, 'days'), ' dias de diferencia');
                    this.jsonData.duracion_dias = fecha_fin.diff(fecha_ini, 'days');
                    this.jsonData.monto_bs = element.objetivo_padre.monto;
                    $('#registro_objetivos_proyecto').modal({backdrop: 'static', keyboard: false});            
                    this.modal_ver_objetivos = true;
                    this.modal_ver_resultados = true;
                    this.modal_ver_todos_resultados = false;
                    this.modal_ver_indicadores = false;
                    this.modal_ver_indicadores_planificacion = false;
                    this.modal_ver_planificacion = false;
                    this.modal_ver_programacion = false;
                    this.tipo_nueva_continuidad();
                }else{
                    if(element.estado == "verModificarObjetivo"){
                        this.abrir_modal_registro = true;
                        this.objetivo_nombre = element.tipo_objetivo.objetivo;
                        this.resultado_nombre = element.tipo_objetivo.resultado; 
                        this.jsonData.objetivo = element.tipo_objetivo;
                        // console.log(element.objetivo);
                        this.jsonData.descripcion_corta_objetivo = element.objetivo.desc_corta;
                        this.jsonData.resumen_narrativo_objetivo = element.objetivo.descripcion;
                        this.jsonData.duracion_dias = element.objetivo.duracion_dias;
                        this.jsonData.fecha_fin = element.objetivo.fecha_final_programada;
                        this.jsonData.fecha_inicio = element.objetivo.fecha_inicial_programada;
                        this.jsonData.id_objetivo_update = element.objetivo.id;
                        this.jsonData.monto_bs = element.objetivo.monto;
                        // this.jsonData.descripcion_corta_objetivo = element.objetivo.padre;
                        if(element.objetivo.tipo_ejecucion == true){
                                this.jsonData.tipo_ejecucion = {id:1, nombre:"Ejecución Propia", valor:true};
                        }else{
                            if(element.objetivo.tipo_ejecucion == false){
                                this.jsonData.tipo_ejecucion = {id:1, nombre:"Ejecución Propia", valor:false};
                            }
                        }
                        $('#registro_objetivos_proyecto').modal({backdrop: 'static', keyboard: false});      
                        this.modal_ver_objetivos = true;
                        this.modal_ver_resultados = false;
                        this.modal_ver_todos_resultados = false;      
                        this.modal_ver_indicadores = false;   
                        this.modal_ver_indicadores_planificacion = false;
                        this.modal_ver_planificacion = false; 
                        this.modal_ver_programacion = false;

                        this.btnguardar_modal = false;
                        this.btnmodificar_modal = true;
                        this.btnadicionar_modal = false;
                        this.btnadicionarIndicador_modal = false;
                        this.btnmodificarIndicador_modal = false;
                        this.btnadicionarPlanificacion_modal = false;
                        this.btnmodificarPlanificacion_modal = false;
                    }else{
                        if(element.estado == "verModificarResultado"){
                            // console.log(element.resultado);
                            this.abrir_modal_registro = true;
                            this.objetivo_nombre = element.tipo_objetivo.objetivo;
                            this.resultado_nombre = element.tipo_objetivo.resultado; 
                            this.jsonData.objetivo = element.tipo_objetivo;
                            
                            this.jsonData.id_objetivo_update = element.objetivo.id;
                            // console.log(element.objetivo);

                            this.rows = element.resultado;

                            if(element.objetivo.tipo_ejecucion == true){
                                    this.jsonData.tipo_ejecucion = {id:1, nombre:"Ejecución Propia", valor:true};
                            }else{
                                if(element.objetivo.tipo_ejecucion == false){
                                    this.jsonData.tipo_ejecucion = {id:1, nombre:"Ejecución Propia", valor:false};
                                }
                            }

                            $('#registro_objetivos_proyecto').modal({backdrop: 'static', keyboard: false});      
                            this.modal_ver_objetivos = false;
                            this.modal_ver_resultados = true;
                            this.modal_ver_todos_resultados = true;  
                            this.modal_ver_indicadores = false;  
                            this.modal_ver_indicadores_planificacion = false;
                            this.modal_ver_planificacion = false; 
                            this.modal_ver_programacion = false;                         

                            this.btnguardar_modal = false;
                            this.btnmodificar_modal = false;
                            this.btnadicionar_modal =true;
                            this.btnadicionarIndicador_modal = false;
                            this.btnmodificarIndicador_modal = false;
                            this.btnadicionarPlanificacion_modal = false;
                            this.btnmodificarPlanificacion_modal = false;
                        }
                    }
                }
            });
        },
        //////////////////////indicadores
        EditarIndicador(resultado){
            // console.log(resultado);//resultad
            this.jsonData.resultadoIndicador = resultado;
            this.jsonData.objetivosProceso.forEach(element => {
                this.jsonData.objetivoIndicador = element;
            });            
            // console.log(this.jsonData.objetivo);//tipo de objetivo
            // console.log(this.jsonData.objetivosProceso);//objetivo
            // console.log(this.jsonData.proyectos);//proyecto
                     
            this.modal_ver_objetivos = false;
            this.modal_ver_resultados = false;
            this.modal_ver_todos_resultados = false;
            this.modal_ver_indicadores = true;
            this.modal_ver_indicadores_planificacion = true;
            this.modal_ver_planificacion = false;
            this.modal_ver_programacion = false;
            
            this.btnguardar_modal = false;
            this.btnmodificar_modal = false;
            this.btnadicionar_modal = false;
            this.btnadicionarIndicador_modal = true;
            this.btnmodificarIndicador_modal = false;
            this.btnadicionarPlanificacion_modal = false;
            this.btnmodificarPlanificacion_modal = false;
            this.listarIndicador(this.jsonData.resultadoIndicador);
        },
        async guardarIndicador(){
            // console.log(this.jsonData);
            var respuesta = await axios.post('indicadores', this.jsonData);
            this.jsonData.Indicador = respuesta.data;
            // console.log(this.jsonData.Indicador);
            this.listarIndicador(this.jsonData.resultadoIndicador);  
            this.limpiar_indicador();
        },
        EditarEsteIndicador(datosIndicador){            
            // console.log(datosIndicador);
            this.jsonData.Indicador_id = datosIndicador.id;
            this.jsonData.Indicador_nombre = datosIndicador.nombre;
            this.jsonData.Indicador_descripcion = datosIndicador.descripcion;
            this.jsonData.Indicador_frecuencia = datosIndicador.frecuencias;
            this.jsonData.Indicador_variables = datosIndicador.variables;
            this.jsonData.Indicador_calculo = datosIndicador.calculo;
            this.jsonData.Indicador_unidades_id = datosIndicador.unidades;
            this.jsonData.Indicador_medios_verificacion = datosIndicador.medios_verificacion;

            this.btnguardar_modal = false;
            this.btnmodificar_modal = false;
            this.btnadicionar_modal = false;
            this.btnadicionarIndicador_modal = false;
            this.btnmodificarIndicador_modal = true;
            this.btnadicionarPlanificacion_modal = false;
            this.btnmodificarPlanificacion_modal = false;

        },
        async eliminarIndicador(id){
            var respuesta = await axios.delete('indicadores/' + id);            
            // console.log(respuesta.data);
            this.listarIndicador(this.jsonData.resultadoIndicador); 
            this.limpiar_indicador();
        },
        async modificarIndicador(){
            // console.log(this.jsonData);
            var respuesta = await axios.post('indicadores_mod', this.jsonData);
            this.jsonData.Indicador = respuesta.data;
            // console.log(this.jsonData.Indicador);
            this.listarIndicador(this.jsonData.resultadoIndicador); 
            this.limpiar_indicador();
        },
        async listarIndicador(resultado){
            var respuesta = await axios.get('indicadores/' + resultado.id);
            this.rowsIndicadores = respuesta.data;
            // console.log(this.rowsIndicadores);
        },
        limpiar_indicador(){
            this.jsonData.Indicador_id = null;
            this.jsonData.Indicador_nombre = "";
            this.jsonData.Indicador_descripcion = "";
            this.jsonData.Indicador_frecuencia = {};
            this.jsonData.Indicador_variables = "";
            this.jsonData.Indicador_calculo = "";
            this.jsonData.Indicador_unidades_id = {};
            this.jsonData.Indicador_medios_verificacion = "";
        },
        //////////////////////planificacion
        async EditarPlanificacion(indicador){
            // console.log(indicador);
            this.jsonData.Indicador = indicador;

            this.modal_ver_objetivos = false;
            this.modal_ver_resultados = false;
            this.modal_ver_todos_resultados = false;
            this.modal_ver_indicadores = false;
            this.modal_ver_indicadores_planificacion = true;
            this.modal_ver_planificacion = true;
            this.modal_ver_programacion = false;

            this.btnguardar_modal = false;
            this.btnmodificar_modal = false;
            this.btnadicionar_modal = false;
            this.btnadicionarIndicador_modal = false;
            this.btnmodificarIndicador_modal = false;
            this.btnadicionarPlanificacion_modal = true;
            this.btnmodificarPlanificacion_modal = false;
                        
            var jsonComp = {'id_resultado':this.jsonData.resultadoIndicador.id, 'id_indicador':indicador.id};
            var respuesta = await axios.post('indicador_resultado', jsonComp);
            this.jsonData.Planificacion_indicadores_resultados_id = respuesta.data;
            console.log(this.jsonData.Planificacion_indicadores_resultados_id);
            this.listarPlanificacion(this.jsonData.Planificacion_indicadores_resultados_id.id); 
        },
        async guardarPlanificacion(){
            let datos_jsonData = new FormData();
            for(let key in this.jsonData){                
                datos_jsonData.append(key, this.jsonData[key]);
            }
            var fecha_inicial = new Date(this.jsonData.Planificacion_fecha_inicial);
            var fecha_final = new Date(this.jsonData.Planificacion_fecha_final);
            datos_jsonData.append('id_fecha_inicial', fecha_inicial.getFullYear() + "-" + (fecha_inicial.getMonth() + 1) + "-" + fecha_inicial.getDate());
            datos_jsonData.append('id_fecha_final', fecha_final.getFullYear() + "-" + (fecha_final.getMonth() + 1) + "-" + fecha_final.getDate());
            datos_jsonData.append('indicadores_resultados_id', this.jsonData.Planificacion_indicadores_resultados_id.id);
            datos_jsonData.append('indicador_frecuencia_id', this.jsonData.Planificacion_indicador_frecuencia_id.id);
            datos_jsonData.append('intervencion_id', this.jsonData.proyectos.id);
            datos_jsonData.append('institucion_id', this.jsonData.proyectos.institucion_id);
            
            var respuesta = await axios.post('planificaciones', datos_jsonData);
            console.log(respuesta.data);
            this.listarPlanificacion(respuesta.data.indicadores_resultados_id);  
            this.limpiarPlanificacion();
        },
        EditarEstaPlanificacion(planificacion){
            console.log(planificacion);
            this.jsonData.Planificacion_id = planificacion.id;
            // this.jsonData.Planificacion_indicadores_resultados_id = planificacion.frecuencias;//esto ya esta cuando abrimos la ventana en editar planificaciones y esto es editar esta planificacion son dos diferentes ojo
            this.jsonData.Planificacion_gestion = planificacion.gestion;
            this.jsonData.Planificacion_fecha_inicial = planificacion.fecha_inicial;
            this.jsonData.Planificacion_fecha_final = planificacion.fecha_final;
            this.jsonData.Planificacion_indicador_frecuencia_id = planificacion.frecuencias;
            this.jsonData.Planificacion_valor_inicial = planificacion.valor_inicial;
            this.jsonData.Planificacion_valor_final = planificacion.valor_final;
            this.jsonData.Planificacion_glosa = planificacion.glosa;
            this.jsonData.Planificacion_pathDocumento = planificacion.pathDocumento;
            
            this.btnguardar_modal = false;
            this.btnmodificar_modal = false;
            this.btnadicionar_modal = false;
            this.btnadicionarIndicador_modal = false;
            this.btnmodificarIndicador_modal = false;
            this.btnadicionarPlanificacion_modal = false;
            this.btnmodificarPlanificacion_modal = true;

            this.reiniciar_file('#label_documento_res_aprobacion', ['bg-primary', 'bg-success'], ['bg-success'], '#contenido_documento_res_aprobacion',[this.jsonData.Planificacion_pathDocumento]);
        },   
        async modificarPlanificacion(){
            let datos_jsonData = new FormData();
            for(let key in this.jsonData){                
                datos_jsonData.append(key, this.jsonData[key]);
            }
            var fecha_inicial = new Date(this.jsonData.Planificacion_fecha_inicial);
            var fecha_final = new Date(this.jsonData.Planificacion_fecha_final);
            datos_jsonData.append('id_fecha_inicial', fecha_inicial.getFullYear() + "-" + (fecha_inicial.getMonth() + 1) + "-" + fecha_inicial.getDate());
            datos_jsonData.append('id_fecha_final', fecha_final.getFullYear() + "-" + (fecha_final.getMonth() + 1) + "-" + fecha_final.getDate());
            datos_jsonData.append('indicadores_resultados_id', this.jsonData.Planificacion_indicadores_resultados_id.id);
            datos_jsonData.append('indicador_frecuencia_id', this.jsonData.Planificacion_indicador_frecuencia_id.id);
            
            var respuesta = await axios.post('planificaciones_mod', datos_jsonData);
            // console.log(respuesta.data);
            this.listarPlanificacion(respuesta.data.indicadores_resultados_id); 
            this.limpiarPlanificacion();
        },  
        async listarPlanificacion(indicador_resultado_id){
            var respuesta = await axios.get('planificaciones/' + indicador_resultado_id);
            this.rowsPlanificaciones = respuesta.data;
            // console.log(this.rowsPlanificaciones);
        },
        async eliminarPlanificacion(id){            
            var respuesta = await axios.delete('planificaciones/' + id);            
            // console.log(respuesta.data);
            this.listarPlanificacion(this.jsonData.resultadoIndicador); 
            this.limpiarPlanificacion();
        },
        limpiarPlanificacion(){
            this.jsonData.Planificacion_id = null;
            // this.jsonData.Planificacion_indicadores_resultados_id = {};// esto es de resultados tener que borrar seria buscar una nueva forma de generar
            this.jsonData.Planificacion_gestion = '';
            this.jsonData.Planificacion_fecha_inicial = '';
            this.jsonData.Planificacion_fecha_final = '';
            this.jsonData.Planificacion_indicador_frecuencia_id = {};
            this.jsonData.Planificacion_valor_inicial = '';
            this.jsonData.Planificacion_valor_final = '';
            this.jsonData.Planificacion_glosa = '';
            this.jsonData.Planificacion_pathDocumento = '';
            this.jsonData.files = null;
        },
        ////////////////////////programacion
        EditarProgramacion(planificacion){
            // console.log(planificacion);
            this.modal_ver_objetivos = false;
            this.modal_ver_resultados = false;
            this.modal_ver_todos_resultados = false;
            this.modal_ver_indicadores = false;
            this.modal_ver_indicadores_planificacion = true;
            this.modal_ver_planificacion = false;
            this.modal_ver_programacion = true;

            this.jsonData.Programacion_cantidad_rows = 4;
            
            this.Programacion_title_planificacion = "";
            this.jsonData.Programacion_title_gestion = planificacion.gestion;
            this.jsonData.Programacion_title_fecha_inicial = planificacion.fecha_inicial;
            this.jsonData.Programacion_title_fecha_final = planificacion.fecha_final;
            this.jsonData.Programacion_title_valor_inicial = planificacion.valor_inicial;
            this.jsonData.Programacion_title_valor_final = planificacion.valor_final;
            this.jsonData.Programacion_title_frecuencia = planificacion.frecuencias.nombre;
            this.jsonData.Programacion_title_registros = "";   
                                    
            this.btnguardar_modal = false;
            this.btnmodificar_modal = false;
            this.btnadicionar_modal = false;
            this.btnadicionarIndicador_modal = false;
            this.btnmodificarIndicador_modal = false;
            this.btnadicionarPlanificacion_modal = false;
            this.btnmodificarPlanificacion_modal = false;
            
            this.buscarProgramacionesIndicadorPlanificacion(planificacion);
        },
        async buscarProgramacionesIndicadorPlanificacion(planificacion){
            var respuesta = await axios.get('programaciones/' + planificacion.id);
            console.log("aqui");
            console.log(respuesta.data);
            var valor_de_guardar = true;
            respuesta.data.forEach(element => {
                if(element.id != null && element.id != 'undefined'){
                    valor_de_guardar = false;                    
                    element.fecha = moment(element.fecha, 'YYYY-MM-DD');
                    element.fecha = new Date(element.fecha);
                }                
            });
            console.log("salio");
            if(valor_de_guardar == false){//existe indicador_seguimiento registros
                this.rowsProgramaciones = respuesta.data; 
                console.log(this.rowsProgramaciones);
            }else{
                this.rowsProgramaciones = [];
                var date = moment(planificacion.fecha_inicial, 'YYYY-MM-DD');//preparacion fecha de planificacion inicial
                var date_aux =  new Date(date);
                var fecha_Programacion_fecha = date_aux;
                var fecha_ini_calculo = moment(date_aux);
                
                date = moment(planificacion.fecha_final, 'YYYY-MM-DD');//preparando fecha de planificacion final
                date_aux =  new Date(date);
                var fecha_Programacion_fecha_aux = date_aux;
                var fecha_fin_calculo = moment(date_aux);            

                var cant_dias_total = fecha_fin_calculo.diff(fecha_ini_calculo, 'days');//cantidad de dias totales
                var cant_dias_frecuencia = Number(planificacion.frecuencias.dias);//la medion de frecuencia del id de frecuencias
                var cantidad_filas = Math.round(cant_dias_total/cant_dias_frecuencia);//cantidad de filas generadas
                var cantidad_dias_en_intervalos = Math.round(cant_dias_total/cantidad_filas);//cantidda de intervalos biseccionados con respecto a la cantidad e fias que se generaron
                // console.log(cant_dias_total);
                // console.log(cant_dias_frecuencia);
                // console.log(cantidad_filas);
                // console.log("");
                var cant_valor_inicial = parseFloat(planificacion.valor_inicial);//valor inicial de planificacion
                var cant_valor_final = parseFloat(planificacion.valor_final);//valor final de planificacion
                var cant_valor = cant_valor_final - cant_valor_inicial;//valor de intervalo entre inicio y fin
                var cant_valor_en_intervalos = cant_valor / cantidad_filas;//valor biseccionado con respecto a la cantidad de filas que se genera
                // console.log(cant_valor_inicial);
                // console.log(cant_valor_final);
                // console.log(cant_valor);
                // console.log(cant_valor_en_intervalos);
                for(var i=0; i<cantidad_filas; i++){
                    if((i+1) == cantidad_filas){
                        fecha_Programacion_fecha = fecha_Programacion_fecha_aux;
                        cant_valor_en_intervalos = (cant_valor_en_intervalos * (cantidad_filas-1));
                        cant_valor_en_intervalos = cant_valor - cant_valor_en_intervalos;
                    }else{
                        fecha_Programacion_fecha = moment(fecha_Programacion_fecha).add(cant_dias_frecuencia, 'days');
                        fecha_Programacion_fecha = moment(fecha_Programacion_fecha, 'YYYY-MM-DD');                
                        fecha_Programacion_fecha =  new Date(fecha_Programacion_fecha);
                    }
                    var array = {
                        fecha:fecha_Programacion_fecha,
                        concepto:"comentario" + i,
                        valor_medido:cant_valor_en_intervalos,
                    };
                    this.rowsProgramaciones.push(array);
                }
                if(this.rowsProgramaciones != []){
                    this.GuardarProgramacion(planificacion);
                }                
            }            
        },
        GuardarProgramacion(planificacion){
            this.rowsProgramaciones.forEach(element => {
                var array = {
                    indicador_planificacion_id:planificacion.id,
                    fecha:element.fecha.getFullYear() + "/" + (element.fecha.getMonth() + 1) + "/" + element.fecha.getDate(),
                    gestion:planificacion.gestion,
                    move_indicator_type_id:1,
                    concepto:element.concepto,
                    valor_medido:element.valor_medido,
                    glosa:'',
                    pathDocumento:''
                };
                this.storeProgramacion(array);
            });
        },
        async storeProgramacion(array){            
            var respuesta = await axios.post('programaciones', array);
            console.log(respuesta.data);
        },
        EditarEstaProgramacion(programacion){
            var date = moment(programacion.fecha, 'YYYY-MM-DD');
            date = new Date(date);
            var array = {
                id:programacion.id,
                indicador_planificacion_id:programacion.indicador_planificacion_id,
                fecha:date.getFullYear() + "/" + (date.getMonth() + 1) + "/" + date.getDate(),
                gestion:programacion.gestion,
                move_indicator_type_id:programacion.move_indicator_type_id,
                concepto:programacion.concepto,
                valor_medido:programacion.valor_medido,
                glosa:programacion.glosa,
                pathDocumento:programacion.pathDocumento
            };
            this.ModificarProgramacion(array);
        },
        async ModificarProgramacion(programacion){  
            var respuesta = await axios.post('programaciones_mod', programacion);
            console.log(respuesta.data);          
        },
        /*********** funciones de configuracion**************/
        funcionRespuestaConfig(configuracion){        
            this.configFechas = configuracion.configFechas;
            this.configTablas = configuracion.configTablas;
            console.log(this.configTablas);
            this.actions = configuracion.configTablasAction;
            this.classes = configuracion.configTablasClases;
            this.configToolBarEditText = configuracion.configToolBarEditText;
        },
        funcionRecuperaConfig(){//funcion solicita la configuracion
            this.$refs.RecuperaConfig.RecuperaConfig();//esta es la funcion de mandar configuracion desde hijo
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
        /*************************fin funciones de configuracion********************** */
    },
    created(){
        this.verificar_un_solo_proyecto();
        this.frecuencia_medicion();
        this.tipos_objetivos();
        this.unidad_medida();
    },
    mounted() {
        this.funcionRecuperaConfig();
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