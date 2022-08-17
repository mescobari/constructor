<?php



Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('documentos_legales', 'DocumentosLegalesController@inicio')->name('documentos_legales');  //menu
        Route::apiResource('documentos_legaleses', DocumentosLegalesController::class);
        Route::post('buscar_documentos_legaleses', 'DocumentosLegalesController@buscar_documentos_legaleses')->name('buscar_documentos_legaleses');
        Route::post('documentos_legaleses_mod', 'DocumentosLegalesController@documentos_legaleses_mod')->name('documentos_legaleses_mod');
        Route::post('buscar_documentos_legaleses_combo', 'DocumentosLegalesController@buscar_documentos_legaleses_combo')->name('buscar_documentos_legaleses_combo');
        Route::post('buscar_documentos_legaleses_tipos_doc', 'DocumentosLegalesController@buscar_documentos_legaleses_tipos_doc')->name('buscar_documentos_legaleses_tipos_doc');
        Route::post('buscar_documentos_legaleses_instituciones', 'DocumentosLegalesController@buscar_documentos_legaleses_instituciones')->name('buscar_documentos_legaleses_instituciones');
        Route::post('buscar_documentos_legaleses_org_finan', 'DocumentosLegalesController@buscar_documentos_legaleses_org_finan')->name('buscar_documentos_legaleses_org_finan');
        Route::post('buscar_documentos_legaleses_objetivos', 'DocumentosLegalesController@buscar_documentos_legaleses_objetivos')->name('buscar_documentos_legaleses_objetivos');

        Route::get('reporte_documentos_legales/{id}', 'DocumentosLegalesController@reporte')->name('reporte_documentos_legales');
    });
?>
