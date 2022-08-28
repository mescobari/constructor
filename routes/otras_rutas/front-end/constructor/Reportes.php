<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Constructor'], function () {
       
       
        
        Route::get('rep_indicadores', 'PlanillaReportesController@inicio')->name('rep_indicadores');  //menu


        Route::get('ver_lista_docs/{id}', 'PlanillaReportesController@lista_documentos')->name('ver_lista_docs');
        Route::get('ver_plazos/{id}', 'PlanillaReportesController@plazos_documentos')->name('ver_plazos');
        
        Route::get('ver_planilla/{id}', 'PlanillaReportesController@planilla_individual')->name('planilla_individual');
        Route::get('ver_pla_vigente/{id}', 'PlanillaReportesController@planilla_vigente')->name('ver_pla_vigente');
        Route::get('ver_pla_fisico/{id}', 'PlanillaReportesController@planilla_ejecucion')->name('ver_pla_fisico');
        Route::get('ver_gra_fisico/{id}', 'PlanillaReportesController@graficos_ejecucion')->name('ver_gra_fisico');
        Route::get('lista_respaldos/{id}', 'PlanillaReportesController@documentos_respaldo')->name('lista_respaldos');
        
        Route::get('ver_requerimientos/{id}', 'PlanillaReportesController@ver_requerimientos')->name('ver_requerimientos');
        

    });     
?>