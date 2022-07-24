<?php
    Route::group(['prefix' => 'Reportes', 'namespace' => 'Front_End\Reportes'], function () {
        Route::get('Reportes', 'ReportesController@inicio')->name('Reportes');  //menu
        Route::apiResource('Reporteses', ReportesController::class);
        Route::post('buscar_Reporteses', 'ReportesController@buscar_Reporteses')->name('buscar_Reporteses');
        Route::post('Reporteses_mod', 'ReportesController@Reporteses_mod')->name('Reporteses_mod');
        
        Route::get('proyectos_de_institucion_reporte', 'ReportesController@proyectos_de_institucion_reporte')->name('proyectos_de_institucion_reporte');

        Route::get('ficha_proyecto/{id}', 'ReportesController@ficha_proyecto')->name('ficha_proyecto');
        Route::get('ficha_proyecto_localizacion/{id}', 'ReportesController@ficha_proyecto_localizacion')->name('ficha_proyecto_localizacion');
        Route::get('ficha_proyecto_estructura_financiamiento/{id}', 'ReportesController@ficha_proyecto_estructura_financiamiento')->name('ficha_proyecto_estructura_financiamiento');
        Route::get('ficha_proyecto_documentos/{id}', 'ReportesController@ficha_proyecto_documentos')->name('ficha_proyecto_documentos');

        Route::get('mml_proyecto/{id}', 'ReportesController@mml_proyecto')->name('mml_proyecto');


        Route::get('Reportes_documentos_legales', 'ReportesController@Reportes_documentos_legales')->name('Reportes_documentos_legales');  //menu
        Route::get('documentos_de_proyecto_reporte/{id}', 'ReportesController@documentos_de_proyecto_reporte')->name('documentos_de_proyecto_reporte');
        Route::get('documentos_legales_vigencia/{id}', 'ReportesController@documentos_legales_vigencia')->name('documentos_legales_vigencia');
        
        Route::get('seguimiento_comprobante/{id}/{gestion}', 'ReportesController@seguimiento_comprobante');
        Route::get('seguimiento_comprobante_individual/{id}', 'ReportesController@seguimiento_comprobante_individual');
        Route::get('ficha_proyecto_estructura_financiamiento2/{id}', 'ReportesController@ficha_proyecto_estructura_financiamiento2')->name('ficha_proyecto_estructura_financiamiento2');
        
    });     
?>