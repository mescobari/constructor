<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Constructor'], function () {
       
        
        Route::get('rep_indicadores', 'PlanillaReportesController@inicio')->name('Reportes');  //menu
        Route::get('ver_planilla/{id}', 'PlanillaReportesController@planilla_individual')->name('planilla_individual');
       
   
   
    });     
?>