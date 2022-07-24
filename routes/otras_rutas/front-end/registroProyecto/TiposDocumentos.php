<?php
    Route::group(['prefix' => 'paginas', 'namespace' => 'Front_End\Paginas'], function () {
        Route::get('TiposDocumentomenu', 'TiposDocumentosController@inicio')->name('TiposDocumentomenu');  //menu
        Route::apiResource('TiposDocumento', TiposDocumentosController::class);
        Route::get('TiposDocumentos', 'TiposDocumentosController@TiposDocumentos')->name('TiposDocumentos');
    });     
?>