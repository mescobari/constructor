<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Constructor'], function () {
       
       
        
        Route::get('rep_indicadores', 'PlanillaReportesController@inicio')->name('rep_indicadores');  //menu
        Route::get('ver_planilla/{id}', 'PlanillaReportesController@planilla_individual')->name('planilla_individual');
        Route::get('ver_pla_vigente/{id}', 'PlanillaReportesController@planilla_vigente')->name('ver_pla_vigente');
        Route::get('ver_pla_fisico/{id}', 'PlanillaReportesController@planilla_ejecucion')->name('ver_pla_fisico');
       
   
    });     
?>